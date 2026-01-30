@extends('layouts.logout')
@section('title', 'Super Admin Dashboard')
@section('content')
    <style>
        .invite-wrapper {
            max-width: 420px;
            margin: 60px auto;
            padding: 25px;
            border-radius: 8px;
            background: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            font-family: Arial, sans-serif;
        }

        .invite-wrapper h2 {
            margin-bottom: 20px;
            font-size: 22px;
            text-align: center;
        }

        .invite-wrapper label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            font-size: 14px;
        }

        .invite-wrapper input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        .invite-wrapper input:focus {
            outline: none;
            border-color: #4f46e5;
        }

        .btn-invite {
            width: 100%;
            padding: 10px;
            background: #4f46e5;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 15px;
            cursor: pointer;
        }

        .btn-invite:hover {
            background: #4338ca;
        }

        .btn-back {
            background: none;
            border: none;
            color: #4f46e5;
            cursor: pointer;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .alert-success {
            color: #155724;
            background: #d4edda;
            padding: 8px 10px;
            border-radius: 4px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .alert-error {
            color: #721c24;
            background: #f8d7da;
            padding: 8px 10px;
            border-radius: 4px;
            margin-bottom: 15px;
            font-size: 14px;
        }
    </style>

    <div class="invite-wrapper">

        <a href="{{ route('super_admin.dashboard') }}" class="btn btn-sm btn-outline-secondary ms-auto">
            ← Back
        </a>

        <h2>Invite Client</h2>

        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert-error">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('invite.send') }}">
            @csrf

            <label>Name</label>
            <input type="text" name="name" placeholder="Enter client name" required>

            <label>Email</label>
            <input type="email" name="email" placeholder="Enter client email" required>

            <button type="submit" class="btn-invite">
                Invite
            </button>
        </form>

    </div>
@endsection
