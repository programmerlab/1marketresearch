 

<div class="form-body">
    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button> Please fill the required field! </div>
  <!--   <div class="alert alert-success display-hide">
        <button class="close" data-close="alert"></button> Your form validation is successful! </div>
-->
 
    <div class="form-group {{ $errors->first('coupan_code', ' has-error') }}">
            <label class="control-label col-md-3">Coupon code <span class="required"> * </span></label>
            <div class="col-md-4"> 
                {!! Form::text('coupan_code',null, ['class' => 'form-control','data-required'=>1])  !!} 
                
                <span class="help-block">{{ $errors->first('coupan_code', ':message') }}</span>
            </div>
        </div> 

        


        <div class="form-group {{ $errors->first('start_date', ' has-error') }}  @if(session('field_errors')) {{ 'has-group' }} @endif">
            <label class="col-md-3 control-label">Start Date 
                <span class="required"> * </span>
            </label>
            <div class="col-md-4"> 

                  {!! Form::text('start_date',null, ['id'=>'startdate','class' => 'form-control end_date','data-required'=>1,"size"=>"16","data-date-format"=>"dd/mm/yyyy","data-date-start-date"=>"+0d" ])  !!} 
                
                <span class="help-block">{{ $errors->first('start_date', ':message') }}</span>
            </div> 
        </div>

         <div class="form-group {{ $errors->first('end_date', ' has-error') }}  @if(session('field_errors')) {{ 'has-group' }} @endif">
            <label class="col-md-3 control-label">End Date 
                <span class="required"> * </span>
            </label>
            <div class="col-md-4"> 
                {!! Form::text('end_date',null, ['id'=>'enddate','class' => 'form-control end_date','data-required'=>1,"size"=>"16","data-date-format"=>"dd/mm/yyyy","data-date-start-date"=>"+0d" ])  !!} 


                
                <span class="help-block">{{ $errors->first('end_date', ':message') }}</span>
            </div> 
        </div> 

         <div class="form-group {{ $errors->first('fix_discount', ' has-error') }}">
            <label class="control-label col-md-3">Fix discount  </label>
            <div class="col-md-4"> 
                {!! Form::text('fix_discount',null, ['class' => 'form-control'])  !!} 
                
                <span class="help-block">{{ $errors->first('fix_discount', ':message') }}</span>
            </div>
        </div>

         <div class="form-group {{ $errors->first('percentage_discount', ' has-error') }}">
            <label class="control-label col-md-3">Percentage discount </label>
            <div class="col-md-4">
                {!! Form::text('percentage_discount',null, ['class' => 'form-control'])  !!} 
                
                <span class="help-block">{{ $errors->first('percentage_discount', ':message') }}</span>
            </div>
        </div> 
           
    
    
</div>
<div class="form-actions">
    <div class="row">
        <div class="col-md-offset-3 col-md-9">
          {!! Form::submit(' Save ', ['class'=>'btn  btn-primary text-white','id'=>'saveBtn']) !!}


           <a href="{{route('coupan')}}">
{!! Form::button('Back', ['class'=>'btn btn-warning text-white']) !!} </a>
        </div>
    </div>
</div>




<div class="form-body">





</div> 

