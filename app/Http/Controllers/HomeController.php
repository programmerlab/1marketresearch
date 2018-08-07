<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth; 
use Modules\Admin\Models\User;
use Modules\Admin\Models\Category;
use Modules\Admin\Models\Product;
use Modules\Admin\Models\Transaction;
use View;
use Html;
use URL; 
use Validator; 
use Paginate;
use Grids; 
use Form;
use Hash; 
use Lang;
use Session;
use DB;
use Route;
use Crypt;
use Redirect;
use Cart;
use Input;
use App\Helpers\Helper as Helper;
use Modules\Admin\Models\Settings; 
use Modules\Admin\Models\Report; 


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
      public function __construct(Request $request,Settings $setting) { 
        View::share('helper',new Helper);
        View::share('category_name',$request->segment(1));
        View::share('total_item',Cart::content()->count());
        View::share('sub_total',Cart::subtotal()); 
        View::share('userData',$request->session()->get('current_user'));
 
        $website_title      = $setting::where('field_key','website_title')->first();
        $website_email      = $setting::where('field_key','website_email')->first();
        $website_url        = $setting::where('field_key','website_url')->first();
        $contact_number     = $setting::where('field_key','contact_number')->first();
        $company_address    = $setting::where('field_key','company_address')->first();

        $banner             = $setting::where('field_key','LIKE','%banner_image%')->get();


         View::share('website_title',$website_title);
         View::share('website_email',$website_email);
         View::share('website_url',$website_url);
         View::share('contact_number',$contact_number);
         View::share('company_address',$company_address);
         View::share('banner',$banner);  

        $base_page =  Route::currentRouteName();

         
         
    }

    public function home(Request $request){
        $category =  Category::all(); 

        $reports = Report::all(); //Paginate(5);

//        dd($reports);
        return view('website.home',compact('category','reports'));
    }

    public function saveForm(Request $request){
      
         $validator = Validator::make($request->all(), [
                'email' => 'required',
                'name'=>'required' 
            ]);
         if ($validator->fails()) {
                    $error_msg  =   [];
            foreach ( $validator->messages()->all() as $key => $value) {
                        array_push($error_msg, $value);     
                    }
                            
            return \Response::json(array(
                'status' => 0,
                'message' => $error_msg[0],
                'data'  =>  ''
                )
            );
             exit();
        }


        $table_cname = \Schema::getColumnListing('contacts');
        $except = ['id','created_at','updated_at','_token'];  
        $data = [];
        foreach ($table_cname as $key => $value) {
           
           if(in_array($value, $except )){
                continue;
           } 
            if($request->get($value)){
                $data[$value] = $request->get($value);
           }
        }
        \DB::table('contacts')->insert($data);

        
         return \Response::json(array(
                'status' => 1,
                'message' => 'Message sent successfully',
                'data'  =>  ''
                )
            );
         exit();

    }

    public function askAnAnalyst(Request $request){

        $title = "Ask An Analyst";
        return view('website.contact',compact('title'));
    }

    public function requestSample(Request $request){
       $title = "Request Sample" ;
       return view('website.contact',compact('title'));
    }

    public function requestBrochure(Request $request){
        $title = "Request Brochure";
        return view('website.contact',compact('title'));
    }

    public function page(Request $request,$page){

        $title = $page;

        $pages = \DB::table('pages')->where('title',$page)->first();

        return view('website.page',compact('title','pages'));
    }

    public function category(Request $request,$name=null)
    {  
        $category = \DB::table('categories')->where('slug',$name)->first();
        
        $categoryName = $category->category_name;

        $data = \DB::table('reports')->where('category_id',$category->id)->get();


       return view('website.categorydetails',compact('data','categoryName'));
    }

    public function researchReports(Request $request)
    {  
        $search = $request->get('search');

        $data = \DB::table('reports')
                ->where('title','LIKE',"%$search%")
                ->orWhere('category_name','LIKE',"%$search%")
                ->orWhere('description','LIKE',"$search%")
                    ->get();
        
        $categoryName = $request->get('search');
                    
       return view('website.categorydetails',compact('data','categoryName'));
    }

    


    public function reportDetails(Request $request,$name)
    {  
       
       $data = \DB::table('reports')->where('slug',$name)->first();

       return view('website.reportDetails',compact('data'));
    }

    public function payment(){
      return view('website.payment'); 
    }
 
 /*----------*/
    public function checkout()
    {
         
         $request = new Request;

        
        $products = Product::with('category')->orderBy('id','asc')->get();
        $categories = Category::nested()->get(); 
        return view('end-user.checkout',compact('categories','products','category'));   
    }

     /*----------*/
    public function mainCategory( $category=null)
    {   
        $request = new Request;
        $q = Input::get('q'); 
         
        $catID = Category::where('slug',$category)->orWhere('name',$category)->first();
        if($catID!=null && $catID->count()){ 

            $sub_cat = Category::where('parent_id', $catID->id)->Orwhere('id', $catID->id)->lists('id');
             
            $products = Product::with('category')->whereIn('product_category',$sub_cat)->orderBy('id','asc')->get();
             
            if($products->count())
            { 
                 
                $products = Product::with('category')->whereIn('product_category',$sub_cat) 
                                ->orderBy('id','asc')
                                ->get();
                 if($q)
                 {
                    $products = Product::with('category')->whereIn('product_category',$sub_cat)
                                ->where('product_title','LIKE','%'.$q.'%')
                                ->orderBy('id','asc')
                                ->get(); 
                 }  
            } 
        }else{
            $products = Product::with('category')->where('product_category',0)->orderBy('id','asc')->get();

        } 
        $category = isset($catID->name)?$catID->name:null; 
        $categories = Category::nested()->get();  
        return view('end-user.category',compact('categories','products','category','q','category','catID','helper'));   
    }

     /*----------*/
    public function productCategory( $category=null)
    {  
        $request = new Request;
        $q = Input::get('q'); 
         
        $catID = Category::where('slug',$category)->orWhere('name',$category)->first(); 
        if($catID!=null && $catID->count()){ 
            $products = Product::with('category')->where('product_category',$catID->id)->orderBy('id','asc')->get();
            
            if($products->count()==0)
            {
                  
                  $products = Product::with('category')->whereIn('product_category',[$catID->id]) 
                                ->orderBy('id','asc')
                                ->get();
                 if($q)
                 {
                    $products = Product::with('category')->whereIn('product_category',[$catID->id])
                                ->where('product_title','LIKE','%'.$q.'%')
                                ->orderBy('id','asc')
                                ->get();
           
                 } 
            } 
        }else{
            $products = Product::with('category')->where('product_category',0)->orderBy('id','asc')->get();

        } 
         $category = isset($catID->name)?$catID->name:null; 
        $categories = Category::nested()->get(); 
        return view('end-user.category',compact('categories','products','category','q','category'));   
    }
    /*----------*/
    public function productDetail($subCategoryName=null,$productName=null)
    {   
        $product = Product::with('category')->where('slug',$productName)->first();
         
        $categories = Category::nested()->get();  
         
        if($product==null)
        {
             $url =  URL::previous().'?error=InvaliAccess'; 
              return Redirect::to($url);
        }else{
          $product->views=$product->views+1;
          $product->save(); 
        } 
        $main_title=  $product->product_title;
        return view('end-user.product-details',compact('categories','product','main_title','helper'));  
    }
     /*----------*/
    public function order(Request $request)
    { 
        $cart = Cart::content();
        $products = Product::with('category')->orderBy('id','asc')->get();
        $categories = Category::nested()->get(); 
        return view('end-user.order',compact('categories','products','category','cart'));   
         
    }
 

    public function contact()
    {
      return view('website.contact');  
    }

    public function services()
    {
      return view('website.services');  
    }

    public function publisher()
    {
      return view('website.publisher');  
    }

   public function pressRelease(){

    return view('website.pressRelease');
   }

    
}
