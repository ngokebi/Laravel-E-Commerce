@php
            $products = App\Models\Products::groupBy('product_tags')->select('product_tags')->get();
@endphp
<div class="sidebar-widget product-tag wow fadeInUp">
    <h3 class="section-title">Product tags</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="tag-list">
            @foreach ($products as $tag)
            <a class="item active" title="{{$tag->product_tags}}" href="{{url('product/tag/' . $tag->product_tags)}}">{{$tag->product_tags}}</a>
            @endforeach
        </div>
        <!-- /.tag-list -->
    </div>
    <!-- /.sidebar-widget-body -->
</div>
