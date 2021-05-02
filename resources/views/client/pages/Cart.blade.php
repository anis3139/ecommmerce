@extends('client.layouts.app')

@section('content')

    <section id="page-title">

        <div class="container">
            <h1>Cart</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cart</li>
            </ol>
        </div>

    </section><!-- #page-title end -->

    <!-- Content
                                                                                      ============================================= -->
    <section id="content">
        <div class="content-wrap">
            <div class="container">

                <table class="table table-bordered table-striped table-hover cart mb-5">
                    <thead>
                        <tr>
                            <th class="cart-product-remove">&nbsp;</th>
                            <th class="cart-product-thumbnail">Image</th>
                            <th class="cart-product-name">Product</th>
                            <th class="cart-product-price">Unit Price</th>
                            <th class="cart-product-quantity">Quantity</th>
                            <th class="cart-product-color">Color</th>
                            <th class="cart-product-mesement">Meserment</th>
                            <th class="cart-product-subtotal">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $key => $cartItem)
                            <tr class="cart_item">
                                <td class="cart-product-remove">
                                    <form action="{{ route('client.cartRemove') }}" method="post">
                                        @csrf
                                        <input type="hidden" value="{{ $key }}" name="product_id">
                                        <button class="remove" title="Remove this item" type="submit"
                                            style="border: none; background-color:#fff;"><i
                                                class="icon-trash2"></i></button>
                                    </form>
                                </td>

                                <td class="cart-product-thumbnail">
                                    <a href="#"><img width="64" height="64" src="{{ $cartItem['image'] }}"
                                            alt="Pink Printed Dress"></a>
                                </td>

                                <td class="cart-product-name">
                                    <a
                                        href="{{ route('client.showProductDetails', ['slug' => $cartItem['slug']]) }}">{{ $cartItem['title'] }}</a>
                                </td>

                                <td class="cart-product-price">
                                    <span class="amount">&#2547; {{ number_format($cartItem['unit_price']), 2 }}</span>
                                </td>


                                <td class="cart-product-quantity">
                                    <div class="quantity">

                                        <form action="{{ route('client.cartUpdate') }}" method="post">
                                            @csrf
                                            <input type="hidden" value="{{ $key }}" name="product_update_id">
                                            <input style="width: 50px" type="number" value="{{ $cartItem['quantity'] }}"
                                                name="quantity" min="1" max="1000"
                                                onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 46 ? true : !isNaN(Number(event.key))">
                                            <button type="submit"
                                                style="background-color: #dad9d1; color:#ff6666; margin:5px 0px 0px 5px;"><i
                                                    style="font-size:15px;" class="icon-ok"></i></button>
                                        </form>
                                    </div>
                                </td>

                                <td class="cart-product-color text-center hidden-xs">
                                    @if ($cartItem['maserment'])

                                        <div class="text-center"
                                            style=" width:20px; height:20px; border:1px solid #000; border-radius:50%; background-color: {{ $cartItem['color'] }};">
                                        </div>
                                    @else
                                        {{ 'N/A' }}
                                    @endif
                                </td>
                                <td class="cart-product-mesement">
                                    @if ($cartItem['maserment'])
                                        {{ $cartItem['maserment'] }}
                                    @else
                                        {{ 'N/A' }}
                                    @endif
                                </td>

                                <td class="cart-product-subtotal">
                                    <span class="amount">&#2547; {{ number_format($cartItem['total_price'], 2) }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

                <div class="row col-mb-30">
                    <div class="col-lg-6">
                        <div class="col-12 form-group">
                            <a href="{{ route('client.ClearCart') }}" class="btn btn-danger">Clear All</a>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <h4>Cart Totals</h4>

                        <div class="table-responsive">
                            <table class="table cart cart-totals">
                                <tbody>
                                    <tr class="cart_item">
                                        <td class="cart-product-name">
                                            <strong>Total</strong>
                                        </td>

                                        <td class="cart-product-name">
                                            <span class="amount color lead"><strong> &#2547;
                                                    {{ number_format($total, 2) }}</strong></span>
                                        </td>
                                    </tr>
                                    <tr class="cart_item">
                                        <td class="cart-product-name">
                                            <div class="col-12 form-group mt-5">
                                                <a href="{{ route('client.checkout') }}"
                                                    class="button button-3d m-0 button-black text-light">Process
                                                    Checkout</a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section><!-- #content end -->
@endsection
@section('script')
    <script>

getcartData()

function getcartData() {

    axios.get("{{ route('client.cartData') }}")
        .then(function(response) {

            if (response.status = 200) {
                var dataJSON = response.data;
                var cartData = dataJSON.cart;

                var a = Object.keys(cartData).length;


                $("#cart_quantity").html(a);
                var tp = parseFloat(dataJSON.total).toFixed(2);
                $("#total_cart_price").html(' &#2547; ' + tp);

                var imageViewHtml = "";
                $.each(cartData, function(i, item) {
                    imageViewHtml += `<div class="top-cart-item">
                                         <div class="top-cart-item-image">
                                             <a href="#"><img src="${cartData[i].image}"
                                                     alt="Blue Round-Neck Tshirt" /></a>
                                         </div>
                                         <div class="top-cart-item-desc">
                                             <div class="top-cart-item-desc-title">
                                                 <a href="#">${cartData[i].title}</a>
                                                 <span class="top-cart-item-price d-block"> ${cartData[i].quantity} x &#2547; ${cartData[i].unit_price}</span>
                                             </div>
                                             <div class="top-cart-item-quantity"><button class="cartDeleteIcon" data-id="${i}" type="submit"><i class="icon-remove"> </i></button></div>
                                         </div>
                                </div>`
                });


                $('.top-cart-items').html(imageViewHtml);

                console.log(a);

                if (a == 0) {
                    $("#HeaderPreview").css("display", "none");
                } else {
                    $("#HeaderPreview").css("display", "block");
                }


                //Carts click on delete icon
                $(".cartDeleteIcon").click(function() {
                    var id = $(this).data('id');
                    $('#CartsDeleteId').html(id);
                    DeleteDataCart(id);
                })
            } else {
                toastr.error('Something Went Wrong');
            }
        }).catch(function(error) {

            toastr.error('Something Went Wrong...');
        });
}












$('#confirmDeleteCart').click(function() {


    alert("hello")
    var id = $(this).data('id');
    DeleteDataCart(id);
})


//delete Cart function
function DeleteDataCart(id) {

    axios.post("{{ route('client.cartRemove') }}", {
            product_id: id
        })
        .then(function(response) {

            if (response.status == 200) {
                toastr.success('Cart Removed Success.');
                getcartData();
            } else {
                toastr.error('Something Went Wrong');
            }
        }).catch(function(error) {

            toastr.error('Something Went Wrong......');
        });
}
    </script>
@endsection
