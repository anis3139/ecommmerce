@extends('admin.Layouts.app')
@section('title', 'Order')
@section('css')
    <style>
        .modal-dialog-full-width {
            width: 90% !important;
            height: 90% !important;

            padding: 20px !important;
            max-width: none !important;
            margin: 0px auto;

        }

        .modal-content-full-width {
            height: auto !important;
            min-height: 100% !important;
            border-radius: 0 !important;
            background-color: #ececec !important
        }

        .modal-header-full-width {
            border-bottom: 1px solid #9ea2a2 !important;
        }

        .modal-footer-full-width {
            border-top: 1px solid #9ea2a2 !important;
        }



    </style>

@endsection
@section('content')

    <div class="row mt-5 px-5">
        <div class="col-md-12 py-3">
            <form class="float-right" action="{{ route('admin.excelExport') }}" method="post">
                @csrf
                <input required type="date" value="{{date('Y-m-d')}}" name="time" id="time">
                <button type="submit" class="btn btn-learge btn-primary"><i class="fas fa-file-excel"></i> Excel
                    Export</button>
            </form>
        </div>
        <div class="col-md-12 border border-dark">

            <div id="mainDivOrders" class="container-fluid">
                <div class="row">
                    <div class="col-md-12 px-2 ">

                        <table id="OrdersDataTable" class="table table-striped table-bordered" width="100%">
                            <thead class="text-center">
                                <tr>
                                    <th class="th-xs">Order No.</th>
                                    <th class="th-xs">Customer Name</th>
                                    <th class="th-xs">Customer Phone</th>
                                    <th class="th-xs">Address</th>
                                    <th class="th-xs">City</th>
                                    <th class="th-xs">District</th>
                                    <th class="th-xs">Delivery Status</th>
                                    <th class="th-xs">paid Amount</th>
                                    <th class="th-xs">Issued Time</th>
                                    <th class="th-xs">View</th>
                                    <th class="th-xs">Print</th>
                                </tr>
                            </thead>
                            <tbody id="Orders_Table">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div id="loadDivOrders" class="container">
                <div class="row">
                    <div class="col-md-12 p-5 text-center">
                        <img class="loding-icon m-5" src="{{ asset('loader.svg') }}" alt="">

                    </div>
                </div>
            </div>
            <div id="wrongDivOrders" class="container d-none">
                <div class="row">
                    <div class="col-md-12 p-5 text-center">
                        <h3>Something Went Wrong!</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>






    <!--View  Modal -->

    <div class="modal fade right" id="viewOrdersModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
        <div class="modal-dialog-full-width modal-dialog momodel modal-fluid" role="document">
            <div class="modal-content-full-width modal-content ">
                <div class=" modal-header-full-width   modal-header text-center">
                    <h5 class="modal-title w-100" id="exampleModalPreviewLabel">Products Order View</h5>
                    <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                        <span style="font-size: 1.3em;" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 id="OrdersViewId" class="mt-4 d-none"></h5>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5 text-center">
                                <h2>Order Details</h2>
                                <table class="table table-bordered">
                                    <tr>
                                        <td style="max-width:200px !important;">Order ID</td>
                                        <td id="id"></td>
                                    </tr>

                                    <tr>
                                        <td style="max-width:200px !important;">Customer Name</td>
                                        <td id="customer_name"></td>
                                    </tr>
                                    <tr>
                                        <td style="max-width:200px !important;">Customer Phone no</td>
                                        <td id="customer_phone_number"></td>
                                    </tr>
                                    <tr>
                                        <td style="max-width:200px !important;">Shipping Address</td>
                                        <td id="address"></td>
                                    </tr>
                                    <tr>
                                        <td style="max-width:200px !important;">Shipping City</td>
                                        <td id="city"></td>
                                    </tr>
                                    <tr>
                                        <td style="max-width:200px !important;">Shipping District</td>
                                        <td id="district"></td>
                                    </tr>

                                    <tr>
                                        <td style="max-width:200px !important;">Shipping Country</td>
                                        <td id="country"></td>
                                    </tr>

                                    <tr>
                                        <td style="max-width:200px !important;">Price Without Discount</td>
                                        <td id="price_without_discount"> </td>
                                    </tr>

                                    <tr>
                                        <td style="max-width:200px !important;">Discount Amount</td>
                                        <td id="discount_amount"> </td>
                                    </tr>

                                    <tr>
                                        <td style="max-width:200px !important;">Sub Total</td>
                                        <td id="total_amount"> </td>
                                    </tr>

                                    <tr>
                                        <td style="max-width:200px !important;">Total Tax</td>
                                        <td id="total_tax"> </td>
                                    </tr>
                                    <tr>
                                        <td style="max-width:200px !important;">Delivery Charge</td>
                                        <td id="total_delivery_charge"> </td>
                                    </tr>
                                    <tr>
                                        <td style="max-width:200px !important;">Cupon Discount</td>
                                        <td id="total_cupon_discount"> </td>
                                    </tr>
                                    <tr>
                                        <td style="max-width:200px !important;">Grand Total </td>
                                        <td id="paid_amount"> </td>
                                    </tr>

                                    <tr>
                                        <td style="max-width:200px !important;">Payment Details </td>
                                        <td id="payment_details"> </td>
                                    </tr>

                                    <tr>
                                        <td style="max-width:200px !important;">Transection ID </td>
                                        <td id="transection_id"> </td>
                                    </tr>
                                    <tr>
                                        <td style="max-width:200px !important;">Order Issued </td>
                                        <td id="order_issued"> </td>
                                    </tr>

                                </table>

                            </div>
                            <div class="col-md-7 text-center">
                                <h2>Ordered Product Details</h2>
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <th>SL</th>
                                        <th>Product Id</th>
                                        <th>Product Name</th>
                                        <th>Product Color</th>
                                        <th>Product Maserment</th>
                                        <th>Product Quantity</th>
                                        <th>Note 1</th>
                                        <th>Note 2</th>
                                        <th>Product Unit Price</th>
                                    </thead>
                                    <tbody id="OrdersView">

                                    </tbody>
                                    <tfoot>

                                        <tr>
                                            <td colspan="8" style="max-width:200px !important;">Total Tax</td>
                                            <td id="tax"> </td>
                                        </tr>

                                        <tr>
                                            <td colspan="8" style="max-width:200px !important;">Delivery Charge</td>
                                            <td id="delivary_charge"> </td>
                                        </tr>

                                        <tr>
                                            <td colspan="8" class="total_price">Total Price</td>
                                            <td id="total_price" class="font-weight-bold"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="card">
                                    <div class="card-header">
                                        <h2>Order Status</h2>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('admin.ordersStatusUpdate') }}" method="post"
                                            id="product_status_form">
                                            @csrf
                                            <div class="form-group" id="shipping">
                                                <input type="text" id="shippingID" name="shippingID" class="form-control" placeholder="Shipping ID">
                                            </div>
                                            <div class="form-group">
                                                <select id="delivery_status"
                                                    class="browser-default custom-select">
                                                    <option value="Pending">Pending</option>
                                                    <option value="Processing">Processing</option>
                                                    <option value="On Shipping">On Shipping</option>
                                                    <option value="Cancelled">Cancelled</option>
                                                    <option value="Delivered">Delivered</option>
                                                </select>
                                            </div>
                                            <input type="hidden" id="delivery_status_id">
                                            <input type="submit" value="Update" class="btn btn-success btn-block">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



