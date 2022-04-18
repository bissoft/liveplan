@extends('layouts.app')
@section('title','Profile - TenBoosts')
@section('css')
@endsection
@section('content')
<section class="login">
    <div class="container">
        <h3 class="text-center mb-0">Checkout</h3>
        <div class="row align-items-center">
            <div class="col-12 col-md-6">
                <img src="{{asset('assets/img/checkout.png')}}" class="w-100">
            </div>
            <div class="col-12 col-md-6">
                <div id="checkOut">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <h4>Payment Details</h4>
                    <form role="form" action="{{ route('stripe.post') }}" method="post" id="payment-form">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6 required">
                                <label for="cardName">Choose A Plan</label>
                                <select class="form-control" name="plan">
                                    @foreach ($plans as $plan)
                                    <option value="{{$plan->id}}" @if(old('plan')==$plan->id) selected @endif>{{$plan->product->name.' ['.($plan->amount/100).' '.strtoupper($plan->currency).' / '.$plan->interval_count.' '.$plan->interval.']'}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6 required">
                                <label for="cardName">Card Holder Name</label>
                                <input type="text" class="form-control" name="name" value="{{old('name')}}" id="cardName" placeholder="Susie Que">
                            </div>
                            <div class="form-group col-md-6 required">
                                <label for="cardNum">Card Number</label>
                                <input type="text" class="form-control card-number" name="number" value="{{old('number')}}" id="cardNum" placeholder="4242 4242 4242 4242">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4 expiration required">
                                <label for="endDate">Expiration Date: Month</label>
                                <select id="endDate" name="exp_month" class="form-control card-expiry-month">
                                    @for ($i = 1; $i < 13; $i++) <option @if($i==old('exp_month')) selected @endif>{{$i}}</option> @endfor
                            </select>
                        </div>
                        <div class="form-group col-md-4 expiration required">
                            <label for="endYear">Year</label>
                            <select id="endYear" name="exp_year" class="form-control card-expiry-year">
                                @for ($i = 2022; $i < 2031; $i++) <option @if($i==old('exp_year')) selected @endif>{{$i}}</option> @endfor
                        </select>
                        </div>

                <div class="form-group col-md-4 cvc required">
                    <label for="cVV">CVV</label>
                    <input type="password" name="cvc" class="form-control card-cvc" id="cVV" value="old('cvv')" placeholder="e.g 123">
                </div>
                </div>
            </div>
            <div class='form-row row'>
                <div class='col-md-12 error form-group d-none'>
                    <div class='alert-danger alert'>Please correct the errors and try
                        again.</div>
                </div>
            </div>
            <div class="text-center">
                <button class="checkout-btn btn btn-success form-control" type="submit" onclick="return submit()">Subscribe</button>
            </div>
            </form>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script>
    function submit(){
        alert(hi);
    }
</script>
@endsection