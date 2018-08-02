@extends('layouts.master')
    @section('title', 'HOME')
        @section('header')
        <h1>Home</h1>
        @stop
        @section('content') 
            
              @include('partials.breadcrumb')
            <!-- Left side column. contains the logo and sidebar -->
            <div class="">&nbsp;
                <div class="shopping-cart">
                    <div class="shopping-cart-table ">
                        <div class="table-responsive" style="padding-bottom:50px">
                            <h2 class="heading-title">Thank you for placed order!</h2>
                            <span class="title-tag">Your order will shipped soon..!</span>
                        </div>
                    </div>
                </div>
            </div>    
        @stop
