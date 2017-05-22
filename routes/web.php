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
Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return view('tasks', [
            'tasks' => Task::orderBy('created_at', 'asc')->get()
        ]);
    });

    Route::post('/task', function (Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/')
            ->withInput()
            ->withErrors($validator);
        }
        $task = new Task;
        $task->name = $request->name;
        $task->save();
        return redirect('/');
    });

    Route::delete('/task/{task}', function (Task $task) {
        $task->delete();
        return redirect('/');
    });

    // Route::get('/', 'LoginController@index')->name('login.index');
    // Route::post('/', 'LoginController@authenticate')->name('login.login');
    // Route::match(['get', 'post'], 'logout', 'LoginController@logout')->name('login.logout');
    // // Admin画面
    // Route::get('admin', 'AdminController@index')->name('admin.index');
    // // User画面
    // Route::get('user', 'UserController@index')->name('user.index');
});
