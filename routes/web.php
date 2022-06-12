<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;

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

Auth::routes(['register'    =>  false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('admin', function () {
    return view('admin');
});

Route::group(['middleware'  =>  ['auth']], function () {
    Route::resource(
        'company',
        CompanyController::class,
        [
            'names' => [
                'index' => 'company',
                'create' => 'company.create',
                'store' => 'company.store',
                'edit'  =>  'company.edit',
                'update'    =>  'company.update',
                'destroy'   =>  'company.destroy'
            ]
        ]
    );

    Route::resource(
        'employee',
        EmployeeController::class,
        [
            'names' => [
                'index' => 'employee',
                'create' => 'employee.create',
                'store' => 'employee.store',
                'edit'  =>  'employee.edit',
                'update'    =>  'employee.update',
                'destroy'   =>  'employee.destroy'
            ]
        ]
    );

});
