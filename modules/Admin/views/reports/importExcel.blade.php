
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
                         <div class="col-md-12 ">
                            <!-- BEGIN SAMPLE FORM PORTLET-->
                             
                            <!-- END SAMPLE FORM PORTLET-->
                            <!-- BEGIN SAMPLE FORM PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-red"></i>
                            <span class="caption-subject font-red sbold uppercase">Export Reports (Total Reports : {{$report_count}})</span>
                        </div>
                        <div class="col-md-2 pull-right">
                            <div style="width: 150px;" class="input-group"> 
                                <a href="{{ route('reports.create')}}">
                                    <button  class="btn btn-danger"><i class="fa fa-plus-circle"></i> Create Reports</button> 
                                </a>
                            </div>
                        </div>
                        <div class="col-md-2 pull-right">
                           <div   class="input-group">  
                            <a class="btn  btn-success" data-toggle="modal" href="{{route('reports')}}"><i class="fa fa-plus-circle"></i> View All Reports </a> 
                           </div>
                       </div> 
                        <div class="col-md-2 pull-right">
                           <div   class="input-group">  
                            <a class="btn  btn-info" data-toggle="modal" href="{{url('admin/excel/import')}}"><i class="fa fa-plus-circle"></i> Import Reports in excel </a> 
                           </div>
                       </div> 
                        


                    </div>
                                <div class="portlet-body form">
                                    <form role="form" action="{{url('admin/exportExcel')}}" method="post">

                                        <div class="form-body">
                                            <div class="row">
                                              <div class="col-md-6">
                                                  
                                                  <div class="form-group form-md-line-input form-md-floating-label has-info">
                                                      <select class="form-control edited" id="form_control_1" name="category_name">
                                                      <option value="" selected="">Any</option>
                                                      @foreach($category as $key => $result)
                                                      <option value="{{$result->id}}">{{$result->category_name}}</option>
                                                      @endforeach
                                                      </select>
                                                    <label for="form_control_1">Research Category</label>
                                                  </div>

                                                </div>
                                              <div class="col-md-6">
                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                        <input type="number" min="1" name="page_number" class="form-control" id="form_control_1">
                                                        <label for="form_control_1">Number of Reports</label>
                                                        <span class="help-block">Please enter total number of reports</span>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group form-md-line-input has-success form-md-floating-label">
                                                        <div class="input-icon">
                                                            
                                                            <input class="form-control   date-picker" size="16" type="text" value=""  name="start_date" data-date-format="dd-mm-yyyy">

                                                            <label for="form_control_1">Start Date</label>
                                                            <span class="help-block">Select start date...</span>
                                                            <i class="fa fa fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-md-line-input has-success form-md-floating-label">
                                                        <div class="input-icon">
                                                            <input class="form-control   date-picker" size="16" type="text" value=""  name="end_date" data-date-format="dd-mm-yyyy">
                                                            <label for="form_control_1">End Date</label>
                                                            <span class="help-block">Select end date..</span>
                                                            <i class="fa fa fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                             
                                            
                                             
                                        </div>
                                        <div class="form-actions noborder">
                                            <button type="submit" class="btn blue">Export Reports</button>
                                            <button type="button" class="btn default">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                                                          
                            </div>
                            
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
                <!-- END CONTENT BODY -->
            </div>
            
            
            <!-- END QUICK SIDEBAR -->
        </div>
        

        
@stop