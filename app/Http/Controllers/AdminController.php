<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\RefundRequest;
use App\Models\Role;
use App\Models\User;
use App\Traits\HasRolesAndPermissions;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    use HasRolesAndPermissions;
    public function adminView()
    {
        return view("admin.admin-page");
    }

    public function usersView()
    {
        $users =User::query()->get();
        return view("admin.users")->with("users",$users);
    }

    public function userEdit()
    {
        $userId =request()->query()["id"];
        $user =User::query()->find($userId)->toArray();
        $userRoleId =$user['role_id'];
        $role = Role::query()->where("id",$userRoleId)->get()->toArray();
        $roleName = $role[0]['name'];
        return view("admin.users-edit")->with("id",$userId)->with("user",$user)->with('roleName',$roleName);
    }

    public function userEditSave()
    {
        $request = request()->post();
        $id =$request["id"];

        if(isset($request['password'])) {
            $request['password'] = Hash::make($request['password']);
        }

        $user = User::query()->find($id);

        $user->fill($request);

        $user->save();

        return redirect()->route('users');
    }

    public function userEditRoleSave()
    {
        $request = request()->post();
        $userId =$request["id"];
        User::query()->where("id",$userId)->update(["role_id" => $request["role_id"]]);


        return redirect()->route('users');
    }

    public function refundRequests()
    {
        $refundRequests = RefundRequest::query()->orderBy("created_at","desc")->get();
        return view("admin.refund-requests")->with("refundRequests",$refundRequests);
    }

    public function returnFunds()
    {
        $request = request()->post();
        $refundRequest = RefundRequest::query()->find($request["id"])->toArray();
        $order =Order::query()->find($refundRequest["order_id"])->toArray();
        $price =$order["price"];
        $user = User::query()->find($order["user_id"])->toArray();
        $balance =$user["balance"];
        $newBalance =$balance+$price;
        User::query()->where("id",$order["user_id"])->update(["balance" => $newBalance]);
        RefundRequest::query()->find($request["id"])->delete();
        Order::query()->find($refundRequest["order_id"])->delete();
        return redirect()->route("refund-requests");
    }

    public function returnRefusal()
    {
        $request = request()->post();
        RefundRequest::query()->find($request["id"])->delete();
        return redirect()->route("refund-requests");
    }
}
