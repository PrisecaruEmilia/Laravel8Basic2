<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BrandController extends Controller
{
    public function allBrands()
    {
        $brands = Brand::latest()->paginate(3);
        return view('admin.brand.index', compact('brands'));
    }

    public function addBrand(Request $request)
    {
        $validated = $request->validate(
            [
                'brand_name' => 'required|unique:brands|max:255|min:2',
                'brand_image' => 'required|mimes:jpg,jpeg,png',
            ],
            [
                'brand_name.required' => "Please input brand name",
                'brand_name.min' => "Brand name must be longer then 2",
                'brand_image.required' => "Please insert brand image"
            ]
        );

        // pass the requested images
        $brand_image = $request->file('brand_image');

        $name_generate = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_generate . '.' . $img_ext;
        $upload_location = 'image/brand/';
        $last_image = $upload_location . $img_name;

        $brand_image->move($upload_location, $img_name);

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_image,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('success', 'Brand inserted successfully');
    }
}