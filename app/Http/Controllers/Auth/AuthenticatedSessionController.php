<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Auth attempt
        $request->authenticate();
        $request->session()->regenerate();

        // Foydalanuvchini olish va rollarni yuklash
        $user = Auth::user()->load('roles'); // roles bilan birga yuklash
        $roles = $user->roles->pluck('name'); // faqat role nomlari kolleksiyasi

        // Roli asosida yo'naltirish
        if ($roles->contains('admin')) {
            return redirect()->route('admin.dashboard');
        }

        if ($roles->contains('moderator')) {
            return redirect()->route('moderator.panel');
        }

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
