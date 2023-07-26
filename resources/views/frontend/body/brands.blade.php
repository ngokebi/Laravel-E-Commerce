         <!-- ============================================== BRANDS CAROUSEL ============================================== -->
         <div id="brands-carousel" class="logo-slider wow fadeInUp">
             <div class="logo-slider-inner">
                 <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">

                     @foreach ($brands as $brand)

                         <div class="item"> <a href="#" class="image"> <img

                                     data-echo="{{ asset($brand->brand_image) }}" src="" alt=""> </a> </div>

                     @endforeach

                 </div>

             </div>

         </div>

         <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
