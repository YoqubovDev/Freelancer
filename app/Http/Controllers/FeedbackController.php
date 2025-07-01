<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\FeedbackMail;

class FeedbackController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'required|email',
            'feedbackType' => 'required|string',
            'rating' => 'required|numeric|min:1|max:5',
            'subject' => 'nullable|string',
            'priority' => 'nullable|string',
            'message' => 'required|string',
            'allowContact' => 'nullable',
        ]);

        Mail::to('xiyobidasturchi0011@gmail.com')->send(new FeedbackMail($data));

        return response()->json(['success' => true]);
    }
}
