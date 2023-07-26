
<div class="col-md-3 sidebar">
    <div class="sidebar-module-container">
        <!-- ==============================================CATEGORY============================================== -->
        <div class="sidebar-widget outer-bottom-xs wow fadeInUp">
            <img src="{{ !empty($user->profile_photo_path) ? url('upload/user_images/' . $user->profile_photo_path) : url('upload/admin.png') }}"
            alt="" class="card-img-top" style="border-radius: 10%; margin-bottom:5%;" height="100%" width="100%">
            <h3 class="section-title">{{ Auth::user()->name }}</h3>
            <div class="sidebar-widget-body m-t-10">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="{{ route('dashboard') }}" class="btn btn-outline btn-secondary"><span
                                class="fa fa-home mr-3"></span> Home</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#" class="btn btn-outline"><span class="fa fa-shopping-cart mr-3"></span> My Orders
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ route('user.profile') }}" class="btn btn-outline"><span
                                class="fa fa-trophy mr-3"></span> Pofile
                            Update</a>
                    </li>
                    {{-- <li class="list-group-item">
                        <a href="#" class="btn btn-outline"><span class="fa fa-cog mr-3"></span> Change
                            Password</a>
                    </li> --}}
                    <li class="list-group-item">
                        <a href="{{ route('user.logout') }}" class="btn btn-outline"><span
                                class="fa fa-sign-out mr-3"></span> Sign
                            Out</a>
                    </li>
                </ul>

            </div><!-- /.sidebar-widget-body -->
        </div><!-- /.sidebar-widget -->
        <!-- ============================================== CATEGORY : END ============================================== -->

    </div>
</div>
