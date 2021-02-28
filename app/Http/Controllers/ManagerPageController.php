<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leave;

class ManagerPageController extends Controller
{
    public function show(){
        $pendingLeaveCount = Leave::where('status_id',3)->count();
        return view('dashboard',[
           'pendingLeaveCount' => $pendingLeaveCount 
        ]);
    }
}
