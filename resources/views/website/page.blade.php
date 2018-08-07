
@extends('layouts.master')
    @section('title', 'HOME')
        
        @section('header')
        <h1>Home</h1>
        @stop

        @section('content')  
          
          @include('partials.search')
        <!-- End Slider Area -->
        
        <nav class="woocommerce-breadcrumb" itemprop="breadcrumb"><a href="#">Home</a> &gt;&gt; <a href="#">{{ ucfirst($title)}}</a></nav>
        
        <div class="published-date">
            <div class="row">
                <div class="date-box">
                  <div class="col-sm-12 border-right"> <span class="pub-date">
                    {{ ucfirst($title)}}
                  </span> </div>
                  
                </div>
            </div>
        </div>
        
        <div class="blog-area area-padding detail-main">
            <div class="container">
                
                <div class="row">
                    <div class="report-left-sec col-sm-12">
                        {!! $pages->page_content !!}
                    </div>
                    
                    
                </div>
                <!-- End row -->
                
                <!--End row-->
            </div>
        </div>
        @stop