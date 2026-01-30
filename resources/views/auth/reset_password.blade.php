@extends('layouts.template')
@section('title', 'Reset Password')

@section('content')

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="auth-card"
        style="max-width: 400px; margin: 80px auto; text-align: center; padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1); border-radius: 10px;">
        <h2 style="margin-bottom: 20px;">Reset Password</h2>

        <form method="POST" action="{{ route('password.update', $user->user_id) }}"
            style="display: flex; flex-direction: column; gap: 15px;">
            @csrf
            @method('PUT')

            <input type="password" name="password" placeholder="New Password"
                style="padding: 10px; border: 1px solid #ccc; border-radius: 6px;" required>

            <input type="password" name="password_confirmation" placeholder="Confirm Password"
                style="padding: 10px; border: 1px solid #ccc; border-radius: 6px;" required>

            <button type="submit" class="btn"
                style="padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 6px; cursor: pointer;">
                Update Password
            </button>
        </form>
    </div>



    @if (session('success'))
        <script>
            setTimeout(function() {
                window.location.href = "{{ route('login.form') }}";
            }, 3000); // redirect after 3 seconds
        </script>
    @endif

    <style>
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 25px;
            display: block;
            /* visible by default */
        }
    </style>

@endsection
