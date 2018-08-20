
@extends('layouts.master')
    @section('title', 'HOME')
        
        @section('header')
        <h1>Home</h1>
        @stop

        @section('content')  
          
              @include('partials.search')
        <!-- End Slider Area -->
        
        <nav class="woocommerce-breadcrumb" itemprop="breadcrumb"><a href="{{url('/')}}">Home</a> &gt;&gt; <a href="#">Research categories</a></nav>
        
        <div class="published-date">
            <div class="row">
                <div class="date-box">
                  <div class="col-sm-12 border-right"> <span class="pub-date">
                    Research Categories
                  </span> </div>
                  
                </div>
            </div>
        </div>
        
        <div class="blog-area area-padding detail-main">
            <div class="container">
                
                <div class="row">
                    <div class="report-left-sec col-sm-12">
                            <!-- about-area end -->
        <!-- Welcome service area start -->
        <div class="Services-area area-padding" style="background:#f9f9f9;">
            <div class="container">
               <div class="row">
          
                    </div>
                    <div class="row"> 
                      
                      @foreach($category as $key=> $result)

                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <div class="single-services text-center" style="height: 200px">
                            <div class="services-img">
                                <a href="{{url($result->url)}}"> 
                              <img src="{{ url('storage/uploads/category/'.$result->category_group_image) }}" alt="" style="" width="100%"> </a> 
                              
                            </div>
                           <!--  <div class="main-services">
                              <div class="service-content">
                                <h4>  <a href="{{url($result->url)}}">{{ucwords($result->category_name)}}</a>  </h4>
                                                  </div>
                            </div> -->
                          </div>
                        </div>

                      @endforeach  
 
                    </div>
                </div>
            </div>  
                    </div>
                    
                    
                </div>
                <!-- End row -->
                
                <!--End row-->
            </div>
        </div>
        @stop