
<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1"> 
  
  <!-- ============================================== TOP MENU ============================================== -->
  <div class="top-bar animate-dropdown">
    <div class="container">
      <div class="header-top-inner">
        <div class="cnt-account">
          <ul class="list-unstyled">
            <li><a href="{{ url('myaccount') }}">My Account</a></li>  
            <li><a href="{{ url('checkout') }}">My Cart</a></li>
            <li><a href="{{ url('checkout') }}">Checkout</a></li>
            <li>
                @if($userData==null)
                  <a href="{{url('myaccount/login')}}">Login</a>
                  @else
                  <a href="{{url('signout')}}">Logout</a>
                  @endif
               </li>
          </ul>
        </div>
        <!-- /.cnt-account -->
        
        
        <!-- /.cnt-cart -->
        <div class="offer-text">Customer Care:   {{ isset($contact_number->field_value)?$contact_number->field_value:"+91-7974343960" }}</div>
        <div class="clearfix"></div>
      </div>
      <!-- /.header-top-inner --> 
    </div>
    <!-- /.container --> 
  </div>
  <!-- /.header-top --> 
  <!-- ============================================== TOP MENU : END ============================================== -->
  <div class="main-header">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 logo-holder"> 
          <!-- ============================================================= LOGO ============================================================= -->
          <div class="logo"> <a href="{{url('/')}}"> <!-- <img src="{{ asset('public/enduser/assets/images/logo.png')}}" alt="logo"> --> <h2 style="margin-top: 0px"> Lazimban </h2></a> </div>
          <!-- /.logo --> 
          <!-- ============================================================= LOGO : END ============================================================= --> </div>
        <!-- /.logo-holder -->
        
        <div class="col-xs-12 col-sm-12 col-md-6 top-search-holder"> 
          <!-- /.contact-row --> 
          <!-- ============================================================= SEARCH AREA ============================================================= -->
          <div class="search-area">
            <form >
              <div class="control-group">
                <ul class="categories-filter animate-dropdown">
                  <li class="dropdown"> <a class="dropdown-toggle"  data-toggle="dropdown" href="category.html">
                  {{ $category or 'Categories' }} <b class="caret"></b></a>
                    <ul class="dropdown-menu" role="menu" > 
                        @foreach($categories as $key => $value)
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ url($value['slug']) }}">- {{$value['name']}}</a></li>
                     
                      @endforeach
                    </ul>
                  </li>
                </ul>
                <input class="search-field" name="q" value="{{ $q or ''}}" placeholder="Search here..." />
               <button type="submit" class="search-button"></button> </div>
            </form>
          </div>
          <!-- /.search-area --> 
          <!-- ============================================================= SEARCH AREA : END ============================================================= --> </div>
        <!-- /.top-search-holder -->
        
        <div class="col-xs-12 col-sm-12 col-md-3 animate-dropdown top-cart-row"> 
          <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
          
          <div class="dropdown dropdown-cart"> <a href="##" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
            <div class="items-cart-inner">
              <div class="top-cart">  </div>
              
              <div class="total-price-basket"> <span class="lbl">{{$total_item}} items /</span> <span class="total-price"> <span class="sign">RS</span><span class="value">{{$sub_total}}</span> </span> </div>
            </div>
            </a>
            <ul class="dropdown-menu">
              <li>
                <div class="cart-item product-summary">
                 <!--  <div class="row">
                    <div class="col-xs-4">
                      <div class="image"> <a href="detail.html"><img src="{{ asset('public/enduser/assets/images/cart.jpg')}}" alt=""></a> </div>
                    </div>
                    <div class="col-xs-7">
                      <h3 class="name"><a href="index.php-page-detail.htm">Simple Product</a></h3>
                      <div class="price">RS600.00</div>
                    </div>
                    <div class="col-xs-1 action"> <a href="##"><i class="fa fa-trash"></i></a> </div>
                  </div> -->
                </div>
                <!-- /.cart-item -->
                <div class="clearfix"></div>
                <hr>
                <div class="clearfix cart-total">
                  <div class="pull-right"> <span class="text">Sub Total :</span><span class='price'>RS{{$sub_total}}</span> </div>
                  <div class="clearfix"></div>
                  <a href="{{ url('checkout') }}" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a> </div>
                <!-- /.cart-total--> 
                
              </li>
            </ul>
            <!-- /.dropdown-menu--> 
          </div>
          <!-- /.dropdown-cart --> 
          
          <!-- SHOPPING CART DROPDOWN : END --> </div>
        <!-- /.top-cart-row --> 
      </div>
      <!-- /.row --> 
      
    </div>
    <!-- /.container --> 
    
  </div>
  <!-- /.main-header --> 
  
  <!-- ============================================== NAVBAR ============================================== -->
  
  <!-- /.header-nav --> 
  <!-- ============================================== NAVBAR : END ============================================== --> 
  
</header>

<!-- ============================================== HEADER : END ============================================== -->

<div class="body-content outer-top-vs" id="top-banner-and-menu">
  <div class="container"> 