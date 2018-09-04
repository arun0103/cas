<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;

use App\Student;
use App\Student_Grade;
use App\Student_Section;
use App\Student_Punch;

class StudentDashboardController extends Controller
{
    public function getTotalStudents(){
        $institution_id = Session::get('company_id');
        $allStudents = Student::where('institution_id',$institution_id)->with('grade','section')->get();//->with(['punches'=> function ($query) {
        //     $query->where('punch_date',Carbon::today('Y-m-d')->first())->get();
        // }]);
        return response()->json($allStudents);
    }
    public function getAbsentStudents(){
        $institution_id = Session::get('company_id');
        $presentStudents = Student::where('institution_id',$institution_id)->with('grade','section')->with(['punches'=> function ($query) {
             $query->where('punch_date',Carbon::today('Y-m-d')->first())->get();
        }]);
        //$absentStudents = Student::where('institution_id',$institution_id)->whereNotIn('student_id',$presentStudents->student_id)->with('grade','section')->get();
        return response()->json($presentStudents);
    }
}
