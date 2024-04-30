<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoriesWithProducts = Category::with(['products:id,title,category_id,thumbnail'])->get();
        return $categoriesWithProducts;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|min:0',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate that main_image is an image file
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            if ($request->hasFile('thumbnail')) {
                $image = $request->file('thumbnail');
                $imageName = time() . '_' . $image->getClientOriginalName();
                // Store the image in the public directory
                $image->storeAs('public/images', $imageName);
                // Get the image path
                $imagePath = 'storage/images/' . $imageName;
            } else {
                throw new \Exception('No image provided');
            }

            $category = Category::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'thumbnail' => $imagePath,
            ]);

            return response()->json(['message' => 'Category created successfully', 'category' => $category]);
        } catch (\Exception $e) {
            // Log the error message
            \Log::error($e->getMessage());
            // Return a response indicating the error
            return response()->json(['error' => 'Failed to store image'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
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
        $products = Category::where('name', 'like', "%{$query}%")->get();
//
//        // Return search results
        return response()->json(['products' => $products]);
    }


    public function show(string $id)
    {
        $category = Category::with(['products:category_id,title'])->find($id);

        if (!$category) {
            return response()->json(['message' => 'Product not found'], Response::HTTP_NOT_FOUND);
        }



        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], Response::HTTP_NOT_FOUND);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
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
            $category->thumbnail = $url;
        }

        // Update the product details
        $category->update($request->except('thumbnail'));

        return response()->json(['message' => 'Product updated successfully', 'product' => $category]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Product not found'], Response::HTTP_NOT_FOUND);
        }
        $category->products()->delete();
        $category->delete();

        return response()->json(['message' => 'category deleted successfully']);
    }
}
