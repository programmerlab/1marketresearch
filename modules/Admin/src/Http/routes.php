<?php
   
    Route::get('admin/login','Modules\Admin\Http\Controllers\AuthController@index');
    Route::get('admin/forgot-password','Modules\Admin\Http\Controllers\AuthController@forgetPassword');
    Route::post('password/email','Modules\Admin\Http\Controllers\AuthController@sendResetPasswordLink');
    Route::get('admin/password/reset','Modules\Admin\Http\Controllers\AuthController@resetPassword');  
    Route::get('admin/logout','Modules\Admin\Http\Controllers\AuthController@logout'); 

    
    Route::post('admin/blog/ajax', 'Modules\Admin\Http\Controllers\BlogController@ajax');

    Route::post('admin/login',function(App\Admin $user){
   
    $credentials = ['email' => Input::get('email'), 'password' => Input::get('password')]; 
    
   // $credentials = ['email' => 'kundan@gmail.com', 'password' => 123456]; 
    
   // $auth = auth()->guard('web');
   // Session::set('role','admin');
   
    $admin_auth = auth()->guard('admin'); 
    $user_auth =  auth()->guard('web'); //Auth::attempt($credentials); 

    if ($admin_auth->attempt($credentials) OR $user_auth->attempt($credentials)) {
            return Redirect::to('admin');
        }else{ 
            return redirect()
                        ->back()
                        ->withInput()  
                        ->withErrors(['message'=>'Invalid email or password. Try again!']);
            } 
    }); 


    Route::get('admin/supportTicket', 'Modules\Admin\Http\Controllers\ArticleTypeController@supportTicket')->name('supportTicket'); 

    Route::post('admin/supportTicket', 'Modules\Admin\Http\Controllers\ArticleTypeController@supportTicketAddreply')->name('supportTicket'); 
 
    
    Route::group(['middleware' => ['admin','userpermission']], function () {

        Route::get('admin', 'Modules\Admin\Http\Controllers\AdminController@index');
        
        /*------------User Model and controller---------*/

        Route::bind('user', function($value, $route) {
            return Modules\Admin\Models\User::find($value);
        });

        Route::resource('admin/user', 'Modules\Admin\Http\Controllers\UsersController', [
            'names' => [
                'edit' => 'user.edit',
                'show' => 'user.show',
                'destroy' => 'user.destroy',
                'update' => 'user.update',
                'store' => 'user.store',
                'index' => 'user',
                'create' => 'user.create',
            ]
                ]
        );
        Route::resource('admin/clientuser', 'Modules\Admin\Http\Controllers\ClientUsersController', [
            'names' => [
                'edit' => 'clientuser.edit',
                'show' => 'clientuser.show',
                'destroy' => 'clientuser.destroy',
                'update' => 'clientuser.update',
                'store' => 'clientuser.store',
                'index' => 'clientuser',
                'create' => 'clientuser.create',
            ]
                ]
        );


       
        /*------------User Category and controller---------*/

            Route::bind('category', function($value, $route) {
                return Modules\Admin\Models\Category::find($value);
            });
     
            Route::resource('admin/category', 'Modules\Admin\Http\Controllers\CategoryController', [
                'names' => [
                    'edit'      => 'category.edit',
                    'show'      => 'category.show',
                    'destroy'   => 'category.destroy',
                    'update'    => 'category.update',
                    'store'     => 'category.store',
                    'index'     => 'category',
                    'create'    => 'category.create',
                ]
                    ]
            );
        /*---------End---------*/   


        /*------------User Category and controller---------*/

            // Route::bind('sub-category', function($value, $route) {
            //     return Modules\Admin\Models\Category::find($value);
            // });
     
            // Route::resource('admin/sub-category', 'Modules\Admin\Http\Controllers\SubCategoryController', [
            //     'names' => [
            //         'edit' => 'sub-category.edit',
            //         'show' => 'sub-category.show',
            //         'destroy' => 'sub-category.destroy',
            //         'update' => 'sub-category.update',
            //         'store' => 'sub-category.store',
            //         'index' => 'sub-category',
            //         'create' => 'sub-category.create',
            //     ]
            //         ]
            // );
            
        /*---------Contact Route ---------*/    

        Route::bind('contact', function($value, $route) {
            return Modules\Admin\Models\Contact::find($value);
        });
 
        Route::resource('admin/contact', 'Modules\Admin\Http\Controllers\ContactController', [
            'names' => [
                'edit' => 'contact.edit',
                'show' => 'contact.show',
                'destroy' => 'contact.destroy',
                'update' => 'contact.update',
                'store' => 'contact.store',
                'index' => 'contact',
                'create' => 'contact.create',
            ]
                ]
        );  
 

        Route::post('admin/contact/import', 'Modules\Admin\Http\Controllers\ContactController@contactImport');

        Route::post('admin/reports/import', 'Modules\Admin\Http\Controllers\ReportController@csvImport');

 
        
        Route::get('admin/importExcel', 'Modules\Admin\Http\Controllers\ReportController@importExcel');

        Route::match(['get','post'],'admin/exportExcel', 'Modules\Admin\Http\Controllers\ReportController@importExcel');

        Route::match(['get','post'],'admin/excel/import', 'Modules\Admin\Http\Controllers\ReportController@excelImport');


        Route::bind('transaction', function($value, $route) {
            return Modules\Admin\Models\Transaction::find($value);
        });
 
        Route::resource('admin/transaction', 'Modules\Admin\Http\Controllers\TransactionController', [
            'names' => [
                'edit'      => 'transaction.edit',
                'show'      => 'transaction.show',
                'destroy'   => 'transaction.destroy',
                'update'    => 'transaction.update',
                'store'     => 'transaction.store',
                'index'     => 'transaction',
                'create'    => 'transaction.create',
            ]
                ]
        ); 

        Route::bind('setting', function($value, $route) {
            return Modules\Admin\Models\Settings::find($value);
        });
 
        Route::resource('admin/setting', 'Modules\Admin\Http\Controllers\SettingsController', [
            'names' => [
                'edit'      => 'setting.edit',
                'show'      => 'setting.show',
                'destroy'   => 'setting.destroy',
                'update'    => 'setting.update',
                'store'     => 'setting.store',
                'index'     => 'setting',
                'create'    => 'setting.create',
            ]
                ]
        ); 


        // Route::bind('blog', function($value, $route) {
        //     return Modules\Admin\Models\Blogs::find($value);
        // });
 
        // Route::resource('admin/blog', 'Modules\Admin\Http\Controllers\BlogController', [
        //     'names' => [
        //         'edit' => 'blog.edit',
        //         'show' => 'blog.show',
        //         'destroy' => 'blog.destroy',
        //         'update' => 'blog.update',
        //         'store' => 'blog.store',
        //         'index' => 'blog',
        //         'create' => 'blog.create',
        //     ]
        //         ]
        // );


        Route::bind('role', function($value, $route) {
            return App\Role::find($value);
        });
 
        Route::resource('admin/role', 'Modules\Admin\Http\Controllers\RoleController', [
            'names' => [
                'edit' => 'role.edit',
                'show' => 'role.show',
                'destroy' => 'role.destroy',
                'update' => 'role.update',
                'store' => 'role.store',
                'index' => 'role',
                'create' => 'role.create',
            ]
                ]
        );

       

        Route::bind('press', function($value, $route) {
            return Modules\Admin\Models\Press::find($value);
        });
 
        Route::resource('admin/press', 'Modules\Admin\Http\Controllers\PressController', [
            'names' => [
                'edit' => 'press.edit',
                'show' => 'press.show',
                'destroy' => 'press.destroy',
                'update' => 'press.update',
                'store' => 'press.store',
                'index' => 'press',
                'create' => 'press.create',
            ]
                ]
        );
        
		
        Route::bind('content', function($value, $route) {
            return Modules\Admin\Models\Pages::find($value);
        });
 
        Route::resource('admin/content', 'Modules\Admin\Http\Controllers\PageController', [
            'names' => [
                'edit' => 'content.edit',
                'show' => 'content.show',
                'destroy' => 'content.destroy',
                'update' => 'content.update',
                'store' => 'content.store',
                'index' => 'content',
                'create' => 'content.create',
            ]
                ]
        );

        // Route::bind('page', function($value, $route) {
        //     return Modules\Admin\Models\Pages::find($value);
        // });
 
        // Route::resource('admin/page', 'Modules\Admin\Http\Controllers\PageController', [
        //     'names' => [
        //         'edit' => 'page.edit',
        //         'show' => 'page.show',
        //         'destroy' => 'page.destroy',
        //         'update' => 'page.update',
        //         'store' => 'page.store',
        //         'index' => 'page',
        //         'create' => 'page.create',
        //     ]
        //         ]
        // );

        Route::bind('publisher', function($value, $route) {
            return Modules\Admin\Models\Publisher::find($value);
        });
 
        Route::resource('admin/publisher', 'Modules\Admin\Http\Controllers\PublisherController', [
            'names' => [
                'edit' => 'publisher.edit',
                'show' => 'publisher.show',
                'destroy' => 'publisher.destroy',
                'update' => 'publisher.update',
                'store' => 'publisher.store',
                'index' => 'publisher',
                'create' => 'publisher.create',
            ]
                ]
        );


        Route::bind('reports', function($value, $route) {
            return Modules\Admin\Models\Report::find($value);
        });
 
        Route::resource('admin/reports', 'Modules\Admin\Http\Controllers\ReportController', [
            'names' => [
                'edit' => 'reports.edit',
                'show' => 'reports.show',
                'destroy' => 'reports.destroy',
                'update' => 'reports.update',
                'store' => 'reports.store',
                'index' => 'reports',
                'create' => 'reports.create',
            ]
                ]
        );

        Route::bind('coupan', function($value, $route) {
            return Modules\Admin\Models\Coupan::find($value);
        });
 
        Route::resource('admin/coupan', 'Modules\Admin\Http\Controllers\CoupanController', [
            'names' => [
                'edit' => 'coupan.edit',
                'show' => 'coupan.show',
                'destroy' => 'coupan.destroy',
                'update' => 'coupan.update',
                'store' => 'coupan.store',
                'index' => 'coupan',
                'create' => 'coupan.create',
            ]
                ]
        );
	 
        Route::match(['get','post'],'admin/permission', 'Modules\Admin\Http\Controllers\RoleController@permission');

        /*----------End---------*/    
        
        Route::match(['get','post'],'admin/profile', 'Modules\Admin\Http\Controllers\AdminController@profile'); 
        
             
  });



 
 
     
 
  
