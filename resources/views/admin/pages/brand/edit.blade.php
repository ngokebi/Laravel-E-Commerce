@extends('admin.admin_master')

@section('admin')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href=""><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Edit Brands</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="row">

                <div class="col-10">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Brands</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form action="{{ route('update.brand', $edit_brand->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="old_image" value="{{ $edit_brand->brand_image}}">
                                <input type="hidden" name="id" value="{{ $edit_brand->id}}">
                                <div class="mb-3">
                                    <label for="update_brandname" class="form-label">Brand Name:</label>
                                    <input type="text" name="brand_name" class="form-control" id="update_brandname"
                                        value="{{ $edit_brand->brand_name }}">
                                    @error('brand_name')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror

                                </div>
                                <div class="mb-3">
                                    <img src="{{ asset($edit_brand->brand_image) }}" style="width: 40%; height:40%;"
                                        id="showImage">
                                </div>
                                <div class="mb-3">
                                    <label for="update_brandimage" class="form-label">Brand Image:</label>
                                    <input type="file" name="brand_image" class="form-control" id="update_brandimage" value="{{ $edit_brand->brand_image }}">
                                    @error('brand_image')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                                <br>
                                <a href="{{ route('all.brand') }}" style="float: right;"
                                    class="btn btn-rounded btn-outline btn-dark mb-5">Back</a>
                                <button type="submit" class="btn btn-rounded btn-outline btn-dark"
                                    style="float: right; margin-right:2%;">Update
                                    Brand</button>

                            </form>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
        </section>
    </div>
    <script type="text/javascript">
        $(document).ready(function(e) {
            $('#update_brandimage').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
