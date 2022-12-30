<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Brand::latest()->paginate(5);
        return view('admin.brand.index', ['brands' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        $image = $request->file('image');
        $image_name = uniqid() . $image->getClientOriginalName();
        $image->move(public_path('/images'), $image_name);

        $brand = new Brand;
        $brand->name = $request->name;
        $brand->image = $image_name;
        $brand->slug = Str::slug($request->name) . uniqid();
        $brand->save();

        return redirect('admin/brand')->with('success', 'Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Brand::where('slug', $id)->first();

        return view('admin.brand.edit', ['brand' => $data]);
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
        $request->validate([
            'name' => 'required'
        ]);

        $brand = Brand::where('slug', $id)->first();
        if (!$brand) {
            return redirect()->back()->with('error', 'Brand not found');
        }
        $image = $request->file('image');
        if ($image) {
            $image_name = uniqid() . $image->getClientOriginalName();
            $image->move(public_path('/images'), $image_name);
        } else {
            $image_name = $brand->image;
        }
        $name = $request->name;
        $slug = Str::slug($name) . uniqid();
        $brand->update(['name' => $name, 'slug' => $slug, 'image' => $image_name]);

        return redirect('/admin/brand')->with('success', 'Edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::where('slug', $id)->first();
        $brand->Delete();

        return redirect()->back()->with('success', 'Deleted successfully');
    }
}
