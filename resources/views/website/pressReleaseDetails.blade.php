
@extends('layouts.master')
    @section('title', 'HOME')
    
    @section('header')
    <h1>Home</h1>
    @stop 
    @section('content')

 @include('partials.search')

<nav class="woocommerce-breadcrumb" itemprop="breadcrumb"><a href="{{url('/')}}">Home</a> &gt;&gt; <a href="#">Press Release ></a> 
 </nav>

<div class="published-date">
<div class="row">
<div class="date-box">
  <div class="col-sm-6 border-right"> <span class="pub-date">Published Date : {{$data->publish_date or date('d-m-Y')}}</span> </div>
   
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
            <div class="blog-title" style="background-color: #ccc; width: 100%; padding: 5px 5px 0px ">
                  
            <h4>{{$data->title }}</h4>  
         
        </div>
                           
                            
                            <div class="detail-tabs">

                                <div class="tab-menu">
                                     <!-- Nav tabs -->
                                    
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane" id="reportDescription">
                                        <div class="tab-inner">
                                            <div class="event-content head-team">
                                                
                                                <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--description panel entry-content wc-tab" id="tab-description" style="display: block;">
                                                       {!! $data->description or 'Description not available' !!}
                                                </div>

                                                 <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--description panel entry-content wc-tab" id="tab-description" style="display: block;">
                                                       {!! $data->table_of_content or 'Table of content not available' !!}
                                                </div>

                                                <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--description panel entry-content wc-tab" id="tab-description" style="display: block;">
                                                       {!! $data->about_us or '' !!}
                                                </div>


                                                <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--description panel entry-content wc-tab" id="tab-description" style="display: block;">
                                                       {!! $data->contact_us or '' !!}
                                                </div>

                                            </div>
                                        </div>
                                    </div>  
                                        
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
 