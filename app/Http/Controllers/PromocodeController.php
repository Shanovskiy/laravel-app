<?php

namespace App\Http\Controllers;

use App\Models\Promocode;
use Illuminate\Http\Request;

class PromocodeController extends Controller
{
    public function promocodeView()
    {
        return view("admin.promocodes.create-promocode");
    }

    public function createPromoCode()
    {
        $request=request()->post();
        $promoCode =new Promocode($request);
        $promoCode->save();
        return redirect()->route("view-promocode");
    }
}
