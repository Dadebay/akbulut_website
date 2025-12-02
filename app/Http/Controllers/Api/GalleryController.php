<?php

namespace App\Http\Controllers\Api;

use App\Models\About;
use App\Models\Gallery;
use App\Http\Controllers\Controller;
use App\Http\Resources\AboutUsResource;
use App\Http\Resources\GalleryResource;
use App\Http\Resources\HomeSliderResource;
use App\Models\Slider;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    //
    public function index()
    {
        $galleries = Gallery::orderBy('created_at','desc')->paginate(10);
        return GalleryResource::collection($galleries);
    }

    public function randomGalleries()
    {
        $galleries_random = Gallery::inRandomOrder()->limit(5)->get();
        return GalleryResource::collection($galleries_random);
    }

    public function sliders()
    {
        $sliders = Slider::all();
        return HomeSliderResource::collection($sliders);
    }

    public function aboutus()
    {
        $aboutusTexts = About::all();
        return new AboutUsResource($aboutusTexts[0]);
    }
}
