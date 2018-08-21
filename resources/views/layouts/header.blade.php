
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>{{ $meta_title or url('/') }}</title> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="Keywords" content="{{$meta_key or url('/') }}">
        <meta name="Description" content="{{ strip_tags($meta_desc) }}"> 
        <!-- favicon -->      
        <link rel="shortcut icon" type="image/png" href="{{url('storage/uploads/img/'.$website_logo->field_value)}}" /> 
        <!-- all css here -->

        <!-- bootstrap v3.3.6 css -->
        <link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.min.css')}}">

        
        <link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap-switch.min.css')}}">
        <link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap-datepicker3.min.css')}}">
        <!-- owl.carousel css -->
        <link rel="stylesheet" href="{{ URL::asset('assets/css/owl.carousel.css')}}">
        <link rel="stylesheet" href="{{ URL::asset('assets/css/owl.transitions.css')}}">
        <!-- meanmenu css -->
        <link rel="stylesheet" href="{{ URL::asset('assets/css/meanmenu.min.css')}}">
        <!-- font-awesome css -->
        <link rel="stylesheet" href="{{ URL::asset('assets/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{ URL::asset('assets/css/icon.css')}}">
        <link rel="stylesheet" href="{{ URL::asset('assets/css/flaticon.css')}}">
        <!-- magnific css -->
        <link rel="stylesheet" href="{{ URL::asset('assets/css/magnific.min.css')}}">
        <!-- venobox css -->
        <link rel="stylesheet" href="{{ URL::asset('assets/css/venobox.css')}}">
        <!-- style css -->
        <link rel="stylesheet" href="{{ URL::asset('assets/css/style.css')}}">
        <!-- responsive css -->
        <link rel="stylesheet" href="{{ URL::asset('assets/css/responsive.css')}}"> 
        <!-- modernizr css -->
        
        {!! $google_anatycs->field_value or '' !!}
        
    </head>
        <body onload="Captcha();">

        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="main-wraper">
        <header class="header-one">
            <!-- Start top bar -->
            <div class="topbar-area fix hidden-xs">
                <div class="container">
                    <div class="row">
                        <div class=" col-md-12 col-sm-12">
                            <div class="topbar-left">
                                <ul>
                                    <li><a href="#"><i class="fa fa-envelope"></i>  
                                        {{$website_email->field_value or ' sales@globalmarketplayers.com' }}</a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-phone"></i> {{$phone->field_value or '+1-1234567891'}} </a></li>
                                </ul>  
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
            <!-- End top bar -->
            <!-- header-area start -->
            <div class="header-area hidden-xs">
                <div class="container">
                    <div class="row">
                        <!-- logo start -->
                        <div class="col-md-3 col-sm-3 logo-bg">
                            <div class="logo">
                                <!-- Brand -->
                                <a class="navbar-brand page-scroll sticky-logo" href="{{url('/')}}">
                                    <img src="{{ url('img/logo/logo2.png')}}" alt="">                                </a>                            </div>
                        </div>
                        <!-- logo end -->
                        <div class="col-md-9 col-sm-9">
                            <div class="header-right-link">
                                <!-- search option start -->
                                
                                <!-- search option end -->
                            </div>
                            <!-- mainmenu start -->
                            <nav class="navbar navbar-default">
                                <div class="collapse navbar-collapse" id="navbar-example">
                                    <div class="main-menu">
                                        <ul class="nav navbar-nav navbar-right">
                                            <li><a class="pagess" href="{{url('research-categories')}}">Research Categories</a>
                                                <ul class="sub-menu" >
                                                    @foreach($catMenu as $result)
                                                    <li><a href="{{url($result->url)}}"> {{ucwords($result->category_name)}}</a></li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            <li><a class="pagess" href="{{url('about-us')}}">About us</a>
                                                <ul class="sub-menu" style="width: 300px">
                                                    <li style="width: 100%"><a href="{{url('pressRelease')}}">Press Release</a></li>
                                                </ul>
                                            </li>
                                            <li><a class="pagess" href="{{url('publisher')}}">Publisher</a>
                                            </li>
                                            <li><a class="pagess" href="{{url('services')}}">Services</a>
                                                
                                            </li>
                                            <li><a class="pagess" href="{{url('contact')}}">Contact Us</a>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                            <!-- mainmenu end -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- header-area end -->
            <!-- mobile-menu-area start -->
            <div class="mobile-menu-area hidden-lg hidden-md hidden-sm">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mobile-menu">
                                <div class="logo">
                                    <a href="{{url('/')}}"><img src="{{ url('img/logo/logo.png')}}" alt="" /></a>                                </div>
                                <nav id="dropdown">
                                    <ul>
                                        <li>
                                            <a class="pagess" href="{{url('research-categories')}}">Research Categories</a>
                                                <ul class="sub-menu">
                                                    @foreach($catMenu as $result)
                                                    <li><a href="{{url($result->url)}}">
                                                        {{ucwords($result->category_name)}}</a></li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            <li><a class="pagess" href="{{url('pressRelease')}}">About us</a>
                                                <ul class="sub-menu">
                                                    <li><a href="{{url('pressRelease')}}">Press Release</a></li>
                                                </ul>
                                            </li>
                                            <li><a class="pagess" href="{{url('publisher')}}">Publisher</a>
                                            </li>
                                            <li><a class="pagess" href="{{url('services')}}">Services</a>
                                                
                                            </li>
                                            <li><a class="pagess" href="{{url('contact')}}">Contact Us</a>
                                            </li>
                                    </ul>
                                </nav>
                            </div>                  
                        </div>
                    </div>
                </div>
            </div>
            <!-- mobile-menu-area end -->       
        </header>