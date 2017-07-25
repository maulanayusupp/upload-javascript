<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Gallery::all();
        return view('welcome', compact('galleries'));
    }

    public function postImage (Request $request) {
        $images = [];
        if ($request->file('image')) {
            foreach ($request->file('image') as $productImage) {
                $upload_file = $productImage;
                $extension = $upload_file->getClientOriginalExtension();
                $picturename = str_random(10) . '.' . $extension;
                $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img/';
                $upload_file->move($destinationPath, $picturename);
                $image = 'img/'. $picturename;
                array_push($images, $image);
            }
            $gallery = new Gallery();
            $gallery->images = json_encode($images);
            $gallery->save();
        }

        return redirect('/');
    }
}
