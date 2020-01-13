@extends('layouts.app')

  @section('content')
    <img id="landing-cover-img" src="../storage/images/protein_powder2.jpg" alt="Protein powder landing page">

    <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
      <h1 class="display-4 font-weight-normal">Get Ahead</h1>
      <strong class="lead font-weight-normal">Get ahead of the competition with Nuzest's finest protein powder to date. Take this for a couple of months and you'll make The Hulk look small!</strong>
     
      <br><br>

      <h5 id="total-price">£{{ Cart::total() }}</h5>

      <form action="{{ route('cart.store') }}" method="POST">
        @csrf 
        <button>+</button>
      </form>

      <form action="{{ route('cart.decreaseProductQuantity') }}" method="POST">
        @csrf 
        <button>-</button>
      </form>

      <a href="{{ route('checkout') }}" style="color: #fff; background-color: royalblue" class="btn"><b>Order now</b></a>

      <script src="https://www.paypal.com/sdk/js?client-id=AbuLwSBZC2p5XMwhs2m-GijPW-cbmlvYYknzjfPuiM8m9uzwBJxlbBORzGy9nN7CfxvydOZrWN-yTkgz"></script>
    </div>

    <div id="paypal-button-container"></div>

    <script>
      paypal.Buttons({
        createOrder: function(data, actions) {
          // this function sets up the details of the transaction, including the amount and line item details
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: '59.99'
              }
            }]
          });
        },
        onApprove: function(data, actions) {
      // this function captures the funds from the transaction
      return actions.order.capture().then(function(details) {
        // this function shows a transaction success message to your buyer
        alert('Transaction completed by ' + details.payer.name.given_name);
      });
    }
      }).render('#paypal-button-container');
    </script>
  @endsection
