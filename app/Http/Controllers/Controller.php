<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Modules\Admin\Models\CategoryDashboard;
use View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function __construct(\Request $request)
    {
        $category_list = Category::where('parent_id', 0)->get();
        View::share('category_list', $category_list);
        $cat       = Category::nested()->get();
        $mega_menu = [];
        foreach ($cat as $key => $result) {
            $category = $result['name'];
            $id       = $result['id'];
            while (1) {
                $rs = $this->recursive($result);
                //echo "<pre>"; print_r($rs);
                if ($rs['name'] != null) {
                    $mega_menu[$id][] = [$rs['slug'] => $rs['name']];
                }

                $result = $rs;
                $c      = count($result['child']);

                if ($c == 0) {
                    break;
                }
            }
        }

        View::share('mega_menu', $mega_menu);
        // View::share('cats',$cat);

        $category_menu = CategoryDashboard::with('category')->get();


        View::share('category_menu', $category_menu);

        $title = last(request()->segments());
        View::share('main_title', $title);
    }

    public function recursive($result)
    {
        foreach ($result['child'] as $key => $value) {
            return $value;
        }
    }
}
