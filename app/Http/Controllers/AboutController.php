<?php

namespace App\Http\Controllers;

use App\Models\Multipic;
use App\Models\HomeAbout;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AboutController extends Controller
{
    public function homeAbout()
    {
        $about = HomeAbout::latest()->get();
        return view('admin.home.index', compact('about'));
    }

    public function addAbout()
    {
        return view('admin.home.create');
    }

    public function storeAbout(Request $request)
    {
        $validated = $request->validate(
            [
                'title' => 'required|unique:home_abouts|max:255|min:2',
                'short_description' => 'required|max:255|min:5',
                'long_description' => 'required|min:5',
            ],
            [
                'title.required' => "Please input about title",
                'title.min' => "About title must be longer then 2",
            ]
        );

        HomeAbout::insert([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('home.about')->with('success', 'About inserted successfully');
    }

    public function editAbout($id)
    {
        $about = HomeAbout::find($id);
        return view('admin.home.edit', compact('about'));
    }

    public function updateAbout(Request $request, $id)
    {
        $validated = $request->validate(
            [
                'title' => 'required|max:255|min:2',
                'short_description' => 'required|max:255|min:5',
                'long_description' => 'required|min:5',
            ],
            [
                'title.required' => "Please input about title",
                'title.min' => "About title must be longer then 2",
            ]
        );

        HomeAbout::find($id)->update([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
        ]);

        return Redirect()->route('home.about')->with('success', 'About updated successfully');
    }

    public function deleteAbout($id)
    {
        HomeAbout::find($id)->delete();
        return Redirect()->route('home.about')->with('success', 'About deleted successfully');
    }

    public function portofolio()
    {
        $multipics = Multipic::all();
        return view('pages.portofolio', compact('multipics'));
    }
}
