@extends('layouts.logout')

@section('title', 'Member Dashboard')

@section('content')
    <style>
        body {
            background: #f6f8fb;
            font-family: 'Inter', sans-serif;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .page-header h4 {
            font-weight: 600;
            margin: 0;
        }

        .btn-primary-soft {
            background: #6c63ff;
            color: #fff;
            border-radius: 8px;
            padding: 8px 16px;
            font-weight: 500;
            border: none;
        }

        .btn-export {
            background: #1e88ff;
            color: #fff;
            border-radius: 8px;
            padding: 8px 16px;
            font-weight: 500;
            border: none;
        }

        .card-box {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        }

        .filter-select {
            max-width: 150px;
            border-radius: 8px;
            font-size: 14px;
        }

        table th {
            font-size: 12px;
            letter-spacing: 0.08em;
            color: #6b7280;
            border-bottom: 2px solid #e5e7eb;
        }

        table td {
            font-size: 14px;
            padding: 14px 10px;
            border-bottom: 1px solid #eef0f4;
            vertical-align: middle;
        }

        .short-url {
            color: #4f6df5;
            font-weight: 500;
            text-decoration: none;
        }

        .destination {
            color: #64748b;
            max-width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .table-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            font-size: 14px;
            color: #6b7280;
        }

        .table-footer a {
            color: #4f6df5;
            font-weight: 500;
            text-decoration: none;
        }
    </style>

    {{-- Header --}}
    <div class="page-header">
        <h4>Generated Short URLs</h4>

        <div class="d-flex gap-2">
            <a href="{{ route('member.urlGenerator') }}" class="btn btn-primary-soft">
                Generate New URL
            </a>

            <a href="{{ route('member.export', request()->query()) }}" class="btn btn-export">
                Export CSV
            </a>
        </div>
    </div>

    {{-- Card --}}
    <div class="card-box">

        {{-- Filter --}}
        <div class="mb-3">
            <select class="form-select filter-select" onchange="filterData(this.value)">
                <option value="">All Data</option>
                <option value="today" {{ request('filter') == 'today' ? 'selected' : '' }}>Today</option>
                <option value="last_week" {{ request('filter') == 'last_week' ? 'selected' : '' }}>Last 7 Days</option>
                <option value="this_month" {{ request('filter') == 'this_month' ? 'selected' : '' }}>This Month</option>
                <option value="last_month" {{ request('filter') == 'last_month' ? 'selected' : '' }}>Last Month</option>
            </select>
        </div>

        {{-- Table --}}
        @if ($urls->count())
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>SHORT URL</th>
                            <th>DESTINATION</th>
                            <th class="text-center">HITS</th>
                            <th>CLIENT</th>
                            <th>CREATED</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($urls as $url)
                            <tr>
                                <td>
                                    <a target="_blank" href="{{ url('/s/' . $url->short_code) }}" class="short-url">
                                        {{ url('/s/' . $url->short_code) }}
                                    </a>
                                </td>

                                <td class="destination" title="{{ $url->long_url }}">
                                    {{ \Illuminate\Support\Str::limit($url->long_url, 45) }}
                                </td>

                                <td class="text-center">
                                    {{ $url->hits }}
                                </td>

                                <td>
                                    {{ $url->client->client_name ?? 'N/A' }}
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($url->created_at)->format("d M 'y") }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Footer --}}
            <div class="table-footer">
                <span>
                    Showing {{ $urls->count() }} URLs
                </span>

                <a href="#">View All Clients →</a>
            </div>
        @else
            <p class="text-center text-muted py-4">No URLs found</p>
        @endif
    </div>

    <script>
        function filterData(value) {
            const url = new URL(window.location.href);
            value ? url.searchParams.set('filter', value) :
                url.searchParams.delete('filter');
            window.location.href = url.toString();
        }
    </script>
@endsection
