<div class="col-md-9 col-sm-8">
                                  <div class="add_panel row">
                                      <div class="col-md-6"><img src="{{ asset('public/new/images/indirim-kazan.jpg') }}"></div>
                                      <div class="col-md-6"><img src="{{ asset('public/new/images/sepette-indirim.jpg') }}"></div>
                                  </div>
                                  
                                  
                                  <div class="product_list_outer">
                                      <h3><span>New</span> Products</h3>
                                      
                                      
                                      <ul>
                                        @foreach($categories as $key => $value) 
                                            @foreach($products as $key2 => $product)
                                                  
                                                @if($value['id']!=$product->category->parent_id && $key < 1) 
                                                    <li>
                                                        <div class="col-md-3"><a href="{{ url($product->url) }}"><img src="{{ asset('storage/uploads/products/'. $product->photo) }}"></a></div>
                                                        <div class="col-md-4"><h2>{{$product->product_title}}</h2>({{ $product->views+100 }} views)</div>
                                                         <div class="col-md-3"><span class="price-product"> RS {{$product->price-($product->price*$product->discount)/100}}</span></div>
                                                          <div class="col-md-2">
                                                            <a href="{{ url($product->url) }}" class="product_link">View Details</a>
                                                                <h6>Seller -  {{ ($helper->getVendorName($product->id)) ? $helper->getVendorName($product->id) : 'Admin' }}</h6>
                                                          </div>
                                                            
                                                        
                                                    </li>
                                                       
                                                @endif
                                            @endforeach
                                        @endforeach                                                                                                  
                                      </ul>
                                  </div>
                                  
                                  <!--<div class="product_list_outer">
                                      <h3><span>New </span> Arrivals</h3>
                                      
                                      
                                      <ul>
                                        @foreach($categories as $key => $value)  
                                            @foreach($product_new as $key2 => $product) 
                                                <li>
                                                    <div class="col-md-3"><a href="{{ url('product-details/'.$product->id) }}"><img src="{{ asset('storage/uploads/products/'. $product->photo) }}"></a></div>
                                                    <div class="col-md-4"><h2>{{$product->product_title}}</h2>({{ $product->views+100 }} views)</div>
                                                     <div class="col-md-3"><span class="price-product"> RS {{$product->price-($product->price*$product->discount)/100}} </span> <span class="price-before-discount">RS {{$product->price}}</span></div>
                                                      <div class="col-md-2"><a href="{{ url('product-details/'.$product->id) }}" class="product_link">View Details</a></div>
                                                    
                                                </li>
                                            @endforeach 
                                        @endforeach                                          
                                      </ul>
                                  </div>-->
                                  
                                  
                                  <div class="product_list_outer">
                                  <h3><span>New </span> Arrivals</h3>
                                      <div class="owl-carousel owl-theme">
                                        @foreach($categories as $key => $value)  
                                            @foreach($product_new as $key2 => $product) 
                                                <div class="item">
                                                     <a href="{{ url($product->url) }}"><img src="{{ asset('storage/uploads/products/'. $product->photo) }}"></a>
                                                        <h2>{{$product->product_title}} </h2>
                                                    </a>
                                                </div>
                                            @endforeach 
                                        @endforeach                                                                   
                                      </div>  
                                  </div>                        
                              </div>