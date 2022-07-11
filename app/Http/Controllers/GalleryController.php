<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Gallery;


class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Gallery::all();
        return view('gallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
            'image' => 'required|file|mimes:jpeg,jpg,png',
            'description' => 'required',
            'price' => 'min:0'
        ]);

        $file = $request->file('image');
        $img_name = $file->getClientOriginalName();
        $data["image"] = $img_name;
        $file->move('images/', $img_name);
        Gallery::create($data);
        return to_route('gallery.index')->with('store', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Gallery::find($id);
        return view('gallery.show', compact('item'));
    }

    public function edit($id)
    {
        $item = Gallery::find($id);
        return view('gallery.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'nullable|regex:/^[a-zA-Z0-9\s]+$/',
            'image' => 'nullable|file|mimes:jpeg,jpg,png',
            'description' => 'nullable',
            'price' => 'min:0'
        ]);

        $item = Gallery::find($id);
        if($request->hasFile('image'))
        {
            File::delete('images/', $item->image);
            $file = $request->file('image');
            $img_name = $file->getClientOriginalName();
            $data["image"] = $img_name;
            $file->move('images/', $img_name);
        }
        $item->update($data);
        return to_route('gallery.index')->with('update', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Gallery::find($id);
        $item->delete();
        return back()->with('destroy', 'success');
    }
}
