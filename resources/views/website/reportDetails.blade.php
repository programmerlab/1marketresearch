
@extends('layouts.master')
    @section('title', 'HOME')
    
    @section('header')
    <h1>Home</h1>
    @stop 
    @section('content')

 @include('partials.search')

<nav class="woocommerce-breadcrumb" itemprop="breadcrumb"><a href="{{url('/')}}">Home</a> &gt;&gt; <a href="#">{{$data->category_name}}</a> &gt;&gt; {{
    ucwords(str_replace('-',' ',$data->slug))
}}</nav>

<div class="published-date">
<div class="row">
<div class="date-box">
  <div class="col-sm-6 border-right"> <span class="pub-date">Published Date : {{$data->publish_date or date('d/m/Y')}}</span> </div>
  <div class="col-sm-6 text-right"> <span class="pub-pages">Number of Pages : {{$data->number_of_pages}}</span> </div>
</div>
</div>
</div>

<div class="blog-area area-padding detail-main">
<div class="container">

<div class="row">
<div class="report-left-sec col-sm-8">

<div class="blog-grid home-blog detail-page">
    <!-- Start single blog -->
<div class="">
    <div class="single-blog">

        <div class="blog-content">
            <div class="blog-title">
                <div class="detail-img">
                 <?php
                     if($category->category_group_image){  
                        $img = asset('storage/uploads/category/'.$category->category_group_image);
                     }else{
                        $img = asset('public/assets/img/4.jpg');
                     }

                ?> 
            <img src="{{$img}}" style="width: 100%">
            
            </div>
            <div class="detail-title">
            <div class="detail-head">
            <a href="#">
            <h4>{{$data->title }}.</h4>
            </a>
            </div>
            <div class="repoort-tags">
            <p><span><b>Date</b> {{$data->publish_date }}</span> <span><b>Pages</b>: {{$data->number_of_pages }}</span></p>
            </div>
            <div class="detail-buttons">
                
            <a href="{{url('requestBrochure?report_id='.$data->id)}}">
                <button type="submit" class=" btn btn-primary" style="background-color: darkcyan; border-color: #3db1e3; height: 38px;"><span class=" glyphicon glyphicon-shopping-cart"></span> Request Brochure</button>
            </a>
            <a href="{{url('askAnAnalyst?report_id='.$data->id)}}">
                <button type="submit" class=" btn btn-primary" style="background-color: #3db1e3; border-color: #3db1e3;height: 38px;" ><span class=" glyphicon glyphicon-shopping-cart"></span> Ask An Analyst</button>
            </a>
            
            </div>
        </div>
    </div>
                                            
                            
                            
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
                <div class="release-background">
                    @include('partials.pricing')  
                    @include('partials.support') 
                    @include('partials.testimonial') 
                </div>
            </div 
        </div> 
    </div>
</div>

<script type="text/javascript">
    



</script>
  
     
@stop
 