<?php

namespace App\Http\Controllers;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;



class AdminController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }


    public function show()
    {
        $profile = Profile::where('user_id', Auth::id())->first();
        return view('profile.show', compact('profile'));
    }

    public function edit()
    {
        $profile = Profile::where('user_id', Auth::id())->first();
        return view('profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'profile_image' => 'nullable|image',
            'cv_file' => 'nullable|mimes:pdf|max:5120',
            'video_url' => 'nullable|url',
        ]);

        $profile = Profile::firstOrNew(['user_id' => Auth::id()]);
        $profile->name = $request->name;
        $profile->title = $request->title;
        $profile->description = $request->description;
        $profile->video_url = $request->video_url;

        if ($request->hasFile('profile_image')) {
            if ($profile->profile_image) {
                Storage::delete($profile->profile_image);
            }
            $profile->profile_image = $request->file('profile_image')->store('profile_images');
        }

        if ($request->hasFile('cv_file')) {
            if ($profile->cv_file) {
                Storage::delete($profile->cv_file);
            }
            $profile->cv_file = $request->file('cv_file')->store('cv_files');
        }

        $profile->user_id = Auth::id();
        $profile->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }





}
