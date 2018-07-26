@extends('packages::layouts.master')
  @section('title', 'Dashboard')
    @section('header')
    <h1>Dashboard</h1>
    @stop
    @section('content') 
  
      @include('packages::partials.navigation')
      <!-- Left side column. contains the logo and sidebar -->
      @include('packages::partials.sidebar')
      <!-- END SIDEBAR -->
      <!-- BEGIN CONTENT -->
     <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD--> 
          <!-- END PAGE HEAD-->
          <!-- BEGIN PAGE BREADCRUMB -->
         @include('packages::partials.breadcrumb')

          <!-- END PAGE BREADCRUMB -->
          <!-- BEGIN PAGE BASE CONTENT -->
          <div class="row">
              <div class="col-md-12">
                  <!-- BEGIN EXAMPLE TABLE PORTLET-->
                  <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                      <div class="caption">
                          <i class="icon-settings font-red"></i>
                          <span class="caption-subject font-red sbold uppercase">{{ $heading }}</span>
                      </div>

                       <div class="col-md-2 pull-right">
                                            <div   class="input-group">  
                                             <a class="btn  btn-success" data-toggle="modal" href="#responsive2"><i class="fa fa-plus-circle"></i>   Import Reports </a> 
                                            </div>
                                        </div> 
                         
                      <div class="col-md-2 pull-right">
                          <div style="" class="input-group"> 
                              <a href="{{ route('reports.create')}}">
                                  <button  class="btn btn-success"><i class="fa fa-plus-circle"></i> Create Reports</button> 
                              </a>
                          </div>
                      </div> 
                      <div class="col-md-1 pull-right">
                          <div style="" class="input-group"> 
                              <a href="{{ route('reports')}}">
                                  <button  class="btn btn-primary"><i class="fa fa-plus-circle"></i> Back</button> 
                              </a>
                          </div>
                      </div>
                           
                    </div>
                        
                      @if(Session::has('flash_alert_notice'))
                           <div class="alert alert-success alert-dismissable" style="margin:10px">
                              <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <i class="icon fa fa-check"></i>  
                           {{ Session::get('flash_alert_notice') }} 
                           </div>
                      @endif
                      <div class="portlet-body">
                          <div class="table-toolbar">
                              <div class="row">
                                 Reports Details
                              </div>
                          </div>
                           
                        <table class="table table-striped table-hover table-bordered" id="contact">
                               
                            <tbody>
                               @foreach ($reports  as $key => $result)
                                @if($key=="id")
                                  <?php continue; ?>
                                @endif  
                                  <tr>
                                     <td width="300px"><b>{{ ucfirst(str_replace('_',' ',$key)) }} </b></td>
                                      <td>{!! ucfirst($result)     !!} 
                                  </td>
                                @endforeach 
                              </tbody>
                        </table> 
                            
                      </div>
                  </div>
                  <!-- END EXAMPLE TABLE PORTLET-->
              </div>
          </div>
            <!-- END PAGE BASE CONTENT -->
      </div>
        <!-- END CONTENT BODY -->
    </div> 
    <!-- END QUICK SIDEBAR -->
</div> 
       
  

<form id="import_csv" action="" method="post" encytype="multipart/form-data">
  <input type="hidden" id="url_action" name="action" value="admin/reports/import">
  <input type="hidden" name="_token" value="{{csrf_token()}}">
  <input type="hidden" id="redirect_action" name="action" value="admin/reports">
 <div id="responsive2" class="modal fade" tabindex="-1" data-width="300">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #efeb10 !important">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Import Reports</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Import excel file</h4>
                        <p><a href="{{ url('storage/csv/reports.csv') }}">download csv sample</a></p>
                        <span id="error_msg2"></span>
                        <p>
                            <input type="file" class="col-md-12 form-control" name="importCsv" id="importCsv"> </p> 
                    </div>
                </div> 
            </div>
            <div class="modal-footer">
            
                <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                <button type="submit" class="btn red" id="csave" >Imort</button>
            </div>
        </div>
    </div>
</div>
</form>
@stop