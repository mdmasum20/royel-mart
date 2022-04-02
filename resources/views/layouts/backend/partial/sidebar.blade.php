<div class="pcoded-inner-navbar main-menu">
    <ul class="pcoded-item pcoded-left-item">
        <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}">
                <span class="pcoded-micon">
                    <i class="feather icon-home"></i>
                </span>
                <span class="pcoded-mtext">Dashboard</span>
            </a>
        </li>
        <li class="pcoded-hasmenu {{ Request::is('admin/category') || Request::is('admin/category-banner') || Request::is('admin/category-ads') ? 'pcoded-trigger' : '' }}">
            <a href="javascript:void(0)">
                <span class="pcoded-micon">
                    <i class="feather icon-sidebar"></i>
                </span>
                <span class="pcoded-mtext">Category</span>
            </a>
            <ul class="pcoded-submenu">
                <li class="{{ Request::is('admin/category') ? 'active' : '' }}">
                    <a href="{{ route('admin.category.index') }}">
                        <span class="pcoded-mtext">Category</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/category-banner')? 'active' : '' }}">
                    <a href="{{ route('admin.category-banner.index') }}">
                        <span class="pcoded-mtext">Category Banner</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/category-ads')? 'active' : '' }}">
                    <a href="{{ route('admin.category-ads.index') }}">
                        <span class="pcoded-mtext">Category Ads</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="{{ Request::is('admin/brand') ? 'active' : '' }}">
            <a href="{{ route('admin.brand.index') }}">
                <span class="pcoded-micon">
                    <i class="feather icon-menu"></i>
                </span>
                <span class="pcoded-mtext">Brand</span>
            </a>
        </li>
        <li class="pcoded-hasmenu {{ Request::is('admin/unit') || Request::is('admin/color*') || Request::is('admin/size') || Request::is('admin/sub-unit') ? 'pcoded-trigger' : '' }}">
            <a href="javascript:void(0)">
                <span class="pcoded-micon">
                    <i class="feather icon-layers"></i>
                </span>
                <span class="pcoded-mtext">Units</span>
            </a>
            <ul class="pcoded-submenu">
                <li class="{{ Request::is('admin/unit') ? 'active' : '' }}">
                    <a href="{{route('admin.unit.index')}}">
                        <span class="pcoded-mtext">Unit</span>
                    </a>
                </li>
                {{-- <li class="{{ Request::is('admin/sub-unit') ? 'active' : '' }}">
                    <a href="{{ route('admin.sub-unit.index') }}">
                        <span class="pcoded-mtext">Sub Unit</span>
                    </a>
                </li> --}}
                <li class="{{ Request::is('admin/color*') ? 'active' : '' }}">
                    <a href="{{ route('admin.color.index') }}">
                        <span class="pcoded-mtext">Color</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/size') ? 'active' : '' }}">
                    <a href="{{ route('admin.size.index') }}">
                        <span class="pcoded-mtext">Size</span>
                    </a>
                </li>
            </ul>
        </li>

        {{-- <li class="pcoded-hasmenu {{ Request::is('admin/division') || Request::is('admin/district') ? 'pcoded-trigger' : '' }}">
            <a href="javascript:void(0)">
                <span class="pcoded-micon">
                    <i class="feather icon-bookmark"></i>
                </span>
                <span class="pcoded-mtext">Location</span>
            </a>
            <ul class="pcoded-submenu">
                <li class="{{ Request::is('admin/division') ? 'active' : '' }}">
                    <a href="{{ route('admin.division.index') }}">
                        <span class="pcoded-mtext">Division</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/district') ? 'active' : '' }}">
                    <a href="{{ route('admin.district.index') }}">
                        <span class="pcoded-mtext">District</span>
                    </a>
                </li>
            </ul>
        </li> --}}

        <li class="pcoded-hasmenu {{ Request::is('admin/quick-sale*') ? 'pcoded-trigger' : '' }}">
            <a href="javascript:void(0)">
                <span class="pcoded-micon">
                    <i class="feather icon-bookmark"></i>
                </span>
                <span class="pcoded-mtext">Quick Sale Manage</span>
            </a>
            <ul class="pcoded-submenu">
                <li class="{{ Request::is('admin/quick-sale') ? 'active' : '' }}">
                    <a href="{{ route('admin.quick-sale.index') }}">
                        <span class="pcoded-mtext">Quick Sale</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="{{ Request::is('admin/voucher') ? 'active' : '' }}">
            <a href="{{ route('admin.voucher.index') }}">
                <span class="pcoded-micon">
                    <i class="fa fa-viadeo"></i>
                </span>
                <span class="pcoded-mtext">Voucher</span>
            </a>
        </li>
    </ul>
    <ul class="pcoded-item pcoded-left-item">
        <li class="pcoded-hasmenu {{ Request::is('admin/product') || Request::is('admin/product/create') ? 'pcoded-trigger' : '' }}">
            <a href="javascript:void(0)">
                <span class="pcoded-micon">
                    <i class="feather icon-message-square"></i>
                </span>
                <span class="pcoded-mtext">Product</span>
            </a>
            <ul class="pcoded-submenu">
                <li class="{{ Request::is('admin/product/create') ? 'active' : '' }}">
                    <a href="{{ route('admin.product.create') }}">
                        <span class="pcoded-mtext">Add Product</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/product') ? 'active' : '' }}">
                    <a href="{{ route('admin.product.index') }}">
                        <span class="pcoded-mtext">Product list</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="pcoded-hasmenu {{ Request::is('admin/purchase/create') || Request::is('admin/purchase') ? 'pcoded-trigger' : '' }}"">
            <a href="javascript:void(0)">
                <span class="pcoded-micon">
                    <i class="feather icon-check-circle"></i>
                </span>
                <span class="pcoded-mtext">
                    Purchase Management
                </span>
            </a>
            <ul class="pcoded-submenu">
                <li class="{{ Request::is('admin/purchase/create') ? 'active' : '' }}">
                    <a href="{{ route('admin.purchase.create') }}">
                        <span class="pcoded-mtext">New Purchase</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/purchase') ? 'active' : '' }}">
                    <a href="{{ route('admin.purchase.index') }}">
                        <span class="pcoded-mtext">Purchase List</span>
                    </a>
                </li>
            </ul>
        </li>
        @php
            $pendingOrders = App\Models\Order::where('status', 'Pending')->latest()->get();
            $confirmedOrders = App\Models\Order::where('status', 'Confirmed')->latest()->get();
            $processingOrders = App\Models\Order::where('status', 'Processing')->latest()->get();
            $deliveredOrders = App\Models\Order::where('status', 'Delivered')->latest()->get();
            $successedOrders = App\Models\Order::where('status', 'Successed')->latest()->get();
            $canceledOrders = App\Models\Order::where('status', 'Canceled')->latest()->get();
        @endphp
        <li class="pcoded-hasmenu {{ Request::is('admin/orders') || Request::is('admin/orders-pending') || Request::is('admin/orders-confirmed') || Request::is('admin/orders-processing') ||Request::is('admin/orders-delivered') || Request::is('admin/orders-successed') || Request::is('admin/orders-canceled') || Request::is('admin/custom-order') ? 'pcoded-trigger' : '' }}">
            <a href="javascript:void(0)">
                <span class="pcoded-micon">
                    <i class="feather icon-gitlab"></i>
                </span>
                <span class="pcoded-mtext">
                    Order Management
                </span>
            </a>
            <ul class="pcoded-submenu">
                <li class="{{ Request::is('admin/orders-pending') ? 'active' : '' }}">
                    <a href="{{route('admin.orders.pending')}}">
                        <span class="pcoded-mtext">
                            Pending Order
                        </span>
                        <span class="pcoded-badge label label-info">
                            {{ $pendingOrders->count() }}
                        </span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/orders-confirmed') ? 'active' : '' }}">
                    <a href="{{route('admin.orders.confirmed')}}">
                        <span class="pcoded-mtext">
                            Confirmed Order
                        </span>
                        <span class="pcoded-badge label label-info">
                            {{ $confirmedOrders->count() }}
                        </span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/orders-processing') ? 'active' : '' }}">
                    <a href="{{route('admin.orders.processing')}}">
                        <span class="pcoded-mtext">
                            Processing Order
                        </span>
                        <span class="pcoded-badge label label-info">
                            {{ $processingOrders->count() }}
                        </span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/orders-delivered') ? 'active' : '' }}">
                    <a href="{{route('admin.orders.delivered')}}">
                        <span class="pcoded-mtext">
                            Delivered Order
                        </span>
                        <span class="pcoded-badge label label-info">
                            {{ $deliveredOrders->count() }}
                        </span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/orders-successed') ? 'active' : '' }}">
                    <a href="{{route('admin.orders.successed')}}">
                        <span class="pcoded-mtext">
                            Successed Order
                        </span>
                        <span class="pcoded-badge label label-info">
                            {{ $successedOrders->count() }}
                        </span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/orders-canceled') ? 'active' : '' }}">
                    <a href="{{route('admin.orders.canceled')}}">
                        <span class="pcoded-mtext">
                            Canceled Order
                        </span>
                        <span class="pcoded-badge label label-info">
                            {{ $canceledOrders->count() }}
                        </span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/orders') ? 'active' : '' }}">
                    <a href="{{ route('admin.orders.index') }}">
                        <span class="pcoded-mtext">
                            All Orders
                        </span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/custom-order') ? 'active' : '' }}">
                    <a href="{{ route('admin.custom-order') }}">
                        <span class="pcoded-mtext">
                            Custom Orders
                        </span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="pcoded-hasmenu {{ Request::is('admin/stock-report') ? 'pcoded-trigger' : '' }}"">
            <a href="javascript:void(0)">
                <span class="pcoded-micon">
                    <i class="feather icon-check-circle"></i>
                </span>
                <span class="pcoded-mtext">
                    Report
                </span>
            </a>
            <ul class="pcoded-submenu">
                <li class="{{ Request::is('admin/stock-report') ? 'active' : '' }}">
                    <a href="{{ route('admin.stock-report') }}">
                        <span class="pcoded-mtext">Stock Report</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/inventory') ? 'active' : '' }}">
                    <a href="{{ route('admin.inventory') }}">
                        <span class="pcoded-mtext">Inventory</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="pcoded-hasmenu {{ Request::is('admin/message') || Request::is('admin/system-setting') || Request::is('admin/contact-massage') || Request::is('admin/policy') || Request::is('admin/abouts') || Request::is('admin/website') || Request::is('admin/banner') || Request::is('admin/mission-vision') || Request::is('admin/happy-client') || Request::is('admin/slider') ? 'active pcoded-trigger' : '' }}">
            <a href="javascript:void(0)">
                <span class="pcoded-micon">
                    <i class="feather icon-globe"></i>
                </span>
                <span class="pcoded-mtext">Website</span>
            </a>
            <ul class="pcoded-submenu">
                <li class="{{ Request::is('admin/abouts')? 'active' : '' }}">
                    <a href="{{ route('admin.abouts.index') }}">
                        <span class="pcoded-mtext">About</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/slider')? 'active' : '' }}">
                    <a href="{{ route('admin.slider.index') }}">
                        <span class="pcoded-mtext">Slider</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/banner')? 'active' : '' }}">
                    <a href="{{ route('admin.banner.index') }}">
                        <span class="pcoded-mtext">Banner</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/message')? 'active' : '' }}">
                    <a href="{{ route('admin.message.index') }}">
                        <span class="pcoded-mtext">Message</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/policy')? 'active' : '' }}">
                    <a href="{{ route('admin.policy.index') }}">
                        <span class="pcoded-mtext">Policy</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/happy-client')? 'active' : '' }}">
                    <a href="{{ route('admin.happy-client.index') }}">
                        <span class="pcoded-mtext">Happy Client</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/mission-vision')? 'active' : '' }}">
                    <a href="{{ route('admin.mission-vision.index') }}">
                        <span class="pcoded-mtext">Mission Vision</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/contact-massage')? 'active' : '' }}">
                    <a href="{{ route('admin.contact-massage') }}">
                        <span class="pcoded-mtext">Contact Massage</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/system-setting') ? 'active' : '' }}">
                    <a href="{{ route('admin.system-setting.index') }}">
                        <span class="pcoded-mtext">System Setting</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/website') ? 'active' : '' }}">
                    <a href="{{ route('admin.website.index') }}">
                        <span class="pcoded-mtext">Website Setting</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
