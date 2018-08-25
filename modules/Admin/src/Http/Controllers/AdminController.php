<?php

declare(strict_types=1);

namespace Modules\Admin\Http\Controllers;

use App\Admin;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Hash;
//use Modules\Admin\Models\User;
use Illuminate\Http\Request;
use Modules\Admin\Models\Category;
use Modules\Admin\Models\Contact;
use Modules\Admin\Models\Press;
use Modules\Admin\Models\Report;
use Session;
use Validator;
use View;

/**
 * Class : AdminController
 */
class AdminController extends Controller
{
    /**
     * @var  Repository
     */
    /**
     * Displays all admin.
     *
     * @return \Illuminate\View\View
     */
    protected $guard = 'admin';
    public function __construct()
    {
        $this->middleware('admin');
        View::share('heading', 'dashboard');
        View::share('route_url', 'admin');
    }
    /*
    * Dashboard
    */
    public function index(Request $request)
    {
        // dd(Session::getId());
        $page_title  = '';
        $page_action = '';

        $professor = User::where('role_type', 1)->count();

        $user     = User::count();
        $viewPage = 'Admin';

        $category_count    =  Category::where('parent_id', 0)->count();
        $press_count       =  Press::count();
        $reports_count     =  Report::count();
        $contact_count     =  Contact::count();



        return view('packages::dashboard.index', compact('category_count', 'reports_count', 'contact_count', 'page_title', 'page_action', 'viewPage', 'press_count'));
    }

    public function profile(Request $request, Admin $users)
    {
        $users       = Admin::find(Auth::guard('admin')->user()->id);
        $page_title  = 'Profile';
        $page_action = 'My Profile';
        $viewPage    = 'Admin';
        $method      = $request->method();
        $msg         = '';
        $error_msg   = [];

        if ($request->method() === 'POST') {
            $messages = ['password.regex' => 'Your password must contain 1 lower case character 1 upper case character one number'];

            $validator = Validator::make($request->all(), [
                'email'    => 'required|email',
                'password' => 'min:6',
                'name'     => 'required',
            ]);
            /** Return Error Message */
            if ($validator->fails()) {
                $error_msg  =   $validator->messages()->all();

                return view('packages::users.admin.index', compact('error_msg', 'method', 'users', 'page_title', 'page_action', 'viewPage'))->with('flash_alert_notice', $msg)->withInput($request->all());
            }
            $users->name  = $request->get('name');
            $users->email = $request->get('email');

            if ($request->get('password') != null) {
                $users->password =    Hash::make($request->get('password'));
            }
            $users->save();
            $method = $request->method();
            $msg    = 'Profile details successfully updated.';
        }

        return view('packages::users.admin.index', compact('error_msg', 'method', 'users', 'page_title', 'page_action', 'viewPage'))->with('flash_alert_notice', $msg)->withInput($request->all());
    }
    public function errorPage()
    {
        $page_title  = 'Error';
        $page_action = 'Error Page';
        $viewPage    = '404 Error';
        $msg         = 'page not found';

        return view('packages::auth.page_not_found', compact('page_title', 'page_action', 'viewPage'))->with('flash_alert_notice', $msg);
    }

    public function uploadFile($file)
    {

        //Display File Name
        $fileName = $file->getClientOriginalName();

        //Display File Extension
        $ext = $file->getClientOriginalExtension();
        //Display File Real Path
        $realPath = $file->getRealPath();
        //Display File Mime Type


        $file_name = time() . '.' . $ext;
        $path      = storage_path('csv');

        chmod($path, 0777);
        $file->move($path, $file_name);
        chmod($path . '/' . $file_name, 0777);

        return $path . '/' . $file_name;
    }

    public function csvImport(Request $request)
    {
        try {
            $file = $request->file('importCsv');

            if ($file == null) {
                echo json_encode(['status' => 0,'message' => 'Please select  csv file!']);

                exit();
            }
            $ext = $file->getClientOriginalExtension();

            if ($file == null || $ext != 'csv') {
                echo json_encode(['status' => 0,'message' => 'Please select valid csv file!']);

                exit();
            }
            $mime = $file->getMimeType();

            $upload = $this->uploadFile($file);

            $rs =    \Excel::load($upload, function ($reader) use ($request) {
                $data = $reader->all();

                $table_cname = \Schema::getColumnListing('reports');

                $except = ['id','create_at','updated_at'];

                $input = $request->all();

                $contact =  new Report;
                foreach ($data  as $key => $result) {
                    foreach ($table_cname as $key => $value) {
                        if (in_array($value, $except)) {
                            continue;
                        }

                        if (isset($result->$value)) {
                            $contact->$value = $result->$value;
                            $status = 1;
                        }
                    }

                    if (isset($status)) {
                        $contact->save();
                    }
                }

                if (isset($status)) {
                    echo json_encode(['status' => 1,'message' => ' Data imported successfully!']);
                } else {
                    echo json_encode(['status' => 0,'message' => 'Invalid file type or content.Please upload csv file only.']);
                }
            });
        } catch (\Exception $e) {
            echo json_encode(['status' => 0,'message' => 'Please select csv file!']);

            exit();
        }
    }
}
