
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
                                        <span class="caption-subject font-red sbold uppercase">{{ $page_title }}</span>
                                    </div>
                                     <div class="col-md-2 pull-right">
                                            <div style="width: 150px;" class="input-group"> 
                                                <a href="{{ URL::previous()}}">
                                                    <button class="btn btn-success"><i class="fa fa-long-arrow-left"></i>  Go Back</button> 
                                                </a>

                                            </div>
                                        </div> 

                                     
                                </div>
                                  
                                    
                                <div class="portlet-body">
                                     
                                    <table class="table table-striped table-hover table-bordered" id="">
                                        <thead>
                                            <tr>
                                                <th> Press title </th>  <td> {{ ucfirst($result->title)}} </td></tr>
                                             <tr>
                                                <th> Table of content link</th>  <td> {!!$result->link or 'NA'!!}  </td>
                                            </tr> 
                                            
                                            <tr>
                                                <th> Description</th> <td>  {!!$result->description!!}  </td>
                                            </tr>

                                            <tr>
                                                <th> Forecast Year</th> <td>  {!!$result->forecast_year!!}  </td>
                                            </tr>

                                            <tr>
                                                <th> Tag</th> <td>  {!!$result->tag!!}  </td>
                                            </tr>

                                            <tr>
                                                <th> Url</th> <td>  
                                                <a target="_blank" href="{{ url($result->url) }}" > {{ url($result->url) }} </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th> About us</th> <td>  {!! $result->about_us !!}  </td>
                                            </tr>

                                            <tr>
                                                <th> Contact us</th> <td>  {!! $result->contact_us !!}  </td>
                                            </tr>
                                            
                                            <tr>
                                                <th> Created date </th> <td>  {!! Carbon\Carbon::parse($result->created_at)->format('m-d-Y'); !!}</td>
                                            </tr> 
                                        </thead>
                                       
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
        