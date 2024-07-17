<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query();
        $query    = $request->input('search');
        $sortBy   = $request->input('sort_by', 'asc'); // Default to 'asc' if not provided

        if (isset($query)) {
            $products->where('name', 'like', "%{$query}%")
                ->orWhere('price', 'like', "%{$query}%")
                ->orWhere('discount', 'like', "%{$query}%")
                ->orWhere('status', 'like', "%{$query}%");
        }

        if (isset($sortBy)) {
            $products->orderBy('price', $sortBy);
        }

        $products = $products->paginate(10);

        if ($request->ajax()) {
            return view('product.filtered-product', compact('products'))->render();
        }

        return view('product.index', compact('products'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'name'      => 'required|string|max:255',
                'price'     => 'required|numeric',
                'discount'  => 'required|numeric',
                'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'images.*'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'status'    => 'required',
            ]);

            if ($validation->fails()) {
                return response()->json([
                    'success' => false,
                    'error' => $validation->errors()
                ]);
            }

            $product           = new Product();
            $product->name     = $request->input('name');
            $product->price    = $request->input('price');
            $product->discount = $request->input('discount');
            $product->status   = $request->input('status');

            if ($request->hasFile('thumbnail')) {
                $thumbnail          = $request->file('thumbnail')->store('thumbnails', 'public');
                $product->thumbnail = $thumbnail;
            }

            if ($request->hasFile('images')) {
                $images = [];
                foreach ($request->file('images') as $image) {
                    $images[]    = $image->store('images', 'public');
                }
                $product->images = json_encode($images);
            }

            $product->save();

            return response()->json([
                'success' => true,
                'status' => 'Product created successfully.',
                'link' => route('products.index')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'status' => $e->getMessage()
            ]);
        }
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        try {
            $validation = Validator::make($request->all(), [
                'name'      => 'required|string|max:255',
                'price'     => 'required|numeric',
                'discount'  => 'required|numeric',
                'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'images.*'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'status'    => 'required',
            ]);

            if ($validation->fails()) {
                return response()->json([
                    'success' => false,
                    'error' => $validation->errors()
                ]);
            }

            $product->name     = $request->input('name');
            $product->price    = $request->input('price');
            $product->discount = $request->input('discount');
            $product->status   = $request->input('status');

            if ($request->hasFile('thumbnail')) {
                $thumbnail          = $request->file('thumbnail')->store('thumbnails', 'public');
                $product->thumbnail = $thumbnail;
            }

            if ($request->hasFile('images')) {
                $images = [];
                foreach ($request->file('images') as $image) {
                    $images[]    = $image->store('images', 'public');
                }
                $product->images = json_encode($images);
            }

            $product->save();

            return response()->json([
                'success' => true,
                'status' => 'Product created successfully.',
                'link' => route('products.index')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'status' => $e->getMessage()
            ]);
        }
    }

    public function delete(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
