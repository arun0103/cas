<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Holiday;
use Session;
use Response;

class HolidayController extends Controller
{
    public function getHolidays(){
        $holidays = Holiday::where('company_id', Session::get('company_id'))->get();
        $dataToSend = [];
        $index = 0;
        foreach($holidays as $holiday){
            $data = [
                'id'=>$holiday->id,
                'title'=> $holiday->holiday_description,
                'start'=> $holiday->holiday_date,
                'end'=> $holiday->holiday_date,
                'allDay'=> 1,
                'color'=>'red'
            ];
            $dataToSend[$index]=$data;
            $index++;

        }
        return response()->json($dataToSend);
    }

    public function addHoliday(Request $request){
        $new = new Holiday([
            'holiday_description'=>$request->holiday_description,
            'holiday_date'=>$request->holiday_date,
            'company_id'=>$request->company_id,
            'branch_id'=>$request->branch_id
        ]);
        $new->save();
        $data = [
            'id'=>$new->id,
                'title'=> $new->holiday_description,
                'start'=> $new->holiday_date,
                'end'=> $new->holiday_date,
                'allDay'=> 1,
                'color'=>'red',
                'description'=>"holiday",
                'editable'=>true,
                'clickable'=>true
                
        ];
        return response()->json($data);
    }
    public function deleteHoliday($id){
        $del = Holiday::where('id',$id)->delete();
        return response()->json($del);
    }
}
