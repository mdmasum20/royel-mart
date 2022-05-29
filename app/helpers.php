<?php

use App\Models\Area;
use App\Models\Category;
use App\Models\Client;
use App\Models\DefaultDeliveryLocation;
use App\Models\District;
use App\Models\Division;
use App\Models\ExpenseCategory;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Policy;
use App\Models\Product;
use App\Models\Review;
use App\Models\SaleStock;
use App\Models\Stock;
use App\Models\User;
use App\Models\Website;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Stichoza\GoogleTranslate\GoogleTranslate;

function total_review($product_id)
{
    return Review::where('product_id', $product_id)->where('replay', 0)->count();
}

function final_rating($product_id)
{
    $t_count = Review::where('product_id', $product_id)->where('replay', 0)->count();
    $total_rating = Review::where('product_id', $product_id)->where('replay', 0)->sum('rating');

    if ($total_rating > 0 && $t_count > 0) {
        return $total_rating / $t_count;
    } else {
        return 0;
    }
}

function user_image($user_id)
{
    $user = User::find($user_id);
    if (file_exists($user->image)) {
        return $user->image;
    } else {
        return 'demomedia/demoprofile.png';
    }
}

function review_image($id)
{
    $review = Review::find($id);
    $html = '';
    if ($review->image != NULL) {
        $mult_images = explode("|", $review->image);
        foreach ($mult_images as $key => $image) {
            $html .= '<img loading="eager|lazy" src="' . URL::to($image) . '" width="100px" height="100px" alt="">';
        }
    }

    echo $html;
}

function product_review($product_id)
{
    $ratting = final_rating($product_id);
    if ($ratting == 0) {
        echo '
            <div class="reviews">
                <div class="reviews-inner">
                    <div class="reviewed" style="width: 0%">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <div class="blanked">
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                    </div>
                </div>
            </div>
        ';
    } else {
        review_rating($ratting);
    }
}

function product_review_details_page($product_id)
{
    $ratting = final_rating($product_id);
    if ($ratting == 0) {
        echo '
            <div class="reviews">
                <div class="reviews-inner">
                    <div class="reviewed" style="width: 0%">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <div class="blanked">
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                    </div>
                </div>
                <div class="reviews-answer">
                    <span class="count-reviews">( 0 ratings)</span>
                </div>
            </div>
        ';
    } else {
        review_rating_details_page($ratting, $product_id);
    }
}

function review_rating_details_page($ratting, $product_id)
{
    $html = '';
    if ($ratting == 5) {
        $html .= '
            <div class="reviews">
                <div class="reviews-inner">
                    <div class="reviewed" style="width: 100%">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <div class="blanked">
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                    </div>
                </div>
                <div class="reviews-answer">
                    <span class="count-reviews">( ' . total_review($product_id) . ' ratings)</span>
                </div>
            </div>
        ';
    } elseif ($ratting == 4) {
        $html .= '
            <div class="reviews">
                <div class="reviews-inner">
                    <div class="reviewed" style="width: 80%">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <div class="blanked">
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                    </div>
                </div>
                <div class="reviews-answer">
                    <span class="count-reviews">( ' . total_review($product_id) . ' ratings)</span>
                </div>
            </div>
        ';
    } elseif ($ratting == 3) {
        $html .= '
            <div class="reviews">
                <div class="reviews-inner">
                    <div class="reviewed" style="width: 60%">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <div class="blanked">
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                    </div>
                </div>
                <div class="reviews-answer">
                    <span class="count-reviews">( ' . total_review($product_id) . ' ratings)</span>
                </div>
            </div>
        ';
    } elseif ($ratting == 4) {
        $html .= '
            <div class="reviews">
                <div class="reviews-inner">
                    <div class="reviewed" style="width: 40%">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <div class="blanked">
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                    </div>
                </div>
                <div class="reviews-answer">
                    <span class="count-reviews">( ' . total_review($product_id) . ' ratings)</span>
                </div>
            </div>
        ';
    } elseif ($ratting == 5) {
        $html .= '
            <div class="reviews">
                <div class="reviews-inner">
                    <div class="reviewed" style="width: 20%">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <div class="blanked">
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                    </div>
                </div>
                <div class="reviews-answer">
                    <span class="count-reviews">( ' . total_review($product_id) . ' ratings)</span>
                </div>
            </div>
        ';
    }

    echo $html;
}

