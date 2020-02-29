<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function getProducts (){
        
        #Get all products from database
        $products = Product::get();
        
        #Initial data array to pass variables to viw
        $data = [
            'products' => $products
        ];

        #Return view and pass varibles to view
        return view('admin/product/list', $data);
    }

    public function getCreateProduct (){
        
        $categories = Category::get();

        #Initial data array to pass variables to viw
        $data = [
            'categories' => $categories
        ];

        #Return view and pass varibles to view
        return view('admin/product/new', $data);
    }

    #Method to submit product creation form
    public function postCreateProduct (Request $request){
        // dd($request->all());

        #Validate the form
        $validator = \Validator::make($request->all(), 
        [
                'name' => 'required|unique:products',
                'unit_price' => 'required',
                'quantity' => 'required|integer',
                // 'quantity' => 'required|integer',
        ]);

        #Save new role details to the database
        $product = New Product;
            $product->name = $request['name'];
            $product->category_id = $request['category'];
            $product->color = $request['color'];
            $product->size = $request['size'];
            $product->unit_price = $request['price'];
            $product->quantity = $request['quantity'];
        $product->save();
        
        #Take us back to the list of roles
        return \Redirect::to('fw/products');

    }
}
