<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CheckUserPassword extends Controller
{
    public function checkCurrentPassword(Request $request){
        $user = User::findOrFail($request->user_id);
        if(!Hash::check($request->password, $user->password)){
            return response()->json(['message'=>'Current password is incorrect!'],401);
        }
        return response()->json(['message'=>'User Found'],200);
    }
}
