<?php

declare(strict_types=1);

namespace App\Exceptions;

use ErrorException;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
//use Symfony\Component\HttpKernel\Exception\ErrorException;
use Illuminate\Validation\ValidationException;
use InvalidArgumentException;
use Redirect;
use Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use URL;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
        NotFoundHttpException::class,
        MethodNotAllowedHttpException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        dd($e);
        $path_info_url = $request->getpathInfo();

        if (strpos($path_info_url, 'admin') == false) {
            return Redirect::to('404');
        }



        $api_url = '';
        $web_url = '';

        if (strpos($path_info_url, 'api/v1') !== false) {
            $api_url = $path_info_url;
        } else {
            $web_url = $path_info_url;
        }
        // dd($e);

        if ($e instanceof FatalThrowableError) {
            $data['url']        = URL::previous();
            $data['message']    = $e->getMessage();
            $data['error_type'] = 'FatalThrowableError';

            $this->errorLog($data, $e);

            $page_title  = '404 Error';
            $page_action = 'Page';
            $viewPage    = '404 Error';
            $msg         = 'page not found';
            $error_msg   = str_slug($e->getMessage()); //"Oops! Server is busy please try later.";

            return  Redirect::to(URL::previous())->with('flash_alert_notice', $error_msg);
        }

        if ($e instanceof InvalidArgumentException) {
            $data['url']        = URL::previous();
            $data['message']    = $e->getMessage();
            $data['error_type'] = 'InvalidArgumentException';

            $this->errorLog($data, $e);

            return  Redirect::to('admin/404?error=' . $e->getmessage())->with('flash_alert_notice', str_slug($e->getMessage()));
        }

        if ($e instanceof ModelNotFoundException) {
            $data['url']        = URL::previous();
            $data['message']    = $e->getMessage();
            $data['error_type'] = 'ModelNotFoundException';

            $this->errorLog($data, $e);

            $page_title  = '404 Error';
            $page_action = 'Page';
            $viewPage    = '404 Error';
            $msg         = 'page not found';
            $error_msg   = $e->getMessage(); //"Oops! Server is busy please try later.";

            return  Redirect::to('admin/404?error=' . $e->getmessage())->with('flash_alert_notice', str_slug($e->getMessage()));
        }
        $error_from_route = 0;

        if ($e instanceof NotFoundHttpException) {
            $data['url']        = URL::previous();
            $data['message']    = $e->getMessage();
            $data['error_type'] = 'NotFoundHttpException';

            $this->errorLog($data, $e);

            $error_from_route = 1;

            if ($api_url) {
                echo json_encode(
                    ['status'     => 0,
                        'code'    => 500,
                        'message' => 'Request URL not available',
                        'data'    => '',
                    ]
                );
            } else {
                return  Redirect::to('admin/404?error=' . $e->getmessage())->with('flash_alert_notice', str_slug($e->getMessage()));
            }

            exit();
        }

        if ($e instanceof QueryException) {
            $data['url']        = URL::previous();
            $data['message']    = $e->getMessage();
            $data['error_type'] = 'QueryException';

            $this->errorLog($data, $e);

            if ($api_url) {
                echo json_encode(
                    ['status'     => 0,
                        'code'    => 500,
                        'message' => $e->getMessage(),
                        'data'    => '',
                    ]
                );
            } else {
                $page_title  = '404 Error';
                $page_action = 'Page';
                $viewPage    = '404 Error';
                $msg         = 'page not found';
                $error_msg   = $e->getMessage(); //"Oops! Server is busy please try later.";
                return view('packages::auth.page_not_found', compact('error_msg', 'page_title', 'page_action', 'viewPage'))->with('flash_alert_notice', $msg);
            }

            exit();
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            $data['url']        = URL::previous();
            $data['message']    = $e->getMessage();
            $data['error_type'] = 'MethodNotAllowedHttpException';

            $this->errorLog($data, $e);

            if ($api_url) {
                echo json_encode(
                    ['status'     => 0,
                        'code'    => 500,
                        'message' => 'Request method not found!',
                        'data'    => '',
                    ]
                );
            } else {
                return  Redirect::to('admin/404?error=' . $e->getmessage())->with('flash_alert_notice', str_slug($e->getMessage()));
            }

            exit();
        }

        if ($e instanceof ErrorException) {
            $data['url']        = URL::previous();
            $data['message']    = $e->getMessage();
            $data['error_type'] = 'ErrorException';

            $this->errorLog($data, $e);

            if ($api_url) {
                echo json_encode(
                    ['status'     => 1,
                        'code'    => 500,
                        'message' => [
                            'error_message' => $e->getmessage(),
                            'file_path'     => $e->getfile(),
                            'line_number'   => $e->getline(), ],
                        'data' => '',
                    ]
                );
            } else {
                return  Redirect::to('admin/404?error=' . $e->getmessage())->with('flash_alert_notice', str_slug($e->getMessage()));
            }

            exit();
        }

        return parent::render($request, $e);
    }

    public function errorLog($data, $e)
    {
        $data['log']        = json_encode($e);
        $data['message']    = str_slug($e->getMessage());
        $data['file']       = $e->getFile();
        $data['statusCode'] = 500;

        \DB::table('error_logs')->insert($data);
    }
}
