<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class login extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        test
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validate request inputs
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to find the user
        $user = User::where('email', $validatedData['email'])->first();

        if (!$user) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Check if the password matches
        if (Hash::check($validatedData['password'], $user->password)) {
            // Generate token
            $deviceName = $request->post('device_name', $request->userAgent());
            $token = $user->createToken($deviceName)->plainTextToken;

            return response()->json(['message' => "Login successful", 'user' => $user, 'token' => $token]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

    public function logout(Request $request)
    {

        $request->user()->tokens()->delete();

        return Response::json(['message' => 'Logged out successfully']);
    }


    public function destroy(string $id)
    {
        //
    }
}
