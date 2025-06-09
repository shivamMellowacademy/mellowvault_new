<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Auth\Developer\ForgotPasswordController;
use App\Http\Controllers\Auth\Developer\ResetPasswordController;
use App\Http\Controllers\GoogleCalendarController;
use App\Http\Controllers\SubscriptionPlanController;
use App\Http\Controllers\RazorpayPaymentController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\CollegeController;

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

Route::get('/','App\Http\Controllers\frontController@index');
Route::get('index','App\Http\Controllers\frontController@index')->name('index');
Route::get('aboutus','App\Http\Controllers\frontController@aboutus')->name('aboutus');
Route::get('product/{id}','App\Http\Controllers\frontController@product')->name('product');
Route::get('subproduct/{id}','App\Http\Controllers\frontController@subproduct')->name('subproduct');

Route::get('product_details/{id}','App\Http\Controllers\frontController@product_details')->name('product_details');

Route::get('contact','App\Http\Controllers\frontController@contact')->name('contact');
Route::post('submit_query','App\Http\Controllers\frontController@submit_query')->name('submit_query');

Route::get('privacy','App\Http\Controllers\frontController@privacy')->name('privacy');
Route::get('term','App\Http\Controllers\frontController@term')->name('term');
Route::get('refund_policy','App\Http\Controllers\frontController@refund_policy')->name('refund_policy');

Route::get('download/{id}','App\Http\Controllers\frontController@download')->name('download');

Route::get('commercial_license','App\Http\Controllers\frontController@commercial_license')->name('commercial_license');

Route::get('order_history','App\Http\Controllers\frontController@order_history')->name('order_history');

Route::get('faq','App\Http\Controllers\frontController@faq')->name('faq');
Route::get('blogs','App\Http\Controllers\frontController@blogs')->name('blogs');
Route::get('blog_details/{id}','App\Http\Controllers\frontController@blog_details')->name('blog_details');

Route::get('product_show/{id}','App\Http\Controllers\frontController@product_show')->name('product_show');

Route::post('autosearch','App\Http\Controllers\frontController@autosearch')->name('autosearch');

Route::get('developer_rating_details/{dev_id}','App\Http\Controllers\frontController@developer_rating_details')->name('developer_rating_details');

Route::get('hosting','App\Http\Controllers\frontController@hosting')->name('hosting');
Route::get('buy_now/{id}','App\Http\Controllers\frontController@buy_now')->name('buy_now');

Route::post('payment_initiate_buy_now/{id}','App\Http\Controllers\frontController@payment_initiate_buy_now')->name('payment_initiate_buy_now');
Route::post('checkout_buy_now/{id}','App\Http\Controllers\frontController@checkout_buy_now')->name('checkout_buy_now');
Route::get('buynow_thank_you','App\Http\Controllers\frontController@buynow_thank_you')->name('buynow_thank_you');
Route::get('view_invoice/{order_id}','App\Http\Controllers\frontController@view_invoice')->name('view_invoice');

/*
---------------------------------------------------------------------------------------------------------
........................................ User Panel Routes Section......................................
---------------------------------------------------------------------------------------------------------
*/

Route::get('login','App\Http\Controllers\userController@login')->name('login');
Route::get('registration','App\Http\Controllers\userController@registration')->name('registration');
Route::post('submit_registeration','App\Http\Controllers\userController@submit_registeration')->name('submit_registeration');
Route::post('verify_login','App\Http\Controllers\userController@verify_login')->name('verify_login');
Route::get('user_logout','App\Http\Controllers\userController@user_logout')->name('user_logout');
Route::post('add_to_cart','App\Http\Controllers\userController@add_to_cart')->name('add_to_cart');
Route::get('delete_cart/{id}','App\Http\Controllers\userController@delete_cart')->name('delete_cart');

Route::get('cart','App\Http\Controllers\userController@cart')->name('cart');
Route::get('proceed_to_checkout','App\Http\Controllers\userController@proceed_to_checkout')->name('proceed_to_checkout');

Route::post('payment_initiate','App\Http\Controllers\userController@payment_initiate')->name('payment_initiate');
Route::post('checkout','App\Http\Controllers\userController@checkout')->name('checkout');
Route::get('thank_you','App\Http\Controllers\userController@thank_you')->name('thank_you');

Route::get('user_profile_details','App\Http\Controllers\userController@user_profile_details')->name('user_profile_details');
Route::get('user_profile','App\Http\Controllers\userController@user_profile')->name('user_profile');
Route::get('show_invoice','App\Http\Controllers\userController@show_invoice')->name('show_invoice');
Route::get('invoice/{id}','App\Http\Controllers\userController@invoice')->name('invoice');
Route::get('dev_invoice/{id}','App\Http\Controllers\userController@dev_invoice')->name('dev_invoice');
Route::get('my_download','App\Http\Controllers\userController@my_download')->name('my_download');
Route::post('edit_profile','App\Http\Controllers\userController@edit_profile')->name('edit_profile');
Route::post('update_image','App\Http\Controllers\userController@update_image')->name('update_image');

Route::get('add_work_space','App\Http\Controllers\userController@add_work_space')->name('add_work_space');

Route::get('act_setting','App\Http\Controllers\userController@act_setting')->name('act_setting');
Route::post('update_change_password','App\Http\Controllers\userController@update_change_password')->name('update_change_password');

Route::post('leave_comment','App\Http\Controllers\userController@leave_comment')->name('leave_comment');
Route::post('reply','App\Http\Controllers\userController@reply')->name('reply');

