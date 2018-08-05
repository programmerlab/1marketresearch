
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
        
        <nav class="woocommerce-breadcrumb" itemprop="breadcrumb"><a href="#">Home</a> &gt;&gt; <a href="#">Contact</a></nav>
        
        <div class="published-date">
            <div class="row">
                <div class="date-box">
                  <div class="col-sm-12 border-right"> <span class="pub-date">
                    Contact
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
        <h4>Contact Form</h4>
    </div>
    <div class="col-md-4 ">
        <form class="register-form" role="form">
            <div class="form-group">
            <label class="info-title" for="exampleInputName">Pull Name <span>*</span></label>
            <input type="email" class="form-control unicase-form-control text-input" id="exampleInputName" placeholder="">
          </div>
        </form>
    </div>
    <div class="col-md-4">
        <form class="register-form" role="form">
            <div class="form-group">
            <label class="info-title" for="exampleInputEmail1">Your Email <span>*</span></label>
            <input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="">
          </div>
        </form>
    </div>
    <div class="col-md-4">
        <form class="register-form" role="form">
            <div class="form-group">
            <label class="info-title" for="exampleInputTitle">Your Country <span>*</span></label>
            <input type="email" class="form-control unicase-form-control text-input" id="exampleInputTitle" placeholder="Title">
          </div>
        </form>
    </div>

    <div class="col-md-4">
        <form class="register-form" role="form">
            <div class="form-group">
            <label class="info-title" for="exampleInputTitle">Job Title <span>*</span></label>
            <input type="email" class="form-control unicase-form-control text-input" id="exampleInputTitle" placeholder="Title">
          </div>
        </form>
    </div>


    <div class="col-md-4">
        <form class="register-form" role="form">
            <div class="form-group">
            <label class="info-title" for="exampleInputTitle">Company <span>*</span></label>
            <input type="email" class="form-control unicase-form-control text-input" id="exampleInputTitle" placeholder="Title">
          </div>
        </form>
    </div>

    <div class="col-md-4">
        <form class="register-form" role="form">
            <div class="form-group">
            <label class="info-title" for="exampleInputTitle">Phone No. (Pls. affix country code) <span>*</span></label>
            <input type="email" class="form-control unicase-form-control text-input" id="exampleInputTitle" placeholder="Title">
          </div>
        </form>
    </div>

    
    <div class="col-md-12">
        <form class="register-form" role="form">
            <div class="form-group">
            <label class="info-title" for="exampleInputComments">Any Specific Request <span>*</span></label>
            <textarea class="form-control unicase-form-control" id="exampleInputComments" rows="5"></textarea>
          </div>
        </form>
    </div>
    <div class="col-md-12 outer-bottom-small m-t-20" style="padding-bottom: 50px">
        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Send Message</button>

    </div>

</div>
<div class="col-md-3 contact-info">
    <div class="contact-title">
        <h4>Mailing Address</h4>
    </div>
    <div class="clearfix address">
        <span class="contact-i"><i class="fa fa-map-marker"></i></span>
         {!! isset($company_address->field_value)?$company_address->field_value:"Indore MP 452001" !!} 
        <span class="contact-span"  </span>  
    </div>
    <div class="clearfix phone-no">
        <span class="contact-i"><i class="fa fa-mobile"></i></span>
        <span class="contact-span">  {{ isset($contact_number->field_value)?$contact_number->field_value:"+91-9168518310" }} </span>
    </div>
    <div class="clearfix email">
        <span class="contact-i"><i class="fa fa-envelope"></i></span>
        <span class="contact-span"><a href="index.htm#"> {{ isset($website_email->field_value)?$website_email->field_value:"info@guruhomeshops.com" }}</a></span>
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