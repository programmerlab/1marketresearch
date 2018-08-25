@extends('layouts.master')
    @section('title', 'HOME')
        
@section('header')
<h1>Home</h1>
@stop

@section('content')
     <!-- header end -->
        <!-- Start Slider Area -->
            @include('partials.search')
        <!-- End Slider Area -->
        <style type="text/css">
            .errorClass{
                color: red;
            }
        </style>
        <nav class="woocommerce-breadcrumb" itemprop="breadcrumb"><a href="#">Home</a> &gt;&gt; <a href="#">Checkout</a></nav>
        
        <div class="published-date">
            <div class="row">
                <div class="date-box">
                  <div class="col-sm-12 border-right"> <span class="pub-date">{{ $reports->title }}</span> </div>
                  
                </div>
            </div>
        </div>
        
        <div class="blog-area area-padding detail-main">
            <div class="container">
                
                <div class="row">
                    <div class="report-left-sec col-sm-12">
                        
                        <div class="blog-grid home-blog detail-page">
                            <!-- Start single blog -->
                            <div class="">
                                <div class="single-blog">
                                    
                                    <div class="detail-tabs payment-tabs">
                                <div class="tab-menu">
                                     <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="active"><a href="#p-view-1" id="billing" disabled role="tab" data-toggle="tab" aria-expanded="true">BILLING >></a></li>
                                        <li class=""><a href="#p-view-2" id="order_notes" role="tab" data-toggle="tab" aria-expanded="false">ORDER NOTES >></a></li>
                                        <li class=""><a href="#p-view-3"  id="order_info" role="tab" data-toggle="tab" aria-expanded="false">ORDER INFO >></a></li>
                                        <li class=""><a href="#p-view-4"  id="payment_info" role="tab" data-toggle="tab" aria-expanded="false">PAYMENT INFO</a></li>
                                    </ul>
                                </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="p-view-1">
                                <div class="tab-inner">
                                    <div class="event-content head-team checkout-form">
                                      <form id="order_info_form" novalidate="" name="order_info_form">
                                        <ul class="sf-content" style="display: block;">
                                        <!-- form step one -->
                                        <li style="margin-bottom: 2rem;">
                                            <div class="sf_columns column_3" style="width: 50%; margin-bottom: 0px;">
                                                <label> First Name *</label>
                                                <input type="text" name="first_name" placeholder="First Name" data-required="true" title="First Name is required.">
                                                
                                            </div>
                                            <div class="sf_columns column_3" style="width: 50%; margin-bottom: 0px;">
                                                <label>Last Name *</label>
                                                <input type="text" name="last_name" placeholder="Last Name" data-required="true" title="Last Name is required.">
                                            </div>
                                        </li>
                                        <li style="margin-bottom: 2rem;">
                                            <div class="sf_columns column_3" style="width: 50%; margin-bottom: 0px;">
                                                <label>Company Name </label>
                                                <input type="text" name="company_name" placeholder="Company Name" title="Company Name is required.">                                                
                                            </div>
                                            <div class="sf_columns column_3" style="width: 50%; margin-bottom: 0px;">
                                                <label>Phone *</label>
                                                <input type="text" name="phone" placeholder="Phone" data-required="true" title="Phone is required.">
                                            </div>
                                        </li>
                                        <li style="margin-bottom: 2rem;">
                                            <div class="sf_columns column_3" style="width: 50%; margin-bottom: 0px;">
                                                <label>Email Address *</label>
                                                <input type="email" name="email" placeholder="Email" data-required="true" title="Email Address is required.">
                                            </div>
                                            <div class="sf_columns column_3" style="width: 50%; margin-bottom: 0px;">
                                                <label>Country *</label>                                               
                                                <select name="country" id="country" data-required="true" autocomplete="country" class="form-control country_to_state country_select " title="Country is required.">
                                                <option value="">Select a country…</option>
                                                <option value="AX">Åland Islands</option>
                                                <option value="AF">Afghanistan</option>
                                                <option value="AL">Albania</option>
                                                <option value="DZ">Algeria</option>
                                                <option value="AS">American Samoa</option>
                                                <option value="AD">Andorra</option>
                                                <option value="AO">Angola</option>
                                                <option value="AI">Anguilla</option>
                                                <option value="AQ">Antarctica</option>
                                                <option value="AG">Antigua and Barbuda</option>
                                                <option value="AR">Argentina</option>
                                                <option value="AM">Armenia</option>
                                                <option value="AW">Aruba</option>
                                                <option value="AU">Australia</option>
                                                <option value="AT">Austria</option>
                                                <option value="AZ">Azerbaijan</option>
                                                <option value="BS">Bahamas</option>
                                                <option value="BH">Bahrain</option>
                                                <option value="BD">Bangladesh</option>
                                                <option value="BB">Barbados</option>
                                                <option value="BY">Belarus</option>
                                                <option value="PW">Belau</option>
                                                <option value="BE">Belgium</option>
                                                <option value="BZ">Belize</option>
                                                <option value="BJ">Benin</option>
                                                <option value="BM">Bermuda</option>
                                                <option value="BT">Bhutan</option>
                                                <option value="BO">Bolivia</option>
                                                <option value="BQ">Bonaire, Saint Eustatius and Saba</option>
                                                <option value="BA">Bosnia and Herzegovina</option>
                                                <option value="BW">Botswana</option>
                                                <option value="BV">Bouvet Island</option>
                                                <option value="BR">Brazil</option>
                                                <option value="IO">British Indian Ocean Territory</option>
                                                <option value="VG">British Virgin Islands</option>
                                                <option value="BN">Brunei</option>
                                                <option value="BG">Bulgaria</option>
                                                <option value="BF">Burkina Faso</option>
                                                <option value="BI">Burundi</option>
                                                <option value="KH">Cambodia</option>
                                                <option value="CM">Cameroon</option>
                                                <option value="CA">Canada</option>
                                                <option value="CV">Cape Verde</option>
                                                <option value="KY">Cayman Islands</option>
                                                <option value="CF">Central African Republic</option>
                                                <option value="TD">Chad</option>
                                                <option value="CL">Chile</option>
                                                <option value="CN">China</option>
                                                <option value="CX">Christmas Island</option>
                                                <option value="CC">Cocos (Keeling) Islands</option>
                                                <option value="CO">Colombia</option>
                                                <option value="KM">Comoros</option>
                                                <option value="CG">Congo (Brazzaville)</option>
                                                <option value="CD">Congo (Kinshasa)</option>
                                                <option value="CK">Cook Islands</option>
                                                <option value="CR">Costa Rica</option>
                                                <option value="HR">Croatia</option>
                                                <option value="CU">Cuba</option>
                                                <option value="CW">Curaçao</option>
                                                <option value="CY">Cyprus</option>
                                                <option value="CZ">Czech Republic</option>
                                                <option value="DK">Denmark</option>
                                                <option value="DJ">Djibouti</option>
                                                <option value="DM">Dominica</option>
                                                <option value="DO">Dominican Republic</option>
                                                <option value="EC">Ecuador</option>
                                                <option value="EG">Egypt</option>
                                                <option value="SV">El Salvador</option>
                                                <option value="GQ">Equatorial Guinea</option>
                                                <option value="ER">Eritrea</option>
                                                <option value="EE">Estonia</option><option value="ET">Ethiopia</option><option value="FK">Falkland Islands</option><option value="FO">Faroe Islands</option><option value="FJ">Fiji</option><option value="FI">Finland</option><option value="FR">France</option><option value="GF">French Guiana</option><option value="PF">French Polynesia</option><option value="TF">French Southern Territories</option><option value="GA">Gabon</option><option value="GM">Gambia</option><option value="GE">Georgia</option><option value="DE">Germany</option><option value="GH">Ghana</option><option value="GI">Gibraltar</option><option value="GR">Greece</option><option value="GL">Greenland</option><option value="GD">Grenada</option><option value="GP">Guadeloupe</option><option value="GU">Guam</option><option value="GT">Guatemala</option><option value="GG">Guernsey</option><option value="GN">Guinea</option><option value="GW">Guinea-Bissau</option><option value="GY">Guyana</option><option value="HT">Haiti</option><option value="HM">Heard Island and McDonald Islands</option><option value="HN">Honduras</option><option value="HK">Hong Kong</option><option value="HU">Hungary</option><option value="IS">Iceland</option><option value="IN">India</option><option value="ID">Indonesia</option><option value="IR">Iran</option><option value="IQ">Iraq</option><option value="IM">Isle of Man</option><option value="IL">Israel</option><option value="IT">Italy</option><option value="CI">Ivory Coast</option><option value="JM">Jamaica</option><option value="JP">Japan</option><option value="JE">Jersey</option><option value="JO">Jordan</option><option value="KZ">Kazakhstan</option><option value="KE">Kenya</option><option value="KI">Kiribati</option><option value="KW">Kuwait</option><option value="KG">Kyrgyzstan</option><option value="LA">Laos</option><option value="LV">Latvia</option><option value="LB">Lebanon</option><option value="LS">Lesotho</option><option value="LR">Liberia</option><option value="LY">Libya</option><option value="LI">Liechtenstein</option><option value="LT">Lithuania</option><option value="LU">Luxembourg</option><option value="MO">Macao S.A.R., China</option><option value="MK">Macedonia</option><option value="MG">Madagascar</option><option value="MW">Malawi</option><option value="MY">Malaysia</option><option value="MV">Maldives</option><option value="ML">Mali</option><option value="MT">Malta</option><option value="MH">Marshall Islands</option><option value="MQ">Martinique</option><option value="MR">Mauritania</option><option value="MU">Mauritius</option><option value="YT">Mayotte</option><option value="MX">Mexico</option><option value="FM">Micronesia</option><option value="MD">Moldova</option><option value="MC">Monaco</option><option value="MN">Mongolia</option><option value="ME">Montenegro</option><option value="MS">Montserrat</option><option value="MA">Morocco</option><option value="MZ">Mozambique</option><option value="MM">Myanmar</option><option value="NA">Namibia</option><option value="NR">Nauru</option><option value="NP">Nepal</option><option value="NL">Netherlands</option><option value="NC">New Caledonia</option><option value="NZ">New Zealand</option><option value="NI">Nicaragua</option><option value="NE">Niger</option><option value="NG">Nigeria</option><option value="NU">Niue</option><option value="NF">Norfolk Island</option><option value="KP">North Korea</option><option value="MP">Northern Mariana Islands</option><option value="NO">Norway</option><option value="OM">Oman</option><option value="PK">Pakistan</option><option value="PS">Palestinian Territory</option><option value="PA">Panama</option><option value="PG">Papua New Guinea</option><option value="PY">Paraguay</option><option value="PE">Peru</option><option value="PH">Philippines</option><option value="PN">Pitcairn</option><option value="PL">Poland</option><option value="PT">Portugal</option><option value="PR">Puerto Rico</option><option value="QA">Qatar</option><option value="IE">Republic of Ireland</option><option value="RE">Reunion</option><option value="RO">Romania</option><option value="RU">Russia</option><option value="RW">Rwanda</option><option value="ST">São Tomé and Príncipe</option><option value="BL">Saint Barthélemy</option><option value="SH">Saint Helena</option><option value="KN">Saint Kitts and Nevis</option><option value="LC">Saint Lucia</option><option value="SX">Saint Martin (Dutch part)</option><option value="MF">Saint Martin (French part)</option><option value="PM">Saint Pierre and Miquelon</option><option value="VC">Saint Vincent and the Grenadines</option><option value="WS">Samoa</option><option value="SM">San Marino</option><option value="SA">Saudi Arabia</option><option value="SN">Senegal</option><option value="RS">Serbia</option><option value="SC">Seychelles</option><option value="SL">Sierra Leone</option><option value="SG">Singapore</option><option value="SK">Slovakia</option><option value="SI">Slovenia</option><option value="SB">Solomon Islands</option><option value="SO">Somalia</option><option value="ZA">South Africa</option><option value="GS">South Georgia/Sandwich Islands</option><option value="KR">South Korea</option><option value="SS">South Sudan</option><option value="ES">Spain</option><option value="LK">Sri Lanka</option><option value="SD">Sudan</option><option value="SR">Suriname</option><option value="SJ">Svalbard and Jan Mayen</option><option value="SZ">Swaziland</option><option value="SE">Sweden</option><option value="CH">Switzerland</option><option value="SY">Syria</option><option value="TW">Taiwan</option><option value="TJ">Tajikistan</option><option value="TZ">Tanzania</option><option value="TH">Thailand</option><option value="TL">Timor-Leste</option><option value="TG">Togo</option><option value="TK">Tokelau</option><option value="TO">Tonga</option><option value="TT">Trinidad and Tobago</option><option value="TN">Tunisia</option><option value="TR">Turkey</option><option value="TM">Turkmenistan</option><option value="TC">Turks and Caicos Islands</option><option value="TV">Tuvalu</option><option value="UG">Uganda</option><option value="UA">Ukraine</option><option value="AE">United Arab Emirates</option><option value="GB">United Kingdom (UK)</option><option value="US">United States (US)</option><option value="UM">United States (US) Minor Outlying Islands</option><option value="VI">United States (US) Virgin Islands</option><option value="UY">Uruguay</option><option value="UZ">Uzbekistan</option><option value="VU">Vanuatu</option><option value="VA">Vatican</option><option value="VE">Venezuela</option><option value="VN">Vietnam</option><option value="WF">Wallis and Futuna</option><option value="EH">Western Sahara</option><option value="YE">Yemen</option><option value="ZM">Zambia</option><option value="ZW">Zimbabwe</option></select>

                                            </div>
                                        </li>
                                        <li style="margin-bottom: 2rem;">
                                            <div class="sf_columns column_6" style="width: 100%; margin-bottom: 0px;">
                                                <label>Address *</label>
                                                <textarea placeholder="Street Address" name="address" data-required="true" title="Address is required."></textarea>
                                            </div>
                                            

                                            <div class="sf_columns column_6" style="width: 100%; margin-bottom: 0px;">
                                                <label>Town / City *</label>
                                                <input type="text" name="city" placeholder="Town City" data-required="true" title="City is required.">
                                            </div>
                                        </li>


                                        <li style="margin-bottom: 2rem;">
                                            <div class="sf_columns column_3" style="width: 50%; margin-bottom: 0px;">
                                                <label>State / County *</label>
                                                <input type="text" name="state" placeholder="State County" data-required="true" title="State is required.">
                                            </div>
                                            <div class="sf_columns column_3" style="width: 50%; margin-bottom: 0px;">
                                                <label>Postcode / ZIP *</label>
                                                <input type="text" name="zipcode" placeholder="Postcode /Zip" data-required="true" title="Postcode is required.">
                                            </div>
                                        </li>

                                    </ul>
                                    
                                    <div class="checkout-next">
                                        <button type="submit" onclick="orderTab('order_notes','order_info')" class="order_notes" >Next</button>
                                    </div>
                                    </form>
                                            </div>
                                        </div>
                                    </div>
                                <div class="tab-pane" id="p-view-2">
                                        <div class="tab-inner">
                                        <form id="order_note_form" novalidate="" name="order_note_form">
                                    
                                            <div class="event-content head-team checkout-form">
                                                <ul class="sf-content" style="display: block;">
                                        <!-- form step two -->

                                        <li style="margin-bottom: 2rem;">
                                            <div class="sf_columns column_6" style="width: 100%; margin-bottom: 0px;">
                                                <label>Order Notes</label>
                                                <textarea placeholder="Notes About Your Order, e.g Special Note For delivery. " name="order_notes"></textarea>
                                            </div>

                                        </li>
                                      
                                    </ul>
                                    <div class="checkout-next">
                                        <button type="submit" onclick="orderTab('order_info','payment_info')" class="order_info"  disabled="disabled" >Next</button>
                                    </div>
                                    </form>
                                            </div>
                                        </div>
                                    </div>
                                
                                <div class="tab-pane" id="p-view-3">
                                    <div class="tab-inner">
                                         <div class="col-md-12">
                                                                    <p>Have a coupon? 
                                                                            <a href="javascript:void(0)" class="showcoupon">Click here to enter your code</a>  </p>
                                                                            <b>
                                                                            <span style="background-color: #f4f4f4;width: 100%;float: left;padding: 10px;margin-bottom: 20px; display: none;" class="Cmsg"></span> </b>

                                                                        <div style="border: 1px solid #ccc;padding:20px 0px "   class="col-md-12 coupn_form">
                                                                            
                                                                            <form  id="checkout_coupon" class="checkout_coupon" method="post">

                                                                                <div class="form-row form-row-first col-md-4">
                                                                                    <input type="text" name="coupon_code" class="input-text form-control" placeholder="Coupon code" id="coupon_code"   style="height: 40px">
                                                                                </div>

                                                                                <div class="col-md-2">
                                                                                    <input type="submit" class="btn btn-primary" style="background-color: #ec1b22;font-weight:700" name="apply_coupon" value="Apply Coupon">
                                                                                </div>
                                                                     
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                        <form id="payment_summary" novalidate="" name="payment_summary" >
                                            <div class="event-content head-team checkout-form">
                                                
                                                <ul class="sf-content" style="display: block;">
                                                    <!-- form step tree -->
                                                    <li style="margin-bottom: 2rem;">
                                                        <div class="sf_columns column_6" style="width: 100%; margin-bottom: 0px;">
                                                            <div class="panel panel-default">
                                                               
                                                                <div class="panel-body">
                                                                    <hr>
                                                                    <div class="col-md-12">
                                                                        <strong>Product Details</strong>
                                                                        <div class="pull-right"><strong>Total</strong></div>
                                                                    </div>

                                                                        <?php
                                                                            $number = (float) $cart_detail->price;    ?>

                                                                    <hr>
 
                                                                    <div class="col-md-12">
                                                                        <span>{{ $reports->title }} × 1</span>
                                                                        <div class="pull-right"><span>$</span><span>{{number_format($number,2)}}
                                                                         </span>
                                                                            <input type="hidden" name="price" value="{{ $cart_detail->price }}">
                                                                            <input type="hidden" name="license_type" value="{{ $cart_detail->options->license_type }}">
                                                                        </div>
                                                                        <hr>
                                                                    </div>
                                                                    <hr>

                                                                    <div class="col-md-12 "  >
                                                                        <strong>Subtotal</strong>
                                                                        <div class="pull-right"><strong >${{number_format($number,2)}}</strong></div>
                                                                        <hr>
                                                                    </div>
                                                                     <div class="col-md-12 discount" style="display:none">
                                                                         <strong>Discount</strong>
                                                                        <div class="pull-right" >- <strong id="discount_price"> $700 </strong></div>
                                                                        <hr>
                                                                    </div>
                                                                    
                                                                    <hr>
                                                                    <div class="col-md-12">
                                                                        <strong>Total</strong>
                                                                        <div class="pull-right"><strong id="total_price">${{number_format($number,2)}}</strong></div>
                                                                        <hr>
                                                                    </div>
                                                                    

                                                                </div>

                                                            </div>
                                                        </div>
                                                        
                                                    </li>
                                                </ul>
                                                <div class="checkout-next"> 
                                                     <button type="submit"  disabled="disabled" class="payment_summary"  >Next</button>
                                                </div>
                                                  
                                            </div>
                                        </form> 
                                    </div>
                                </div>
                        <div class="tab-pane" id="p-view-4">
                            <div class="tab-inner">

                            <form id="paymentFinal" name="paymentFinal" novalidate="">
                                <div class="event-content head-team checkout-form">
                                    
                                    <ul class="sf-content" style="display: block;">
                                        <!-- form step four -->
                                        <li style="margin-bottom: 2rem;">
                                           
                                            <div class="sf_columns column_6" style="width: 100%; margin-bottom: 0px;">

                                                <h3>Payment</h3>
                                                <div class="panel-group" id="accordion">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <!--<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#panel1">
                                                                
                                                                </a>-->
                                                                 <input type="radio" name="payment_method" value="PayPal" class="payment_method" >&nbsp;&nbsp;&nbsp;PayPal
                                                            </h4>
                                                        </div>
                                                        <div id="panel1" class="panel-collapse collapse">
                                                            <div class="panel-body">
                                                                Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                               <!-- <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#panel2">
                                                                
                                                                </a>-->
                                                                <input type="radio" name="payment_method" value="BankTransfer" class="payment_method" checked="checked"> &nbsp;&nbsp;&nbsp;Direct Bank Transfer
                                                            </h4>
                                                        </div>
                                                        <div id="panel2" class="panel-collapse collapse">
                                                            <div class="panel-body">
                                                                Sales team will contact you soon with bank details
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>

                                        </li>
                                    </ul>
                                    <div class="checkout-next">
                                        <button type="submit" class="paymentFinal" disabled="disabled" id="place_order">Place Order</button>
                                    </div>
                                </form>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                    
                                </div>
                            </div>
                            <!-- End single blog -->
                        </div>
                    </div>
                    
                                        
                    
                    
                </div>
                <!-- End row -->
                
                <!--End row-->
            </div>
        </div>
        
@stop
         