Route::post('search','App\Http\Controllers\userController@search')->name('search');
Route::get('higher_professional','App\Http\Controllers\userController@higher_professional')->name('higher_professional');
Route::get('dev_details/{id}','App\Http\Controllers\userController@dev_details')->name('dev_details');
Route::get('developer_detail/{id}','App\Http\Controllers\userController@developer_detail')->name('developer_detail');

Route::get('invoice_pdf/{id}','App\Http\Controllers\userController@invoice_pdf')->name('invoice_pdf');
Route::get('dev_invoice_pdf/{id}','App\Http\Controllers\userController@dev_invoice_pdf')->name('dev_invoice_pdf');
Route::get('buynow_invoice_pdf/{id}','App\Http\Controllers\userController@buynow_invoice_pdf')->name('buynow_invoice_pdf');


Route::post('user_profile_show','App\Http\Controllers\userController@user_profile_show')->name('user_profile_show');

Route::get('forgetpassword','App\Http\Controllers\userController@forgetpassword')->name('forgetpassword');

Route::post('sendforgetpassword','App\Http\Controllers\userController@sendforgetpassword')->name('sendforgetpassword');

Route::post('send_message','App\Http\Controllers\userController@send_message')->name('send_message');

Route::post('submit_rating','App\Http\Controllers\userController@submit_rating')->name('submit_rating');

Route::post('free_consultation','App\Http\Controllers\userController@free_consultation')->name('free_consultation');

/*


/*
---------------------------------------------------------------------------------------------------------
........................................ News Letter Routes Section......................................
---------------------------------------------------------------------------------------------------------
*/


Route::post('store','App\Http\Controllers\NewsletterController@store')->name('store');


/*
---------------------------------------------------------------------------------------------------------
........................................ Cart Routes Section......................................
---------------------------------------------------------------------------------------------------------
*/


Route::post('cart','App\Http\Controllers\cartcontroller@cart')->name('cart');
Route::get('developer_checkout/{id}','App\Http\Controllers\cartcontroller@developer_checkout')->name('developer_checkout');
Route::get('developer_proceed_checkouts','App\Http\Controllers\cartcontroller@developer_proceed_checkout')->name('developer_proceed_checkout');
Route::post('developer_payment_initiate','App\Http\Controllers\cartcontroller@developer_payment_initiate')->name('developer_payment_initiate');
Route::post('developer_payment','App\Http\Controllers\cartcontroller@developer_payment')->name('developer_payment');
Route::get('resume_download/{dev_id}','App\Http\Controllers\cartcontroller@resume_download')->name('resume_download');
Route::get('delete_developer_cart/{dev_id}','App\Http\Controllers\cartcontroller@delete_developer_cart')->name('delete_developer_cart');
Route::get('developer_thank_you','App\Http\Controllers\cartcontroller@developer_thank_you')->name('developer_thank_you');



Route::get('resource','App\Http\Controllers\cartcontroller@resource')->name('resource');
Route::post('submit_require_docs','App\Http\Controllers\cartcontroller@submit_require_docs')->name('submit_require_docs');
Route::post('submit_short_message','App\Http\Controllers\cartcontroller@submit_short_message')->name('submit_short_message');
Route::post('submit_sow_docs','App\Http\Controllers\cartcontroller@submit_sow_docs')->name('submit_sow_docs');
Route::post('schedule_interview_resource','App\Http\Controllers\cartcontroller@schedule_interview_resource')->name('schedule_interview_resource');
Route::post('schedule_interview_qualified','App\Http\Controllers\cartcontroller@schedule_interview_qualified')->name('schedule_interview_qualified');

Route::get('success','App\Http\Controllers\cartcontroller@success')->name('success');

// google calender routes start
Route::get('/google-calendar/connect', [GoogleCalendarController::class, 'redirectToGoogle'])->name('google.connect');
Route::get('/google-calendar/callback', [GoogleCalendarController::class, 'handleGoogleCallback'])->name('google.callback');
// new
Route::get('/google-calendar/events', [GoogleCalendarController::class, 'useGoogleCalendar'])->name('google.use');
// google calender routes end


Route::get('assign_work','App\Http\Controllers\cartcontroller@assign_work')->name('assign_work');

Route::get('assign_work_details/{dev_id}','App\Http\Controllers\cartcontroller@assign_work_details')->name('assign_work_details');
Route::get('sow_docs_download/{id}','App\Http\Controllers\cartcontroller@sow_docs_download')->name('sow_docs_download');
Route::get('require_docs_download/{id}','App\Http\Controllers\cartcontroller@require_docs_download')->name('require_docs_download');

Route::get('why_qualified_advance/{dev_id}','App\Http\Controllers\cartcontroller@why_qualified_advance')->name('why_qualified_advance');
Route::get('dev_qualified_checkout/{dev_id}','App\Http\Controllers\cartcontroller@dev_qualified_checkout')->name('dev_qualified_checkout');
Route::post('devq_payment_initiate/{dev_id}','App\Http\Controllers\cartcontroller@devq_payment_initiate')->name('devq_payment_initiate');
Route::post('dev_qcheckout/{dev_id}','App\Http\Controllers\cartcontroller@dev_qcheckout')->name('dev_qcheckout');
Route::get('dev_thank_you','App\Http\Controllers\cartcontroller@dev_thank_you')->name('dev_thank_you');
Route::get('/dev/pay/{dev_id}', 'App\Http\Controllers\cartcontroller@pay')->name('dev.pay');

/*
---------------------------------------------------------------------------------------------------------
........................................ Admin Panel Routes Section......................................
---------------------------------------------------------------------------------------------------------
*/


Route::get('adminindex','App\Http\Controllers\admincontroller@adminindex')->name('adminindex');
Route::post('login_verification_admin','App\Http\Controllers\admincontroller@login_verification_admin')->name('login_verification_admin');
Route::get('dashboard','App\Http\Controllers\admincontroller@dashboard')->name('dashboard');
Route::get('logout','App\Http\Controllers\admincontroller@logout')->name('logout');

