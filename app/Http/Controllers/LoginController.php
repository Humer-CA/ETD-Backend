<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

class LoginController extends Controller
{
    //
    public function login(Request $request) {
       

        $user = User::where("username", $request->username)->first();
        if (!$user) {
            return response()->json([
                "message" => "Invalid Credentials"
            ], 422);
        } 
        
        $pass_decrypt = Crypt::decryptString($user->password);
        if ($request->password !== $pass_decrypt) {
            return response()->json([
              "message" => "Invalid Credentials"
            ], 422);
        }

        $token = $user->createToken("userToken")->plainTextToken;
        $cookie = cookie("userCookie", $token);
            
        return response()->json([
            "message" => "Successfully Logged In",
            "data" => $user,
            "token"=>$token
        ], 200)->withCookie($cookie);
        
    }
}
