<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;


class HomeController extends Controller
{
    public function homeSlider()
    {
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function addSlider()
    {
        return view('admin.slider.create');
    }

    public function storeSlider(Request $request)
    {
        $validated = $request->validate(
            [
                'title' => 'required|unique:sliders|max:255|min:5',
                'description' => 'required|max:255|min:5',
                'image' => 'required|mimes:jpg,jpeg,png',
            ],
            [
                'title.required' => "Please input slider title",
                'title.min' => "Slider title must be longer then 2",
                'image.required' => "Please insert slider image"
            ]
        );

        // pass the requested images
        $slider_image = $request->file('image');

        $name_generate = hexdec(uniqid()) . '.' . $slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1920, 1088)->save('image/slider/' . $name_generate);
        $last_image = 'image/slider/' . $name_generate;

        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_image,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('home.slider')->with('success', 'Slider inserted successfully');
    }

    public function deleteSlider($id)
    {
        $slider = Slider::find($id);
        $old_image = $slider->image;
        unlink($old_image);
        $slider->delete();
        return Redirect()->route('home.slider')->with('success', 'Slider deleted successfully');
    }

    public function editSlider($id)
    {
        $slider = Slider::find($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function updateSlider(Request $request, $id)
    {
        $validated = $request->validate(
            [
                'title' => 'required|max:255|min:5',
                'description' => 'required|max:255|min:5',
                'image' => 'mimes:jpg,jpeg,png',
            ],
            [
                'title.required' => "Please input slider title",
                'title.min' => "Slider title must be longer then 2",
            ]
        );

        // take the old image and remove it
        $old_image = $request->old_image;

        if ($request->image == null) {
            $last_image = $old_image;
        } else {
            // pass the requested images
            $image = $request->file('image');

            $name_generate = hexdec(uniqid());
            $img_ext = strtolower($image->getClientOriginalExtension());
            $img_name = $name_generate . '.' . $img_ext;
            $upload_location = 'image/slider/';
            $last_image = $upload_location . $img_name;

            $image->move($upload_location, $img_name);

            unlink($old_image);
        }

        Slider::find($id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_image,
        ]);

        return Redirect()->route('home.slider')->with('success', 'Slider updated successfully');
    }
}
