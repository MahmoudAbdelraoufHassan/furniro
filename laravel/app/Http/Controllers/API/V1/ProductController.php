<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImages;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::with(['category:id,name'])->get();

        $products->each(function ($product) {
            $imageUrls = $product->images->pluck('path')->toArray();
            $product->imageUrls = $imageUrls;
        });

// Return the modified products
        return $products;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust as needed
            'images.*' => 'required', // Validation for multiple images
        ]);

        // Check for validation errors
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Store the thumbnail image
        $thumbnail = $request->file('thumbnail');
        $thumbnailName = time() . '_' . $thumbnail->getClientOriginalName();
        $thumbnail->storeAs('public/images', $thumbnailName);
        $thumbnailPath = 'storage/images/' . $thumbnailName;

        $product = Product::create([
            'title' => $request->input('title'),
            'stock' => $request->input('stock'),
            'price' => $request->input('price'),
            'thumbnail' => $thumbnailPath,
        ]);

        // Store the additional images
        if ($request->hasFile('images')) {
            $imagesData = [];
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('public/images', $imageName);
                $imagePath = 'storage/images/' . $imageName;
                $imagesData[] = [
                    'product_id' => $product->id,
                    'filename' => $imageName,
                    'path' => $imagePath,
                ];
            }

            ProductImages::insert($imagesData);
        }

        return response()->json(['message' => 'Product created successfully', 'product' => $product , 'related_images'=>$imagesData]);
    }

    /**
     * Display the specified resource.
     */

    public function search(Request $request)
    {
        // Validate search query
        $request->validate([
            'query' => 'required|string',
        ]);


        // Perform the search
        $query = $request->input('query');
        $products = Product::where('title', 'like', "%{$query}%")->get();
//
//        // Return search results
        return response()->json(['products' => $products]);
    }
    public function show(string $id)
    {
        $product = Product::with('images')->find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], Response::HTTP_NOT_FOUND);
        }

        $imageUrls = $product->images->pluck('path')->toArray();
        $product->imageUrls = $imageUrls;
        return response()->json([$product]);
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], Response::HTTP_NOT_FOUND);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'quantity' => 'sometimes|required|integer|min:0',
            'price' => 'sometimes|required|numeric|min:0',
            'thumbnail' => 'sometimes|required|image', // Validate that the thumbnail is an image
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs('uploads', $filename, 'public');
            $url = Storage::disk('public')->url('uploads/'.$filename);

            // Update the product's thumbnail URL
            $product->thumbnail = $url;
        }

        // Update the product details
        $product->update($request->except('thumbnail'));

        return response()->json(['message' => 'Product updated successfully', 'product' => $product]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], Response::HTTP_NOT_FOUND);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully', 'product' => $product]);
    }
}
