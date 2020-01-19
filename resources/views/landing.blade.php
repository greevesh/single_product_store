@extends('layouts.app')

<script src="https://js.braintreegateway.com/web/dropin/1.21.0/js/dropin.min.js"></script>

  @section('content')
    <img id="landing-cover-img" src="../storage/images/protein_powder2.jpg" alt="Protein powder landing page">

    <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
      <h1 class="display-4 font-weight-normal">Get Ahead</h1>
      <strong class="lead font-weight-normal">Get ahead of the competition with Nuzest's finest protein powder to date. Take this for a couple of months and you'll make The Hulk look small!</strong>
     
      <br><br>

      <h5 id="total-price"><i>Price: £{{ Cart::total() }}</i></h5>

      <h5><i>Quantity: {{ Cart::count() }}</i></h5>

      <form action="{{ route('cart.store') }}" method="POST">
        @csrf 
        <button style="background-color: mediumblue; color: white;">+</button>
      </form>

      @if(session()->has('quantityIncreasedMessage'))
        <p style="color: green;">{{ session()->get('quantityIncreasedMessage') }}</p>
      @endif 

      <a href="{{ route('checkout') }}" style="color: #fff; background-color: red" class="btn"><b>Order now</b></a>
    </div>

    <div id="dropin-container"></div>
  @endsection
