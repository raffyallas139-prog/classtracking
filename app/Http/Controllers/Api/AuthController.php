<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {
    public function register(Request $request) {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
            'role' => 'required|string|in:student,faculty'
        ]);

        // Simple identity rule verification: Faculty requires structural vetting manually or automatically
        $autoVerify = ($fields['role'] === 'student'); 

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => Hash::make($fields['password']),
            'role' => $fields['role'],
            'is_verified' => $autoVerify 
        ]);

        $token = $user->createToken('classtrackertoken')->plainTextToken;

        return response()->json(['user' => $user, 'token' => $token], 201);
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response()->json(['message' => 'Bad Credentials'], 401);
        }

        $token = $user->createToken('classtrackertoken')->plainTextToken;

        return response()->json(['user' => $user, 'token' => $token], 200);
    }
}
