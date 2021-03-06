<?php
namespace Modules\Admin\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use Modules\Admin\Models\User; 
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
use Modules\Admin\Models\Coupan;
use Response; 
use Modules\Admin\Http\Requests\CoupanRequest;
/**
 * Class AdminController
 */
class CoupanController extends Controller {
    /**
     * @var  Repository
     */

    /**
     * Displays all admin.
     *
     * @return \Illuminate\View\View
     */
    public function __construct(Coupan $coupan) { 
        $this->middleware('admin');
        View::share('viewPage', 'Coupan');
        View::share('sub_page_title', 'Coupon');
        View::share('helper',new Helper);
        View::share('heading','Coupon');
        View::share('route_url',route('coupan')); 
        $this->record_per_page = Config::get('app.record_per_page'); 
    }

   
    /*
     * Dashboard
     * */

    public function index(Coupan $coupan, Request $request) 
    { 
        $page_title = 'Coupon'; 
        $page_action = 'View Coupon'; 

        if ($request->ajax()) {
            $id = $request->get('id'); 
            $Coupan = Coupan::find($id); 
            $Coupan->status = $s;
            $Coupan->save();
            echo $s;
            exit();
        }

        // Search by name ,email and group
        $search = Input::get('search');
        $status = Input::get('status');
        if ((isset($search) && !empty($search))) {

            $search = isset($search) ? Input::get('search') : '';
               
            $coupans = Coupan::where(function($query) use($search,$status) {
                        if (!empty($search)) {
                            $query->Where('coupan_code', 'LIKE', "%$search%");
                        }
                        
                    })->Paginate($this->record_per_page);
        } else {
            $coupans = Coupan::Paginate($this->record_per_page);
        }
         
        
        return view('packages::coupan.index', compact('coupans', 'page_title', 'page_action','sub_page_title'));
    }

    /*
     * create Group method
     * */

    public function create(Coupan $coupan) 
    {
        $page_title     = 'Coupon';
        $page_action    = 'Create Coupon'; 

        return view('packages::coupan.create', compact( 'coupan','status','page_title', 'page_action'));
    }

    

    /*
     * Save Group method
     * */

    public function store(CoupanRequest $request, Coupan $coupan) 
    {   
        $coupan->fill(Input::all()); 
        $coupan->save();
         
        return Redirect::to(route('coupan'))
                            ->with('flash_alert_notice', 'New coupan  successfully created!');
    }

    /*
     * Edit coupan method
     * @param 
     * object : $coupan
     * */

    public function edit(Coupan $coupan) {
        $page_title     = 'Coupon';
        $page_action    = 'Edit Coupon'; 
         
        return view('packages::coupan.edit', compact( 'url','coupan','status', 'page_title', 'page_action'));
    }

    public function update(CoupanRequest $request, Coupan $coupan) {
        
        $coupan->fill(Input::all()); 
        $coupan->save();  
        return Redirect::to(route('coupan'))
                        ->with('flash_alert_notice', 'Coupan  successfully updated.');
    }
    /*
     *Delete User
     * @param ID
     * 
     */
    public function destroy(Coupan $coupan) {
        
        Coupan::where('id',$coupan->id)->delete();
        return Redirect::to(route('coupan'))
                        ->with('flash_alert_notice', 'Coupan  successfully deleted.');
    }

    public function show(Coupan $coupan) {

        $page_title     = 'Coupon';
        $page_action    = 'Show Coupon'; 
        
        return view('packages::coupan.show', compact('coupan','page_title', 'page_action'));
    }

}