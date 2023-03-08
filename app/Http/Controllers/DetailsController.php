<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DetailsController extends Controller
{
    public function details($id){
        $user=User::where('id',$id)->first();
        return response()->json([
            'user'=>$user
        ]);
    }

    public function update(Request $request, $id){
        $validated=$request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'phone_number'=>'required',
            'location'=>'required',
            'id_number'=>'required',
        ]);
        $user=User::where('id',$id)->first();
        
        $user->name=$request->name;
        $user->email=$request->email;
        $user->phone_number=$request->phone_number;
        $user->location=$request->location;
        $user->id_number=$request->id_number;
        if($user->update()){
            return response()->json([
                'message'=>"$user->name updated successfully"
            ]);
        }
       
    }

    
}
