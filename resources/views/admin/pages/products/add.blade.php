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
                                <li class="breadcrumb-item" aria-current="page">Add Products</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Products</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="post" action="{{ route('store.products') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">

                                        <!-- Start 1st Row -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <!-- Start Col-Md-4 -->
                                                <div class="mb-3">
                                                    <label for="brand_id" class="form-label">Brand Select:</label>
                                                    <div class="controls">
                                                        <select name="brand_id" class="form-control">
                                                            <option value="" selected="" disabled="">Select Brand
                                                            </option>
                                                            @foreach ($brands as $brand)
                                                                <option value="{{ $brand->id }}">
                                                                    {{ $brand->brand_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('brand_id')
                                                            <span class="text-danger"> {{ $message }} </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- End Col-Md-4 -->

                                            <div class="col-md-4">
                                                <!-- Start Col-Md-4 -->
                                                <div class="mb-3">
                                                    <label for="category_id" class="form-label">Category Select:</label>
                                                    <div class="controls">
                                                        <select name="category_id" class="form-control">
                                                            <option value="" selected="" disabled="">Select Category
                                                            </option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}">
                                                                    {{ $category->category_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('category_id')
                                                            <span class="text-danger"> {{ $message }} </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- End Col-Md-4 -->

                                            <div class="col-md-4">
                                                <!-- Start Col-Md-4 -->
                                                <div class="mb-3">
                                                    <label for="subcategory_id" class="form-label">SubCategory
                                                        Select:</label>
                                                    <div class="controls">
                                                        <select name="subcategory_id" class="form-control">
                                                            <option value="" selected="" disabled="">Select SubCategory
                                                            </option>

                                                        </select>
                                                        @error('subcategory_id')
                                                            <span class="text-danger"> {{ $message }} </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- End Col-Md-4 -->

                                        </div>
                                        <!-- End 1st Row -->

                                        <!-- Start 2nd Row -->
                                        <div class="row">

                                            <div class="col-md-4">
                                                <!-- Start Col-Md-4 -->
                                                <div class="mb-3">
                                                    <label for="subsubcategory_id" class="form-label">Sub_SubCategory
                                                        Select:</label>
                                                    <div class="controls">
                                                        <select name="subsubcategory_id" class="form-control">
                                                            <option value="" selected="" disabled="">Select Sub_SubCategory
                                                            </option>

                                                        </select>
                                                        @error('subsubcategory_id')
                                                            <span class="text-danger"> {{ $message }} </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- End Col-Md-4 -->

                                            <div class="col-md-4">
                                                <!-- Start Col-Md-4 -->
                                                <div class="form-group">
                                                    <label for="product_name" class="form-label">Product Name:</label>
                                                    <div class="controls">
                                                        <input type="text" name="product_name" class="form-control">
                                                        @error('product_name')
                                                            <span class="text-danger"> {{ $message }} </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- End Col-Md-4 -->

                                            <div class="col-md-4">
                                                <!-- Start Col-Md-4 -->
                                                <div class="form-group">
                                                    <label for="product_code">Product Code</label>
                                                    <div class="controls">
                                                        <input type="text" name="product_code" class="form-control">
                                                        @error('product_code')
                                                            <span class="text-danger"> {{ $message }} </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- End Col-Md-4 -->

                                        </div>
                                        <!-- End 2nd Row -->

                                        <!-- Start 3rd Row -->
                                        <div class="row">

                                            <div class="col-md-4">
                                                <!-- Start Col-Md-4 -->
                                                <div class="form-group">
                                                    <label for="product_tags" class="form-label">Product Tags:</label>
                                                    <div class="controls">
                                                        <input type="text" name="product_tags" class="form-control"
                                                            value="Lorem,Ipsum,Amet" data-role="tagsinput" required="">
                                                        @error('product_tags')
                                                            <span class="text-danger"> {{ $message }} </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- End Col-Md-4 -->

                                            <div class="col-md-4">
                                                <!-- Start Col-Md-4 -->
                                                <div class="form-group">
                                                    <label for="product_qty" class="form-label">Product
                                                        Quantity:</label>
                                                    <div class="controls">
                                                        <input type="text" name="product_qty" class="form-control">
                                                        @error('product_qty')
                                                            <span class="text-danger"> {{ $message }} </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- End Col-Md-4 -->

                                            <div class="col-md-4">
                                                <!-- Start Col-Md-4 -->
                                                <div class="form-group">
                                                    <label for="discount_price" class="form-label">Discount
                                                        Price:</label>
                                                    <div class="controls">
                                                        <input type="text" name="discount_price" class="form-control">
                                                        @error('discount_price')
                                                            <span class="text-danger"> {{ $message }} </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- End Col-Md-4 -->

                                        </div>
                                        <!-- End 3rd Row -->

                                        <!-- Start 4th Row -->
                                        <div class="row">

                                            <div class="col-md-4">
                                                <!-- Start Col-Md-4 -->
                                                <div class="form-group">
                                                    <label for="product_size" class="form-label">Product Size:</label>
                                                    <div class="controls">
                                                        <input type="text" name="product_size" class="form-control"
                                                            value="Large, Small, Medium" data-role="tagsinput">
                                                        @error('product_size')
                                                            <span class="text-danger"> {{ $message }} </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- End Col-Md-4 -->

                                            <div class="col-md-4">
                                                <!-- Start Col-Md-4 -->
                                                <div class="form-group">
                                                    <label for="product_color" class="form-label">Product
                                                        Color:</label>
                                                    <div class="controls">
                                                        <input type="text" name="product_color" class="form-control"
                                                            value="Blue,Green,Red" data-role="tagsinput" required="">
                                                        @error('product_color')
                                                            <span class="text-danger"> {{ $message }} </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- End Col-Md-4 -->

                                            <div class="col-md-4">
                                                <!-- Start Col-Md-4 -->
                                                <div class="form-group">
                                                    <label for="selling_price">Selling Price</label>
                                                    <div class="controls">
                                                        <input type="text" name="selling_price" class="form-control">
                                                        @error('selling_price')
                                                            <span class="text-danger"> {{ $message }} </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- End Col-Md-4 -->

                                        </div>
                                        <!-- End 4th Row -->

                                        <!-- Start 5th Row -->
                                        <div class="row">

                                            <div class="col-md-6">
                                                <!-- Start Col-Md-6 -->
                                                <div class="form-group">
                                                    <label for="short_descriptioshort_descriptionn"
                                                        class="form-label">Short
                                                        Description:</label>
                                                    <div class="controls">
                                                        <textarea cols="50" name="short_description" id="textarea"
                                                            class="form-control"></textarea>
                                                        @error('short_description')
                                                            <span class="text-danger"> {{ $message }} </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- End Col-Md-6 -->

                                            <div class="col-md-6">
                                                <!-- Start Col-Md-6 -->
                                                <div class="form-group">
                                                    <label for="long_description">Long Description:</label>
                                                    <div class="controls">
                                                        <textarea cols="50" name="long_description" id="textarea"
                                                            class="form-control"></textarea>
                                                        @error('long_description')
                                                            <span class="text-danger"> {{ $message }} </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- End Col-Md-6 -->

                                        </div>
                                        <!-- End 5th Row -->

                                        <!-- Start 6th Row -->
                                        <div class="row">

                                            <div class="col-md-4">
                                                <!-- Start Col-Md-4 -->
                                                <div class="form-group">
                                                    <label for="product_thumbnail" class="form-label">Main
                                                        Thumbnail:</label>
                                                    <div class="controls">
                                                        <input type="file" name="product_thumbnail" class="form-control"
                                                            onchange="mainthumbUrl(this)">
                                                        @error('product_thumbnail')
                                                            <span class="text-danger"> {{ $message }} </span>
                                                        @enderror
                                                        <img src="" id="mainThumb"
                                                            style="width: 40%; height:40%; padding-top:10px;">
                                                    </div>
                                                </div>

                                            </div> <!-- End Col-Md-4 -->

                                            <div class="col-md-4">
                                                <!-- Start Col-Md-4 -->
                                                <div class="form-group">
                                                    <label for="photo_image" class="form-label">Multiple Image:</label>
                                                    <div class="controls">
                                                        <input type="file" name="photo_image[]" class="form-control"
                                                            multiple="" id="multiImg">
                                                        @error('photo_image')
                                                            <span class="text-danger"> {{ $message }} </span>
                                                        @enderror
                                                        <div class="row" id="preview_img"
                                                            style="width: 40%; height:40%; padding-top:10px;"></div>
                                                    </div>
                                                </div>
                                            </div> <!-- End Col-Md-4 -->

                                        </div>
                                        <!-- End 6th Row -->
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <fieldset>
                                                    <input type="checkbox" id="hot_deals" name="hot_deals" value="1">
                                                    <label for="hot_deals">Hot Deals</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input type="checkbox" id="featured" name="featured" value="1">
                                                    <label for="featured">Featured</label>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <fieldset>
                                                    <input type="checkbox" id="special_offer" name="special_offer" value="1">
                                                    <label for="special_offer">Special Offer</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input type="checkbox" id="special_deals" name="special_deals" value="1">
                                                    <label for="special_deals">Special Deals</label>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-xs-right">

                                    <button type="submit" class="btn btn-rounded btn-outline btn-dark"
                                        style="float: right; margin-left:1%;">Add
                                        Product</button>
                                    <a href="{{ route('manage.products') }}" style="float: right;"
                                        class="btn btn-rounded btn-outline btn-dark mb-5">Back</a>
                                </div>
                            </form>

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="category_id"]').on('change', function() {
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: "{{ url('/sub_subcategory/subcategory/ajax') }}/" + category_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="subsubcategory_id"]').html('');
                            var d = $('select[name="subcategory_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="subcategory_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .subcategory_name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });



            $('select[name="subcategory_id"]').on('change', function() {
                var subcategory_id = $(this).val();
                if (subcategory_id) {
                    $.ajax({
                        url: "{{ url('/sub_subcategory/subsubcategory/ajax') }}/" +
                            subcategory_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var d = $('select[name="subsubcategory_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="subsubcategory_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .subsubcategory_name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }

            });


        });
    </script>

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

    <script>
        $(document).ready(function() {
            $('#multiImg').on('change', function() { //on file input change
                if (window.File && window.FileReader && window.FileList && window
                    .Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function(index, file) { //loop though each file
                        if (/(\.|\/)(gif|jpe?g|png)$/i.test(file
                                .type)) { //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file) { //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src',
                                        e.target.result)
                                    // .width(100)
                                    // .height(100);
                                    //create image element
                                    $('#preview_img').append(
                                        img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                } else {
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });
    </script>
@endsection
