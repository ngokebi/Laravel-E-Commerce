@extends('layouts.app')

@section('content')

    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class='active'>Password Reset</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content">
        <div class="container">
            <div class="sign-in-page">
                <div class="row">
                    <!-- Sign-in -->
                    <div class="col-md-6 col-sm-6 sign-in">
                        <h4 class="">Reset Password</h4>
                    <form method="POST"
                            class="register-form outer-top-xs" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                            <div class="form-group">
                                <label class="info-title" for="email">Email Address <span>*</span></label>
                                <input type="email" name="email" class="form-control unicase-form-control text-input"
                                    id="email">
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="password">Password <span>*</span></label>
                                <input type="password" name="password" class="form-control unicase-form-control text-input"
                                    id="password">
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="password_confirmation">Confirm Password
                                    <span>*</span></label>
                                <input type="password" name="password_confirmation"
                                    class="form-control unicase-form-control text-input" id="password_confirmation">
                            </div>
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Reset
                                Password</button>
                            </form>
                    </div>
                    <!-- Sign-in -->
                </div><!-- /.row -->
            </div><!-- /.sigin-in-->
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            @include('frontend.body.brands')
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
        </div><!-- /.container -->
    </div><!-- /.body-content -->
    <!-- /#top-banner-and-menu -->

@endsection
