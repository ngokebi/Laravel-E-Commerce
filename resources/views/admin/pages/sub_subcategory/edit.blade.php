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
                                <li class="breadcrumb-item" aria-current="page">Edit Sub_SubCategory</li>
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
                            <h3 class="box-title">Edit Sub_SubCategory</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form action="{{ route('update.sub_subcategory', $edit_subsubcategory->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $edit_subsubcategory->id }}">
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Category Select:</label>
                                    <div class="controls">
                                        <select name="category_id" class="form-control">
                                            <option value="" selected="" disabled="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $category->id == $edit_subsubcategory->category_id ? 'selected' : '' }}>
                                                    {{ $category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="subcategory_id" class="form-label">SubCategory Select:</label>
                                    <div class="controls">
                                        <select name="subcategory_id" class="form-control">
                                            <option value="" selected="" disabled="">Select SubCategory</option>
                                            @foreach ($subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}"
                                                {{ $subcategory->id == $edit_subsubcategory->subcategory_id ? 'selected' : '' }}>
                                                {{ $subcategory->subcategory_name }}
                                            </option>
                                        @endforeach
                                        </select>
                                        @error('subcategory_id')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="subsubcategory_name" class="form-label">Sub_SubCategory Name:</label>
                                    <input type="text" name="subsubcategory_name" class="form-control"
                                        id="subsubcategory_name" value="{{ $edit_subsubcategory->subsubcategory_name }}">
                                    @error('subsubcategory_name')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                                <br>
                                <a href="{{ route('all.sub_subcategory') }}" style="float: right;"
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
