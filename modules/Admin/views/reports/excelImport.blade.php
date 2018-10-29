
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
                                    <div class="caption font-red-sunglo">
                                        <span class="caption-subject bold ">Import Excel Report </span>
                                    </div>
                                     <div class="col-md-2 pull-right">
                                   <div   class="input-group">  
                                    <a class="btn  btn-success" data-toggle="modal" href="{{route('reports')}}"><i class="fa fa-plus-circle"></i> View All Reports </a> 
                                   </div>
                               </div>
                                    
                                </div>
                                <div class="portlet-body form" style="height: 560px">

                                    <form method="POST" action="{{url('admin/excel/import')}}" accept-charset="UTF-8" class="form-horizontal user-form" id="uploadMsgform" enctype="multipart/form-data" novalidate="novalidate">

                                        <div class="form-body" style="
                                                border: 1px solid #ccc;
                                                padding: 40px;
                                            ">
                                            <div class="row">
                                              
                                                <div class="col-md-4">
                                                    <a class="btn-floating btn-lg pink lighten-1 mt-0 float-left">
                                                        <i class="fa fa-paperclip" aria-hidden="true"></i>
                                                        <input type="file" multiple  style="float: left;position: absolute;top: 0px;left: 55px;" name="importExcel" class="btn btn-danger" >

                                                    </a> 
                                                        
                                                </div>
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn blue" id="uploadMsg" >Import Reports</button>
                                                </div>


                                            </div>
                                            
                                               @if($errors->any())
                                                <h4 style="color: red;margin-left: 40px;margin-top: 20px;" >{!!$errors->first()!!}</h4>
                                                @else
                                                <h4 style="color:  green; margin-left: 40px;margin-top: 20px;" >
                                                    (allowed extension: xls,xlsx)
                                                </h4>
                                                @endif
                                                <p>
                                                    @if(isset($catName))
                                                <p>Following category is not found in the system.</p>
                                                <ul>      
                                                @foreach($catName as $result)
                                                <li> <b> {{ $result }} </b> </li>
                                                      @endforeach
                                                </ul>
                                                    @endif
                                                </p>

                                            </div>
                                        
                                    </form>
                                    <div id="uploadMsgs"></div>
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