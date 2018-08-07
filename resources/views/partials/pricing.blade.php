<div class="press-release">
            <h4>Price</h4>
        </div>
        <form action="{{url('payment')}}">
        <div class="plan-pricing">
            <input type="hidden" name="payment_id" value="{{$data->id}}">
            <p><input type="radio" name="price" value="{{$data->signle_user_license}}"> <span>Single User License : US $ {{$data->signle_user_license}}      </span></p>
            <p><input type="radio" name="price" value="{{$data->multi_user_license}}"> <span>Multi User License : US $ {{$data->multi_user_license}}       </span></p>
            <p><input type="radio" name="price" value="{{$data->corporate_user_license}}"> <span>Corporate User License : US $ {{$data->corporate_user_license}} </span></p>
            <button type="submit" class="btn btn-danger">
                <span class=" glyphicon glyphicon-shopping-cart">
                </span> Buy Now!
            </button>
        </div>
        </form>