Route::get('category','App\Http\Controllers\admincontroller@category')->name('category');
Route::post('submit_category','App\Http\Controllers\admincontroller@submit_category')->name('submit_category');
Route::post('update_category','App\Http\Controllers\admincontroller@update_category')->name('update_category');
Route::get('delete_category/{id}','App\Http\Controllers\admincontroller@delete_category')->name('delete_category');

Route::get('subcategory','App\Http\Controllers\admincontroller@subcategory')->name('subcategory');
Route::post('submit_subcategory','App\Http\Controllers\admincontroller@submit_subcategory')->name('submit_subcategory');
Route::post('update_subcategory','App\Http\Controllers\admincontroller@update_subcategory')->name('update_subcategory');
Route::get('delete_subcategory/{id}','App\Http\Controllers\admincontroller@delete_subcategory')->name('delete_subcategory');
Route::get('search-subcategory','App\Http\Controllers\admincontroller@searchSubcategory')->name('search_subcategory');

Route::get('delete_category/{id}','App\Http\Controllers\admincontroller@delete_category')->name('delete_category');
Route::get('delete_category/{id}','App\Http\Controllers\admincontroller@delete_category')->name('delete_category');
Route::get('employee-advance-due','App\Http\Controllers\admincontroller@employeeAdvanceDue')->name('employee.advance.due');
Route::get('employee-salary-due','App\Http\Controllers\admincontroller@employeeSalaryDue')->name('employee.salary.due');
Route::get('employee-salary-due-id/{id}','App\Http\Controllers\admincontroller@employeeSalaryDueId')->name('employee.salary.due.id');
Route::get('/admin/employee/details/{id}', 'App\Http\Controllers\admincontroller@employeeDetails')->name('admin.employee.details');


Route::get('about','App\Http\Controllers\admincontroller@about')->name('about');
Route::post('submit_about','App\Http\Controllers\admincontroller@submit_about')->name('submit_about');
Route::post('update_about','App\Http\Controllers\admincontroller@update_about')->name('update_about');
Route::get('delete_about/{id}','App\Http\Controllers\admincontroller@delete_about')->name('delete_about');


Route::get('service','App\Http\Controllers\admincontroller@service')->name('service');
Route::post('submit_service','App\Http\Controllers\admincontroller@submit_service')->name('submit_service');
Route::post('update_service','App\Http\Controllers\admincontroller@update_service')->name('update_service');
Route::get('delete_service/{id}','App\Http\Controllers\admincontroller@delete_service')->name('delete_service');

Route::get('banner','App\Http\Controllers\admincontroller@banner')->name('banner');
Route::post('submit_banner','App\Http\Controllers\admincontroller@submit_banner')->name('submit_banner');
Route::post('update_banner','App\Http\Controllers\admincontroller@update_banner')->name('update_banner');
Route::get('delete_banner/{id}','App\Http\Controllers\admincontroller@delete_banner')->name('delete_banner');


Route::get('products','App\Http\Controllers\admincontroller@products')->name('products');
Route::post('submit_product','App\Http\Controllers\admincontroller@submit_product')->name('submit_product');
Route::get('addproducts','App\Http\Controllers\admincontroller@addproducts')->name('addproducts');
Route::post('update_product','App\Http\Controllers\admincontroller@update_product')->name('update_product');
Route::get('delete_product/{id}','App\Http\Controllers\admincontroller@delete_product')->name('delete_product');
Route::post('show','App\Http\Controllers\admincontroller@show')->name('show');
Route::get('product_updates/{id}','App\Http\Controllers\admincontroller@product_updates')->name('product_updates');


Route::get('add_contact','App\Http\Controllers\admincontroller@add_contact')->name('add_contact');
Route::post('submit_add_contact','App\Http\Controllers\admincontroller@submit_add_contact')->name('submit_add_contact');
Route::post('update_add_contact','App\Http\Controllers\admincontroller@update_add_contact')->name('update_add_contact');
Route::get('delete_add_contact/{id}','App\Http\Controllers\admincontroller@delete_add_contact')->name('delete_add_contact');

Route::get('contactus','App\Http\Controllers\admincontroller@contactus')->name('contactus');
Route::get('all_rating','App\Http\Controllers\admincontroller@all_rating')->name('all_rating');
Route::get('free_consultations','App\Http\Controllers\admincontroller@free_consultations')->name('free_consultations');

Route::get('change_password','App\Http\Controllers\admincontroller@change_password')->name('change_password');
Route::post('update_password','App\Http\Controllers\admincontroller@update_password')->name('update_password');

Route::get('privacy_policy','App\Http\Controllers\admincontroller@privacy_policy')->name('privacy_policy');
Route::post('submit_privacy_policy','App\Http\Controllers\admincontroller@submit_privacy_policy')->name('submit_privacy_policy');
Route::post('update_privacy_policy','App\Http\Controllers\admincontroller@update_privacy_policy')->name('update_privacy_policy');
Route::get('delete_privacy_policy/{id}','App\Http\Controllers\admincontroller@delete_privacy_policy')->name('delete_privacy_policy');


Route::get('term_condition','App\Http\Controllers\admincontroller@term_condition')->name('term_condition');
Route::post('submit_term_condition','App\Http\Controllers\admincontroller@submit_term_condition')->name('submit_term_condition');
Route::post('update_term_condition','App\Http\Controllers\admincontroller@update_term_condition')->name('update_term_condition');
Route::get('delete_term_condition/{id}','App\Http\Controllers\admincontroller@delete_term_condition')->name('delete_term_condition');


