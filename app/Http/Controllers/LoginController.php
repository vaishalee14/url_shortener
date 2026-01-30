<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\password;

class LoginController extends Controller
{

    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate form inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Create and save user
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role_id = 1;
        $user->save();

        // Redirect with success message
        return redirect()->back()->with('success', 'User registered successfully!');
    }

    public function logout()
    {
        return view('auth.login');
    }

    /**
     * Display the specified resource.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate input fields
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate user
        if (Auth::attempt($request->only('email', 'password'))) {

            $request->session()->regenerate();

            $user = Auth::user(); // ✅ already authenticated user

            if ($user->role_id == 1) {
                return redirect()->route('super_admin.dashboard')
                    ->with('success', 'User logged in successfully!');
            } elseif ($user->role_id == 2) {
                return redirect()->route('client_admin.dashboard')
                    ->with('success', 'User logged in successfully!');
            } else {

                return redirect()->route('member.dashboard')
                    ->with('success', 'User logged in successfully!');
            }
        }

        // ✅ Runs when authentication fails
        return back()
            ->with('error', 'Invalid email or password.')
            ->onlyInput('email');
    }

    public function redirectToDashboard(User $user)
    {
        return match ($user->role_id) {
            1 => route('super_admin.dashboard'),
            2 => route('client_admin.dashboard'),
            default => route('member.dashboard'),
        };
    }
    // Forgot Form

    public function showForgotForm()
    {
        return view('auth.forgot_password');
    }

    // Verifying the Email

    public function verifyEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email not found!');
        }

        // Redirect to password reset form
        return redirect()->route('password.reset', $user->user_id);
    }

    public function showResetForm($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('password.request')->with('error', 'Invalid user!');
        }

        return view('auth.reset_password', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->back()->with('success', 'Password updated successfully! Redirecting to login...');
    }
}
