<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
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
        return view('home');
    }

    public function postImage (Request $request) {
        // $image = $request->file('image');
        $images = [];

        foreach ($request->file('image') as $productImage) {
            $upload_file = $productImage;
            $extension = $upload_file->getClientOriginalExtension();
            $picturename = str_random(10) . '.' . $extension;
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img/';
            $upload_file->move($destinationPath, $picturename);
            $image = 'public/img/'. $picturename;
            array_push($images, $image);
        }

        dd($images);
    }
}
