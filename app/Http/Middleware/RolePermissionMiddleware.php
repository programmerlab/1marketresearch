<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Route;
use View;

class RolePermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'web')
    {
        if (!Auth::guard('admin')->user()) {
            $validAccess = false;
            $user        = Auth::guard('web')->user();
            $role_type   = isset($user->role_type) && $user->role_type?$user->role_type:'Guest';
            $role        = \App\Role::find($role_type);

            $controllerAction          = class_basename(Route::getCurrentRoute()->getActionName());
            list($controller, $action) = explode('@', $controllerAction);
            $routeName                 = Route::currentRouteName();

            $controller = str_replace('Controller', '', $controller);

            $permission = $role?(array) json_decode($role->permission):[];

            $hide = ['Coupan' => 'hide',
                'Setting'     => 'hide',
                'Transaction' => 'hide',
                'Contact'     => 'hide',
                'ClientUsers' => 'hide',
                'Users'       => 'hide',
                'Publisher'   => 'hide',
                'Report'      => 'hide',
            ];

            if ($action != 'importExcel') {
                unset($hide['Report']);
            }

            View::share('hide', ($hide));

            if (isset($hide[$controller])) {
                $page_title     = '403';
                $heading        = 'Permission Denied.';
                $sub_page_title = '403';
                $page_action    = '403';
                $hide['Report'] = 'hide';
                View::share('hide', ($hide));
                $route_url = Route::getCurrentRoute()->getPath();

                return view('packages::errors.403', compact('route_url', 'heading', 'page_title', 'hide', 'page_action', 'sub_page_title'));
            }


            $isControllerExist = key_exists($controller, $permission);

            if ($controller && $isControllerExist) {
                $accessMode    = $permission[$controller];
                $userCanRead   = isset($accessMode->read)?true:false;
                $userCanWrite  = isset($accessMode->write)?true:false;
                $userCanDelete = isset($accessMode->delete)?true:false;



                switch ($request->method()) {
                    case 'POST': $validAccess = $userCanWrite;
                        break;
                    case 'PUT':
                         $validAccess = $userCanWrite;
                        break;
                    case 'PATCH':
                        $validAccess = $userCanWrite;
                        break;
                    case 'DELETE':
                         $validAccess = $userCanDelete;
                        break;
                    case 'GET':
                        $validAccess = $userCanRead;
                        break;
                    default:
                        break;

                    }
            } elseif (in_array($controller, ['Admin','Role'])) {
                $validAccess = $request->method() == 'GET'?true:true;
            } else {
                $validAccess = true;
            }



            if ($validAccess) {
                return $next($request);
            } else {
                $route_url = Route::getCurrentRoute()->getPath();

                return view('packages::errors.403', compact('route_url', 'heading', 'page_title', 'page_action', 'sub_page_title'));
            }
        }

        if (Auth::guard('admin')->user()) {
            $hide = [];

            $hide = ['Coupan' => '',
                'Setting'     => '',
                'Transaction' => '',
                'Contact'     => '',
                'ClientUsers' => '',
                'Users'       => '',
                'Publisher'   => '',
                'Report'      => '',
            ];

            View::share('hide', ($hide));


            return $next($request);
        }
    }
}
