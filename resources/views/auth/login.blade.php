@extends('layouts.template')

@section('title', 'Login')

@section('content')
    <style>
        .auth-card {
            background: var(--card, #fff);
            padding: 2rem;
            border-radius: 8px;
            max-width: 420px;
            margin: 40px auto;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        }

        .auth-card h2 {
            margin-top: 0;
            color: var(--accent, #007bff);
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: 500;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-top: 6px;
            font-size: 1rem;
        }

        .actions {
            margin-top: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .small-link {
            color: var(--accent, #007bff);
            text-decoration: none;
            font-size: 0.9rem;
        }

        .small-link:hover {
            text-decoration: underline;
        }

        .error {
            color: red;
            font-size: 0.9rem;
            margin-top: 4px;
        }

        .btn {
            background: var(--accent, #007bff);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            background: #0056b3;
        }
    </style>

    <div class="auth-card">
        <h2>Login</h2>

        {{-- Display general error message if credentials are wrong --}}
        @if ($errors->has('email') && !old('password'))
            <div class="error" style="text-align:center; margin-bottom:10px;">
                {{ $errors->first('email') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">

            @csrf

            <label>Email
                <input type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required
                    autofocus>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </label>

            <label>Password
                <input type="password" name="password" placeholder="Enter your password" required>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </label>

            <div class="actions">
                <button type="submit" class="btn">Login</button>

                <a href="{{ route('password.request') }}" class="small-link">Forgot password?</a>

            </div>
        </form>

        <p style="text-align:center; margin-top:1rem;">
            Don't have an account?
            <a href="{{ route('register.form') }}" class="small-link">Register</a>
        </p>
    </div>
@endsection
