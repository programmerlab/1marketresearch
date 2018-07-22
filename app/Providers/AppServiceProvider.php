<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use Route;
use Modules\Admin\Models\Settings;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $controllers = [];

        foreach (Route::getRoutes()->getRoutes() as $route)
        {
            $action = $route->getAction();

            if (array_key_exists('controller', $action))
            {
                // You can also use explode('@', $action['controller']); here
                // to separate the class name from the method
                if(str_contains($action['controller'],'@index')){
                    $step1 = str_replace('Modules\Admin\Http\Controllers','',$action['controller']);    
                    $step2 = str_replace("@index", '', $step1);
                    $step3 = str_replace("Controller", '', $step2);
                    
                    $notArr = ['Auth','Admin','Role'];
                    if(in_array(ltrim($step3,'"\"'), $notArr))
                    {
                        continue;
                    }else{
                        $controllers[] = ltrim($step3,'"\"');
                    }
                }
                
            }
        }
        
        View::share('controllers',$controllers);



        $setting = Settings::first(); 
        $web_setting =  Settings::all(); 
        if($setting)
        {
            $setting->id;
        }else{
            return Redirect::to(route('setting.create'));
        }
        foreach ($web_setting as $key => $value) {
            $key_name = $value->field_key;
            $setting->$key_name = $value->field_value; 
        }

        View::share('setting', $setting);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
