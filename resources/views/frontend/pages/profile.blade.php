@extends('layouts.app')

@section('content')

@section('title')
Fav Store - Profile
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        h4 {
            color: #0f6cb2;
        }

        .invalid-feedback {
            color: #dc3545!important;
        }

    </style>

    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class='active'>Profile Update</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <style>
        a {
            color: black;
        }

        a:hover {
            color: #0f6cb2 !important;
        }

    </style>

    <div class="body-content">
        <div class="container">
            <div class="row">

                @include('frontend.body.profilesiderbar')

                <div class="blog-page">
                    <div class="col-md-5">
                        <div class="blog-post  wow fadeInUp">
                            <h4 class="checkout-subtitle"><strong>Profile Details</strong></h4>
                            <p class="text title-tag-line"> Update all your details with a tap of a button.</p>
                            <form method="POST" class="register-form outer-top-xs" action="{{route('user.profileupdate')}}">
                                @csrf
                                <div class="form-group">
                                    <label class="info-title" for="email">Email Address </label>
                                    <input type="email" name="email" class="form-control unicase-form-control text-input"
                                        id="email" value="{{ $user->email }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="name">Name </label>
                                    <input type="text" name="name" class="form-control unicase-form-control text-input"
                                        id="name" value="{{ $user->name }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="phone">Phone Number </label>
                                    <input type="text" name="phone" class="form-control unicase-form-control text-input"
                                        id="phone" value="{{ $user->phone }}">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn-upper btn btn-primary checkout-page-button"> Update Profile
                                    </button>
                            </form>
                        </div>
                    </div><!-- /.filters-container -->
                </div>

                <div class="blog-page">
                    <div class="col-md-4">
                        <div class="blog-post  wow fadeInUp">
                            <h4 class="checkout-subtitle"><strong>Password Update</strong></h4>
                            <p class="text title-tag-line">Dont like your current password?.</p>
                            <form method="POST" class="register-form outer-top-xs" action="{{route('user.password')}}">
                                @csrf
                                <div class="form-group">
                                    <label class="info-title" for="current_password">Current Password</label>
                                    <input type="password" name="current_password"
                                        class="form-control unicase-form-control text-input" id="current_password">
                                    @error('current_password')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="password"> New Password</label>
                                    <input type="password" name="password"
                                        class="form-control unicase-form-control text-input" id="password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="password_confirmation">Confirm Password
                                    </label>
                                    <input type="password" name="password_confirmation"
                                        class="form-control unicase-form-control text-input" id="password_confirmation">
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Update password
                                    </button>
                            </form>
                        </div>
                    </div><!-- /.filters-container -->
                </div>

                <div class="blog-page">
                    <div class="col-md-5">
                        <div class="blog-post  wow fadeInUp">
                            <h4 class="checkout-subtitle"><strong>Profile Image</strong></h4>
                            <p class="text title-tag-line"> Want to try out a New Picture.</p>
                            <form method="POST" class="register-form outer-top-xs" action="{{route('user.picture')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <img src="{{ !empty($user->profile_photo_path) ? url('upload/user_images/' . $user->profile_photo_path) : url('upload/admin.png') }}"
                                        style="width: 40%; height:40%;" id="showImage">
                                </div>
                                <div class="mb-3" style="margin-top: 3%">
                                    <label for="profile_photo_path" class="form-label">Profile image:</label>
                                    <input type="file" name="profile_photo_path" class="form-control"
                                        id="profile_photo_path">
                                    @error('profile_photo_path')
                                        <span class="invalid-feedback" role="alert"> {{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn-upper btn btn-primary checkout-page-button" style="margin-top: 3%">Update Profile Image
                                    </button>
                            </form>
                        </div>
                    </div><!-- /.filters-container -->
                </div>

            </div>
        </div>

    </div>
    <script type="text/javascript">
        $(document).ready(function(e) {
            $('#profile_photo_path').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
