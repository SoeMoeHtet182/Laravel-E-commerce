<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Supplier::latest()->paginate(4);
        return view('admin.supplier.index', ['suppliers' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.supplier.create');
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
            'image' => 'required|mimes:png,jpg,jpeg,webp|max:2048',
            'description' => 'required'
        ]);

        $image = $request->file('image');
        $image_name = uniqid() . $image->getClientOriginalName();
        $image->move(public_path('/images'), $image_name);

        $supplier = new Supplier;
        $supplier->name = $request->name;
        $supplier->image = $image_name;
        $supplier->description = $request->description;
        $supplier->save();

        return redirect('admin/supplier')->with('success', 'Created successfully');
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
        $data = Supplier::where('id', $id)->first();
        return view('admin.supplier.edit', ['supplier' => $data]);
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
            'name' => 'required',
            'description' => 'required'
        ]);

        $supplier = Supplier::where('id', $id)->first();
        if (!$supplier) {
            return redirect()->back()->with('error', 'Supplier not found');
        }

        $image = $request->file('image');
        if ($image) {
            $image_name = uniqid() . $image->getClientOriginalName();
            $image->move(public_path('/images'), $image_name);
        } else {
            $image_name = $supplier->image;
        }

        $name = $request->name;
        $image = $image_name;
        $description = $request->description;
        $supplier->update(['name' => $name, 'description' => $description, 'image' => $image_name]);

        return redirect('admin/supplier')->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::where('slug', $id)->first();
        $supplier->Delete();

        return redirect()->back()->with('success', 'Deleted successfully');
    }
}
