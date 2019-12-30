@extends('layouts.app')

  @section('content')
    <img id="landing-cover-img" src="../storage/images/protein_powder2.jpg" alt="Protein powder landing page">

    <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
      <h1 class="display-4 font-weight-normal">Get Ahead</h1>
      <strong class="lead font-weight-normal">Get ahead of the competition with Nuzest's finest protein powder to date. Take this for a couple of months and you'll make The Hulk look small!</strong>
     
      <br><br>

      {{-- INCREASE PRODUCT QUANTITY --}}
      <form action="{{ route('cart.store') }}" method="POST">
        @csrf 
        <input name="id" type="hidden" value="{{ $product->id }}"> 
        <input name="name" type="hidden" value="{{ $product->name }}"> 
        <input name="price" type="hidden" value="{{ $product->price }}"> 
        <button class="bg-success text-white" style="width: 2rem;"><strong>+</strong></button>
      </form>
      {{-- END INCREASE PRODUCT QUANTITY --}}

      {{-- DECREASE PRODUCT QUANTITY --}}
      {{-- <form action="{{ route('cart.update') }}" method="POST"> --}}
        @csrf
        @method('UPDATE')
        <button class="bg-danger text-white" style="width: 2rem;"><strong>-</strong></button>
      </form>
      {{-- END DECREASE PRODUCT QUANTITY --}}

      <br><br>

      @if(session()->has('quantityIncreasedMessage'))
         <p style="color: green">{{ session()->get('quantityIncreasedMessage') }}</p>
      @endif 

      <h5>£{{ Cart::total() }}</h5>
      <h5>{{ Cart::count() }} tubs</h5>

      <a class="btn btn-outline-secondary" href="{{ route('checkout.store') }}">Order now</a>
      <script src="https://www.paypal.com/sdk/js?client-id=AbuLwSBZC2p5XMwhs2m-GijPW-cbmlvYYknzjfPuiM8m9uzwBJxlbBORzGy9nN7CfxvydOZrWN-yTkgz"></script>
    </div>

    <div id="paypal-button-container"></div>

    <script>
      paypal.Buttons({
        createOrder: function(data, actions) {
          // This function sets up the details of the transaction, including the amount and line item details.
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: '59.99'
              }
            }]
          });
        },
        onApprove: function(data, actions) {
      // This function captures the funds from the transaction.
      return actions.order.capture().then(function(details) {
        // This function shows a transaction success message to your buyer.
        alert('Transaction completed by ' + details.payer.name.given_name);
      });
    }
      }).render('#paypal-button-container');
    </script>
  @endsection
