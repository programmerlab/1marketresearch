<?php

declare(strict_types=1);

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Input;
use Modules\Admin\Helpers\Helper as Helper;
use Modules\Admin\Http\Requests\SettingRequest;
use Modules\Admin\Models\Category;
use Modules\Admin\Models\Product;
use Modules\Admin\Models\Settings;
use Modules\Admin\Models\User;
use Route;
use URL;
use View;
use Html;

/**
 * Class AdminController
 */
class SettingsController extends Controller
{
    /**
     * @var  Repository
     */

    /**
     * Displays all admin.
     *
     * @return \Illuminate\View\View
     */
    public function __construct()
    {
        $this->middleware('admin');
        View::share('viewPage', 'setting');
        View::share('helper', new Helper);
        $this->record_per_page = Config::get('app.record_per_page');
        View::share('route_url', route('setting'));
        View::share('heading', 'Website Settings');
    }

    protected $categories;

    /*
     * Dashboard
     * */

    public function index(Settings $setting, Request $request)
    {
        $page_title  = 'Setting';
        $page_action = 'View Setting';

        $website_title      = $setting::where('field_key', 'website_title')->first();
        $website_email      = $setting::where('field_key', 'website_email')->first();
        $website_url        = $setting::where('field_key', 'website_url')->first();
        $contact_number     = $setting::where('field_key', 'contact_number')->first();
        $company_address    = $setting::where('field_key', 'company_address')->first();

        $banner             = $setting::where('field_key', 'LIKE', '%banner_image%')->get();


        $setting     = Settings::first();
        $web_setting =  Settings::all();

        if ($setting) {
            $setting->id;
        } else {
            return Redirect::to(route('setting.create'));
        }
        foreach ($web_setting as $key => $value) {
             $key_name = $value->field_key;

            $setting->$key_name = $value->field_value;
        }

        return view('packages::setting.edit', compact('setting', 'website_title', 'website_email', 'website_url', 'contact_number', 'company_address', 'banner', 'page_title', 'page_action', 'helper'));
    }

    /*
     * create  method
     * */

    public function create(Settings $setting)
    {
        $page_title  = 'Setting';
        $page_action = 'Create Setting';
        $setting     = Settings::first();

        if ($setting) {
            return Redirect::to(URL::previous());
        }
        $website_title      = $setting::where('field_key', 'website_title')->first();
        $website_email      = $setting::where('field_key', 'website_email')->first();
        $website_url        = $setting::where('field_key', 'website_url')->first();
        $contact_number     = $setting::where('field_key', 'contact_number')->first();
        $company_address    = $setting::where('field_key', 'company_address')->first();

        $banner             = $setting::where('field_key', 'LIKE', '%banner_image%')->get();


        return view('packages::setting.create', compact('setting', 'website_title', 'website_email', 'website_url', 'contact_number', 'company_address', 'banner', 'page_title', 'page_action', 'helper'));
    }

    /*
     * Save Group method
     * */

    public function store(SettingRequest $request, Settings $setting)
    {
        foreach ($request->except('_token') as $key => $value) {
            $setting = Settings::firstOrCreate(['field_key' => $key]);

            $setting->field_key     =   $key;
            $setting->field_value   =   $value;
            $setting->save();


            if ($request->file($key)) {
                $photo           = $request->file($key);
                $destinationPath = storage_path('files/banner/');
                $photo->move($destinationPath, time() . $photo->getClientOriginalName());
                $banner_image1 = time() . $photo->getClientOriginalName();

                $setting = Settings::firstOrCreate(['field_key' => $key]);

                $setting->field_key     =   $key;
                $setting->field_value   =   $banner_image1;
                $setting->save();
            }
        }



        return Redirect::to(route('setting'))
            ->with('flash_alert_notice2', 'Site settigs was successfully created !');
    }
    /*
     * Edit Group method
     * @param
     * object : $category
     * */

    public function edit(Settings $settings)
    {
        $page_title  = 'Setting';
        $page_action = 'Show Setting';
        $category    = Category::all();
        $cat         = [];
        foreach ($category as $key => $value) {
            $cat[$value->category_name][$value->id] =  $value->sub_category_name;
        }

        $categories =  Category::attr(['name' => 'product_category','class' => 'form-control form-cascade-control input-small'])
            ->selected(['id' => $product->product_category])
            ->renderAsDropdown();

        return view('packages::setting.edit', compact('categories', 'product', 'page_title', 'page_action'));
    }

    public function update(Request $request, Settings $setting)
    {
        foreach ($request->except('_token') as $key => $value) {
            $setting                = Settings::firstOrCreate(['field_key' => $key]);
            $setting->field_key     =   $key;
            $setting->field_value   =   $value;
            $setting->save();

            if ($request->file($key)) {
                $photo           = $request->file($key);
                $destinationPath = storage_path('uploads/img/');
                $photo->move($destinationPath, time() . $photo->getClientOriginalName());
                $banner_image1 = time() . $photo->getClientOriginalName();

                $setting = Settings::firstOrCreate(['field_key' => $key]);

                $setting->field_key     =   $key;
                $setting->field_value   =   $banner_image1;

                $google_analytics_code = HTML::entities(Input::get('google_analytics_code'));

                if ($google_analytics_code) {
                    $setting->google_analytics_code = $google_analytics_code ;
                }

                $setting->save();
            }
        }

        return Redirect::to(route('setting'))
            ->with('flash_alert_notice', 'Site settigs was saved!');
    }
    /*
     *Delete User
     * @param ID
     *
     */
    public function destroy(Request $request, $id)
    {
        Product::where('id', $id)->delete();

        return Redirect::to(route('setting'))
            ->with('flash_alert_notice', 'Product was successfully deleted!');
    }

    public function show(Settings $setting)
    {
    }
}
