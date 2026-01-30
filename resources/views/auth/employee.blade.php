@extends('layouts.template')
@section('title', 'Employee')

@section('content')
    <style>
        .auth-card {
            background: var(--card);
            padding: 2rem;
            border-radius: 8px;
            max-width: 420px;
            margin: 40px auto;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        }

        .auth-card h2 {
            margin-top: 0;
            color: var(--accent);
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
        }

        .actions {
            margin-top: 1rem;
            display: flex;
            justify-content: center;
        }

        .text-danger {
            color: #e74c3c;
            font-size: 0.9rem;
        }

        /* Popup Styles */
        .popup {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #28a745;
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            opacity: 0;
            transform: translateY(-20px);
            transition: all 0.4s ease;
            z-index: 9999;
        }

        .popup.show {
            opacity: 1;
            transform: translateY(0);
        }

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
    {{-- Success Popup --}}
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="auth-card">
        <h2>Employee Form</h2>

        <form action="{{ route('employee.store') }}" method="POST">
            @csrf

            <label>Full Name
                <input type="text" name="name" placeholder="Enter Employee name" value="{{ old('name') }}" required>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </label>

            <label>Phone Number
                <input type="text" name="phone_number" placeholder="Enter Employee's phone number"
                    value="{{ old('phone_number') }}" required>
                @error('phone_number')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </label>

            <label>Email
                <input type="email" name="email" placeholder="Enter Employee's email" value="{{ old('email') }}"
                    required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </label>

            <label>Address
                <input type="text" name="address" placeholder="Enter Employee's District" value="{{ old('address') }}">
                @error('address')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </label>

            <label>Password
                <input type="password" name="password" placeholder="Enter Tehsil" required>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </label>

            <div class="actions">
                <button type="submit" class="btn">Submit</button>
            </div>
        </form>

        <p style="text-align:center;margin-top:1rem;">
            Alreay Employee is created?
            {{-- <a href="{{ route('login') }}" style="color:var(--accent);text-decoration:none;">Login</a> --}}
        </p>
    </div>



    @if (session('success'))
        <script>
            setTimeout(function() {
                window.location.href = "{{ route('login.form') }}";
            }, 3000); // redirect after 3 seconds
        </script>
    @endif

    </script>
@endsection
