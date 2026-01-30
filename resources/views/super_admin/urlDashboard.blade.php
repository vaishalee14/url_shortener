@extends('layouts.logout')
@section('title', 'Super Admin Dashboard')
@section('content')
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 12px;
            background: white;
            animation: fadeIn 0.4s ease-out;
        }

        .card.shadow-sm {
            box-shadow: 0 1px 3px rgba(0, 0, 0, .05), 0 1px 2px rgba(0, 0, 0, .1);
        }

        .card-header {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 1.25rem 1.5rem;
            border-radius: 12px 12px 0 0;
        }

        .card-header h5 {
            font-weight: 700;
            margin: 0;
            color: #2d3748;
        }

        /* Table */
        .table thead th {
            font-size: .75rem;
            text-transform: uppercase;
            letter-spacing: .05em;
            color: #4a5568;
            background: #f7fafc;
            border-bottom: 2px solid #e2e8f0;
            padding: 1rem;
        }

        .table tbody td {
            padding: 1rem;
            border-bottom: 1px solid #edf2f7;
            color: #2d3748;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background: #f8fafc;
        }

        .url-link {
            color: #667eea;
            font-weight: 600;
            text-decoration: none;
        }

        .url-link:hover {
            text-decoration: underline;
        }

        .url-target {
            font-size: .8125rem;
            color: #718096;
        }

        /* Empty state */
        .empty-state {
            padding: 3rem;
            text-align: center;
            color: #a0aec0;
        }

        .empty-state-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: .6;
        }

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
    </style>

    <div class="card shadow-sm">

        {{-- Header --}}
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>All Clients</h5>

            <a href="{{ route('super_admin.dashboard') }}" class="btn btn-sm btn-outline-secondary">
                ← Back
            </a>
        </div>

        <div class="card-body">

            {{-- Table --}}
            @if ($urls->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Short URL</th>
                                <th>Destination</th>
                                <th class="text-center">Hits</th>
                                <th>Client</th>
                                <th class="text-center">Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($urls as $url)
                                <tr>
                                    <td>
                                        <a href="{{ url('/s/' . $url->short_code) }}" target="_blank" class="url-link">
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
                                        {{ $url->client->client_name ?? 'N/A' }}
                                    </td>

                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($url->created_at)->format("d M 'y") }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if ($urls->hasPages())
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            Showing
                            {{ $urls->firstItem() ?? 0 }}
                            to
                            {{ $urls->lastItem() ?? 0 }}
                            of
                            {{ $urls->total() }}
                            results
                        </small>

                        {{ $urls->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            @endauth
    </div>
</div>
@endsection
