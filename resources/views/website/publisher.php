
@extends('layouts.master')
    @section('title', 'HOME')
        
        @section('header')
        <h1>Home</h1>
        @stop

        @section('content')  
          
         @include('partials.search')
        <!-- End Slider Area -->
        
        <nav class="woocommerce-breadcrumb" itemprop="breadcrumb"><a href="#">Home</a> &gt;&gt; <a href="{{url('publisher')}}">Publisher</a></nav>
        
        <div class="published-date">
            <div class="row">
                <div class="date-box">
                  <div class="col-sm-12 border-right"> <span class="pub-date">
                    Publisher
                  </span> </div>
                  
                </div>
            </div>
        </div>
        
        <div class="blog-area area-padding detail-main">
            <div class="container">
                
                <div class="row">
                    <div class="report-left-sec col-sm-12">
                        <div class="row">
    <div class="col-lg-12">
        
<article id="post-121022" class="post-121022 page type-page status-publish hentry">
    
        <h1></h1>
<table style="width: 1000px;" border="1" cellspacing="1" cellpadding="15">
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
<p><a href="https://www.1marketresearch.com/contact-us/"><img src="https://www.1marketresearch.com/wp-content/uploads/2017/10/contact-us-now.png" alt="" width="392" height="130" class="alignleft size-full wp-image-121044" srcset="https://www.1marketresearch.com/wp-content/uploads/2017/10/contact-us-now.png 392w, https://www.1marketresearch.com/wp-content/uploads/2017/10/contact-us-now-300x99.png 300w" sizes="(max-width: 392px) 100vw, 392px"></a></p>
    
</article><!-- #post-## -->
    </div>
  </div>
                    </div>
                    
                    
                </div>
                <!-- End row -->
                
                <!--End row-->
            </div>
        </div>
        @stop