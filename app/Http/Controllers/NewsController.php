<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::orderBy('created_at','desc')->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        app()->setLocale('tk');
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $news = News::create([
            'title_en'=>$request->get('name_en'),
            'title_ru'=>$request->get('name_ru'),
            'title_tk'=>$request->get('name_tk'),

            'body_tk'=>$request->get('body_tk'),
            'body_en'=>$request->get('body_en'),
            'body_ru'=>$request->get('body_ru'),

            'main'=>$request->get('main')
        ]);

        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $key => $value) {

                $news->addMedia($request->file('images')[$key])
                    ->toMediaCollection('news');
            }
        }


        return redirect()->route('news.index')->with('success','news created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        app()->setLocale('tk');
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $news->media->pluck('id')->diff($request->old_photos)->map(function($id) use ($news){
            $news->deleteMedia($id);
        });

        $news->update([
            'title_en'=>$request->get('name_en'),
            'title_ru'=>$request->get('name_ru'),
            'title_tk'=>$request->get('name_tk'),

            'body_en'=>$request->get('body_en'),
            'body_ru'=>$request->get('body_ru'),
            'body_tk'=>$request->get('body_tk'),

            'main'=>$request->get('main')
        ]);

        if($request->hasFile('images')){
            $images = $request->file('images');
            foreach ($images as $key => $value) {
                $news->addMedia($images[$key])
                    ->toMediaCollection('news');
            }
        }
        return redirect()->route('news.index')->with('success','news updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('news.index')->with('success','news created successfully');
    }

    public function upload(Request $request)
    {
        $news = new News();
        $news->id = 0;
        $news->exists = true;
        $image = $news->addMediaFromRequest('upload')->toMediaCollection('news');

        return response()->json([
            'url'=>$image->getUrl()
        ]);
    }
}
