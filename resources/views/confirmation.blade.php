<link rel="stylesheet" type="text/css" href="/css/app.css">

@if(session()->has('paymentSuccessMessage'))
    <h2 class="alert alert-success text-center">{{ session()->get('paymentSuccessMessage') }}</h2>
    <h3 class="text-center"><a href="{{ route('checkout') }}">Return Home</a></h3>
@endif