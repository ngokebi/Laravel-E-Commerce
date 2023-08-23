@extends('layouts.app')

@section('content')
@section('title')
    Checkout
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class='active'>Checkout</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="checkout-box ">
            <div class="row">
                <form class="register-form" role="form" action="{{ route('checkout.store') }}" method="post">
                    @csrf
                    <div class="col-md-8">
                        <div class="panel-group checkout-steps" id="accordion">
                            <!-- checkout-step-01  -->
                            <div class="panel panel-default checkout-step-01">

                                <div id="collapseOne" class="panel-collapse collapse in">

                                    <!-- panel-body  -->
                                    <div class="panel-body">
                                        <div class="row">

                                            <!-- guest-login -->
                                            <div class="col-md-6 col-sm-6 already-registered-login">
                                                <h4 class="checkout-subtitle">Personal Details</h4>
                                                <p class="text title-tag-line">Please fill form below:</p>

                                                <div class="form-group">
                                                    <label class="info-title"
                                                        for="exampleInputEmail1">Name<span>*</span></label>
                                                    <input type="text"
                                                        class="form-control unicase-form-control text-input"
                                                        name="name" value="{{ Auth::user()->name }}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title" for="email">Email<span>*</span></label>
                                                    <input type="email"
                                                        class="form-control unicase-form-control text-input"
                                                        name="email" value="{{ Auth::user()->email }}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title" for="phone">Contact
                                                        Number<span>*</span></label>
                                                    <input type="text"
                                                        class="form-control unicase-form-control text-input"
                                                        name="phone" placeholder="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title"
                                                        for="address">Address<span>*</span></label>
                                                    <input type="text"
                                                        class="form-control unicase-form-control text-input"
                                                        name="address" placeholder="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title" for="post_code">Zip/Postal
                                                        Code<span>*</span></label>
                                                    <input type="text"
                                                        class="form-control unicase-form-control text-input"
                                                        name="post_code" placeholder="">
                                                </div>
                                            </div>
                                            <!-- guest-login -->

                                            <!-- already-registered-login -->
                                            <div class="col-md-6 col-sm-6 already-registered-login">
                                                <h4 class="checkout-subtitle">Shipping Address</h4>
                                                <p class="text title-tag-line">Enter your destination to get shipping
                                                </p>
                                                <div class="form-group">
                                                    <label class="info-title"
                                                        for="exampleInputEmail1">Country<span>*</span></label>
                                                    <select class="form-control unicase-form-control"
                                                        name="division_id">
                                                        <option>Select options</option>
                                                        @foreach ($division as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->division_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title"
                                                        for="exampleInputEmail1">State<span>*</span></label>
                                                    <select class="form-control unicase-form-control" name="state_id">
                                                        <option value="" selected="" disabled="">Select
                                                            options
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title"
                                                        for="exampleInputEmail1">Area<span>*</span></label>
                                                    <select class="form-control unicase-form-control" name="area_id">
                                                        <option value="" selected="" disabled="">Select
                                                            options
                                                        </option>

                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title"
                                                        for="exampleInputEmail1">Note<span>*</span></label>
                                                    <textarea class="form-control" name="notes" id="" cols="10" rows="4"></textarea>
                                                </div>
                                            </div>
                                            <!-- already-registered-login -->

                                        </div>
                                    </div>
                                    <!-- panel-body  -->

                                </div><!-- row -->
                            </div>
                            <!-- checkout-step-01  -->


                        </div><!-- /.checkout-steps -->
                    </div>
                    <div class="col-md-4">
                        <!-- checkout-progress-sidebar -->
                        <div class="checkout-progress-sidebar ">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="unicase-checkout-title">Your Checkout Items</h4>
                                    </div>
                                    <div class="">
                                        <ul class="nav nav-checkout-progress list-unstyled">
                                            @foreach ($carts as $item)
                                                <li><strong>Image:</strong>
                                                    <img src="{{ asset($item->options->image) }}" height="100px"
                                                        weight="100px" style="margin-bottom: 7px;">
                                                </li>
                                                <li>
                                                    <strong>Quantity:</strong>
                                                    ({{ $item->qty }})
                                                    || &nbsp;
                                                    <strong>Color:</strong>
                                                    {{ $item->options->color }} || &nbsp;
                                                    <strong>Size:</strong>
                                                    {{ $item->options->size }} &nbsp;
                                                </li><br>
                                            @endforeach
                                            <div style="float: right">
                                                @if (Session::has('coupon'))
                                                    <li><strong>SubTotal:</strong>&nbsp; ${{ $cartTotal }}</li>
                                                    <li><strong>Coupon Name:</strong>&nbsp;
                                                        {{ session()->get('coupon')['coupon_name'] }}
                                                        ({{ session()->get('coupon')['discount'] }}%)</li>
                                                    <li><strong>Coupon Discount:</strong>&nbsp;
                                                        ${{ session()->get('coupon')['discount_amount'] }}</li>
                                                    <li><strong>GrandTotal:</strong>&nbsp;
                                                        ${{ session()->get('coupon')['total_amount'] }}</li>
                                                @else
                                                    <li><strong>SubTotal:</strong>&nbsp; ${{ $cartTotal }}</li>
                                                    <li><strong>GrandTotal:</strong>&nbsp; ${{ $cartTotal }}</li>
                                                @endif

                                            </div>



                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- checkout-progress-sidebar -->
                    </div>
                    <div class="col-md-4">
                        <!-- checkout-progress-sidebar -->
                        <div class="checkout-progress-sidebar ">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="unicase-checkout-title">Select Payment Method</h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="">Paypal</label>
                                            <input type="radio" name="payment_method" id=""
                                                value="flaterwave">
                                            <img src="{{ asset('frontend/assets/images/payments/PayPal.png') }}"
                                                alt="" length='50px' width="70px">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">Card</label>
                                            <input type="radio" name="payment_method" id=""
                                                value="card">
                                            <img src="{{ asset('frontend/assets/images/payments/visacard.png') }}"
                                                alt="" length='40px' width="60px">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">PayStack</label>
                                            <input type="radio" name="payment_method" id=""
                                                value="paystack">
                                            <img src="{{ asset('frontend/assets/images/payments/paystack.png') }}"
                                                alt="" length='50px' width="90px">
                                        </div>
                                    </div>
                                    <hr>
                                    <button type="submit"
                                        class="btn-upper btn btn-primary checkout-page-button">CHECKOUT</button>
                                </div>
                            </div>
                        </div>
                        <!-- checkout-progress-sidebar -->
                </form>
            </div>
        </div><!-- /.row -->
    </div><!-- /.checkout-box -->
</div><!-- /.container -->
</div><!-- /.body-content -->

<script type="text/javascript">
    $(document).ready(function() {

        $('select[name="division_id"]').on('change', function() {
            var division_id = $(this).val();
            if (division_id) {
                $.ajax({
                    url: "{{ url('/shipping/state/ajax') }}/" + division_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="area_id"]').html('');
                        var d = $('select[name="state_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="state_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .state_name + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });

        $('select[name="state_id"]').on('change', function() {
            var state_id = $(this).val();
            if (state_id) {
                $.ajax({
                    url: "{{ url('/shipping/area/ajax') }}/" + state_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var d = $('select[name="area_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="area_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .area_name + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });

    });
</script>

@endsection
