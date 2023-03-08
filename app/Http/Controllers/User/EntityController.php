<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Entity;
use App\Models\User;
use Illuminate\Http\Request;

class EntityController extends Controller
{
    public function index(){
        $entity=Entity::all();
        return response()->json([
            'entity'=>$entity
        ]);
    }
    public function store(Request $request,$id){
        $validated=$request->validate([
            'director_name'=>'required',
            'email'=>'required|email',
            'entity_name'=>'required',
            'entity_address'=>'required',
            'entity_phone'=>'required',
            'entity_sector'=>'required',
            'entity_kra'=>'required',
            'entity_reg'=>'required',
        ]);
        $user=User::where('id',$id)->first();

        $entity= new Entity();
        $entity->director_name=$request->director_name;
        $entity->email=$request->email;
        $entity->entity_name=$request->entity_name;
        $entity->entity_address=$request->entity_address;
        $entity->entity_phone=$request->entity_phone;
        $entity->entity_sector=$request->entity_sector;
        $entity->entity_kra=$request->entity_kra;
        $entity->entity_reg=$request->entity_reg;
        $entity->user_id=$user->id;

        if($entity->save()){
            return response()->json([
                "message"=>"Entity created successfully"
            ],200);
        }
    }
}
