@extends('admin.admin_master')

@section('admin')

    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href=""><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Add Brands</li>
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
                            <h3 class="box-title">New Brands</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="brand_name" class="form-label">Brand Name:</label>
                                    <input type="text" name="brand_name" class="form-control" id="brand_name">
                                    @error('brand_name')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror

                                </div>
                                <div class="mb-3">
                                    <label for="brand_image" class="form-label">Brand Image:</label>
                                    <input type="file" name="brand_image" class="form-control" id="brand_image">
                                    @error('brand_image')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                                <br>
                                <a href="{{ route('all.brand') }}" style="float: right;"
                                class="btn btn-rounded btn-outline btn-dark mb-5">Back</a>
                                <button type="submit" class="btn btn-rounded btn-outline btn-dark" style="float: right; margin-right:2%;">Add
                                    Brand</button>

                            </form>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
        </section>
    </div>

@endsection
