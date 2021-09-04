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

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();
//Auth::routes(['register'=>false]);

Route::get('/home', 'HomeController@index')->name('home');

// Invoice Routes
Route::resource('invoices', 'InvoicesController');

// Archive
Route::resource('Archive', 'invoicesArchiveController');

// attachments
Route::resource('InvoiceAttachments', 'InvoicesAttachmentsController');

Route::get('/section/{id}','InvoicesController@getProducts');

Route::get('/invoices/Details/{id}','InvoicesDetailsController@getDetails');

Route::get('view_file/{invoices_number}/{file_name}','InvoicesDetailsController@open_file' );

Route::get('download/{invoices_number}/{file_name}','InvoicesDetailsController@get_file' );

Route::post('delete_file' , 'InvoicesDetailsController@destroy')->name('file_delete');

// section Routes
Route::resource('sections', 'SectionsController');

// products Routes
Route::resource('products', 'ProductsController');

Route::get('edit_invoice/{id}' , 'InvoicesController@edit' );

Route::get('status_show/{id}' , 'InvoicesController@show' )->name('status_show');

Route::post('update_status/{id}' , 'InvoicesController@update_status' )->name('update_status');

// invoice_PUP

Route::get('invoices_PUP/{value_status}', 'InvoicesController@invoices_PUP')->name('invoices_PUP');

//print
Route::get('print_invoice/{id}' , 'InvoicesController@print_invoice' );
// export
Route::get('export_invoices','InvoicesController@export');


// Route::resource('user', 'userController');



Route::group(['middleware'=>['auth']],function () {

    Route::resource('roles', 'RoleController');
    Route::resource('user', 'userController');

});

Route::get( 'invoices_report' ,'ReportController@index');
Route::post( 'search_reports' ,'ReportController@search');

Route::get( 'customer_reports' ,'customerReportController@index');
Route::post( 'search_customer' ,'customerReportController@search');



Route::get('/{page}','AdminController@index');

