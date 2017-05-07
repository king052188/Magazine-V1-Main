<?php

Route::get('/', function () {
    return view('login.login');
});

Route::get('/dual_list', function () {
    return view('client.dual_list');
});

Route::get('/get_new_password/{value}', 'loginController@get_new_password');


Route::get('/login', 'loginController@login');
Route::get('/login_process/{username}/{password}', 'loginController@login_process');
Route::get('/logout_process', 'loginController@logout_process');

Route::get('/dashboard', 'dashboardController@dashboard');

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

Route::get('/client/client_contacts_group_list/{company_uid}', 'clientController@client_contacts_group_list');
Route::get('/client/list_of_contacts_in_group/{company_uid}/{group_id}', 'clientController@list_of_contacts_in_group');

Route::get('/client/add_contacts_in_group/{company_uid}/{group_id}/{contact_id}/{role}', 'clientController@add_contacts_in_group'); //ok
Route::get('/client/add_group/{company_uid}/{group_name}/{category}', 'clientController@add_group'); //ok
Route::get('/client/list_group/{company_uid}', 'clientController@list_group'); //ok
Route::get('/client/client_group/{group_uid}', 'clientController@client_group'); //ok
Route::get('/client/remove_contact_in_group/{contact_uid_in_group}', 'clientController@remove_contact_in_group'); //ok

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
Route::get('/magazine/create/company/{add?}', 'magazineController@magazine_add_company');
Route::post('/magazine/add-new', 'magazineController@magazine_add_new');
Route::get('/magazine/add-ad-color-and-size/{mag_uid}', 'magazineController@magazine_add_color_size');
Route::get('/magazine/digital/settings/{mag_uid}', 'magazineController@show_digital_settings');
Route::post('/magazine/digital/settings/save/{mag_uid}', 'magazineController@show_digital_settings_save');
Route::get('/magazine/digital/settings/info/{mag_uid}', 'magazineController@get_show_digital_settings_info');
Route::get('/magazine/digital/settings/edit/{digital_uid}', 'magazineController@edit_digital_settings_info');
Route::get('/magazine/digital/settings/update/{digital_uid}/{digital_type}/{digital_size}/{digital_amount}/{digital_issue}', 'magazineController@update_digital_settings_info');
Route::get('/magazine/digital/settings/delete/{digital_uid}', 'magazineController@delete_digital_settings_info');

Route::get('/magazine/ad/delete/{ad_uid}', 'magazineController@magazine_ad_delete');
Route::get('/magazine/add-ad-color-and-size-api', 'magazineController@magazine_add_color_size_api');
Route::get('/magazine/all', 'magazineController@index');
Route::post('/magazine/company/save', 'magazineController@save_company');
Route::get('/magazine/company/get_company', 'magazineController@get_company');
Route::get('/magazine/company/get_country/{company_uid}', 'magazineController@get_country');
Route::post('/magazine/add-color-size-discount/{mag_uid}', 'magazineController@add_color_size_discount');
Route::get('/magazine/add-issue-discount/{mag_id}/{discount_2}/{discount_3}/{discount_4}/{discount_5}/{discount_6}/{discount_7}/{discount_8}/{discount_9}/{discount_10}/{discount_11}/{discount_12}', 'magazineController@add_issue_discount');
Route::get('/magazine/update/{magazine_uid}', 'magazineController@magazine_update');
Route::get('/magazine/get-discount-issue/{mag_uid}', 'magazineController@get_discount_issue');
Route::post('/magazine/update/save', 'magazineController@magazine_update_save');

Route::get('/magazine/list/publisher/{publisher_uid}', 'magazineController@list_publishers');
Route::get('/magazine/set/inactive/status/publisher/{publisher_uid}', 'magazineController@set_inactive_publishers');
Route::get('/magazine/set/active/status/publisher/{publisher_uid}', 'magazineController@set_active_publishers');
//Route::post('/magazine/update/save', 'magazineController@edit_publishers');

// Transaction Routes
Route::get('/transaction/create', 'transactionController@create');
Route::post('/transaction/store', 'transactionController@store');
Route::get('/transaction/all', 'transactionController@index');


// Booking Routes
//Route::get('/booking/booking-list/{filter_publication}/{filter_sales_rep}/{filter_client}/{filter_status}', 'bookingController@booking_list');
Route::get('/booking/booking-list', 'bookingController@booking_list');
Route::get('/booking/booking-list-filter/{filter_publication}/{filter_sales_rep}/{filter_client}/{filter_status}', 'bookingController@booking_list_filter');
Route::get('/booking/booking-list_api/{filter?}', 'bookingController@booking_list_api');

Route::get('/booking/checkpoint', 'bookingController@booking_checkpoint');
Route::get('/booking/add-booking', 'bookingController@add_booking');
Route::get('/booking/digital/add-booking', 'bookingController@add_booking_digital');
Route::get('/booking/get-client-contacts/{client_id}', 'bookingController@search_bill_to');
Route::get('/search/search-group-by-category/{client_id}/{category}', 'bookingController@search_group_by_category');

