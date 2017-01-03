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
Route::get('/client/view_contacts/{company_uid}', 'clientController@view_contacts');
Route::get('/client/add_contact/{company_uid}', 'clientController@add_contact');
Route::post('/client/save_company', 'clientController@save_company');
Route::post('/client/save_contact/{company_uid}', 'clientController@save_contact');
Route::get('/client/client_contacts/{company_uid}', 'clientController@client_contacts');
Route::get('/client/update/{company_uid}', 'clientController@client_update');
Route::post('/client/update/save/{company_uid}', 'clientController@client_update_save');

Route::get('/contact/update/{contact_uid}', 'clientController@contact_update');
Route::post('/client/save_update_contact', 'clientController@contact_update_save');

// Salesperson Routes
Route::get('/users/create', 'userAccountController@create');
Route::post('/users/store', 'userAccountController@store');
Route::get('/users/all/{filter?}', 'userAccountController@index');

// Contract Routes
Route::get('/contract/create', 'contractController@create');
Route::post('/contract/store', 'contractController@store');
Route::get('/contract/all', 'contractController@index');

// Magazine Routes
Route::get('/magazine/create', 'magazineController@create');
Route::get('/magazine/create/company', 'magazineController@magazine_add_company');
Route::post('/magazine/add-new', 'magazineController@magazine_add_new');
Route::get('/magazine/add-ad-color-and-size/{mag_uid}', 'magazineController@magazine_add_color_size');
Route::get('/magazine/add-ad-color-and-size-api', 'magazineController@magazine_add_color_size_api');
Route::get('/magazine/all', 'magazineController@index');
Route::post('/magazine/company/save', 'magazineController@save_company');
Route::get('/magazine/company/get_company', 'magazineController@get_company');
Route::get('/magazine/company/get_country/{company_uid}', 'magazineController@get_country');
Route::post('/magazine/add-color-size-discount/{mag_uid}', 'magazineController@add_color_size_discount');
Route::get('/magazine/update/{magazine_uid}', 'magazineController@magazine_update');
Route::post('/magazine/update/save', 'magazineController@magazine_update_save');

// Transaction Routes
Route::get('/transaction/create', 'transactionController@create');
Route::post('/transaction/store', 'transactionController@store');
Route::get('/transaction/all', 'transactionController@index');


// Booking Routes
Route::get('/booking/booking-list/{filter?}', 'bookingController@booking_list');
Route::get('/booking/booking-list_api/{filter?}', 'bookingController@booking_list_api');

Route::get('/booking/add-booking', 'bookingController@add_booking');

Route::post('/booking/magazine-transaction-save-process', 'bookingController@save_booking'); // Process
Route::any('/booking/magazine-transaction/{trans_uid}/{which_country}/{client_id}', 'bookingController@show_transaction_mag'); // after process viewing
Route::post('/booking/save-magazine-transaction/{trans_id}/{which_country}/{client_id}', 'bookingController@save_magazine_transaction');
Route::get('/booking/add_issue/{mag_trans_uid}/{client_id}', 'bookingController@add_issue');
Route::post('/booking/save_issue/{mag_trans_uid}/{client_id}', 'bookingController@save_issue');
Route::get('/booking/getPackageName/{criteria_id}/{mag_uid}', 'bookingController@getPackageName');
Route::get('/booking/delete_issue/{tran_issue_uid}/{mag_trans_uid}/{client_id}', 'bookingController@delete_issue');
Route::post('/booking/save/discount/{booking_trans_num}/{mag_trans_uid}/{client_id}', 'bookingController@save_discount');
Route::get('/booking/get_discount_transaction/{booking_trans_num}', 'bookingController@get_discount_transaction');


Route::post('/booking/issue/discount/approve/{tran_issue_uid}/{mag_trans_uid}/{client_id}', 'bookingController@approve_discount');

Route::post('/booking/issue/discount/decline/{tran_issue_uid}/{mag_trans_uid}/{client_id}', 'bookingController@decline_discount');


Route::get('/transaction/update/row/{trans_id}/{trans_status}', 'bookingController@trans_selected_row_update');

// Payment Routes
Route::get('/payment/payment_list', 'paymentController@payment_list');
Route::get('/payment/invoice_create_api/{trans_num}', 'paymentController@invoice_create_api');
Route::get('/payment/search_invoice_number_api/{inv_num}', 'paymentController@search_invoice_number_api');
Route::get('/payment/save_payment_transaction/{inv_num}/{line_item}/{ref_number}/{method_payment}/{date_payment}/{amount}/{remarks}', 'paymentController@save_payment_transaction');
Route::get('/payment/view/transaction/{inv_num}/{line_item}', 'paymentController@view_payment_transaction');

// Search Routes
Route::get('/execute/search/booking-and-sales', 'searchController@search_function');


Route::get('/ph/developers', 'DeveloperClass@index');

