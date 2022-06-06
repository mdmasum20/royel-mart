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

<section class="shipping-summary-section pt-20 pb-60">
    <div class="address-area">
        <div class="addresses">
            @foreach($shipping_addresses as $shipping_address)
                <div class="modal fade" id="edit-form{{$shipping_address->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="edit-form">
                                <form action="{{ route('customer.shippingaddress.update', $shipping_address->id) }}" class="address">
                                    @csrf
                                    <div class="delivery-types">
                                        <label for="">Shipping your product to</label>
                                        <div class="type-wrapper">
                                            <span class="single-type">
                                                <input type="radio" id="home{{$shipping_address->id}}" value="home" name="shipping_to" @if($shipping_address->shipping_to == 'home') checked @endif>
                                                <label for="home{{$shipping_address->id}}">home</label>
                                            </span>
                                            <span class="single-type">
                                                <input type="radio" id="office{{$shipping_address->id}}" value="office" name="shipping_to" @if($shipping_address->shipping_to == 'office') checked @endif>
                                                <label for="office{{$shipping_address->id}}">Office</label>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="address-wrapper">
                                        <div class="single-input">
                                            <label for="name">Name </label>
                                            <input id="name" class="form-control" type="text" name="shipping_name" value="{{ $shipping_address->shipping_name }}">
                                        </div>
                                        <div class="single-input">
                                            <label for="phone">Email Address </label>
                                            <input id="phone" class="form-control" type="text" name="shipping_email" value="{{ $shipping_address->shipping_email }}">
                                        </div>
                                        <div class="single-input">
                                            <label for="phone">Phone Number </label>
                                            <input id="phone" class="form-control" type="text" name="shipping_phone" value="{{ $shipping_address->shipping_phone }}">
                                        </div>

                                        <div class="single-input">
                                            <label for="phone">Division</label>
                                            <select name="update_division_id" id="division_id_{{ $shipping_address->id }}" class="form-control" onchange="updateCngDiv({{ $shipping_address->id }})" required>
                                                <option  disabled selected>Select One</option>
                                                @foreach($divisions as $division)
                                                    <option value="{{ $division->id }}" @if($division->id == $shipping_address->shipping_division_id) selected @endif>{{ $division->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="single-input">
                                            <label for="phone">Division</label>
                                            <select name="update_district_id" id="district_id_{{ $shipping_address->id }}" class="form-control" onchange="updateCngDis({{ $shipping_address->id }})" required>
                                                <option disabled selected>select district</option>
                                                @foreach($districts as $district)
                                                    <option value="{{ $district->id }}" @if($district->id == $shipping_address->shipping_district_id) selected @endif>{{ $district->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="single-input">
                                            <label for="phone">Area</label>
                                            <select name="update_area_id" id="area_id_{{ $shipping_address->id }}" class="form-control" required>
                                                <option disabled selected>select area</option>
                                                @foreach($areas as $area)
                                                    <option value="{{ $area->id }}" @if($area->id == $shipping_address->shipping_area_id) selected @endif>{{ $area->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="single-input">
                                            <label for="Address">Address</label>
                                            <textarea class="form-control" name="shipping_address" id="" placeholder="Address" cols="30" rows="1">{{ $shipping_address->shipping_address }}</textarea>
                                        </div>
                                    </div>
                                    <div class="text-center mt-2">
                                        <button type="submit" class="save-address">save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <form action="{{ route('customer.checkout.store') }}" method="POST" id="order_check_out">
        @csrf
        <div class="container">
            <div class="shipping-summary-wrapper">
                <div class="shipping-area">
                    <div class="single-wrapper">
                        <h3 class="area-title">Shipping Address
                            <span class="d-block">(Please Fill Out Your Information)</span>
                        </h3>
                        <div class="address-area">
                            <div class="addresses">
                                @foreach($shipping_addresses as $shipping_address)
                                    <div class="single-address">
                                        <div class="address-head">
                                            <div class="label-area">
                                                <input type="radio" id="address{{$shipping_address->id}}" name="shipp_to_id" value="{{$shipping_address->id}}" onclick="selectShippAddress({{$shipping_address->id}})">
                                                <label for="address{{$shipping_address->id}}">address one</label>
                                            </div>
                                            <div class="edit-area">
                                                <button type="button" class="edit-trigger" data-bs-toggle="modal" data-bs-target="#edit-form{{$shipping_address->id}}">
                                                    <i class="bi bi-pencil-square"></i>
                                                    edit
                                                </button>
                                                <a href="{{ route('customer.deleteshipping.address', $shipping_address->id) }}" onclick="return confirm('Are you sure, you want delete this shipping address ? ')" class="remove-trigger">
                                                    <i class="bi bi-trash"></i>
                                                    delete
                                                </a>
                                            </div>
                                        </div>
                                        <div class="address-body">
                                            <div class="address-wrapper">
                                                <p><label for="">Shipping To : </label><span>Home</span></p>
                                                <p><label for="">name : </label><span>{{ $shipping_address->shipping_name }}</span></p>
                                                <p><label for="">Phone : </label><span>{{ $shipping_address->shipping_phone }}</span></p>
                                                <p><label for="">Mail : </label><span>{{ $shipping_address->shipping_email }}</span></p>
                                                <p><label for="">Address : </label><span>{{ division_name($shipping_address->shipping_division_id ) }}{{ district_name($shipping_address->shipping_district_id ) }}{{ area_name($shipping_address->shipping_area_id ) }}, {{ $shipping_address->shipping_address }}</span></p>
                                                <input type="hidden" id="existing_area_id_{{ $shipping_address->id }}" value="{{ $shipping_address->shipping_area_id }}">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="address-footer" id="new_shipping_address_btn_area">
                                <button type="button" class="address-trigger">
                                    <i class="bi bi-plus"></i>
                                    add new address
                                </button>
                            </div>
                        </div>

                        <input type="hidden" id="area_position" value="">

                        <div class="toggle-form" id="new_shipping_address_area">
                            <div class="address">
                                <div class="delivery-types">
                                    <label for="">Pick up your product from : </label>
                                    <div class="type-wrapper">
                                        <span class="single-type">
                                            <input type="radio" id="home" name="new_shipping_to" checked>
                                            <label for="home">home</label>
                                        </span>
                                        <span class="single-type">
                                            <input type="radio" id="office" name="new_shipping_to">
                                            <label for="office">Office</label>
                                        </span>
                                    </div>
                                </div>
                                <div class="address-wrapper row">
                                    <div class="single-input col-md-4">
                                        <label for="name">Name: </label>
                                        <input id="name" class="form-control" type="text" placeholder="Full name" value="{{ Auth::user()->name }}" name="new_shipping_name">
                                    </div>
                                    <div class="single-input col-md-4">
                                        <label for="phone">Phone Number: </label>
                                        <input id="phone" class="form-control" type="text" placeholder="Number" value="{{ Auth::user()->phone }}" name="new_shipping_phone">
                                    </div>
                                    <div class="single-input col-md-4">
                                        <label for="email">Email: </label>
                                        <input id="email" class="form-control" type="email" placeholder="Email" value="{{ Auth::user()->email }}" name="new_shipping_email">
                                    </div>

                                    <div class="single-input col-md-4">
                                        <label for="phone">Division</label>
                                        <select name="new_shipping_division_id" id="division_id" class="form-control" required>
                                            <option  disabled selected>Select One</option>
                                            @foreach($divisions as $division)
                                                <option value="{{ $division->id }}" @if(Auth::user()->division_id == $division->id) selected @endif>{{ $division->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="single-input col-md-4">
                                        <label for="phone">Division</label>
                                        <select name="new_shipping_district_id" id="district_id" class="form-control" required>
                                            <option disabled selected>select district</option>
                                            @foreach($districts as $district)
                                                <option value="{{ $district->id }}" @if(Auth::user()->district_id == $district->id) selected @endif>{{ $district->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="single-input col-md-4">
                                        <label for="phone">Area</label>
                                        <select name="new_shipping_area_id" id="area_id" class="form-control" required>
                                            <option disabled selected>select area</option>
                                            @foreach($areas as $area)
                                                <option value="{{ $area->id }}" @if(Auth::user()->area_id == $area->id) selected @endif>{{ $area->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="single-input">
                                        <label for="new_address">Address: </label>
                                        <textarea class="form-control" name="new_shipping_address" id="new_address" placeholder="Address" cols="30" rows="3">{{ Auth::user()->address }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="summary-area">
                    @php
                        $sub_total = 0;
                        $total = 0;
                        $discount = 0;
                        $shipping_charge = 0;
                    @endphp
                    @if(session('cart'))
                        @foreach(session('cart') as $key => $checkoutDetails)
                            @php
                                $sub_total += ($checkoutDetails['price'] * $checkoutDetails['quantity']);
                                $shipping_charge += $checkoutDetails['shipping_charge'];
                                $discount += $checkoutDetails['discount'];
                            @endphp
                            <input type="hidden" name="product_id[]" value="{{ $key }}">
                            <input type="hidden" name="sale_price[]" value="{{ $checkoutDetails['price'] }}">
                            <input type="hidden" name="quantity[]" value="{{ $checkoutDetails['quantity'] }}">
                            <input type="hidden" name="size_id[]" value="{{ $checkoutDetails['size_id'] }}">
                            <input type="hidden" name="color_id[]" value="{{ $checkoutDetails['color_id'] }}">
                        @endforeach
                        @php
                            // $total = ($sub_total + $shipping_charge);
                        @endphp
                    @endif
                    <h3 class="area-title">Checkout Summary</h3>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Subtotal </td>
                                <input type="hidden" name="sub_total" id="sub_total" value="{{ $sub_total }}">
                                <td>{{ $sub_total }} ৳</td>
                            </tr>
                            <tr>
                                @php
                                    $total = ($sub_total + $shipping_charge);
                                @endphp
                                <td>Shipping </td>
                                <input type="hidden" name="shipping_amount" id="shipping_amount" value="{{ $shipping_charge }}">
                                <td> <span id="delivery_amount">{{ $shipping_charge }}</span> ৳</td>
                            </tr>
                            <tr>
                                <td>Discount </td>
                                <input type="hidden" name="discount" id="discount" value="0">
                                <td> <span id="discount_amount">0</span> ৳</td>
                            </tr>
                            <tr>
                                <td>Payable Total</td>
                                <input type="hidden" name="total" id="total" value="{{ $total }}">
                                <td><span id="grand_total">{{ $total }} </span> ৳</td>
                            </tr>
                        </tbody>
                    </table>
                {{-- @if ($discount <= 0) --}}
                    <div class="accordion" id="promo">
                        <div class="accordion-item">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Add Promo code or Gift voucher
                            </button>
                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#promo">
                                <div class="accordion-body">
                                    <input class="form-control" name="voucher_code" id="voucher_code" type="text">
                                    <input class="form-control" id="voucher_code_apply" type="hidden" value="0">
                                    <button class="promo-btn" type="button" id="applyVoucherBtn" onclick="applyVoucher()">apply</button>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- @endif --}}
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
                                    <input id="cash" type="radio" name="payment_method" value="Cash">
                                    <label for="cash">
                                        <ul>
                                            <li><img src="{{asset('image/cod.png')}}" alt=""></li>
                                        </ul>
                                    </label>
                                </div>
                            </div>
                            <div class="single-type">
                                <div class="inner-type">
                                    <input id="cards" type="radio" name="payment_method" value="Online">
                                    <label for="cards">
                                        <ul>
                                            <li><img src="{{asset('image/ssl.png')}}" alt=""></li>
                                        </ul>
                                    </label>
                                </div>
                            </div>
                            {{-- <div class="single-type">
                                <div class="inner-type">
                                    <input id="bkash" type="radio" name="payment_method" value="Bkash">
                                    <label for="bkash">
                                        <ul>
                                            <li><img src="{{asset('frontend/images/payments/bkash.png')}}" alt=""></li>
                                        </ul>
                                    </label>
                                </div>
                            </div>
                            <div class="single-type">
                                <div class="inner-type">
                                    <input id="nagad" type="radio" name="payment_method" value="Nagad">
                                    <label for="nagad">
                                        <ul>
                                            <li><img src="{{asset('frontend/images/payments/nagad.png')}}" alt=""></li>
                                        </ul>
                                    </label>
                                </div>
                            </div>
                            <div class="single-type">
                                <div class="inner-type">
                                    <input id="rocket" type="radio" name="payment_method" value="Rocket">
                                    <label for="rocket">
                                        <ul>
                                            <li><img src="{{asset('frontend/images/payments/rocket.png')}}" alt=""></li>
                                        </ul>
                                    </label>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="shipping-area mt-20 bg-transparent border-0 p-0">
                    <div class="order-note">
                        <p>Note: In some cases, the price of your peace book / product may change from the supplier / supplier for various reasons. You may not get it from your family book / product publisher / supplier. We apologize for any inconvenience this person may have caused</p>
                    </div>
                    <div class="text-center mt-20">
                        <button class="navigation-btn" type="button" onclick="submitCheckoutForm()">Confirm Order</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
<!-- End Shipping Summary Section -->
@endsection

@push('js')
<script src="{{asset('massage/sweetalert/sweetalert.all.js')}}"></script>
<script>

    // edit billing
    function editDivision(id) {

        var billing_div_id = $("#billing_div_id_" + id).val();
        var sub_total = $("#sub_total").val();

        if (billing_div_id) {
            $.ajax({
                url: "{{ route('customer.division-district') }}"
                , type: 'POST'
                , data: {
                    billing_div_id: billing_div_id
                    , _token: '{{csrf_token()}}'
                , }
                , success: function(data) {
                    console.log(data);
                    $("#billing_dis_id_" + id).empty();
                    $('#billing_dis_id_' + id).append('<option value=""> Select One </option>');
                    $("#vatDisplay_" + id).show();
                    $.each(data[0], function(key, value) {
                        $('#billing_dis_id_' + id).append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                    $("#delivery_amount").text(data[1]);
                    $("#shipping_amount").val(data[1]);
                    $("#grand_total").text(parseInt(data[1]) + parseInt(sub_total));
                }
            , });
        } else {
            alert("Select your division");
        };
    };

    function selectShippAddress(id) {
        $('#new_shipping_address_btn_area').remove();
        $('#new_shipping_address_area').remove();

        var area_id = $('#existing_area_id_'+id).val();
        $('#area_position').val(area_id);

        if(area_id != ''){
            $.ajax({
                url: "{{ route('location-set-for-checkout') }}",
                type:"POST",
                data:{
                    _token: '{{csrf_token()}}',
                    area_id: area_id,
                },
                success:function(data) {
                    console.log(data);
                    // $('#shipping_amount').val(data['shipping_charge']);
                    // $('#total').val(data['total']);

                    // $('#delivery_amount').html(data['shipping_charge']);
                    // $('#grand_total').html(data['total']);
                },
            });
        }else{
            alert('Update your location');
        }

    }

    function applyVoucher() {
        var voucher_code = $('#voucher_code').val();
        var voucher_code_apply = parseInt($('#voucher_code_apply').val());

        var discount_amount = parseInt($('#discount').val());
        var total = parseInt($('#total').val());

        if (voucher_code == '') {
            Swal.fire({
                icon: 'error'
                , title: 'Oops...'
                , text: 'Please enter voucher code!'
            , })
        }else if (voucher_code_apply == 1) {
            Swal.fire({
                icon: 'error'
                , title: 'Oops...'
                , text: 'Already used this code!'
            , })
        } else {
            $.ajax({
                url: "{{ route('customer.voucher-check-with-auth') }}"
                , type: 'POST'
                , data: {
                    voucher_code: voucher_code
                    , discount_amount: discount_amount
                    , total: total
                    , _token: '{{csrf_token()}}'
                , }
                , success: function(data) {
                    if (data['real_code'] <= 0) {
                        Swal.fire({
                            icon: 'error'
                            , title: 'Oops...'
                            , text: 'You entered invalid code!'
                        , })

                        $('#voucher_code_apply').val(0);
                        $('#voucher_code').val('');
                    } else if (data['code_applicable'] <= 0) {
                        Swal.fire({
                            icon: 'error'
                            , title: 'Oops...'
                            , text: 'This code applicable for minimum purchase '+data['min_p_amount']+' ৳'
                        , })

                        $('#voucher_code_apply').val(0);
                        $('#voucher_code').val('');
                    } else if (data['use_time'] <= 0) {
                        Swal.fire({
                            icon: 'error'
                            , title: 'Oops...'
                            , text: 'Already used this code and crossed the limit!'
                        , })

                        $('#voucher_code_apply').val(0);
                        $('#voucher_code').val('');
                    } else {
                        $('#discount').val(data['discount_amount']);
                        $('#discount_amount').html(data['discount_amount']);
                        $('#total').val(data['total']);
                        $('#grand_total').html(data['total']);
                        $('#voucher_code_apply').val(1);
                    }
                }
            , });
        }
    }



    $('#division_id').on('change', function(){
        var division_id = $(this).val();

        $('#district_id').html('<option value="">Select One</option>');
        $('#area_id').html('<option value="">Select One</option>');

        $.ajax({
            url: "{{ route('get-customer-district-by-division') }}",
            type:"POST",
            data:{
                _token: '{{csrf_token()}}',
                division_id: division_id,
            },
            success:function(data) {
                $('#district_id').html(data);
            },
        });

    });

    $('#district_id').on('change', function(){
        var district_id = $(this).val();

        $('#area_id').html('<option value="">Select One</option>');

        $.ajax({
            url: "{{ route('get-customer-area-by-district') }}",
            type:"POST",
            data:{
                _token: '{{csrf_token()}}',
                district_id: district_id,
            },
            success:function(data) {
                $('#area_id').html(data);
            },
        });

    });

    $('#area_id').on('change', function(){
        var area_id = $(this).val();
        $('#area_position').val(area_id);

        $.ajax({
            url: "{{ route('location-set-for-checkout') }}",
            type:"POST",
            data:{
                _token: '{{csrf_token()}}',
                area_id: area_id,
            },
            success:function(data) {
                console.log(data);
                // $('#shipping_amount').val(data['shipping_charge']);
                // $('#total').val(data['total']);

                // $('#delivery_amount').html(data['shipping_charge']);
                // $('#grand_total').html(data['total']);
            },
        });
    });

    function updateCngDiv(id){
        var division_id = $('#division_id_'+id).val();

        $('#district_id').html('<option value="">Select One</option>');
        $('#area_id').html('<option value="">Select One</option>');

        $.ajax({
            url: "{{ route('get-customer-district-by-division') }}",
            type:"POST",
            data:{
                _token: '{{csrf_token()}}',
                division_id: division_id,
            },
            success:function(data) {
                $('#district_id_'+id).html(data);
            },
        });

    };

    function updateCngDis(id){
        var district_id = $('#district_id_'+id).val();

        $('#area_id').html('<option value="">Select One</option>');

        $.ajax({
            url: "{{ route('get-customer-area-by-district') }}",
            type:"POST",
            data:{
                _token: '{{csrf_token()}}',
                district_id: district_id,
            },
            success:function(data) {
                $('#area_id_'+id).html(data);
            },
        });
    };

    function submitCheckoutForm(){
        var area_position = $('#area_position').val();
        if(area_position == ''){
            alert('Please select shipping location');
        }else{
            $('#order_check_out').submit();
        }
    }


</script>
@endpush
