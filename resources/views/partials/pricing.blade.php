<div class="press-release">
            <h4>Price</h4>
</div>
    <form action="{{url('payment')}}">
    <div class="plan-pricing" style="color: #000 !important">
        <input type="hidden" name="payment_id" value="{{$data->id}}">
        <div>
            <input type="radio" name="price" value="{{$data->signle_user_license}}" checked="checked" style="display: block;"> 
            <span>
            <b>Single User License </b>: US $ {{$data->signle_user_license}}      </span>
        </div>
        <div><input type="radio" name="price" value="{{$data->multi_user_license}}" style="display: block;"> <span>
            <b>Multi User License </b>: US $ {{$data->multi_user_license}}       </span>
        </div>
        <div><input type="radio" name="price" value="{{$data->corporate_user_license}}" style="display: block;"> <span>
            <b>Corporate User License </b>: US $ {{$data->corporate_user_license}} </span>
        </div>
        <button type="submit" class="btn btn-danger" style="font-size: 18px">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            </span> <b> Buy Now!</b>
        </button>
    </div>
</form>