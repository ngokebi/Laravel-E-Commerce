<div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
    <h3 class="section-title">hot deals</h3>
    <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
        @foreach ($hot_deals as $product)
            <div class="item">
                <div class="products">
                    <div class="hot-deal-wrapper">
                        <div class="image"> <img src="{{ asset($product->product_thumbnail) }}"
                                alt="">
                        </div>
                        <div>
                            @if ($product->discount_price == null)
                                <div class="tag sale"><span>sale</span></div>
                            @else
                                <div class="tag new">
                                    <span>{{ round((($product->selling_price - $product->discount_price) / $product->selling_price) * 100) . '%' }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- /.hot-deal-wrapper -->

                    <div class="product-info text-left m-t-20">
                        <h3 class="name"><a
                                href="{{ url('product/details/' . $product->id . '/' . $product->product_name) }}">{{ $product->product_name }}</a>
                        </h3>
                        <div class="rating rateit-small"></div>

                        @if ($product->discount_price == null)
                            <div class="product-price"> <span class="price">
                                    ${{ $product->selling_price }}
                                </span>
                            </div>
                        @else
                            <div class="product-price"> <span class="price">
                                    ${{ $product->discount_price }}
                                </span> <span
                                    class="price-before-discount">${{ $product->selling_price }}</span>
                            </div>
                        @endif
                        <!-- /.product-price -->

                    </div>
                    <!-- /.product-info -->

                    <div class="cart clearfix animate-effect">
                        <div class="action">
                            <div class="add-cart-button btn-group">
                                <button class="btn btn-primary icon" data-toggle="dropdown"
                                    type="button">
                                    <i class="fa fa-shopping-cart"></i> </button>
                                <button class="btn btn-primary cart-btn" type="button">Add to
                                    cart</button>
                            </div>
                        </div>
                        <!-- /.action -->
                    </div>
                    <!-- /.cart -->
                </div>
            </div>
        @endforeach
    </div>
    <!-- /.sidebar-widget -->
</div>
