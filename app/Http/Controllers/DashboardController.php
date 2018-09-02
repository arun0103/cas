<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;

use App\Company;
use App\Employee;
use App\Punch;
use App\Student;
use App\Student_Punch;

class DashboardController extends Controller
{
    // Function to send refreshed contents of dashboard of company type = insititute
    public function getNewDashboardContents_institute(){
        $institution_id = Session::get('company_id');
        $totalEmployees = Employee::where('company_id',$institution_id)->count();
        $presentEmployees = Punch::where([['company_id',$institution_id],['punch_date',Carbon::today()]])->get();
        $lateEmployees = 0;
        if(count($presentEmployees)>0){
            foreach($presentEmployees as $emp){
                if($emp->late_in >0 && $emp->late_in != null){
                    $lateEmployees++;
                }
            }
        }
        $employeeDetails = [
            'total'=>$totalEmployees, 
            'present'=>count($presentEmployees), 
            'late'=>$lateEmployees
        ];
        
        $totalStudents = Student::where('institution_id',$institution_id)->count();
        $presentStudents = Student_Punch::where([['institution_id',$institution_id],['punch_date',Carbon::today()]])->get();
        $lateStudents = 0;
        $studentDetails = [
            'total'=>$totalStudents,
            'present'=>count($presentStudents),
            'late'=>$lateStudents
        ];
        $dataToSend = [
            'employee'=>$employeeDetails,
            'student'=>$studentDetails
        ];

        return response()->json($dataToSend);
    }
    // Function to send refreshed contents of dashboard of company type = business
    public function getNewDashboardContents_business(){
        $company_id = Session::get('company_id');
        $totalEmployees = Employee::where('company_id',$company_id)->count();
        $presentEmployees = Punch::where([['company_id',$company_id],['punch_date',Carbon::today()]])->get();
        $lateEmployees = 0;
        if(count($presentEmployees)>0){
            foreach($presentEmployees as $emp){
                if($emp->late_in >0 && $emp->late_in != null){
                    $lateEmployees++;
                }
            }
        }
        $employeeDetails = [
            'total'=>$totalEmployees, 
            'present'=>count($presentEmployees), 
            'late'=>$lateEmployees
        ];
        return response()->json($employeeDetails);
    }
}
