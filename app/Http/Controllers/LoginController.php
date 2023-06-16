<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\HasRolesAndPermissions;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use HasRolesAndPermissions;
    public function viewLogin()
    {
//        if (Auth::check()) {
//            return redirect()->route('root');
//        }
        $users = User::query()->get();
        return view("profile.login")->with("users", $users);
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        Auth::attempt($credentials);
        $user_id =Auth::user()->getAuthIdentifier();
        $user = User::query()->where("id",$user_id)->get()->toArray();
        $role_id = $user[0]["role_id"];
        if (Auth::attempt($credentials) && $this->hasRoleAdmin($role_id)) {

            $request->session()->regenerate();

            return redirect()->route('admin.page');
        }

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()->intended('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
