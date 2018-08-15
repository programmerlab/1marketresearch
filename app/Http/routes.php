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


Route::get('/send', 'EmailController@sendMail');

Route::get('/sendEmailReminder', 'NotificationController@sendEmailReminder');

 

Route::get('/404', 'HomeController@error404');

Route::post('/billing', 'HomeController@billing');
Route::post('/ordernote', 'HomeController@ordernote');
Route::post('/paymentSummary', 'HomeController@paymentSummary');

Route::get('/paypal', 'HomeController@paypal');

Route::get('/directBankTransfer', 'HomeController@directBankTransfer');


Route::match(['post','get'],'makeOrder',[
        'as' => 'makeOrder',
        'uses' => 'HomeController@makeOrder'
        ]
    );
 

Route::match(['post','get'],'saveForm',[
        'as' => 'saveForm',
        'uses' => 'HomeController@saveForm'
        ]
    );

Route::get('allError', 'HomeController@allError');

Route::match(['post','get'],'checkoutCoupon','HomeController@checkoutCoupon');


Route::match(['post','get'],'/',[
        'as' => 'homePage',
        'uses' => 'HomeController@home'
        ]
    );

Route::match(['post','get'],'research-categories',[
        'as' => 'research-categories',
        'uses' => 'HomeController@category'
        ]
    );


Route::match(['post','get'],'category/{name}',[
        'as' => 'categories',
        'uses' => 'HomeController@researchReports'
        ]
    );

Route::match(['post','get'],'research-reports',[
        'as' => 'researchReports',
        'uses' => 'HomeController@researchReports'
        ]
    );


Route::match(['post','get'],'services',[
        'as' => 'services',
        'uses' => 'HomeController@services'
        ]
    );


Route::match(['post','get'],'publisher',[
        'as' => 'publishers',
        'uses' => 'HomeController@publisher'
        ]
    );



Route::match(['post','get'],'market-reports',[
        'as' => 'marketReports',
        'uses' => 'HomeController@reportDetails'
        ]
    );


Route::match(['post','get'],'market-reports/{name}',[
        'as' => 'marketReports',
        'uses' => 'HomeController@reportDetails'
        ]
    );


Route::match(['post','get'],'payment',[
        'as' => 'payment',
        'uses' => 'HomeController@payment'
        ]
    );


Route::match(['post','get'],'contact',[
        'as' => 'contacts',
        'uses' => 'HomeController@contact'
        ]
    );

Route::match(['post','get'],'press-release/{name}',[
        'as' => 'press-release2',
        'uses' => 'HomeController@pressReleaseDetails'
        ]
    );
Route::match(['post','get'],'pressRelease',[
        'as' => 'press-release',
        'uses' => 'HomeController@pressRelease'
        ]
    );


Route::match(['post','get'],'askAnAnalyst',[
        'as' => 'askAnAnalyst',
        'uses' => 'HomeController@askAnAnalyst'
        ]
    );

Route::match(['post','get'],'requestSample',[
        'as' => 'requestSample',
        'uses' => 'HomeController@requestSample'
        ]
    );

Route::match(['post','get'],'requestBrochure ',[
        'as' => 'requestBrochure',
        'uses' => 'HomeController@requestBrochure'
        ]
    );



/*
* Admin Based Auth
*/  
  

Route::get('/login','Adminauth\AuthController@showLoginForm'); 
//Route::post('password/reset','Adminauth\AuthController@resetPassword'); 
//Route::post('password/reset','ApiController@resetPassword');  

 Route::post('password/email','ApiController@resetPassword'); 

Route::get('admin/404',function(){
    if(Auth::guard('admin')->check()==false){
        return redirect('admin');
    }else{
      $page_title = "404 Error";
              $page_action = "Page";
              $viewPage = "404 Error";
              $msg = "page not found";
              $error_msg = "Page not found!"; 
              return view('packages::auth.page_not_found',compact('error_msg','page_title','page_action','viewPage'))->with('flash_alert_notice', $msg);
    }

    
});

Route::match(['post','get'],'thankyou-{name}',[
        'as' => 'thankyou',
        'uses' => 'HomeController@thankyou'
        ]
    );

Route::match(['post','get'],'/{name}',[
        'as' => 'contentspage',
        'uses' => 'HomeController@page'
        ]
    );

