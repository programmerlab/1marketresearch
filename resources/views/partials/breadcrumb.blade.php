<div class="page_title">
    <div class="page-wrapper">
        <div class="col-md-6"><h1>{{ isset($category)?$category:''}}</h1>   </div>
        <div class="col-md-6 text-right">
                <span><a href="#">Home</a> </span>
                @if(isset($category_name) && !isset($product->category->name))                                
 
                    @else
                {{$product->category->name or ''}}
                @endif                      
                <span> {{ isset($category)?$category:''}} </span>  
           </div>
    </div>
</div>