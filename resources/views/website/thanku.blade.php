
@extends('layouts.master')
    @section('title', 'HOME')
        
        @section('header')
        <h1>Home</h1>
        @stop

        @section('content')  
              <!-- header end -->
        @include('partials.search')
        <!-- End Slider Area -->
        
        <nav class="woocommerce-breadcrumb" itemprop="breadcrumb"><a href="{{url('/')}}">Home</a> &gt;&gt; <a href="#">{{$title or 'Contact'}}</a></nav>
        
        <div class="published-date">
            <div class="row">
                <div class="date-box">
                  <div class="col-sm-12 border-right"> <span class="pub-date">
                    {{$title or 'Contact Us'}}
                  </span> </div>
                  
                </div>
            </div>
        </div>
            <!-- Left side column. contains the logo and sidebar -->
            <div class="">&nbsp;
                <div class="shopping-cart">
                    <div class="shopping-cart-table ">
                        <div class="table-responsive" style="padding:50px">
                            <h2 class="heading-title">Thank You !</h2>
                            <span class="title-tag">Thank you for getting in touch!</span>
                            <br>
                            <p >We appreciate you contacting us. We try to respond as soon as possible, so one of our Customer Service colleagues will get back to you within a few hours.</p>
                        </div>
                    </div>
                </div>
            </div>    
        @stop
