<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //View a list of all categories
    public function categories(){
        
        #Get all users from database
        $categories = Category::get();
        
        #Initial data array to pass variables to viw
        $data = [
            'categories' => $categories
        ];

        #Return view and pass varibles to view
        return view('admin/cat/list', $data);
    }

    public function getCreateCategory (){
        
        #Initial data array to pass variables to viw
        $data = [
            // 'roles' => $roles
        ];

        #Return view and pass varibles to view
        return view('admin/cat/new', $data);
        
    }

    #Method to submit role creation form
    public function postCreateCategory (Request $request){
        // dd($request->all());

        #Validate the form
        $validator = \Validator::make($request->all(), 
        [
                'name' => 'required|unique:categories',
        ]);

        #Save new role details to the database
        $cat = New Category;
            $cat->name = $request['name'];
            $cat->description = $request['description'];
        $cat->save();
        
        #Take us back to the list of roles
        return \Redirect::to('fw/categories');

    }

}
