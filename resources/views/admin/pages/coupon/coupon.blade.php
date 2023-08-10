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
                                <li class="breadcrumb-item" aria-current="page">All Coupons</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="row">
                @if (session('success'))
                    <div class="col-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                @endif


                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Coupon</h3>
                        <a href="{{ route('add.coupon') }}" class="btn btn-rounded btn-outline btn-secondary"
                            style="float: right">New Coupon</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Coupon Name</th>
                                        <th>Discount</th>
                                        <th>Validity</th>
                                        <th>Status</th>
                                        <th>Created at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 1)
                                    @foreach ($coupons as $item)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $item->coupon_name }}</td>
                                            <td>{{ $item->discount }}</td>
                                            <td>{{ Carbon\Carbon::parse($item->validity)->format('D, d F Y') }}</td>
                                            <td>
                                                @if ($item->validity >= Carbon\Carbon::now())
                                                    <span class="badge badge-pill badge-success">Valid</span>
                                                @else
                                                    <span class="badge badge-pill badge-danger">Invalid</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->created_at == null)
                                                    <span class="text-danger"> No Date Set</span>
                                                @else
                                                    {{ $item->created_at }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('edit.coupon', $item->id) }}"
                                                    class="btn btn-rounded btn-outline btn-primary" title="Edit"><i
                                                        class="fa fa-pencil"></i></a>

                                                <a href="{{ route('delete.coupon', $item->id) }}" title="Delete"
                                                    class="btn btn-rounded btn-outline btn-danger" id="deleted"><i
                                                        class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
    </div>
    </section>
    </div>
@endsection
