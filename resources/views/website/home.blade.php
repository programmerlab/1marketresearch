
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
             </style>

              @foreach($reports as $key => $result)
              <div class="">
                <div class="single-blog">
                  <div class="blog-content">
                    <div class="blog-title">
                        <a href="#">
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
              <li class="disabled"><a href="#">«</a></li>
              <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
              <li><a href="#">»</a></li>
            </ul>
      
              <!-- End single blog -->
            </div>
          </div>

                <div class="report-right-sec col-sm-4">
              <div class="release-background">
                        <div class="mey-help-new">
                                <div class="assist-pic"><img src="{{ asset('public/assets/img/2(1).jpg')}}"></div>
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
                    <img src="img/review/1.jpg" alt="">
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
                    <img src="img/review/2.jpg" alt="">
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
                    <img src="img/review/1.jpg" alt="">
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
              <p>Lorem ipsum dolor is the dummy text for describung the website content.</p>
            </div>
          </div>
        </div>
        <div class="row"> 
          
          @foreach($category as $key=> $result)

            <div class="col-md-3 col-sm-3 col-xs-12">
              <div class="single-services text-center" style="height: 300px">
                <div class="services-img">
                  <img src="{{ url('storage/uploads/category/'.$result->category_group_image) }}" alt="" style="height: 230px" width="100%">
                  <div class="image-layer">
                    <a href="{{url($result->url)}}">{{$result->category_name}}</a>                  </div>
                </div>
                <div class="main-services">
                  <div class="service-content">
                    <h4>{{$result->category_name}}</h4>
                                      </div>
                </div>
              </div>
            </div>

          @endforeach  

            
            <div class="col-md-2 col-sm-2 col-xs-12">
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
            
           
            <!-- single-well end-->
                    </div>
                </div>
            </div>  
  @stop