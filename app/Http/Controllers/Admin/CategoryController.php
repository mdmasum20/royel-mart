<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = "Category";
        $categories = Category::latest()->get();
        return view('admin.category.index', compact('title', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required',
        ]);

        if($request->menu) {
            $menuStatus = $request->menu;
        }else{
            $menuStatus = "0";
        }
        if($request->feature) {
            $featureStatus = $request->feature;
        }else {
            $featureStatus = "0";
        }

        if($request->show_hide_status) {
            $showHideStatus = $request->show_hide_status;
        }else {
            $showHideStatus = "0";
        }

        $category_image = $request->file('image');
        $slug = 'category';
        if(isset($category_image)) {
            $category_image_name = $slug.'-'.uniqid().'.'.$category_image->getClientOriginalExtension();
            $upload_path = 'media/category/';
            $category_image->move($upload_path, $category_image_name);
    
            $image_url = $upload_path.$category_image_name;
        }else {
            $image_url = NULL;
        }
        Category::insert([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
            'image' => $image_url,
            'icon' => $request->icon,
            'menu' => $menuStatus,
            'feature' => $featureStatus,
            'serial_number' => $request->serial_number,
            'show_hide_status' => $showHideStatus,
            'status' => "1",
            'created_at' => Carbon::now(),
        ]);

        Toastr::success('Category successfully save :-)','Success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function categoryActive($id)
    {
        //
        
        Category::findOrFail($id)->update(['status' => '1']);
        Toastr::info('Category Successfully Active :-)','Success');
        return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function categoryInactive($id)
    {
        //
        Category::findOrFail($id)->update(['status' => '0']);
        Toastr::info('Category Successfully Inactive :-)','Success');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'name' => 'required',
        ]);
        
        if($request->menu) {
            $menuStatus = $request->menu;
        }else{
            $menuStatus = "0";
        }
        if($request->feature) {
            $featureStatus = $request->feature;
        }else {
            $featureStatus = "0";
        }

        if($request->show_hide_status) {
            $showHideStatus = $request->show_hide_status;
        }else {
            $showHideStatus = "0";
        }

        $category_image = $request->file('image');
        $slug = 'category';
        if(isset($category_image)) {
            $category_image_name = $slug.'-'.uniqid().'.'.$category_image->getClientOriginalExtension();
            $upload_path = 'media/category/';
            $category_image->move($upload_path, $category_image_name);
            
            $category_old_image = Category::findOrFail($id);
            if ($category_old_image->image) {
                unlink($category_old_image->image);
            }
            
            $image_url = $upload_path.$category_image_name;

            Category::findOrFail($id)->update([
                'name' => $request->name,
                'slug' => strtolower(str_replace(' ', '-', $request->name)),
                'image' => $image_url,
                'icon' => $request->icon,
                'menu' => $menuStatus,
                'feature' => $featureStatus,
                'serial_number' => $request->serial_number,
                'show_hide_status' => $showHideStatus,
                'updated_at' => Carbon::now(),
            ]);
    
            Toastr::info('Category successfully updated :-)','Success');
            return redirect()->back();

        }else {
            Category::findOrFail($id)->update([
                'name' => $request->name,
                'slug' => strtolower(str_replace(' ', '-', $request->name)),
                'icon' => $request->icon,
                'menu' => $menuStatus,
                'feature' => $featureStatus,
                'serial_number' => $request->serial_number,
                'show_hide_status' => $showHideStatus,
                'updated_at' => Carbon::now(),
            ]);

            Toastr::info('Category successfully updated :-)','Success');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}