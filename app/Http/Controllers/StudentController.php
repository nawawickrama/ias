<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\CandidateDocument;
use App\Models\Country;
use App\Models\Course;
use App\Models\DocumentCourse;
use App\Models\DocumentSetting;
use App\Models\Guardian;
use App\Models\Potential;
use App\Models\Student;
use App\Models\StudentAddress;
use App\Models\StudentGuardian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'actived', 'agent']);
    }

    public function studentInformation()
    {
        $countries = Country::all();
        $candidateDetails = User::find(Auth::user()->id)->candidate;
        $cpfDetails = $candidateDetails->cpf;
        $coursesDetails = Course::where([['course_id', $cpfDetails->course_id], ['course_status', '1']])->first();
        $documentDetails = DocumentCourse::where([['course_id', $cpfDetails->course_id], ['document_course_status', '1']])->get();
        $guardianDetails = $candidateDetails->guardian;

        return view('student.registration.information')->with(['guardianDetails' => $guardianDetails, 'documentDetails' => $documentDetails, 'countries' => $countries, 'coursesDetails' => $coursesDetails, 'candidateDetails' => $candidateDetails]);
    }

    public function studentWizardPost(Request $request)
    {
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

            $candidate_details->update([
                'first_name' => \request('first_name'),
                'sur_name' => \request('sur_name'),
                'telephone' => \request('mobile_no'),
                'dob' => \request('dob'),
                'sex' => \request('gender'),
                'address' => \request('addressLine') . ', ' . \request('city') . ', ' . \request('state') . ', ' . \request('zip'),
                'city' => \request('city'),
                'state' => \request('state'),
                'zipcode' => \request('zip'),
                'country' => \request('country_id'),
                'nationality' => \request('nationality'),
                'passport_no' => \request('passport_no'),
                'whatsapp_no' => \request('whatsapp_no'),
                'isComplete' => 'Yes'
            ]);

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

            $guardian = Guardian::firstOrNew(['candidate_id' => $candidate_details->candidate_id]);
            $guardian->guardian_title = \request('guardian_title');
            $guardian->guardian_firstName = \request('guardian_firstName');
            $guardian->guardian_lastName = \request('guardian_lastName');
            $guardian->guardian_email = \request('guardian_email');
            $guardian->guardian_phoneNo = \request('guardian_phoneNo');
            $guardian->guardian_mobileNo = \request('guardian_mobileNo');
            $guardian->relationship = \request('relationship');
            $guardian->occupation = \request('occupation');
            $guardian->home_address = \request('homeAddress');
            $guardian->isComplete = 'Yes';

            $guardian->save();

        }


        /*$requireDocument = DocumentCourse::where([['document_course_status', 1], ['course_id', \request('courseId')]])->get();

        foreach ($requireDocument as $reqDocs) {
            $docInfo = $reqDocs->document;
            if ($reqDocs->option == 'Mandatory') {
                $request->validate(["$docInfo->doc_name" => 'required|mimes:pdf,jpg,png,jpeg',]);
            } else {
                $request->validate(["$docInfo->doc_name" => 'nullable|mimes:pdf,jpg,png,jpeg',]);
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

        }*/

        return response()->json($candidate_details->candidate_id);

    }

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

}
