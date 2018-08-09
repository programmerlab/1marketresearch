
@extends('layouts.master')  
  @section('header')
  <h1>Home</h1>
  @stop 
  @section('content') 
      <!-- Left side column. contains the logo and sidebar --> 
   @include('layouts.home-slider') 

        <!-- End Slider Area -->
    
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
                .py-1{
                  height: 44px !important; 
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
  
              <ul class="pagination" style="padding: 5px">
                 <a class="btn btn-primary" href="{{url('research-reports')}}">View All Reports </a>  

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
                                <p><i class="fa fa-phone"></i> {{$phone->field_value or $mobile->field_value}} </p>
                                <p><i class="fa fa-envelope"></i> <a href="#">Contact By Mail </p>
                            </div>
                        </div>
              @include('partials.testimonial')
          </div>
          </div>
         
                </div> 
            </div>
        </div>
    
    
        <!-- Welcome service area start -->
        
        <!-- Welcome service area End -->
        <!-- about-area start -->
        
        <!-- about-area end -->
        <!-- Welcome service area start -->
        <div class="Services-area area-padding" style="background:#f9f9f9;">
            <div class="container">
               <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline text-center">
              <h3>Popular Categories</h3>
            <!--   <p>Lorem ipsum dolor is the dummy text for describung the website content.</p> -->
            </div>
          </div>
        </div>
        <div class="row"> 
          
          @foreach($category as $key=> $result)

            <div class="col-md-2 col-sm-2 col-xs-12">
              <div class="single-services text-center" style="height: 200px">
                <div class="services-img">
                    <a href="{{url($result->url)}}"> 
                  <img src="{{ url('storage/uploads/category/'.$result->category_group_image) }}" alt="" style="height: 153px" width="100%"> </a> 
                  
                </div>
                <div class="main-services">
                  <div class="service-content">
                    <h4>  <a href="{{url($result->url)}}">{{$result->category_name}}</a>  </h4>
                                      </div>
                </div>
              </div>
            </div>

           

          @endforeach  

            
           <!--  <div class="col-md-2 col-sm-2 col-xs-12">
              <div class="single-services text-center">
                <div class="services-img">
                  <img src="{{ asset('public/assets/img/6.jpg')}}" alt="">
                  <div class="image-layer">
                    <a href="#">Category Not Available</a>                  </div>
                </div>
                <div class="main-services">
                  <div class="service-content">
                    <h4>Category Not Available</h4>
                                      </div>
                </div>
              </div>
            </div>
             -->
           
            <!-- single-well end-->
                    </div>
                </div>
            </div>  
  @stop