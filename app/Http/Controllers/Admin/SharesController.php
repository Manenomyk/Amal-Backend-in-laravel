<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Share;
use App\Models\User;
use Illuminate\Http\Request;

class SharesController extends Controller
{
    public function index(){
        $share=Share::all();
        return response()->json([
            'share'=>$share
        ]);
    }
    public function one($id){
        $share=Share::where('id',$id)->first();
        return response()->json([
            'share'=>$share
        ]);
    }
    public function store(Request $request,$id){
        $validated=$request->validate([
            'company_name'=>'required',
            'sector'=>'required',
            'total_shares'=>'required',
            'share_prices'=>'required',
            'share_on_offer'=>'required',
            'max_shares_to_buy'=>'required',
            'min_shares_to_buy'=>'required',
        ]);
        $user=User::where('id',$id)->first();
        $share=new Share();
        $share->company_name=$request->company_name;
        $share->sector=$request->sector;
        $share->total_shares=$request->total_shares;
        $share->share_prices=$request->share_prices;
        $share->share_on_offer=$request->share_on_offer;
        $share->max_shares_to_buy=$request->max_shares_to_buy;
        $share->min_shares_to_buy=$request->min_shares_to_buy;
        $share->user_id=$user->id;
        if($share->save()){
            return response()->json([
                'message'=>"share created successfully"
            ]);
        }
    }
    public function update(Request $request,$id){
        $validated=$request->validate([
            'company_name'=>'required',
            'sector'=>'required',
            'total_shares'=>'required',
            'share_prices'=>'required',
            'share_on_offer'=>'required',
            'max_shares_to_buy'=>'required',
            'min_shares_to_buy'=>'required',
        ]);
       
        $share=Share::where('id',$id)->first();
        $share->company_name=$request->company_name;
        $share->sector=$request->sector;
        $share->total_shares=$request->total_shares;
        $share->share_prices=$request->share_prices;
        $share->share_on_offer=$request->share_on_offer;
        $share->max_shares_to_buy=$request->max_shares_to_buy;
        $share->min_shares_to_buy=$request->min_shares_to_buy;

        if($share->save()){
            return response()->json([
                'message'=>"share updated successfully"
            ]);
        }
    }
    public function destroy($id){
        $share=Share::where('id',$id)->first();
        $share->delete();
    }
}
