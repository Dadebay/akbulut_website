<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $home_sliders = Slider::paginate(10);
        return view('admin.sliders.index', compact('home_sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $slider = Slider::create([
            'caption_tk' => $request->get('caption_tk'),
            'caption_ru' => $request->get('caption_ru'),
            'caption_en' => $request->get('caption_en'),
            'desc_en' => $request->get('desc_en'),
            'desc_ru' => $request->get('desc_ru'),
            'desc_tk' => $request->get('desc_tk'),

        ]);

        if ($request->hasFile('slider_image') && $request->file('slider_image')->isValid()) {
            $slider->addMediaFromRequest('slider_image')
                // ->withManipulations([
                //     '*' => ['width' => 800,'height'=> 560],
                //  ])
                ->toMediaCollection('home_sliders');
        }

        return redirect()->route('sliders.index')->with('success', 'slider goshuldy');
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        //
        return view('admin.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        //
        $slider->update([
            'caption_tk' => $request->get('caption_tk'),
            'caption_ru' => $request->get('caption_ru'),
            'caption_en' => $request->get('caption_en'),
            'desc_en' => $request->get('desc_en'),
            'desc_ru' => $request->get('desc_ru'),
            'desc_tk' => $request->get('desc_tk'),

        ]);

        if($request->hasFile('slider_image') && $request->file('slider_image')->isValid())
        {
            $slider->addMediaFromRequest('slider_image')->toMediaCollection('home_sliders');
        }

        return redirect()->route('sliders.index')->with('success','Slider üýtgedildi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
        return redirect()->route('sliders.index')->with('success','Slider deleted!');
    }
}
