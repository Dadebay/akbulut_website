<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $galleries = Gallery::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        app()->setLocale('tk');
        return view('admin.galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $gallery = Gallery::create([
            'caption_ru' => $request->get('caption_ru'),
            'caption_tk' => $request->get('caption_tk'),
            'caption_en' => $request->get('caption_en')
        ]);

        if ($request->hasFile('gallery_image') && $request->file('gallery_image')->isValid()) {
            $gallery->addMediaFromRequest('gallery_image')
                // ->withManipulations([
                //     '*' => ['width' => 800,'height'=> 560],
                //  ])
                ->toMediaCollection('galleries');
        }

        return redirect()->route('galleries.index')->with('success', 'taze galereya doredildi');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        //
        app()->setLocale('en');
        return view('admin.galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $gallery->update([
            'caption_en' => $request->get('caption_en'),
            'caption_ru' => $request->get('caption_ru'),
            'caption_tk' => $request->get('caption_tk'),
        ]);

        if ($request->hasFile('gallery_image') && $request->file('gallery_image')->isValid()) {
            $gallery->addMediaFromRequest('gallery_image')->toMediaCollection('galleries');
        }

        return redirect()->route('galleries.index')->with('success', 'Galereya üýtgedildi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return redirect()->route('galleries.index')->with('warning', 'gallery pozuldy');
    }
}
