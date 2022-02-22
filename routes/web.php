<?php

use App\Http\Controllers\Auth\FacebookController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\CheckUserPassword;
use App\Http\Controllers\UserChangePassword;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/auth/facebook/redirect', [FacebookController::class, 'handleFacebookRedirect'])->name('facebook.redirect');
Route::get('/auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware(['auth'])->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/user/fullname',[UserController::class,'checkUserFullName'])->name('check.user.fullname');
    Route::post('/user/accountno',[UserController::class,'checkUserAccount'])->name('check.user.account_no');
    Route::post('/user/input_validation',[UserController::class,'checkConsumerInputValidation'])->name('check.input.validation');
    Route::post('/user/update',[UserController::class,'updateUser'])->name('update.user');
    Route::post('/user/show',[UserController::class,'showUser'])->name('user.show');
    Route::post('/user/inquiry/powerbill',[UserController::class,'powerbillInquiry'])->name('user.powerbill.inquiry');
    Route::post('/check/user/account',[UserController::class,'checkUserAccountInfo']);
    Route::post('/check/user/password',[CheckUserPassword::class,'checkCurrentPassword']);
    Route::post('/user/change/password',[UserChangePassword::class,'changePassword']);
    Route::post('/user/total_arrears',[UserController::class,'getTotalArrears']);
});

