<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the email input
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Send the password reset link to the provided email
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Check the status of the password reset link
        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status)) // Success
                    : back()->withInput($request->only('email')) // Failure
                        ->withErrors(['email' => __($status)]);
    }
}
