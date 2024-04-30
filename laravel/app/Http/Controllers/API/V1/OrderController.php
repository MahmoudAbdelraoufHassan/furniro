<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ordersWithUsersAndProducts = Order::with(['user:id,name', 'products'])->get();
        return $ordersWithUsersAndProducts;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order = Order::create([
            'total_amount'=>$this->total_amount,
            'status'=>$this->status,
            'payment_method'=>$this->payment_method,
            'payment_status'=>$this->payment_status,
            'shipping_address'=>$this->shipping_address,
            'user'=>$this->user
        ]);
        return response()->json(['message' => 'Order created successfully', 'order' => $order]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::with(['user'])->find($id);

        if (!$order) {
            return response()->json(['message' => 'Product not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($order);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Category::find($id);

        if (!$order) {
            return response()->json(['message' => 'Product not found'], Response::HTTP_NOT_FOUND);
        }

        $order->update($request->all());

        return response()->json(['message' => 'Product updated successfully', 'order' => $order]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'order not found'], Response::HTTP_NOT_FOUND);
        }
        $order->delete();

        return response()->json(['message' => 'order deleted successfully']);
    }
}
