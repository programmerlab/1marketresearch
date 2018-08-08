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
use Response;


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

        $phone    = $setting::where('field_key','phone')->first();
        $mobile   = $setting::where('field_key','mobile')->first();
        
        $facebook_url    = $setting::where('field_key','facebook_url')->first();
        
        $linkedin_url    = $setting::where('field_key','linkedin_url')->first();
        
        $twitter_url     = $setting::where('field_key','twitter_url')->first();
        $website_logo  = $setting::where('field_key','website_logo')->first();

         View::share('phone',$phone);
         View::share('mobile',$mobile); 
         View::share('website_logo',$website_logo);

         View::share('facebook_url',$facebook_url);
         View::share('linkedin_url',$linkedin_url);
         View::share('twitter_url',$twitter_url);

         View::share('website_title',$website_title);
         View::share('website_email',$website_email);
         View::share('website_url',$website_url);
         View::share('contact_number',$contact_number);
         View::share('company_address',$company_address);
         View::share('banner',$banner);  

        $base_page =  Route::currentRouteName();


        $meta_title      = $setting::where('field_key','meta_title')->first();
        $meta_key      = $setting::where('field_key','meta_key')->first();
        $meta_description      = $setting::where('field_key','meta_description')->first();
 


        $uri = explode('/',ltrim($request->getpathInfo(),'/'));
        
        $meta_title = isset($meta_title->field_value)?$meta_title->field_value:$website_title->field_value;
        $meta_key   = isset($meta_key->field_value)?$meta_key->field_value:$website_title->field_value;
        $meta_desc  = isset($meta_description->field_value)?$meta_description->field_value:$website_title->field_value;

        if(count($uri)==2){
            if($uri[0]=='market-reports'){

                $meta = \DB::table('reports')->where('slug',$uri[1])->first();

                $meta_title = $meta->meta_title;
                $meta_key = $meta->meta_key;
                $meta_desc = $meta->meta_description;

            }
            elseif($uri[0]=='category'){
                $meta = \DB::table('categories')->where('slug',$uri[1])->first();

                $meta_title = $meta->category_name;
                $meta_key = $meta->meta_key;
                $meta_desc = $meta->meta_description;
            }else{

            }
        }else{
            $meta_title = ($uri[0]=="")?$meta_title:$uri[0];
            $meta_key   = ($uri[0]=="")?$meta_key:$uri[0];
            $meta_desc  = ($uri[0]=="")?$meta_desc:$uri[0];
        }

         View::share('meta_title',$meta_title);
         View::share('meta_key',$meta_key);
         View::share('meta_desc',$meta_desc);

         $this->page_size = 5;
         
    }


    public function error404(){
       $title = "Page not found";
        return view('website.404',compact('title'));
    }

    public function thankyou($name){
        $title = "ThankYou!";
        return view('website.thanku',compact('title'));
    }

    public function home(Request $request){
        $category =  Category::all(); 

        $reports = Report::orderBy('id','desc')->Paginate($this->page_size); //Paginate(5);

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

        
         return Response::json(array(
                'status' => 1,
                'message' => 'Message sent successfully',
                'data'  =>  ''
                )
            ); 

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

    public function page(Request $request,$page=null){
        
        
        $pages = \DB::table('pages')->where('slug',$page)->first();
        $title = isset($pages->title)?$pages->title:'Page Not Found';

        if($pages==null){
          return Redirect::to('404');
        }

        return view('website.page',compact('title','pages'));
    }

    public function category(Request $request,$name=null)
    {  
        $category = \DB::table('categories')->where('slug',$name)->first();
        
        $categoryName = $category->category_name;
 
        $data    = Report::where('category_id',$category->id)->Paginate($this->page_size);
        $reports = $data;
         

       return view('website.categorydetails',compact('data','categoryName','reports'));
    }

    public function researchReports(Request $request)
    {  
        $search = $request->get('search');  

        $data = $reports =   Report::where(function($query) use($search) {
                        if (!empty($search)) {
                            $query->Where('title', 'LIKE', "%$search%");
                             $query->orWhere('category_name', 'LIKE', "%$search%");
                              $query->orWhere('description', 'LIKE', "%$search%");
                        }
                        
                    })->Paginate($this->page_size);

        
        $categoryName = $request->get('search');
                  
       return view('website.categorydetails',compact('data','categoryName','reports'));
    }

    


    public function reportDetails(Request $request,$name)
    {  
       
       $data = \DB::table('reports')->where('slug',$name)->first();

       $category = Category::find($data->category_id);

       return view('website.reportDetails',compact('data','category'));
    }

    public function payment(Request $request){

      $reports = Report::find($request->get('payment_id'));

      $purl = URL::previous();
       
      if(!$reports){
        return Redirect::to($purl);
      } 

      return view('website.payment',compact('reports'));
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

      $title = "Press Release";
      $category =  Category::all(); 
      $reports = Report::orderBy('id','desc')->Paginate($this->page_size); //Paginate(5);
 
      return view('website.pressRelease',compact('category','reports','title'));
   }

    
}
