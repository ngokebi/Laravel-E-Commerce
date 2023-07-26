@extends('layouts.app')


@section('content')

@section('title')
Fav Store - Profile
@endsection

    {{-- <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-2"><br><br>
                    <img src="{{ !empty($admin_data->profile_photo_path) ? url('upload/admin_images/' . $admin_data->profile_photo_path) : url('upload/admin.png') }}"
                        alt="" class="card-img-top" style="border-radius: 50%;" height="100%" width="100%">
                    <ul class="list-group list-group-flush"><br><br>
                        <a href="" class="btn btn-primary btn-sm btn-block">Home</a>
                        <a href="" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                        <a href="" class="btn btn-primary btn-sm btn-block">Change Password</a>
                        <a href="" class="btn btn-primary btn-sm btn-block">Logout</a>
                    </ul>
                </div> <!-- end col md 2 -->
                <div class="col-md-2">

                </div><!-- end col md 2 -->
                <div class="col-md-6">
                    <div class="card">
                        <h3 class="text-center"><span
                                class="text-danger">Hi....</span><strong>{{ Auth::user()->name }}</strong>, Welcome</h3>

                    </div>
                </div><!-- end col md 6 -->
            </div> <!-- end row -->
        </div>
    </div> --}}
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li class='active'>Dashboard</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->
    <style>
        a {
            color: black;
        }

        a:hover {
            color: #0f6cb2!important;
        }

    </style>
    <div class="body-content">
        <div class="container">
            <div class="row">

                @include('frontend.body.profilesiderbar')

                <div class="blog-page">
                    <div class="col-md-9">
                        <div class="blog-post  wow fadeInUp">
                            <a href="blog-details.html"><img class="img-responsive"
                                    src="assets/images/blog-post/blog_big_01.jpg" alt=""></a>
                            <h1><a href="blog-details.html">Nemo enim ipsam voluptatem quia voluptas sit aspernatur</a></h1>
                            <span class="author">John Doe</span>
                            <span class="review">6 Comments</span>
                            <span class="date-time">14/06/2016 10.00AM</span>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                                voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                                cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum...</p>
                        </div>



                    </div><!-- /.filters-container -->
                </div>

            </div>
        </div>

    </div>




@endsection
