<?php

declare(strict_types=1);

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Input;
use Modules\Admin\Http\Requests\GroupRequest;
use Modules\Admin\Models\User;
use URL;
use View;

/**
 * Class AdminController
 */
class LoginController extends Controller
{
    /**
     * @var  Repository
     */

    /**
     * Displays all admin.
     *
     * @return \Illuminate\View\View
     */

    /*
     * Dashboard
     * */

    public function index(Request $request, User $user)
    {

        //$url = URL::asset('public/assets/bootstrap/css/bootstrap.css') ; //public_path('assets');
        //dd($url);
        $page_title  = 'Group';
        $page_action = 'Create Group';

        return view('packages::auth.login', compact('user', 'page_title', 'page_action'));
    }

    /*
     * create Group method
     * */

    public function create(Group $group)
    {
        $page_title  = 'Group';
        $page_action = 'Create Group';

        return view('packages::login.create', compact('group', 'page_title', 'page_action'));
    }

    /*
     * Save Group method
     * */

    public function store(GroupRequest $request, Group $group)
    {
        $group->fill(Input::all());
        $group->save();

        return Redirect::to(route('group.create'))
            ->with('flash_alert_notice', 'New group was successfully created !')->with('alert_class', 'alert-success alert-dismissable');
    }

    /*
     * Edit Group method
     * */

    public function edit(Group $group)
    {
        $page_title  = 'Group';
        $page_action = 'Edit Group';

        return view('packages::users.group.edit', compact('group', 'page_title', 'page_action'));
    }

    public function update(GroupRequest $request, Group $group)
    {
        $group->fill(Input::all());
        $group->save();

        return Redirect::to(route('group'))
            ->with('flash_alert_notice', 'Group was successfully updated !');
    }
}
