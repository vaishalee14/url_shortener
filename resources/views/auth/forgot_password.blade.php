@extends('layouts.template')
@section('title', 'Forgot Password')

@section('content')
    <div class="auth-card"
        style="max-width: 400px; margin: 80px auto; text-align: center; padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1); border-radius: 10px;">
        <h2 style="margin-bottom: 20px;">Forgot Password</h2>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('password.verify') }}" style="display: flex; flex-direction: column; gap: 15px;">
            @csrf
            <input type="email" name="email" placeholder="Enter your email"
                style="padding: 10px; border: 1px solid #ccc; border-radius: 6px;" required>

            <button type="submit" class="btn"
                style="padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 6px; cursor: pointer;">
                Next
            </button>
        </form>
    </div>
@endsection
