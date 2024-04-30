<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $reviews = Review::all();
        return response()->json($reviews);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        $validator = Validator::make($request->all(), [
//            'product_id' => 'required|exists:products,id',
//            'user_id' => 'required|exists:users,id',
//            'rating' => 'required|integer|min:1|max:5',
//            'comment' => 'nullable|string',
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json(['errors' => $validator->errors()], 422);
//        }

        $review = Review::create($request->all());
        return Response::json(['message' => 'Review updated successfully' , 'status' => 200 , 'reviews' => $review]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $review = Review::with(['product' , 'user'])->find($id);
        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }
        return response()->json($review, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'rating' => 'sometimes|required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $review = Review::find($id);
        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        $review->update($request->all());
        return response()->json($review, 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $review =Review::find($id);

        if (!$review) {
            return response()->json(['message' => 'Review not found']);
        }

        $review->delete();

        return response()->json(['message' => 'Review deleted successfully', 'review' => $review]);
    }
}
