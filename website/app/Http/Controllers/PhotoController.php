<?php

namespace App\Http\Controllers;

use App\models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller {
    public function index(Request $request) {
        $this->logVisit($request);
        $photos = Photo::PHOTOS;

        return view('photo', compact('photos'));
    }

}
