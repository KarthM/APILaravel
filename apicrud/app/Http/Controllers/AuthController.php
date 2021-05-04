<?php

namespace App\Http\Controllers;
//use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
   public function register(Request $request)

  {
         $validator=Validator::make($request->all(),[
    'name'=>'required',
 'email'=>'required|email',
 'password'=>'required'


        ]);

        if($validator->fails())
        {
             return response()->json(['status_code'=>400,'message'=>'Bad request']);
         }      
           $user=new User();
        $user->name= $request->name;

         $user->email= $request->email;
         $user->password= bcrypt($request->password);
         $user->save();
    
     return response()->json(['status_Code'=>200,'message' =>' user created successful']);

     }

     public function login(Request $request)   
       {
         $validator=validator::make($request->all(),[
             'email'=>'required|email',
            'password'=>'required'

        ]);

         if($validator->fails())
         {
             return response()->json(['status_code'=>400,'message' =>'Bad request']);
         }

         
     $user= User::where('email', $request->email)->first();

                    if (!$user || !Hash::check($request->password, $user->password)) {
                        return response([
                            'message' => ['These credentials do not match our records.']
                        ], 404);
                    }
                
                     $token = $user->createToken('my-app-token')->plainTextToken;
                
                    $response = [
                        'user' => $user,
                        'token' => $token
                    ];
                
                     return response($response, 201);


     
 }

 Public function logout(Request $request)
 {
    $request->user()->currentAccessToken()->delete();

    return response()->json(['status_Code'=>200,'message' =>'Token deleted']);
}

  

 }