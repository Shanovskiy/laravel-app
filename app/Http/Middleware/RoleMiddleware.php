<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Traits\HasRolesAndPermissions;
use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user_id =Auth::user()->getAuthIdentifier();
        $user = User::query()->where("id",$user_id)->get()->toArray();
        $role_id = $user[0]["role_id"];
        if($this->hasRoleAdmin($role_id)){
            return $next($request);
        }
        return redirect()->route("root");
    }

    private function hasRoleAdmin(mixed $role_id):bool
    {
        $user_id =Auth::user()->getAuthIdentifier();
        $user = User::query()->where("id",$user_id)->get()->toArray();
        $role_id = $user[0]["role_id"];
        if($role_id==1){
            return true;
        }
        return false;
    }
}
