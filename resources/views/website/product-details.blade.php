@extends('layouts.master')
    @section('title', 'HOME')
        
        @section('header')
        <h1>Home</h1>
        @stop

        @section('content')
            @include('partials.breadcrumb')
            <div id="main" class="site-main">
              	<div class="page-wrapper">
                	
                    <div class="col-md-6">
                    	<div class='zoom ex1' id='ex1'>
                            <img src="{{ asset('storage/uploads/products/'. $product->photo) }}"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                    	<div class="product_discription">
                        	<h2 class="product_name">{{$product->product_title}}</h2>
                            <h3 class="product_price">RS {{$product->price-($product->price*$product->discount/100)}}  </h3> <h5><p style="text-decoration: line-through">RS {{$product->price}}</p></h5>
                            <table class="variations" cellspacing="0">
                                <tbody>
                                        <!--<tr>
                                            <td ><label for="pa_beden">Qty</label></td>
                                            <td>
                                                <select id="pa_beden" class="" name="attribute_pa_beden" data-attribute_name="attribute_pa_beden" data-show_option_none="yes"><option value="">Bir seçim yapın</option><option value="xxs" class="attached enabled">XXS</option><option value="xs" class="attached enabled">XS</option><option value="s" class="attached enabled">S</option><option value="l" class="attached enabled">L</option><option value="m" class="attached enabled">M</option><option value="xl" class="attached enabled">XL</option><option value="xxl" class="attached enabled">XXL</option></select><a class="reset_variations" href="#" style="visibility: hidden;">Temizle</a>						</td>
                                        </tr>-->
                                </tbody>
                            </table>
        					<div class="quantity_outer">
                            	<input type="number" value="1" onchange="updateCart(this.value)" min=1>
                                 <a href="{{ url(str_slug($product->product_title,'-').'/addToCart/'.$product->id) }}" id="addToCart" >

                                <button type="submit" class="single_add_to_cart_button button alt disabled wc-variation-selection-needed">Add to Cart</button></a>
                                
                                <a href="{{ url(str_slug($product->product_title,'-').'/buyNow/'.$product->id) }}" >
                                <button type="submit" class="single_add_to_cart_button button alt disabled wc-variation-selection-needed">Buy</button></a>                                    
                            </div>
                            <div class="category_list">
                            	<span><strong>Description:</strong></span> <span>{!! str_limit($product->description,100) !!}</span>                                
                            </div>
                            <div>
                                <h6>Seller -  {{ ($helper->getVendorName($product->id)) ? $helper->getVendorName($product->id) : 'Admin' }}</h6>
                            </div>    
                        </div>                        
                    </div>
                    
                        
                    <div class="col-md-12">
                    	<div class="product_info">
                        	<div id="horizontalTab">
                                <ul class="resp-tabs-list">
                                    <li>Description </li>
                                    <!--<li>Ek bilgi </li>-->
                                    <!--<li>Yorumlar (0) </li>-->
                                    <!--<li>Satıcı Bilgisi </li>-->
                                    <li>More Product </li>
                                    <!--<li>Product Enquiry </li>-->
                                </ul>
                                <div class="resp-tabs-container">
                                        <div>
                                            <h2>Description</h2>
                                            <p>{!! $product->description !!}.</p>
                                            <h6>Seller -  {{ ($helper->getVendorName($product->id)) ? $helper->getVendorName($product->id) : 'Admin' }}</h6>
                                        </div>
                                         
                                        <div>    
                                            <div class="owl-carousel owl-theme">
                                            @foreach($hot_products as $result)
                                                    <div class="item">
                                                         <a href="{{url($result->url)}}"><img src="{{ asset('storage/uploads/products/'. $result->photo) }}" alt="Gıda Ürünleri">								
                                                            <h2>{{ $result->product_title }} </h2>
                                                            <h6>Seller -  {{ ($helper->getVendorName($result->id)) ? $helper->getVendorName($result->id) : 'Admin' }}</h6>
                                                        </a>
                                                    </div>
                                            @endforeach
                                                                     
                                                
                                            </div>	    
                                        </div>
                                         
                                </div>
                            </div>	
                        </div>
                    </div>
                    <hr>    
                    <div class="col-md-12">
                     <div class="product-review">
                         <h2>Reviews</h2>
                            <div class="rating_outer"><span class="fa fa-star" id="star1" onclick="add(this,1)"></span>
                                <span class="fa fa-star" id="star2" onclick="add(this,2)"></span>
                                <span class="fa fa-star" id="star3" onclick="add(this,3)"></span>
                                <span class="fa fa-star" id="star4" onclick="add(this,4)"></span>
                                <span class="fa fa-star" id="star5" onclick="add(this,5)"></span></div>
                                
                                
                                 <h2>Comment</h2>
                                <div class="comment_form row">
                                
                                 <div class="col-md-6"><input class="input-text" type="text" placeholder="Name"></div>
                                    <div class="col-md-6"><input class="input-text" type="text" placeholder="Email"></div>
                                    <div class="col-md-12"><textarea class="input-text" placeholder="Comment">                       </textarea></div>
                                    <div class="col-md-12"><input value="submit" class="submit-btn" type="submit"></div>
                                </div>
                               
                        </div>
                    </div>
                    
                </div>
            </div>
        @stop
        
<style>
    .checked {
        color: orange;
    }
    .comment_form .input-text{ height:50px; margin-bottom:15px;}
    .comment_form textarea.input-text{ height:200px; resize:none;}
</style>