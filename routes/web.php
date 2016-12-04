<?php

Route::get('/', function () {
    return view('login.login');
});

Route::get('/get_new_password/{value}', 'loginController@get_new_password');


Route::get('/login', 'loginController@login');
Route::get('/login_process/{username}/{password}', 'loginController@login_process');
Route::get('/logout_process', 'loginController@logout_process');

Route::get('/dashboard', 'dashboardController@dashboard');

// Reports Routes
Route::get('/sales_report/view', 'reportController@viewSalesReport');

Route::get('/agency/manage/{agency_uid}', 'agencyController@agency');
Route::get('/agency/grab_checking/{client_code}/{agency_code}/{agency_uid}', 'AgencyController@agency_grab_checking');
Route::get('/agency/grab_save/{client_code}/{agency_code}/{agency_uid}', 'AgencyController@agency_grab_save');

// Client Routes
Route::get('/client/create', 'clientController@create');
Route::post('/client/store', 'clientController@store');
Route::get('/client/all', 'clientController@companies');
Route::get('/client/add_contact/{company_uid}', 'clientController@add_contact');
Route::post('/client/save_client', 'clientController@save_client');
Route::post('/client/save_contact/{company_uid}', 'clientController@save_contact');
Route::get('/client/client_contacts/{company_uid}', 'clientController@client_contacts');
Route::get('/client/update/{company_uid}', 'clientController@client_update');
Route::post('/client/update/save/{company_uid}/{client_id}', 'clientController@client_update_save');

Route::get('/contact/update/{contact_uid}', 'clientController@contact_update');
Route::post('/client/save_contact/{company_uid}/{client_id}', 'clientController@contact_update_save');

// Salesperson Routes
Route::get('/salesperson/create', 'salespersonController@create');
Route::post('/salesperson/store', 'salespersonController@store');
Route::get('/salesperson/all', 'salespersonController@index');

// Contract Routes
Route::get('/contract/create', 'contractController@create');
Route::post('/contract/store', 'contractController@store');
Route::get('/contract/all', 'contractController@index');

// Magazine Routes
Route::get('/magazine/create', 'magazineController@create');
Route::post('/magazine/add-new', 'magazineController@magazine_add_new');
Route::get('/magazine/add-ad-color-and-size/{mag_uid}', 'magazineController@magazine_add_color_size');
Route::get('/magazine/all', 'magazineController@index');

// Transaction Routes
Route::get('/transaction/create', 'transactionController@create');
Route::post('/transaction/store', 'transactionController@store');
Route::get('/transaction/all', 'transactionController@index');


// Booking Routes
Route::get('/booking/booking-list', 'bookingController@booking_list');
Route::get('/booking/add-booking', 'bookingController@add_booking');

Route::post('/booking/magazine-transaction-save-process', 'bookingController@save_booking'); // Process
Route::any('/booking/magazine-transaction/{trans_uid}/{which_country}/{client_id}', 'bookingController@show_transaction_mag'); // after process viewing
Route::post('/booking/save-magazine-transaction/{trans_id}/{which_country}/{client_id}', 'bookingController@save_magazine_transaction');
Route::get('/booking/add_issue/{mag_trans_uid}/{client_id}', 'bookingController@add_issue');
Route::post('/booking/save_issue/{mag_trans_uid}/{client_id}', 'bookingController@save_issue');
Route::get('/booking/getPackageName/{criteria_id}', 'bookingController@getPackageName');
Route::get('/booking/getPackageName/{criteria_id}', 'bookingController@getPackageName');
Route::get('/booking/delete_issue/{tran_issue_uid}/{mag_trans_uid}/{client_id}', 'bookingController@delete_issue');


Route::get('/transaction/update/row/{trans_id}/{trans_status}', 'bookingController@trans_selected_row_update');

// Search Routes
Route::get('/executeSearchClient', 'searchController@executeSearchClient');
Route::get('/executeSearchAgency', 'searchController@executeSearchAgency');

