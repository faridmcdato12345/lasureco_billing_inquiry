<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserChangePassUpdateRequest;

class UserChangePassword extends Controller
{
    public function changePassword(UserChangePassUpdateRequest $request)
    {
        $user = User::findOrFail($request->user_id);
        if(!Hash::check($request->password, $user->password)){
            return response()->json(['message'=>'Current password is incorrect!'],401);
        }
        $user->password = $request->new_password;
        $user->save();
        return response()->json($user,200);
    }
}
