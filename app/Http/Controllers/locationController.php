<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Response;
class locationController extends Controller
{
    public function createCountry(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>['required'],
        ]);
        if($validator->fails()){
            return response()->json($validator->messages(),400);
        }
        else{
            $data=[
                'name'=>$request->name,
            ];
            DB::beginTransaction();
            try {
                $Country = Country::create($data);
                DB::commit();
            } catch (\Exception $e) {
                echo $e;
                DB::rollback();
                $Country = null;
            }
            if ($Country!=null) {
                return response()->json(
                    ['message'=>'Country Created Successfully','success'=>true],200
                );
            }
            else{
                return response()->json([
                     'message'=>'Internal server error','success'=>false
                ],500);
            }
    }
    }



    public function createState(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>['required'],
        ]);
        if($validator->fails()){
            return response()->json($validator->messages(),400);
        }
        else{
            $country_name = $request->country;
            $country_id = Country::where('name',$country_name)->value('id');
            $data=[
                'name'=>$request->name,
                'countryId'=>$country_id
            ];
            DB::beginTransaction();
            try {
                $State = State::create($data);
                DB::commit();
            } catch (\Exception $e) {
                echo $e;
                DB::rollback();
                $State = null;
            }
            if ($State!=null) {
                return response()->json(
                    ['message'=>'State Created Successfully','success'=>true],200
                );
            }
            else{
                return response()->json([
                     'message'=>'Internal server error','success'=>false
                ],500);
            }
    }
    }

    public function createCity(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>['required'],
        ]);
        if($validator->fails()){
            return response()->json($validator->messages(),400);
        }
        else{
            $country_name = $request->country;
            $country_id = Country::where('name',$country_name)->value('id');
            $state_name = $request->state;
            $state_id = State::where('name',$state_name)->value('id');
            $data=[
                'name'=>$request->name,
                'countryId'=>$country_id,
                'stateId'=>$state_id
            ];
            DB::beginTransaction();
            try {
                $City = City::create($data);
                DB::commit();
            } catch (\Exception $e) {
                echo $e;
                DB::rollback();
                $City = null;
            }
            if ($City!=null) {
                return response()->json(
                    ['message'=>'City Created Successfully','success'=>true],200
                );
            }
            else{
                return response()->json([
                     'message'=>'Internal server error','success'=>false
                ],500);
            }
    }
    }

}
