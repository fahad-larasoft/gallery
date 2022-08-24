<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $images = Image::all();
        return view('home', compact('images'));
    }

    public function storeImages(Request $request) {
        foreach ($request->file('images') as $image) {
            $path = Storage::putFile('images', $image);
            Image::create(['name' => $path]);
            ImageOptimizer::optimize(public_path("storage/$path"));
        }

        return redirect()->back();
    }
}
