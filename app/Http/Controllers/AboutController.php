<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $about = About::where('user_id', Auth::id())->first();
        return view('about.show', compact('about'));
    }

    public function edit()
    {
        $about = About::where('user_id', Auth::id())->first();
        return view('about.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birthday' => 'nullable|string|max:255',
            'degree' => 'nullable|string|max:255',
            'experience' => 'nullable|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'nullable|string|max:255',
            'freelance' => 'nullable|string|max:255',
            'description' => 'required|string',
            'about_image' => 'nullable|image|max:2048',
        ]);

        $about = About::firstOrNew(['user_id' => Auth::id()]);
        $about->name = $request->name;
        $about->birthday = $request->birthday;
        $about->degree = $request->degree;
        $about->experience = $request->experience;
        $about->phone = $request->phone;
        $about->email = $request->email;
        $about->address = $request->address;
        $about->freelance = $request->freelance;
        $about->description = $request->description;

        if ($request->hasFile('about_image')) {
            if ($about->about_image) {
                Storage::delete($about->about_image);
            }
            $about->about_image = $request->file('about_image')->store('about_images');
        }

        $about->user_id = Auth::id();
        $about->save();

        return redirect()->back()->with('success', 'About info updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(About $about)
    {
        $about = About::where('user_id', Auth::id())->first();
        if ($about) {
            // Fayllarni ham o'chirish
            if ($about->about_image) {
                Storage::delete($about->about_image);
            }
            $about->delete();
            return redirect()->back()->with('success', 'About ma\'lumotlari o‘chirildi!');
        }
        return redirect()->back()->with('error', 'Ma\'lumot topilmadi.');
    }
}
