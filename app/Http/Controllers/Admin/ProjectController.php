<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){
        $project=Project::all();
        return response()->json([
            'project'=>$project
        ]);
    }
    public function one($id){
        $project=Project::where('id',$id)->first();
        return response()->json([
            'project'=>$project
        ]);
    }
    public function store(Request $request,$id){
        $validated=$request->validate([
            'project_name'=>'required',
            'project_sector'=>'required',
            'goal_amount'=>'required',
            'max_investment'=>'required',
            'stake'=>'required',
            'opening_date'=>'required',
            'closing_date'=>'required',
        ]);
        $user=User::where('id',$id)->first();
        $project=new Project();
        $project->project_name=$request->project_name;
        $project->project_sector=$request->project_sector;
        $project->goal_amount=$request->goal_amount;
        $project->max_investment=$request->max_investment;
        $project->stake=$request->stake;
        $project->opening_date=$request->opening_date;
        $project->closing_date=$request->closing_date;
        $project->user_id=$user->id;
        if($project->save()){
            return response()->json([
                'message'=>"Project created successfully"
            ]);
        }
    }
    public function update(Request $request,$id){
        $validated=$request->validate([
            'project_name'=>'required',
            'project_sector'=>'required',
            'goal_amount'=>'required',
            'max_investment'=>'required',
            'stake'=>'required',
            'opening_date'=>'required',
            'closing_date'=>'required',
        ]);
        $project=Project::where('id',$id)->first();
        $project->project_name=$request->project_name;
        $project->project_sector=$request->project_sector;
        $project->goal_amount=$request->goal_amount;
        $project->max_investment=$request->max_investment;
        $project->stake=$request->stake;
        $project->opening_date=$request->opening_date;
        $project->closing_date=$request->closing_date;
        if($project->save()){
            return response()->json([
                'message'=>"Project Updated successfully"
            ]);
        }
    }
    public function destroy($id){
        $project=Project::where('id',$id)->first();
        $project->delete();
    }
}
