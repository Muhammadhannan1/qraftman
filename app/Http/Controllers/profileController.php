<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Profile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Response;
class profileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if (Auth::guard('api')->check()) {
            $userId = Auth::guard('api')->user()->id;
            $validator = Validator::make($request->all(),[
                'companyName'=>['required'],
                // 'image'=>['required'],
                // 'organizationNum'=>['required'],
                // 'website'=>['required'],
                // 'companyDescription'=>['required'],
                // 'country'=>['required'],
                // 'city'=>['required'],
                // 'postaddress'=>['required'],
                // 'streetaddress'=>['required'],
                // 'zipcode'=>['required'],
                // 'number'=>['required'],

            ]);
            if($validator->fails()){
                return response()->json($validator->messages(),400);
            }
            else{
                $check_user_profile = Profile::where('userId',$userId)->exists();
                if ($check_user_profile) {
                    return response()->json(['message'=>'You have already created profile','success'=>false],404);
                }
                else {

                $data=[
                    'userId'=>$userId,
                    'companyName'=>$request->companyName,
                    'image'=>$request->image,
                    'organizationNum'=>$request->organizationNum,
                    'website'=>$request->website,
                    'companyDescription'=>$request->companyDescription,
                    'country'=>$request->country,
                    'city'=>$request->city,
                    'postaddress'=>$request->postaddress,
                    'streetaddress'=>$request->streetaddress,
                    'zipcode'=>$request->zipcode,
                    'number'=>$request->number,
                ];

                DB::beginTransaction();
                try {
                    $profile = Profile::create($data);
                    DB::commit();
                } catch (\Exception $e) {
                    echo $e;
                    DB::rollback();
                    $profile = null;
                }
                if ($profile!=null) {
                    return response()->json(
                        ['message'=>'Profile created successfully','success'=>true],200
                    );
                }
                else{
                    return response()->json([

                         'message'=>'Internal server error','success'=>false
                    ],500);
                }

            }}

        } else {
             return response()->json(['message'=>'Cant access Login first'], 401 );
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