Route::get('hig_prof','App\Http\Controllers\admincontroller@hig_prof')->name('hig_prof');
Route::post('submit_hig_prof','App\Http\Controllers\admincontroller@submit_hig_prof')->name('submit_hig_prof');
Route::post('update_hig_prof','App\Http\Controllers\admincontroller@update_hig_prof')->name('update_hig_prof');
Route::get('delete_hig_prof/{id}','App\Http\Controllers\admincontroller@delete_hig_prof')->name('delete_hig_prof');


Route::get('requested_developer_details','App\Http\Controllers\admincontroller@requested_developer_details')->name('requested_developer_details');
Route::get('active_developer_details','App\Http\Controllers\admincontroller@active_developer_details')->name('active_developer_details');
Route::get('developer_details','App\Http\Controllers\admincontroller@developer_details')->name('developer_details');
Route::post('submit_developer_details','App\Http\Controllers\admincontroller@submit_developer_details')->name('submit_developer_details');
Route::post('update_developer_details','App\Http\Controllers\admincontroller@update_developer_details')->name('update_developer_details');
Route::get('delete_developer_details/{dev_id}','App\Http\Controllers\admincontroller@delete_developer_details')->name('delete_developer_details');
Route::get('developer_details_update/{dev_id}','App\Http\Controllers\admincontroller@developer_details_update')->name('developer_details_update');
Route::post('developer_available_update','App\Http\Controllers\admincontroller@developer_available_update')->name('developer_available_update');
Route::get('developer_login_status/{dev_id}','App\Http\Controllers\admincontroller@developer_login_status')->name('developer_login_status');
Route::get('developer_approve_status/{dev_id}','App\Http\Controllers\admincontroller@developer_approve_status')->name('developer_approve_status');
Route::get('developer_transaction_details/{dev_id}','App\Http\Controllers\admincontroller@developer_transaction_details')->name('developer_transaction_details');

Route::get('checkout_to_developer/{id}','App\Http\Controllers\admincontroller@checkout_to_developer')->name('checkout_to_developer');

Route::post('payment_initiate_to_developer/{id}','App\Http\Controllers\admincontroller@payment_initiate_to_developer')->name('payment_initiate_to_developer');
Route::post('amount_transfer','App\Http\Controllers\admincontroller@amount_transfer')->name('amount_transfer');
Route::get('transfer_thank_you','App\Http\Controllers\admincontroller@transfer_thank_you')->name('transfer_thank_you');



Route::get('requested_developer_profile_details/{dev_id}','App\Http\Controllers\admincontroller@requested_developer_profile_details')->name('requested_developer_profile_details');
Route::get('requested_bank_details/{dev_id}','App\Http\Controllers\admincontroller@requested_bank_details')->name('requested_bank_details');
Route::get('requested_project_details/{dev_id}','App\Http\Controllers\admincontroller@requested_project_details')->name('requested_project_details');

Route::get('License','App\Http\Controllers\admincontroller@License')->name('License');
Route::post('submit_License','App\Http\Controllers\admincontroller@submit_License')->name('submit_License');
Route::post('update_License','App\Http\Controllers\admincontroller@update_License')->name('update_License');
Route::get('delete_License/{id}','App\Http\Controllers\admincontroller@delete_License')->name('delete_License');


Route::get('faqs','App\Http\Controllers\admincontroller@faqs')->name('faqs');
Route::post('submit_faqs','App\Http\Controllers\admincontroller@submit_faqs')->name('submit_faqs');
Route::post('update_faqs','App\Http\Controllers\admincontroller@update_faqs')->name('update_faqs');
Route::get('delete_faqs/{id}','App\Http\Controllers\admincontroller@delete_faqs')->name('delete_faqs');

Route::get('blog','App\Http\Controllers\admincontroller@blog')->name('blog');
Route::post('submit_blog','App\Http\Controllers\admincontroller@submit_blog')->name('submit_blog');
Route::post('update_blog','App\Http\Controllers\admincontroller@update_blog')->name('update_blog');
Route::get('delete_blog/{id}','App\Http\Controllers\admincontroller@delete_blog')->name('delete_blog');


Route::get('customer_details','App\Http\Controllers\admincontroller@customer_details')->name('customer_details');
Route::get('product_order','App\Http\Controllers\admincontroller@product_order')->name('product_order');
Route::get('developer_order','App\Http\Controllers\admincontroller@developer_order')->name('developer_order');

Route::get('developer_project_details','App\Http\Controllers\admincontroller@developer_project_details')->name('developer_project_details');
Route::post('submit_developer_project_details','App\Http\Controllers\admincontroller@submit_developer_project_details')->name('submit_developer_project_details');
Route::post('update_developer_project_details','App\Http\Controllers\admincontroller@update_developer_project_details')->name('update_developer_project_details');
Route::get('delete_developer_project_details/{developer_id}','App\Http\Controllers\admincontroller@delete_developer_project_details')->name('delete_developer_project_details');
Route::get('premium_developer','App\Http\Controllers\admincontroller@premium_developer')->name('premium_developer');
Route::get('interview_schedule_developer','App\Http\Controllers\admincontroller@interview_schedule_developer')->name('interview_schedule_developer');
Route::post('send_interview_link','App\Http\Controllers\admincontroller@send_interview_link')->name('send_interview_link');

Route::post('developer_status','App\Http\Controllers\admincontroller@developer_status')->name('developer_status');

Route::get('web_setting','App\Http\Controllers\admincontroller@web_setting')->name('web_setting');
Route::post('update_web_setting','App\Http\Controllers\admincontroller@update_web_setting')->name('update_web_setting');


