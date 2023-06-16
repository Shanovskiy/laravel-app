<?php

namespace App\Http\Controllers;

use App\Mail\Feedback;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{
    public function forgotPassword()
    {
        return view('profile.forgot-password');
    }


    public function passwordUpdate()
    {
        return view('profile.reset-password')->with("recovery_pin",request()->query()["recovery_pin"]);
    }


    public function recoveryPin()
    {
        $request = request()->post();
        $userEmail = $request["email"];
        $recoveryPin = rand(1000,9999);
        User::query()->where("email",$userEmail)->update(['recovery_pin' => $recoveryPin]);
        Mail::to($userEmail)->send(new Feedback($recoveryPin));
        return redirect()->route('enter.recovery.pin',["email"=>$userEmail]);
    }
    public function changePassword()
    {
        return view('profile.enter-recovery-pin')->with("email",request()->query()["email"]);
    }

    public function validateRecoveryPin()
    {
        $request = request()->post();
        $userRecoveryPin = $request["recovery_pin"];
        $userEmail =$request["email"];
        if(User::query()->where("recovery_pin",$userRecoveryPin)->where("email",$userEmail)->first()){

            return redirect()->route('password.update',["recovery_pin"=>$userRecoveryPin]);
        }
        else abort(404);
    }
    public function saveNewPassword()
    {

        $request = request()->post();
        $userEmail = $request["email"];
        $userRecoveryPin = $request["recovery_pin"];
        $userPassword = Hash::make($request['password']);
        if(User::query()->where("recovery_pin",$userRecoveryPin)){
            User::query()->where("email",$userEmail)->update(['password' => $userPassword]);
        }
        return redirect()->route('login');
    }
}
