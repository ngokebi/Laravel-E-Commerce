@extends('admin.admin_master')

@section('admin')

    <div class="container-full">


        <!-- Main content -->
        <section class="content">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row">
                <div class="box box-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-black"
                        style="background: url('../images/gallery/full/10.jpg') center center;">
                        <h3 class="widget-user-username">{{ $admin_data->name }}</h3>
                        <a href="{{ route('admin.profile.edit') }}" style="float: right;"
                            class="btn btn-rounded btn-outline btn-dark mb-5">Edit Profile</a>
                        <h6 class="widget-user-desc"><i class="fa fa-envelope"></i> {{ $admin_data->email }}</h6>
                    </div>
                    <div class="widget-user-image">
                        <img class="avatar-xxxl "
                            src="{{ (!empty($admin_data->profile_photo_path)) ?  url('upload/admin_images/' . $admin_data->profile_photo_path) : url('upload/admin.png') }}"
                            alt="User Avatar">
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">12K</h5>
                                    <span class="description-text">FOLLOWERS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 br-1 bl-1">
                                <div class="description-block">
                                    <h5 class="description-header">550</h5>
                                    <span class="description-text">FOLLOWERS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">158</h5>
                                    <span class="description-text">TWEETS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>



                <!-- Profile Image -->
                <div class="box">
                    <div class="box-body box-profile">
                        <div class="row">
                            <div class="col-12">
                                <div>
                                    <p>Email :<span class="text-gray pl-10">{{ $admin_data->email }}</span> </p>
                                    <p>Phone :<span class="text-gray pl-10">+11 123 456 7890</span></p>
                                    <p>Address :<span class="text-gray pl-10">123, Lorem Ipsum, Florida, USA</span></p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="pb-15">
                                    <p class="mb-10"><b>Social Profile</b></p>
                                    <div class="user-social-acount">
                                        <button class="btn btn-circle btn-social-icon btn-facebook"><i
                                                class="fa fa-facebook"></i></button>
                                        <button class="btn btn-circle btn-social-icon btn-twitter"><i
                                                class="fa fa-twitter"></i></button>
                                        <button class="btn btn-circle btn-social-icon btn-instagram"><i
                                                class="fa fa-instagram"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div>
                                    <div class="map-box">
                                        {{-- <iframe
                                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2805244.1745767146!2d-86.32675167439648!3d29.383165774894163!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88c1766591562abf%3A0xf72e13d35bc74ed0!2sFlorida%2C+USA!5e0!3m2!1sen!2sin!4v1501665415329"
                                            width="100%" height="100" frameborder="0" style="border:0"
                                            allowfullscreen></iframe> --}}
                                            <iframe style="border:0; width: 100%; height: 200px;"
                src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJYwDpKheLOxARdWuEhMJ1Asg&key=AIzaSyDEAnKa9MAAFnXKEb1Cm9MRnp6YUUNd8OE"
                frameborder="0" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
    </div>


    </section>


    </div>

@endsection
