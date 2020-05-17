<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Builder;
use App\User;
use App\Meeting;
use Auth;
use App\MeetingGroup;
use Illuminate\Support\Facades\DB;

class BaseController extends Controller
{
    //
    public function addMeeting(){
        $parents = User::whereHas('roles',function(Builder $query){
            $query->where('role_id',2);
        })->get();

        return view('frontend.addMeeting',['parents'=>$parents]);


    }

    public function createMeeting(Request $request){

        $validationData = $request->validate([
            'name'=>'required',
            'date'=>'required',
            'parent'=>'required',
        ],[
            'name.required'=>'Please Assing A Meeting Name',
            'date.required'=>'Please Select A Date For Meeting',
            'parent.required'=>'Please Select At Least One Parent For Meeting',
        ]);

        try{
            DB::beginTransaction();
            $meeting = new Meeting();
            $meeting->name = $request->input('name');
            $meeting->user_id = Auth::user()->id;
            $meeting->scheduled_at = date("Y-m-d h:i:s",strtotime($request->input('date')));
            $meeting->save();

            $parentData = [];
            foreach ($request->parent as $parent) {
                $parentData[] = new MeetingGroup(['user_id'=>$parent]);
            }
            $meeting->meeting_groups()->saveMany($parentData);

            DB::commit();

            return redirect(url('/teacherMain/'))->with('status', 'Meeting Added Successfully !');
        }catch(\Exception $e){
            DB::rollback();
            return redirect(url('/addMeeting'))->with('status','Meeting Could Not Be Added Successfully, Please Try Again');
        }
    }

    public function teacherDashboard(){
        $meetings = Meeting::where('user_id',Auth::user()->id)->get();

        return view('frontend.teacher',['meetings'=>$meetings]);
    }

    public function parentDashboard(){
        $meetings = Meeting::whereHas('meeting_groups',function(Builder $query){
                $query->where('user_id',Auth::user()->id);
        })->get();
        return view('frontend.parent',['meetings'=>$meetings]);
    }
}
