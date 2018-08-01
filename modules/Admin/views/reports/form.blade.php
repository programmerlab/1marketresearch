<style type="text/css">
 li.multiselect-all,li.multiselect-item {
    margin-left: 25px;
  }
  ul.multiselect-container > li{
     margin-left: 25px;
  }
</style> 

<div class="form-body">
    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button> Please fill the required field! </div>
  <!--   <div class="alert alert-success display-hide">
        <button class="close" data-close="alert"></button> Your form validation is successful! </div>
-->
 
        <div class="form-group {{ $errors->first('title', ' has-error') }}">
            <label class="control-label col-md-3">Report Title <span class="required"> * </span></label>
            <div class="col-md-6"> 
                {!! Form::text('title',null, ['class' => 'form-control','data-required'=>1])  !!} 
                
                <span class="help-block">{{ $errors->first('title', ':message') }}</span>
            </div>
        </div>  

       <div class="form-group {{ $errors->first('category', ' has-error') }}">
        <label class="control-label col-md-3">Research Category
            <span class="required">  </span>
        </label>
        <div class="col-md-6"> 
        <div class="portlet-body">
             <select class="form-control" name="category" >   
                <option>Select Category</option>
                @foreach($categories as $key=>$value)
                <option value="{{$value->id}}" @if(isset($category_id) && (in_array($value->id,$category_id))) {{ 'selected="selected"'}}  @endif

                @if($value->id==old('category'))  {{ 'selected="selected"'}} @endif
                  >

                {{ $value->category_name }}
                
                </option>
                @endforeach
            </select>
            </div>
            <span class="help-block">{{ $errors->first('category', ':message') }}</span>
        </div>
    </div> 
 
      <div class="form-group{{ $errors->first('description', ' has-error') }}">
        <label class="control-label col-md-3">Description</label>
        <div class="col-md-8"> 
            {!! Form::textarea('description',null, ['class' => 'form-control ckeditor form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('description', ':message') }}</span>
            @if(Session::has('flash_alert_notice')) 
            <span class="label label-danger">
                {{ Session::get('flash_alert_notice') }} 
            </span>@endif
        </div>
      </div> 


        <div class="form-group{{ $errors->first('table_of_contents', ' has-error') }}">
            <label class="control-label col-md-3">Table of contents</label>
            <div class="col-md-8"> 
                {!! Form::textarea('table_of_contents',null, ['class' => 'form-control ckeditor form-cascade-control input-small'])  !!}
                <span class="label label-danger">{{ $errors->first('table_of_contents', ':message') }}</span>
                @if(Session::has('flash_alert_notice')) 
                <span class="label label-danger">
                    {{ Session::get('flash_alert_notice') }} 
                </span>@endif
            </div>
        </div>


         <div class="form-group {{ $errors->first('number_of_pages', 'has-error') }}">
            <label class="control-label col-md-3">Number of pages  </label>
            <div class="col-md-6"> 
                {!! Form::number('number_of_pages',null, ['class' => 'form-control','min'=>1])  !!} 
                
                <span class="help-block">{{ $errors->first('number_of_pages', ':message') }}</span>
            </div>
        </div> 


        <div class="form-group {{ $errors->first('report_id', 'has-error') }}">
            <label class="control-label col-md-3">Report Id  </label>
            <div class="col-md-6"> 
                {!! Form::number('report_id',$report_id, ['class' => 'form-control','min'=>1])  !!} 
                
                <span class="help-block">{{ $errors->first('report_id', ':message') }}</span>
            </div>
        </div> 

        <div class="form-group {{ $errors->first('publish_date', ' has-error') }}  @if(session('field_errors')) {{ 'has-group' }} @endif">
            <label class="col-md-3 control-label">Publish date 
                <span class="required"> * </span>
            </label>
            <div class="col-md-6"> 

                  {!! Form::text('publish_date',null, ['id'=>'startdate','class' => 'form-control end_date','data-required'=>1,"size"=>"16","data-date-format"=>"dd/mm/yyyy","data-date-start-date"=>"+0d" ])  !!} 
                
                <span class="help-block">{{ $errors->first('publish_date', ':message') }}</span>
            </div> 
        </div>


         <div class="form-group {{ $errors->first('signle_user_license', 'has-error') }}">
            <label class="control-label col-md-3">Signle User License ($) </label>
            <div class="col-md-6"> 
                {!! Form::text('signle_user_license',null, ['class' => 'form-control'])  !!} 
                
                <span class="help-block">{{ $errors->first('signle_user_license', ':message') }}</span>
            </div>
        </div>


         <div class="form-group {{ $errors->first('multi_user_license', 'has-error') }}">
            <label class="control-label col-md-3">Multi User License ($) </label>
            <div class="col-md-6"> 
                {!! Form::text('multi_user_license',null, ['class' => 'form-control'])  !!} 
                
                <span class="help-block">{{ $errors->first('multi_user_license', ':message') }}</span>
            </div>
        </div>


        <div class="form-group {{ $errors->first('corporate_user_license', 'has-error') }}">
            <label class="control-label col-md-3">Corporate User License($)  </label>
            <div class="col-md-6"> 
                {!! Form::text('corporate_user_license',null, ['class' => 'form-control'])  !!} 
                
                <span class="help-block">{{ $errors->first('corporate_user_license', ':message') }}</span>
            </div>
        </div>

        <div class="form-group {{ $errors->first('currency', 'has-error') }}">
            <label class="control-label col-md-3">Currency  </label>
            <div class="col-md-6"> 
                {!! Form::text('currency','$', ['class' => 'form-control'])  !!} 
                
                <span class="help-block">{{ $errors->first('currency', ':message') }}</span>
            </div>
        </div>

        <div class="form-group {{ $errors->first('status', 'has-error') }}">
            <label class="control-label col-md-3">status  </label>
            <div class="col-md-6"> 
                <select name="status" class="form-control">
                  <option value="publish">Publish</option>
                  <option value="unpublish">Unpublish</option>
                </select>
                
                <span class="help-block">{{ $errors->first('status', ':message') }}</span>
            </div>
        </div>  
        <!-- <div class="form-group {{ $errors->first('photo', ' has-error') }}">
            <label class="control-label col-md-3">Images  </label>
            <div class="col-md-6"> 
                  {!! Form::file('photo',null,['class' => 'form-control'])  !!}
             <br>
              @if(isset($reports->photo))
              <img src="{!! Url::to('storage/reports/'.$reports->photo) !!}" width="150px">
              @endif                                   
            <span class="label label-danger">{{ $errors->first('photo', ':message') }}</span>
            @if(Session::has('flash_alert_notice')) 
            <span class="label label-danger">

                {{ Session::get('flash_alert_notice') }} 

            </span>@endif

            </div>
        </div>  --> 

        <div class="form-group {{ $errors->first('meta_title', 'has-error') }}">
            <label class="control-label col-md-3">Meta title  </label>
            <div class="col-md-6"> 
                {!! Form::text('meta_title',null, ['class' => 'form-control'])  !!} 
                
                <span class="help-block">{{ $errors->first('meta_title', ':message') }}</span>
            </div>
        </div>

        <div class="form-group {{ $errors->first('meta_key', 'has-error') }}">
            <label class="control-label col-md-3">Meta key  </label>
            <div class="col-md-6"> 
                {!! Form::text('meta_key',null, ['class' => 'form-control'])  !!} 
                
                <span class="help-block">{{ $errors->first('meta_key', ':message') }}</span>
            </div>
        </div>

        <div class="form-group {{ $errors->first('meta_description', 'has-error') }}">
            <label class="control-label col-md-3">Meta Description  </label>
            <div class="col-md-8"> 
            {!! Form::textarea('meta_description',null, ['class' => 'form-control ckeditor form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{$errors->first('meta_description', ':message') }}</span>
            @if(Session::has('flash_alert_notice')) 
            <span class="label label-danger">
                {{ Session::get('flash_alert_notice') }} 
            </span>@endif
        </div>
        </div>
    
    
</div>
<div class="form-actions">
    <div class="row">
        <div class="col-md-offset-3 col-md-9">
         <!--  {!! Form::button(' Save ', ['class'=>'btn save  btn-primary text-white','id'=>'saveBtn']) !!} -->
          {!! Form::submit('Save', ['class'=>'btn save btn-primary text-white','id'=>'saveBtn']) !!}


           <a href="{{route('reports')}}">
{!! Form::button('Back', ['class'=>'btn btn-warning text-white']) !!} </a>
        </div>
    </div>
</div>

 