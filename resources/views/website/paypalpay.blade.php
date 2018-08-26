
@extends('layouts.master')
    @section('title', 'HOME')
        
        @section('header')
        <h1>Home</h1>
        @stop

        @section('content')  
              <!-- header end -->
        @include('partials.search')
        <!-- End Slider Area -->
        
        <nav class="woocommerce-breadcrumb" itemprop="breadcrumb"><a href="{{url('/')}}">Home</a> &gt;&gt; <a href="#">{{$title or 'paypal'}}</a></nav>
        
        <div class="published-date">
            <div class="row">
                <div class="date-box">
                  <div class="col-sm-12 border-right"> <span class="pub-date">
                    {{$title or 'Payment status'}}
                  </span> </div>
                  
                </div>
            </div>
        </div>
            <!-- Left side column. contains the logo and sidebar -->
            <div class="">&nbsp;
                <div class="shopping-cart">
                    <div class="shopping-cart-table ">
                        <div class="table-responsive" style="padding:50px">
                          <p>{{$msg}} </p>
                          <br>
                            <h2 class="heading-title">Thank You !</h2> 

                            <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
              
                            <input type="hidden" name="business" value="sales@1marketresearch.com">
                            <!-- Specify a Buy Now button. -->
                            <input type="hidden" name="cmd" value="_xclick">

                            <!-- Specify details about the item that buyers will purchase. -->
                            <input type="hidden" name="item_name" value="Hot Sauce-12oz. Bottle">
                            <input type="hidden" name="amount" value="1.95">
                            <input type="hidden" name="currency_code" value="USD">



                            <!-- Specify URLs -->
                              <input type='hidden' name='cancel_return' value="{{url('paypalpay?cancel_return=1')}}">
                              <input type='hidden' name='return' value="{{url('paypalpay?return=1')}}">
                              <input type='hidden' name='notify_url' value="{{url('paypalpay?notify_url=1')}}">

                              @if($show==0)

                            <!-- Display the payment button. -->
                          <!--   <input type="image" name="submit" border="0"
                            src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
                            alt="Buy Now">
                            <img alt="" border="0" width="1" height="1"
                            src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" > -->
                            @endif

                          </form>

                             
                        </div>
                    </div>
                </div>
            </div>    
        @stop
