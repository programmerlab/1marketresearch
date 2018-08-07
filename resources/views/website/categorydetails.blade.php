
@extends('layouts.master')  
  @section('header')
  <h1>Home</h1>
  @stop 
  @section('content')  


         @include('partials.search')
        <!-- End Slider Area -->
    
    <nav class="woocommerce-breadcrumb"><a href="#">Home</a> &gt;&gt; {{$categoryName}}</nav>
    
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
                <p>{!! substr($result->description,0,230)

                  !!} </p>
                <a class="blog-btn" href="{{url($result->url) }}">Read more</a> </div>
                  </div>
                </div>
              </div>
              @endforeach

              
              <ul class="pagination">
               
             </ul>
      
              <!-- End single blog -->
            </div>
          </div>
          <div class="report-right-sec col-sm-4">
    <div class="release-background">
                        <div class="mey-help-new">
                                <div class="assist-pic"><img src="{{asset('public/assets/img/2(1).jpg')}}"></div>
                                <div class="assist-slogen">Ansel helps you
    find the right report:</div>
                            <div class="assiste-contact">
                                <p><i class="fa fa-phone"></i> +911234567890</p>
                                <p><i class="fa fa-envelope"></i> <a href="#">Contact By Mail </p>
                            </div>
                        </div>
            <div class="press-release">
              <h4>Testimonial</h4>
            </div>
            <div class="Reviews-content">
              <!-- start testimonial carousel -->
              <div class="testimonial-carousel item-indicator">
                <div class="single-testimonial text-center">
                  <div class="testimonial-text">
                    <p>Dummy text is also used to demonstrate the appearance of different typefaces and layouts, and in general the content of dummy text is nonsensical. Due to its widespread use as filler text for layouts, non-readability is of great importance.</p>
                  </div>
                  <div class="testimonial-img ">
                    <img src="{{asset('public/assets/img/review/1.jpg')}}" alt="">
                    <div class="client-name">
                      <h4>Arnold russel</h4>
                      <span>Genarel Manager</span>                    </div>
                  </div>
                </div>
                <!-- End single item -->
                <div class="single-testimonial text-center">
                  <div class="testimonial-text">
                    <p>Dummy text is also used to demonstrate the appearance of different typefaces and layouts, and in general the content of dummy text is nonsensical. Due to its widespread use as filler text for layouts, non-readability is of great importance.</p>
                  </div>
                  <div class="testimonial-img ">
                    <img src="{{asset('public/assets/img/review/2.jpg')}}" alt="">
                    <div class="client-name">
                      <h4>Arnold russel</h4>
                      <span>Genarel Manager</span>                    </div>
                  </div>
                </div>
                <!-- End single item -->
                <div class="single-testimonial text-center">
                  <div class="testimonial-text">
                    <p>Dummy text is also used to demonstrate the appearance of different typefaces and layouts, and in general the content of dummy text is nonsensical. Due to its widespread use as filler text for layouts, non-readability is of great importance.</p>
                  </div>
                  <div class="testimonial-img ">
                    <img src="{{asset('public/assets/img/review/1.jpg')}}" alt="">
                    <div class="client-name">
                      <h4>Arnold russel</h4>
                      <span>Genarel Manager</span>                    </div>
                  </div>
                </div>
                <!-- End single item -->
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