<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SharesController;
use App\Http\Controllers\Admin\UserManageController;
use App\Http\Controllers\DetailsController;
use App\Http\Controllers\User\CapitalController;
use App\Http\Controllers\User\EntityController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\InvestmentController;
use App\Http\Controllers\User\MySharesController;
use App\Http\Controllers\User\UserProjectController;
use App\Http\Controllers\User\UserSharesController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(UserController::class)->group(function(){
    Route::post('register','register');
    Route::post('login','login');
    Route::post('logout','logout');
});

Route::controller(DetailsController::class)->group(function(){
    Route::get('user/details/{id}','details');
    Route::post('user/update/{id}','update');
});

//admin
Route::controller(ProjectController::class)->group(function(){
    Route::get('admin/projects/get','index');
    Route::get('admin/project/{id}','one');
    Route::post('admin/projects/add/{id}','store');
    Route::post('admin/projects/update/{id}','update');
    Route::post('admin/projects/remove/{id}','destroy');
});

Route::controller(SharesController::class)->group(function(){
    Route::get('admin/shares/get','index');
    Route::get('admin/share/{id}','one');
    Route::post('admin/shares/add/{id}','store');
    Route::post('admin/shares/update/{id}','update');
    Route::post('admin/shares/remove/{id}','destroy');
});

Route::controller(DashboardController::class)->group(function(){
    
});

Route::controller(RoleController::class)->group(function(){
    
});

Route::controller(UserManageController::class)->group(function(){
    
});



//user
Route::controller(EntityController::class)->group(function(){
    Route::get('user/entity/get','index');
    Route::post('user/entity/post/{id}','store');
});

Route::controller(CapitalController::class)->group(function(){
    Route::get('user/capital/get','index');
    Route::get('user/capital/{id}','one');
    Route::post('user/capital/raise/{id}','store');
    // Route::post('user/capital/update/{id}','update');
    // Route::post('user/capital/remove/{id}','destroy');
});

Route::controller(HomeController::class)->group(function(){
    
});

Route::controller(InvestmentController::class)->group(function(){
    Route::post('user/invest/{id}','store');
});



Route::controller(MySharesController::class)->group(function(){
    Route::post('user/buy-shares/{id}','store');
});




