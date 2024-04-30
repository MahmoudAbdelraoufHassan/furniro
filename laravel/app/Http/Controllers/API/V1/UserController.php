<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $users = User::with(['orders' , 'reviews'])->get();
        $users = User::all();
        return response()->json(['users' => $users], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:supervisor,moderator',
            'status' => 'required|in:active,inactive',
            'avatar' => 'sometimes|required|image'
        ]);

        // If validation fails, return an error response
        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        // Initialize $url variable
        $url = null;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs('public/uploads', $filename); // Store in the 'public/uploads' directory
            $url = Storage::url('uploads/'.$filename); // Generate the URL starting from the 'storage' directory
        }

        // Create a new user record
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => 'user',
            'status' => $request->input('status'),
            'avatar' => $url,
            'birthdate' => $request->input('birthdate'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'bio' => $request->input('bio'),
        ]);

        // Return a success response with the new user data
        return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
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
        $products = User::where('name', 'like', "%{$query}%")->get();
//
//        // Return search results
        return response()->json(['products' => $products]);
    }


    public function show($id)
    {

        $user = User::with(['orders' , 'reviews' , 'cart'])->find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Return a JSON response with the user data
        return response()->json(['user' => $user], 200);
    }



    public function update(Request $request, string $id)
    {

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Product not found'], Response::HTTP_NOT_FOUND);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|string|min:8',
            'role' => 'in:supervisor,moderator',
            'status' => 'in:active,inactive',
            'avatar' => 'sometimes|required|image'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }


        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs('uploads', $filename, 'public');
            $url = Storage::disk('public')->url('uploads/'.$filename);

            // Update the product's thumbnail URL
            $user->avatar = $url;
        }
        $user->update($request->except('avatar'));
        return response()->json(['message' => 'User updated successfully', 'User' => $user]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the user with the given ID
        $user = User::find($id);

        // If user not found, return an error response
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Delete the user record
        $user->delete();

        // Return a success response
        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}

