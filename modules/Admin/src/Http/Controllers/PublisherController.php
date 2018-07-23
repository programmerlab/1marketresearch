<?php
namespace Modules\Admin\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use Modules\Admin\Http\Requests\PublisherRequest; 
use Modules\Admin\Models\Publisher; 
//use App\Category;
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
use DB;
use Route;
use Crypt;
use App\Http\Controllers\Controller;
use Illuminate\Http\Dispatcher;
use App\Helpers\Helper;

/**
 * Class AdminController
 */
class PublisherController extends Controller { 

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
        View::share('viewPage', 'Publisher');
        View::share('helper',new Helper);
        View::share('heading','Publisher');
        $this->record_per_page = Config::get('app.record_per_page');
        View::share('route_url',route('publisher'));

    }

    protected $press;

    /*
     * Dashboard
     * */

    public function index(Publisher $publisher, Request $request) 
    { 
        $page_title = 'Publisher'; 
        $page_action = 'View Publisher'; 
        

        // Search by name ,email and group
        $search = Input::get('search');
        $status = Input::get('status');
        if ((isset($search) && !empty($search))) {

            $search = isset($search) ? Input::get('search') : '';


            $results = Publisher::where(function($query) use($search,$status) {
                        if (!empty($search)) {
                            $query->Where('publisher', 'LIKE', "%$search%")
                                    ->OrWhere('company', 'LIKE', "%$search%");
                        }
                    })->Paginate($this->record_per_page);

       
        } else {
            $results = Publisher::Paginate($this->record_per_page);
        }
        return view('packages::publisher.index', compact('results','Press','page_title', 'page_action'));
    }

    /*
     * create Group method
     * */

    public function create(Publisher $publisher,Request $request) 
    {
        $id =  $request->get('id');
        $page_title = 'Publisher';
        $page_action = 'Create Publisher';  
         
        return view('packages::publisher.create', compact('id','publisher','page_title', 'page_action'))->withInput(Input::all());
    }

    /*
     * Save Group method
     * */
  
    public function store(PublisherRequest $request, Publisher $result) 
    {                   
        $result->fill(Input::all()); 
        $result->save(); 
        return Redirect::to(route('publisher'))
                            ->with('flash_alert_notice', 'New publisher  successfully added.');
    }

    /*
     * Edit Group method
     * @param 
     * object : $category
     * */

    public function edit(Publisher $publisher,Request $request) {

        $page_title = 'Publisher';  
        $page_action = 'Edit Publisher';  
    
        return view('packages::publisher.edit', compact('publisher', 'page_title', 'page_action'));
    }

    public function update(Request $request, Publisher $result) {
         
        $result->fill(Input::all()); 
        $result->save(); 
        
        return Redirect::to(route('press'))
                        ->with('flash_alert_notice', 'Press item successfully updated.');
    }
    /*
     *Delete User
     * @param ID
     * 
     */
    public function destroy(Publisher $publisher) {
        
        $del = Publisher::where('id',$publisher->id)->delete(); 
        return Redirect::to(URL::previous())
                        ->with('flash_alert_notice', 'Publisher successfully deleted.');
    }

    public function show(Publisher $result) {
        
        
        $page_title  = 'Publisher';
        $page_action  = 'Show Publisher';  
        return view('packages::publisher.show', compact('result','data', 'page_title', 'page_action','html'));

    }

}
