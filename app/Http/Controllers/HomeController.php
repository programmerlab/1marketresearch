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
use Modules\Admin\Models\Press;

use Response;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
      public function __construct(Request $request,Settings $setting) { 
        
      //  dd($request);

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

        $banner             = $setting::where('field_key','LIKE',"%banner_image%")->get();

        $phone    = $setting::where('field_key','phone')->first();
        $mobile   = $setting::where('field_key','mobile')->first();
        
        $facebook_url    = $setting::where('field_key','facebook_url')->first();
        
        $linkedin_url    = $setting::where('field_key','linkedin_url')->first();
        
        $twitter_url     = $setting::where('field_key','twitter_url')->first();
        $website_logo  = $setting::where('field_key','website_logo')->first();

        $website_description  = $setting::where('field_key','website_description')->first();
        
        $google_anatycs  = $setting::where('field_key','google_analytics_code')->first();

        View::share('website_description',$website_description);
        View::share('google_anatycs',$google_anatycs);


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

        View::share('total_item',Cart::content()->count());
        View::share('sub_total',Cart::subtotal());
       
         
    }

    public function checkoutCoupon(Request $request){
        
        $data = $request->get('coupon_code');
        
        $cart = Cart::content();  
        $cart_details = [];
        foreach ($cart as $key => $value) {
            $cart_detail = $value;
        }
            
        $price =  $cart_detail->price; 
        
        

        $coupan_code = \DB::table('coupans')->where('coupan_code',$data)->first();

        if($coupan_code){
            
           
            
            $fix_discount =  $coupan_code->fix_discount;
            $percentage_discount = $price*($coupan_code->percentage_discount)/100;
            
            if($fix_discount>$percentage_discount){
                $discount = $fix_discount;
            }else{
                $discount = $percentage_discount;
            }
            
            $id =  $request->session()->get('shiping_id');
             
            if(!$id){
                echo json_encode(['status'=>0,'message'=>"Billing or shipping information is required"]); 
                exit();
            }
             
            $datas['coupon_code']    =  $coupan_code->coupan_code;
            $datas['discount']       =  $discount;
            $datas['price']          =  $price; 
            $datas['total_price']    =  $price-$discount;
            
            \DB::table('shipping_billing_addresses')->where('id',$id)->update($datas);
            
            echo json_encode(['status'=>1,'message'=>"Coupon $data is not valid",'data'=>$datas]); exit();
        }else{
            echo json_encode(['status'=>0,'message'=>"Coupon $data is not valid"]); exit();
        }

        
    }

    public function billing(Request $request){
        $request->session()->put('billing', $request->all());
      
        $table_cname = \Schema::getColumnListing('users');
        $except = ['id','created_at','updated_at','_token'];  
        $data = [];
        
        $user = User::firstOrNew(['email'=>$request->get('email')]);

        foreach ($table_cname as $key => $value) {
           
           if(in_array($value, $except )){
                continue;
           } 
            if($request->get($value)){
                $user->$value = $request->get($value);
           }
        }
        $rs =  $user->save();
        
        if($rs){
            $user = User::find($user->id);
            $user->emp_code = $user->id.'-'.time();
            $user->role_type = 4;
            $user->save();
            $request->session()->put('buyer_id', $user->id);
            
            
            $table_cname = \Schema::getColumnListing('shipping_billing_addresses');
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
            //order_notes
            //$value = $request->session()->get('key');
            
            $cart = Cart::content();  
            $cart_details = [];
            foreach ($cart as $key => $value) {
                $cart_detail = $value;
            }
            $data['report_id'] = $cart_detail->id;
            $data['user_id'] = $user->id;
            $data['reference_number'] = $cart_detail->id.'-'.time();
            $data['status'] = "pending";
            
            $id = \DB::table('shipping_billing_addresses')->insertGetId($data);
            
            $request->session()->put('shiping_id', $id);
            
            echo json_encode(['status'=>1,'message'=>"shipping_billing_addresses id $id"]); exit();
        }
      
    }

    public function ordernote(Request $request){
      $request->session()->put('orderNote', $request->all());
      
        $cart = Cart::content();  
        $cart_details = [];
        foreach ($cart as $key => $value) {
            $cart_detail = $value;
        }
        
        $id =  $request->session()->get('shiping_id');
        
        $data['report_id'] =  $cart_detail->id;
        
        $data['order_notes'] =  $request->get('order_notes');
        
        \DB::table('shipping_billing_addresses')->where('id',$id)->update($data);
      
    }

    public function paymentSummary(Request $request){
      $request->session()->put('paymentSummary', $request->all());
      
      
        $cart = Cart::content();  
        $cart_details = [];
        foreach ($cart as $key => $value) {
            $cart_detail = $value;
        }
        
        $id =  $request->session()->get('shiping_id');
        
        $data['report_id'] =  $cart_detail->id;
        $data['license_type'] =  $request->get('license_type');
        $data['price'] = $request->get('price');
        
        \DB::table('shipping_billing_addresses')->where('id',$id)->update($data);
        
      
    }

    public function makeOrder(Request $request){

      //$request->session()->put('orderinfo_final', $request->all());

      $data = $request->session()->all(); 
      
      echo json_encode($data); exit();

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

    public function allError(){

        $error = \DB::table('error_logs')->orderBy('id','desc')->limit(10)->get();
        return view('website.allError',compact('error'));
   
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

        
        

        $helper = new Helper;

        $subject = "1marketResearch-".$request->get('request_type');

        $report = Report::find($request->get('report_id'));
        if($report){
          $report_name = $report->title;
          $report_link = url('market-reports/'.$report->slug);
        }else{
          $report_name = '';
          $report_link = '';
        }
        $data = $request->except('_method','_token','report_id'); 
        
        $email_content = [
                'receipent_email'=> $request->input('email'),
                'subject'=> $subject,
                'greeting'=> '1marketresearch',
                'first_name'=> $request->input('name'),
                'from' => env('MAIL_FROM'),
                'addBCC' => env('MAIL_BCC'),
                'report_name' => $report_name,
                'report_link' => $report_link, 
                'data' => $data
                ];

        $helper->sendMail($email_content,'contact');
        unset($data['request_type']);
         $email_content = [
                'receipent_email'=> env('MAIL_TO'),
                'subject'=> $request->get('request_type'),
                'greeting'=> '1marketresearch',
                'first_name'=> $request->input('name'),
                'from' => env('MAIL_FROM'),
                'addBCC' => env('MAIL_BCC'),
                'report_name' => $report_name,
                'report_link' => $report_link, 
                'data' => $data
                ];

          $this->sendEmailTo($email_content);
       

         return Response::json(array(
                'status' => 1,
                'message' => 'Message sent successfully',
                'data'  =>  ''
                )
            ); 

    }

    public function sendEmailTo($email_content){
        $helper_admin = new Helper;
        $helper_admin->sendMailToAdmin($email_content,'admin');
    }

    public function askAnAnalyst(Request $request){

        $title = "Ask An Analyst";
        $report_id = $request->get('report_id');
        return view('website.contact',compact('title','report_id'));
    }

    public function requestSample(Request $request){
       $title = "Request Sample" ;
      $report_id = $request->get('report_id');
        return view('website.contact',compact('title','report_id'));
    }

    public function requestBrochure(Request $request){
        $title = "Request Brochure";
        $report_id = $request->get('report_id');
        return view('website.contact',compact('title','report_id'));
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

        $category =  Category::all();
       return view('website.category',compact('category'));
    }

    public function researchReports(Request $request,$name=null)
    {  

        $category_id = null;
        if($name){

            $category = Category::where('slug',$name)->first();
            $name = $category->category_name;
            $category_id = $category->id;
        }
        
        $search = $request->get('search');  

        $data = $reports =   Report::where(function($query) use($search,$name,$category_id) {
                        
                            if(!empty($search)){
                               // $query->Where('title', 'LIKE', "%$search%");
                                 $query->orWhere('category_name', 'LIKE', "%$search%");
                               // $query->orWhere('description', 'LIKE', "%$search%");
                                $query->orwhereRaw("MATCH(title) AGAINST(? IN BOOLEAN MODE)", array($search));
                            }
                            
                             if($name){
                                $query->where('category_name', 'LIKE', "%$name%");
                                $query->where('category_id',$category_id); 
                             }
                    })->orderBy('id','desc')->Paginate($this->page_size);
                    

        $title= "Market Research Reports";
        if($name){
            $title= ucwords($name)." Reports";
        }
         
        

        $categoryName = $request->get('search');
                  
       return view('website.categorydetails',compact('data','categoryName','reports','title'));
    }

    


    public function reportDetails(Request $request,$name)
    {  
       
       $data = \DB::table('reports')->where('slug',$name)->first();

       $category = Category::find($data->category_id);

       return view('website.reportDetails',compact('data','category'));
    }

    public function payment(Request $request){

    $cart = Cart::content(); 
        foreach ($cart as $key => $value) {
             Cart::remove($key);
    }


      $product = Report::find($request->get('payment_id'));

      $purl = URL::previous();

      if(!$product){
        return Redirect::to($purl);
      } 

        $signle_user_license        = $product->signle_user_license<=>$request->get('price');
        $multi_user_license         = $product->multi_user_license<=>$request->get('price');
        $corporate_user_license     = $product->corporate_user_license<=>$request->get('price');


        $l[]        = $product->signle_user_license<=>$request->get('price');
        $l[]        = $product->multi_user_license<=>$request->get('price');
        $l[]        = $product->corporate_user_license<=>$request->get('price');


        $ls = ['signle user license','multi user license','corporate user license'];

        $license_type = 'invalid';
        if($l[0]==0){
           $license_type = $ls[0]; 
        }
        elseif($l[1]==0){
           $license_type = $ls[1]; 
        }
        elseif($l[2]==0){
           $license_type = $ls[2]; 
        }

        if($signle_user_license===0 || $multi_user_license===0 || $corporate_user_license===0){

            $qty = 1;
            $id  = $product->id;
            $is_item_exist = 0;
            foreach(Cart::content() as $row) {
                if($row->id==$id)
                {
                    $is_item_exist++;
                    break;
                }
            }

            if($is_item_exist==0){
                if ($request->isMethod('get')) {
                    Cart::add(array(
                            'id' => $product->id, 
                            'name' => $product->title, 
                            'qty' => $qty, 
                            'price' => $request->get('price'),
                            'options' => ['license_type' => $license_type,'user'=>$request->session()->all()]
                        )
                    );
                }
            }
            
            $cart = Cart::content();  
            $cart_details = [];
            foreach ($cart as $key => $value) {
                $cart_detail = $value;
            }

            $reports = $product;
            return view('website.payment',compact('reports','cart_detail'));
    
        }else{
             return Redirect::to($purl);
      
        }
      
    
   }
    
  public function directBankTransfer(Request  $request){
        $reports = Cart::content();
            $cart_details = [];
            foreach ($reports as $key => $value) {
                $cart_detail = $value;
        }

        $billing = $cart_detail->options->user['billing'];
        $email_content = [
                'receipent_email'=> $billing['email'],
                'subject'=> 'Thank you for your order',
                'greeting'=> '1marketresearch',
                'first_name'=> $billing['first_name'],
                'from' => env('MAIL_FROM'),
                'billing' => $billing,
                'cart_detail' => $cart_detail
                ];

        $request->session()->put('order_mail', 1);

        $order_mail = $request->session()->get('order_mail');
        if(!$order_mail){
            $helper = new Helper;
            $helper->sendMail($email_content,'directBankTransfer');
        }

    return view('website.directBankTransfer',compact('reports','cart_detail','billing'));
  }
 /*----------*/
    public function checkout()
    {
         
         $request = new Request;

        
        $products = Product::with('category')->orderBy('id','asc')->get();
        $categories = Category::nested()->get(); 
        return view('end-user.checkout',compact('categories','products','category'));   
    }

   
    public function order(Request $request)
    { 
        $cart = Cart::content();
        $products = Product::with('category')->orderBy('id','asc')->get();
        $categories = Category::nested()->get(); 
        return view('end-user.order',compact('categories','products','category','cart'));   
         
    }
 

    public function contact(Request $request)
    {
      $report_id = $request->get('report_id');
      return view('website.contact',compact('report_id'));  
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
      $reports = Press::orderBy('id','desc')->Paginate($this->page_size); //Paginate(5);

      return view('website.pressRelease',compact('category','reports','title'));
   }


   public function pressReleaseDetails(Request $request, $name=null){

      $title = "Press Release";
      $category =  Category::all(); 
      $data = Press::where(function($q) use($name){ 
        $q->Where('slug', 'LIKE', "%$name%");
      })->orderBy('id','desc')->first();//Paginate(5);
       
      return view('website.pressReleaseDetails',compact('category','data','title'));
   }

    
}
