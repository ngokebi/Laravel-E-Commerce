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
                                <li class="breadcrumb-item" aria-current="page">Add Slider</li>
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
                            <h3 class="box-title">New Slider</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form action="{{ route('store.slider') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="slider" class="form-label">Slider:</label>
                                    <div class="controls">
                                        <input type="file"  name="slider" class="form-control"
                                            onchange="mainthumbUrl(this)">
                                        @error('slider')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                    <img src="" id="mainThumb"
                                            style="width: 40%; height:40%; padding-top:10px;">
                                </div>

                                <div class="mb-3">
                                    <label for="caption" class="form-label">Caption:</label>
                                    <input type="text" name="caption" class="form-control" id="caption">
                                    @error('caption')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="title" class="form-label">Title:</label>
                                    <input type="text" name="title" class="form-control" id="title">
                                    @error('title')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description:</label>
                                    <input type="text" name="description" class="form-control" id="description">
                                    @error('description')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>

                                <br>
                                <a href="{{ route('manage.slider') }}" style="float: right;"
                                    class="btn btn-rounded btn-outline btn-dark mb-5">Back</a>
                                <button type="submit" class="btn btn-rounded btn-outline btn-dark"
                                    style="float: right; margin-right:2%;">Add
                                    Slider</button>

                            </form>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
        </section>
    </div>
    <script type="text/javascript">
        function mainthumbUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainThumb').attr('src', e.target.result);
                    // .width(200).height(200)
                };
                reader.readAsDataURL(input.files[0]);
            };
        };
    </script>
@endsection
