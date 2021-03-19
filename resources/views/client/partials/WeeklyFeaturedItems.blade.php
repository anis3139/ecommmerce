 <div class="fancy-title title-border mt-4 title-center">
     <h4>Weekly Featured Items</h4>
 </div>

 <div id="oc-products" class="owl-carousel products-carousel carousel-widget" data-margin="20" data-loop="true"
     data-autoplay="5000" data-nav="true" data-pagi="false" data-items-xs="1" data-items-sm="2" data-items-md="3"
     data-items-lg="4" data-items-xl="5">

     @foreach ($featureProducts as $featureProduct)
         <!-- Shop Item 1 ============================================= -->
         <div class="oc-item">
             <div class="product">
                 <div class="product-image">
                     @php $i= 2; @endphp
                     @foreach ($featureProduct->img as $images)
                         @if ($i > 0)
                             <a
                                 href="{{ route('client.showProductDetails', ['slug' => $featureProduct->product_slug]) }}"><img
                                     src="{{ $images->image_path }}" alt="Round Neck T-shirts"></a>
                         @endif
                         @php $i--; @endphp
                     @endforeach
                     @if ($featureProduct->product_in_stock)
                         <div class="sale-flash badge badge-danger p-2">Sale!</div>
                     @else
                         <div class="sale-flash badge badge-secondary p-2">Out of Stock!</div>
                     @endif
                     
                     <div class="bg-overlay">
                         <div class="bg-overlay-content align-items-end justify-content-between"
                             data-hover-animate="fadeIn" data-hover-speed="400">
                             <a href="#" class="btn btn-dark mr-2"><i class="icon-shopping-basket"></i></a>
                             <a href="{{ route('client.modal') }}"
                                 onclick="productDetailsModal({{ $featureProduct->id }})" class="btn btn-dark"
                                 data-lightbox="ajax"><i class="icon-line-expand"></i></a>
                         </div>
                         <div class="bg-overlay-bg bg-transparent"></div>
                     </div>
                 </div>
                 <div class="product-desc">
                     <div class="product-title mb-1">
                         <h3><a href="{{ $featureProduct->product_slug }}">{{ $featureProduct->product_title }}</a>
                         </h3>
                     </div>
                     <div class="product-price font-primary">
                         @if ($featureProduct->product_price != $featureProduct->product_selling_price)<del
                                 class="mr-1">&#2547; {{ $featureProduct->product_price }}</del>@endif <ins>&#2547; {{ $featureProduct->product_selling_price }}</ins>
                     </div>
                     <div class="product-rating">
                         <i class="icon-star3"></i>
                         <i class="icon-star3"></i>
                         <i class="icon-star3"></i>
                         <i class="icon-star-half-full"></i>
                         <i class="icon-star-empty"></i>
                     </div>
                 </div>
             </div>
         </div>

     @endforeach
 </div>