Route::get('resoure_details','App\Http\Controllers\admincontroller@resoure_details')->name('resoure_details');

Route::get('require_docs_details/{u_id}/{dev_id}','App\Http\Controllers\admincontroller@require_docs_details')->name('require_docs_details');
Route::get('require_download/{id}','App\Http\Controllers\admincontroller@require_download')->name('require_download');
Route::get('short_message_details/{u_id}/{dev_id}','App\Http\Controllers\admincontroller@short_message_details')->name('short_message_details');
Route::get('sow_details/{u_id}/{dev_id}','App\Http\Controllers\admincontroller@sow_details')->name('sow_details');
Route::get('sow_download/{id}','App\Http\Controllers\admincontroller@sow_download')->name('sow_download');

Route::get('live_chat','App\Http\Controllers\admincontroller@live_chat')->name('live_chat');


Route::get('refund','App\Http\Controllers\admincontroller@refund')->name('refund');
Route::post('submit_refund','App\Http\Controllers\admincontroller@submit_refund')->name('submit_refund');
Route::post('update_refund','App\Http\Controllers\admincontroller@update_refund')->name('update_refund');
Route::get('delete_refund/{id}','App\Http\Controllers\admincontroller@delete_refund')->name('delete_refund');

Route::get('all_visitor','App\Http\Controllers\admincontroller@all_visitor')->name('all_visitor');

Route::get('education_updates_details/{dev_id}','App\Http\Controllers\admincontroller@education_updates_details')->name('education_updates_details');
Route::post('education_updates','App\Http\Controllers\admincontroller@education_updates')->name('education_updates');

Route::get('commission','App\Http\Controllers\admincontroller@commission')->name('commission');
Route::post('submit_commission','App\Http\Controllers\admincontroller@submit_commission')->name('submit_commission');
Route::post('update_commission','App\Http\Controllers\admincontroller@update_commission')->name('update_commission');
Route::get('delete_commission/{id}','App\Http\Controllers\admincontroller@delete_commission')->name('delete_commission');

Route::get('sow_project_details/{sow_id}','App\Http\Controllers\admincontroller@sow_project_details')->name('sow_project_details');

Route::get('request_for_reward','App\Http\Controllers\admincontroller@request_for_reward')->name('request_for_reward');
Route::post('withdraw_status_submit','App\Http\Controllers\admincontroller@withdraw_status_submit')->name('withdraw_status_submit');

Route::get('web_hosting','App\Http\Controllers\admincontroller@web_hosting')->name('web_hosting');
Route::post('submit_web_hosting','App\Http\Controllers\admincontroller@submit_web_hosting')->name('submit_web_hosting');
Route::post('update_web_hosting','App\Http\Controllers\admincontroller@update_web_hosting')->name('update_web_hosting');
Route::get('delete_web_hosting/{id}','App\Http\Controllers\admincontroller@delete_web_hosting')->name('delete_web_hosting');

Route::get('premium','App\Http\Controllers\admincontroller@premium')->name('premium');
Route::post('premium','App\Http\Controllers\admincontroller@premiumId')->name('premium_id');
Route::post('premium-points-store','App\Http\Controllers\admincontroller@premiumPointsStore')->name('premium_points_store');
Route::post('premium-points-update','App\Http\Controllers\admincontroller@premiumPointsUpdate')->name('premium_points_update');
Route::post('premium-points-delete','App\Http\Controllers\admincontroller@premiumPointsDelete')->name('premium_points_delete');

Route::post('premium-price-store','App\Http\Controllers\admincontroller@premiumPriceStore')->name('premium_price_store');
Route::post('send-email-notification','App\Http\Controllers\admincontroller@sendEmail')->name('send.email.notification');

// Employers admin end routes 
Route::get('employers', [EmployerController::class, 'index'])->name('employer.list');
Route::get('user/status-toggle/{id}', [EmployerController::class, 'toggleStatus'])->name('toggle_user_status');

Route::get('/export-report-employer','App\Http\Controllers\admincontroller@reportEmployerExcel')->name('admin.report.employer');
Route::get('/export-report-developer','App\Http\Controllers\admincontroller@reportDeveloperExcel')->name('admin.report.developer');


// Route::post('/college-status','App\Http\Controllers\admincontroller@collegeStatus')->name('college.status');
// Route::get('/college-create','App\Http\Controllers\admincontroller@collegeCreate')->name('college.create');

Route::get('/college','App\Http\Controllers\admincontroller@showCollege')->name('admin.college.index');
Route::get('/college/create', 'App\Http\Controllers\admincontroller@collegeCreate')->name('admin.college.create');
Route::post('/college', 'App\Http\Controllers\admincontroller@collegeStore')->name('admin.college.store');
Route::get('/college/{id}/edit', 'App\Http\Controllers\admincontroller@collegeEdit')->name('admin.college.edit');
Route::post('/college/update', 'App\Http\Controllers\admincontroller@collegeUpdate')->name('admin.college.update');
Route::post('/college/status', 'App\Http\Controllers\admincontroller@collegeUpdateStatus')->name('admin.college.status');
Route::delete('/college/{id}', 'App\Http\Controllers\admincontroller@collegeDestroy')->name('admin.college.destroy');

/*
---------------------------------------------------------------------------------------------------------
........................................ Developer Panel Routes Section......................................
---------------------------------------------------------------------------------------------------------
*/