function review_rating($ratting)
{
    $html = '';
    if ($ratting == 5) {
        $html .= '
            <div class="reviews">
                <div class="reviews-inner">
                    <div class="reviewed" style="width: 100%">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <div class="blanked">
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                    </div>
                </div>
            </div>
        ';
    } elseif ($ratting == 4) {
        $html .= '
            <div class="reviews">
                <div class="reviews-inner">
                    <div class="reviewed" style="width: 80%">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <div class="blanked">
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                    </div>
                </div>
            </div>
        ';
    } elseif ($ratting == 3) {
        $html .= '
            <div class="reviews">
                <div class="reviews-inner">
                    <div class="reviewed" style="width: 60%">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <div class="blanked">
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                    </div>
                </div>
            </div>
        ';
    } elseif ($ratting == 4) {
        $html .= '
            <div class="reviews">
                <div class="reviews-inner">
                    <div class="reviewed" style="width: 40%">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <div class="blanked">
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                    </div>
                </div>
            </div>
        ';
    } elseif ($ratting == 5) {
        $html .= '
            <div class="reviews">
                <div class="reviews-inner">
                    <div class="reviewed" style="width: 20%">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <div class="blanked">
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                    </div>
                </div>
            </div>
        ';
    }

    echo $html;
}

function replay_this_review($id)
{
    $html = '';

    $replays = Review::where('replay_review_id', $id)->where('replay', 1)->orderBy('id', 'ASC')->get();
    if ($replays->count() > 0) {
        foreach ($replays as $review) {
            $html .= '
                            <div class="review-head">
                                <div class="user-area">
                                    <div class="user-photo">
                                        <img loading="eager|lazy" src="';
            if ($review->user_id) {
                $html .= ' ' . asset(user_image($review->user_id)) . ' ';
            } else {
                $html .= ' ' . asset('demomedia/demoprofile.png') . ' ';
            }
            $html .= ' " alt="">
                                    </div>
                                    <div class="user-meta">';
            if ($review->name == NULL) {
                $html .= '<h4 class="username">No Name Reviewer</h4>';
            } else {
                $html .= '<h4 class="username">' . $review->name . '</h4>';
            }

            $html .= ' ' . review_rating($review->rating) . '
                                    </div>
                                </div>
                                <div class="date-area">
                                    <span class="date">
                                        ' . $review->created_at->format('d M Y h:i A') . '
                                    </span>
                                </div>
                            </div>
                            <div class="review-body">
                                <p>' . $review->opinion . '</p>
                                ' . review_image($review->id) . '
                            </div>
            ';
        }
    }

    echo $html;
}


function ordered_product($order_id)
{
    $order = Order::find($order_id);
    $html = '';

    $products = OrderProduct::where('order_code', $order->order_code)->get();
    if ($products->count() > 0) {
        foreach ($products as $order_product) {
            $product = Product::find($order_product->product_id);
            $stock = Stock::where('product_id', $order_product->product_id)->where('quantity', '>', 0)->sum('quantity');
            $sale_price = $order_product->sale_price;
            $quantity = $order_product->quantity;

            $html .= '
                <tr id="product_tr_' . $product->id . '">
                    <td class="text-center">
                        <button class="btn btn-danger waves-effect" type="button" onclick="removeProductTr(' . $product->id . ')">
                            <i class="ml-1 fa fa-trash"></i>
                        </button>
                    </td>
                    <td>
                        <img src="';

            if (file_exists($product->thumbnail)) {
                $html .= '' . URL::to($product->thumbnail) . '';
            } else {
                $html .= 'asset("media\general-image\no-photo.jpg")';
            }
            $html .= ' " width="100%" height="60px" alt="banner image">
                    </td>
                    <td>
                        <input type="hidden" class="form-control" name="product_id[]" value="' . $product->id . '">
                        <a href="' . route('productdetails', $product->slug) . '" target="_blank">' . $product->name . '</a>
                    </td>
                    <td>
                        <input type="hidden" class="form-control text-center" value="' . $stock . '" id="pro_max_quantity_' . $product->id . '">
                        <input type="text" class="form-control text-center" value="' . $quantity . '" name="pro_quantity[]" id="pro_quantity_' . $product->id . '" onfocus="focusInQuantity(' . $product->id . ')" onfocusout="focusOutQuantity(' . $product->id . ')" onpaste="QuantityCng(' . $product->id . ')" onkeyup="QuantityCng(' . $product->id . ')" onchange="QuantityCng(' . $product->id . ')">
                    </td>
                    <td class="text-center">
                        <input type="text" class="form-control text-center" name="pro_sale_price[]" value="' . $sale_price . '" id="pro_sale_price_' . $product->id . '" onfocus="focusInSalePrice(' . $product->id . ')" onfocusout="focusOutSalePrice(' . $product->id . ')" onpaste="SalePriceCng(' . $product->id . ')" onkeyup="SalePriceCng(' . $product->id . ')" onchange="SalePriceCng(' . $product->id . ')">
                    </td>
                    <td class="text-center">
                        <input type="text" class="form-control text-right" readonly name="pro_shipping[]" id="pro_shipping_' . $product->id . '" value="' . $product->shipping_charge . '">
                    </td>
                    <td class="text-center">
                        <input type="text" class="form-control text-right" readonly name="pro_total[]" id="pro_total_' . $product->id . '" value="' . ($sale_price * $quantity) . '">
                    </td>
                </tr>
            ';
        }
    }

    echo $html;
}

