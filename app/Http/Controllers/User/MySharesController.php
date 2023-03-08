<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\MyShare;
use App\Models\Share;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MySharesController extends Controller
{
    public function store(Request $request,$id){
        DB::beginTransaction();
        $validated=$request->validate([
            'amount'=>'required',
            'shares'=>'required',
            'agree'=>'required',
        ]);
        $user=User::where('id',$id)->first();
        $share=new MyShare();
        $shares=Share::first();
       
        $share->person=$request->boolean('person');
        $share->entity=$request->boolean('entity');

        $share->agree=$request->agree;
        $share->amount=$request->amount;
        $share->shares=$request->shares;
        $share->user_id=$user->id;
        try {
            $share->save();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                $th
            ]);
        }
        try {
            $balance=$shares->total_shares-$request->amount;
            $shares->total_shares=$balance;
            if ($balance<0) {
                return response()->json([
                    "error"=>"You have less balance"
                ]);
            }
            $shares->save();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                "error here"=>$th
            ]);
        }

        DB::commit();
       
            return response()->json([
                'message'=>"You have bought $request->amount shares"
            ]);
       
    }
}
