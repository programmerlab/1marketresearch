<div class="col-md-3 col-sm-4">
    <div class="product_categories">
        <h3>Categories </h3>
            <ul class="product-categories">
              @foreach($categories as $key => $value)
                <li class="cat-item cat-parent"><a href="#">{{$value['name']}}</a>
                    <ul class="children">                                                      
                          @if(count($value['child'])>0)
                            @foreach($value['child'] as $subCat)
                              <li class="cat-item"><a href="{{url($subCat['slug'])}}">{{$subCat['name']}}</a></li>


                            @endforeach
                          @else                                                        
                          <li class="cat-item"><a href="{{url($value['slug'])}}">{{$value['name']}}</a></li> 
                          @endif                                                                                                            
                   </ul>
                </li>
              @endforeach                                                                                                        
            </ul>            
    </div>
     
    <div class="top_rated_products">
        <h3>High-rated products</h3>
        <ul class="product_list">
          @foreach($hot_products as $result)
              <li>                                             
                  <div class="product_cont">
                    <span class="product-title"><strong>{{ $result->product_title }}</strong> ({{ $result->views+100 }} views)</span><br>
                    <span class="amount">{{ $result->price - ($result->price*$result->discount)/100 }}<span class="woocommerce-Price-currencySymbol"> INR</span></span>
                    <span class="price-before-discount" style="text-decoration: line-through;">INR {{ $result->price }}</span> 
                  </div>
                  <div class="product_img"><a href="{{ url($result->url) }}">  <img src="{{ asset('storage/uploads/products/'. $result->photo) }}"> </a></div>
              </li>
          @endforeach                                              
        </ul>
    </div>
</div>