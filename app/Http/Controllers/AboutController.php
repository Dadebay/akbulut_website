<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abouts = About::all();
        return view('admin.abouts.index', compact('abouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.abouts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $new_about = About::create([
            'body_tk' => $request->get('body_tk'),
            'body_en' => $request->get('body_en'),
            'body_ru' => $request->get('body_ru'),
        ]);

        return redirect()->route('abouts.index')->with('success', 'About us text created');
    }

    /**
     * Display the specified resource.
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(About $about)
    {
        //
        return view('admin.abouts/edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, About $about)
    {
        //
        $about->update(
            [
                'body_tk' => $request->get('body_tk'),
                'body_en' => $request->get('body_en'),
                'body_ru' => $request->get('body_ru'),
            ]
        );
        return redirect()->route('abouts.index')->with('success', 'About us text updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(About $about)
    {
        //
        $about->delete();
        return redirect()->route('abouts.index')->with('success', 'About us text deleted');
    }
}
