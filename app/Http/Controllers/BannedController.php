<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BannedController extends Controller
{
    public function bannedView()
    {
        return view("banned.banned");
    }
}
