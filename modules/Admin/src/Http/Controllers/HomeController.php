<?php
namespace Modules\Admin\Http\Controllers;


use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Modules\Admin\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Modules\Admin\Models\User;
use Input;
use Validator;
use Auth;
use Paginate;
use Grids;
use HTML;
use Form;
use View;
use URL;
use Lang;
use Route;
use App\Http\Controllers\Controller; 

/**
 * Class AdminController
 */
class HomeController extends Controller { 
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
    **/
    public function index(User $user) { 
         
       return view('packages::auth.create', compact('user'));
    } 

    public function deleteAll(Request $request){
        $ids = $request->get('ids');
        $table = $request->get('table');
        $status = 0;
        
        if(count($ids )){
           foreach ($ids as $key => $value) {
            \DB::table($table)->where('id',$value)->delete();
            $status =1;
            } 
        }
        
        
        if($status==1){
            echo "true";
        }else{
            echo "false";
        }
        exit();
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
            if($file==NULL || $ext!='csv'){
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

            $contact =  new Report;
            foreach ($data  as $key => $result) {
                foreach ($table_cname as $key => $value) {
                   if(in_array($value, $except )){
                        continue;
                   }
                   if(isset($result->$value)) {
                       $contact->$value = $result->$value; 
                       $status = 1;
                   } 
                }
                 if(isset($status)){
                     $contact->save(); 
                 }
            } 
           
            if(isset($status)){
                echo json_encode(['status'=>1,'message'=>' Data imported successfully!']);
            }else{
               echo json_encode(['status'=>0,'message'=>'Invalid file type or content.Please upload csv file only.']);
            }
             
            });

        } catch (\Exception $e) {
            echo json_encode(['status'=>0,'message'=>'Please select csv file!']); 
            exit(); 
        } 
    } 

}
