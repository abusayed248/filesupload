@extends('layouts.app')

@section('title', 'Download Links')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif


        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    You will be charged ${{ $userPlan->monthly_fee}} for Plan
                </div>

                <div class="card-body">
                    @auth
                    <form id="payment-form" action="{{ route('subscription.create') }}" method="POST">
                        @csrf
                        <input type="hidden" name="plan" id="plan" value="{{ $userPlan->stripe_price_id}}"> <!-- Replace with your price ID -->

                        <div class="form-group">
                            <label for="card-holder-name">Name on Card</label>
                            <input type="text" name="name" id="card-holder-name" class="form-control" placeholder="Name on the card" required>
                        </div>

                        <div class="form-group">
                            <label for="card-element">Card Details</label>
                            <div id="card-element"></div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3" id="card-button" data-secret="{{ auth()->user()->createSetupIntent()->client_secret }}">
                            Purchase
                        </button>
                    </form>
                    @else
                    <!-- Prompt the user to log in -->
                    <div class="text-center">
                        <p>You need to log in to purchase a subscription.</p>
                        <a href="{{ route('login') }}" class="btn btn-primary">Log In</a>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const stripe = Stripe('{{ env('STRIPE_KEY') }}');
            


        const elements = stripe.elements();
        const cardElement = elements.create('card', {
            hidePostalCode: true,
        });
        cardElement.mount('#card-element');

        $('#payment-form').on('submit', async function(e) {
            e.preventDefault();

            const cardButton = $('#card-button');
            const cardHolderName = $('#card-holder-name');
            const clientSecret = cardButton.data('secret');

            cardButton.prop('disabled', true);

            const {
                setupIntent,
                error
            } = await stripe.confirmCardSetup(
                clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: cardHolderName.val(),
                        },
                    },
                }
            );

            if (error) {
                alert('Payment failed: ' + error.message);
                cardButton.prop('disabled', false);
            } else {
                // Add setupIntent.payment_method as a hidden input and submit the form
                $('<input>').attr({
                    type: 'hidden',
                    name: 'token',
                    value: setupIntent.payment_method
                }).appendTo('#payment-form');

                $('#payment-form').off('submit').submit();
            }
        });
    });
</script>
@endsection