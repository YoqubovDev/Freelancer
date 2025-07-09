<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
        return response()->json(Education::orderBy('id', 'desc')->get());
    }
// app/Http/Controllers/EducationController.php

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'institution' => 'nullable|string|max:255',
            'period' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);
        $education = Education::create($validated);
        return response()->json($education, 201);
    }

    public function update(Request $request, $id)
    {
        $education = Education::findOrFail($id);
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'institution' => 'nullable|string|max:255',
            'period' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);
        $education->update($validated);
        return response()->json($education);
    }

    public function show($id)
    {
        $education = Education::findOrFail($id);
        return response()->json($education);
    }

    public function destroy($id)
    {
        Education::destroy($id);
        return response()->json(null, 204);
    }
}
