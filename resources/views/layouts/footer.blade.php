 <!-- end Brand Area -->
        <!-- Start Banner Area -->
        <div class="banner-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="banner-content text-left col-md-12">
                             <div class="col-md-8 ">
                                <h5 style="color: #fff">Contact us at +1-702-425-8599 or share your details on sales@1marketresearch.com with your requirements of market research reports and business intelligence needs. </h5>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <div class="banner-contact-btn">
                                    <a class="banner-btn" href="{{url('contact')}}">Contact us</a>                            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Banner Area -->
        <!-- Start Footer bottom Area -->
      <!-- End Banner Area -->
        <!-- Start Footer bottom Area -->
        <footer>
            <div class="footer-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-5 col-xs-12">
                            <div class="footer-content">
                                <div class="footer-head">
                                    <div class="footer-logo">
                                        <a href="#"><img src="{{asset('public/assets/img/logo/logo2.png')}}" alt="" style="border-radius:5px;"></a>                                    </div>
                                    <p >
                                       

                                        {!! wordwrap($website_description->field_value,5,"\n") !!}   
                                    </p>
                                    <div class="footer-icons">
                                        <ul>
                                            <li>
                                                <a href="{{$facebook_url->field_value or '#'}}">
                                                    <i class="fa fa-facebook"></i>                                                </a>                                            </li>
                                            <li>
                                                <a href="{{$twitter_url->field_value or '#'}}">
                                                    <i class="fa fa-twitter"></i>                                                </a>                                            </li>
                                            
                                            <li>
                                                <a href="{{$linkedin_url->field_value or '#'}}">
                                                    <i class="fa fa-linkedin"></i>                                                </a>                                            </li>
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end single footer -->
                        <div class="col-md-4 col-sm-3 col-xs-12">
                            <div class="footer-content">
                                <div class="footer-head">
                                    <h4>Services Link</h4>
                                    <div class="footer-services-link">
                                    
                                        <ul class="footer-list">
                                        
                                        <li><a href="{{url('/')}}">Home</a></li>
                                        <li><a href="{{url('pressRelease')}}">Press Release </a></li>
                                        <li><a href="{{url('services')}}">Services</a></li>
                                        <li><a href="{{url('publisher')}}">Publisher</a></li>
                                        <li><a href="{{url('contact')}}">Contact Us</a></li>
                                        <li><a href="{{url('requestBrochure')}}">Request Brochure</a></li>
                                    @foreach($pageMenu as $key => $result)
                                        @if($key<2)
                                            <li><a href="{{url($result->slug)}}"> {{ucfirst($result->title)}}</a></li>
                                        @endif 
                                    @endforeach
                                    </ul>

                                     <ul class="footer-list hidden-sm">
                                        @foreach($pageMenu as $key => $result)
                                        @if($key<2)
                                            <?php continue; ?>
                                        @endif
                                        <li><a href="{{url($result->slug)}}"> {{ucfirst($result->title)}}</a></li>
                                        @endforeach
                                    </ul> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end single footer -->
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="footer-content">
                                <div class="footer-head">
                                    <h4>Payment Option</h4>
                                    
                                    <div class="subs-feilds">
                                        <img src="{{ asset('public/assets/img/payment-option.jpg')}}" style="border-radius:5px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end single footer -->
                    </div>
                </div>
            </div>
            <!-- End footer area -->
            <div class="footer-area-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="copyright">
                                <p>
                                    Copyright @ {{date('Y')}}
                                    1market Research All Rights Reserved                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        
        </div>
        
       
       
        <!-- all js here -->

        <!-- jquery latest version --> 
 

        <!-- jquery latest version --> 
                <script src="{{asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>


       
        <!-- bootstrap js -->
        <!-- owl.carousel js -->
        <script src="{{ asset('js/owl.carousel.min.js')}}"></script>
        <!-- Counter js -->
        <script src="{{ asset('js/jquery.counterup.min.js')}}"></script>
        <!-- waypoint js -->
        <script src="{{ asset('js/waypoints.js')}}"></script>
        <!-- isotope js -->
        <script src="{{ asset('js/isotope.pkgd.min.js')}}"></script>
        <!-- stellar js -->
        <script src="{{ asset('js/jquery.stellar.min.js')}}"></script>
        <!-- magnific js -->
        <script src="{{ asset('js/magnific.min.js')}}"></script>
        <!-- venobox js -->
        <script src="{{ asset('js/venobox.min.js')}}"></script>
        <!-- meanmenu js -->
        <script src="{{ asset('js/jquery.meanmenu.js')}}"></script>
        <!-- Form validator js -->
        <script src="{{ asset('js/form-validator.min.js')}}"></script>
        <!-- plugins js -->
        <script src="{{ asset('js/plugins.js')}}"></script>
        <!-- main js -->
        <script src="{{ asset('js/main.js')}}"></script>
        <script src="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/bootbox.js')}}"></script> 
        <script src="{{ asset('assets/js/jquery.validate.min.js')}}"></script> 
        <script src="{{ asset('assets/js/common.js')}}"></script> 

        <script type="text/javascript">
          var  url = "{{ url('/') }}";
        </script>

    </body>
</html>