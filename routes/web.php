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


Auth::routes();

Route::middleware('lang', 'auth')->group(function () {
    // Home page
    Route::get('/', 'Admin\HomeController@index')->name('admin.dashboard.index');

    //Companies
    Route::resource('companies', 'Admin\CompaniesController', ['except' => ['show']]);
    Route::post('companies/bulk-delete', 'Admin\CompaniesController@bulkDelete')->name('companies.bulk-delete');

    //Employees
    Route::resource('employees', 'Admin\EmployeesController', ['except' => ['show']]);
    Route::post('employees/bulk-delete', 'Admin\EmployeesController@bulkDelete')->name('employees.bulk-delete');

    // set language
    Route::get('/set-language/{lang}', 'Admin\HomeController@setLanguage')->name('admin.language.set');
});
