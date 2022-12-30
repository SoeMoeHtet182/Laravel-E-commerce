<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('user.home');
    }

    public function about()
    {
        return view('user.aboutUs');
    }

    public function contact()
    {
        return view('user.contactUs');
    }

    public function allProducts(Request $request)
    {
        $brands = Brand::all();
        $category = Category::all();

        if ($request->product == 'all') {
            $products = Product::orderBy('id', 'ASC');
        } else {
            $products = Product::latest();
        }

        if ($category_slug = $request->category) {
            $findCategory = Category::where('slug', $category_slug)->first();
            if (!$findCategory) {
                return redirect('/products')->with('error', 'Category not found');
            }

            $products->whereHas('category', function ($p) use ($findCategory) {
                $p->where('category_product.category_id', $findCategory->id);
            });
        }

        if ($brand_slug = $request->brand) {
            $findBrand = Brand::where('slug', $brand_slug)->first();
            if (!$findBrand) {
                return redirect('/products')->with('error', 'Brand not found');
            }
            $products->where('brand_id', $findBrand->id);
        }

        if ($search = $request->search) {
            $products->where('name', 'like', "%$search%");
        }

        $products = $products->paginate(12);

        return view('user.allProducts', compact('brands', 'products'));
    }

    public function showProfile()
    {
        return view('user.profile');
    }

    public function showEditUserInfo($id)
    {
        $user = User::where('id', $id)->with('level')->first();
        if (!$user) {
            return redirect()->back()->with('error', 'User not Found');
        }
        return view('user.editProfile', compact('user'));
    }

    public function updateUserInfo(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'required',
            'display_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'postal_code' => 'required'
        ]);

        $user = User::where('id', $id)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        $user->update([
            'full_name' => $request->full_name,
            'display_name' => $request->display_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'postal_code' => $request->postal_code
        ]);
        return redirect('/profile#');
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }
        $user->delete();
        return redirect('/login')->with('success', 'Your account is deleted.');
    }
}
