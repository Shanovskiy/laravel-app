<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaneMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()) {
        $user_id = Auth::user()->getAuthIdentifier();
        $user = User::query()->where("id", $user_id)->get()->toArray();
        $role_id = $user[0]["role_id"];
            if($this->hasRoleBan($role_id)){
                return redirect()->route("banned");
            }
        }
        return $next($request);
    }
    private function hasRoleBan(mixed $role_id):bool
    {
        $user_id =Auth::user()->getAuthIdentifier();
        $user = User::query()->where("id",$user_id)->get()->toArray();
        $role_id = $user[0]["role_id"];
        if($role_id==3){
            return true;
        }
        return false;
    }
}
