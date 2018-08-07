
@extends('layouts.master')
    @section('title', 'HOME')
        
        @section('header')
        <h1>Home</h1>
        @stop

        @section('content')  
              <!-- header end -->
        @include('partials.search')
        <!-- End Slider Area -->
        
        <nav class="woocommerce-breadcrumb" itemprop="breadcrumb"><a href="#">Home</a> &gt;&gt; <a href="#">{{$title or 'Contact'}}</a></nav>
        
        <div class="published-date">
            <div class="row">
                <div class="date-box">
                  <div class="col-sm-12 border-right"> <span class="pub-date">
                    {{$title or 'Contact Us'}}
                  </span> </div>
                  
                </div>
            </div>
        </div>
            <div class="checkout-box faq-page">
            <div class="row">
                <div class="col-md-12">
                    
                    <div class="panel-group checkout-steps" id="accordion">
                        <!-- checkout-step-01  -->
            <div class="panel panel-default checkout-step-01">

               
                <!-- panel-heading -->

                <div id="collapseOne" class="panel-collapse collapse in">

                    <!-- panel-body  -->
                    <div class="panel-body">
                        <div class="contact-page">
        <div class="row">
             
                <div class="col-md-9 contact-form">
    <div class="col-md-12 contact-title">
        <h4>{{$title or 'Reach Us'}}</h4>
        <hr>
    </div>
     <form novalidate="" id="contactForm" name="sentMessage">
         <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="request_type" value="{{ $title or 'contact'}}">


    <div class="col-md-4 ">
         
            <div class="form-group">
            <label class="info-title" for="exampleInputName">Full Name <span>*</span></label>
            <input text="text" name="name" class="form-control unicase-form-control text-input" id="name" placeholder="Full Name">
          </div>
        
    </div>
    <div class="col-md-4">
        
            <div class="form-group">
            <label class="info-title" for="exampleInputEmail1">Your Email <span>*</span></label>
            <input name="email" type="text" class="form-control unicase-form-control text-input" id="email" placeholder="Email">
          </div>
        
    </div>
    <div class="col-md-4">
         
            <div class="form-group">
            <label class="info-title" for="exampleInputTitle">Your Country <span>*</span></label>
            <input type="text" name="country" class="form-control unicase-form-control text-input" id="country" placeholder="Country">
          </div>
        
    </div>

    <div class="col-md-4">
        
            <div class="form-group">
            <label class="info-title" for="exampleInputTitle">Job Title <span>*</span></label>
            <input type="text" name="job_title" class="form-control unicase-form-control text-input" id="job_title" placeholder="Job title">
          </div>
         
    </div>


    <div class="col-md-4">
       
            <div class="form-group">
            <label class="info-title" for="exampleInputTitle">Company <span>*</span></label>
            <input type="text" name="company" class="form-control unicase-form-control text-input" id="company" placeholder="Company">
          </div>
        
    </div>

    <div class="col-md-4">
        
            <div class="form-group">
            <label class="info-title" for="exampleInputTitle">Phone No. (Pls. affix country code) <span>*</span></label>
            <input type="text" name="phone" class="form-control unicase-form-control text-input" id="phone" placeholder="Phone">
          </div>
         
    </div>

    
    <div class="col-md-12"> 
            <div class="form-group">
            <label class="info-title" for="exampleInputComments">Any Specific Request <span>*</span></label>
            <textarea  class="form-control unicase-form-control " name="request_description" id="request_description" rows="5"></textarea>
          </div>
         
    </div>

     <div class="col-md-4">
        
            <div class="form-group">
            <label>Enter Captcha:</label>
                        <span id="mainCaptcha" style="margin-left: 10px;" /> </span>
                        <i class="fa fa-refresh" onclick="Captcha();"  aria-hidden="true" style="color: #337ab7; font-size: 30px; padding-left: 10px;"></i>

                        <span class="cptch_reload_button dashicons dashicons-update"></span>
                        <input type="text" id="txtInput" class="form-control" onkeyup="ValidCaptcha(1)"> 
                        <div id="CaptchaMsg" style="color: red"></div>
                        <span id="mainCaptcha2" style="display: none"></span>
          </div>
         
    </div>

    <div class="col-md-12 outer-bottom-small m-t-20" style="padding-bottom: 50px">
        <button type="submit" class="btn-upper btn btn-primary checkout-page-button" id="btnSubmit">Send Message</button>

    </div>

</form>
</div>
<div class="col-md-3 contact-info">
    <div class="contact-title">
        <h4>Mailing Address</h4>
    </div>
    <div class="clearfix address">
        <span class="contact-i"><i class="fa fa-map-marker"></i></span>
         {!! isset($company_address->field_value)?$company_address->field_value:"304, S. Jones Blvd, #3299" !!} 
        <span class="contact-span"  </span>  
    </div>
    <div class="clearfix phone-no">
        <span class="contact-i"><i class="fa fa-mobile"></i></span>
        <span class="contact-span">  {{ isset($contact_number->field_value)?$contact_number->field_value:"+1 702-425-8599" }} </span>
    </div>
    <div class="clearfix email">
        <span class="contact-i"><i class="fa fa-envelope"></i></span>
        <span class="contact-span"><a href="#"> {{ isset($website_email->field_value)?$website_email->field_value:"Sales@1MarketResearch.com" }}</a></span>
    </div>
</div>          </div><!-- /.contact-page -->
        </div>        
                    </div>
                    <!-- panel-body  -->

                </div><!-- row -->
            </div> 
                        
                    </div><!-- /.checkout-steps -->
                </div>
            </div><!-- /.row -->
        </div><!-- /.checkout-box -->
        @stop