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
                                <li class="breadcrumb-item" aria-current="page">Add State</li>
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
                            <h3 class="box-title">New State</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form action="{{ route('store.state') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Division:</label>
                                    <div class="controls">
                                        <select name="division_id" class="form-control">
                                            <option value="" selected="" disabled="">Select Division</option>
                                            @foreach ($division as $div)
                                                <option value="{{ $div->id }}">{{ $div->division_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('division_id')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="state_name" class="form-label">State:</label>
                                    <input type="text" name="state_name" class="form-control" id="state_name">
                                    @error('state_name')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                                <br>
                                <a href="{{ route('manage.state') }}" style="float: right;"
                                    class="btn btn-rounded btn-outline btn-dark mb-5">Back</a>
                                <button type="submit" class="btn btn-rounded btn-outline btn-dark"
                                    style="float: right; margin-right:2%;">Add
                                    State</button>

                            </form>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection
