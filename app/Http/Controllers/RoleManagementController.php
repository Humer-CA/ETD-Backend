<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleManagement;

class RoleManagementController extends Controller
{
    //

    public function index() {
        $roles = RoleManagement::all();
        return $roles;
    }

    public function store(Request $request) {
        $access_permissions = implode(",", $request->access_permission);

        $userCredentials = RoleManagement::create([
            'role_name' => $request->role_name,
            'access_permission' => $access_permissions,
            'is_active' => 1,
            
        ]);
        return $userCredentials;
    }
}
