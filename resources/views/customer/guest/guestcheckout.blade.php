@extends('layouts.frontend.app')

@section('title')
    {{$title}}
@endsection

@section('meta')

@endsection

@push('css')

@endpush

@section('content')

    @include('layouts.frontend.partial.breadcrumbcategory')
    <form action="{{ route('customer.guest-checkout.store') }}" method="POST">
        @csrf
        <section class="shipping-summary-section pt-20 pb-60">
            <div class="container">
                <div class="shipping-summary-wrapper">
                    <div class="shipping-area">
                        <div class="single-wrapper">
                            <h3 class="area-title">Shipping Address
                                <span class="d-block">(Please Fill Out Your Information)</span>
                            </h3>
                            <div class="address">
                                <div class="delivery-types">
                                    <label for="">Shipping to</label>
                                    <div class="type-wrapper">
                                        <span class="single-type">
                                            <input type="radio" id="home" name="shippingto" value="home" checked>
                                            <label for="home">home</label>
                                        </span>
                                        <span class="single-type">
                                            <input type="radio" id="office" name="shippingto" value="office">
                                            <label for="office">Office</label>
                                        </span>
                                    </div>
                                </div>
                                <div class="address-wrapper">
                                    <div class="single-input">
                                        <label for="name">Name: </label>
                                        <input id="name" name="shipping_name" required class="form-control" type="text" placeholder="Full Name">
                                    </div>
                                    <div class="single-input">
                                        <label for="email">Email Address: </label>
                                        <input id="email" name="shipping_email" required class="form-control" type="text" placeholder="Email Address">
                                    </div>
                                    <div class="single-input">
                                        <label for="phone">Phone Number: </label>
                                        <input id="phone" name="shipping_phone" readonly class="form-control" type="text" value="{{ $getPhone }}" placeholder="Phone">
                                    </div>
                                    <div class="single-input">
                                        <div class="row mx-0">
                                            <div class="col-6 px-3 ps-0">
                                                <label for="phone">City</label>
                                                <select name="shipping_division_id" id="billing_div_id" class="form-control" required>
                                                    <option  disabled value="" selected>Select One</option>
                                                    @foreach($divisions as $division)
                                                        <option value="{{ $division->id }}">{{ $division->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-6 px-3 pe-0">
                                                <label for="phone">Area</label>
                                                <select name="shipping_district_id" id="billing_dis_id" class="form-control" required>
                                                    <option disabled value="" selected>First select division</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-input">
                                        <label for="phone">Address</label>
                                        <textarea class="form-control" required name="shipping_address" placeholder="Your Address" cols="30" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="summary-area">
                        @php 
                            $total = 0;
                        @endphp
                        @if(session('cart'))
                            @foreach(session('cart') as $key => $checkoutDetails)
                                @php
                                    $total += $checkoutDetails['price'] * $checkoutDetails['quantity'];
                                @endphp
                                <input type="hidden" name="product_id[]" value="{{ $key }}">
                                <input type="hidden" name="quantity[]" value="{{ $checkoutDetails['quantity'] }}">
                                <input type="hidden" name="size_id[]" value="{{ $checkoutDetails['size_id'] }}">
                                <input type="hidden" name="color_id[]" value="{{ $checkoutDetails['color_id'] }}">
                            @endforeach
                        @endif
                        <h3 class="area-title">Checkout Summary</h3>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Subtotal </td>
                                    <input type="hidden" name="sub_total" id="sub_total" value="{{ $total }}">
                                    <td>{{ $total }} TK</td>
                                </tr>
                                <tr>
                                    <td>Shipping </td>
                                    <input type="hidden" name="shipping_amount" id="shipping_amount" value="">
                                    <td> <span id="delivery_amount"> 0 </span> TK</td>
                                </tr>
                                <tr>
                                    <td>Payable Total</td>
                                    <td><span id="grand_total">{{ $total }} </span> TK</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="accordion" id="promo">
                            <div class="accordion-item">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Add Promo code or Gift voucher
                                </button>
                                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#promo">
                                    <div class="accordion-body">
                                        <form action="">
                                            <input class="form-control" type="text">
                                            <button class="promo-btn" type="submit">apply</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="shipping-summary-wrapper mt-30">
                    <div class="shipping-area">
                        <div class="single-wrapper">
                            <h3 class="area-title">Payment Method
                                <span class="d-block">(Please Fill Out Your Information)</span>
                            </h3>
                            <div class="payment-types">
                                <div class="single-type">
                                    <div class="inner-type">
                                        <input id="cash" type="radio" name="payment_method" value="Cash" checked>
                                        <label for="cash">Cash on Delivery</label>
                                    </div>
                                </div>
                                <div class="single-type">
                                    <div class="inner-type">
                                        <input id="cards" type="radio" name="payment_method" value="Payment Cards">
                                        <label for="cards">
                                            <ul>
                                                <li><img src="{{asset('frontend/images/payments/1.jpg')}}" alt=""></li>
                                                <li><img src="{{asset('frontend/images/payments/2.jpg')}}" alt=""></li>
                                                <li><img src="{{asset('frontend/images/payments/3.jpg')}}" alt=""></li>
                                                <li><img src="{{asset('frontend/images/payments/4.jpg')}}" alt=""></li>
                                            </ul>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="shipping-area mt-20 bg-transparent border-0 p-0">
                        <div class="order-note">
                            <p>Note: In some cases, the price of your peace book / product may change from the supplier / supplier for various reasons. You may not get it from your family book / product publisher / supplier. We apologize for any inconvenience this person may have caused</p>
                        </div>
                        <div class="text-center mt-20">
                            <button class="navigation-btn" type="submit">Confirm Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
    <!-- End Shipping Summary Section -->
@endsection

@push('js')
    <script>
        // informaiton division
        $("#billing_div_id").on('change', function() {
            var billing_div_id = $("#billing_div_id").val();
            // alert(billing_div_id);
            var sub_total = $("#sub_total").val();
            // alert(sub_total);
            var grand_total = $("#grand_total").text();
            // alert(grand_total);
            if(billing_div_id){
                $.ajax({
                    url         : "{{ url('customer/division-distric/ajax') }}/" + billing_div_id ,
                    type        : 'GET',
                    dataType    : 'json',
                    success     : function(data) {
                        // console.log(data);
                        $("#billing_dis_id").empty();
                        $('#billing_dis_id').append('<option value=""> Select One </option>');
                        $("#vatDisplay").show();
                        $.each(data[0], function(key, value){
                            $('#billing_dis_id').append('<option value="'+ value.id +'">' + value.name + '</option>');
                        });
                        $("#delivery_amount").text(data[1]);
                        $("#shipping_amount").val(data[1]);
                        $("#grand_total").text(parseInt(data[1]) + parseInt(sub_total));
                    },
                });
            }else {
                alert("Select your division");
            };
        });
        // informaiton distric
        $("#billing_dis_id").on('change', function() {
            var billing_dis_id = $("#billing_dis_id").val();
            // alert(billing_dis_id);
            var sub_total = $("#sub_total").val();
            // alert(sub_total);
            var grand_total = $("#grand_total").text();
            // alert(grand_total);
            if(billing_dis_id){
                $.ajax({
                    url         : "{{ url('customer/distric-division/ajax') }}/" + billing_dis_id ,
                    type        : 'GET',
                    dataType    : 'json',
                    success     : function(data) {
                        console.log(data);
                        $("#delivery_amount").text(data[0]);
                        $("#shipping_amount").val(data[0]);
                        $("#grand_total").text(parseInt(data[0]) + parseInt(sub_total));
                    },
                });
            }else {
                alert("Select your distric");
            };
        });
    </script>

@endpush