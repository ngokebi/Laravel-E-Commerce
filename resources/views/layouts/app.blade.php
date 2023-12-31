@php
    $brands = DB::table('brands')->get();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">
    <title>@yield('title')</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.transitions.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/rateit.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap-select.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">



    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome.css') }}">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800'
        rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
</head>

<body class="cnt-home">
    <!-- ============================================== HEADER ============================================== -->

    @include('frontend.body.header')
    <!-- ============================================== HEADER : END ============================================== -->

    @yield('content')

    <!-- /#top-banner-and-menu -->

    @include('frontend.body.brands')

    <!-- ============================================================= FOOTER ============================================================= -->

    @include('frontend.body.footer')

    <!-- ============================================================= FOOTER : END============================================================= -->

    <script src="{{ asset('frontend/assets/js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-hover-dropdown.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/echo.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.easing-1.3.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.rateit.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/assets/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "5000",
            "hideDuration": "5000",
            "timeOut": "5000",
            "extendedTimeOut": "5000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
            // onHidden: function() {
            //     window.location.reload();
            //     // location.reload(true);
            // }
        }
    </script>


    <!-- Add to Cart Product Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span id="pname"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModel">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-4">

                            <div class="card" style="width: 18rem;">
                                <img src="" class="card-img-top" alt="..." id="pimage"
                                    style="height: 200px; width: 200px;">
                            </div>

                        </div><!-- // end col md -->


                        <div class="col-md-4">

                            <ul class="list-group">
                                <li class="list-group-item">Product Price: <strong class="text-danger">$<span
                                            id="pprice"></span></strong>
                                    <del id="oldprice">$</del>
                                </li>
                                <li class="list-group-item">Product Code: <strong id="pcode"></strong></li>
                                <li class="list-group-item">Category: <strong id="pcat"></strong></li>
                                <li class="list-group-item">Brand: <strong id="pbrand"></strong></li>
                                <li class="list-group-item">Stock <span class="badge badge-pill badge-success"
                                        id="aviable" style="background: green; color: white;"></span>
                                    <span class="badge badge-pill badge-danger" id="stockout"
                                        style="background: red; color: white;"></span>
                                </li>
                            </ul>

                        </div><!-- // end col md -->

                        <div class="col-md-4">

                            <div class="form-group">
                                <label for="color">Choose Color</label>
                                <select class="form-control" id="color" name="color">
                                </select>
                            </div>


                            <div class="form-group" id="sizeArea">
                                <label for="size">Choose Size</label>
                                <select class="form-control" id="size" name="size">
                                    <option>1</option>

                                </select>
                            </div> <!-- // end form group -->

                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" id="quantity" min="1">
                            </div> <!-- // end form group -->
                            <input type="hidden" id="product_id">
                            <button type="submit" class="btn btn-primary mb-2" onclick="addToCart()">Add to
                                Cart</button>
                        </div><!-- // end col md -->


                    </div> <!-- // end row -->


                </div> <!-- // end modal Body -->

            </div>
        </div>
    </div>
    <!-- End Add to Cart Product Modal -->

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        // Start Product View with Modal
        function productView(id) {

            $.ajax({
                type: 'GET',
                url: '/product/view/modal/' + id,
                dataType: 'json',
                success: function(data) {
                    // console.log(data)
                    $('#pname').text(data.product.product_name);
                    $('#price').text(data.product.selling_price);
                    $('#pcode').text(data.product.product_code);
                    $('#pcat').text(data.product.category.category_name);
                    $('#pbrand').text(data.product.brand.brand_name);
                    $('#pimage').attr('src', '/' + data.product.product_thumbnail);
                    $('#product_id').val(id);


                    // Product Prize
                    if (data.product.discount_price == null) {
                        $('#pprice').text('');
                        $('#oldprice').text('');
                        $('#pprice').text(data.product.selling_price);
                    } else {
                        $('#pprice').text(data.product.discount_price);
                        $('#oldprice').text(data.product.selling_price);
                    } // end prodcut price
                    // Start Stock opiton
                    if (data.product.product_qty > 0) {
                        $('#aviable').text('');
                        $('#stockout').text('');
                        $('#aviable').text('aviable');
                    } else {
                        $('#aviable').text('');
                        $('#stockout').text('');
                        $('#stockout').text('stockout');
                    } // end Stock Option
                    // Color
                    $('select[name="color"]').empty();
                    $.each(data.color, function(key, value) {
                        $('select[name="color"]').append('<option value=" ' + value + ' ">' + value +
                            '</option>')
                    })

                    // Size
                    $('select[name="size"]').empty();
                    $.each(data.size, function(key, value) {
                        $('select[name="size"]').append('<option value=" ' + value + ' ">' + value +
                            ' </option>')
                        if (data.size == "") {
                            $('#sizeArea').hide();
                        } else {
                            $('#sizeArea').show();
                        }
                    }) // end size
                }
            })

        }

        // Add to Cart
        function addToCart() {
            // alert($('#product_id').val());
            var product_name = $('#pname').text();
            var id = $('#product_id').val();
            var color = $('#color option:selected').text();
            var size = $('#size option:selected').text();
            var quantity = $('#quantity').val();

            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: {
                    color: color,
                    size: size,
                    quantity: quantity,
                    product_name: product_name
                },
                url: '/cart/data/store/' + id,
                success: function(data) {

                    miniCart()
                    $('#closeModel').click();
                    // console.log(data);

                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }
                    // End Message
                }
            })
        }
    </script>

    <script type="text/javascript">
        function miniCart() {
            $.ajax({
                type: 'GET',
                url: '/product/mini/cart/',
                dataType: 'json',
                success: function(response) {
                    // console.log(response);
                    $('span[id="cartSubTotal"]').text(response.cartTotal);
                    $('span[id="cartQty"]').text(response.cartQty);

                    var miniCart = '';
                    $.each(response.carts, function(key, value) {
                        miniCart += `<div class="cart-item product-summary">
                  <div class="row">
                    <div class="col-xs-4">
                      <div class="image"> <a href="detail.html"><img src="/${value.options.image}" alt=""></a> </div>
                    </div>
                    <div class="col-xs-7">
                      <h3 class="name"><a href="index.php?page-detail">${value.name}</a></h3>
                      <div class="price">$${value.price} * ${value.qty}</div>
                    </div>
                    <div class="col-xs-1 action"> <a id="${value.rowId}" onclick="miniCartRemove(this.id)"><i class="fa fa-trash"></i></a> </div>
                  </div>
                </div>
                <!-- /.cart-item -->
                <div class="clearfix"></div>
                <hr>`
                    });
                    $('#miniCart').html(miniCart);
                }
            })
        }
        miniCart();

        // mini cart remove
        function miniCartRemove(rowId) {
            $.ajax({
                type: 'GET',
                url: '/minicart/product_remove/' + rowId,
                dataType: 'json',
                success: function(data) {
                    miniCart();
                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }
                    // End Message
                    location.reload(true);
                }
            })
        }
    </script>

    <script type="text/javascript">
        function addToWishlist(product_id) {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/add_to_wishlist/' + product_id,
                success: function(data) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                }
            })
        }
    </script>

    <script type="text/javascript">
        function wishList() {
            $.ajax({
                type: 'GET',
                url: '/user/get_wishlist',
                dataType: 'json',
                success: function(response) {

                    var wishListRow = '';
                    $.each(response, function(key, value) {
                        wishListRow += `<tr>
                                    <td class="col-md-2"><img src="/${value.product.product_thumbnail}" alt="imga">
                                    </td>
                                    <td class="col-md-7">
                                        <div class="product-name"><a href="product/details/${value.product_id}/${value.product.product_name}">${value.product.product_name}</a>
                                        </div>
                                        <div class="price">
                                            ${value.product.discount_price == null ? `$${value.product.selling_price}` : `$${value.product.discount_price} <span>$${value.product.selling_price}</span>`}
                                        </div>
                                    </td>
                                    <td class="col-md-2">
                                        <button class="btn btn-primary icon" type="button"
                                            title="Add Cart" data-toggle="modal"
                                            data-target="#exampleModal" id="${value.product_id}"
                                            onclick="productView(this.id)">
                                            <i class="fa fa-shopping-cart"></i> Add to Cart
                                        </button>
                                    </td>
                                    <td class="col-md-1 close-btn">
                                        <a id="${value.id}" onclick="wishListRemove(this.id)"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>`
                    });
                    $('#wishlist').html(wishListRow);
                }
            })
        }
        wishList();

        // wishlist remove
        function wishListRemove(id) {
            $.ajax({
                type: 'GET',
                url: '/user/wishlist_remove/' + id,
                dataType: 'json',
                success: function(data) {
                    wishList();
                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }
                    // End Message

                }
            })
        }
    </script>

    <script type="text/javascript">
        function cartList() {
            $.ajax({
                type: 'GET',
                url: '/user/cartitem',
                dataType: 'json',
                success: function(response) {
                    $('span[id="cartSubTotal"]').text(response.cartTotal);
                    $('span[id="cartQty"]').text(response.cartQty);

                    var cartListRow = '';
                    $.each(response.carts, function(key, value) {
                        cartListRow += `<tr>
                                    <td class="romove-item"><a id="${value.rowId}" onclick="cartListRemove(this.id)" title="cancel" class="icon"><i
                                                class="fa fa-trash-o"></i></a></td>
                                    <td class="cart-image">
                                        <a class="entry-thumbnail" href="detail.html">
                                            <img src="/${value.options.image}" alt="">
                                        </a>
                                    </td>
                                    <td class="cart-product-name-info">
                                        <h4 class='cart-product-description'><a href="../product/details/${value.id}/${value.name}">${value.name}</a></h4>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="rating rateit-small"></div>
                                            </div>
                                        </div><!-- /.row -->
                                        <div class="cart-product-info">
                                            <span class="product-color">COLOR:<span>${value.options.color}</span></span>
                                        </div>
                                    </td>
                                    <td class="cart-product-quantity">
                                        <div class="cart-quantity">
                                            <div class="quant-input">
                                                <input type="number" id="${value.rowId}" class="qtyCart" min="1" value="${value.qty}" onchange="qtyChange(this.id)">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart-product-edit">${value.options.size == null ? `<span>....</span>` : `<strong>${value.options.size}</strong>`}
                                    </td>
                                    <td class="cart-product-sub-total"><span
                                            class="cart-sub-total-price">$${value.price}</span></td>
                                    <td class="cart-product-grand-total"><span
                                            class="cart-grand-total-price">$${value.price * value.qty}</span></td>
                                </tr>`

                    });
                    $('#cartitem').html(cartListRow);
                }
            })
        }
        cartList();

        // cartList remove
        function cartListRemove(id) {
            $.ajax({
                type: 'GET',
                url: '/user/cartlist_remove/' + id,
                dataType: 'json',
                success: function(data) {
                    cartList();
                    miniCart();
                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }
                    // End Message
                    location.reload(true);
                }
            })
        }

        function qtyChange(rowId) {
            var newqty = $('.qtyCart').val();

            $.ajax({
                type: 'GET',
                url: "/cart_increment/" + rowId,
                data: {
                    qty: newqty
                },
                dataType: 'json',
                success: function(data) {
                    couponCalculation();
                    cartList();
                    miniCart();
                }
            });
        }
    </script>

    <script type="text/javascript">
        function applyCoupon() {
            var coupon_name = $('#coupon_name').val();

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: "{{ url('/coupon_apply') }}",
                data: {
                    coupon_name: coupon_name
                },
                success: function(data) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                    location.reload(true);
                }
            })
        }

        function couponCalculation() {
            $.ajax({
                type: 'GET',
                url: "{{ url('/coupon_calculate') }}",
                dataType: 'json',
                success: function(data) {
                    if (data.total) {
                        $('#couponCalField').html(
                            `<tr>
                                <th>
                                    <div class="cart-sub-total">
                                        Total Quantity<span class="inner-left-md">${data.cartQty}</span>
                                    </div>
                                    <div class="cart-grand-total">
                                        SubTotal<span class="total-price"><span class="inner-left-md">
                                                <span class="sign">$</span><span>${data.total}</span></span>
                                        </span>
                                    </div>
                                    <div class="cart-grand-total">
                                        GrandTotal<span class="total-price"><span class="inner-left-md">
                                                <span class="sign">$</span><span>${data.total}</span></span>
                                        </span>
                                    </div>
                                </th>
                            </tr>`
                        )
                    } else {
                        $('#couponCalField').html(
                            `<tr>
                                <th>
                                    <div class="cart-sub-total">
                                        Total Quantity:<span class="inner-left-md">${data.cartQty}</span>
                                    </div>
                                    <div class="cart-sub-total">
                                        DIscount Name:<span class="inner-left-md">${data.coupon_name}</span><span>&nbsp;&nbsp;<button type="submit" title="cancel" onclick="removeCoupon()" class="icon"><i class="fa fa-trash-o"></i></button></span>
                                    </div>
                                    <div class="cart-grand-total">
                                        Sub Total<span class="total-price"><span class="inner-left-md">
                                                <span class="sign">$</span><span>${data.subtotal}</span></span>
                                        </span>
                                    </div>
                                    <div class="cart-grand-total">
                                        Discount Amount<span class="total-price"><span class="inner-left-md">
                                                <span class="sign" style ="color:red;">$</span><span style ="color:red;">${data.discount_amount}</span></span>
                                        </span>
                                    </div>
                                    <div class="cart-grand-total">
                                        Grand Total<span class="total-price"><span class="inner-left-md">
                                                <span class="sign">$</span><span>${data.total_amount}</span></span>
                                        </span>
                                    </div>
                                </th>
                            </tr>`
                        )
                    }

                }
            })
        }
        couponCalculation();

        function removeCoupon() {
            $.ajax({
                    type: 'GET',
                    url: "{{ url('/remove_coupon') }}",
                    dataType: 'json',
                    success: function(data) {
                        couponCalculation();
                        const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                    location.reload(true);
                    }
            })
        }
    </script>

</body>

</html>

