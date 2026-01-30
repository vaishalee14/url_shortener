@extends('layouts.logout')
@section('title', 'Super Admin Dashboard')
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

    <div class="card shadow-sm">

        {{-- 🔹 Header with Back Button --}}
        <div class="card-header d-flex align-items-center">
            <h5 class="mb-0">All Clients</h5>

            <a href="{{ route('super_admin.dashboard') }}" class="btn btn-sm btn-outline-secondary ms-auto">
                ← Back
            </a>
        </div>

        {{-- 🔹 Top Actions --}}
        <div class="card-body">

            {{-- 🔹 Clients Table --}}
            @if ($clients->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">Client</th>
                                <th class="text-center">Users</th>
                                <th class="text-center">Total Generated URLs</th>
                                <th class="text-center">Total URL Hits</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                                <tr>
                                    <td>
                                        <div class="client-name">{{ $client->client_name }}</div>
                                        <div class="client-email">{{ $client->email }}</div>
                                    </td>

                                    <td class="text-center">
                                        {{ $client->users_count }}
                                    </td>

                                    <td class="text-center">
                                        {{ $client->short_urls_count }}
                                    </td>

                                    <td class="text-center">
                                        {{ number_format($client->short_urls_sum_total_hits ?? 0) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- ✅ Pagination --}}
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <small class="text-muted">
                        Showing {{ $clients->firstItem() }} to {{ $clients->lastItem() }}
                        of {{ $clients->total() }} results
                    </small>

                    {{ $clients->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">😕</div>
                    <p>No clients found.</p>
                </div>
            @endif


        </div>
    </div>
@endsection
