@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="container">
            <br>
            <h4><strong> Change Profile Password </strong></h4>
            @if (session('error'))
                <div class="alert alert-error alert-dismissible fade show" role="alert">
                    <strong>{{ session('error') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <br>
            <br>
            <div class="row">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header"><strong>Edit Details</strong></div>
                        <div class="card-body">
                            <form action="{{route('admin.profile.changepassword')}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="current_password" class="form-label">Current Password: <span style="color: red">*</span></label>
                                    <input type="password" name="current_password" class="form-control" id="current_password">
                                    @error('current_password')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">New Password: <span style="color: red">*</span></label>
                                    <input type="password" name="password" class="form-control" id="password">
                                    @error('password')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password: <span style="color: red">*</span></label>
                                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                                    @error('password_confirmation')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                                <br>
                                <a href="{{ route('admin.profile') }}" style="float: right;"
                                class="btn btn-rounded btn-outline btn-dark mb-5">Back</a>
                                <button type="submit" class="btn btn-rounded btn-outline btn-dark"
                                    style="float: right; margin-right:2%;">Update Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
