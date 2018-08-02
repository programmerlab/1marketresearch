
@extends('layouts.master')
    @section('title', 'HOME')
        
        @section('header')
        <h1>Home</h1>
        @stop

        @section('content') 

            @include('partials.breadcrumb')
            
   <div class="container">
        <div class="checkout-box ">
            <div class="row">

                <div class="col-md-12 col-md-offset-2">
                    <div class="col-md-8 col-sm-8 already-registered-login">
                        

                            @if($errors->has())
                            <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                            <p> {{ $error }} </p>
                            @endforeach
                            </div>
                            @endif 
                            <div class="login-box-body">
                              <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}" style="margin: 50px; padding: 20px;">
                                {{ csrf_field() }}

                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                    <div class="col-md-8">
                                        <input id="email" type="email" class="form-control unicase-form-control text-input" name="email" value="{{ old('email') }}">

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}" style="margin: 10px 0px;">
                                    <label for="password" class="col-md-4 control-label">Password</label>

                                    <div class="col-md-8">
                                        <input id="password" type="password" class="form-control unicase-form-control text-input" name="password">

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                

                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-btn fa-sign-in"></i> Login
                                        </button>
                                        <a class="" href="{{ url('myaccount/signup') }}" style="margin-left: 20px">  Signup?</a> Or 
                                        <a class="" href="{{ url('/password/reset') }}" > Forgot Password?</a>  
                                         
                                       
                                    </div>
                                </div>
                            </form>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
        @stop
 