Route::get('developer_registration','App\Http\Controllers\developercontroller@developer_registration')->name('developer_registration');
Route::post('submit_developer_registration','App\Http\Controllers\developercontroller@submit_developer_registration')->name('submit_developer_registration');
Route::get('developer_admin','App\Http\Controllers\developercontroller@developer_admin')->name('developer_admin');
Route::post('login_verification','App\Http\Controllers\developercontroller@login_verification')->name('login_verification');
// forget password routes 
Route::get('developer-forget-password-form', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('dvlprFrgtPassForm');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password-reset-form/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset.form');
Route::post('password-new-set', [ResetPasswordController::class, 'reset'])->name('password.new.set');


Route::get('developer_dashboard','App\Http\Controllers\developercontroller@developer_dashboard')->name('developer_dashboard');
Route::get('developer_log','App\Http\Controllers\developercontroller@developer_log')->name('developer_log');

Route::get('developer_change_password','App\Http\Controllers\developercontroller@developer_change_password')->name('developer_change_password');
Route::post('developer_update_password','App\Http\Controllers\developercontroller@developer_update_password')->name('developer_update_password');

Route::get('developer_profile','App\Http\Controllers\developercontroller@developer_profile')->name('developer_profile');
Route::get('developer_profile_update_details','App\Http\Controllers\developercontroller@developer_profile_update_details')->name('developer_profile_update_details');
Route::post('developer_profile_update','App\Http\Controllers\developercontroller@developer_profile_update')->name('developer_profile_update');
Route::get('developer_interview_schedule_details','App\Http\Controllers\developercontroller@developer_interview_schedule_details')->name('developer_interview_schedule_details');

Route::get('why_premium_purchase','App\Http\Controllers\developercontroller@why_premium_purchase')->name('why_premium_purchase');
Route::get('premium_purchase_checkout','App\Http\Controllers\developercontroller@premium_purchase_checkout')->name('premium_purchase_checkout');
//Route::post('premium_payment_initiate/{dev_id}','App\Http\Controllers\developercontroller@premium_payment_initiate')->name('premium_payment_initiate');
Route::post('premium_payment_initiate','App\Http\Controllers\developercontroller@premium_payment_initiate')->name('premium_payment_initiate');
Route::post('premium_checkout','App\Http\Controllers\developercontroller@premium_checkout')->name('premium_checkout');
Route::get('premium_thank_you','App\Http\Controllers\developercontroller@premium_thank_you')->name('premium_thank_you');

Route::get('developer_kyc','App\Http\Controllers\developercontroller@developer_kyc')->name('developer_kyc');
Route::post('add_developer_kyc','App\Http\Controllers\developercontroller@add_developer_kyc')->name('add_developer_kyc');
Route::get('update_developer_kyc_details/{id}','App\Http\Controllers\developercontroller@update_developer_kyc_details')->name('update_developer_kyc_details');
Route::post('update_developer_kyc','App\Http\Controllers\developercontroller@update_developer_kyc')->name('update_developer_kyc');

Route::get('bank_details','App\Http\Controllers\developercontroller@bank_details')->name('bank_details');
Route::post('add_bank_details','App\Http\Controllers\developercontroller@add_bank_details')->name('add_bank_details');
Route::get('update_developer_bank_details/{id}','App\Http\Controllers\developercontroller@update_developer_bank_details')->name('update_developer_bank_details');
Route::post('update_developer_bank','App\Http\Controllers\developercontroller@update_developer_bank')->name('update_developer_bank');

Route::get('developer_project','App\Http\Controllers\developercontroller@developer_project')->name('developer_project');
Route::post('submit_project_details','App\Http\Controllers\developercontroller@storeOrUpdateProjectDetails')->name('storeOrUpdateProjectDetails');
// Route::post('update_project_details','App\Http\Controllers\developercontroller@update_project_details')->name('update_project_details');
Route::get('delete_project_details/{developer_id}','App\Http\Controllers\developercontroller@delete_project_details')->name('delete_project_details');
Route::get('payment/success','App\Http\Controllers\developercontroller@paymentSuccess')->name('payment.success');


Route::get('work_space','App\Http\Controllers\developercontroller@work_space')->name('work_space');
Route::post('work_show','App\Http\Controllers\developercontroller@work_show')->name('work_show');

Route::post('add_work_space_error','App\Http\Controllers\developercontroller@add_work_space_error')->name('add_work_space_error');
Route::post('add_work_space','App\Http\Controllers\developercontroller@add_work_space')->name('add_work_space');
Route::get('work_space_updates/{id}','App\Http\Controllers\developercontroller@work_space_updates')->name('work_space_updates');
Route::post('work_space_details_updates','App\Http\Controllers\developercontroller@work_space_details_updates')->name('work_space_details_updates');
Route::get('delete_work_space/{id}','App\Http\Controllers\developercontroller@delete_work_space')->name('delete_work_space');

Route::get('developer_resource','App\Http\Controllers\developercontroller@developer_resource')->name('developer_resource');
Route::get('developer-premium','App\Http\Controllers\developercontroller@developerPremium')->name('developer_premium');
Route::post('developer-premium-pay','App\Http\Controllers\developercontroller@developerPremiumPay')->name('developer_premium_pay');

Route::get('developer_require_docs/{dev_id}/{u_id}','App\Http\Controllers\developercontroller@developer_require_docs')->name('developer_require_docs');
Route::get('developer_require_download/{id}','App\Http\Controllers\developercontroller@developer_require_download')->name('developer_require_download');

Route::get('developer_short_message/{dev_id}/{u_id}','App\Http\Controllers\developercontroller@developer_short_message')->name('developer_short_message');
Route::post('developer_short_message_reply','App\Http\Controllers\developercontroller@developer_short_message_reply')->name('developer_short_message_reply');


Route::get('developer_sow_docs/{dev_id}/{u_id}','App\Http\Controllers\developercontroller@developer_sow_docs')->name('developer_sow_docs');
Route::get('developer_sow_download/{id}','App\Http\Controllers\developercontroller@developer_sow_download')->name('developer_sow_download');


Route::get('developer_create_milestone/{u_id}/{dev_id}','App\Http\Controllers\developercontroller@developer_create_milestone')->name('developer_create_milestone');
Route::post('developer_submit_milestone','App\Http\Controllers\developercontroller@developer_submit_milestone')->name('developer_submit_milestone');
Route::get('developer_milestone_details/{sow_id}','App\Http\Controllers\developercontroller@developer_milestone_details')->name('developer_milestone_details');
Route::post('developer_update_milestone','App\Http\Controllers\developercontroller@developer_update_milestone')->name('developer_update_milestone');
Route::get('developer_delete_milestone/{id}','App\Http\Controllers\developercontroller@developer_delete_milestone')->name('developer_delete_milestone');

// Route::post('milestone_status','App\Http\Controllers\developercontroller@milestone_status')->name('milestone_status');

Route::get('developer_milestone_accept/{sow_value}/{id}','App\Http\Controllers\developercontroller@developer_milestone_accept')->name('developer_milestone_accept');
Route::post('developer_milestone_reject/{sow_value}/{id}','App\Http\Controllers\developercontroller@developer_milestone_reject')->name('developer_milestone_reject');


Route::get('developer_milestone_pdf_download/{id}','App\Http\Controllers\developercontroller@developer_milestone_pdf_download')->name('developer_milestone_pdf_download');

Route::post('submit_complition_request','App\Http\Controllers\developercontroller@submit_complition_request')->name('submit_complition_request');

Route::get('sow_approve/{id}/{sow_value}','App\Http\Controllers\developercontroller@sow_approve')->name('sow_approve');

Route::get('developer_milestone_project_details/{sow_id}','App\Http\Controllers\developercontroller@developer_milestone_project_details')->name('developer_milestone_project_details');

Route::post('developer_available_date_update','App\Http\Controllers\developercontroller@developer_available_date_update')->name('developer_available_date_update');
Route::post('developer_available_date_update_error','App\Http\Controllers\developercontroller@developer_available_date_update_error')->name('developer_available_date_update_error');

Route::get('profile_education_update_Details/{dev_id}','App\Http\Controllers\developercontroller@profile_education_update_Details')->name('profile_education_update_Details');
Route::post('education_profile_update','App\Http\Controllers\developercontroller@education_profile_update')->name('education_profile_update');

Route::get('all_transaction_details','App\Http\Controllers\developercontroller@all_transaction_details')->name('all_transaction_details');
Route::get('transaction_product_details/{p_id}','App\Http\Controllers\developercontroller@transaction_product_details')->name('transaction_product_details');


Route::get('wallet_details','App\Http\Controllers\developercontroller@wallet_details')->name('wallet_details');

Route::get('withdraw/{milestone_id}','App\Http\Controllers\developercontroller@withdraw')->name('withdraw');
Route::post('withdraw_payment','App\Http\Controllers\developercontroller@withdraw_payment')->name('withdraw_payment');
// subscription plan for employer
Route::resource('subscription_plans', SubscriptionPlanController::class);
Route::get('upgrade-plan', 'App\Http\Controllers\userController@upgradePlan')->name('upgrade_plan');

// razorpay rotues 
Route::post('razorpay-process', [RazorpayPaymentController::class, 'processPayment'])->name('razorpay.process');
Route::post('razorpay-process-response', [RazorpayPaymentController::class, 'processResponse']);

/*
---------------------------------------------------------------------------------------------------------
........................................ Client Routes Section......................................
---------------------------------------------------------------------------------------------------------
*/


Route::get('client_index','App\Http\Controllers\clientcontroller@client_index')->name('client_index');
Route::post('client_login','App\Http\Controllers\clientcontroller@client_login')->name('client_login');
Route::get('client_dashboard','App\Http\Controllers\clientcontroller@client_dashboard')->name('client_dashboard');
Route::get('client_logout','App\Http\Controllers\clientcontroller@client_logout')->name('client_logout');

Route::get('client_profile','App\Http\Controllers\clientcontroller@client_profile')->name('client_profile');
Route::post('client_profile_update','App\Http\Controllers\clientcontroller@client_profile_update')->name('client_profile_update');

Route::get('client_change_password','App\Http\Controllers\clientcontroller@client_change_password')->name('client_change_password');
Route::post('client_update_password','App\Http\Controllers\clientcontroller@client_update_password')->name('client_update_password');

Route::get('client_resource','App\Http\Controllers\clientcontroller@client_resource')->name('client_resource');
Route::get('client_ongoing_resource','App\Http\Controllers\clientcontroller@client_ongoing_resource')->name('client_ongoing_resource');
Route::get('client_completed_resource','App\Http\Controllers\clientcontroller@client_completed_resource')->name('client_completed_resource');

Route::get('client_require_docs/{id}/{u_id}','App\Http\Controllers\clientcontroller@client_require_docs')->name('client_require_docs');
Route::get('client_require_download/{id}','App\Http\Controllers\clientcontroller@client_require_download')->name('client_require_download');

Route::get('client_short_message/{id}/{u_id}','App\Http\Controllers\clientcontroller@client_short_message')->name('client_short_message');
Route::get('client_short_message_reply/{id}','App\Http\Controllers\clientcontroller@client_short_message_reply')->name('client_short_message_reply');

Route::get('client_sow/{id}/{u_id}','App\Http\Controllers\clientcontroller@client_sow')->name('client_sow');
Route::get('client_sow_download/{id}','App\Http\Controllers\clientcontroller@client_sow_download')->name('client_sow_download');

Route::post('create_milestone','App\Http\Controllers\clientcontroller@create_milestone')->name('create_milestone');

Route::get('milestone_project_details/{sow_id}','App\Http\Controllers\clientcontroller@milestone_project_details')->name('milestone_project_details');

Route::get('milestone/{u_id}/{dev_id}','App\Http\Controllers\clientcontroller@milestone')->name('milestone');
Route::post('submit_milestone','App\Http\Controllers\clientcontroller@submit_milestone')->name('submit_milestone');
Route::get('show_milestone/{sow_id}','App\Http\Controllers\clientcontroller@show_milestone')->name('show_milestone');
Route::post('update_milestone','App\Http\Controllers\clientcontroller@update_milestone')->name('update_milestone');
Route::get('delete_milestone/{id}','App\Http\Controllers\clientcontroller@delete_milestone')->name('delete_milestone');

Route::get('milestone_accept/{sow_value}/{id}','App\Http\Controllers\clientcontroller@milestone_accept')->name('milestone_accept');
Route::post('milestone_reject/{sow_value}/{id}','App\Http\Controllers\clientcontroller@milestone_reject')->name('milestone_reject');


Route::get('milestone_approve/{id}','App\Http\Controllers\clientcontroller@milestone_approve')->name('milestone_approve');
Route::get('milestone_pdf_download/{id}','App\Http\Controllers\clientcontroller@milestone_pdf_download')->name('milestone_pdf_download');

Route::get('completion_approve/{id}','App\Http\Controllers\clientcontroller@completion_approve')->name('completion_approve');
Route::post('completion_disapprove_reason','App\Http\Controllers\clientcontroller@completion_disapprove_reason')->name('completion_disapprove_reason');

Route::post('developer_rating','App\Http\Controllers\clientcontroller@developer_rating')->name('developer_rating');

Route::get('client_advance_payment/{sow_id}','App\Http\Controllers\clientcontroller@client_advance_payment')->name('client_advance_payment');
Route::post('advance_payment','App\Http\Controllers\clientcontroller@advance_payment')->name('advance_payment');
Route::get('hire-developers-list','App\Http\Controllers\clientcontroller@hiredDevelopersList')->name('hiredDevelopersList');

Route::get('client/kyc','App\Http\Controllers\clientcontroller@kycForm')->name('kycForm');
Route::post('client/kyc/store', 'App\Http\Controllers\clientcontroller@kycStore')->name('kycStore');
Route::get('client/bank-details','App\Http\Controllers\clientcontroller@bankForm')->name('bankForm');
Route::post('client/bank-details/store', 'App\Http\Controllers\clientcontroller@bankStore')->name('bankFormSave');
/*
---------------------------------------------------------------------------------------------------------
........................................ Export Routes Section......................................
---------------------------------------------------------------------------------------------------------
*/

Route::get('export','App\Http\Controllers\Mycontroller@export')->name('export');


/*
---------------------------------------------------------------------------------------------------------
........................................ Chat Routes Section......................................
---------------------------------------------------------------------------------------------------------
*/

Route::post('submit_chat','App\Http\Controllers\ChatController@submit_chat')->name('submit_chat');

Route::get('payment','App\Http\Controllers\userController@payment');
Route::get('/pay-advance/{order_id}}', 'App\Http\Controllers\userController@processAdvance')->name('payment.advance');
Route::post('/verify-payment', 'App\Http\Controllers\userController@verifyPayment')->name('verify.payment');


Route::get('/check-monthly-payments', 'App\Http\Controllers\userController@checkMonthlyPayments')->name('check.monthly.payments');
Route::get('/pay-salary-payment/{id}', 'App\Http\Controllers\userController@processSalaryPayment')->name('pay.salary.payment');
Route::post('/verify-salary-payment', 'App\Http\Controllers\userController@verifySalaryPayment')->name('verify.salary.payment');

Route::get('/export-employee-payout', 'App\Http\Controllers\admincontroller@getEmployeePayout')->name('admin.employee.export');
Route::get('/export-active-developer-details', 'App\Http\Controllers\admincontroller@activeDeveloperDetails')->name('active.developer.details.export');
Route::get('/export-premium-developer', 'App\Http\Controllers\admincontroller@premiumDeveloperExcel')->name('premium.developer.export');
Route::get('/export-resoure-details', 'App\Http\Controllers\admincontroller@resoureDetailsExcel')->name('resoure.details.export');

Route::get('/export-employers', [EmployerController::class, 'exportEmployers'])->name('export.employers');

Route::get('/admin-send-mail', 'App\Http\Controllers\admincontroller@sendMail')->name('admin.send.mail');
Route::post('/admin-send-mail-save', 'App\Http\Controllers\admincontroller@sendMailSave')->name('admin.send.mail.save');






Route::get('/college/login', [CollegeController::class, 'index'])->name('college.login');
Route::post('/college/login', [CollegeController::class, 'store'])->name('college.login');
Route::get('/college/dashboard', [CollegeController::class, 'dashboard'])->name('college.dashboard');
Route::get('/college/developers/index', [CollegeController::class, 'developersIndex'])->name('college.developers.index');
Route::get('/college/developers/create', [CollegeController::class, 'developersCreate'])->name('college.developers.create');
Route::post('/college/developers/store', [CollegeController::class, 'developersStore'])->name('college.developers.store');


Route::get('/college/dashboard/stats', [CollegeController::class, 'dashboardStats'])->name('college.dashboard.stats');
Route::get('/college/developers/show', [CollegeController::class, 'developersShow'])->name('college.developers.show');
Route::get('/college/developers/edit', [CollegeController::class, 'developersEdit'])->name('college.developers.edit');

Route::get('/college/developers/toggle-status', [CollegeController::class, 'developersToggleStatus'])->name('college.developers.toggle-status');
