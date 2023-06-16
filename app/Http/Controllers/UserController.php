<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function editProfile()
    {
        $userId = Auth::user()->getAuthIdentifier();
        $user = User::query()->find($userId);
        return view("profile.edit")->with("user",$user);
    }
    public function saveProfile()
    {
        $userId = Auth::user()->getAuthIdentifier();

        $request = request()->post();

        if(isset($request['password'])) {
            $request['password'] = Hash::make($request['password']);
        }

        $user = User::query()->find($userId);

        $user->fill($request);

        $user->save();

        return redirect()->route('root');
    }

    public function addUserImage()
    {
        $image = request()->file("image");
        $filename = date('Y-m-d-H-i-s')."-".$image->getClientOriginalName();
        Image::make($image->getRealPath())->resize(50, 50)->save(Storage::path('/public/image/users').$filename,100);
        $userId = Auth::user()->getAuthIdentifier();
        $user = User::query()->find($userId);
        $path = $user->image;
        Storage::delete($path);
        $user->image = 'storage/image/users'.$filename;
        $user->save();
        return redirect()->route('root');
    }
}
