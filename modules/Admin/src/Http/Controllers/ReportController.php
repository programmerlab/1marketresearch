<?php

declare(strict_types=1);

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Input;
use Modules\Admin\Helpers\Helper as Helper;
use Modules\Admin\Http\Requests\ReportRequest;
use Modules\Admin\Models\Category;
use Modules\Admin\Models\Report;
use Route;
use URL;
use Validator;
use View;


/**
 * Class AdminController
 */
class ReportController extends Controller
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
        View::share('viewPage', 'Report');
        View::share('helper', new Helper);
        View::share('route_url', route('reports'));
        View::share('heading', 'Reports');

        $this->record_per_page = Config::get('app.record_per_page');

        $report_count = Report::count();
        View::share('report_count', $report_count);
    }

    public function excelImport(Request $request)
    {
        $page_title  = 'Reports';
        $page_action = 'Export Reports';

        if ($request->method('method') == 'POST') {
            try {
                $file = $request->file('importExcel');

                if (!$request->file('importExcel')) {
                    return Redirect::back()->withErrors(['Please choose a file to upload!', 'The Message']);
                }


                $validator = Validator::make(
              [
                  'importExcel'      => $file,
                  'extension'        => strtolower($file->getClientOriginalExtension()),
              ],
              [
                  'importExcel'          => 'required',
                  'extension'            => 'required|in:xlsx,xls',
              ]
            );

                // Return Error Message
                if ($validator->fails()) {
                    $error_msg  =   [];
                    foreach ($validator->messages()->all() as $key => $value) {
                        array_push($error_msg, $value);
                    }

                    return view('packages::reports.excelImport', compact('category', 'page_title', 'page_action', 'error_msg'))
                    ->withErrors($validator);
                }
                $mime = $file->getMimeType();

                $ext = $file->getClientOriginalExtension();

                $file_type = ['csv','xlsx','xls'];

                if (!in_array($ext, $file_type)) {
                    return Redirect::back()->withErrors(['Select a valid file!', 'The Message']);
                }

                 $total_import=1;
                       
                $upload = $this->uploadFile($file);

                $rs = \Excel::filter('chunk')->load($upload)->chunk(500, function($data) use($total_import)
                        { 
                     
                    $table_cname = \Schema::getColumnListing('reports');
                    $except = ['id','create_at','updated_at'];
                    
                    $dataArray = [];

                    $table_cname = \Schema::getColumnListing('reports');
                    $except = ['id','created_at','updated_at','_token','photo'];
                    // $dataArray['category_name'] = null;
                    foreach ($data  as $key => $result) {
                        $dataArray['category_name'][] =  $result->category;
                    }

                    $category = Category::select(\DB::raw("TRIM(category_name) as category_name"))->get();
                    $a = $category->toArray();

                    $main_category      = array_column($a, 'category_name');
                    
                    $current_category   = array_unique(array_filter($dataArray['category_name']));
                    $catName = [];
                    $not_cat = 0;
                    foreach ($current_category as $key => $cat) {
                        if (!in_array($cat, $main_category)) {
                            $not_cat = 1;
                            $catName[] = trim($cat);
                        }
                    }
                    $status = 0;
                    // category check
                    if ($not_cat == 1) {

                        View::share('catName', $catName);

                        return Redirect::back()->withErrors(['File contains some invalid category.']);
                    } else {
                        foreach ($data  as $key => $result) {

                            if($result->post_title==null){
                                continue;
                            }else{
                               $total_import++;
                            }
                           // $csv = new Report;
                            $csv        = Report::firstOrNew(['title' => $result->post_title,'category_name' => $result->category]);
                            $category   = Category::where('category_name', 'LIKE', "%$result->category%")->first();


                            if ($result->post_title) {
                                $status = 1;
                                // $csv->title  =  implode(' ', array_slice(explode(' ', $result->post_title), 0, 7));
                                $csv->title  =  $result->post_title;
                            }

                            if ($result->category) {
                                $csv->category_name = $result->category;
                                $csv->category_id   = $category->id ?? null;
                            }

                            if ($result->publisher_name) {
                                $csv->publisher_name  =  $result->publisher_name;
                            }

                            if ($result->number_of_pages) {
                                $csv->number_of_pages  =  $result->number_of_pages;
                            }

                            if ($result->post_content) {

                                $csv->description  =  nl2br(str_replace("_x000D_", "", $result->post_content));
                            }

                            if ($result->table_of_content) {
                                $csv->table_of_contents  = nl2br(str_replace("_x000D_", "", $result->table_of_content));
                            }

                            if ($result->list_of_figures) {
                                $csv->table_and_figures  =  nl2br(str_replace("_x000D_", "", $result->list_of_figures));
                            }

                            if ($result->single_user_price) {
                                $csv->signle_user_license  =  $result->single_user_price;
                            }

                            if ($result->multi_user_price) {
                                $csv->multi_user_license  =  $result->multi_user_price;
                            }

                            if ($result->corporate_user_price) {
                                $csv->corporate_user_license  =  $result->corporate_user_price;
                            }

                            if ($result->report_type) {
                                $csv->type  =  $result->report_type;
                            }

                            if ($result->metakeyword) {
                                $csv->meta_key  =  nl2br(str_replace("_x000D_", "", $result->metakeyword));
                            }

                            if (empty($result->short_url)) {

                                $u = implode(' ', array_slice(explode(' ', $result->post_title), 0, 7));
                                $csv->url   = 'market-reports/' . date('Y') . '-' . str_slug($u);
                                $csv->slug  = date('Y') . '-' . str_slug($result->post_title);
                            } else {
                                $csv->url   = 'market-reports/' . str_slug($result->short_url);
                                $csv->slug  = str_slug($result->short_url);
                            }

                            if (empty($result->metatitle)) {
                                $csv->meta_title   = nl2br(str_replace("_x000D_", "", $result->post_title));
                            } else {
                                $csv->meta_title  =  nl2br(str_replace("_x000D_", "", $result->metatitle));
                            }

                            if (empty($result->metadescription)) {
                                $post_content = nl2br(str_replace("_x000D_", "", $result->post_content));
                                $csv->meta_description  = nl2br(implode(' ', array_slice(explode(' ', $post_content), 0, 80)));
                            } else {
                                $csv->meta_description  =  nl2br(str_replace("_x000D_", "",$result->metadescription));
                            }

                            if (!empty($result->publishe_date)) {

                                $csv->publish_date  = \PHPExcel_Style_NumberFormat::toFormattedString($result->publishe_date, 'DD-MM-YYYY');
                            } else {
                                $csv->publish_date  = date('d-m-Y');
                            }
                            $csv->status = 'status';


                            if (isset($status) && $status == 1) {
                                $rs = $csv->save();

                                if ($rs) {
                                    $r = Report::find($csv->id);
                                    $r->report_id = $csv->id;
                                    $r->url = $csv->url . '-' . $csv->id;
                                    $r->slug = $csv->slug . '-' . $csv->id;

                                    $r->save();
                                }
                            }
                        }
 
                    }
                    return Redirect::back()->withErrors(['<p style="color:green">Reports imported successfully!</p>']);
                }
            );
            } catch (\Exception $e) {
               
                return Redirect::back()->withErrors([$e->getMessage()]);
            }
        }

        if($request->method()=='POST'){
            return Redirect::back()->withErrors(['<p style="color:green">Reports imported successfully!</p>']); 
        }else{
            return view('packages::reports.excelImport', compact('category', 'page_title', 'page_action')); 
        }
    }

    public function importExcel(Request $request)
    {
        $page_title  = 'Reports';
        $page_action = 'Export Reports';

        $category = Category::all();

        if ($request->method() == 'POST') {
            $start_date  = Input::get('start_date');
            $end_date    = Input::get('end_date');
            $category_id = Input::get('category_name');
            $page_number = Input::get('page_number');
            $n           = !empty($category_name)?'-' . $category_name:'';

            if ($start_date &&  $end_date) {
                $start_date = \Carbon\Carbon::createFromFormat('d-m-Y', $start_date)->format('d-m-Y');
                $end_date   = \Carbon\Carbon::createFromFormat('d-m-Y', $end_date)->format('d-m-Y');
            }
            
            $page_number = ($page_number)?$page_number:123456789;
            $reportsname = 'reports-' . date('d-m-Y') . $n;

            Excel::create($reportsname, function ($excel) use ($page_number,$start_date,$end_date,$category_id) {
                $url = url('/');

                $items = Report::select('id as Sno','title as post_title','category_name as category','description as post_content','table_of_contents','number_of_pages','type','meta_title','meta_key','meta_key','meta_description','signle_user_license','multi_user_license','corporate_user_license','table_and_figures','status','publisher_name', \DB::raw('CONCAT(\'' . $url . '/\',url) as ReportUrl'), 'publish_date as PublishDate')->where(function ($q) use ($page_number,$start_date,$end_date,$category_id) {
                    if ($start_date && $end_date) {
                       $q->whereBetween('publish_date', [date($start_date),date($end_date)]);
                    }

                    if (!empty($category_id)) {
                       $q->where('category_id', $category_id);
                    }
                })->orderBy('id', 'asc')->limit($page_number)->get()->toArray();

                if (count($items) == 0) {
                    $arr = ['message' => 'Record not found'];
                }else{
                    foreach ($items as $key => $resultset) {
                         $wizard = new \PHPExcel_Helper_HTML;
                            foreach ($resultset as $key => $value) {
                                if($key=='publish_date'){
                                    $data[$key] = $value;
                                }else{
                                    $data[$key] = $wizard->toRichTextObject($value);    
                                }
                            }
                        $arr[] =  $data;
                        }
                }

                $excel->sheet('Sheet', function ($sheet) use ($arr) {
                    $sheet->fromModel($arr, null, 'A1', true);
                });
            })->download('xlsx');
        }

        return view('packages::reports.importExcel', compact('category', 'page_title', 'page_action'));
    }

    public function exportExcel(Request $request)
    {
        $page_title  = 'Reports';
        $page_action = 'View Reports';

        $category = Category::all();

        return view('packages::reports.importExcel', compact('category', 'page_title', 'page_action'));
    }

    public function ajax(Request $request, Report $reports)
    {
        if ($request->file('file')) {
            $photo           = $request->file('file');
            $destinationPath = storage_path('reports');
            $photo->move($destinationPath, time() . $photo->getClientOriginalName());
            $photo          = time() . $photo->getClientOriginalName();
            $reports->photo = $photo;
        }

        exit();
    }
    /*
     * Dashboard
     * */

    public function index(Report $reports, Request $request)
    {
        $page_title  = 'Reports';
        $page_action = 'View Reports';

        // Search by name ,email and group
        $search = Input::get('search');

        if ((isset($search) && !empty($search))) {
            $search = isset($search) ? Input::get('search') : '';

            $reports = Report::where(function ($query) use ($search) {
                if (!empty($search)) {
                    $query->orWhere('report_id', $search);
                    $query->orWhere('title', 'LIKE', "%$search%");
                    $query->orWhere('category_name', 'LIKE', "%$search%");
                }
            })->Paginate(20);

        } else {
            $reports  = Report::orderBy('id', 'desc')->Paginate(10);
        }

        $export = $request->get('export');

        if ($export == 'excel') {
            $reportsname = 'reports-' . date('d-M-Y');
            Excel::create($reportsname, function ($excel) {
                $url = url('/');

                $items = Report::select('title as Title', \DB::raw('CONCAT(\'' . $url . '/\',url) as ReportUrl'), 'category_name as CategoryName', 'publish_date as PublishDate')->get();


                $excel->sheet('Sheet', function ($sheet) use ($items) {
                    $sheet->fromModel($items, null, 'A1', true);
                });
            })->download('xlsx');
        }

        return view('packages::reports.index', compact('reports', 'page_title', 'page_action'));
    }

    /*
     * create  method
     * */

    public function create(Report $reports)
    {
        $page_title  = 'Reports';
        $page_action = 'Create Report';
        $categories  = Category::all();

        $rptid = Report::select('id')->orderBy('id', 'desc')->limit(1)->first();

        $report_id  = intval($rptid->id) + 1;

        return view('packages::reports.create', compact('reports', 'page_title', 'page_action', 'categories', 'report_id'));
    }

    /*
     * Save Group method
     * */

    public function store(ReportRequest $request, Report $reports)
    {
      
        if ($request->file('photo')) {
            $photo           = $request->file('photo');
            $destinationPath = storage_path('reports');
            $photo->move($destinationPath, time() . $photo->getClientOriginalName());
            $photo            = time() . $photo->getClientOriginalName();
            $reports->photo   =   $photo;
        }

        $rptid = Report::select('id')->orderBy('id', 'desc')->limit(1)->first();

        $report_id          = intval($rptid->id) + 1;
        $reports->report_id = $report_id;

        $table_cname = \Schema::getColumnListing('reports');
        $except      = ['id','create_at','updated_at','_token','photo','report_id','url'];
        $input       = $request->all();

        $reports->slug = date('Y') . '-' . str_slug($request->get('title')) . '-' . $report_id;

        if ($request->get('url')) {
            $reports->url = 'market-reports/' . date('Y') . '-' . str_slug($request->get('url')) . '-' . $report_id;
        } else {
            $u            = implode(' ', array_slice(explode(' ', $request->get('title')), 0, 7));
            $reports->url = 'market-reports/' . date('Y') . '-' . str_slug($u) . '-' . $report_id;
        }
 
        $cat = Category::find($request->get('category'));

        $reports->category_id   = $request->get('category');
        $reports->category_name = $cat->category_name;

        foreach ($table_cname as $key => $value) {
            if (in_array($value, $except)) {
                continue;
            }

            if (isset($input[$value])) {
                $reports->$value = $request->get($value);
            }
        }

        if (empty($request->get('meta_title'))) {
            $reports->meta_title  =  $request->get('title');
        }

        if (empty($request->get('meta_description'))) {
            $reports->meta_description  = implode(' ', array_slice(explode(' ', $request->get('description')), 0, 80));
        }
        $rs = $reports->save();

        if ($rs) {
            $r            = Report::find($reports->id);
            $r->report_id = $reports->id;
            $r->save();
        }


        return Redirect::to('admin/reports')
           ->with('flash_alert_notice', 'Reports was successfully created !');
    }
    /*
     * Edit Group method
     * @param
     * object : $category
     * */

    public function edit(Request $request, $id)
    {
        $page_title     = 'Report';
        $page_action    = 'Edit Report';

        $categories  = Category::all();
    
        $reports = Report::find($id);
        $report_id = $id;

        return view('packages::reports.edit', compact('reports', 'page_title', 'page_action', 'categories', 'report_id', 'category_id'));
    }

    public function update(ReportRequest $request, $id)
    {    
        $reports = Report::find($id);
        $cat = Category::find($request->get('category'));
        if($cat){
            $reports->category_id   = $request->get('category');
            $reports->category_name = $cat->category_name; 
        }
       

        if ($request->file('photo')) {
            $photo           = $request->file('photo');
            $destinationPath = storage_path('reports');
            $photo->move($destinationPath, time() . $photo->getClientOriginalName());
            $photo            = time() . $photo->getClientOriginalName();
            $reports->photo   =   $photo;
        }


        $report_id = $reports->id;

        $table_cname = \Schema::getColumnListing('reports');
        $except      = ['id','create_at','updated_at','_token','photo','report_id'];
        $input       = $request->all();

        $reports->slug = date('Y') . '-' . str_slug($request->get('title')) . '-' . $report_id;

        //$reports->url = 'market-reports/'.date('Y').'-'.str_slug($request->get('title')).'-'.$report_id;
        if ($request->get('url')) {
            $reports->url = 'market-reports/' . date('Y') . '-' . str_slug($request->get('url')) . '-' . $report_id;
        } else {
            $u            = implode(' ', array_slice(explode(' ', $request->get('title')), 0, 7));
            $reports->url = 'market-reports/' . date('Y') . '-' . str_slug($u) . '-' . $report_id;
        }

        foreach ($table_cname as $key => $value) {
            if (in_array($value, $except)) {
                continue;
            }

            if (isset($input[$value])) {
                $reports->$value = $request->get($value);
            }
        }

        if (empty($request->get('meta_title'))) {
            $reports->meta_title  =  $request->get('title');
        }

        if (empty($request->get('meta_description'))) {
            $reports->meta_description  = implode(' ', array_slice(explode(' ', $request->get('description')), 0, 80));
        }

        $reports->save();

        return Redirect::to('admin/reports')
            ->with('flash_alert_notice', 'Reports was successfully updated!');
    }
    /*
     *Delete reports
     * @param ID
     *
     */
    public function destroy(Request $request,$id)
    {
        Report::where('id', $id)->delete();
        return Redirect::to('admin/reports')
            ->with('flash_alert_notice', 'Reports was successfully deleted!');
    }

    public function show(Request $request, $id)
    {
        $reports = Report::find($id);
        $page_title     = 'Report';
        $page_action    = 'Show Report';
        $categories     = Category::all();
        $reports        = $reports->toArray();

        return view('packages::reports.show', compact('reports', 'banner', 'page_title', 'page_action', 'categories', 'type', 'category_id'));
    }

    public function csvImport(Request $request)
    {
        try {
            $file = $request->file('importCsv');

            if ($file == null) {
                echo json_encode(['status' => 0,'message' => 'Please select  file!']);

                exit();
            }
            $ext = $file->getClientOriginalExtension();

            $file_type = ['csv','xlsx','xls'];

            if (!in_array($ext, $file_type)) {
                echo json_encode(['status' => 0,'message' => 'Please select valid file!']);

                exit();
            }
            $mime = $file->getMimeType();

            $upload = $this->uploadFile($file);

            $rs =    \Excel::load(
                $upload,
                function ($reader) use ($request) {
                    $data = $reader->all();

                    $table_cname = \Schema::getColumnListing('reports');

                    $except = ['id','create_at','updated_at'];

                    $input = $request->all();

                    $dataArray = [];

                    $table_cname = \Schema::getColumnListing('reports');
                    $except = ['id','created_at','updated_at','_token','photo'];


                    // $dataArray['category_name'] = null;
                    foreach ($data  as $key => $result) {
                        foreach ($table_cname as $key => $value) {
                            if (in_array($value, $except)) {
                                continue;
                            }

                            if (isset($result->$value)) {
                                $dataArray[$value][] = $result->$value;
                            }
                        }
                    }
                    $category = Category::all(['category_name']);
                    $a = $category->toArray();

                    $main_category      = array_column($a, 'category_name');
                    $current_category   = $dataArray['category_name'];

                    $not_cat = 0;
                    foreach ($current_category as $key => $cat) {
                        if (!in_array($cat, $main_category)) {
                            $not_cat = 1;
                        }
                    }


                    if ($not_cat == 1) {
                        echo  json_encode(['status' => 0,'message' => 'Invalid category name found in file']);

                        exit();
                    } else {
                        foreach ($data  as $key => $result) {
                            // $result = $result[0];
                            $csv = Report::firstOrNew(['title' => $result->title,'category_name' => $result->category_name]);

                            $rptid          = Report::select('id')->orderBy('id', 'desc')->limit(1)->first();
                            $report_id      = intval($rptid->id) + 1;
                            $category       = Category::where('category_name', $result->category_name)->first();

                            foreach ($table_cname as $key => $value) {
                                if (in_array($value, $except)) {
                                    continue;
                                }
                                $csv->$value = $result->$value;

                                $csv->slug = date('Y') . '-' . str_slug($result->title) . '-' . $report_id;
                                $csv->meta_title  =  implode(' ', array_slice(explode(' ', $result->title), 0, 7));
                                $csv->title  =  implode(' ', array_slice(explode(' ', $result->title), 0, 7));
                                $csv->report_id = $report_id;
                                $csv->category_name = $result->category_name;
                                $csv->category_id = $category->id ?? null;

                                $csv->category_id = $category->id ?? null;

                                $csv->url = 'market-reports/' . date('Y') . '-' . str_slug($result->title) . '-' . $report_id;


                                if (isset($result->$value)) {
                                    if ($value == 'meta_title'  && !empty($result->$value)) {
                                        $csv->meta_title  =  implode(' ', array_slice(explode(' ', $result->$value), 0, 7));
                                    } else {
                                        $csv->meta_title  =  implode(' ', array_slice(explode(' ', $result->title), 0, 7));
                                    }

                                    if ($value == 'title') {
                                        $csv->url = 'market-reports/' . date('Y') . '-' . str_slug($result->$value) . '-' . $report_id;
                                    }

                                    if ($value == 'meta_title' && !empty($result->$value)) {
                                        $csv->meta_title  =  implode(' ', array_slice(explode(' ', $result->$value), 0, 7));
                                    } else {
                                        $csv->meta_title  =  implode(' ', array_slice(explode(' ', $result->title), 0, 7));
                                    }

                                    if ($value == 'description') {
                                        $csv->meta_description  = implode(' ', array_slice(explode(' ', $result->$value), 0, 80));
                                        $csv->description = $result->$value;
                                    }

                                    if ($value == 'meta_description' && !empty($result->$value)) {
                                        $csv->meta_description  = implode(' ', array_slice(explode(' ', $result->$value), 0, 80));
                                    } else {
                                        $csv->meta_description  = implode(' ', array_slice(explode(' ', $result->description), 0, 80));
                                    }
                                    $status = 1;
                                }
                            }

                            if (isset($status) && $status == 1) {
                                $rs = $csv->save();

                                if ($rs) {
                                    $r = Report::find($csv->id);
                                    $r->report_id = $csv->id;
                                    $r->save();
                                }
                                $status = 0;
                            }
                        }

                        if (isset($status)) {
                            echo json_encode(['status' => 1,'message' => ' Data imported successfully!']);

                            exit();
                        } else {
                            echo json_encode(['status' => 0,'message' => 'Invalid file type or content.Please upload csv file only.']);

                            exit();
                        }
                    }
                }
        );
        } catch (\Exception $e) {
            echo json_encode(['status' => 0,'message' => $e->getMessage()]);

            exit();
        }
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

        // chmod($path ,0777);
        $file->move($path, $file_name);
        chmod($path . '/' . $file_name, 0777);

        return $path . '/' . $file_name;
    }
}
