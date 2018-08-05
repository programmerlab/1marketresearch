<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use Route;
use Modules\Admin\Models\Settings;
use Modules\Admin\Models\Category;

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

        $catMenu = Category::all();

        if($catMenu){
            View::share('catMenu',$catMenu);
        }else{
            View::share('catMenu',null);
        }


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