@endsection
@section('script')

    <script type="text/javascript" src="{{ asset('admin/js/yearpicker.js') }}"></script>
    <script>
        $('#OrdersDataTable').DataTable()








        getOrdersdata();

        function getOrdersdata() {
            axios.get("{{ route('admin.getOrdersData') }}")
                .then(function(response) {

                    if (response.status = 200) {
                        $('#mainDivOrders').removeClass('d-none');
                        $('#loadDivOrders').addClass('d-none');
                        $('#OrdersDataTable').DataTable().destroy();
                        $('#Orders_table').empty();
                        var dataJSON = response.data;



                        var table = "";
                        for (let trableData = 0; trableData < dataJSON.length; trableData++) {
                            const element = dataJSON[trableData];
                            let issuedTime = moment(element.created_at).format('DD-MMM-YYYY hh:mm A')
                            table += '<tr>';
                            table += '<td style="max-width:100px; overflow-wrap: break-word;">' + (element
                                .order_id) +
                                '</td>';
                            table += '<td style="max-width:100px; overflow-wrap: break-word;">' + element
                                .customer_name + '</td>';
                            table += '<td style="max-width:100px; overflow-wrap: break-word;">' + element
                                .customer_phone_number + '</td>';
                            table += '<td style="max-width:100px; overflow-wrap: break-word;">' + element.address +
                                '</td>';
                            table += '<td style="max-width:100px; overflow-wrap: break-word;">' + element.city +
                                '</td>';
                            table += '<td style="max-width:100px; overflow-wrap: break-word;">' + element.district +
                                '</td>';
                            table += '<td style="max-width:100px; overflow-wrap: break-word;">' + element
                                .delivery_status + '</td>';
                            table += '<td style="max-width:100px; overflow-wrap: break-word;">' + element.paid_amount +
                                '</td>';
                            table += '<td style="max-width:100px; overflow-wrap: break-word;">' + issuedTime + '</td>';
                            table += '<td><a class="OrdersView" data-id=' + element.id +
                                '><i class="fas fa-eye"></i></a></td>';
                            table += '<td><a href="ordersPrint/' + element.id +
                                '"><i class="fas fa-print"></i></a></td>';
                            table += '</tr>'
                        }
                        $('#Orders_Table').html(table);



                        //Order View icon click

                        $(".OrdersView").click(function() {
                            var id = $(this).data('id');
                            $('#OrdersViewId').html(id);
                            $('#viewOrdersModal').modal('show');
                            OrdersViewDetails(id);
                        })
                        $('#OrdersDataTable').DataTable({
                            "order": true
                        });

                        $('.dataTables_length').addClass('bs-select');

                    } else {
                        $('#wrongDivOrders').removeClass('d-none');
                        $('#loadDivOrders').addClass('d-none');

                    }
                }).catch(function(error) {
                    console.log(error);

                    $('#wrongDivOrders').removeClass('d-none');
                    $('#loadDivOrders').addClass('d-none');
                });

        }






        function OrdersViewDetails(id) {
            axios.post("{{ route('admin.ordersView') }}", {
                    id: id
                })
                .then(function(response) {
                  
                    if (response.status == 200) {
                          
                        $('#loadDivOrders').addClass('d-none');
                        $('#OrdersEditForm').removeClass('d-none');

                        var dataJSON = response.data;
                        $('#id').html(dataJSON[0].order_id)
                        $('#customer_name').html(dataJSON[0].customer_name)
                        $('#customer_phone_number').html(dataJSON[0].customer_phone_number)
                        $('#address').html(dataJSON[0].address)
                        $('#city').html(dataJSON[0].city)
                        $('#district').html(dataJSON[0].district)
                        $('#country').html(dataJSON[0].country)
                        $('#postal_code').html(dataJSON[0].postal_code)
                        $('#price_without_discount').html(dataJSON[0].price_without_discount);
                        $('#discount_amount').html(dataJSON[0].discount_amount);
                        $('#total_amount').html(dataJSON[0].total_amount)
                        $('#paid_amount').html(dataJSON[0].paid_amount);
                        $('#payment_details').html(dataJSON[0].payment_details);
                        $('#total_tax').html(dataJSON[0].total_tax);
                        $('#total_delivery_charge').html(dataJSON[0].total_delivery_charge);
                        $('#total_price').html('&#2547;  ' + dataJSON[0].paid_amount);
                        $('#tax').html(dataJSON[0].total_tax);
                        $('#delivary_charge').html(dataJSON[0].total_delivery_charge);
                        $('#transection_id').html(dataJSON[0].transection_id);
                        $('#order_issued').html(moment(dataJSON[0].created_at).format('DD-MMM-YYYY hh:mm A'));
                        $('#total_cupon_discount').html(dataJSON[0].total_cupon_discount);
                        $('#shippingID').val(dataJSON[0].shipping_id);


                        $('#delivery_status_id').val(dataJSON[0].id);

                        $('#delivery_status option[value=' + dataJSON[0].delivery_status + ']').attr('selected',
                            'selected');




                        var productViewHTML = "";
                        for (let index = 0; index < dataJSON[0].order_product.length; index++) {
                            const element = dataJSON[0].order_product[index];
                            productViewHTML += '<tr>';
                            productViewHTML += '<td>' + (index + 1) + '</td>';
                            productViewHTML += '<td clsss="mx-auto" >' + element.product.product_id + '</td>';
                            productViewHTML += '<td clsss="mx-auto" >' + element.product.name + '</td>';
                            if (element.color) {
                                productViewHTML +=
                                    '<td style="display:flex; justify-content:center; align-items: center;"><div>' +
                                    element.color + '</div></td>';
                            } else {
                                productViewHTML += '<td clsss="mx-auto" >N/A</td>';
                            }
                            if (element.maserment) {
                                productViewHTML += '<td clsss="mx-auto" >' + element.maserment + '</td>';
                            } else {
                                productViewHTML += '<td clsss="mx-auto" >N/A</td>';
                            }
                            productViewHTML += '<td clsss="mx-auto" >' + element.quantity + '</td>';
                            if (element.note1) {
                            productViewHTML +=
                                '<td clsss="mx-auto" style="max-width:80px; overflow-wrap: break-word;" >' + element
                                .note1 + '</td>';
                            } else {
                                productViewHTML += '<td clsss="mx-auto" >N/A</td>';
                            }
                            if (element.note2) {
                            productViewHTML += '<td clsss="mx-auto" style="max-width:80px; overflow-wrap: break-word;">' +
                                element.note2 + '</td>';
                            } else {
                                productViewHTML += '<td clsss="mx-auto" >N/A</td>';
                            }
                            productViewHTML += '<td clsss="mx-auto" >&#2547;  ' + element.price + '</td>';
                            productViewHTML += '</tr>';
                        }
                        $('#OrdersView').html(productViewHTML);


                    } else {
                        $('#loadDivOrders').addClass('d-none');
                        $('#wrongDivOrders').removeClass('d-none');

                    }
                }).catch(function(error) {
                    $('#loadDivOrders').addClass('d-none');
                    $('#wrongDivOrders').removeClass('d-none');
                    console.log(error);
                });
        }
        $(document).ready(function() {
            var targetBox = $('#shipping');
            targetBox.hide();
            $('#delivery_status').change(function() {
                var delivery_status = $('#delivery_status').val();
                if(delivery_status == 'On Shipping'){
                     $('#shippingID').prop("required", true)
                     $(targetBox).show();
                }else{
                     $('#shippingID').removeAttr("required")
                    $(targetBox).hide();
                }
            });
        });

        $('#product_status_form').submit(function(event) {
            event.preventDefault();
            var delivery_status = $('#delivery_status').val()
            var delivery_status_id = $('#delivery_status_id').val()
            var shippingID = $('#shippingID').val()
            let url = " {{ route('admin.ordersStatusUpdate') }}";

           if( delivery_status == "On Shipping"){
                if(shippingID.length == 0 ){
                    toastr.info('Shipping id is Empty.', 'Error', {
                            closeButton: true,
                            progressBar: true,
                        });
                }else{
                    axios.post(url, {
                    id: delivery_status_id,
                    delivery_status: delivery_status,
                    shippingID: shippingID,
                }).then(function(response) {
                    if (response.status == 200 && response.data == 1) {
                        toastr.success('Update Success.', 'Success', {
                            closeButton: true,
                            progressBar: true,
                        });

                        $('#viewOrdersModal').modal('hide');
                        getOrdersdata();

                    } else {
                        toastr.error('Update Fail ! Try Again');
                        getOrdersdata();
                    }
                }).catch(function(error) {
                    toastr.error('Update Fail ! Try Again');
                })
                }
           }else{
                axios.post(url, {
                    id: delivery_status_id,
                    delivery_status: delivery_status,
                    shippingID: shippingID,
                }).then(function(response) {
                    if (response.status == 200 && response.data == 1) {
                        toastr.success('Update Success.', 'Success', {
                            closeButton: true,
                            progressBar: true,
                        });

                        $('#viewOrdersModal').modal('hide');
                        getOrdersdata();

                    } else {
                        toastr.error('Update Fail ! Try Again');
                        getOrdersdata();
                    }
                }).catch(function(error) {
                    toastr.error('Update Fail ! Try Again');
                })
           }
        })









    </script>

@endsection
