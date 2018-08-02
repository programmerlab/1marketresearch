<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//use Redirect;
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With, auth-token');
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Origin: *");

Route::get('/', function () { 
    return redirect('home');
});

Route::get('/send', 'EmailController@sendMail');

Route::get('/sendEmailReminder', 'NotificationController@sendEmailReminder');


Route::match(['post','get'],'home',[
        'as' => 'homePage',
        'uses' => 'HomeController@home'
        ]
    );


/*
* Admin Based Auth
*/  
  

Route::get('/login','Adminauth\AuthController@showLoginForm'); 
//Route::post('password/reset','Adminauth\AuthController@resetPassword'); 
//Route::post('password/reset','ApiController@resetPassword');  

 Route::post('password/email','ApiController@resetPassword'); 
 Route::get('molpay','MolpayPaymentController@index'); 
 Route::post('molpay/return_ipn','MolpayPaymentController@return_ipn'); 
 Route::post('molpay/notification_ipn','MolpayPaymentController@notification_ipn'); 
 Route::get('molpay/payment/success','MolpayPaymentController@success'); 
 Route::post('molpay/payment/failed','MolpayPaymentController@failed'); 

Route::get('admin/404',function(){
    if(Auth::guard('admin')->check()==false){
        return redirect('admin');
    }

    $page_title = "404 Error";
              $page_action = "Page";
              $viewPage = "404 Error";
              $msg = "page not found";
              $error_msg = "Page not found!"; 
              return view('packages::auth.page_not_found',compact('error_msg','page_title','page_action','viewPage'))->with('flash_alert_notice', $msg);
});
