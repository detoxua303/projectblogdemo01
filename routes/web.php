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
use App\Role;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
/*
|--------------------------------------------------------------------------
| To dcheck whether middleware logic(isAdmin) is working or not
|--------------------------------------------------------------------------
*/
//Route::get('/middleware', function () {
//   	$user = Auth::user();
//    if($user->isAdmin()){
//    	echo "Admin";
//    }
//
//});
/*
|--------------------------------------------------------------------------
| To display the users of role id 2 (i.e role: user)
|--------------------------------------------------------------------------
*/
//Route::get('/roles', function(){

//	$users = App\Role::find(2)->user;
//	foreach ($users as $user)
//	{
//		echo $user->name;
//	}
//});
/*
|--------------------------------------------------------------------------
| AdminUsersCRUD Route
|--------------------------------------------------------------------------
*/
Route::group(['middleware'=>'admin'], function(){

	Route::resource('admin/users','AdminUserController');

	Route::get('/admin', function () {
		return view('admin.index');
	});

	Route::resource('admin/posts','AdminPostsController');

});