function product_name($id)
{
    $product = Product::find($id);
    if($product){
        return $product->name;
    }else{
        return 'N/A';
    }
}

function expense_category($id)
{
    $category = ExpenseCategory::find($id);
    if($category){
        return $category->name;
    }else{
        return 'N/A';
    }
}

function user_name($id)
{
    $user = User::find($id);
    if($user){
        return $user->name;
    }else{
        return 'N/A';
    }
}

function division_name($id)
{
    $data = Division::find($id);
    if($data){
        return $data->name.', ';
    }else{
        $default_location = DefaultDeliveryLocation::latest()->first();
        $data = Division::find($default_location->division_id);
        if($data){
            return $data->name.', ';
        }else{
            return '';
        }
    }
}

function district_name($id)
{
    $data = District::find($id);
    if($data){
        return $data->name.', ';
    }else{
        $default_location = DefaultDeliveryLocation::latest()->first();
        $data = District::find($default_location->district_id);
        if($data){
            return $data->name.', ';
        }else{
            return '';
        }
    }
}

function area_name($id)
{
    $data = Area::find($id);
    if($data){
        return $data->name;
    }else{
        $default_location = DefaultDeliveryLocation::latest()->first();
        $data = Area::find($default_location->area_id);
        if($data){
            return $data->name;
        }else{
            return '';
        }
    }
}

function pro_shipping_charge($id)
{
    $product = Product::find($id);
    if($product->free_shipping_charge == 1){
        if(Auth::user()){
            $area = Area::find(Auth::user()->area_id);
        }else{
            $area = Area::find(session()->get('area_id'));
        }
        if($area){
            if($area->is_inside == 0){
                return '৳ '.$product->outside_shipping_charge;
            }else{
                return '৳ '.$product->inside_shipping_charge;
            }
        }else{
            $default_location = DefaultDeliveryLocation::latest()->first();
            $area = Area::find($default_location->area_id);
            if($area){
                if($area->is_inside == 0){
                    return '৳ '.$product->outside_shipping_charge;
                }else{
                    return '৳ '.$product->inside_shipping_charge;
                }
            }else{
                return '৳ 0';
            }
        }
    }else{
        return 'Free';
    }
}

function shipping_charge($id)
{
    $product = Product::find($id);
    if($product->free_shipping_charge == 1){
        if(Auth::user()){
            $area = Area::find(Auth::user()->area_id);
        }else{
            $area = Area::find(session()->get('area_id'));
        }
        if($area){
            if($area->is_inside == 0){
                return $product->outside_shipping_charge;
            }else{
                return $product->inside_shipping_charge;
            }
        }else{
            $default_location = DefaultDeliveryLocation::latest()->first();
            $area = Area::find($default_location->area_id);
            if($area){
                if($area->is_inside == 0){
                    return $product->outside_shipping_charge;
                }else{
                    return $product->inside_shipping_charge;
                }
            }else{
                return 0;
            }
        }
    }else{
        return 'Free';
    }
}



