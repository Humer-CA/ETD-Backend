<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleManagementController;
use App\Http\Controllers\LoginController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::resource("user", UserController::class);
Route::resource("role-management", RoleManagementController::class);
Route::post("login", [LoginController::class, "login"]);
// Route::get("/login", [UserController::class, "index"]);
// Route::post("/register", [UserController::class, "store"]);
// Route::put("/updateUser/{id}", [UserController::class, "update"]);