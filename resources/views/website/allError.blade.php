
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

                      <table class="table table-striped table-hover table-bordered">
                        <tr>
                          <td>URL</td>
                          <td>Message</td>
                          <td>File</td>
                        </tr>
                      
                      @foreach($error as $key=> $result)
                        <tr>
                          <td>{!!$result->url!!}</td>
                          <td>{!!$result->message!!}</td>
                          <td>{!!$result->file!!}</td>
                        </tr>
                         

                      @endforeach  
                      </table>
 
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