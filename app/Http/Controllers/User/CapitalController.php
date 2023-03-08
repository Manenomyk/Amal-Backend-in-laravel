<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Capital;
use App\Models\User;
use Illuminate\Http\Request;

class CapitalController extends Controller
{
    public function index($id){
        $capital=Capital::where('id',$id)->get();
        return response()->json([
            'capitals'=>$capital
        ]);
    }
    public function store(Request $request,$id){
        $validated=$request->validate([
            'first_name'=>'required',
            'middle_name'=>'required',
            'last_name'=>'required',
            'id_number'=>'required',
            'phone_number'=>'required',
            'email'=>'required',
            'entity_name'=>'required',
            'director_name'=>'required',
            'location'=>'required',
            'entity_id_number'=>'required',
            'entity_phone_number'=>'required',
            'entity_email'=>'required',
            'amount'=>'required',
        ]);
        $user=User::where('id',$id)->first();
        // $capital=Capital::where('user_id',$user->id)->get();
        // if ($capital) {
        //     # code...
        // }
        $capital=new Capital();
        $capital->first_name=$request->first_name;
        $capital->middle_name=$request->middle_name;
        $capital->last_name=$request->last_name;
        $capital->id_number=$request->id_number;
        $capital->phone_number=$request->phone_number;
        $capital->email=$request->email;
        $capital->entity_name=$request->entity_name;
        $capital->director_name=$request->director_name;
        $capital->location=$request->location;
        $capital->entity_id_number=$request->entity_id_number;
        $capital->entity_phone_number=$request->entity_phone_number;
        $capital->entity_email=$request->entity_email;
        $capital->amount=$request->amount;
        $capital->user_id=$user->id;
        if($capital->save()){
            return response()->json([
                'message'=>"Capital Raised successfully"
            ]);
        }
    }
}
