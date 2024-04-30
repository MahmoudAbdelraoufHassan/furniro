<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shoppingCartItems = ShoppingCart::with(['user:id,name' , 'products'])->get();

        return response()->json($shoppingCartItems);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Create a new shopping cart item
        $shoppingCartItem = ShoppingCart::create([
            'user_id' => $request->user_id,
            'product_id' => $validatedData['product_id'],
            'quantity' => $validatedData['quantity'],
        ]);
        return Response::json(['message' => 'The Cart Created Successfully' , 'status'=>201 , 'shoppingCartItem' => $shoppingCartItem]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $shoppingCartItem = ShoppingCart::with(['user:id,name'])->findOrFail($id);

        return response()->json($shoppingCartItem);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
//        $validatedData = $request->validate([
//            'quantity' => 'required|integer|min:1',
//        ]);
//
//        // Find the shopping cart item
        $shoppingCartItem = ShoppingCart::with('user')->findOrFail($id);
//
//        // Update the quantity
        $shoppingCartItem->quantity = $request->quantity;
//        $shoppingCartItem->save();

        return Response::json(['message' => 'The Cart Updated Successfully' , 'shoppingCartItem'=>$shoppingCartItem]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        {
            $cart = ShoppingCart::find($id);

            if (!$cart) {
                return response()->json(['message' => 'cart not found']);
            }
            $cart->delete();

            return response()->json(['message' => 'cart deleted successfully']);
        }
    }
}
