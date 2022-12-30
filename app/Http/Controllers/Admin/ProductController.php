<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductAddTransition;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // Show Admin Home Product
    public function index()
    {
        $products = Product::latest()->select('slug', 'name', 'image', 'total_quantity')->paginate('3');
        return view('admin.product.index', compact('products'));
    }

    // Show Admin Create Product
    public function create()
    {
        $suppliers = Supplier::all();
        $brands = Brand::all();
        $colors = Color::all();
        $categories = Category::all();
        return view('admin.product.create', compact('suppliers', 'brands', 'colors', 'categories'));
    }

    // Store Admin Product
    public function store(Request $request)
    {
        // validation
        $request->validate([
            'brand_slug' => 'required',
            'supplier_id' => 'required',
            'buying_price' => 'required',
            'name' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,webp|max:2048',
            'sale_price' => 'required',
            'total_quantity' => 'required',
            'description' => 'required'
        ]);
        // image upload
        $image = $request->file('image');
        $image_name = uniqid() . $image->getClientOriginalName();
        $image->move(public_path('/images'), $image_name);

        // store product
        $categories = [];
        foreach ($request->category_slug as $c) {
            $category = Category::where('slug', $c)->first();
            if (!$category) {
                return redirect()->back()->with('error', 'category is not found');
            }
            $categories[] = $category->id;
        }

        $brand = Brand::where('slug', $request->brand_slug)->first();
        if (!$brand) {
            return redirect()->back()->with('error', 'brand is not found');
        }

        $supplier = Supplier::where('id', $request->supplier_id)->first();
        if (!$supplier) {
            return redirect()->back()->with('error', 'supplier is not found');
        }

        $colors = [];
        foreach ($request->color_slug as $c) {
            $color = Color::where('slug', $c)->first();
            if (!$color) {
                return redirect()->back()->with('error', 'color is not found');
            }
            $colors[] = $color->id;
        }

        $product = Product::create([
            'brand_id' => $brand->id,
            'supplier_id' => $request->supplier_id,
            'buying_price' => $request->buying_price,
            'slug' => Str::slug($request->name) . uniqid(),
            'name' => $request->name,
            'image' => $image_name,
            'sale_price' => $request->sale_price,
            'discount_price' => $request->discount_price,
            'total_quantity' => $request->total_quantity,
            'like_count' => 0,
            'view_count' => 0,
            'description' => $request->description
        ]);

        // add to product_add_transition

        ProductAddTransition::create([
            'supplier_id' => $request->supplier_id,
            'product_id' => $product->id,
            'total_quantity' => $request->total_quantity
        ]);

        // store in product pivot tables

        $p = Product::find($product->id);
        $p->color()->sync($colors);
        $p->category()->sync($categories);

        return redirect('/admin/add-product_images/' . $p->id)->with('success', 'Created successfully. Add images of this product');
    }

    public function edit($id)
    {
        $suppliers = Supplier::all();
        $brands = Brand::all();
        $colors = Color::all();
        $categories = Category::all();
        $product = Product::where('slug', $id)->with('supplier', 'brand', 'category', 'color')->first();
        return view('admin.product.edit', compact('suppliers', 'brands', 'colors', 'categories', 'product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::where('slug', $id)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        $exisited_product_id = $product->id;

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'buying_price' => 'required|integer',
            'sale_price' => 'required|integer',
            'category_slug' => 'required',
            'brand_slug' => 'required|string',
        ]);

        // image upload

        $image = $request->file('image');
        if ($image) {
            $image_name = uniqid() . $image->getClientOriginalName();
            $image->move(public_path('/images'), $image_name);
        } else {
            $image_name = $product->image;
        }

        // product store
        $categories = [];
        foreach ($request->category_slug as $c) {
            $category = Category::where('slug', $c)->first();
            if (!$category) {
                return redirect()->back()->with('error', 'category is not found');
            }
            $categories[] = $category->id;
        }

        $brand = Brand::where('slug', $request->brand_slug)->first();
        if (!$brand) {
            return redirect()->back()->with('error', 'brand is not found');
        }

        $colors = [];
        foreach ($request->color_slug as $c) {
            $color = Color::where('slug', $c)->first();
            if (!$color) {
                return redirect()->back()->with('error', 'color is not found');
            }
            $colors[] = $color->id;
        }

        $product->update([
            'brand_id' => $brand->id,
            'supplier_id' => $product->supplier_id,
            'buying_price' => $request->buying_price,
            'slug' => Str::slug($request->name) . uniqid(),
            'name' => $request->name,
            'image' => $image_name,
            'sale_price' => $request->sale_price,
            'discount_price' => $request->discount_price,
            'total_quantity' => $product->total_quantity,
            'like_count' => 0,
            'view_count' => 0,
            'description' => $request->description
        ]);

        Product::find($exisited_product_id)->color()->sync($colors);
        Product::find($exisited_product_id)->category()->sync($categories);

        return redirect('/admin/product')->with('success', 'Product is updated successfully');
    }

    public function destroy($id)
    {
        //find product
        $product = Product::where('slug', $id)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        //delete image
        File::delete(public_path('/images/' . $product->image));

        //delete product_color
        $product->color()->sync([]);

        //delete product
        $product->delete();
        return redirect()->back()->with('success', 'Deleted successfully');
    }

    public function imageUpload()
    {
        $file = request()->file('image');
        $file_name = uniqid() . $file->getClientOriginalName();
        $file->move(public_path('/images'), $file_name);
        return asset('/images/' . $file_name);
    }

    public function craeteProductAdd($slug)
    {
        $product = Product::select('slug', 'name', 'total_quantity')->where('slug', $slug)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        $supplier = Supplier::all();

        return view('admin.product.create-product-add', compact('product', 'supplier'));
    }

    public function storeProductAdd(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        //store to add-trans
        ProductAddTransition::create([
            'supplier_id' => $request->supplier_id,
            'product_id' => $product->id,
            'total_quantity' => $request->total_quantity,
            'description' => $request->description
        ]);

        //sum to database
        $product->update([
            'total_quantity' => DB::raw('total_quantity+' . $request->total_quantity)
        ]);

        return redirect('admin/product')->with('success', 'Added successfully');
    }

    public function images()
    {
        $products = Product::select('id', 'name')->latest()->paginate(3);
        $productImages = Image::with('product');
        if (!$productImages->count()) {
            $productImages = [];
        } else {
            $productImages = $productImages->get();
        }

        return view('admin.product.image.index', compact('products', 'productImages'));
    }

    public function showAddImages($id)
    {
        $product = Product::select('id', 'name')->where('id', $id)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }
        return view('admin.product.image.add', compact('product'));
    }

    public function storeImages(Request $request, $id)
    {
        $product = Product::select('id', 'name')->where('id', $id)->with('images')->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        // laravel can't access multiple files, so use php array_map
        // Retrieve the uploaded files from the request object
        $files = $request->file('files');

        // Use the array_map function to iterate over the array of uploaded files

        $uploadedFiles = array_map(function ($file) {
            $image_name = uniqid() . $file->getClientOriginalName();
            $image_url = asset('/images/' . $image_name);

            // Move the uploaded file to a permanent location on the server
            $file->move(public_path('/images'), $image_name);

            // Return the path to the uploaded file
            return  ['image_name' => $image_name, 'image_url' => $image_url];
        }, $files);

        foreach ($uploadedFiles as $file) {
            Image::create([
                'product_id' => $id,
                'image' => $file['image_name'],
                'image_url' => $file['image_url']
            ]);
        }
        return redirect(route('product.create'))->with('success', 'Assigned images to product successfully');
    }

    public function showEditImages($id)
    {
        $product = Product::select('id', 'name')->where('id', $id)->with('images')->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }
        return view('admin.product.image.edit', compact('product'));
    }

    public function updateEditImages(Request $request, $id)
    {
        $product = Product::select('id', 'name')->where('id', $id)->with('images')->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }
        // laravel can't access multiple files, so use php array_map
        // retrieve the uploaded files from the request
        $files = $request->file('files');

        //use array_map function to iterate over the array of uploaded files
        $uploadedFiles = array_map(function ($file) {
            $image_name = uniqid() . $file->getClientOriginalName();
            $image_url = asset('/images/' . $image_name);

            $file->move(public_path('/images'), $image_name);

            return ['image_name' => $image_name, 'image_url' => $image_url];
        }, $files);

        $count = count($uploadedFiles);
        for ($i = 0; $i < $count; $i++) {
            $image = $product->images[$i];
            $file = $uploadedFiles[$i];
            $image->update([
                'product_id' => $product->id,
                'image' => $file['image_name'],
                'image_url' => $file['image_url']
            ]);
        }
        return redirect('/admin/product_images')->with('success', 'Updated Images successfully');
    }
}
