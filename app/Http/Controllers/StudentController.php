<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Country;
use App\Models\Course;
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

    public function studentWizard()
    {
        $countries = Country::all();
        $candidateDetails = User::find(Auth::user()->id)->candidate;
        $courses = Course::where('course_status', '1')->get();
        return view('student.wizard.wizard')->with(['countries' => $countries, 'courses' => $courses, 'candidateDetails' => $candidateDetails]);
    }

    public function studentWizardPost(Request $request)
    {
        //student Details

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

        $potentialDetails = Potential::where('potential_status', '1')->get();
        return view('admin.potential.potential-students')->with(['potentialDetails' => $potentialDetails]);

    }

}
