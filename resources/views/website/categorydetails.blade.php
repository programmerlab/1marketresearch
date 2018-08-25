
@extends('layouts.master')  
  @section('header')
  <h1>Home</h1>
  @stop 
  @section('content')  
    @include('partials.search')
        <!-- End Slider Area -->
    <nav class="woocommerce-breadcrumb"><a href="{{url('/')}}">Home</a> &gt;&gt; {{$categoryName or $title }}
      @if(empty($categoryName) || empty($title))
        Search Research Reports
      @endif

    </nav>
    <div class="blog-area area-padding">
      <div class="container">
              
        <div class="row">
          <div class="report-left-sec col-sm-8">
            <div class="press-release">
              <h4> {{$categoryName}} Market Research Reports</h4>
            </div>
            <div class="blog-grid home-blog">
              <!-- Start single blog -->

              @if(count($data)==0) 
               
              <div class="blog-title">
                  
                     <p style="padding-left: 20px;">No reports were found matching your selection.</p>
                     
              </div> 
              @endif
              
             @foreach($data as $key => $result)
              <div class="">
                <div class="single-blog">
                  <div class="blog-content">
                    <div class="blog-title">
                        <a href="{{url($result->url) }}">
                            <h4>{{$result->title}}</h4>
                          </a>                                    </div>
                          <div class="repoort-tags">
                <p><span><b>Date </b>: {{$result->publish_date}}</span> <span><b>Pages</b>: {{$result->number_of_pages}}</span>  <span><b>Report ID</b>: {{$result->report_id}}</span><span><b>Price for Single User</b>: ${{$result->signle_user_license}}</span></p>
                </div>
                <div class="blog-text"> 
               <p> 
                  <?php
                   $str =  (implode(' ', array_slice(explode(' ', strip_tags($result->description)), 0, 43)))
                  ?>
                  {{(str_replace("Summary",'', trim($str))) }}
                  @if(strlen($str)>40)<a href="{{url($result->url) }}">[...]</a>
                  @endif
                   </p> 

              <p>  <a class="blog-btn" href="{{url($result->url) }}">Read more</a> </p>
              </div>
                  </div>
                </div>
              </div>
              @endforeach
         
              <!-- End single blog -->
            </div>

            <br>
            <ul class="pagination">
                 <div class="center" align="center">  {!! $reports->appends(['search' => isset($_GET['search'])?$_GET['search']:''])->render() !!}</div>
             </ul> 
            
            <br>
          </div>
            <div class="report-right-sec col-sm-4">
                <div class="release-background"> 
                    @include('partials.support') 
                    @include('partials.testimonial') 
                </div>
            </div>        
        </div>   
        <!--End row-->
      </div>  
    </div>  
  @stop