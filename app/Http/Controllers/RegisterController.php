<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function viewRegister()
    {
//        if (Auth::check()) {
//            return redirect()->route('root');
//        }
        $users = User::query()->get();
        return view("profile.register")->with("users",$users);

    }
    public function saveUser()
    {
        $validator = Validator::make(request()->all(), [
            'g-recaptcha-response' => 'recaptcha',
            // OR since v4.0.0
            recaptchaFieldName() => recaptchaRuleName()
        ]);

// check if validator fails
        if($validator->fails()) {
            return redirect()->route('root');
        }
        $request = request()->post();

        $request['password'] = Hash::make($request['password']);

        $user = new User($request);
        $user->save();
        Auth::login($user);
        return redirect()->route('root');
    }
}
