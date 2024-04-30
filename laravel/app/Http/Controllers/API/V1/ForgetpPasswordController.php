<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\ForgetpPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgetpPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function forgotPassword(Request $request)
    {
        // Validate the request (e.g., check if email is provided and valid)
        $request->validate([
            'email' => 'required|email',
        ]);

        // Generate a unique token
        $token = Str::random(60);

        // Store the token in the database
        ForgetpPassword::create([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
        ]);

        // Return a response indicating that the reset email has been sent
        return response()->json(['message' => 'Reset email sent.']);
    }



    public function resetPassword(Request $request)
    {
        // Validate request data (e.g., token, new password)
        $request->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|min:8', // Example validation for password
        ]);

        // Find the password reset record by email and token
        $passwordReset = ForgetpPassword::where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        // Check if the password reset record exists
        if (!$passwordReset) {
            return response()->json(['message' => 'Invalid or expired token'], 400);
        }

        // Check if the token is expired (you may add an expiration time in your password reset table)
        // Example: if ($passwordReset->created_at->addMinutes(60)->isPast()) { ... }

        // Find the user by email (assuming your user model is App\Models\User)
        $user = User::where('email', $request->email)->first();

        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete the password reset record from the database
        $passwordReset->delete();

        // Respond with a success message
        return response()->json(['message' => 'Password reset successfully'], 200);
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
    public function destroy(string $id)
    {
        //
    }
}
