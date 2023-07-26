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
                                <li class="breadcrumb-item" aria-current="page">All Slider</li>
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
                        <h3 class="box-title">Slider</h3>
                        <a href="{{ route('add.slider') }}" class="btn btn-rounded btn-outline btn-secondary"
                            style="float: right">New Slider</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Slider Image</th>
                                        <th>Title</th>
                                        <th>Caption</th>
                                        <th>Description</th>
                                        <th>Stattus</th>
                                        <th>Created at</th>
                                        <th width="20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 1)
                                    @foreach ($sliders as $item)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td><img src="{{ asset($item->slider) }}" alt="" width="50%"
                                                    height="30%"></td>
                                            <td>
                                                @if ($item->title == null)
                                                    <span class="text-danger"> No Title</span>
                                                @else
                                                    {{ $item->title }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->caption == null)
                                                    <span class="text-danger"> No Caption</span>
                                                @else
                                                    {{ $item->caption }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->title == null)
                                                    <span class="text-danger"> No Description</span>
                                                @else
                                                    {{ $item->description }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->status == 1)
                                                    <a href="{{ route('slider.inactive', $item->id) }}"
                                                        title="Inactive"><span
                                                            class="badge badge-pill badge-success">Active</span></a>
                                                @else
                                                    <a href="{{ route('slider.active', $item->id) }}" title="Active"><span
                                                            class="badge badge-pill badge-danger">Inactive</span></a>
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
                                                <a href="{{ route('edit.slider', $item->id) }}"
                                                    class="btn btn-rounded btn-outline btn-primary" title="Edit"><i
                                                        class="fa fa-pencil"></i></a>

                                                <a href="{{ route('delete.slider', $item->id) }}" title="Delete"
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
