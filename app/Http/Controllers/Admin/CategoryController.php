<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::latest()->paginate(5);
        return view('admin.category.index', ['categories' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'mm_name' => 'required'
        ]);

        $name = request()->name;
        $mm_name = request()->mm_name;
        $slug = Str::slug($name) . uniqid();
        $cre = ['slug' => $slug, 'name' => $name, 'mm_name' => $mm_name];
        Category::create($cre);
        return redirect()->back()->with('success', 'Created successfully');
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
        $cat = Category::where('slug', $id)->first();
        if (!$cat) {
            return redirect()->back()->with('error', 'Category is not found');
        }
        return view('admin.category.edit', ['category' => $cat]);
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
        $cat = Category::where('slug', $id)->first();
        if (!$cat) {
            return redirect()->back()->with('error', 'Category is not found');
        }
        $name = $request->name;
        $slug = Str::slug($name) . uniqid();
        Category::where('slug', $id)->update([
            'name' => $name,
            'mm_name' => request()->mm_name,
            'slug' => $slug
        ]);
        return redirect('/admin/category')->with('success', 'Edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Category::where('slug', $id);
        $cat->delete();
        return redirect()->back()->with('success', 'Your category is deleted successfully');
    }
}
