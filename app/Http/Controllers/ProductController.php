<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use Modules\Admin\Http\Requests\ProductRequest;
use Modules\Admin\Models\User;
use Modules\Admin\Models\Category;
use Modules\Admin\Models\Product; 
use Modules\Admin\Models\ShippingBillingAddress;
use Modules\Admin\Models\Transaction;
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
use App\Helpers\Helper;
use Response;
use Cart; 
use PDF;
use Modules\Admin\Models\Settings;
use Illuminate\Contracts\Encryption\DecryptException;

/**
 * Class AdminController
 */
class ProductController extends Controller {
    /**
     * @var  Repository
     */

    /**
     * Displays all admin.
     *
     * @return \Illuminate\View\View
    
     */

    private $user_id;

    public function __construct(Request $request, Settings $setting) {
        
        View::share('category_name', $request->segment(1));
        View::share('total_item',Cart::content()->count());
        View::share('sub_total',Cart::subtotal());
        View::share('helper',new Helper);

        View::share('userData',$request->session()->get('current_user'));
         if ($request->session()->has('current_user')) { 

            $this->user_id = $request->session()->get('current_user')->id;

        }else{
            $this->user_id = "";
        }

         if ($request->session()->has('tab')) { 
          View::share('tab',$request->session()->get('tab'));
       
        }else{
            View::share('tab',"0");
       
        }

        $hot_products   = Product::orderBy('views','desc')->limit(3)->get();
        $special_deals  = Product::orderBy('discount','desc')->limit(3)->get(); 
        View::share('hot_products',$hot_products);
        View::share('special_deals',$special_deals);  

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

        $path_info = explode('/', $request->getpathInfo());
        $md = ($setting::where('field_key','meta_description')->first());
        $mk = ($setting::where('field_key','meta_key')->first());
          
        if($base_page == 'homePage'){
            $meta_description =  isset($md->field_value)?$md->field_value:'';
            $meta_key         =  isset($mk->field_value)?$mk->field_value:'';
        }
        elseif($base_page == 'productName'){
            $data = Product::where('slug',$path_info[2])->first();
            $meta_description = $data->meta_description;
            $meta_key = $data->meta_key;
        }
        elseif($base_page == 'productcategory'){ 
         
            $data = Category::where('slug',$path_info[1])->first();
            $meta_description = $data->meta_description;
            $meta_key = $data->meta_key;

        }else{
           $meta_description =  isset($md->field_value)?$md->field_value:'';
            $meta_key         =  isset($mk->field_value)?$mk->field_value:'';
        }
 
        View::share('meta_description',$meta_description);
        View::share('meta_key',$meta_key); 
        View::share('getpathInfo',$request->getpathInfo());
 
    }

    public function showProduct(Request $request, Product $product)
    {    
         $category = Input::get('q'); 
         $q = Input::get('q');
         $categories     = Category::nested()->get();  
         if($q)
         {
            $products = Product::with('category')
                        ->where('product_title','LIKE','%'.$q.'%')
                        ->orderBy('id','asc')
                        ->get(); 
            $categories = Category::nested()->get(); 
            return view('end-user.category',compact('categories','products','category','q','category'));
             
         } 
         else{
            $products       = Product::with('category')->groupBy('product_category')->orderBy('views','desc')->get(); 

            $product_new    = Product::with('category')->orderBy('id','desc')->groupBy('product_category')->Paginate(12); 
         }
        
         


 
        return view('end-user.home', compact('special_deals','hot_products','banner_path1', 'banner_path2','categories','products','product_new','helper')); 
    }

    /*
     * Dashboard
     * */

    public function index(Request $request) 
    {  
        
        $cart = Cart::content();  
        $pid = [];
        foreach ($cart as $key => $value) {
            $pid[] = $value->id;
        }
        $product_photo =   Product::whereIn('id',$pid)->get(['photo','id'])->toArray();
         
        return view('cart', compact('cart','product_photo'));
    }


    public function checkout(Request $request) 
    {  
        $cart = Cart::content();  
        if(count($cart)==0){
            return Redirect::to('/');
        }
        $pid = [];
        foreach ($cart as $key => $value) {
            $pid[] = $value->id;
        }
        $product_photo =   Product::whereIn('id',$pid)->get(['photo','id'])->toArray();
       // dd($product_photo);
       // dd($cart);
        $products = Product::with('category')->whereIn('id',$pid)->orderBy('id','asc')->get();
        $categories = Category::nested()->get(); 

        return view('end-user.checkout',compact('categories','products','category','cart','product_photo'));  
    }


