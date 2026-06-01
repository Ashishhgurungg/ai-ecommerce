<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;


class GalleryController extends Controller
{
    public function galleryForm()
    {
        return view('galleries/gallery-form');
    }

    public function addgallery(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image.*'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $gallery = new Gallery();
        $gallery->title = $validated['name'];
        $gallery->description = $validated['description'] ?? '';

        $images = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $imageName = time() . '_' . uniqid() . '.' . $file->extension();
                $file->storeAs('galleries', $imageName, 'public');
                $images[] = $imageName;
            }
            $gallery->images = $images;
        }

        $gallery->save();

        return redirect('/all-galleries')->with('success', 'Gallery added successfully!');
    }

    public function allgalleries()
    {
        $galleries = Gallery::paginate(6);
        return view('galleries/all-galleries', compact('galleries'));
    }

    public function deletegallery(Request $request)
    {
        $id = $request->id;
        $gallery = Gallery::find($id);
        $gallery->delete();
        return redirect('/all-galleries')->with("delete", "Deleted the gallery successfully !!!");
    }

    public function showUpdateForm(Request $request)
    {
        $id = $request->id;
        $gallery = Gallery::find($id);
        return view('galleries/update-galleries', compact('gallery'));
    }

    public function updategallery(Request $request)
    {
        $validated = $request->validate([
            'id'          => 'required|exists:galleries,id',
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image.*'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'remove_all'  => 'nullable|boolean',
        ]);

        $gallery = Gallery::findOrFail($validated['id']);

        // 1. REMOVE ALL IMAGES (optional)
        if ($request->remove_all == 1) {

            if (!empty($gallery->images)) {
                foreach ($gallery->images as $img) {
                    \Storage::disk('public')->delete('galleries/' . $img);
                }
            }

            $gallery->images = [];
        }

        // 2. ADD NEW IMAGES
        if ($request->hasFile('image')) {

            $newImages = [];

            foreach ($request->file('image') as $file) {
                $imageName = time() . '_' . uniqid() . '.' . $file->extension();
                $file->storeAs('galleries', $imageName, 'public');
                $newImages[] = $imageName;
            }

            // merge old + new
            $gallery->images = array_merge($gallery->images ?? [], $newImages);
        }

        // 3. UPDATE TEXT FIELDS
        $gallery->title = $validated['name'];
        $gallery->description = $validated['description'] ?? '';

        $gallery->save();

        return redirect('/all-galleries')
            ->with('success', 'Gallery updated successfully!');
    }

    public function showGalleryDetails($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('galleries/gallery-details', compact('gallery'));
    }
}
