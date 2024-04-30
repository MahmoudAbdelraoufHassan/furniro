<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\CustomerWishlist;
use Illuminate\Http\Request;

class CustomerWishListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wishlists = CustomerWishlist::all();
        return response()->json(['wishlists' => $wishlists]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
        ]);

        $wishlist = CustomerWishlist::create($request->all());

        return response()->json(['message' => 'Wishlist item created successfully', 'wishlist' => $wishlist], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $wishlist = CustomerWishlist::findOrFail($id);
        return response()->json(['wishlist' => $wishlist]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
        ]);

        $wishlist = CustomerWishlist::findOrFail($id);
        $wishlist->update($request->all());

        return response()->json(['message' => 'Wishlist item updated successfully', 'wishlist' => $wishlist]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        {
            $wishlist = CustomerWishlist::findOrFail($id);
            $wishlist->delete();

            return response()->json(['message' => 'Wishlist item deleted successfully']);
        }
    }
}
