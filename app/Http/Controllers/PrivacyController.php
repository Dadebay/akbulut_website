<?php

namespace App\Http\Controllers;

use App\Models\Privacy;
use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abouts = Privacy::all();
        return view('admin.privacies.index', compact('abouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.privacies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $new_about = Privacy::create([
            'body_tk' => $request->get('body_tk'),
            'body_en' => $request->get('body_en'),
            'body_ru' => $request->get('body_ru'),
        ]);
        return redirect()->route('privacies.index')->with('success', 'privacy policy text created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Privacy $privacy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Privacy $privacy)
    {
        //
        return view('admin.privacies.edit', compact('privacy'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Privacy $privacy)
    {
        $privacy->update(
            [
                'body_tk' => $request->get('body_tk'),
                'body_en' => $request->get('body_en'),
                'body_ru' => $request->get('body_ru'),
            ]
        );
        return redirect()->route('privacies.index')->with('success', 'privacy policy text updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Privacy $privacy)
    {
        $privacy->delete();
        return redirect()->route('privacies.index')->with('success', 'privacy policy text deleted');
    }
}
