@extends('layouts.logout')
@section('title', 'Client Dashboard')
@section('content')

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        /* Page Header */
        .page-header {
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 0.25rem;
            letter-spacing: -0.025em;
        }

        .page-subtitle {
            font-size: 0.875rem;
            color: #718096;
            font-weight: 400;
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1.25rem;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            box-shadow: 0 2px 4px rgba(102, 126, 234, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .btn-outline-primary {
            color: #f9fafc;
            border: 1.5px solid #667eea;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }

        .btn-outline-primary:hover {
            background-color: #a2a2cc;
            color: white;
            transform: translateY(-1px);
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 12px;
            background: white;
            transition: all 0.3s ease;
        }

        .card.shadow-sm {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05), 0 1px 2px rgba(0, 0, 0, 0.1) !important;
        }

        .card:hover {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07), 0 2px 4px rgba(0, 0, 0, 0.05) !important;
        }

        .card-header {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 1.25rem 1.5rem;
            border-radius: 12px 12px 0 0 !important;
        }

        .card-header h5 {
            font-size: 1.125rem;
            font-weight: 700;
            color: #2d3748;
            margin: 0;
        }

        .card-footer {
            background: #fafbfc;
            border-top: 1px solid #e2e8f0;
            padding: 1rem 1.5rem;
            border-radius: 0 0 12px 12px !important;
        }

        /* Section Headers */
        .section-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.5rem;
        }

        .section-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #a0aec0;
            font-weight: 700;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #2d3748;
            margin: 0;
        }

        /* Tables */
        .table {
            width: 100% !important;
            margin-bottom: 0;
        }


        .table thead th {
            font-weight: 700;
            color: #4a5568;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            border-bottom: 2px solid #e2e8f0;
            padding: 1rem 1.25rem;
            background-color: #f7fafc;
        }

        .table tbody td {
            padding: 1rem 1.25rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f3f5;
            color: #2d3748;
        }

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: #f8fafc;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .client-email {
            font-size: 0.8125rem;
            color: #718096;
        }

        /* URL Display */
        .url-link {
            color: #667eea;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s ease;
            font-size: 0.875rem;
        }

        .url-link:hover {
            color: #5a67d8;
            text-decoration: underline;
        }

        .url-target {
            color: #718096;
            font-size: 0.8125rem;
        }

        /* Badges */
        .badge {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.375rem 0.75rem;
            border-radius: 6px;
            letter-spacing: 0.025em;
        }

        .badge.bg-secondary {
            background-color: #e2e8f0 !important;
            color: #4a5568 !important;
        }

        .badge.bg-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            color: white !important;
        }

        .badge.bg-success {
            background-color: #48bb78 !important;
            color: white !important;
        }

        .badge.bg-info {
            background-color: #4299e1 !important;
            color: white !important;
        }

        /* Filter Controls */
        .filter-controls {
            display: flex;
            gap: 0.75rem;
            align-items: center;
        }

        .form-select-sm {
            border-radius: 8px;
            font-size: 0.875rem;
            border: 1.5px solid #e2e8f0;
            padding: 0.5rem 2.5rem 0.5rem 0.75rem;
            font-weight: 500;
            color: #4a5568;
            transition: all 0.2s ease;
            background-color: white;
        }

        .form-select-sm:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        /* Footer Links */
        .footer-link {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.875rem;
            transition: color 0.2s ease;
        }

        .footer-link:hover {
            color: #5a67d8;
            text-decoration: underline;
        }

        .footer-info {
            color: #718096;
            font-size: 0.875rem;
        }

        /* Stats Display */
        .stat-value {
            font-size: 1.125rem;
            font-weight: 700;
            color: #2d3748;
        }

        /* Empty State */
        .empty-state {
            padding: 3rem 1.5rem;
            text-align: center;
            color: #a0aec0;
        }

        .empty-state-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 1rem;
            }

            .filter-controls {
                flex-direction: column;
                width: 100%;
            }

            .filter-controls .form-select-sm,
            .filter-controls .btn {
                width: 100%;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 1rem;
            }

            .card-footer {
                flex-direction: column;
                gap: 0.75rem;
                align-items: flex-start !important;
            }


            .table thead th,
            .table tbody td {
                padding: 0.75rem;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: fadeIn 0.4s ease-out;
        }

        /* Loading State */
        .loading-spinner {
            display: inline-block;
            width: 1rem;
            height: 1rem;
            border: 2px solid #e2e8f0;
            border-top-color: #667eea;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }

            body {
                background-color: #f8f9fa;
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            }

            /* Page Header */
            .page-header {
                margin-bottom: 2rem;
            }

            .page-title {
                font-size: 1.75rem;
                font-weight: 700;
                color: #1a202c;
                margin-bottom: 0.25rem;
                letter-spacing: -0.025em;
            }

            .page-subtitle {
                font-size: 0.875rem;
                color: #718096;
                font-weight: 400;
            }

            /* Buttons */
            .btn-primary {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                border: none;
                border-radius: 8px;
                padding: 0.5rem 1.25rem;
                font-weight: 600;
                font-size: 0.875rem;
                transition: all 0.2s ease;
                box-shadow: 0 2px 4px rgba(102, 126, 234, 0.2);
            }

            .btn-primary:hover {
                transform: translateY(-1px);
                box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
            }

            .btn-outline-primary {
                color: #f5f7fc;
                border: 1.5px solid #667eea;
                border-radius: 8px;
                padding: 0.5rem 1rem;
                font-weight: 600;
                font-size: 0.875rem;
                transition: all 0.2s ease;
            }

            .btn-outline-primary:hover {
                background-color: #7980b9;
                color: white;
                transform: translateY(-1px);
            }

            /* Cards */
            .card {
                border: none;
                border-radius: 12px;
                background: white;
                transition: all 0.3s ease;
            }

            .card.shadow-sm {
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05), 0 1px 2px rgba(0, 0, 0, 0.1) !important;
            }

            .card:hover {
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07), 0 2px 4px rgba(0, 0, 0, 0.05) !important;
            }

            .card-header {
                background: white;
                border-bottom: 1px solid #e2e8f0;
                padding: 1.25rem 1.5rem;
                border-radius: 12px 12px 0 0 !important;
            }

            .card-header h5 {
                font-size: 1.125rem;
                font-weight: 700;
                color: #2d3748;
                margin: 0;
            }

            .card-footer {
                background: #fafbfc;
                border-top: 1px solid #e2e8f0;
                padding: 1rem 1.5rem;
                border-radius: 0 0 12px 12px !important;
            }

            /* Section Headers */
            .section-header {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                margin-bottom: 0.5rem;
            }

            .section-label {
                font-size: 0.75rem;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                color: #a0aec0;
                font-weight: 700;
            }

            .section-title {
                font-size: 1.25rem;
                font-weight: 700;
                color: #2d3748;
                margin: 0;
            }



            .table thead th {
                font-weight: 700;
                color: #4a5568;
                text-transform: uppercase;
                font-size: 0.75rem;
                letter-spacing: 0.05em;
                border-bottom: 2px solid #e2e8f0;
                padding: 1rem 1.25rem;
                background-color: #f7fafc;
            }

            .table tbody td {
                padding: 1rem 1.25rem;
                vertical-align: middle;
                border-bottom: 1px solid #f1f3f5;
                color: #2d3748;
            }

            .table tbody tr {
                transition: all 0.2s ease;
            }

            .table tbody tr:hover {
                background-color: #f8fafc;
            }

            .table tbody tr:last-child td {
                border-bottom: none;
            }

            /* Client Info */
            .client-name {
                font-weight: 400;
                color: #2d3748;
                font-size: 0.6375rem;
                margin-bottom: 0.125rem;
            }

            .client-email {
                font-size: 0.8125rem;
                color: #718096;
            }

            /* URL Display */
            .url-link {
                color: #667eea;
                font-weight: 600;
                text-decoration: none;
                transition: color 0.2s ease;
                font-size: 0.875rem;
            }

            .url-link:hover {
                color: #5a67d8;
                text-decoration: underline;
            }

            .url-target {
                color: #718096;
                font-size: 0.8125rem;
            }

            /* Badges */
            .badge {
                font-size: 0.75rem;
                font-weight: 600;
                padding: 0.375rem 0.75rem;
                border-radius: 6px;
                letter-spacing: 0.025em;
            }

            .badge.bg-secondary {
                background-color: #e2e8f0 !important;
                color: #4a5568 !important;
            }

            .badge.bg-primary {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
                color: white !important;
            }

            /* .badge.bg-success {
                    background-color: #48bb78 !important;
                    color: white !important;
                } */

            /* .badge.bg-info {
                    background-color: #4299e1 !important;
                    color: white !important;
                } */

            /* Filter Controls */
            .filter-controls {
                display: flex;
                gap: 0.75rem;
                align-items: center;
            }

            .form-select-sm {
                border-radius: 8px;
                font-size: 0.875rem;
                border: 1.5px solid #e2e8f0;
                padding: 0.5rem 2.5rem 0.5rem 0.75rem;
                font-weight: 500;
                color: #4a5568;
                transition: all 0.2s ease;
                background-color: white;
            }

            .form-select-sm:focus {
                border-color: #667eea;
                box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            }

            /* Footer Links */
            .footer-link {
                color: #667eea;
                text-decoration: none;
                font-weight: 600;
                font-size: 0.875rem;
                transition: color 0.2s ease;
            }

            .footer-link:hover {
                color: #5a67d8;
                text-decoration: underline;
            }

            .footer-info {
                color: #718096;
                font-size: 0.875rem;
            }

            /* Stats Display */
            .stat-value {
                font-size: 1.125rem;
                font-weight: 700;
                color: #2d3748;
            }

            /* Empty State */
            .empty-state {
                padding: 3rem 1.5rem;
                text-align: center;
                color: #a0aec0;
            }

            .empty-state-icon {
                font-size: 3rem;
                margin-bottom: 1rem;
                opacity: 0.5;
            }

            /* Responsive */
            @media (max-width: 768px) {
                .page-header {
                    flex-direction: column;
                    align-items: flex-start !important;
                    gap: 1rem;
                }

                .filter-controls {
                    flex-direction: column;
                    width: 100%;
                }

                .filter-controls .form-select-sm,
                .filter-controls .btn {
                    width: 100%;
                }

                .card-header {
                    flex-direction: column;
                    align-items: flex-start !important;
                    gap: 1rem;
                }

                .card-footer {
                    flex-direction: column;
                    gap: 0.75rem;
                    align-items: flex-start !important;
                }


                .table thead th,
                .table tbody td {
                    padding: 0.75rem;
                }
            }

            /* Animation */
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .card {
                animation: fadeIn 0.4s ease-out;
            }

            /* Loading State */
            .loading-spinner {
                display: inline-block;
                width: 1rem;
                height: 1rem;
                border: 2px solid #e2e8f0;
                border-top-color: #667eea;
                border-radius: 50%;
                animation: spin 0.6s linear infinite;
            }

            @keyframes spin {
                to {
                    transform: rotate(360deg);
                }
            }
        }
    </style>

    <div class="container-fluid py-4 px-lg-5">

        <!-- Clients Section -->
        <div class="mb-4 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3">
                <h2 class="section-title mb-0 fw-semibold">Generated Short URLs</h2>
                <a href="{{ route('client_admin.urlGenerator') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Generate New URL
                </a>
            </div>

            {{-- <a href="{{ route('dashboard.export', ['filter' => request('filter')]) }}" --}}
            <a href="{{ route('dashboard.export') }}?filter={{ request('filter') }}" class="btn btn-outline-secondary">
                <i class="bi bi-download me-2"></i>Export CSV
            </a>

        </div>

        <div class="card shadow-sm p-0">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="filter-controls">
                    <select onchange="filterData(this.value)" class="form-select form-select-sm">
                        <option value="">All Data</option>
                        <option value="today" {{ request('filter') == 'today' ? 'selected' : '' }}>Today</option>
                        <option value="last_week" {{ request('filter') == 'last_week' ? 'selected' : '' }}>Last 7 Days
                        </option>
                        <option value="this_month" {{ request('filter') == 'this_month' ? 'selected' : '' }}>This Month
                        </option>
                        <option value="last_month" {{ request('filter') == 'last_month' ? 'selected' : '' }}>Last Month
                        </option>
                    </select>

                </div>
            </div>

            @if ($urls->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th class="text-start ps-4">
                                    <i class="bi bi-link-45deg me-2"></i>Short URL
                                </th>
                                <th class="text-start">
                                    <i class="bi bi-globe me-2"></i>Destination
                                </th>
                                <th class="text-center">
                                    <i class="bi bi-graph-up me-2"></i>Hits
                                </th>
                                <th class="text-start">
                                    <i class="bi bi-person me-2"></i>Client
                                </th>
                                <th class="text-center">
                                    <i class="bi bi-calendar3 me-2"></i>Created
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($urls as $url)
                                <tr>
                                    <td class="ps-4">
                                        <a href="{{ url('/s/' . $url->short_code) }}" target="_blank"
                                            rel="noopener noreferrer" class="url-link">
                                            {{ url('/s/' . $url->short_code) }}
                                        </a>
                                    </td>

                                    <td>
                                        <span class="url-target" title="{{ $url->long_url }}">
                                            {{ Str::limit($url->long_url, 50) }}
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        {{ number_format($url->hits) }}
                                    </td>

                                    <td>
                                        <span class="client-name" style="font-size: 0.875rem;">
                                            {{ $url->client->client_name ?? 'N/A' }}
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($url->created_at)->format("d M 'y") }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer d-flex justify-content-between align-items-center">
                    <span class="footer-info">
                        Showing {{ $urls->count() }} {{ Str::plural('URL', $urls->count()) }}
                    </span>

                    {{-- 🔹 Redirect to full list page --}}
                    <a href="{{ route('client_admin.urlAllData') }}" class="footer-link">
                        View All Clients →
                    </a>
                </div>
            @else
                <div class="empty-state text-center py-5">
                    <div class="empty-state-icon fs-1">🔗</div>
                    <h5>No URLs Generated</h5>
                    <p class="text-muted">Short URLs will appear here once created</p>
                </div>
            @endif


            <style>
                .copy-btn {
                    opacity: 0;
                    transition: opacity 0.2s;
                }

                tr:hover .copy-btn {
                    opacity: 1;
                }

                .url-link:hover {
                    text-decoration: underline !important;
                }

                .table-hover tbody tr:hover {
                    background-color: rgba(0, 0, 0, 0.02);
                }

                .client-avatar {
                    flex-shrink: 0;
                }
            </style>

            <script>
                // Copy to clipboard functionality
                document.querySelectorAll('.copy-btn').forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        const url = this.getAttribute('data-url');
                        navigator.clipboard.writeText(url).then(() => {
                            const icon = this.querySelector('i');
                            icon.classList.remove('bi-clipboard');
                            icon.classList.add('bi-check2');
                            setTimeout(() => {
                                icon.classList.remove('bi-check2');
                                icon.classList.add('bi-clipboard');
                            }, 2000);
                        });
                    });
                });
            </script>
        </div>


        <br>
        <br>

        <!-- Short URLs Section -->
        <div class="mb-4 d-flex align-items-center">
            <h2 class="section-title mb-0">Clients</h2>

            <div class="ms-auto">
                <a href="{{ route('inviteMember.index') }}" class="btn btn-primary">
                    <i class="bi bi-person-plus-fill me-2"></i> Invite Client
                </a>
            </div>
        </div>

        <div class="card shadow-sm p-0">

            @if ($clients->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">Client</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Total Generated URLs</th>
                                <th class="text-center">Total URLs Hits</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                                <tr>
                                    <td class="client-name">
                                        {{-- <div class="client-name">{{ $client->client_name }}</div> --}}
                                        {{ $client->client_name }}
                                    </td>
                                    <td class="client-email">
                                        {{-- <div class="client-email">{{ $client->email }}</div> --}}
                                        {{ $client->email }}
                                    </td>
                                    <td class="text-center">
                                        {{ $client->role->role_name ?? '—' }}
                                    </td>

                                    <td class="text-center">
                                        {{-- <span class="badge bg-primary"> --}}
                                        {{ $client->shortUrls()->count() }}
                                        {{-- </span> --}}
                                    </td>
                                    <td class="text-center">
                                        {{-- <span class="badge bg-success"> --}}
                                        {{ $client->short_urls_sum_total_hits }}
                                        {{-- </span> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <span class="footer-info">
                        Showing {{ $clients->count() }} {{ Str::plural('client', $clients->count()) }}
                    </span>

                    {{-- 🔹 Redirect to full list page --}}
                    <a href="{{ route('client_admin.datadashboard') }}" class="footer-link">
                        View All Clients →
                    </a>
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">📊</div>
                    <h5>No Clients Yet</h5>
                    <p class="text-muted">Get started by inviting your first client</p>
                </div>
            @endif
        </div>

    </div>

    <script>
        function filterData(value) {
            const url = new URL(window.location.href);
            if (value) {
                url.searchParams.set('filter', value);
            } else {
                url.searchParams.delete('filter');
            }
            window.location.href = url.toString();
        }
    </script>

@endsection
