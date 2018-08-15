
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
                <p><span><b>Published On</b> {{$result->publish_date}}</span> </p>
                </div>
                <div class="blog-text"> 
                <p>
                  <?php 
                   $str =  (implode(' ', array_slice(explode(' ',  strip_tags($result->description)), 0, 43)))
                  ?>
                  {{(str_replace("Summary",'', trim($str))) }}
                  @if(strlen($str)>40)<a href="{{url($result->url) }}">[...]</a>
                  @endif
                   </p>
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
                        @include('partials.support')
              @include('partials.testimonial')
          </div>
          </div>
         
                </div> 
            </div>
        </div> 
  @stop