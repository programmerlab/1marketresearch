<div class="press-release">
            <h4>Price</h4>
        </div>
        <form action="{{url('payment')}}">
        <div class="plan-pricing">
            <input type="hidden" name="payment_id" value="{{$data->id}}">
            <p><input type="radio" name="price" value="{{$data->signle_user_license}}"> <span>
                <b>Single User License </b>: US $ {{$data->signle_user_license}}      </span></p>
            <p><input type="radio" name="price" value="{{$data->multi_user_license}}"> <span>
                <b>Multi User License </b>: US $ {{$data->multi_user_license}}       </span></p>
            <p><input type="radio" name="price" value="{{$data->corporate_user_license}}"> <span>
                <b>Corporate User License </b>: US $ {{$data->corporate_user_license}} </span></p>
            <button type="submit" class="btn btn-danger">
                <span class=" glyphicon glyphicon-shopping-cart">
                </span> <b> Buy Now!</b>
            </button>
        </div>
        </form>