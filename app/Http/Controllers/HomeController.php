<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MissionVision;
use App\Models\Category;
use App\Models\CategoryAds;
use App\Models\CategoryBanner;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductUnit;
use App\Models\ProductSubUnit;
use App\Models\Slider;
use App\Models\Banner;
use App\Models\About;
use App\Models\Policy;
use App\Models\Website;
use App\Models\Contact;
use App\Models\Unit;
use App\Models\SubUnit;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function welcome()
    {
        $title = "Home";
        $sliders = Slider::where('status', 1)->latest()->get();
        $banners = Banner::where('status', 1)->latest()->limit(3)->get();
        $missionvissions = MissionVision::where('status', 1)->latest()->get();
        $categories = Category::where('parent_id', NULL)->where('child_id', NULL)->where('status', 1)->latest()->get();
        $products = Product::where('product_type', 'Features')->latest()->limit(18)->get();
        $newArrivals = Product::where('product_type', 'New Arrival')->latest()->get();
        return view('welcome', compact('title', 'sliders', 'banners', 'missionvissions', 'categories', 'products', 'newArrivals'));
    }
    public function aboutUs()
    {
        $title = "About Us";
        $about = About::latest()->first();
        return view('pages.aboutus', compact('title', 'about'));
    }
    public function contact()
    {
        $title = "Contact Us";
        $website = Website::latest()->first();
        return view('pages.contact', compact('title', 'website'));
    }
    public function contactStore(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ]);
        Contact::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        ]);
        Toastr::success('Your message successfully received :-)','Success');
        return redirect()->back();

    }
    public function policy($slug)
    {
        $policy = Policy::where('slug', $slug)->first();
        $title = $policy->name;
        return view('pages.policy', compact('title', 'policy'));
    }
    public function newArrival()
    {
        $title = "New Arrival Products";
        $newArrivals = Product::where('product_type', 'New Arrival')->latest()->get();
        return view('pages.newarrival', compact('title', 'newArrivals'));
    }

    public function allProduct()
    {
        $title = "All Product";
        $products = Product::latest()->get();
        $categories = Category::where('parent_id', NULL)->where('child_id', NULL)->limit(12)->get();
        $categorybanners = CategoryBanner::where('status', 1)->latest()->get();
        $brands = Brand::where('status', 1)->latest()->get();
        $latestcategoryads = CategoryAds::where('status', 1)->latest()->limit(3)->get();
        $units = Unit::where('status', 1)->latest()->get();
        $subunits = SubUnit::where('status', 1)->latest()->get();
        return view('pages.allproduct', compact('title', 'units', 'subunits', 'categories', 'products', 'categorybanners', 'brands', 'latestcategoryads'));
    }
}
