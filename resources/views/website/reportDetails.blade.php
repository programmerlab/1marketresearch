
@extends('layouts.master')
    @section('title', 'HOME')
    
    @section('header')
    <h1>Home</h1>
    @stop 
    @section('content')

 @include('partials.search')

<nav class="woocommerce-breadcrumb" itemprop="breadcrumb"><a href="{{url('/')}}">Home1</a> &gt;&gt; 

    {{$data->category_name or ''}} &gt;&gt; {{
        ucwords(str_replace('-',' ',$data->slug))
    }}

</nav>

<style>
    
      .published-date2 {
    margin-top: 27px;
    padding-top: 10px;  
    background: transparent;
    font-weight: 600;
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
}

   .published-date2 p{color: #0a8a2d;}

.published-date3 {
    margin-top: 11px;
     background: transparent;
    padding: 10px 15px;
    font-weight: 600;
    
}
.published-date3 p{font-size:20px;border-bottom: 1px solid #ddd;margin-bottom: 15px;}
    </style>



<div class="published-date2">
<div class="row">
<div class="date-box">
  <div class="col-sm-12 border-right" style="color: #000; font-size: 16px;"> <span class="pub-date"> 
     <div class="col-sm-6 text-left">
         <b><p>Published Date: {{ $data->publish_date or ''}}</p></b>
     </div>
     <div class="col-sm-6 text-right">
         <b><p>Number of Pages: {{$data->number_of_pages  or  ''}}</p></b>
     </div>
    </span> 
  </div>
</div>
</div>
</div>

<div class="published-date" style="margin:5px;">
<div class="row">
<div class="date-box">
  <div class="col-sm-12 border-right" style="color: #000; font-size: 16px;"> 
        <span class="pub-date"> 

    <b>{{$data->title or '' }} </b></span> </div>
</div>
</div>
</div>


<div class="col-md-12" style="margin: 0px; background: #ccc; padding: 12px 0 12px 12px; padding-left: 10%">
       <form action="{{url('payment')}}">
        <input type="hidden" name="payment_id" value="{{$data->id}}">
        <div class="col-md-3">
            <select class="form-control" style="height: 40px" name="price">
                <option value="{{$data->signle_user_license}}"> <b>Single User License </b>: US $ {{$data->signle_user_license}} </option>
                <option value="{{$data->multi_user_license}}">Multi User License </b>: US $ {{$data->multi_user_license}}  </option>
                <option value="{{$data->corporate_user_license}}">Corporate User License </b>: US $ {{$data->corporate_user_license}}</option>
            </select>

        </div>
        <div class="col-md-1">
        
            <button type="submit" class="btn btn-danger" style="height: 38px">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </span> <b> Buy Now!</b>
            </button>
       </div>

        
        <div class="col-md-1" style="margin-left: 0px">
        <a href="{{url('requestSample?report_id='.$data->id)}}">
                <button type="button" class=" btn btn-primary" style="background-color: darkcyan; border-color: #875635; background-color: #875635; height: 38px;margin-left: 5px;"><span class=" glyphicon glyphicon-shopping-cart"></span><b> Request Sample </b></button>
            </a>
        </div>

        <div class="col-md-1" style="margin-left: 40px">
        <a href="{{url('requestBrochure?report_id='.$data->id)}}">
                <button type="button" class=" btn btn-primary" style="background-color: darkcyan; border-color: #3db1e3; height: 38px;margin-left: 5px;"><span class=" glyphicon glyphicon-shopping-cart"></span><b> Request Brochure </b></button>
            </a>
        </div>
        <div class="col-md-2" style="margin-left: 60px">
            <a href="{{url('askAnAnalyst?report_id='.$data->id)}}">
                <button type="button" class=" btn btn-primary" style="background-color: #3db1e3; border-color: #3db1e3;height: 38px; margin-left: 0px;" ><span class=" glyphicon glyphicon-shopping-cart"></span><b> Ask An Analyst </b></button>
            </a>
            </div>  
    </form>
 </div>



<div class="blog-area area-padding detail-main">
<div class="container">

<div class="row">
<div class="report-left-sec col-sm-12">

<div class="blog-grid home-blog detail-page" style="margin-top: 10px; border-radius: 0px;">
    <!-- Start single blog -->
<div class="">
    <div class="single-blog">

        <div class="blog-content">
             
                                            
                            
                            
                            <div class="detail-tabs">

                                <div class="tab-menu">
                                     <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="reportDescription"><a href="{{url($data->url)}}#reportDescription" role="tab" data-toggle="tab" aria-expanded="false">Report Description</a></li>
                                        <li class="tableOfContents"><a href="{{url($data->url)}}#tableOfContents" role="tab" data-toggle="tab" aria-expanded="false">Table of Contents</a></li>
                                        <li class="enquireBeforeBuying"><a href="{{url($data->url)}}#enquireBeforeBuying" role="tab" data-toggle="tab" aria-expanded="false">Enquire Before Buying</a></li>
                                        <li class="requestSample"><a href="{{url($data->url)}}#requestSample" role="tab" data-toggle="tab" aria-expanded="false">Request Sample</a></li>
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane" id="reportDescription">
                                        <div class="tab-inner">
                                            <div class="event-content head-team">
                                                
                                                <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--description panel entry-content wc-tab" id="tab-description" style="display: block;">
                                                       {!! $data->description or 'Description not available' !!}
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="tableOfContents">
                                        <div class="tab-inner">
                                            <div class="event-content head-team">
                                
                                                <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--table_of_contents_tab panel entry-content wc-tab" id="tab-table_of_contents_tab" style="display: block;">
                                                    <p style="margin-bottom:15px;"><b>Table of Contents</b></p>
                                                    <p>{{$data->title }} </p> <br>

                                                        {!! $data->table_of_contents or 'Contents not available' !!}

                                                        <p>
                                                        {!! $data->table_and_figures !!}
                                                    </p>
                                    
                                                </div> 
                                            </div>
                                        </div>
                                    </div>

                                   @include('partials.enquiry')
                                    @include('partials.request_sample')   
                                        
                                </div>
                            </div> 
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    
            <div class="report-right-sec col-sm-4"> 
            </div 
        </div> 
    </div>
</div>

<script type="text/javascript">
    



</script>
  
     
@stop
 