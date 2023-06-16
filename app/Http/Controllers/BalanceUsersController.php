<?php

namespace App\Http\Controllers;



use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BalanceUsersController extends Controller
{
    public function balanceView()
    {
        $userId = Auth::user()->getAuthIdentifier();
        $user =User::query()->find($userId);
        return view("profile.balance")->with("user",$user);
    }

    public function insufficientFunds()
    {
        return view("profile.insufficient-funds");
    }
}
