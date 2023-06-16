<?php

namespace App\Traits;

use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait HasRolesAndPermissions
{
    /**
     * @return mixed
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'users_permissions');
    }

    public function hasRoleAdmin($role_id):bool
    {
        $user_id =Auth::user()->getAuthIdentifier();
        $user =User::query()->find($user_id)->first();
        $role_id = $user["role_id"];
        if($role_id==1){
            return true;
        }
        return false;
    }
    /**
     * @param mixed ...$roles
     * @return bool
     */
    //Проверка есть ли у текущего залогиненного пользователя роль.
    //В функцию мы передаем массив $roles и проверяем в цикле, содержат ли роли текущего пользователя заданную роль.
    public function hasRole(... $roles ) {
        foreach ($roles as $role) {
            if ($this->roles->contains('name', $role)) {
                return true;
            }
        }
        return false;
    }
    /**
     * @param $permission
     * @return bool
     */
    public function hasPermission($permission):bool
    {
        return $this->permissions->where('name', $permission)->count();
    }
    /**
     * @param $permission
     * @return bool
     */
    //Метод проверяет, содержат ли права пользователя заданное право, если да, то тогда он вернет true, а иначе false.
    public function hasPermissionTo($permission):bool
    {
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission->name);
    }
    /**
     * @param $permission
     * @return bool
     */
    //Эта функция проверяет, привязана ли Роль с Правами к Пользователю.
    public function hasPermissionThroughRole($permission):bool
    {
        foreach ($permission->roles as $role){
            if($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
    }
    /**
     * @param array $permissions
     * @return mixed
     */
    //Получаем все Права на основе переданного массива.
    public function getAllPermissions(array $permissions)
    {
        return Permission::whereIn('name',$permissions)->get();
    }
    /**
     * @param mixed ...$permissions
     * @return $this
     */
    //Передаем Права в виде массива и получаем все Права из базы данных на основе массива.
    public function givePermissionsTo($permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        if($permissions === null) {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }
    /**
     * @param mixed ...$permissions
     * @return $this
     */
    //мы передаем Права методу и удаляем все прикрепленные Права с помощью метода detach().
    public function deletePermissions(... $permissions )
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }
    /**
     * @param mixed ...$permissions
     * @return HasRolesAndPermissions
     */
    // Удаляем все Права Пользователя, а затем переназначаем предоставленные для него Права.
    public function refreshPermissions(... $permissions )
    {
        $this->permissions()->detach();
        return $this->givePermissionsTo($permissions);
    }
}
