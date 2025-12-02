<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\News as ResourcesNews;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    //
    public function index(Request $request)
    {

        $news = News::orderBy('created_at', 'desc')->paginate(10);

        $news_random = News::inRandomOrder()->limit(5)->get();
        return ResourcesNews::collection($news);
    }

    public function show($id)
    {
        return new ResourcesNews(News::find($id));
    }


    public function slider_news()
    {
        $news_random = News::whereMain(true)->inRandomOrder()->limit(5)->get();
        return ResourcesNews::collection($news_random);
    }

    public function latest()
    {
        $news = News::orderBy('created_at', 'desc')->take(3)->get();
        return ResourcesNews::collection($news);
    }
}
