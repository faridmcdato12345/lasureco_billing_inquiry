<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function updateUser(Request $request){   
        $data = User::where('id',Auth::user()->id)
        ->update([
            'name'=>$request->full_name,
            'account_no' => $request->account_no
        ]);
        return response()->json($data,200);
    }
    public function checkUserFullName(Request $request){
        $response = Http::post('http://222.127.146.254/api/v1/consumer/full_name', [
            'cm_full_name' => $request->full_name,
        ]);
        if($response->failed()){
            return response()->json(['message' => 'Inputted data is not a member consumer!'],404);
        }else{
            return response()->json($response->json(),200);
        }
    }
    public function checkUserAccount(Request $request){
        $response = Http::post('http://222.127.146.254/api/v1/consumer/account_no', [
            'cm_account_no' => $request->account_no,
        ]);
        if($response->failed()){
            return response()->json(['message' => 'Account number doesnt exist!'],404);
        }else{
            return response()->json($response,200);
        }
    }

    public function checkConsumerInputValidation(Request $request){
        $response = Http::post('http://222.127.146.254/api/v1/consumer/input_validation',[
            'cm_full_name' => $request->full_name,
            'cm_account_no' => $request->account_no,
        ]);
        if($response->failed()){
            return response()->json(['message' => 'Error!'],404);
        }
        if($response->serverError()){
            return response()->json(['message' => 'Server connection error!'],500);
        }
        else{
            return response()->json($response,200);
        }
    }

    public function showUser(Request $request){
        $user = User::where('id',$request->user_id)->first();
        return response()->json($user,200);
    }

    public function powerbillInquiry(Request $request){
        $billPeriod = str_replace("-","",$request->mr_bill_date);
        $response = Http::post('http://222.127.146.254/api/v1/inquiry/power_bill', [
            'bill_period' => $billPeriod ,
            'account_no' => $request->mr_account_no
        ]);
        
        if($response->failed()){
            return response()->json($response,404);
        }
        if($response->serverError()){
            return response()->json(['message' => 'Server connection error!'],500);
        }
        return response()->json($response->json(),200);
    }

    public function checkUserAccountInfo(Request $request){
        $user = User::where('id',$request->id)->whereNotNull('name')->whereNotNull('account_no')->get();
        if($user->isEmpty()){
            return response()->json(['message' => 'Error'],404);
        }
        return response()->json($user,200);
    }
    public function getTotalArrears(Request $request){
        $response = Http::post('http://222.127.146.254/api/v1/consumer/arrears', [
            'account_no' => $request->mr_account_no
        ]);
        if($response->failed()){
            return response()->json($response,404);
        }
        if($response->serverError()){
            return response()->json(['message' => 'Server connection error!'],500);
        }
        return response()->json($response->json(),200);
    }
}
