<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Laboratory;
use Illuminate\Http\Request;

class LabApiController extends Controller
{
    // Fetch all labs for the dashboard polling
    public function index()
    {
        return response()->json(Laboratory::all());
    }

    // Ashrain's Search Logic: Filters by Room, Faculty, or Section
    public function search(Request $request)
    {
        $query = $request->query('search');

        $results = Laboratory::where('room_number', 'LIKE', "%{$query}%")
            ->orWhere('faculty_name', 'LIKE', "%{$query}%")
            ->orWhere('section_name', 'LIKE', "%{$query}%")
            ->get();

        return response()->json($results);
    }
}