function purchase_price($order_code)
{
    $sale_stocks = SaleStock::where('order_code', $order_code)->get();
    $total = 0;
    if($sale_stocks->count() > 0){
        foreach($sale_stocks as $stock){
            $total += $stock->buying_price * $stock->quantity;
        }
    }

    return $total;
}

function clients(){
    $clients = Client::latest()->get();
    $html = '';

    foreach($clients as $client){
        $html .= '<li><a href="'.$client->link.'"><img src="'.asset($client->image).'" alt=""></a></li>';
    }

    echo $html;
}

function site_policy(){
    $policies = Policy::where('status', 1)->latest()->limit(4)->get();
    $html = '';

    foreach($policies as $policy){
        $html .= '<li><a href="'.route('policy', $policy->slug).'">'.$policy->name.'</a></li>';
    }

    echo $html;
}

function site_icon(){
    $website = Website::latest()->first();
    $icon = explode("|", $website->icon);
    $link = explode("|", $website->link);

    $html = '';

    foreach($icon as $key=>$icon){
        $html .= '<li  class="'.$icon.'"><a target="blank" href="';
                    if(isset($link[$key])){
                        $html .= ' '.$link[$key].' ';
                    }
        $html .= ' "><i class="fa fa-'.$icon.'"></i></a></li>';
    }

    echo $html;
}

function site_logo(){
    $website = Website::latest()->first();

    $html = '';

    $html .= ' <img  loading="eager|lazy" src=" ';
            if($website->logo){
                $html .= ''.asset($website->logo).'';
            }else{
                $html .= ''.asset('frontend/images/logo/logo.png').'';
            }
    $html .= '  "  alt="">';

    echo $html;
}

function site_phone(){
    $website = Website::latest()->first();

    echo $website->phone;
}

function site_footer_phone(){
    $website = Website::latest()->first();
    $html = '';
    $html .= $website->phone;

    if($website->another_phone_one != ''){
        $html .= ', </br>'.$website->another_phone_one;
    }

    if($website->another_phone_two != ''){
        $html .= ', </br>'.$website->another_phone_two;
    }

    if($website->another_phone_three != ''){
        $html .= ', </br>'.$website->another_phone_three;
    }

    if($website->another_phone_four != ''){
        $html .= ', </br>'.$website->another_phone_four;
    }

    if($website->another_phone_five != ''){
        $html .= ', </br>'.$website->another_phone_five;
    }

    echo $html;
}

function site_telephone(){
    $website = Website::latest()->first();

    echo $website->tel;
}

function category_exist($id){
    $category = Category::find($id);

    if($category){
        return 1;
    }else{
        return 0;
    }
}

function site_email(){
    $website = Website::latest()->first();

    echo $website->email;
}

function site_address(){
    $website = Website::latest()->first();

    echo $website->address;
}

function main_categories(){
    return Category::where('parent_id', NULL)->where('child_id', NULL)->where('is_default', 0)->where('status', 1)->orderBy('serial_number', 'asc')->limit(18)->get();
}

function parent_categories($category_id){
    return Category::where('parent_id', $category_id)->where('child_id', NULL)->orderBy('parent_serial', 'asc')->get();
}

function child_categories($category_id){
    return Category::where('child_id', $category_id)->orderBy('child_serial', 'asc')->get();
}

function language_convert($data){
    // $lan = session()->get('lan');
    // echo GoogleTranslate::trans($data, $lan, 'en');

    echo $data;
}

function change_date_format($data){
    echo Carbon::parse($data)->format('Y/m/d');
}

function category_breadcrumb_title($p_cat_id){
    $html = '';
    $check_cat = Category::find($p_cat_id);
    if ($check_cat){
        if ($check_cat->parent_id != NULL){
            $b_cat = Category::find($check_cat->parent_id);
            if ($b_cat){
                $html .= '<li><a href="'. route('category', $b_cat->slug) .'">'. language_convert($b_cat->name) .'</a></li>';
            }
        }

        if ($check_cat->child_id != NULL){
            $b_cat = Category::find($check_cat->child_id);
            if ($b_cat){
                $html .= '<li><a href="'. route('category', $b_cat->slug) .'">'. language_convert($b_cat->name) .'</a></li>';
            }
        }
    }

    echo $html;
}

