

            <div class="form-body">
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button> Please fill the required field! </div>
            
            <div class="form-group {{ $errors->first('title', ' has-error') }}
            @if(session('field_errors')) {{ 'has-error' }} @endif
            ">
            <label class="control-label col-md-3">Press Title <span class="required"> * </span></label>
            <div class="col-md-8"> 
                {!! Form::text('title',null, ['class' => 'form-control','data-required'=>1,'required'])  !!} 
                <span class="help-block">{{ $errors->first('title', ':message') }}  
            </div>
        </div>  
        

        <div class="form-group {{ $errors->first('link', ' has-error') }}
            @if(session('field_errors')) {{ 'has-error' }} @endif
            ">
            <label class="control-label col-md-3">Table of Content link <span class="required"> * </span></label>
            <div class="col-md-8"> 
                {!! Form::text('link',null, ['class' => 'form-control','data-required'=>1,'required'])  !!} 
                <span class="help-block">{{ $errors->first('link', ':message') }}  
            </div>
        </div> 
        <div class="form-group {{ $errors->first('publish_date', ' has-error') }}
            @if(session('field_errors')) {{ 'has-error' }} @endif
            ">
            <label class="control-label col-md-3">Publish date <span class="required"> * </span></label>
            <div class="col-md-8"> 
                {!! Form::text('publish_date',null, ['class' => 'form-control','data-required'=>1,'required','placeholder'=>'Example : 06/19/2018'])  !!} 
                <span class="help-block">{{ $errors->first('publish_date', ':message') }}  
            </div>
        </div> 

        <div class="form-group {{ $errors->first('tag', ' has-error') }}
            @if(session('field_errors')) {{ 'has-error' }} @endif
            ">
            <label class="control-label col-md-3">Tag <span class="required"> * </span></label>
            <div class="col-md-8"> 
                {!! Form::text('tag',null, ['class' => 'form-control','data-required'=>1,'required','placeholder'=>'Example : Growth, Demand'])  !!} 
                <span class="help-block">{{ $errors->first('tag', ':message') }}  
            </div>
        </div> 

        <div class="form-group {{ $errors->first('forecast_year', ' has-error') }}
            @if(session('field_errors')) {{ 'has-error' }} @endif
            ">
            <label class="control-label col-md-3">Forecast Year <span class="required"> * </span></label>
            <div class="col-md-8"> 
                {!! Form::text('forecast_year',null, ['class' => 'form-control','data-required'=>1,'required','placeholder'=>'Example : 2022'])  !!} 
                <span class="help-block">{{ $errors->first('forecast_year', ':message') }}  
            </div>
        </div>

         <div class="form-group {{ $errors->first('description', ' has-error') }}">
            <label class="control-label col-md-3">Description<span class="required"> </span></label>
            <div class="col-md-8"> 
                {!! Form::textarea('description',null, ['class' => 'form-control ckeditor form-cascade-control','data-required'=>1,'rows'=>3,'cols'=>5])  !!}  
                <span class="help-block">{{ $errors->first('description', ':message') }}</span>
            </div>
        </div>

        <div class="form-group {{ $errors->first('table_of_content', ' has-error') }}">
            <label class="control-label col-md-3">Table for content<span class="required"> </span></label>
            <div class="col-md-8"> 
                {!! Form::textarea('table_of_content',null, ['class' => 'form-control ckeditor form-cascade-control','data-required'=>1,'rows'=>3,'cols'=>5])  !!}  
                <span class="help-block">{{ $errors->first('table_of_content', ':message') }}</span>
            </div>
        </div>


         <div class="form-group {{ $errors->first('about_us', ' has-error') }}">
            <label class="control-label col-md-3">About Us<span class="required"> </span></label>
            <div class="col-md-8"> 
                {!! Form::textarea('about_us',null, ['class' => 'form-control ckeditor form-cascade-control','data-required'=>1,'rows'=>3,'cols'=>5])  !!}  
                <span class="help-block">{{ $errors->first('about_us', ':message') }}</span>
            </div>
        </div>

        <div class="form-group {{ $errors->first('contact_us', ' has-error') }}">
            <label class="control-label col-md-3">Contact Us<span class="required"> </span></label>
            <div class="col-md-8"> 
                {!! Form::textarea('contact_us',null, ['class' => 'form-control ckeditor form-cascade-control','data-required'=>1,'rows'=>3,'cols'=>5])  !!}  
                <span class="help-block">{{ $errors->first('contact_us', ':message') }}</span>
            </div>
        </div>
    
            
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-3 col-md-9">
                  {!! Form::submit(' Save ', ['class'=>'btn  btn-primary text-white','id'=>'saveBtn']) !!} 

                   <a href="{{route('press')}}">
{!! Form::button('Back', ['class'=>'btn btn-warning text-white']) !!} </a>
                </div>
            </div>
        </div>

 

