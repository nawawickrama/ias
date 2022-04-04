<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Student;
use App\Models\StudentAddress;
use App\Models\StudentGuardian;
use Illuminate\Http\Request;
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
        return view('student.wizard.wizard')->with(['countries' => $countries]);
    }

    public function studentWizardPost(Request $request)
    {
        //student Details
        DB::transaction(function () use($request){
            $student_info = Student::create($request->all());
            $request['student_id'] = $student_info->student_id;
            StudentGuardian::create($request->all());
            StudentAddress::create($request->all());
        });
    }
}
