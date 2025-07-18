<?php

use App\Http\Controllers\ImageController;
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

Route::post('/register', 'App\Http\Controllers\UserCon@register');
Route::get('/memberlist', 'App\Http\Controllers\UserCon@userlist');
Route::post('/login', 'App\Http\Controllers\UserCon@login');
Route::get('/logout', 'App\Http\Controllers\UserCon@logout');
Route::post('member', 'App\Http\Controllers\UserCon@member');
Route::get('/listadmins', 'App\Http\Controllers\UserCon@listAdmins');
Route::post('/member_register', 'App\Http\Controllers\UserCon@member_register');
Route::post('mlogin', 'App\Http\Controllers\UserCon@mlogin');
Route::post('banks_tranfers', 'App\Http\Controllers\UserCon@bank_tranfers');
Route::post('aclida', 'App\Http\Controllers\UserCon@aclida');
Route::post('princebank', 'App\Http\Controllers\UserCon@princebank');
Route::post('phli', 'App\Http\Controllers\UserCon@phli');
Route::post('canadi', 'App\Http\Controllers\UserCon@canadi');
Route::post('updated_members', 'App\Http\Controllers\UserCon@update_members');
Route::get('paymentscom', 'App\Http\Controllers\UserCon@paymentscom');
Route::post('ppc_tranfers', 'App\Http\Controllers\UserCon@ppc_tranfers');
Route::post('bankofamericar_tranfers', 'App\Http\Controllers\UserCon@bankofamericar_tranfers');
Route::get('bank', 'App\Http\Controllers\UsersController@index');
Route::get('/accountstatement', 'App\Http\Controllers\UsersController@accountstatement');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('postimage', [ImageController::class, 'postImageProfile']);
Route::get('getimageurl/{id}', [ImageController::class, 'getImageUrl']);
