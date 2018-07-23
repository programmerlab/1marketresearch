

            <div class="form-body">
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button> Please fill the required field! </div>
            
            <div class="form-group {{ $errors->first('publisher', ' has-error') }}
            @if(session('field_errors')) {{ 'has-error' }} @endif
            ">
            <label class="control-label col-md-3">Publisher Name <span class="required"> * </span></label>
            <div class="col-md-6"> 
                {!! Form::text('publisher',null, ['class' => 'form-control','data-required'=>1,'required'])  !!} 
                <span class="help-block">{{ $errors->first('publisher', ':message') }}  
            </div>
        </div>  
        

            <div class="form-group {{ $errors->first('company', ' has-error') }}
            @if(session('field_errors')) {{ 'has-error' }} @endif
            ">
            <label class="control-label col-md-3">Company name <span class="required"> * </span></label>
            <div class="col-md-6"> 
                {!! Form::text('company',null, ['class' => 'form-control','data-required'=>1,'required'])  !!} 
                <span class="help-block">{{ $errors->first('company', ':message') }}  
            </div>
        </div>  

         
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-3 col-md-9">
                  {!! Form::submit(' Save ', ['class'=>'btn  btn-primary text-white','id'=>'saveBtn']) !!} 

                   <a href="{{route('publisher')}}">
{!! Form::button('Back', ['class'=>'btn btn-warning text-white']) !!} </a>
                </div>
            </div>
        </div>

 

