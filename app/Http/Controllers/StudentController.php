<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\CandidateDocument;
use App\Models\CandidateRequirementList;
use App\Models\Country;
use App\Models\Course;
use App\Models\DocumentCourse;
use App\Models\Guardian;
use App\Models\Potential;
use App\Models\User;
use App\Notifications\DocumentSubmitNotification;
use App\Notifications\PendingLeadNotify;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'actived', 'agent']);
    }

    /**
     * @return Application|Factory|View
     * student dashboard
     * student information page
     */
    public function studentInformation()
    {
        /**@var App\Models\User $user */
        $user = Auth::user();

        if (!$user->hasRole('Student')) {
            Auth::logout();
            abort(403);
        }

        $countries = Country::all();
        $candidateDetails = User::find(Auth::user()->id)->candidate;
        $cpfDetails = $candidateDetails->cpf;
        $coursesDetails = Course::where([['course_id', $cpfDetails->course_id], ['course_status', '1']])->first();
        $guardianDetails = $candidateDetails->guardian;

        return view('student.registration.information')->with(['guardianDetails' => $guardianDetails, 'countries' => $countries, 'coursesDetails' => $coursesDetails, 'candidateDetails' => $candidateDetails]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * Student file upload
     */
    public function studentInformationPost(Request $request): JsonResponse
    {
        $user = Auth::user();
        $candidate_details = User::find(Auth::user()->id)->candidate;

        if (\request('formNo') == 1) {

            $request->validate([
                'courseId' => 'required',
                'first_name' => 'required',
                'sur_name' => 'required',
                'mobile_no' => 'required|numeric',
                'dob' => 'required',
                'gender' => 'required',
                'addressLine' => 'required',
                'city' => 'required',
                'state' => 'required',
                'zip' => 'required',
                'country_id' => 'required',
                'nationality' => 'required',
                'passport_no' => 'nullable',
                'whatsapp_no' => 'required|numeric',
            ]);

            DB::transaction(function () use ($candidate_details) {

                $candidate_details->update([
                    'first_name' => ucfirst(\request('first_name')),
                    'sur_name' => ucfirst(\request('sur_name')),
                    'telephone' => \request('mobile_no'),
                    'dob' => \request('dob'),
                    'sex' => \request('gender'),
                    'address' => ucfirst(\request('addressLine') . ', ' . \request('city') . ', ' . \request('state') . ', ' . \request('zip')),
                    'city' => ucfirst(\request('city')),
                    'state' => ucfirst(\request('state')),
                    'zipcode' => \request('zip'),
                    'country' => \request('country_id'),
                    'nationality' => \request('nationality'),
                    'passport_no' => \request('passport_no'),
                    'whatsapp_no' => \request('whatsapp_no'),
                    'isComplete' => 'Yes'
                ]);

                //check for complete status (guardian details check)
                if (isset($candidate_details->guardian) && $candidate_details->guardian->isComplete === 'Yes') {
                    $candidate_details->candidateRequirementList->where('requirement_list_id', '1')->first()->update([
                        'isComplete' => 'Yes'
                    ]);
                }
            });

        } elseif (\request('formNo') == 2) {

            $request->validate([
                'guardian_title' => 'required',
                'guardian_firstName' => 'required',
                'guardian_lastName' => 'required',
                'guardian_email' => 'required',
                'guardian_phoneNo' => 'required',
                'guardian_mobileNo' => 'required',
                'relationship' => 'required',
                'occupation' => 'required',
                'homeAddress' => 'required',
            ]);

            DB::transaction(function () use ($candidate_details) {

                $guardian = Guardian::firstOrNew(['candidate_id' => $candidate_details->candidate_id]);
                $guardian->guardian_title = \request('guardian_title');
                $guardian->guardian_firstName = ucfirst(\request('guardian_firstName'));
                $guardian->guardian_lastName = ucfirst(\request('guardian_lastName'));
                $guardian->guardian_email = strtolower(\request('guardian_email'));
                $guardian->guardian_phoneNo = \request('guardian_phoneNo');
                $guardian->guardian_mobileNo = \request('guardian_mobileNo');
                $guardian->relationship = ucfirst(\request('relationship'));
                $guardian->occupation = ucfirst(\request('occupation'));
                $guardian->home_address = ucfirst(\request('homeAddress'));
                $guardian->isComplete = 'Yes';
                $guardian->save();

                //check for complete status (guardian details check)
                if (isset($candidate_details->guardian) && $candidate_details->guardian->isComplete === 'Yes' && $candidate_details->isComplete === 'Yes') {
                    $candidate_details->candidateRequirementList->where('requirement_list_id', '1')->first()->update([
                        'isComplete' => 'Yes'
                    ]);


                }

            });

        } elseif (\request('formNo') == 3) {

            $courseId = User::find($user->id)->candidate->cpf->course_id;
            $requireDocument = DocumentCourse::where([['document_course_status', 1], ['course_id', $courseId]])->get();

            foreach ($requireDocument as $reqDocs) {
                $docInfo = $reqDocs->document;
                if ($reqDocs->option == 'Mandatory') {
                    $request->validate(["$docInfo->doc_name" => 'required|mimes:pdf,jpg,png,jpeg|max:10240',]);
                } else {
                    $request->validate(["$docInfo->doc_name" => 'nullable|mimes:pdf,jpg,png,jpeg|max:10240',]);
                }
            }

            DB::transaction(function () use ($requireDocument, $candidate_details, $request) {

                foreach ($requireDocument as $reqDocs) {
                    $docInfo = $reqDocs->document;
                    if (!empty($request->file($docInfo->doc_name))) {
                        $extension = $request->file($docInfo->doc_name)->getClientOriginalExtension();
                        $name = $candidate_details->candidate_id . '_' . $docInfo->doc_name . '_' . time() . '.' . $extension;
                        $fill_path = $request->file($docInfo->doc_name)->storeAs('student_document', $name, 'public');

                        CandidateDocument::create([
                            'candidate_id' => $candidate_details->candidate_id,
                            'document_id' => $docInfo->document_id,
                            'file_path' => $fill_path
                        ]);
                    }
                }
            });

            $users = User::role('Super Admin')->get();
            Notification::sendNow($users, new DocumentSubmitNotification($candidate_details->candidate_id));
        }

        return response()->json($candidate_details->candidate_id);

    }

    /**
     * @return Application|Factory|View
     * Admin panel potential student section
     */
    public function potential_student()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('potential-student.view');

        if (!$permission) {
            Auth::logout();
            abort(403);
        }

        $potentialDetails = Potential::where('potential_status', '1');

        if ($user->hasRole('Agent')) {
            $agent_id = User::find($user->id)->agent->agent_id;
            $potentialDetails = $potentialDetails->where('agent_id', $agent_id);
        }

        $potentialDetails = $potentialDetails->get();
        return view('admin.potential.potential-students')->with(['potentialDetails' => $potentialDetails]);

    }


    /**
     * @param Request $request
     * @return RedirectResponse
     * re-upload required documents
     * student panel
     */
    public function reUploadDocument(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $candidateInfo = User::find($user->id)->candidate;

        $fileId = \request('fileID');
        $fileName = \request('docName');

        $documentInfo = CandidateDocument::find($fileId);

        $extension = $request->file('resubmitDoc')->getClientOriginalExtension();
        $name = $candidateInfo->candidate_id . '_' . $fileName . '_' . time() . '.' . $extension;
        $fill_path = $request->file('resubmitDoc')->storeAs('student_document', $name, 'public');

        try {
            $documentInfo->update([
                'file_path' => $fill_path,
                'status' => 'Pending',
                'reject_reason' => NULL
            ]);

            //delete old file
            Storage::disk('public')->delete('student_document/1_NIC_1652536910.png');

            //send notification
            $users = User::role('Super Admin')->get();
            Notification::sendNow($users, new DocumentSubmitNotification($candidateInfo->candidate_id));

        } catch (\Throwable $e) {
            return back()->with(['error' => 'File upload failed', 'error_type' => 'error']);
        }

        return back()->with(['success' => 'File re-uploaded successful.']);
    }
}
