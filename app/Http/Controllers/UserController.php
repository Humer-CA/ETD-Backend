<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    // public function index() {
    //     return User::paginate(5);
    // }

    public function index(Request $request) {
        $perPage = $request->perPage;
        $search = $request->search;
        return User::with("role")->where("username", "LIKE", "%{$search}%")->orWhere("id", $search)->paginate($perPage);
    }

    public function store(Request $request) {
        $request->all(); 
        $userCredentials = User::create([
            'username' => $request->username,
            'password' => Crypt::encryptString($request->password),
            'role_id' => $request->role_id,
            
        ]);
        return response()->json([
            "message" => "User created successfully",
            "data" => $userCredentials
        ]);
    }

    public function update(Request $request, $id) {
        $request->all(); 
        $userCredentials = User::update([
            'username' => $request->username,
            'password' => Crypt::encryptString($request->password),
        ]);
        return $userCredentials;
    }
}
