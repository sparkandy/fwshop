<?php

namespace App\Http\Controllers;
use App\User;
use App\Role;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //View a list of all users
    public function users(){
        
        #Get all users from database
        $users = User::get();
        
        #Initial data array to pass variables to viw
        $data = [
            'users' => $users
        ];

        #Return view and pass varibles to view
        return view('admin/user/list', $data);
    }

    public function getCreateUser (){
        #Get all roles from roles table
        $roles = Role::get();

        #Initial data array to pass variables to viw
        $data = [
            'roles' => $roles
        ];

        #Return view and pass varibles to view
        return view('admin/user/new', $data);
        
    }

    public function postCreateUser (Request $request){
        #Validate the form
        $validator = \Validator::make($request->all(), 
        [
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required',
        ]);

        #Save new user details to the database
        $user = New User;
            $user->firstname = $request['firstname'];
            $user->middlename = 'James';
            $user->lastname = $request['lastname'];
            $user->email = $request['email'];
            $user->password = \Hash::make($request['password']);
            $user->suspend = 1;
        $user->save();
        
        
        #Attach selected role to user created.
        $user->attachRole($request['role']);

        #Take us back to the list of users
        return \Redirect::to('fw/users');

    }
}
