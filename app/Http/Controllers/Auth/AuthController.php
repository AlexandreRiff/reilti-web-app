<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class AuthController extends Controller
{
    public function index()
    {
        $autenticated = auth()->check();

        if (!$autenticated) {
            return view('auth.index');
        }

        return redirect()->route('resource.index');
    }

    public function login(Request $request)
    {
        $credentialsValidated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $isValidUser = auth()->attempt($credentialsValidated);

        if (!$isValidUser) {
            return redirect()->route('auth.index');
        }

        $request->session()->regenerate();

        return redirect()->intended('/');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.index');
    }


    public function forgotPasswordShow()
    {
        return view('auth.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        $emailValidated = $request->validate([
            'email' => [
                'required',
                'email'
            ]
        ]);

        $status = Password::sendResetLink($emailValidated);

        if ($status === Password::RESET_LINK_SENT) {
            return back()->withSuccess(__($status));
        }

        return back()->withError(__($status));
    }

    public function resetPasswordShow(Request $request)
    {
        $token = $request->token;
        $email = $request->email;

        return view('auth.reset-password', compact('token', 'email'));
    }

    public function resetPassword(Request $request)
    {
        $credentialsValidated = $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $credentialsValidated,
            function (User $user, string $password) {
                $user->password = $password;
                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('auth.index')->withSuccess(__($status));
        }

        return back()->withError(__($status));
    }
}
