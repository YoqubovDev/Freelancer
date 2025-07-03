<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::all();
        return view('educations.index', compact('educations'));
    }

    public function create()
    {
        return view('educations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'degree' => 'required',
            'institution' => 'required',
            'year' => 'required',
            'description' => 'nullable',
        ]);

        $education = Education::create($request->only(['degree', 'institution', 'year', 'description']));

        // AJAX yoki JSON so‘rov bo‘lsa, JSON qaytaradi
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => "Education created successfully.",
                'data' => $education,
            ]);
        }
        // Oddiy form POST uchun
        return redirect()->route('educations.index')->with('success', 'Education created successfully.');
    }

    public function show(Education $education)
    {
        return view('educations.show', compact('education'));
    }

    public function edit(Education $education)
    {
        return view('educations.edit', compact('education'));
    }

    public function update(Request $request, Education $education)
    {
        $request->validate([
            'degree' => 'required',
            'institution' => 'required',
            'year' => 'required',
            'description' => 'nullable',
        ]);

        $education->update($request->all());
        return redirect()->route('educations.index')->with('success', 'Education updated successfully.');
    }

    public function destroy(Education $education)
    {
        $education->delete();
        return redirect()->route('educations.index')->with('success', 'Education deleted successfully.');
    }
}
