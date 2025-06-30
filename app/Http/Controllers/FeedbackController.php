<?php

namespace App\Http\Controllers;
use App\Mail\FeedbackMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class FeedbackController
{


    public function submit(Request $request)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'required|email',
            'feedbackType' => 'required|string',
            'rating' => 'required|numeric|min:1|max:5',
            'subject' => 'nullable|string|max:255',
            'priority' => 'nullable|string',
            'message' => 'required|string',
            'allowContact' => 'nullable',
        ]);

        Mail::to('youremail@example.com')->send(new FeedbackMail($data)); // bu yerda sizning email manzilingiz bo'lishi kerak

        return response()->json(['success' => true]);
    }



}
