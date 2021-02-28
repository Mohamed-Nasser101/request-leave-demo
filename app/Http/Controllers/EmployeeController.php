<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function show(){
        $user = User::findOrFail(auth()->user()->id);
        return view('employee',[
            'user' => $user
        ]);
    }
}
