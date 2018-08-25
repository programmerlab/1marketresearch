 

<div class="form-body">
    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button> Please fill the required field! </div>
  <!--   <div class="alert alert-success display-hide">
        <button class="close" data-close="alert"></button> Your form validation is successful! </div>
-->

      
            <div class="form-group {{ $errors->first('title', ' has-error') }}">
                <label class="control-label col-md-3">Select Title
                    <span class="required" aria-required="true">  </span>
                </label>
                <div class="col-md-4"> 
                <select name="title" class="form-control">
                   <option value="Mr." {{ (isset($contact->title) && $contact->title=="Mr.")?"selected":'' }}> 
                        Mr. 
                    </option>         
                    <option value="Mrs." {{ (isset($contact->title) && $contact->title=="Mrs.")?"selected":'' }} > 
                        Mrs. 
                    </option>
                     <option value="Miss" {{ (isset($contact->title) && $contact->title=="Miss")?"selected":'' }} > 
                        Miss 
                    </option>
                </select>
                    <span class="help-block"></span>
                </div>
            </div>



    <div class="form-group {{ $errors->first('name', ' has-error') }}">
        <label class="control-label col-md-3">Name <span class="required"> * </span></label>
        <div class="col-md-4"> 
            {!! Form::text('name',null, ['class' => 'form-control','data-required'=>1])  !!} 
            
            <span class="help-block">{{ $errors->first('name', ':message') }}</span>
        </div>
    </div> 

    

     <div class="form-group {{ $errors->first('job_title', ' has-error') }}">
        <label class="control-label col-md-3">Job Title </label>
        <div class="col-md-4"> 
            {!! Form::text('job_title',null, ['class' => 'form-control','data-required'=>1])  !!} 
            
            <span class="help-block">{{ $errors->first('job_title', ':message') }}</span>
        </div>
    </div> 

     <div class="form-group {{ $errors->first('request_type', ' has-error') }}">
        <label class="control-label col-md-3">Request  type </label>
        <div class="col-md-4"> 
            {!! Form::text('request_type',null, ['class' => 'form-control','data-required'=>1])  !!} 
            
            <span class="help-block">{{ $errors->first('request_type', ':message') }}</span>
        </div>
    </div> 

    <div class="form-group {{ $errors->first('phone', ' has-error') }}">
        <label class="control-label col-md-3">Phone </label>
        <div class="col-md-4"> 
            {!! Form::number('phone',null, ['class' => 'form-control','data-required'=>1,'min'=>10]) !!} 
            <span class="help-block">{{ $errors->first('phone', ':message') }}</span>
        </div>
    </div> 

    <div class="form-group {{ $errors->first('country', ' has-error') }}">
        <label class="control-label col-md-3">Country </label>
        <div class="col-md-4"> 
            {!! Form::text('country',null, ['class' => 'form-control','data-required'=>1]) !!} 
            <span class="help-block">{{ $errors->first('country', ':message') }}</span>
        </div>
    </div>


    <div class="form-group {{ $errors->first('email', ' has-error') }}  @if(session('field_errors')) {{ 'has-group' }} @endif">
        <label class="col-md-3 control-label">Email 
            <span class="required"> * </span>
        </label>
        <div class="col-md-4"> 
                
         {!! Form::email('email',null, ['class' => 'form-control','data-required'=>1])  !!} 
        <span class="help-block" style="color:red">{{ $errors->first('email', ':message') }} @if(session('field_errors')) {{ 'The email has already been taken.' }} @endif</span>

        </div> 
    </div> 

<div class="form-group {{ $errors->first('request_description', ' has-error') }}">
    <label class="control-label col-md-3">Description<span class="required"> </span></label>
    <div class="col-md-4"> 
        {!! Form::textarea('request_description',null, ['class' => 'form-control','data-required'=>1,'rows'=>3,'cols'=>5])  !!} 
        
        <span class="help-block">{{ $errors->first('request_description', ':message') }}</span>
    </div>
</div> 
    
    
</div>
<div class="form-actions">
    <div class="row">
        <div class="col-md-offset-3 col-md-9">
          {!! Form::submit(' Save ', ['class'=>'btn  btn-primary text-white','id'=>'saveBtn']) !!}


           <a href="{{route('contact')}}">
{!! Form::button('Back', ['class'=>'btn btn-warning text-white']) !!} </a>
        </div>
    </div>
</div>


<style type="text/css">
    ul.multiselect-container.dropdown-menu li {
    margin-left: 25px !important;
}
</style>