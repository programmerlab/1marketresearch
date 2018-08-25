<?php

declare(strict_types=1);

namespace Modules\Admin\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Modules\Admin\Models\Settings;
use View;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;


    /**
     * Displays all admin.
     *
     * @return \Illuminate\View\View
     */
    public function __construct()
    {
        $setting     = Settings::first();
        $web_setting =  Settings::all();

        if ($setting) {
            $setting->id;
        } else {
            return Redirect::to(route('setting.create'));
        }
        foreach ($web_setting as $key => $value) {
            $key_name           = $value->field_key;
            $setting->$key_name = $value->field_value;
        }

        View::share('setting', $setting);
    }
}
