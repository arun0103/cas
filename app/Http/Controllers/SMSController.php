<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SMSController extends Controller
{
    public function postDeliveryStatus(Request $requests){
        foreach($requests->data as $req){
            $newReport = SMSReport::create($req->input());
        }
    }
}
