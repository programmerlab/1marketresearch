<?php

declare(strict_types=1);

namespace Modules\Admin\Http\Controllers;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Auth;
use Crypt;
use Hash;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Input;
use Modules\Admin\Models\User;
use Redirect;
use URL;
use Validator;
use View;

class AuthController extends Controller
{
    protected $redirectTo = 'admin';
    protected $guard      = 'admin';

    public function index(User $user, Request $request)
    {
        if (Auth::guard('admin')->check()) {
            return Redirect::to('admin');
        }

        return view('packages::auth.login', compact('user'));
    }

    public function forgetPassword()
    {
        return view('packages::auth.passwords.email');
    }

    public function resetPassword(UserRequest $request)
    {
        $encryptedValue = ($request->get('key'))?$request->get('key'):'';
        $method_name    = $request->method();
        $token          = $request->get('token');
        $email          = ($request->get('email'))?$request->get('email'):'';

        if ($method_name == 'GET') {
            try {
                $email = Crypt::decrypt($encryptedValue);

                if (Hash::check($email, $token)) {
                    return view('packages::auth.passwords.reset', compact('token', 'email'));
                } else {
                    return redirect()
                        ->back()
                        ->withInput()
                        ->withErrors(['message' => 'Invalid reset password link!']);
                }
            } catch (DecryptException $e) {
                return view('packages::auth.passwords.reset', compact('token', 'email'))
                    ->withErrors(['message' => 'Invalid reset password link!']);
            }
        } else {
            if (Hash::check($email, $token)) {
                $password =  Hash::make($request->get('password'));
                $user     = User::where('email', $request->get('email'))->update(['password' => $password]);
                echo 'Password reset successfully.';
            } else {

                 //return Redirect::to(URL::previous())->with('message','Invalid token');
                return redirect()
                     ->back()
                     ->withInput()
                     ->withErrors(['message' => 'Invalid reset password link!']);
            }
        }
    }

    public function logout()
    {
        Auth::logout();
        auth()->guard('admin')->logout();

        return redirect('admin/login');
    }
    public function login(Request $request)
    {
        $credentials = ['email' => Input::get('email'), 'password' => Input::get('password')];

        if (Auth::attempt($credentials, true)) {
            return Redirect::to('admin');
        }
        //dd(Auth::check());
    }

    public function sendResetPasswordLink(Request $request)
    {
        $email = $request->get('email');
        //Server side valiation
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        $user =   User::where('email', $email)->get();

        if ($user->count() == 0) {
            return redirect()
                 ->back()
                 ->withInput()
                 ->withErrors(['alert' => 'danger','message' => 'Oh no! The address you provided isn’t in our system']);
        }
        $user_data     = User::find($user[0]->id);
        $temp_password =  Hash::make($email);

        $email_content = [
            'receipent_email'   => $request->get('email'),
            'subject'           => 'Your Yellotasker Account Password',
            'name'              => $user_data->first_name,
            'temp_password'     => $temp_password,
            'encrypt_key'       => Crypt::encrypt($email),
            'greeting'          => 'Yellotasker Team',
            'name'              => $user[0]->name,
        ];
        //print_r($email_content);
        $helper         = new Helper;
        $email_response = $helper->sendMail(
                                $email_content,
                                'forgot_password_link'
                            );

        return Redirect::to('admin/forgot-password')
            ->withErrors(['alert' => 'success','message' => 'Reset password link has sent to your registered email.']);
    }
}
