<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Permission;

class AuthController extends Controller
{
    public function getLogin (){

        $data = [
            'title' => 'This is my login page',
        ];

        return view('login');
    }

    public function getRegister (){

        $data = [
            'title' => 'This is my registration page',
            'msg' => ''
        ];

        return view('register', $data);
    }
    
    public function postRegister (Request $request){
    
        // dd('I just submitted the resgistration form');

        #Validate the form
        $validator = \Validator::make($request->all(), 
        [
                'email' => 'required|unique:users',
                'firstname' => 'required',
                'lastname' => 'required',
                'password' =>  'required|confirmed',
                // 'password_confirmation' =>  'required',
                // 'hear' => 'required',
                // 'category' => 'required'
        ]);

        #Create the user account
        $user = New User();
            $user->firstname = $request['firstname'];
            $user->middlename = $request['middlename'];
            $user->lastname = $request['lastname'];
            $user->phonenumber = $request['phonenumber'];
            $user->email = $request['email'];
            $user->password = \Hash::make($request['password']);
            $user->suspend = 1;
        $user->save();

        #Attach a role to the user account
        #Get role customer
        $role = Role::where('name', 'Customer')->first();
        if ($user){
            $user->attachRole($role);
        }

        #Redirect the user to the success page with success message
        return \Redirect::to('success')->with('message', 'Your registration was successful, kindly proceed to login');

   

    //      if($validator->fails())
    //     {
    //         return redirect()->to('/'.'#show-form')->withErrors($validator)->withInput();
    //     }

    //     return view('register');
    }

    public function success (){

        return view('success');
    }
    
    public function access (){

        return view('access');
    }


}