    public function addToCart(Request $request, $name,$id) 
    { 
       
         $item =  $request->get('item'); 
         if($item ){
            $qty = substr($item,-1);
         } else{
            $qty = 1;
         } 
        if ($request->isMethod('get')) {
            $product_id = $request->get('id');
            $product = Product::find($id);   
            Cart::add(array('id' => $product->id, 'name' => $product->product_title, 'qty' => $qty, 'price' => $product->price,'photo'=>$product->photo));
        }
        $cart = Cart::content();  
       // $request->session()->put('key', 'value');
        
         return Redirect::to(url()->previous());
         
    }

    public function buyNow(Request $request, $name,$id) 
    {    
         $item =  $request->get('item'); 
         if($item ){
            $qty = substr($item,-1);
         } else{
            $qty = 1;
         } 
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
                $product_id = $request->get('id');
                $product = Product::find($id);   
                Cart::add(array('id' => $product->id, 'name' => $product->product_title, 'qty' => $qty, 'price' => $product->price,'photo'=>$product->photo));
            }   
        }
           
        $cart = Cart::content();  
       // $request->session()->put('key', 'value');
         return Redirect::to('checkout');
         
    }

    public function updateCart(Request $request) 
    { 
        if ($request->get('product_id') && ($request->get('increment')) == 1) {
           
            $rowId = Cart::search(function($key, $value) use($request)
                        { 
                            return $key->id == $request->get('product_id'); 
                        }
                    );
            foreach ($rowId as $key => $value) {
                $rowId = $value->rowId; 
            }
              $item = Cart::get($rowId);
              $qty = intval($item->qty)+1;
              Cart::update($rowId,$qty);
            return Redirect::to('checkout');
        }
        elseif ($request->get('product_id') && ($request->get('decrease')) == 1) {  
           $rowId = Cart::search(function($key, $value) use($request)
                        { 
                            return $key->id == $request->get('product_id'); 
                        }
                    );
            $total_qty = 0;
            foreach ($rowId as $key => $value) {
                $rowId = $value->rowId;
                $total_qty = $value->qty-1;
            }
            Cart::update($rowId, intval($total_qty));
            return Redirect::to('checkout');
        }
    }

    public function clearCart(Request $request, Cart $cart)
    {
        $cart = Cart::content(); 
        foreach ($cart as $key => $value) {
             Cart::remove($key);
        }

        return Redirect::to('product');
    }

    

    public function getProduct(Request $request, Product $product)
    {
        $products = Product::with('category')->orderBy('id','asc')->get();
        $categories = Category::nested()->get(); 
         $cart = Cart::content(); 
    
         return json_encode(array(
                'status' => 1,
                'message' => 'success',
                'cart'  => count($cart),
                'data'  =>  $products
                )
            ); 
    } 

    public function removeItem($id)
    {
        $rowId = Cart::search(function($key, $value) use($id)
            { 
                return $key->id == $id; 
            }
        );
        foreach ($rowId as $key => $value) {
            $rowId = $value->rowId; 
        }
        $item = Cart::get($rowId); 
        Cart::remove($rowId);
        return Redirect::to('checkout');
    }


    public function order(Request $request)
    { 
        $cart = Cart::content();
        $products = Product::with('category')->orderBy('id','asc')->get();
        $categories = Category::nested()->get(); 

        $billing    = ShippingBillingAddress::where('user_id',$this->user_id)->where('address_type',1)->first(); 

        $shipping   = ShippingBillingAddress::where('user_id',$this->user_id)->where('address_type',2)->first(); 


        return view('end-user.order',compact('categories','products','category','cart','billing','shipping'));   
         
    }


    public function billing(ShippingBillingAddress $shipBill, Request $request)
    {
       
        $bill =  ShippingBillingAddress::where('user_id',$this->user_id)->where('address_type',1)->first();

        if($bill) 
        {
            $shipBill = ShippingBillingAddress::find($bill->id);
        }
        
        $shipBill->name = $request->get('name');
        $shipBill->email = $request->get('email');
        $shipBill->mobile = $request->get('mobile');
        $shipBill->address1 = $request->get('address1');
        $shipBill->user_id = $this->user_id;
        $shipBill->address_type = 1; 
 
        $shipBill->save();
        $request->session()->put('tab',2);
        $request->session()->put('billing',$shipBill);
        return Redirect::to('order');


    }

    public function shipping(ShippingBillingAddress $shipBill, Request $request)
    {
        $shipping = ShippingBillingAddress::where('user_id',$this->user_id)->where('address_type',2)->first();

        if($shipping) 
        {
            $shipBill = ShippingBillingAddress::find($shipping->id);
        }
        
        $shipBill->name     = $request->get('name');
        $shipBill->email    = $request->get('email');
        $shipBill->mobile   = $request->get('mobile');
        $shipBill->address1 = $request->get('address1');
        $shipBill->address2 = $request->get('address2');
        $shipBill->zip_code = $request->get('zip_code');
        $shipBill->city     = $request->get('city');
        $shipBill->state    = $request->get('state');
        $shipBill->user_id  = $this->user_id;
        $shipBill->address_type = 2;  
        $shipBill->save();
        $request->session()->put('shipping',$shipBill);
        $request->session()->put('tab',3);
         return Redirect::to('order');
        
    }

    public function shippingMethod(hippingBillingAddress $shipBill, Request $request)
    {
        

        $shipping = ShippingBillingAddress::where('user_id',$this->user_id)->where('address_type',2)->first();

        if($shipping) 
        {
            $shipBill = ShippingBillingAddress::find($shipping->id);
        }

        $shipping->payment_mode = "COD";
        $shipBill->user_id  = $this->user_id;
        $shipBill->address_type = 2;
        $shipBill->save();
         $request->session()->put('tab',4);
        return Redirect::to('order');
        
    }

    public function placeOrder(Request $request)
    {
        
    }

    public function thankYou(Request $request)
    {
        $user_id    = $this->user_id;
        $cart       = Cart::content();

        if($cart->count()==0)
        {
           return  Redirect::to('checkout');
        }
        if($user_id=="")
        {
           return  Redirect::to('order');
        }

        $products   = Product::with('category')->orderBy('id','asc')->get();
        $categories = Category::nested()->get(); 

        $billing    = ShippingBillingAddress::where('user_id',$this->user_id)->where('address_type',1)->first();
        $shipping   = ShippingBillingAddress::where('user_id',$this->user_id)->where('address_type',2)->first(); 


        foreach ($cart as $key => $result) {

            $transaction                = new Transaction;
            $transaction->user_id       = $user_id;
            $transaction->product_name  = $result->name;
            $transaction->product_id    = $result->id;
            $transaction->total_price   = $result->price;
            $transaction->discount_price= $result->price;
            $transaction->payment_mode  = "COD";
            $transaction->transaction_id = strtotime("now");
            $transaction->product_details = json_encode(Product::where('id',$result->id)->get()->toArray());
            $transaction->save();
             
        } 
        $cart = Cart::content();  
        if($cart){
            
            $email_content['subject'] = "Invoice";
            $template = "invoice";
            if($billing){
                $email_content['receipent_email'] = ($billing->email)?$billing->email:(Auth::user()->email);
                $template_content = ['cart'=>$cart ,'billing' => $billing , 'shipping' => $shipping,'transaction'=>$transaction];
                
            }else{
                $email_content['receipent_email'] = ($shipping->email)?$shipping->email:(Auth::user()->email);
           
                $template_content = ['cart'=>$cart ,'billing' => $shipping , 'shipping' => $shipping,'transaction'=>$transaction];
                
            }
            $data = $template_content; 
         	
          $helper =  new   Helper;
          $helper->sendInvoiceMail($email_content, $template, $template_content);
        } 


        foreach ($cart as $key => $value) {
             Cart::remove($key);
        }
        return view('end-user.thanku',compact('categories','products','category','cart','billing','shipping'));
    }
    public function showLoginForm(Request $request)
    {
  
        $cart       = Cart::content(); 
        $products   = Product::with('category')->orderBy('id','asc')->get();
        $categories = Category::nested()->get(); 
        
        return view('end-user.login',compact('categories','products','category','cart'));

    }
    public function showSignupForm(Request $request)
    {
        $cart       = Cart::content(); 
        $products   = Product::with('category')->orderBy('id','asc')->get();
        $categories = Category::nested()->get(); 

        return view('end-user.register',compact('categories','products','category','cart'));

    }

    public function myaccount(Request $request)
    {
        
        if($this->user_id=="")
        {      
            return Redirect::to('myaccount/login');
        }
        $cart = Cart::content();
        $products = Product::with('category')->orderBy('id','asc')->get();
        $categories = Category::nested()->get(); 

        $billing    = ShippingBillingAddress::where('user_id',$this->user_id)->where('address_type',1)->first(); 

        $shipping   = ShippingBillingAddress::where('user_id',$this->user_id)->where('address_type',2)->first(); 
        $transaction                = Transaction::where('user_id',$this->user_id)->get();


        return view('end-user.myaccount',compact('transaction','categories','products','category','cart','billing','shipping'));

    }
    
    public function sendResetPasswordLink(Request $request)
    {

        $cart       = Cart::content(); 
        $products   = Product::with('category')->orderBy('id','asc')->get();
        $categories = Category::nested()->get(); 

        return view('end-user.forgetPasswordForm',compact('categories','products','category','cart'));
    }


    public function resetPassword(Request $request)
    { 
        
        $cart       = Cart::content(); 
        $products   = Product::with('category')->orderBy('id','asc')->get();
        $categories = Category::nested()->get(); 
 
        $encryptedValue = ($request->get('key'))?$request->get('key'):''; 
        $method_name = $request->method();
        $token = $request->get('token');
        $email = ($request->get('email'))?$request->get('email'):'';
        $key = ($request->get('key'))?$request->get('key'):''; 
        

        if($method_name=='GET')
        {    
            try { 
                $email = Crypt::decrypt($encryptedValue);
                if (Hash::check($email, $token)) {
                   return view('end-user.resetPasswordForm',compact('categories','products','category','cart','token','email','key'));

                }else{
                    return redirect()
                        ->back()
                        ->withInput()  
                        ->withErrors(['message'=>'Invalid reset password link!']);
                } 
                
            } catch (DecryptException $e) {

                return view('end-user.resetPasswordForm',compact('categories','products','category','cart','token','email','key'))
                            ->withErrors(['message'=>'Invalid reset password link!']);

               }
            
        }else
        {    

           try { 

                $validator = Validator::make($request->all(), [
                    'password' => 'required',
                    'confirm_password' => 'required|same:password'

                                    ]);

                if ($validator->fails()) {

                    return redirect()
                                ->back()
                                ->withInput()
                                ->withErrors($validator);
                    }

                $email = Crypt::decrypt($encryptedValue);
                $token = $request->get('token');
                
                if (Hash::check($email, $token)) {
                     
                    $password =  Hash::make($request->get('password'));
                    $user = User::where('email',$request->get('email'))->update(['password'=>$password]);
                    
                    return redirect()
                            ->back()
                            ->withInput()  
                            ->withErrors(['message'=>'Password reset successfully!','class'=>' ']);

                }else{
                     
                     //return Redirect::to(URL::previous())->with('message','Invalid token');
                     return redirect()
                            ->back()
                            ->withInput()  
                            ->withErrors(['message'=>'Invalid reset password link!']);
                }
            }catch (DecryptException $e) {

                 return redirect()
                            ->back()
                            ->withInput()  
                            ->withErrors(['message'=>'Invalid reset password link!']);

               }
            
        }
        
    }

    public function forgetPasswordLink(Request $request)
    {  
        $email = $request->input('email');
        //Server side valiation
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        $helper = new Helper;
       
        if ($validator->fails()) {
            

        return redirect()
                        ->back()
                        ->withInput()  
                        ->withErrors(['message'=>'Email id is required!']);
        }

        $user =   User::where('email',$email)->first();

        if($user==null){

        return redirect()
                        ->back()
                        ->withInput()  
                        ->withErrors(['message'=>"Oh no! The address you provided isn't in our system!"]);


        }
        
        $email = $request->get('email');
        $user =   User::where('email',$email)->first();
 
        $user_data = User::find($user->id);
        $temp_password = Hash::make($email);
        
      // Send Mail after forget password
        $temp_password =  Hash::make($email);
       
        $email_content = array(
                        'receipent_email'   => $request->input('email'),
                        'subject'           => 'Your Account Password',
                        'name'              => $user->first_name,
                        'temp_password'     => $temp_password,
                        'encrypt_key'       => Crypt::encrypt($email),
                        'greeting'          => 'Admin'

                    );
        $helper = new Helper;
        $email_response = $helper->sendMail(
                                $email_content,
                                'forgot_password_link'
                            ); 
       
        return redirect()
                        ->back()
                        ->withInput()  
                        ->withErrors(['message'=>"Reset password link has sent. Please check your email."]);
    }
}   


