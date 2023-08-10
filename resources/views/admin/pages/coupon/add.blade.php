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
                                <li class="breadcrumb-item" aria-current="page">Add Coupon</li>
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
                            <h3 class="box-title">New Coupon</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form action="{{ route('store.coupon') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="coupon_name" class="form-label">Coupon Name:</label>
                                    <input type="text" name="coupon_name" class="form-control" id="coupon_name">
                                    @error('coupon_name')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="discount" class="form-label">Discount (%):</label>
                                    <input type="text" name="discount" class="form-control" id="discount">
                                    @error('discount')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="validity" class="form-label">Validity Date:</label>
                                    <input type="date" name="validity" class="form-control" id="validity" min="{{Carbon\Carbon::now()->format('Y-m-d')}}">
                                    @error('validity')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                                <br>
                                <a href="{{ route('manage.coupon') }}" style="float: right;"
                                class="btn btn-rounded btn-outline btn-dark mb-5">Back</a>
                                <button type="submit" class="btn btn-rounded btn-outline btn-dark" style="float: right; margin-right:2%;">Add
                                    Coupon</button>

                            </form>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
        </section>
    </div>

@endsection
