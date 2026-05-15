<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebController extends Controller {
    public function showLogin() {
        return view('auth.login');
    }

    public function handleLogin(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }

    public function dashboard() {
        $laboratories = Laboratory::all();
        return view('dashboard', compact('laboratories'));
    }

    public function toggleStatus(Request $request, $id) {
        $lab = Laboratory::findOrFail($id);

        if ($request->status === 'Occupied') {
            $request->validate(['section_name' => 'required|string']);
            $lab->status = 'Occupied';
            $lab->faculty_name = Auth::user()->name;
            $lab->section_name = $request->section_name;
        } else {
            $lab->status = 'Available';
            $lab->faculty_name = null;
            $lab->section_name = null;
        }

        $lab->save();
        return back()->with('success', "Room {$lab->room_number} updated successfully.");
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}