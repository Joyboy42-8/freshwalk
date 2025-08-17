<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Activity;
use App\Models\User;

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
    public function store(LoginRequest $request, User $user): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->intended(route('admin.panel', absolute: false));
        }

        try {
            Activity::create([
                "user_id" => $user->id,
                "action" => "Utilisateur connecté",
                "subject_type" => User::class,
                "subject_id" => $user->id
            ]);
        } catch (\Throwable $e) {
            // Affiche l'erreur si ça plante
            return redirect()->back()->with('error', 'Erreur lors de la création du log : '.$e->getMessage());
        }

        return redirect()->intended(route('dashboard.home', absolute: false));
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
