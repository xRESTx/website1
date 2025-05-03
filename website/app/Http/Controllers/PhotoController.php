<?php

namespace App\Http\Controllers;

use App\models\Photo;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::PHOTOS;

        return view('photo', compact('photos'));
    }

}
