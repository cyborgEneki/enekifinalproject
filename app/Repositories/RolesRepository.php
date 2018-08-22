<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 22/08/2018
 * Time: 2:30 PM
 */

namespace App\Repositories;

use App\Role;
use Illuminate\Http\Request;

class RolesRepository
{
    public function __construct()
    {
    }

    public function getRoles(){
        $roles = Role::all();

        return $roles;
    }

    public function getRole($id)
    {
        $role = Role::find($id);

        return $role;
    }

    public function postNewRole(Request $request)
    {
        $role =  Role::create($request->all());

        return $role;
    }

    public function updateRole($request, Role $role)
    {
       return $role->update($request->all());

    }

    public function deleteRole(Role $role)
    {
        $role->users()->detach();
        return $role->delete();

    }
}