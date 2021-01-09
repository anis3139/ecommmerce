@extends('client.layouts.app')

@section('content')
    <!-- catg header banner section -->
   @include('client.components.hero')
    <!-- / catg header banner section -->

    <!-- product category -->
    <section id="aa-product-details">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="aa-product-details-area">



                        <div class="aa-product-details-content">
                            <div class="row">
                                <!-- Modal view slider -->
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                    <div class="aa-product-view-slider">
                                        <div id="demo-1" class="simpleLens-gallery-container">

                                            <div class="simpleLens-container">
                                                <div class="simpleLens-big-image-container">
                                                    @foreach ($productDetails->img as $images)
                                                        @if ($loop->first)

                                                            <a data-lens-image="{{ $images->image_path }}"
                                                                class="simpleLens-lens-image"><img
                                                                    src="{{ $images->image_path }}"
                                                                    class="simpleLens-big-image">
                                                            </a>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="simpleLens-thumbnails-container">
                                                @foreach ($productDetails->img as $images)
                                                    <a data-big-image="{{ $images->image_path }}"
                                                        data-lens-image="{{ $images->image_path }}"
                                                        class="simpleLens-thumbnail-wrapper" href="#">
                                                        <img width="50px" height="50px" src="{{ $images->image_path }}">
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal view content -->
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <div class="aa-product-view-content">
                                        <h3>{!! $productDetails->product_title !!}</h3>
                                        <div class="aa-price-block">
                                            <span class="aa-product-view-price">&euro; &nbsp;{{ $productDetails->product_price }}</span>
                                            <p class="aa-product-avilability">Avilability: <span>
                                                    @if ($productDetails->product_in_stock == 1)
                                                        {{ 'In Stock' }}
                                                    @else
                                                        {{ 'Stock Out' }}
                                                    @endif
                                                </span></p>
                                        </div>
                                        <p> {!! nl2br(e( $productDetails->product_discription)) !!}</p>


                         <form action="{{ route('client.addCart') }}" id="cartForm" method="post">


                                   @if(count($productDetails->color)>0)
                                        <!-- Product Color -->
                                        <div class="product-color">
                                            <span >Color</span>

                                            <div class="color-choose mt-5">
                                                @foreach ($productDetails->color as $color)
                                                <div>
                                                    <input type="radio" id="{{$color->product_color_code}}" name="color" @if($loop->first){{"checked"}} @endif value="{{$color->product_color_code}}" >
                                                    <label for="{{$color->product_color_code}}"><span  style="background-color:{{$color->product_color_code}} "></span></label>
                                                </div>
                                                @endforeach


                                        </div>
                                    @endif

                                    <!-- Cable Configuration -->
                                    @if(count($productDetails->maserment)>0)
                                    <div class="product-color">
                                        <span >Mezerment</span>

                                        <div class="meserment-choose mt-5">
                                            @foreach ($productDetails->maserment as $maserment)
                                            <div>
                                                <input type="radio" id="{{$maserment->meserment_value}}" name="maserment" @if($loop->first){{"checked"}} @endif value="{{$maserment->meserment_value}}" >
                                                <label for="{{$maserment->meserment_value}}"><span style="background-color:#000;"></span></label>
                                                <span >{{$maserment->meserment_value}}</span>&ensp;
                                            </div>
                                            @endforeach
                                    </div>
                                    @endif

                                        <div class="aa-prod-quantity">
                                            <label for="quantity">Quantity:&ensp;</label>
                                                <select id="quantity" name="quantity">
                                                    <option value="1" selected>1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="10">10</option>
                                                </select>

                                            <p class="aa-prod-category">
                                                Category: <a href="#">{{ $productDetails->cat->name }}</a>
                                            </p>
                                        </div>
                                        <div class="aa-prod-view-bottom">
                                        {{-- <form action="{{ route('client.addCart') }}" id="cartForm"
                                            method="post"> --}}
                                            @csrf
                                            <input type="hidden" id="product_id" name="product_id"
                                                value="{{ $productDetails->id }}">
                                            <button type="submit" class="aa-add-to-cart-btn">Add To Cart</button>




                        </form>


                                            {{-- <a class="aa-add-to-cart-btn" href="#">Wishlist</a>
                                            <a class="aa-add-to-cart-btn" href="#">Compare</a> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="aa-product-details-bottom">
                            <ul class="nav nav-tabs" id="myTab2">
                                <li><a href="#description" data-toggle="tab">Description</a></li>
                                <li><a href="#review" data-toggle="tab">Reviews</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="description">
                                    <p>

                                        {!! $productDetails->product_discription !!}
                                    </p>
                                </div>
                                <div class="tab-pane fade " id="review">
                                    <div class="aa-product-review-area">
                                        <h4>2 Reviews for T-Shirt</h4>
                                        <ul class="aa-review-nav">
                                            <li>
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img class="media-object"
                                                                src="{{ asset('client') }}/img/testimonial-img-3.jpg"
                                                                alt="girl image">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h4 class="media-heading"><strong>Marla Jobs</strong> - <span>March
                                                                26, 2016</span></h4>
                                                        <div class="aa-product-rating">
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star-o"></span>
                                                        </div>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img class="media-object"
                                                                src="{{ asset('client') }}/img/testimonial-img-3.jpg"
                                                                alt="girl image">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h4 class="media-heading"><strong>Marla Jobs</strong> - <span>March
                                                                26, 2016</span></h4>
                                                        <div class="aa-product-rating">
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star-o"></span>
                                                        </div>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <h4>Add a review</h4>
                                        <div class="aa-your-rating">
                                            <p>Your Rating</p>
                                            <a href="#"><span class="fa fa-star-o"></span></a>
                                            <a href="#"><span class="fa fa-star-o"></span></a>
                                            <a href="#"><span class="fa fa-star-o"></span></a>
                                            <a href="#"><span class="fa fa-star-o"></span></a>
                                            <a href="#"><span class="fa fa-star-o"></span></a>
                                        </div>
                                        <!-- review form -->
                                        <form action="" class="aa-review-form">
                                            <div class="form-group">
                                                <label for="message">Your Review</label>
                                                <textarea class="form-control" rows="3" id="message"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" placeholder="Name">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email"
                                                    placeholder="example@gmail.com">
                                            </div>

                                            <button type="submit" class="btn btn-default aa-review-submit">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Related product -->
                        <div class="aa-product-related-item">
                            <h3>Related Products</h3>


                            <ul class="aa-product-catg aa-related-item-slider">
                                <!-- start single product item -->
                                @php
                                $relProducts=App\Models\product_table::with('img')->where('product_category_id',
                                $productDetails->product_category_id)->where('product_active',
                                1)->take(12)->inRandomOrder()->get();
                                @endphp

                                @foreach ($relProducts as $relProduct)
                                    <li>
                                        <figure>
                                            <a class="aa-product-img" href="{{ route('client.showProductDetails', ['slug' => $relProduct->product_slug]) }}">

                                                @php  $i= 1; @endphp

                                            @foreach ($relProduct->img as $images)
                                               @if ($i > 0)

                                               <img src="{{$images->image_path}}" alt="polo shirt img" width="250px" height="300px">

                                               @endif
                                               @php $i--; @endphp
                                            @endforeach


                                            </a>
                                            <a class="aa-add-card-btn" href="#"><span class="fa fa-shopping-cart"></span>Add
                                                To
                                                Cart
                                            </a>
                                            <figcaption>
                                                <h4 class="aa-product-title"><a
                                                        href="{{ route('client.showProductDetails', ['slug' => $relProduct->product_slug]) }}">{!!
                                                        $relProduct->product_title !!}</a></h4>
                                                <span class="aa-product-price">&euro; &nbsp;{{ $relProduct->product_price }}</span><span
                                                    class="aa-product-price"><del>&euro; &nbsp;{{ $relProduct->product_selling_price }}</del></span>
                                            </figcaption>
                                        </figure>
                                        {{-- <div class="aa-product-hvr-content">
                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                                            <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span
                                                    class="fa fa-exchange"></span></a>
                                            <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View"
                                                data-toggle="modal" data-target="#quick-view-modal"><span
                                                    class="fa fa-search"></span></a>
                                        </div> --}}
                                        <!-- product badge -->
                                        @if ($relProduct->product_in_stock)
                                        <span class="aa-badge aa-sale" href="#">
                                            SALE!
                                        </span>
                                    @else
                                        <span class="aa-badge aa-sold-out" href="#">Sold Out!</span>
                                    @endif
                                    </li>
                                @endforeach

                                <!-- start single product item -->

                            </ul>

                            <!-- quick view modal -->
                            <div class="modal fade" id="quick-view-modal" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                            <div class="row">
                                                <!-- Modal view slider -->
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="aa-product-view-slider">
                                                        <div class="simpleLens-gallery-container" id="demo-1">
                                                            <div class="simpleLens-container">
                                                                <div class="simpleLens-big-image-container">
                                                                    <a class="simpleLens-lens-image"
                                                                        data-lens-image="{{ asset('client') }}/img/view-slider/large/polo-shirt-1.png">
                                                                        <img src="{{ asset('client') }}/img/view-slider/medium/polo-shirt-1.png"
                                                                            class="simpleLens-big-image">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="simpleLens-thumbnails-container">
                                                                <a href="#" class="simpleLens-thumbnail-wrapper"
                                                                    data-lens-image="{{ asset('client') }}/img/view-slider/large/polo-shirt-1.png"
                                                                    data-big-image="{{ asset('client') }}/img/view-slider/medium/polo-shirt-1.png">
                                                                    <img
                                                                        src="{{ asset('client') }}/img/view-slider/thumbnail/polo-shirt-1.png">
                                                                </a>
                                                                <a href="#" class="simpleLens-thumbnail-wrapper"
                                                                    data-lens-image="{{ asset('client') }}/img/view-slider/large/polo-shirt-3.png"
                                                                    data-big-image="{{ asset('client') }}/img/view-slider/medium/polo-shirt-3.png">
                                                                    <img
                                                                        src="{{ asset('client') }}/img/view-slider/thumbnail/polo-shirt-3.png">
                                                                </a>

                                                                <a href="#" class="simpleLens-thumbnail-wrapper"
                                                                    data-lens-image="{{ asset('client') }}/img/view-slider/large/polo-shirt-4.png"
                                                                    data-big-image="{{ asset('client') }}/img/view-slider/medium/polo-shirt-4.png">
                                                                    <img
                                                                        src="{{ asset('client') }}/img/view-slider/thumbnail/polo-shirt-4.png">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal view content -->
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="aa-product-view-content">
                                                        <h3>T-Shirt</h3>
                                                        <div class="aa-price-block">
                                                            <span class="aa-product-view-price">$34.99</span>
                                                            <p class="aa-product-avilability">Avilability: <span>In
                                                                    stock</span></p>
                                                        </div>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                                            Officiis animi, veritatis quae repudiandae quod nulla porro
                                                            quidem, itaque quis quaerat!</p>
                                                        <h4>Size</h4>
                                                        <div class="aa-prod-view-size">
                                                            <a href="#">S</a>
                                                            <a href="#">M</a>
                                                            <a href="#">L</a>
                                                            <a href="#">XL</a>
                                                        </div>
                                                        <div class="aa-prod-quantity">
                                                            <form action="">
                                                                <select name="" id="">
                                                                    <option value="0" selected="1">1</option>
                                                                    <option value="1">2</option>
                                                                    <option value="2">3</option>
                                                                    <option value="3">4</option>
                                                                    <option value="4">5</option>
                                                                    <option value="5">6</option>
                                                                </select>
                                                            </form>
                                                            <p class="aa-prod-category">
                                                                Category: <a href="#">Polo T-Shirt</a>
                                                            </p>
                                                        </div>
                                                        <div class="aa-prod-view-bottom">
                                                            <a href="#" class="aa-add-to-cart-btn"><span
                                                                    class="fa fa-shopping-cart"></span>Add To Cart</a>
                                                            <a href="#" class="aa-add-to-cart-btn">View Details</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div>
                            <!-- / quick view modal -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / product category -->

@endsection
