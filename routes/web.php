<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


#Show login form
// Route::get('login', 'AuthController@getLogin');

Route::get('access', 'AuthController@access');


#Show Registration Form
Route::get('register', 'AuthController@getRegister')->name('register');

#Submit Login Form
Route::post('register', 'AuthController@postRegister');

#Show login page
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');

#Submit login form
Route::post('login', 'Auth\LoginController@login');

#Submit logout form
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


Route::get('success', 'AuthController@success');

// Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


#Administrators Routes
#User Management
#View all users
Route::get('fw/users', 'UserController@users');

#Display form to create new user
Route::get('/fw/user/create', 'UserController@getCreateUser');

#Submit user form
Route::post('/fw/user/create', 'UserController@postCreateUser');


#Role Management
#View all roles
Route::get('fw/roles', 'RoleController@roles');

#Display form to create new role
Route::get('/fw/role/create', 'RoleController@getCreateRole');

#Submit role form
Route::post('/fw/role/create', 'RoleController@postCreateRole');


#Display form to edit role
// Route::get('/fw/role/edit/{roleId}', 'RoleController@getEditRole');
Route::get('/fw/role/edit/{roleId}', ['middleware' => ['permission:edit-role'], 'uses' => 'RoleController@getEditRole']);
// Route::post('/fw/role/edit', ['middleware' => ['permission:edit-role'], 'uses' => 'RoleController@postEditRole']);


#Submit edit role form
// Route::post('/fw/role/edit', 'RoleController@postEditRole');
Route::post('/fw/role/edit', ['middleware' => ['permission:edit-role'], 'uses' => 'RoleController@postEditRole']);
// Route::get('/manage', ['middleware' => ['permission:manage-admins'], 'uses' => 'AdminController@manageAdmins']);


#Category Management
#View all categories
Route::get('fw/categories', 'CategoryController@categories');

#Display form to create new user
Route::get('/fw/category/create', 'CategoryController@getCreateCategory');

#Submit user form
Route::post('/fw/category/create', 'CategoryController@postCreateCategory');


#List all products
Route::get('/fw/products', 'ProductController@getProducts');

#Get create product form
Route::get('/fw/product/create', 'ProductController@getCreateProduct');

Route::post('/fw/product/create', 'ProductController@postCreateProduct');