//Route::get('/search/search-contact-by-group/{client}/{category}', 'bookingController@search_contact_by_group_edited_kpa');
Route::get('/search/search-contact-by-group/{client}/{category}', 'bookingController@search_contact_by_group');
Route::get('/search/get-bill-to-using-group-uid/{group_uid}', 'bookingController@get_bill_to_using_group_to');


Route::get('/use-default-bill-to/{client_id}', 'bookingController@use_default_bill_to');

Route::post('/booking/magazine-transaction-save-process', 'bookingController@save_booking'); // Process
Route::post('/booking/digital/magazine-transaction-save-process', 'bookingController@save_booking_digital');

Route::any('/booking/magazine-transaction/{trans_uid}/{which_country}/{client_id}', 'bookingController@show_transaction_mag'); // after process viewing
Route::any('/booking/digital/magazine-transaction/{trans_uid}/{which_country}/{client_id}', 'bookingController@show_transaction_mag_digital'); // after process viewing

Route::post('/booking/save-magazine-transaction/{trans_id}/{which_country}/{client_id}', 'bookingController@save_magazine_transaction');
Route::post('/booking/digital/save-magazine-transaction/{trans_id}/{which_country}/{client_id}', 'bookingController@save_magazine_transaction_digital');

Route::get('/booking/add_issue/{mag_trans_uid}/{client_id}', 'bookingController@add_issue');
Route::get('/booking/digital/add_issue/{mag_trans_uid}/{client_id}', 'bookingController@add_issue_digital');
Route::get('/api/api_get_digital_price/{digital_price_uid}', 'bookingController@api_get_digital_price');
Route::get('/booking/digital/add_issue/save/{mag_id}/{position_id}/{month_id}/{week_id}/{amount}', 'bookingController@digital_add_issue_save');
Route::get('/api/api_get_digital_transaction/{mag_id}', 'bookingController@api_get_digital_transaction');

Route::post('/booking/save_issue/{mag_trans_uid}/{client_id}', 'bookingController@save_issue');
Route::get('/booking/getPackageName/{criteria_id}/{mag_uid}', 'bookingController@getPackageName');
Route::get('/booking/delete_issue/{tran_issue_uid}/{mag_trans_uid}/{client_id}', 'bookingController@delete_issue');
Route::post('/booking/save/discount/{booking_trans_num}/{mag_trans_uid}/{client_id}', 'bookingController@save_discount');
Route::get('/booking/get_discount_transaction/{booking_trans_num}', 'bookingController@get_discount_transaction');
Route::get('/booking/notes/save/{booking_trans_num}/{notes}', 'bookingController@notes_save');
Route::get('/booking/notes/get/{booking_trans_num}', 'bookingController@notes_get');

Route::post('/booking/save/artwork/{booking_trans_num}/{mag_trans_uid}/{client_id}', 'bookingController@save_artwork');
Route::get('/booking/get_artwork/{booking_trans_num}', 'bookingController@get_artwork');

Route::post('/booking/issue/discount/approve/{tran_issue_uid}/{mag_trans_uid}/{client_id}', 'bookingController@approve_discount');

Route::post('/booking/issue/discount/decline/{tran_issue_uid}/{mag_trans_uid}/{client_id}', 'bookingController@decline_discount');

Route::get('/transaction/update/row/{trans_id}/{trans_status}', 'bookingController@trans_selected_row_update');

// Production Routes
Route::get('/production/flat/planing', 'FlatPlanController@init');



// Payment Routes
Route::get('/payment/payment_list', 'paymentController@payment_list');
Route::get('/payment/invoice_create_api/{trans_num}', 'paymentController@invoice_create_api');
Route::get('/payment/search_invoice_number_api/{inv_num}', 'paymentController@search_invoice_number_api');
Route::get('/payment/save_payment_transaction/{inv_num}/{line_item}/{ref_number}/{method_payment}/{date_payment}/{amount}/{remarks}', 'paymentController@save_payment_transaction');
Route::get('/payment/view/transaction/{inv_num}/{line_item}', 'paymentController@view_payment_transaction');
Route::get('/payment/invoice/generate/{generate_issue}/{generate_year}/{generate_company_name}/{generate_magazine_name}', 'paymentController@invoice_generate');
Route::get('/payment/invoice', 'paymentController@invoice');
Route::get('/payment/invoice/list', 'paymentController@invoice_list');
Route::get('/payment/latest/invoice/list/{generate_issue}/{generate_year}/{generate_company_name}/{generate_magazine_name}', 'paymentController@latest_invoice_list');

// Search Routes
Route::get('/execute/search/booking-and-sales', 'searchController@search_function');


// Reports Routes
Route::get('/sales_report/view', 'reportController@viewSalesReport');
Route::get('/sales_report/get_filter_data/{f_publication}/{f_sales_rep}/{f_client}/{f_status}/{f_date_from}/{f_date_to}/{f_operator}', 'reportController@get_filter_data');
Route::get('/sales_report/get_filter_data_invoice/{i_invoice_number}/{i_publication}/{i_issue}/{i_year}/{i_sales_rep}/{i_date_from}/{i_date_to}/{i_operator}', 'reportController@get_filter_data_invoice');




//Route::get('/ph/developers', 'DeveloperClass@index');