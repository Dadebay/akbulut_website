<?php

namespace App\Http\Controllers;

use App\Models\Horse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HorseController extends Controller
{
    public function index()
    {
        $horses = Horse::orderBy('sort_order')->orderBy('id')->paginate(20);
        return view('admin.horses.index', compact('horses'));
    }

    public function create()
    {
        return view('admin.horses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'breed'       => 'nullable|string|max:255',
            'age'         => 'nullable|integer|min:0|max:50',
            'height'      => 'nullable|integer|min:100|max:220',
            'color'       => 'nullable|string|max:100',
            'gender'      => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'sort_order'  => 'nullable|integer',
            'images'      => 'nullable|array|max:5',
            'images.*'    => 'image|mimes:jpg,jpeg,png,webp|max:10240',
            'video'       => 'nullable|mimes:mp4,mov,avi,webm|max:5120',
        ]);

        $horse = Horse::create([
            'name'        => $request->name,
            'breed'       => $request->breed ?? 'Ahalteke Bedewi',
            'age'         => $request->age,
            'height'      => $request->height,
            'color'       => $request->color,
            'gender'      => $request->gender,
            'description' => $request->description,
            'sort_order'  => $request->sort_order ?? 0,
        ]);

        // Upload images (max 5)
        if ($request->hasFile('images')) {
            foreach (array_slice($request->file('images'), 0, 5) as $image) {
                $horse->addMedia($image)->toMediaCollection('horse_images');
            }
        }

        // Upload video
        if ($request->hasFile('video')) {
            $horse->addMedia($request->file('video'))->toMediaCollection('horse_video');
        }

        return redirect()->route('horses.index')->with('success', 'At üstünlikli goşuldy!');
    }

    public function show(Horse $horse)
    {
        return redirect()->route('horses.edit', $horse);
    }

    public function edit(Horse $horse)
    {
        return view('admin.horses.edit', compact('horse'));
    }

    public function update(Request $request, Horse $horse)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'breed'       => 'nullable|string|max:255',
            'age'         => 'nullable|integer|min:0|max:50',
            'height'      => 'nullable|integer|min:100|max:220',
            'color'       => 'nullable|string|max:100',
            'gender'      => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'sort_order'  => 'nullable|integer',
            'images'      => 'nullable|array',
            'images.*'    => 'image|mimes:jpg,jpeg,png,webp|max:10240',
            'video'       => 'nullable|mimes:mp4,mov,avi,webm|max:5120',
        ]);

        $horse->update([
            'name'        => $request->name,
            'breed'       => $request->breed ?? 'Ahalteke Bedewi',
            'age'         => $request->age,
            'height'      => $request->height,
            'color'       => $request->color,
            'gender'      => $request->gender,
            'description' => $request->description,
            'sort_order'  => $request->sort_order ?? 0,
        ]);

        // Add new images (keep existing, add up to max 5 total)
        if ($request->hasFile('images')) {
            $existingCount = $horse->getMedia('horse_images')->count();
            $newFiles = $request->file('images');
            $canAdd = max(0, 5 - $existingCount);
            foreach (array_slice($newFiles, 0, $canAdd) as $image) {
                $horse->addMedia($image)->toMediaCollection('horse_images');
            }
        }

        // Replace video
        if ($request->hasFile('video')) {
            $horse->clearMediaCollection('horse_video');
            $horse->addMedia($request->file('video'))->toMediaCollection('horse_video');
        }

        return redirect()->route('horses.index')->with('success', 'At üstünlikli üýtgedildi!');
    }

    public function destroy(Horse $horse)
    {
        $horse->clearMediaCollection('horse_images');
        $horse->clearMediaCollection('horse_video');
        $horse->delete();
        return redirect()->route('horses.index')->with('success', 'At üstünlikli pozuldy!');
    }

    /** Delete a single image by media ID */
    public function deleteImage(Horse $horse, $mediaId)
    {
        $media = $horse->getMedia('horse_images')->firstWhere('id', $mediaId);
        if ($media) {
            $media->delete();
        }
        return back()->with('success', 'Surat pozuldy!');
    }
}
