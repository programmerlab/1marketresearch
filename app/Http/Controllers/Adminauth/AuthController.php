<?php

declare(strict_types=1);

namespace App\Http\Controllers\Adminauth;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\User;
use Auth;
use Crypt;
use Hash;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Input;
use Redirect;
use URL;
use Validator;
use View;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/admin';
    protected $guard      = 'admin';

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function showRegistrationForm()
    {
        return view('admin.auth.register');
    }

    public function forgetPassword()
    {
        return view('admin.auth.passwords.email');
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
                    return view('admin.auth.passwords.reset', compact('token', 'email'));
                } else {
                    return redirect()
                        ->back()
                        ->withInput()
                        ->withErrors(['message' => 'Invalid reset password link!']);
                }
            } catch (DecryptException $e) {
                return view('admin.auth.passwords.reset', compact('token', 'email'))
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
        Auth::guard('admin')->logout();

        return redirect('/admin/login');
    }
    public function login(Request $request)
    {
        $credentials = ['email' => Input::get('email'), 'password' => Input::get('password')];

        if (Auth::attempt($credentials, true)) {
            return Redirect::to('testAdmin');
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
            return  'Email not found <a href="/password/reset">Go Back</a>' ;
        }
        $user_data = User::find($user[0]->userID);

        // Send Mail after forget password
        $temp_password = Hash::make($email);
        $email_content = [
            'receipent_email' => $request->get('email'),
            'subject'         => 'Forgot Password',
            'name'            => $user[0]->first_name,
            'temp_password'   => $temp_password,
        ];
        $helper         = new Helper;
        $email_response = $helper->sendMail(
                                $email_content,
                                'forgot_password_link'
                            );

        echo 'Reset password link has sent to your registered email.';
    }
}
