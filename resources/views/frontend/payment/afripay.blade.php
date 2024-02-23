<!DOCTYPE html>
<html lang="en"> 
<head>
	<title>AfriPay | {{ config('app.name', 'Laravel') }}</title>
</head>
<body>

    @php
        if(Session::has('currency_code')){
            $currency_code = Session::get('currency_code');
        }
        else{
            $currency_code = \App\Currency::findOrFail(\App\BusinessSetting::where('type', 'system_default_currency')->first()->value)->code;
        }
    @endphp

    <!-- process afri pay gateway -->
    <form action="https://afripay.africa/checkout/index.php" method="POST" id="AfripayForm">
        <input type="hidden" name="amount" value="{{ $total }}" >

        <input type="hidden" name="currency" value="{{ $currency_code }}" >

        <input type="hidden" name="comment" value="Order {{ $code }}">

        <input type="hidden" name="client_token" value="BMA-{{ $code }}" >

        <input type="hidden" name="return_url" value="{{ route('order_confirmed') }}" >

        <input type="hidden" name="firstname" value="{{ Session::get('shipping_info')['name'] }}" >

        <input type="hidden" name="lastname" value="" >

        <input type="hidden" name="street" value="{{ Session::get('shipping_info')['city'] }}" >
        <input type="hidden" name="city" value="{{ Session::get('shipping_info')['city'] }}" >

        <input type="hidden" name="state" value="{{ Session::get('shipping_info')['city'] }}" >

        <input type="hidden" name="zip_code" value="{{ Session::get('shipping_info')['postal_code'] }}" >
        <input type="hidden" name="country" value="Rwanda" >

        <input type="hidden" name="email" value="{{ Session::get('shipping_info')['email'] }}" >

        <input type="hidden" name="phone" value="{{ Session::get('shipping_info')['phone'] }}" >

        <input type="hidden" name="app_id" value="3f56a5d7c5a7b6e466b2be9483664cd4">
        <input type="hidden" name="app_secret" value="JDJ5JDEwJGhzRTlY">
    </form>

    <script type="text/javascript">
    	document.getElementById('AfripayForm').submit();
    </script>
</body>
</html>