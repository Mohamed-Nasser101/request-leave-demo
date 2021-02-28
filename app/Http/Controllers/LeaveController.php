<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LeaveRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\RequestLeave;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pendingLeaves = Leave::where('status_id',3)->with('user')->with('type')->get();
        //dd($pendingLeaves);
        return view('leaves.index',[
            'pendingLeaves' => $pendingLeaves
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        $type = LeaveType::all();
        $otherUsers = User::all()->except($user->id);
        return view('leaves.request-form',[
            'type' => $type,
            'otherUsers' =>$otherUsers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LeaveRequest $request ,User $user)
    {
        $leave = Leave::create([
            'user_id' => $user->id,
            'from' => $request->from,
            'to' => $request->to,
            'description' => $request->description,
            'type_id' => $request->type,
            'status_id' => 3,
        ]);

        //Mail::to(User::find(1)->email)->send(new RequestLeave($leave));

        return redirect()->route('user')->withSuccess('leave sent to the manager wait for reply');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leave $leave)
    {
        if($request->input('submit') == 'approve'){
            $leave->status_id = 1;
            $leave->save();
            return redirect()->back()->withSuccess('leave approved');
        }else{
            $leave->status_id = 2;
            $leave->save();
            return redirect()->back()->withSuccess('leave refused');
        }
    }
}
