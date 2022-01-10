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
}
