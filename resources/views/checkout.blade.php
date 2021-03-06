@extends('layout')

@section('title', 'Checkout')

@section('extra-css')
    <style>
        .mt-32 {
            margin-top: 32px;
        }
        
    </style>

    <script src="https://js.stripe.com/v3/"></script>

@endsection

@section('content')
<div class="py-12 mt-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session()->has('success_message'))
                <div class="text-xl font-bold text-gray-500 my-4 bg-green-300 py-2 px-6">
                    {{ session()->get('success_message') }}
                </div>
            @endif

            @if(count($errors) > 0)
                <div class="text-xl font-bold text-gray-500 my-4 bg-red-300 px-6 py-2">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        <h1 class="text-3xl font-bold uppercase text-center py-6 ">Checkout</h1>
        <div class="checkout-section flex">
            <div class="w-7/12">
                <form action="{{ route('checkout.store') }}" method="POST" id="payment-form">
                    {{ csrf_field() }}

                    <!-- Billing Details -->
                    <h2 class="text-xl font-semibold py-4">Billing Details</h2>
                    <div class="">
                        <div class="form-group">
                            <label class="text-lg my-2 font-medium" for="email">Email Address</label>
                            @if (auth()->user())
                                <input type="email" class="px-4 py-2 border border-gray-300 bg-gray-100 w-full" id="email" name="email" value="{{ auth()->user()->email }}" readonly>
                            @else
                                <input type="email" class="px-4 py-2 border border-gray-300 bg-gray-100 w-full" id="email" name="email" value="{{ old('email') }}" required>
                            @endif
                        </div>
                        <div class="form-group ">
                            <label class="text-lg my-2 font-medium" for="name">Name</label>
                            <input type="text" class="px-4 py-2 border border-gray-300 bg-gray-100 w-full" id="name" name="name" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <label class="text-lg my-2 font-medium" for="address">Address</label>
                            <input type="text" class="px-4 py-2 border border-gray-300 bg-gray-100 w-full" id="address" name="address" value="{{ old('address') }}" required>
                        </div>
                        <div class="flex ">
                            <div class="w-1/2 mr-4">
                                <label class="text-lg my-2 font-medium" for="city">City</label>
                                <input type="text" class="px-4 py-2 border border-gray-300 bg-gray-100 w-full" id="city" name="city" value="{{ old('city') }}" required>
                            </div>
                            <div class="w-1/2 ml-4">
                                <label class="text-lg my-2 font-medium" for="province">Province</label>
                                <input type="text" class="px-4 py-2 border border-gray-300 bg-gray-100 w-full" id="province" name="province" value="{{ old('province') }}" required>
                            </div>
                        </div> 

                        <div class="flex ">
                            <div class="w-1/2 mr-4">
                                <label class="text-lg my-2 font-medium" for="postalcode">Postal Code</label>
                                <input type="text" class="px-4 py-2 border border-gray-300 bg-gray-100 w-full" id="postalcode" name="postalcode" value="{{ old('postalcode') }}" required>
                            </div>
                            <div class="w-1/2 ml-4">
                                <label class="text-lg my-2 font-medium" for="phone">Phone</label>
                                <input type="text" class="px-4 py-2 border border-gray-300 bg-gray-100 w-full" id="phone" name="phone" value="{{ old('phone') }}" required>
                            </div>
                        </div>
                    </div>
                    <!-- Billing Details End -->

                    <!-- Shipping address  -->
                    <h2 class="text-xl font-semibold py-4">Shipping Address</h2>
                    <div class="">
                            <div class="form-group">
                                <label class="text-lg my-2 font-medium" for="email">Email Address</label>
                                <input type="email" class="px-4 py-2 border border-gray-300 bg-gray-100 w-full"  >
                            </div>
                            <div class="form-group ">
                                <label class="text-lg my-2 font-medium" for="name">Name</label>
                                <input type="text" class="px-4 py-2 border border-gray-300 bg-gray-100 w-full" >
                            </div>
                            <div class="form-group">
                                <label class="text-lg my-2 font-medium" for="address">Address</label>
                                <input type="text" class="px-4 py-2 border border-gray-300 bg-gray-100 w-full">
                            </div>

                            <div class="flex ">
                                <div class="w-1/2 mr-4">
                                    <label class="text-lg my-2 font-medium" for="city">City</label>
                                    <input type="text" class="px-4 py-2 border border-gray-300 bg-gray-100 w-full"  >
                                </div>
                                <div class="w-1/2 ml-4">
                                    <label class="text-lg my-2 font-medium" for="province">Province</label>
                                    <input type="text" class="px-4 py-2 border border-gray-300 bg-gray-100 w-full">
                                </div>
                            </div> 

                            <div class="flex ">
                                <div class="w-1/2 mr-4">
                                    <label class="text-lg my-2 font-medium" for="postalcode">Postal Code</label>
                                    <input type="text" class="px-4 py-2 border border-gray-300 bg-gray-100 w-full"  >
                                </div>
                                <div class="w-1/2 ml-4">
                                    <label class="text-lg my-2 font-medium" for="phone">Phone</label>
                                    <input type="text" class="px-4 py-2 border border-gray-300 bg-gray-100 w-full">
                                </div>
                            </div> 
                    </div>
                    <!-- Shiping Address End  -->

                    <!-- Stripe Payment -->
                    <h2 class="text-xl font-semibold py-4">Payment Details</h2>
                    <div class="">
                        <div class="form-group">
                            <label class="text-lg my-2 font-medium" for="name_on_card">Name on Card</label>
                            <input type="text" class="px-4 py-2 border border-gray-300 bg-gray-100 w-full" id="name_on_card" name="name_on_card" value="">
                        </div>

                        <div class="form-group">
                            <label  class="text-lg my-2 font-medium" for="card-element">
                            Credit or debit card
                            </label>
                            <div id="card-element">
                            <!-- a Stripe Element will be inserted here. -->
                            </div>

                            <!-- Used to display form errors -->
                            <div id="card-errors" role="alert"></div>
                        </div>
                    </div>
                    <!-- Stripe Payment End -->
                    <button id="complete-order" type="submit" class="complete-order mt-5 px-4 py-2 border-2 border-gray-500 bg-gray-100 hover:bg-black hover:text-white hover:font-bold hover:border-black ">Complete Order</button>
                </form>

                @if ($paypalToken)
                    <div class="mt-32">or</div>
                    <div class="mt-32">
                        <h2>Pay with PayPal</h2>

                        <form method="post" id="paypal-payment-form" action="{{ route('checkout.paypal') }}">
                            @csrf
                            <section>
                                <div class="bt-drop-in-wrapper">
                                    <div id="bt-dropin"></div>
                                </div>
                            </section>

                            <input id="nonce" name="payment_method_nonce" type="hidden" />
                            <button class="button-primary" type="submit"><span>Pay with PayPal</span></button>
                        </form>
                    </div>
                @endif
            </div>
            <div class="w-1/12"></div>
                <div class="checkout-table-container w-4/12 ml-">
                    <h2 class="text-3xl font-bold pb-6 ">Your Order</h2>

                    <div class="checkout-table mt-4 border-b-2 border-t-2 py-5 border-gray-500">
                        @foreach (Cart::content() as $item)
                            <table class="text-left w-full">
                                <tbody class="bg-grey-100 flex flex-col font-bold" >
                                    <tr class="flex w-full divide-x-2 divide-gray-400 border-2 border-gray-400">
                                        <td class="p-3 w-1/5">
                                            <a href="{{ route('shop.show', $item->model->slug) }}"><img class="w-16 h-16" src="{{ asset('/storage/'.$item->model->image) }}" alt="product" ></a>
                                        </td>
                                        <td class="p-3 w-3/5 ">
                                            <div class="checkout-item-details">
                                                <div class="checkout-table-item">{{ $item->model->name }}</div>
                                                <div class="checkout-table-description">{{ $item->model->details }}</div>
                                                <div class="checkout-table-price">{{ $item->model->presentPrice() }}</div>
                                            </div>
                                        </td>
                                        <td class="p-3 w-1/5 ">
                                            <div class="flex justify-center items-center">{{ $item->qty }}</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        @endforeach

                    </div> <!-- end checkout-table -->

                    <div class="checkout-totals flex justify-between  border-gray-500 pb-5 mt-5">       
                        <table class="text-left w-full">
                            <tbody class="bg-grey-100 flex flex-col font-bold" >
                                <tr class="flex w-full divide-x-2 divide-gray-400 border-2 border-gray-400">
                                    <td class="p-3 w-1/2">Subtotal</td>
                                    <td class="p-3 w-1/2 ">{{ presentPrice(Cart::subtotal()) }}</td>
                                </tr>
                                @if (session()->has('coupon'))
                                <tr class="flex w-full divide-x-2 divide-gray-400 border-l-2 border-r-2 border-b-2 border-gray-400">
                                    <td class="p-3 w-1/2 ">Discount ( {{ session()->get('coupon')['name'] }} ) :
                                        <form action="{{ route('coupon.destroy') }}" method="POST" class="inline-flex">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <button type="submit" style="font-size:14px;">Remove</button>
                                        </form>
                                    </td>
                                    <td class="p-3 w-1/2 ">-{{ presentPrice($discount) }}</td>
                                </tr>
                                <tr class="flex w-full divide-x-2 divide-gray-400 border-l-2 border-r-2 border-b-2 border-gray-400">
                                    <td class="p-3 w-1/2 ">New Subtotal</td>
                                    <td class="p-3 w-1/2 ">{{ presentPrice($newSubtotal) }}</td>
                                </tr>
                                @endif
                                <tr class="flex w-full divide-x-2 divide-gray-400 border-l-2 border-r-2 border-gray-400">
                                    <td class="p-3 w-1/2 ">Tax ({{config('cart.tax')}}%)</td>
                                    <td class="p-3 w-1/2 ">{{ presentPrice($newTax) }}</td>
                                </tr>
                                <tr class="flex w-full divide-x-2 divide-gray-400 border-2 border-gray-400">
                                    <td class="p-3 w-1/2 ">Total</td>
                                    <td class="p-3 w-1/2 ">{{ presentPrice($newTotal) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div> <!-- end checkout-totals -->

                
                </div>
            </div> <!-- end checkout-section -->
        </div>
    </div>
</div>
@endsection

@section('extra-js')
    <script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>

    <script>
        (function(){
            // Create a Stripe client 
            // {{ config('services.stripe.key') }}
            var stripe = Stripe('pk_test_51I5nWLLK5WcONVkpJg5pXezj0AwCEKMkksXTDGnzAzdjPCXkUuBdqnhT7cyCLonWUB6Y8cMHYRvQpgakPxWaClgD00nZG1kDTS');

            // Create an instance of Elements
            var elements = stripe.elements();

            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
              base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Roboto", Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                  color: '#aab7c4'
                }
              },
              invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
              }
            };

            // Create an instance of the card Element
            var card = elements.create('card', {
                style: style,
                hidePostalCode: true
            });

            // Add an instance of the card Element into the `card-element` <div>
            card.mount('#card-element');

            // Handle real-time validation errors from the card Element.
            card.addEventListener('change', function(event) {
              var displayError = document.getElementById('card-errors');
              if (event.error) {
                displayError.textContent = event.error.message;
              } else {
                displayError.textContent = '';
              }
            });

            // Handle form submission
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
              event.preventDefault();

              // Disable the submit button to prevent repeated clicks
              document.getElementById('complete-order').disabled = true;

              var options = {
                name: document.getElementById('name_on_card').value,
                address_line1: document.getElementById('address').value,
                address_city: document.getElementById('city').value,
                address_state: document.getElementById('province').value,
                address_zip: document.getElementById('postalcode').value
              }

              stripe.createToken(card, options).then(function(result) {
                if (result.error) {
                  // Inform the user if there was an error
                  var errorElement = document.getElementById('card-errors');
                  errorElement.textContent = result.error.message;

                  // Enable the submit button
                  document.getElementById('complete-order').disabled = false;
                } else {
                  // Send the token to your server
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

            // PayPal Stuff
            var form = document.querySelector('#paypal-payment-form');
           

            braintree.dropin.create({
              authorization: client_token,
              selector: '#bt-dropin',
              paypal: {
                flow: 'vault'
              }
            }, function (createErr, instance) {
              if (createErr) {
                console.log('Create Error', createErr);
                return;
              }

              // remove credit card option
              var elem = document.querySelector('.braintree-option__card');
              elem.parentNode.removeChild(elem);

              form.addEventListener('submit', function (event) {
                event.preventDefault();

                instance.requestPaymentMethod(function (err, payload) {
                  if (err) {
                    console.log('Request Payment Method Error', err);
                    return;
                  }

                  // Add the nonce to the form and submit
                  document.querySelector('#nonce').value = payload.nonce;
                  form.submit();
                });
              });
            });

        })();
    </script>
@endsection
