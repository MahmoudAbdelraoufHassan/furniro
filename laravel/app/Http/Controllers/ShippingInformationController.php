<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShippingInformationRequest;
use App\Http\Requests\UpdateShippingInformationRequest;
use App\Models\ShippingInformation;

class ShippingInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShippingInformationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ShippingInformation $shippingInformation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShippingInformation $shippingInformation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShippingInformationRequest $request, ShippingInformation $shippingInformation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShippingInformation $shippingInformation)
    {
        //
    }
}
