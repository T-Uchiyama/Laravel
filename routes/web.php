<?php

use App\Task;
use Illuminate\Http\Request;
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

    Route::get('/', 'HomeController@index');

    Route::get('/task', function () {
        return view('tasks', [
            'tasks' => Task::orderBy('created_at', 'asc')->get()
        ]);
    })->name('task');

    Route::post('/task', function (Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/task')
            ->withInput()
            ->withErrors($validator);
        }
        $task = new Task;
        $task->name = $request->name;
        $task->save();
        return redirect('/task');
    });

    Route::delete('/task/{task}', function (Task $task) {
        $task->delete();
        return redirect('/task');
    });

Auth::routes();


// Authentication Routes...
$this->get('admin/login', 'AdminAuth\AuthController@showLoginForm');
$this->post('admin/login', 'AdminAuth\AuthController@login');
$this->get('admin/logout', 'AdminAuth\AuthController@logout');
// Registration Routes...
$this->get('admin/register', 'AdminAuth\AuthController@showRegistrationForm');
$this->post('admin/register', 'AdminAuth\AuthController@register');
// Password Reset Routes...
$this->get('admin/password/reset/{token?}', 'AdminAuth\PasswordController@showResetForm');
$this->post('admin/password/email', 'AdminAuth\PasswordController@sendResetLinkEmail');
$this->post('admin/password/reset', 'AdminAuth\PasswordController@reset');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('admin/home', 'AdminHomeController@index');

$this->get('admin/login', 'AdminAuth\LoginController@showLoginForm')->name('admin.login');
$this->post('admin/login', 'AdminAuth\LoginController@login');
$this->post('admin/logout', 'AdminAuth\LoginController@logout')->name('admin.logout');
// Registration Routes...
$this->get('admin/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('admin.register');
$this->post('admin/register', 'AdminAuth\RegisterController@register');
// Password Reset Routes...
$this->post('admin/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
$this->get('admin/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
$this->post('admin/password/reset', 'AdminAuth\ResetPasswordController@reset');
$this->get('admin/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm')->name('admin.password.reset');

// Article Routes...
Route::get('/articles', 'ArticlesController@getIndex')->name('article');
$this->get('articles/show/{id}', 'ArticlesController@show');
$this->get('articles/create', 'ArticlesController@getCreate');
$this->post('articles/create', 'ArticlesController@postCreate');
$this->get('articles/edit/{id}', 'ArticlesController@getEdit');
$this->post('articles/edit/{id}', 'ArticlesController@postEdit');
$this->post('articles/delete/{id}', 'ArticlesController@postDelete');
$this->post('articles/imageDelete', 'ArticlesController@imageDelete');
$this->get('articles/getQuerySearch', 'ArticlesController@getQuerySearch')->name('articles.search');
$this->post('articles/addTag', 'ArticlesController@addTag');


// Home_Avatar
Route::post('/upload', 'HomeController@upload');

// Mail
Route::post('/mail', 'MailController@send')->name('mail');

//Comment
Route::resource('comment', 'CommentsController');