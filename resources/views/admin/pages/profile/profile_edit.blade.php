@extends('admin.admin_master')

@section('admin')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="py-12">
        <div class="container">
            <br>
            <h4><strong>Profile Information Edit </strong></h4>
            <p><small>Update your account's profile information, email address and Image.</small></p>
            <br>
            <div class="row">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header"><strong>Edit Details</strong></div>
                        <div class="card-body">
                            <form action="{{route('admin.profile.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name:</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        value="{{ $edit_data->name }}">
                                    @error('name')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                        value="{{ $edit_data->email }}">
                                    @error('email')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <img src="{{ (!empty($edit_data->profile_photo_path)) ?  url('upload/admin_images/' . $edit_data->profile_photo_path) : url('upload/admin.png') }}"
                                        style="width: 40%; height:40%;" id="showImage">
                                </div>
                                <div class="mb-3">
                                    <label for="profile_photo_path" class="form-label">Profile image:</label>
                                    <input type="file" name="profile_photo_path" class="form-control" id="profile_photo_path"
                                        value="">
                                    @error('profile_photo_path')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                                <br>
                                <a href="{{ route('admin.profile') }}" style="float: right;"
                                class="btn btn-rounded btn-outline btn-dark mb-5">Back</a>
                                <button type="submit" class="btn btn-rounded btn-outline btn-dark"
                                    style="float: right; margin-right:2%;">Update</button>
                            </form>
                        </div>
                    </div>
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
