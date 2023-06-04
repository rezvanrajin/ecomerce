@extends('frontend.master')

@section('content')   
<!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Checkout</h2>
                        <ul>
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li><span>Checkout</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- checkout-area start -->

    <div class="checkout-area ptb-100">
        <div class="container">
            <div class="row">
                     <div class="col-lg-8">
                    <div class="checkout-form form-style">
                        <h3>Billing Details</h3>
                                   <form action="{{Route('Payment')}}" method="post" id="payment-form">
                    @csrf
                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <p>User Name *</p>
                                    <input type="text" name="name" value="{{$auth_user->name}}">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Email Address *</p>
                                    <input type="email" name="email" value="{{$auth_user->email}}">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Division</p>
                                    <select name="$division_id" id="division_id">
                                        <option value="">Select one  </option>
                                        @foreach($divisions as $division)
                                        <option value="{{$division->id}}">{{$division->name}}  </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>District *</p>
                                    <select name="district_id" id="district_id">
                                        
                                    </select>
                                </div>
                                <div class="col-12">
                                    <p>Your Address *</p>
                                    <input type="text" name="address">
                                </div>
                           <div class="col-sm-6 col-12">
                                    <p>Phone No. *</p>
                                    <input type="text" name="phone">
                                </div>
                                <div class="col-12">
                                    <p>Order Notes </p>
                                    <textarea name="note" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="order-area">
                        <h3>Your Order</h3>
                       
                        <ul class="total-cost">
                              @foreach($carts as $cart) 
                        
                           <li>{{$cart->product_name}}<span class="pull-right"><strong>${{$cart->product_price}}</strong></span></li> 
                           @endforeach
                            <li>Subtotal <span class="pull-right"><strong>$20</strong></span></li>
                            <li>Shipping <span class="pull-right">Free</span></li>
                            <li>Total<span class="pull-right">$</span></li>
                                
                        </ul>
                        
                         

              
                        <ul class="payment-method">
                            <li>
                                <input id="bank" type="radio" name="payment" value="stripe">
                                <label for="card-element">Stripe</label>
  <div class="form-row">
      <div id="card-element" style="width: 100%">
      <!-- A Stripe Element will be inserted here. -->
    </div>

    <!-- Used to display Element errors. -->
    <div id="card-errors" role="alert"></div>
  </div>

                            </li>
                            <li>
                                <input id="paypal" type="radio" name="payment" value="paypal">
                                <label for="paypal">Paypal</label>
                            </li>
                            <li>
                                <input id="card" type="radio" name="payment" value="card">
                                <label for="card">Credit Card</label>
                            </li>
                            <li>
                                <input id="delivery" type="radio" name="payment" value="cash">
                                <label for="delivery">Cash on Delivery</label>
                            </li>
                        </ul>

  <button>Place Order</button>
                    </div>
                </div>
                                            </form>

            </div>
        </div>
    </div>
    <!-- checkout-area end -->

    @endsection
    @section('footer_js')
    <script src="http://js.stripe.com/v3/"></script>
    <script type="text/javascript">
        $('#division_id').change(function(){
            var divisionID = $(this).val();

            if(divisionID){
                $.ajax({
                    type:"GET",
                    url:"{{url('api/get-district-list')}}/"+divisionID,
                    success:function(res){
                        if(res){
                            $("#district_id").empty();
                            $("#district_id").append('<option>Select District</option>');
                            $.each(res,function(key,value){
                                $("#district_id").append('<option value="'+value.id+'">'+value.name+'</option>');
                            });

                        }else{
                            $("#district_id").empty();
                        }
                    }
                });
            }else{
                $("#district_id").empty();
                
            }
        });
        
// Set your publishable key: remember to change this to your live publishable key in production
// See your keys here: https://dashboard.stripe.com/apikeys
var stripe = Stripe('pk_test_51LdaLbFV9tP5vJjyz6KWqeo2SgfmAbiFCrxlOyZ8Mb7LL0lsUMRcAPolGvOVLjBUCF08h8velYmLcgbjzubRjZJr005J6uQF2Q');
var elements = stripe.elements();
// Custom styling can be passed to options when creating an Element.
var style = {
  base: {
    // Add your base input styles here. For example:
    fontSize: '16px',
    color: '#32325d',
  },
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');




// Create a token or display an error when the form is submitted.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the customer that there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
        
    </script>
        @endsection