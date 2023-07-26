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
                                <li class="breadcrumb-item" aria-current="page">All Sub_SubCategories</li>
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
                        <h3 class="box-title">Sub_SubCategory</h3>
                        <a href="{{ route('add.sub_subcategory') }}" class="btn btn-rounded btn-outline btn-secondary"
                            style="float: right">New Sub_SubCategory</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category</th>
                                        <th>SubCategory</th>
                                        <th>SubSubCategory Name</th>
                                        <th>Created at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 1)
                                    @foreach ($sub_subcategory as $item)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $item['category']['category_name'] }}</td>
                                            <td>{{ $item['subcategory']['subcategory_name'] }}</td>
                                            <td>{{$item->subsubcategory_name}}</td>
                                            <td>
                                                @if ($item->created_at == null)
                                                    <span class="text-danger"> No Date Set</span>
                                                @else
                                                    {{ $item->created_at }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('edit.sub_subcategory', $item->id) }}"
                                                    class="btn btn-rounded btn-outline btn-primary" title="Edit"><i class="fa fa-pencil"></i></a>

                                                <a href="{{ route('delete.sub_subcategory', $item->id) }}" title="Delete" {{--onclick="return confirm('Are you sure you want to delete')" --}}
                                                    class="btn btn-rounded btn-outline btn-danger" id="deleted"><i class="fa fa-trash"></i></a>
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
