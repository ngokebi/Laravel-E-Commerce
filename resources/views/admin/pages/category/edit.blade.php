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
                                <li class="breadcrumb-item" aria-current="page">Edit Category</li>
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
                            <h3 class="box-title">Edit Category</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form action="{{ route('update.category', $edit_category->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $edit_category->id}}">
                                <div class="mb-3">
                                    <label for="update_categoryname" class="form-label">Category Name:</label>
                                    <input type="text" name="category_name" class="form-control" id="update_categoryname"
                                        value="{{ $edit_category->category_name }}">
                                    @error('category_name')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror

                                </div>
                                <div class="mb-3">
                                    <label for="update_categoryicon" class="form-label">Category Icon:</label>
                                    <input type="text" name="category_icon" class="form-control" id="update_categoryicon" value="{{ $edit_category->category_icon }}">
                                    @error('category_icon')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                                <br>
                                <a href="{{ route('all.category') }}" style="float: right;"
                                    class="btn btn-rounded btn-outline btn-dark mb-5">Back</a>
                                <button type="submit" class="btn btn-rounded btn-outline btn-dark"
                                    style="float: right; margin-right:2%;">Update
                                    category</button>

                            </form>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection
