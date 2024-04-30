<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\ShippingInformation;
use Illuminate\Http\Request;

class ShippingInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shippingInformation = ShippingInformation::all();
        return response()->json($shippingInformation);
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
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'zip_code' => 'required|string',
        ]);

        $shippingInformation = ShippingInformation::create($request->all());
        return response()->json($shippingInformation, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $shippingInformation = ShippingInformation::findOrFail($id);
        return response()->json($shippingInformation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'address' => 'string',
            'city' => 'string',
            'state' => 'string',
            'country' => 'string',
            'zip_code' => 'string',
        ]);

        $shippingInformation = ShippingInformation::findOrFail($id);
        $shippingInformation->update($request->all());
        return response()->json($shippingInformation, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $shippingInformation = ShippingInformation::findOrFail($id);
        $shippingInformation->delete();
        return response()->json(null, 204);
    }
}
