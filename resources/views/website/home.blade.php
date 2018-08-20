
@extends('layouts.master')  
  @section('header')
  <h1>Home</h1>
  @stop 
  @section('content') 
      <!-- Left side column. contains the logo and sidebar --> 
 <div class="intro-area banner-section">
           <div class="main-overly"></div>
            <div class="intro-carousel2">
                <div class="intro-content">
                    <div class="slider-images">
                        <img src="{{ asset('img/slider/s1.jpg') }}" alt="">
                    </div>
                    <div class="slider-content">
                        <div class="display-table">
                            <div class="display-table-cell">
                                <div class="container"> 
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                            <div class="layer-1-2" style="margin-top: 0px;">
                                                <h2 class="title22" style="color: #fff">World's Larest Market Research Reports Portal</h2>
                                            </div> 
                                            <div class="layer-1-1 ">
                                                <p>Search from over 500,000 In-Depth Market Research Reports & Free Sample Reports!</p> 
                                            </div>

                                    <div class="input-group md-form form-sm form-2 pl-0">
                                        <form action="{{url('research-reports')}}">
                                        <input class="form-control my-0 py-1 amber-border" type="text" name="search" placeholder="Search Your Keywords..." aria-label="Search">
                                        <div class="input-group-append"> 
                                          <button type="submit" class="single_add_to_cart_button btn btn-danger alt">Search</button>
                                        </div>
                                        </form>

                                    </div>


                                                                                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="intro-content">
                    <div class="slider-images">
                        <img src="{{ asset('img/slider/s1.jpg') }}" alt="">
                    </div>
                    <div class="slider-content">
                        <div class="display-table">
                            <div class="display-table-cell">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                            <div class="layer-1-2" style="margin-top: 0px;">
                                                <h2 class="title22" style="color: #fff">World's Larest Market Research Reports Portal</h2>
                                            </div> 
                                            <div class="layer-1-1 ">
                                                <p>Search from over 500,000 In-Depth Market Research Reports & Free Sample Reports!</p> 
                                            </div>

                                    <div class="input-group md-form form-sm form-2 pl-0">
                                        <form action="{{url('research-reports')}}">
                                        <input class="form-control my-0 py-1 amber-border" type="text" name="search" placeholder="Search Your Keywords..." aria-label="Search">
                                        <div class="input-group-append"> 
                                          <button type="submit" class="single_add_to_cart_button btn btn-danger alt">Search</button>
                                        </div>
                                        </form>

                                    </div>


                                                                                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                
            </div>
            <div class="inner-main">
                    
                        <div class="col-md-12 col-sm-12 col-xs-12 services-column">
                            <div class="row">
                                <div class="col-md-3 col-sm-4 col-xs-12">
                                    <div class="well-services">
                                        <div class="well-icon">
                                            <a href="#"><i class="fa fa-umbrella" ></i></a>                                     </div>
                                        <div class="well-content">
                                            <h4><a href="#">Quality <br/>Assurence</a></h4>
                                            <p>Ensure your fingertips with our high standards database of market research.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- single-well end-->
                                <div class="col-md-3 col-sm-4 col-xs-12">
                                    <div class="well-services ">
                                        <div class="well-icon">
                                            <a href="#"><i class="fa fa-clock-o" ></i></a>                                      </div>
                                        <div class="well-content">
                                            <h4><a href="#">24X7 Customer <br/>Service</a></h4>
                                            <p>Assistance at your finger tips.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- single-well end-->
                                <div class="col-md-3 col-sm-4 col-xs-12">
                                    <div class="well-services">
                                        <div class="well-icon">
                                            <a href="#"><i class="fa fa-certificate" ></i></a>                                      </div>
                                        <div class="well-content">
                                            <h4><a href="#">Customization </a></h4>
                                            <p>We provide research according to customer requirements.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- single-well end-->
                                <div class="col-md-3 hidden-sm col-xs-12">
                                    <div class="well-services">
                                        <div class="well-icon">
                                            <a href="#"><i class="fa fa-lock" ></i></a>                                     </div>
                                        <div class="well-content">
                                            <h4><a href="#">Secured Payment <br/>Option</a></h4>
                                            <p>Your trust, our security.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- single-well end-->
                            </div>
                        </div>
                    </div>
        </div>
        <!-- End Slider Area -->
        
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
                div.bgcolor:nth-child(odd){
                  background-color: rgba(172, 202, 217, 0.2);
                }
             </style>


              @foreach($reports as $key => $result)
              <div class="bgcolor">
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
  
              <ul class="pagination" style="padding: 5px">
                 <a class="btn btn-primary" href="{{url('research-reports')}}">View All Reports </a>  

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
                <div class="services-img2">
                    <a href="{{url($result->url)}}"> 
                  <img src="{{ url('storage/uploads/category/'.$result->category_group_image) }}" alt="" style="height: 188px" width="100%"> </a> 
                  
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