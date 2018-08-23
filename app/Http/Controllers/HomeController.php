<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Employee;
use App\Punch;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   if(Auth::check()){
            $loggedInUser = Auth::user();
            session(['user_id' => $loggedInUser->id]);
            session(['company_id' => $loggedInUser->company_id]);
            session(['role' => $loggedInUser->role]);
            session(['user_name' =>$loggedInUser->name]);

            if($loggedInUser->role =='admin'){
                //dd($loggedInUser);
                $totalEmployees = Employee::where('company_id',$loggedInUser->company_id)->count();
                $presentEmployees = Punch::where([['company_id',$loggedInUser->company_id],['punch_date',Carbon::today()]])->get();
                $lateEmployees = 0;
                if(count($presentEmployees)>0)
                foreach($presentEmployees as $emp){
                    if($emp->late_in >0 && $emp->late_in != null){
                        $lateEmployees++;
                    }
                }
                return view('pages/admin/dashboard',['total'=>$totalEmployees, 'present'=>count($presentEmployees), 'late'=>$lateEmployees]);
            }
            return view('home');
        }
        else{
            return view('/login');
        }
    }
}
