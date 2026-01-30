@extends('layouts.logout')
@section('title', 'Client Dashboard')
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <!-- Card -->
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">

                        <!-- Header -->
                        <div class="d-flex align-items-center mb-4">
                            <h4 class="mb-0 fw-semibold">Invite Client</h4>

                            <!-- Back Button -->
                            <a href="{{ route('client_admin.dashboard') }}" class="btn btn-sm btn-outline-secondary ms-auto">
                                ← Back
                            </a>
                        </div>

                        <!-- Alerts -->
                        @if (session('success'))
                            <div class="alert alert-success py-2">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger py-2">
                                {{ session('error') }}
                            </div>
                        @endif

                        <!-- Form -->
                        <form method="POST" action="{{ route('inviteMember.send') }}">
                            @csrf

                            <!-- Name -->
                            <div class="mb-3">
                                <label class="form-label fw-medium">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter full name"
                                    required>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label fw-medium">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter email address"
                                    required>
                            </div>

                            <!-- Role -->
                            <div class="mb-4">
                                <label class="form-label fw-medium">Role</label>
                                <select name="role_id" id="roleDropdown" class="form-select" required>
                                    <option value="">-- Select Role --</option>
                                </select>
                            </div>

                            <!-- Submit -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    Send Invitation
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
                <!-- End Card -->

            </div>
        </div>
    </div>

    <!-- Fetch Roles -->
    <script>
        fetch('/roles')
            .then(res => res.json())
            .then(data => {
                const dropdown = document.getElementById('roleDropdown');
                data.forEach(role => {
                    dropdown.innerHTML += `
                    <option value="${role.id}">${role.role_name}</option>
                `;
                });
            })
            .catch(err => console.error(err));
    </script>
@endsection
