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
                                <li class="breadcrumb-item" aria-current="page">Manage Products</li>
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
                        <h3 class="box-title">All Products</h3>
                        <a href="{{ route('add.products') }}" class="btn btn-rounded btn-outline btn-secondary"
                            style="float: right">Add Products</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Products Name</th>
                                        <th>Category</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Main Thumbnail</th>
                                        <th>Status</th>
                                        <th width='19%'>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 1)
                                    @foreach ($products as $item)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $item->product_name }}</td>
                                            <td>{{ $item['subsubcategory']['subsubcategory_name'] }}</td>
                                            <td>{{ $item->product_qty }}</td>
                                            <td>{{ $item->selling_price }}</td>
                                            <td>
                                                @if ($item->discount_price == null)
                                                    <span class="badge badge-pill badge-danger">No Discount</span>
                                                @else
                                                    {{(round((($item->selling_price - $item->discount_price) / ($item->selling_price)) * 100).'%') }}
                                                    
                                                @endif
                                            </td>
                                            <td><img src="{{ asset($item->product_thumbnail) }}" alt=""
                                                    height="200px" width="150px"></td>
                                            <td>
                                                @if ($item->status == 1)
                                                    <a href="{{ route('product.inactive', $item->id) }}"
                                                        title="Inactive"><span
                                                            class="badge badge-pill badge-success">Active</span></a>
                                                @else
                                                    <a href="{{ route('product.active', $item->id) }}" title="Active"><span
                                                            class="badge badge-pill badge-danger">Inactive</span></a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('detail.products', $item->id) }}"
                                                    class="btn btn-rounded btn-outline btn-primary"
                                                    title="Product Details"><i class="fa fa-eye"></i></a>

                                                <a href="{{ route('edit.products', $item->id) }}"
                                                    class="btn btn-rounded btn-outline btn-info" title="Edit"><i
                                                        class="fa fa-pencil"></i></a>

                                                <a href="{{ route('delete.products', $item->id) }}" title="Delete"
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
