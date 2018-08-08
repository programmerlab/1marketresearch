
@extends('layouts.master')  
  @section('header')
  <h1>Home</h1>
  @stop 
  @section('content')  

 @include('partials.search')
        <!-- End Slider Area -->
    
    <nav class="woocommerce-breadcrumb"><a href="#">Home</a> &gt;&gt; {{$title}}</nav>
    
      <div class="blog-area area-padding">
            <div class="container">
                
                <div class="row">
          <div class="report-left-sec col-sm-8">
            <div class="press-release">
              <h4>Latest Published Report</h4>
            </div>
            <div class="blog-grid home-blog">
              <!-- Start single blog -->
             <style type="text/css">
               .blog-text h1{
                font-size: 14px;
                font-weight: 100px;
                padding-left: 10px;
               }
             </style>

              @foreach($reports as $key => $result)
              <div class="">
                <div class="single-blog">
                  <div class="blog-content">
                    <div class="blog-title">
                        <a href="{{url($result->url) }}">
                            <h4>{{$result->title}}</h4>
                          </a>                                    </div>
                          <div class="repoort-tags">
                <p><span><b>On</b> {{$result->publish_date}}</span> <span><b>Pages</b>: {{$result->number_of_pages}}</span>  <span><b>Report ID</b>: {{$result->report_id}}</span><span><b>Price for Single User</b>: ${{$result->signle_user_license}}</span></p>
                </div>
                <div class="blog-text"> 
                <p>{!! substr($result->description,0,230)

                  !!} </p>
                <a class="blog-btn" href="{{url($result->url) }}">Read more</a> </div>
                  </div>
                </div>
              </div>
              @endforeach
              <!-- End single blog -->
  
              <ul class="pagination">
                 <div class="center" align="center">  {!! $reports->appends(['search' => isset($_GET['search'])?$_GET['search']:''])->render() !!}</div>
             </ul> 
      
              <!-- End single blog -->
            </div>
          </div>

                <div class="report-right-sec col-sm-4">
              <div class="release-background">
                        <div class="mey-help-new">
                                <div class="assist-pic"><img src="{{ asset('public/assets/img/Ansel.jpg')}}"></div>
                                <div class="assist-slogen">Ansel helps you
              find the right report:</div>
                            <div class="assiste-contact">
                                <p><i class="fa fa-phone"></i> +91{{$phone->field_value or $mobile->field_value}} </p>
                                <p><i class="fa fa-envelope"></i> <a href="#">Contact By Mail </p>
                            </div>
                        </div>
              @include('partials.testimonial')
          </div>
          </div>
         
                </div> 
            </div>
        </div> 
  @stop