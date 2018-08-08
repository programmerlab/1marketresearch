
@extends('layouts.master')
    @section('title', 'HOME')
        
        @section('header')
        <h1>Home</h1>
        @stop

        @section('content')  
          
                <!-- header end -->
        <!-- Start Slider Area -->
            <div class="inner-serch-bar">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group md-form form-sm form-2 pl-0">
                            <input class="form-control my-0 py-1 amber-border" type="text" placeholder="Search Your Keywords..." aria-label="Search">
                                <div class="input-group-append">
                                    <a href="#">Search</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- End Slider Area -->
        
        <nav class="woocommerce-breadcrumb" itemprop="breadcrumb"><a href="#">Home</a> &gt;&gt; <a href="#">404</a></nav>
        
        <div class="published-date">
            <div class="row">
                <div class="date-box">
                  <div class="col-sm-12 border-right"> <span class="pub-date">
                   Page not found
                  </span> </div>
                  
                </div>
            </div>
        </div>
        
        <div class="blog-area area-padding detail-main">
            <div class="container">
                
                <div class="row">
                    <div class="report-left-sec col-sm-12" style="height: 300px; text-align: center; margin-top: 20px;" align="conter">
                         <input style="width: 550px; padding: 20px; cursor: pointer; box-shadow: 6px 6px 5px; #999; -webkit-box-shadow: 6px 6px 5px #999; -moz-box-shadow: 6px 6px 5px #999; font-weight: bold; background: #ec1b22; color: #000; border-radius: 10px; border: 1px solid #999; font-size: 200%; color: #fff" type="button" value="Sorry! This Page Doesn’t Exist!" onclick="window.location.href='{{url('/')}}'">
                         <br>

                         <hr>
                         <br>
                          <h3>Visit the <a href="{{url('/')}}">Home Page</a> or <a href="{{url('contact')}}">Contact US</a> about the Problem</h3>
                    </div>
                     
                       
                   
                    
                </div>
                <!-- End row -->
                
                <!--End row-->
            </div>
        </div>
        @stop