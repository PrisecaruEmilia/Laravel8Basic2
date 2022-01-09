<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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

        // $name_generate = hexdec(uniqid());
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // $img_name = $name_generate . '.' . $img_ext;
        // $upload_location = 'image/brand/';
        // $last_image = $upload_location . $img_name;

        // $brand_image->move($upload_location, $img_name);

        $name_generate = hexdec(uniqid()) . '.' . $brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300, 200)->save('image/brand/' . $name_generate);
        $last_image = 'image/brand/' . $name_generate;

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_image,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('success', 'Brand inserted successfully');
    }

    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.brand.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate(
            [
                'brand_name' => 'required|max:255|min:2',
                'brand_image' => 'mimes:jpg,jpeg,png',
            ],
            [
                'brand_name.required' => "Please input brand name",
                'brand_name.min' => "Brand name must be longer then 2",
                'brand_image.required' => "Please insert brand image"
            ]
        );

        // take the old image and remove it
        $old_image = $request->old_image;

        if ($request->brand_image == null) {
            $last_image = $old_image;
        } else {
            // pass the requested images
            $brand_image = $request->file('brand_image');

            $name_generate = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_generate . '.' . $img_ext;
            $upload_location = 'image/brand/';
            $last_image = $upload_location . $img_name;

            $brand_image->move($upload_location, $img_name);

            unlink($old_image);
        }


        Brand::find($id)->update([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_image,
        ]);

        return Redirect()->route('all.brands')->with('success', 'Brand updated successfully');
    }

    public function delete($id)
    {
        $brand = Brand::find($id);
        $old_image = $brand->brand_image;
        unlink($old_image);
        $brand->delete();
        return Redirect()->route('all.brands')->with('success', 'Brand deleted successfully');
    }
}
