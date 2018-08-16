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

use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;


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

        $report_count = Report::count();
        View::share('report_count',$report_count);


    }

    public function excelImport(Request $request){
        $page_title = 'Reports';
        $page_action = 'Export Reports'; 

        if($request->method('method')=='POST'){
            try{
            $file = $request->file('importExcel');

            if (!$request->file('importExcel')) { 
                return Redirect::back()->withErrors(['Please choose a file to upload!', 'The Message']);
            } 


            $validator = Validator::make(
              [
                  'importExcel'      => $file,
                  'extension' => strtolower($file->getClientOriginalExtension()),
              ],
              [
                  'importExcel'          => 'required',
                  'extension'      => 'required|in:xlsx,xls'
              ]);



           // Return Error Message
            if ($validator->fails()) {

                 $error_msg  =   [];
                    foreach ( $validator->messages()->all() as $key => $value) {
                        array_push($error_msg, $value);     
                    }

                return view('packages::reports.excelImport', compact('category', 'page_title', 'page_action','error_msg'))
                    ->withErrors($validator);

            }
            $mime = $file->getMimeType(); 

            $ext = $file->getClientOriginalExtension();

            $file_type = ['csv','xlsx','xls'];

            if(!in_array($ext, $file_type)){   
                return Redirect::back()->withErrors(['Select a valid file!', 'The Message']);
            }


            $upload = $this->uploadFile($file);
           
            $rs =    \Excel::load($upload, function($reader)use($request) {

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
                   if(in_array($value, $except )){
                        continue;
                   } 
                   if(isset($result->$value)) {
                        $dataArray[$value][] = $result->$value;
                   }
                }
            }
                $category = Category::all(['category_name']);
                $a = $category->toArray();

                $main_category      = array_column($a, 'category_name');
                $current_category   = $dataArray['category_name'];

                $not_cat =0;
                foreach ($current_category as $key => $cat) {
                    if(!in_array($cat, $main_category)){
                        $not_cat = 1;
                    }
                }

                $id = Report::orderBy('id','desc')->first();

                $rid = ($id)?'-'.$id->id:null;

                if($not_cat==1){
                     return Redirect::back()->withErrors(['File contains some invalid category.']);
                }else{
                    foreach ($data  as $key => $result) {
                  // $result = $result[0];
                    $csv = Report::firstOrNew(['title' =>$result->title.$rid ,'category_name'=> $result->category_name]);

                    $category       = Category::where('category_name',$result->category_name)->first();

                    foreach ($table_cname as $key => $value) {
                       if(in_array($value, $except )){
                            continue;
                       } 
                        $csv->$value = $result->$value;
                        
                        $csv->slug = date('Y').'-'.str_slug($result->title);
                        $csv->meta_title  =  $result->title;
                        $csv->title  =  implode(' ', array_slice(explode(' ', $result->title), 0, 7));
                       
                        $csv->category_name = $result->category_name;
                       
                       $csv->category_id = $category->id??null;

                       $csv->url = 'market-reports/'.date('Y').'-'.str_slug($result->title);


                       if(isset($result->$value)) {
                            

                        if($value=='meta_title'  && !empty($result->$value)){

                            $csv->meta_title  =   $result->$value;
                            
                        }else{
                            $csv->meta_title  =  implode(' ', array_slice(explode(' ', $result->title), 0, 7));
                        }
                                           
                        if($value=="title"){
                            $u = implode(' ', array_slice(explode(' ', $result->$value), 0, 7));
                            $csv->url = 'market-reports/'.date('Y').'-'.str_slug($u);
                        }
                        if($value=='meta_title' && !empty($result->$value)){  
                            $csv->meta_title  =   $result->$value;
                           
                         }else{
                             $csv->meta_title  =  $result->title;
                         }

                        if($value=='description'){
                            $csv->meta_description  = implode(' ', array_slice(explode(' ', $result->$value), 0, 80));
                            $csv->description = $result->$value;
                        }

                        if($value=='meta_description' && !empty($result->$value)){ 
                            $csv->meta_description  = implode(' ', array_slice(explode(' ', $result->$value), 0, 80));
                         }else{
                           $csv->meta_description  = implode(' ', array_slice(explode(' ', $result->description), 0, 80)); 
                         }
                           $status = 1;
                       }
                    }

                    if(isset($status) && $status==1){
                        $rs = $csv->save();
                        if($rs){
                            $r = Report::find($csv->id);
                            $r->report_id = $csv->id;
                            $r->url = $csv->url.'-'.$csv->id;
                            $r->slug = $csv->slug.'-'.$csv->id;
                            $r->title = $csv->title.' '.$csv->id;
                                
                            $r->save();
                        }
                        $status=0;
                     }
                }

                    if(isset($status)){
                        
                        return Redirect::back()->withErrors(['<p style="color:green">Data imported successfully!</p>']);
                    }else{
                        return Redirect::back()->withErrors(['Invalid file type or content.Please upload xls,xlsx file only']);
                    } 
                }
            }
            );

            } catch (\Exception $e) {
                return Redirect::back()->withErrors([$e->getMessage()]);
            } 
        }
        return view('packages::reports.excelImport', compact('category', 'page_title', 'page_action'));
   
    }

    public function importExcel(Request $request){


        $page_title = 'Reports';
        $page_action = 'Export Reports'; 

        $category = Category::all();

        if($request->method()=='POST')
        { 
            $start_date = Input::get('start_date');
            $end_date   = Input::get('end_date');
            $category_id = Input::get('category_name');
            $page_number = Input::get('page_number');
            $n = !empty($category_name)?'-'.$category_name:'';

            if($start_date &&  $end_date){
                $start_date = \Carbon\Carbon::createFromFormat('m-d-Y', $start_date)->format('d-m-Y');
                $end_date = \Carbon\Carbon::createFromFormat('m-d-Y', $end_date)->format('d-m-Y');
  
            }
            
            

            $page_number = ($page_number)?$page_number:123456789;
            $reportsname = "reports-".date('d-m-Y').$n;
            Excel::create($reportsname, function($excel) use($page_number,$start_date,$end_date,$category_id) {
                
                $url = url('/');

            $items=Report::select('*',\DB::raw("CONCAT('".$url."/',url) as ReportUrl"),'publish_date as PublishDate')->where(function($q) 
                use($page_number,$start_date,$end_date,$category_id){
            
                if($start_date && $end_date){
                    $q->whereBetween('publish_date',[date($start_date),date($end_date)]);
                }
                
                if(!empty($category_id)){ 
                    $q->where('category_id',$category_id);    
                } 
                
                
            })->orderBy('id','desc')->limit($page_number)->get();

           
            if(count($items)==0){
                $items = ['message'=>'Record not found']; 
            }
  
                $excel->sheet('Sheet', function($sheet) use($items){
                    $sheet->fromModel($items, null, 'A1', true);
                }); 

            })->download('xlsx');
          

        }



        return view('packages::reports.importExcel', compact('category', 'page_title', 'page_action'));
   
    }

    public function exportExcel(Request $request){


        $page_title = 'Reports';
        $page_action = 'View Reports'; 

        $category = Category::all();

        return view('packages::reports.importExcel', compact('category', 'page_title', 'page_action'));
   
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
                            $query->orWhere('category_name', 'LIKE', "%$search%");
                            $query->orWhere('category_id', "%$search%");
                        }
                        
                    })->Paginate($this->record_per_page);
        } else {
            $reports  = Report::orderBy('id','desc')->Paginate(10);
            
        } 

        $export = $request->get('export');
        if($export=='excel')
        {
            $reportsname = "reports-".date('d-M-Y');
            Excel::create($reportsname, function($excel) {
                
                $url = url('/');

            $items=Report::select('title as Title',\DB::raw("CONCAT('".$url."/',url) as ReportUrl"),'category_name as CategoryName','publish_date as PublishDate')->get();
              

                $excel->sheet('Sheet', function($sheet) use($items){
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
        $page_title = 'Report';
        $page_action = 'Create Report'; 
        $categories  = Category::all();
         
        $rptid = Report::select('id')->orderBy('id','desc')->limit(1)->first();
        
        $report_id  = intval($rptid->id)+1;

        return view('packages::reports.create', compact('reports','page_title', 'page_action','categories','report_id'));
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
        
        $rptid = Report::select('id')->orderBy('id','desc')->limit(1)->first();
        
        $report_id  = intval($rptid->id)+1;
        $reports->report_id = $report_id;

        $table_cname = \Schema::getColumnListing('reports');
        $except = ['id','create_at','updated_at','_token','photo','report_id','url'];
        $input = $request->all();
        
        $reports->slug = date('Y').'-'.str_slug($request->get('title')).'-'.$report_id;

        if($request->get('url')){
            $reports->url = 'market-reports/'.date('Y').'-'.str_slug($request->get('url')).'-'.$report_id;
        }else{
            $u = implode(' ', array_slice(explode(' ', $request->get('title')), 0, 7));
            $reports->url = 'market-reports/'.date('Y').'-'.str_slug($u).'-'.$report_id;
        }
        

        $cat = Category::find($request->get('category'));

        $reports->category_id = $request->get('category');
        $reports->category_name = $cat->category_name;

        foreach ($table_cname as $key => $value) {
           
           if(in_array($value, $except )){
                continue;
           }

           if(isset($input[$value])) {
               $reports->$value = $request->get($value); 
           } 
        }   

        if(empty($request->get('meta_title'))){  
            $reports->meta_title  =  $request->get('title');
           
         }
         
         if(empty($request->get('meta_description'))){ 
            $reports->meta_description  = implode(' ', array_slice(explode(' ', $request->get('description')), 0, 80));
         }
        $rs = $reports->save();
        
        if($rs){
            $r = Report::find($reports->id);
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

    public function edit(Report $reports) {

        $page_title     = 'Report';
        $page_action    = 'Edit Report'; 
        $categories     = Category::all();
        $type = ['Stories'=>'Stories','News'=>'News','Tips'=>'Tips'];  
        $category_id  = explode(',',$reports->category_id);
        $report_id = $reports->id;
 

         return view('packages::reports.edit', compact( 'reports' ,'page_title', 'page_action','categories','report_id','category_id'));
    }

    public function update(ReportRequest $request, Report $reports) 
    {
        
        $reports = Report::find($reports->id); 
        
        $cat = Category::find($request->get('category'));

        $reports->category_id = $request->get('category');
        $reports->category_name = $cat->category_name;


        
        if ($request->file('photo')) {  

            $photo = $request->file('photo');
            $destinationPath = storage_path('reports');
            $photo->move($destinationPath, time().$photo->getClientOriginalName());
            $photo = time().$photo->getClientOriginalName();
            $reports->photo   =   $photo; 
        } 
           
        
        $report_id = $reports->id;  
        
        $table_cname = \Schema::getColumnListing('reports');
        $except = ['id','create_at','updated_at','_token','photo','report_id'];
        $input = $request->all();
        
        $reports->slug = date('Y').'-'.str_slug($request->get('title')).'-'.$report_id;

        //$reports->url = 'market-reports/'.date('Y').'-'.str_slug($request->get('title')).'-'.$report_id;
        if($request->get('url')){
            $reports->url = 'market-reports/'.date('Y').'-'.str_slug($request->get('url')).'-'.$report_id;
        }else{
            $u = implode(' ', array_slice(explode(' ', $request->get('title')), 0, 7));
            $reports->url = 'market-reports/'.date('Y').'-'.str_slug($u).'-'.$report_id;
        }
        
        foreach ($table_cname as $key => $value) {
           
           if(in_array($value, $except )){
                continue;
           }

           if(isset($input[$value])) {
               $reports->$value = $request->get($value); 
           } 
        }  
        if(empty($request->get('meta_title'))){  
            $reports->meta_title  =  $request->get('title');
         }
         
         if(empty($request->get('meta_description'))){ 
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
                echo json_encode(['status'=>0,'message'=>'Please select  file!']); 
                exit(); 
            }
            $ext = $file->getClientOriginalExtension();

            $file_type = ['csv','xlsx','xls'];

            if(!in_array($ext, $file_type)){   
                echo json_encode(['status'=>0,'message'=>'Please select valid file!']); 
                exit(); 
            }
            $mime = $file->getMimeType(); 

            $upload = $this->uploadFile($file);
           
            $rs =    \Excel::load($upload, function($reader)use($request) {

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
                   if(in_array($value, $except )){
                        continue;
                   } 
                   if(isset($result->$value)) {
                        $dataArray[$value][] = $result->$value;
                   }
                }
            }
                $category = Category::all(['category_name']);
                $a = $category->toArray();

                $main_category      = array_column($a, 'category_name');
                $current_category   = $dataArray['category_name'];

                $not_cat =0;
                foreach ($current_category as $key => $cat) {
                    if(!in_array($cat, $main_category)){
                        $not_cat = 1;
                    }
                }


                if($not_cat==1){
                    echo  json_encode(['status'=>0,'message'=>'Invalid category name found in file']);
                    exit();
                }else{
                    foreach ($data  as $key => $result) {
                  // $result = $result[0];
                    $csv = Report::firstOrNew(['title' =>$result->title,'category_name'=> $result->category_name]);

                    $rptid          = Report::select('id')->orderBy('id','desc')->limit(1)->first();
                    $report_id      = intval($rptid->id)+1;
                    $category       = Category::where('category_name',$result->category_name)->first();

                    foreach ($table_cname as $key => $value) {
                       if(in_array($value, $except )){
                            continue;
                       } 
                        $csv->$value = $result->$value;
                        
                        $csv->slug = date('Y').'-'.str_slug($result->title).'-'.$report_id;
                        $csv->meta_title  =  implode(' ', array_slice(explode(' ', $result->title), 0, 7));
                        $csv->title  =  implode(' ', array_slice(explode(' ', $result->title), 0, 7));
                        $csv->report_id = $report_id;
                        $csv->category_name = $result->category_name;
                        $csv->category_id = $category->id??null;

                       $csv->category_id = $category->id??null;

                       $csv->url = 'market-reports/'.date('Y').'-'.str_slug($result->title).'-'.$report_id;


                       if(isset($result->$value)) {
                            

                        if($value=='meta_title'  && !empty($result->$value)){

                            $csv->meta_title  =  implode(' ', array_slice(explode(' ', $result->$value), 0, 7));
                            
                        }else{
                            $csv->meta_title  =  implode(' ', array_slice(explode(' ', $result->title), 0, 7));
                        }
                                           
                        if($value=="title"){
                            $csv->url = 'market-reports/'.date('Y').'-'.str_slug($result->$value).'-'.$report_id;
                        }
                        if($value=='meta_title' && !empty($result->$value)){  
                            $csv->meta_title  =  implode(' ', array_slice(explode(' ', $result->$value), 0, 7));
                           
                         }else{
                             $csv->meta_title  =  implode(' ', array_slice(explode(' ', $result->title), 0, 7));
                         }

                        if($value=='description'){
                            $csv->meta_description  = implode(' ', array_slice(explode(' ', $result->$value), 0, 80));
                            $csv->description = $result->$value;
                        }

                        if($value=='meta_description' && !empty($result->$value)){ 
                            $csv->meta_description  = implode(' ', array_slice(explode(' ', $result->$value), 0, 80));
                         }else{
                           $csv->meta_description  = implode(' ', array_slice(explode(' ', $result->description), 0, 80)); 
                         }
                           $status = 1;
                       }
                    }

                    if(isset($status) && $status==1){
                        $rs = $csv->save();
                        if($rs){
                            $r = Report::find($csv->id);
                            $r->report_id = $csv->id;
                            $r->save(); 
                        }
                        $status=0;
                     }
                }

                    if(isset($status)){
                        echo json_encode(['status'=>1,'message'=>' Data imported successfully!']);
                        exit(); 
                    }else{
                       echo json_encode(['status'=>0,'message'=>'Invalid file type or content.Please upload csv file only.']);
                       exit(); 
                    } 
                }
            }
        );

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
