<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Laboratory; // Note: Ensure an empty file exists at app/Models/Laboratory.php extending Model
use Illuminate\Http\Request;

class LaboratoryController extends Controller {
    // Student & Faculty view: Fetches current status records
    public function index() {
        return response()->json(Laboratory::all(), 200);
    }

    // Comprehensive dynamic search module (Ashrain's unified search base)
    public function search(Request $request) {
        $query = Laboratory::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('room_number', 'LIKE', "%{$search}%")
                  ->orWhere('faculty_name', 'LIKE', "%{$search}%")
                  ->orWhere('section_name', 'LIKE', "%{$search}%");
        }

        return response()->json($query->get(), 200);
    }

    // Protected logging method accessed strictly by verified Faculty
    public function updateStatus(Request $request, $id) {
        $lab = Laboratory::findOrFail($id);

        $request->validate([
            'status' => 'required|in:Available,Occupied',
            'section_name' => 'required_if:status,Occupied|nullable|string',
        ]);

        if ($request->status === 'Occupied') {
            $lab->status = 'Occupied';
            $lab->faculty_name = $request->user()->name; // Tracks logging faculty name automatically
            $lab->section_name = $request->section_name;
        } else {
            $lab->status = 'Available';
            $lab->faculty_name = null;
            $lab->section_name = null;
        }

        $lab->save();

        return response()->json([
            'message' => 'Laboratory status updated successfully',
            'laboratory' => $lab
        ], 200);
    }
}
