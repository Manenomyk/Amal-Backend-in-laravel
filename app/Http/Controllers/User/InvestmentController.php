<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Capital;
use App\Models\Investment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvestmentController extends Controller
{
    public function store(Request $request,$id){
        DB::beginTransaction();
        $validated=$request->validate([
            'amount'=>'required',
            'agree'=>'required',
        ]);
        $user=User::where('id',$id)->first();
        $capital=Capital::where('user_id',$user->id)->first();
        $invest=new Investment();

        if($request->equity!=null){
            $invest->equity=$request->equity;
        }
        if($request->debt!=null){
            $invest->debt=$request->debt;
        }
        if($request->revenue_share!=null){
            $invest->revenue_share=$request->revenue_share;
        }
        $invest->person=$request->boolean('person');
        $invest->entity=$request->boolean('entity');

        $invest->agree=$request->agree;
        $invest->amount=$request->amount;
        $invest->user_id=$user->id;
        try {
            $invest->save();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                $th
            ]);
        }
        try {
            $balance=$capital->amount-$request->amount;
            $capital->amount=$balance;
            if ($balance<0) {
                return response()->json([
                    "error"=>"You have less balance"
                ]);
            }
            $capital->save();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                $th
            ]);
        }

        DB::commit();
       
            return response()->json([
                'message'=>"You have invested successfully $request->amount"
            ]);
       
    }
}
