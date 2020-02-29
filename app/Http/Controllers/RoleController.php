<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function roles(){
        
        #Get all roles from database
        $roles = Role::get();
        
        #Initial data array to pass variables to viw
        $data = [
            'roles' => $roles
        ];

        #Return view and pass varibles to view
        return view('admin/role/list', $data);
    }

    #Method to display the create role form
    public function getCreateRole (){

        #Get a list of all permissoins
        $permissions = Permission::get();

        #Initial data array to pass variables to viw
        $data = [
            'permissions' => $permissions
        ];

        #Return view and pass varibles to view
        return view('admin/role/new', $data);
    }

    #Method to submit role creation form
    public function postCreateRole (Request $request){
        // dd($request->all());

        #Validate the form
        $validator = \Validator::make($request->all(), 
        [
                'name' => 'required|unique:roles',
        ]);

        #Save new role details to the database
        $role = New Role;
            $role->name = $request['name'];
            $role->display_name = $request['name'];
        $role->save();
        #Assign permissions array to a new array variable
        $permissions = $request['permissions'];

        // dd($permissions);
        
        #Attach selected permissions to role created.
        foreach($permissions as $permission){
            $role->attachPermission($permission);
            // dd($permission);
        }

        #Take us back to the list of roles
        return \Redirect::to('fw/roles');

    }

    #Get edit role form 
    public function getEditRole ($roleId){
        // dd($roleId);
        $role = Role::where('id', $roleId)->first();
        #Get a list of all permissoins
        $permissions = Permission::get();

        if ($role == null){
            return "Role you are looking for is not found";
        }
        // dd($role);

        $data = [
            'role' => $role,
            'permissions' => $permissions,
        ];

        return view('admin/role/edit', $data);

    }

    #Submit edit form
    public function postEditRole (Request $request){

        $newPermissions = $request['permissions'];
    
        if ($newPermissions == null){
            return 'You must select at least one permission for  a role';
        }

        #Get the selected role with roleId $request['roleId]
        $role = Role::where('id', $request['roleId'])->first();

        if ($role == null){
            return 'Invalid Role';
        }

        // dd($role);

        #Save the role details
            $role->name =  $request['name'];
        $role->save();

        #Delete all existing attachments to role permissions
        foreach($role->permissions as $permission){
            $role->detachPermission($permission);
        }

        #Attach new permissions to role in a loop
        foreach ($newPermissions as $newPermission){
            $role->attachPermission($newPermission);
        }

        return \Redirect::to('/fw/roles');

    }
}
