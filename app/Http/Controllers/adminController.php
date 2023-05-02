<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Posttype;
use App\Models\Group;
use App\Models\Service;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Response;
use Illuminate\Support\Facades\Hash;
class adminController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>['required'],
            'email'=>['required','email','unique:users,email'],
            'password'=>['required','min:4',],

        ]);
        if($validator->fails()){
            return response()->json($validator->messages(),400);
        }
        else{
            $data=[
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'role'=>'admin',

            ];
            DB::beginTransaction();
            try {
                $user = User::create($data);
                $token= $user->createToken("auth_token")->accessToken;
                DB::commit();
            } catch (\Exception $e) {
                echo $e;
                DB::rollback();
                $user = null;
            }
            if ($user!=null) {
                return response()->json(
                    ['message'=>'User registered Successfully','token'=>$token,'success'=>true],200
                );
            }
            else{
                return response()->json([

                     'message'=>'Internal server error','success'=>false
                ],500);
            }
        }
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


    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email'=>['required','email'],
            'password'=>['required'],
        ]);
        if($validator->fails()){
            return response()->json($validator->messages(),400);
        }
        else{
            $data=[
                'email'=>$request->email,
                'password'=>$request->password
            ];
            try {
                $user = User::where('email', $data['email'])->first();
                if (!$user || !Hash::check($data['password'], $user->password)) {
                    return response()->json(['message'=>'Invalid credentials','success'=>false ],401);
                }
                $token = $user->createToken("auth_token")->accessToken;
                return response()->json(['message'=>'Logged in Successfully','token'=>$token,'user'=>$user],200);

            }
            catch (\Exception $e) {
                echo $e;
                return response()->json(['messgae'=>'Internal Server Error','success'=>false ],500);
            }
        }

    }



    public function registerCompany(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>['required'],
            'email'=>['required','email','unique:users,email'],
            'password'=>['required','min:4',],

        ]);
        if($validator->fails()){
            return response()->json($validator->messages(),400);
        }
        else{
            $data=[
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'role'=>'company',

            ];
            DB::beginTransaction();
            try {
                $user = User::create($data);
                $token= $user->createToken("auth_token")->accessToken;
                DB::commit();
            } catch (\Exception $e) {
                echo $e;
                DB::rollback();
                $user = null;
            }
            if ($user!=null) {
                return response()->json(
                    ['message'=>'User registered Successfully','token'=>$token,'success'=>true],200
                );
            }
            else{
                return response()->json([

                     'message'=>'Internal server error','success'=>false
                ],500);
            }
        }
    }



    public function createPostType(Request $request)
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
                $postType = Posttype::create($data);
                DB::commit();
            } catch (\Exception $e) {
                echo $e;
                DB::rollback();
                $postType = null;
            }
            if ($postType!=null) {
                return response()->json(
                    ['message'=>'Post Created Successfully','success'=>true],200
                );
            }
            else{
                return response()->json([
                     'message'=>'Internal server error','success'=>false
                ],500);
            }
    }
}
    public function createGroup(Request $request)
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
                $Group = Group::create($data);
                DB::commit();
            } catch (\Exception $e) {
                echo $e;
                DB::rollback();
                $Group = null;
            }
            if ($Group!=null) {
                return response()->json(
                    ['message'=>'Group Created Successfully','success'=>true],200
                );
            }
            else{
                return response()->json([
                     'message'=>'Internal server error','success'=>false
                ],500);
            }
    }
}





public function createServices(Request $request)
{
    $validator = Validator::make($request->all(),[
        'name'=>['required'],
    ]);
    if($validator->fails()){
        return response()->json($validator->messages(),400);
    }
    else{
        $group_name = $request->group;
        $group_id = Group::where('name',$group_name)->value('id');
        $data=[
            'name'=>$request->name,
            'groupId'=>$group_id
        ];
        DB::beginTransaction();
        try {
            $Services = Service::create($data);
            DB::commit();
        } catch (\Exception $e) {
            echo $e;
            DB::rollback();
            $Services = null;
        }
        if ($Services!=null) {
            return response()->json(
                ['message'=>'Services Created Successfully','success'=>true],200
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
