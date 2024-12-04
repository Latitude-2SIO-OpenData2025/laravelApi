<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Http\Resources\AdminResource;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Administrator::get();
        // If there are admins
        if ($admins->count() > 0) {
            return AdminResource::collection($admins);
        }
        // If there are no admins
        else {
            return response()->json([
                'status' => 'success',
                'message' => 'No admin found',
                'data' => []
            ], 200);
        }

    }

    // Store a new admin
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:administrators,email',
            'password' => 'required|string|min:6',
            'is_superadmin' => 'required|boolean',
            'is_active' => 'required|boolean',
        ]);

        // If the validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->messages()
            ], 422);
        }

        // Create the admin
        $admin = Administrator::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_superadmin' => $request->is_superadmin,
            'is_active' => $request->is_active,
        ]);

        // Return the response
        return response()->json([
            'status' => 'success',
            'message' => 'Admin created successfully',
            'admin' => new AdminResource($admin)
        ], 201);
    }

    // Show a single admin
    public function show(Administrator $admin)
    {
        // Return the response
        return new AdminResource($admin);
    }
    
    public function update(Administrator $admin, Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:administrators,email,' . $admin->id,
            'password' => 'required|string|min:6',
            'is_superadmin' => 'required|boolean',
            'is_active' => 'required|boolean',
        ]);

        // If the validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->messages()
            ], 422);
        }

        // Update the admin
        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_superadmin' => $request->is_superadmin,
            'is_active' => $request->is_active,
        ]);

        // Return the response
        return response()->json([
            'status' => 'success',
            'message' => 'Admin updated successfully',
            'admin' => new AdminResource($admin)
        ], 200);

    }

    public function destroy(Administrator $admin)
    {
        // Delete the admin
        $admin->delete();

        // Return the response
        return response()->json([
            'status' => 'success',
            'message' => 'Admin deleted successfully',
        ], 200);
    }
}
