@extends('layouts.master')
    @section('title', 'HOME')
        
        @section('header')
        <h1>Home</h1>
        @stop

        @section('content')  
              <!-- header end -->
        @include('partials.search')
        <!-- End Slider Area -->
        
        <nav class="woocommerce-breadcrumb" itemprop="breadcrumb"><a href="{{url('/')}}">Home</a> &gt;&gt; <a href="#">{{$title or 'Contact'}}</a></nav>
        
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
                    
                    <div class="panel-body">
                        <div class="contact-page">
                            <div class="row">
                                <article id="post-121022" class="post-121022 page type-page status-publish hentry">
    
        <h1></h1>
<table style="width: 100%;" class="table-responsive" border="1" cellspacing="1" cellpadding="15">
<caption>Publishers</caption>
<tbody>
<tr>
<td>&nbsp; QYResearch</td>
<td>&nbsp; WinterGreen Research</td>
</tr>
<tr>
<td>&nbsp; GraceMarketData</td>
<td>&nbsp; S&amp;P Consulting</td>
</tr>
<tr>
<td>&nbsp; 99strategy</td>
<td>&nbsp; Prof-research</td>
</tr>
<tr>
<td>&nbsp; Heyreport</td>
<td>&nbsp; Goldsteinresearch</td>
</tr>
<tr>
<td>&nbsp; DPIresearch</td>
<td>&nbsp; GlobalInfoResearch</td>
</tr>
<tr>
<td>&nbsp; Gen Consulting</td>
<td>&nbsp; Tuoda Research</td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<h3>Become a Publisher</h3>
<p>If you are a specialist publisher of market research, please get in touch with us.<br>
We will need you to first fill a form and register with us for more information.</p>
<p>&nbsp;</p>
<p><a href="{{url('contact')}}"><img src="https://www.1marketresearch.com/wp-content/uploads/2017/10/contact-us-now.png" alt="" width="392" height="130" class="alignleft size-full wp-image-121044" srcset="https://www.1marketresearch.com/wp-content/uploads/2017/10/contact-us-now.png 392w, https://www.1marketresearch.com/wp-content/uploads/2017/10/contact-us-now-300x99.png 300w" sizes="(max-width: 392px) 100vw, 392px"></a></p>
    
</article><!-- #post-## -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>  

     
  

        @stop