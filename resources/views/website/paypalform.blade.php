<form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="paypalForm">

  <input type="hidden" name="cmd" value="_xclick">
  <input type="hidden" name="business" value="sales@1marketresearch.com">
  <input type="hidden" name="item_name" value="{{$cart_detail->name}}">
  <input type="hidden" name="item_number" value="{{$ref}}">
  <input type="hidden" name="amount" value="{{$amount_pay}}"> 
  <input type="hidden" name="quantity" value="1">
  <input type="hidden" name="currency_code" value="USD">

  <!-- Enable override of buyers's address stored with PayPal . -->
<!--   <input type="hidden" name="address_override" value="1"> -->
  <!-- Set variables that override the address stored with PayPal. -->
<!--   <input type="hidden" name="first_name" value="{{$order->first_name}}">
  <input type="hidden" name="last_name" value="{{$order->last_name}}">
  <input type="hidden" name="address1" value="{{$order->address}}">
  <input type="hidden" name="city" value="{{$order->city}}">
  <input type="hidden" name="state" value="{{$order->state}}">
  <input type="hidden" name="zip" value="{{$order->zipcode}}"> -->
  <input type="hidden" name="country" value="{{$order->country}}">
  <input type="hidden" name="email" value="{{$order->email}}">

    <!-- Specify URLs -->
  <input type='hidden' name='cancel_return' value="{{url('paypalpay?cancel_return=1')}}">
  <input type='hidden' name='return' value="{{url('paypalpay?return=1')}}">
  <input type='hidden' name='notify_url' value="{{url('paypalpay?notify_url=1')}}">
</form>