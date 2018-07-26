<?php
namespace Modules\Admin\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use Modules\Admin\Models\User;
use Modules\Admin\Models\Settings;
use Modules\Admin\Http\Requests\ReportRequest;
use Modules\Admin\Models\Report;
use Modules\Admin\Models\Category;
use Input;
use Validator;
use Auth;
use Paginate;
use Grids;
use HTML;
use Form;
use Hash;
use View;
use URL;
use Lang;
use Session;
use Route;
use Crypt;
use App\Http\Controllers\Controller;
use Illuminate\Http\Dispatcher; 
use Modules\Admin\Helpers\Helper as Helper;
use Response;
use Excel;

/**
 * Class AdminController
 */
class ReportController extends Controller {
    /**
     * @var  Repository
     */

    /**
     * Displays all admin.
     *
     * @return \Illuminate\View\View
     */
    public function __construct() {

        $this->middleware('admin');
        View::share('viewPage', 'Report');
        View::share('helper',new Helper);
        View::share('route_url',route('reports'));
        View::share('heading','Reports');

        $this->record_per_page = Config::get('app.record_per_page');
    }

    public function ajax(Request $request, Report $reports){
        
        if ($request->file('file')) {  

            $photo = $request->file('file');
            $destinationPath = storage_path('reports');
            $photo->move($destinationPath, time().$photo->getClientOriginalName());
            $photo = time().$photo->getClientOriginalName();
            $reports->photo = $photo;
        }  
       exit();
    }
    /*
     * Dashboard
     * */

    public function index(Report $reports, Request $request) 
    { 
        
        $page_title = 'Reports';
        $page_action = 'View Reports'; 
        
        // Search by name ,email and group
        $search = Input::get('search'); 
        if ((isset($search) && !empty($search)) ) {

            $search = isset($search) ? Input::get('search') : '';
               
            $reports = Report::where(function($query) use($search) {
                        if (!empty($search)) {
                            $query->Where('title', 'LIKE', "%$search%");
                        }
                        
                    })->Paginate($this->record_per_page);
        } else {
            $reports  = Report::orderBy('id','desc')->Paginate(10);
            
        } 
        
         return view('packages::reports.index', compact('reports', 'page_title', 'page_action'));
   
    }

    /*
     * create  method
     * */

    public function create(Report $reports)  
    {
        $page_title = 'Report';
        $page_action = 'Create Report'; 
         $categories  = Category::all();
         $type = ['Stories'=>'Stories','News'=>'News','Tips'=>'Tips'];  
        return view('packages::reports.create', compact('reports','page_title', 'page_action','categories','type'));
     }

    /*
     * Save Group method
     * */

    public function store(ReportRequest $request, Report $reports) 
    {    
        if ($request->file('photo')) {  

            $photo = $request->file('photo');
            $destinationPath = storage_path('reports');
            $photo->move($destinationPath, time().$photo->getClientOriginalName());
            $photo = time().$photo->getClientOriginalName();
            $reports->photo   =   $photo;
            
        } 
       
        $categoryName = $request->get('category_id');
        $cn= '';
        foreach ($categoryName as $key => $value) {
            $cn = ltrim($cn.','.$value,',');
        }
        
        $table_cname = \Schema::getColumnListing('reports');
        $except = ['id','create_at','updated_at','category_id','photo'];
        $input = $request->all();
        $reports->category_id = $cn;
        foreach ($table_cname as $key => $value) {
           
           if(in_array($value, $except )){
                continue;
           }

           if(isset($input[$value])) {
               $reports->$value = $request->get($value); 
           } 
        }  

        $reports->blog_title     =   $request->get('blog_title');
        $reports->blog_description   =   $request->get('blog_description');
        $reports->blog_created_by = $request->get('blog_created_by');

        $reports->save();
       return Redirect::to('admin/reports')
                            ->with('flash_alert_notice', 'Reports was successfully created !');
    }
    /*
     * Edit Group method
     * @param 
     * object : $category
     * */

    public function edit(Report $reports) {

        $page_title     = 'Report';
        $page_action    = 'Edit Report'; 
        $categories     = Category::all();
        $type = ['Stories'=>'Stories','News'=>'News','Tips'=>'Tips'];  
        $category_id  = explode(',',$reports->category_id);
         
         return view('packages::reports.edit', compact( 'reports' ,'page_title', 'page_action','categories','type','category_id'));
    }

    public function update(ReportRequest $request, Report $reports) 
    {
        $reports = Report::find($reports->id); 
        
        if ($request->file('photo')) {  

            $photo = $request->file('photo');
            $destinationPath = storage_path('reports');
            $photo->move($destinationPath, time().$photo->getClientOriginalName());
            $photo = time().$photo->getClientOriginalName();
            $reports->photo   =   $photo; 
        } 
 
        $request = $request->except('_method','_token','photo','category');
        
        foreach ($request as $key => $value) {
            $reports->$key = $value;
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
    public function destroy(Report $reports) 
    {
        Report::where('id',$reports->id)->delete();
        return Redirect::to('admin/reports')
                        ->with('flash_alert_notice', 'Blog was successfully deleted!');
    }

    public function show(Report $reports) {
        
        $page_title     = 'Report';
        $page_action    = 'Show Report';
        $categories     = Category::all();
        $reports        = $reports->toArray();

        return view('packages::reports.show', compact( 'reports','banner' ,'page_title', 'page_action','categories','type','category_id'));
    }

    public function csvImport(Request $request)
    {
        try{
            $file = $request->file('importCsv'); 
            if($file==NULL){
                echo json_encode(['status'=>0,'message'=>'Please select  csv file!']); 
                exit(); 
            }
            $ext = $file->getClientOriginalExtension();

            $file_type = ['csv','xlsx','xls'];

            if(!in_array($ext, $file_type)){   
                echo json_encode(['status'=>0,'message'=>'Please select valid csv file!']); 
                exit(); 
            }
            $mime = $file->getMimeType(); 

            $upload = $this->uploadFile($file);
           
            $rs =    \Excel::load($upload, function($reader)use($request) {

            $data = $reader->all();

            $table_cname = \Schema::getColumnListing('reports');
            
            $except = ['id','create_at','updated_at'];

            $input = $request->all(); 

            
            foreach ($data  as $key => $result) {
              // $result = $result[0];
                $csv =  new Report;
                foreach ($table_cname as $key => $value) {
                   if(in_array($value, $except )){
                        continue;
                   } 
                   if(isset($result->$value)) {
                       $csv->$value = $result->$value; 
                       $status = 1;
                   } 
                }

                 if(isset($status)){
                     $csv->save(); 
                 } 
            }  
            if(isset($status)){
                echo json_encode(['status'=>1,'message'=>' Data imported successfully!']);
            }else{
               echo json_encode(['status'=>0,'message'=>'Invalid file type or content.Please upload csv file only.']);
            } 
            });

        } catch (\Exception $e) {
            echo json_encode(['status'=>0,'message'=>$e->getMessage()]); 
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

        $file_name = time().'.'.$ext;
        $path = storage_path('csv');

       // chmod($path ,0777);
        $file->move($path,$file_name);
        chmod($path.'/'.$file_name ,0777);
        return $path.'/'.$file_name;
    }

}
