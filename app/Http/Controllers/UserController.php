<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Input;
use Response;
use Session;
use Spatie\Sitemap\Sitemap; 
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;
use Carbon\Carbon;
use Validator;
use View;

use Modules\Admin\Models\Report;
use Modules\Admin\Models\Category;


class UserController extends Controller
{
    public function sitemap(Request $request, $sitemapPath='sitemap.xml')
    {
        echo "start at:".date('h:i:s').'<br>';
        
        $destination = "sitemap";

        $page = \DB::table('pages')->select('url')->pluck('url')->toArray();
        $page[] = "research-categories";
        $page[] = "pressRelease";
        $page[] = "publisher";
        $page[] = "services";
        $page[] = "contact";

        // static page xml
        $u =  Sitemap::create();
        foreach ($page as $key => $result) {
            $u->add(url($result));
        }
        $u->writeToFile($destination.'/page-sitemap.xml');

        //  category xml
        $category = \DB::table('categories')->pluck('url')->toArray();

        $u =  Sitemap::create();
        foreach ($category as $key => $value) {
            $u->add(url($value));
        }

        $u->writeToFile($destination.'/product-sitemap.xml');
        $count=0;
      
        // reports xml
      
        $categories = Category::with('report')->get();
        $i=0;
        $url_path[] = '/';
        $url_path[] = 'page-sitemap.xml';
        $url_path[] = 'product-sitemap.xml';
      
        foreach ($categories as $key => $result) {
            $u =  Sitemap::create();
            $u->add(url($result->url));
                
            foreach ($result->report as $key2 => $value) {
                $count=1;
                $u->add(url($result->url));
            }
            if($count==1){
                $i++;
                $path = 'product-sitemap'.$i.'.xml';
                $url_path[] = $path;
                $u->writeToFile($destination.'/'.$path);    
            }
            $count=0;
        } 
        // mail sitemap
        $u =  Sitemap::create();
        foreach ($url_path as $key => $final) {
               $u->add(url('sitemap/'.$final));
            }
        $u->writeToFile($sitemapPath);
        echo "end at:".date('h:i:s');
    }

    public function index(Request $request)
    {
        //dd( $request->session()->get('current_user'));
        return view('welcome');
    }
    /* @method : login
    * @param : email,password and deviceID
    * Response : json
    * Return : token and user details
    * Author : kundan Roy
    */
    public function login(Request $request)
    {
        $input = $request->all();

        if (!Auth::attempt(['email' => $request->input('email'),'password' => $request->input('password')])) {
            return response()->json(['status' => 0,'message' => 'Invalid email or password. Try again!','data' => '']);
        }
        $data = Auth::user();

        return Redirect::to('/');
    }

    public function signup(Request $request, User $user)
    {
        $input['first_name'] 	  = $request->input('first_name');
        $input['email'] 		      = $request->input('email');
        $input['password'] 	    = Hash::make($request->input('password'));


        //Server side valiation
        $validator = Validator::make($request->all(), [
            'first_name'		     => 'required',
            'email'            => 'required|email|unique:users',
            'password'         => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);
        /** Return Error Message */
        if ($validator->fails()) {
            $error_msg	 =	[];
            foreach ($validator->messages()->messages() as $key => $value) {
                $error_msg[$key] = $value[0];
            }

            return Response::json(
                  [
                      'status'  => 0,
                      'message' => $error_msg,
                      'data'	   => '',
                  ]
              );
        }
        /** --Create USER-- */
        $user = User::create($input);

        if ($user) {
            $credentials = ['email' => Input::get('email'), 'password' => Input::get('password')];

            if (Auth::attempt($credentials)) {
                $request->session()->put('current_user', Auth::user());
                $request->session()->put('tab', 1);

                return response()->json(
                            [
                                'status'  => 1,
                                'code'    => 200,
                                'message' => 'Thank you for registration.',
                                'data'    => $user,
                            ]
                        );
            }
        }
    }

    public function userSignup(Request $request, User $user)
    {
        $input['first_name']    = $request->input('first_name');
        $input['email']         = $request->input('email');
        $input['password']      = Hash::make($request->input('password'));


        //Server side valiation
        $validator = Validator::make($request->all(), [
            'first_name'        => 'required',
            'email'             => 'required|email|unique:users',
            'password'          => 'required|min:6',
            'confirm_password'  => 'required|same:password',
        ]);
        /** Return Error Message */
        if ($validator->fails()) {
            $error_msg  =   [];
            foreach ($validator->messages()->messages() as $key => $value) {
                $error_msg[$key] = $value[0];
            }

            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['message' => $error_msg]);
        } else {
            $user = User::create($input);

            $credentials = ['email' => Input::get('email'), 'password' => Input::get('password')];

            if (Auth::attempt($credentials)) {
                $request->session()->put('current_user', Auth::user());

                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['message' => 'success']);
            }
        }
    }

    public function register(Request $request)
    {
        return view('auth.register');
    }

    public function showLoginForm(Request $request)
    {
        return view('auth.login');
    }
}
