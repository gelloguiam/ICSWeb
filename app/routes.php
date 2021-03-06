
<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Route::get('/test', array('uses' => 'TestController@show', 'as' => 'pages.test'));
Route::get('/', array('uses' => 'HomeController@showWelcome', 'as' => 'index'));
Route::post('/', array('uses'=> 'HomeController@showWelcome', 'as' => 'index'));
Route::get('/pages',array('uses' => 'GeneralController@showHome', 'as' => 'page/library'));


Route::get('pages/profiles/{lastname}', array('uses'=> 'SessionsController@viewProfile', 'as' => 'page.prof'));
Route::resource('fileupload','FileController');
Route::post('pages/upload_file', array('uses'=> 'FileController@upload_file', 'as' => 'page.fileupload'));
Route::post('pages/profile', array('uses'=> 'FileController@upload_file', 'as' => 'page.fileupload'));

//Controller to the web pages in the site
Route::get('pages/about',array('uses' => 'GeneralController@showAbout', 'as' => 'page.about'));
Route::get('pages/successfile',array('uses' => 'GeneralController@showFile', 'as' => 'page.file'));
Route::get('pages/library',array('uses' => 'GeneralController@showLibrary', 'as' => 'page.library'));
Route::get('pages/curriculum',array('uses' => 'GeneralController@showCurriculum', 'as' => 'page.curriculum'));
Route::get('pages/directory',array('uses' => 'GeneralController@showDirectory', 'as' => 'page.directory'));
Route::get('pages/division',array('uses' => 'GeneralController@showDivision', 'as' => 'page.division'));
Route::get('pages/home',array('uses' => 'GeneralController@showHome', 'as' => 'page.home'));
Route::get('pages/organization',array('uses' => 'GeneralController@showOrganization', 'as' => 'page.organization'));

Route::get('pages/publication',array('uses' => 'GeneralController@showPublication', 'as' => 'page.publication'));
Route::get('pages/register',array('uses' => 'GeneralController@showRegisterForm', 'as' => 'page.reg_form'));

Route::get('signup_success',function(){
    return View::make('pages.user.success');
});

Route::get('/thisIsATestRoute','LaravelHomeControl@showHome');

Route::get('home', function(){
	return "<h1>This is my home</h1>";
});

Route::get('pages/users/login', array('as' => 'user.login', 'uses' => 'SessionsController@getLogin'));
Route::post('pages/users/edit', array('as' => 'user.edit', 'uses' => 'UserController@edit'));
Route::post('pages/users/login', array('as' => 'user.login.post', 'uses' => 'SessionsController@postLogin'));
Route::get('pages/users/logout', array('as' => 'user.logout', 'uses' => 'SessionsController@destroy'));

/* Routes for Sign Up */
Route::resource('pages/user', 'UserController');
Route::get('pages/create/student', function(){
    return View::make('pages.user.student');
});
Route::get('pages/create/faculty', function(){
    return View::make('pages.user.faculty');
});

//Route::resource('pages/students','StudentsController');
//Route::resource('faculty','FacultyController');
//this is for login


Route::resource('sessions', 'SessionsController');

Route::group(array('prefix'=>'pages', 'before' => 'auth'), function(){
	Route::get('profile',array('uses' => 'GeneralController@showProfile', 'as' => 'page.profile'));
	Route::get('profile-edit',array('uses' => 'GeneralController@showProfileEdit', 'as' => 'page.profile-edit'));
	// Group routes
    Route::get('group',array('uses' => 'GeneralController@showGroup', 'as' => 'page.group'));
    Route::post('group/post',array('uses' => 'GroupsController@groupPost', 'as' => 'page.group.post'));
    Route::get('group/join',array('uses' => 'GroupsController@showGroupJoin', 'as' => 'page.group.join'));
    Route::post('group/join/post',array('uses' => 'GroupsController@groupJoin', 'as' => 'page.group.join.post'));
    Route::get('group/create',array('uses'=>'GroupsController@create','as'=>'page.group.create'));
    Route::post('group/store',array('uses' => 'GroupsController@store', 'as' => 'page.group.store'));
    // Message sending
    Route::post('user/message',array('uses'=> 'UserController@sendMessage','as'=>'page.user.message'));
    Route::post('user/message/send',array('uses'=> 'UserController@storeMessage','as'=>'page.user.message.store'));
    // Comments sending
    Route::post('user/comment/send',array('uses'=> 'GroupsController@storeComment','as'=>'page.user.comment.store'));
    Route::resource('groups', 'GroupsController');
    // Route::resource('group','GroupsController', array('only'=>array('groupPost','index'))/*,array('uses' => 'GroupsController@groupPost', 'as' => 'page.group.post')*/);
});

Route::post('pages/library/search', array('as' => 'pages.library.search', 'uses' => 'BookController@search'));
Route::get('team', array('uses'=>'team','as'=>'GeneralController@showTeam'));
