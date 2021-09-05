<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    //
    public function changePassword(Request $request){
        $userId = Auth::User()->id;
        $user = User::find($userId);
        $errors = [];
        if(Hash::check($request->old_password,$user->password)){
            if($request->new_password1==$request->new_password2){
                $user->password = Hash::make($request->new_password1);
                $user->update();
                Session::flash('success','Successfully Changed.');
                return redirect()->back();
            }
            else{
                array_push($errors,"Please Enter Same New Password");
            }
        }else{
            array_push($errors,"Your Old Password didn't Matched.");
        }
        Session::flash('validationErrors',$errors);
        return redirect()->back();
    }
}
