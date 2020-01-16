@extends('layouts.app')

<script src="https://js.braintreegateway.com/web/dropin/1.21.0/js/dropin.min.js"></script>

  @section('content')
    <img id="landing-cover-img" src="../storage/images/protein_powder2.jpg" alt="Protein powder landing page">

    <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
      <h1 class="display-4 font-weight-normal">Get Ahead</h1>
      <strong class="lead font-weight-normal">Get ahead of the competition with Nuzest's finest protein powder to date. Take this for a couple of months and you'll make The Hulk look small!</strong>
     
      <br><br>

      <h5 id="total-price">£{{ Cart::total() }}</h5>

      {{-- <form action="{{ route('cart.store') }}" method="POST"> --}}
        @csrf 
        <button>+</button>
      </form>

      <form action="{{ route('cart.decreaseProductQuantity') }}" method="POST">
        @csrf 
        <button>-</button>
      </form>

      <a href="{{ route('checkout') }}" style="color: #fff; background-color: royalblue" class="btn"><b>Order now</b></a>
    </div>

    <div id="dropin-container"></div>

    <button id="submit-button">Request payment method</button>

    <script>
      var button = document.querySelector('#submit-button');

      braintree.dropin.create({
        authorization: 'CLIENT_TOKEN_FROM_SERVER',
        container: '#dropin-container'
      }, function (createErr, instance) {
        button.addEventListener('click', function () {
          instance.requestPaymentMethod(function (err, payload) {
          // submit payload.nonce to your server
          });
        });
      });
    </script>
  @endsection
