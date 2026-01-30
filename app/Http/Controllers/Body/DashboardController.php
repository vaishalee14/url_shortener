<?php

namespace App\Http\Controllers\Body;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Role;
use App\Models\ShortUrl;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $filter = $request->get('filter');
        $data = Client::where('created_by', $user->id)->pluck('id');


        $query = ShortUrl::with('client')
            ->where('client_id', $data);;

        match ($filter) {
            'today' => $query->whereDate('created_at', Carbon::today()),
            'last_week' => $query->whereBetween('created_at', [
                Carbon::now()->subWeek(),
                Carbon::now()
            ]),
            'last_month' => $query->whereMonth(
                'created_at',
                Carbon::now()->subMonth()->month
            ),
            'this_month' => $query->whereMonth(
                'created_at',
                Carbon::now()->month
            ),
            default => null,
        };

        $urls = $query = ShortUrl::with('client')
            ->latest()->paginate(3)->withQueryString();

        $clients = Client::where('created_by', $user->id)
            ->withCount('users') // Users count
            ->withCount('shortUrls') // Total generated URLs
            ->withSum('shortUrls', 'total_hits') // Total URL hits
            ->take(3)
            ->get();


        return view('super_admin.dashboard', compact('clients', 'urls', 'filter'));
    }
    public function superClientData(Request $request)
    {
        $user = Auth::user();
        $filter = $request->get('filter');

        $query = ShortUrl::query();

        match ($filter) {
            'today' => $query->whereDate('created_at', Carbon::today()),
            'last_week' => $query->whereBetween('created_at', [
                Carbon::now()->subWeek(),
                Carbon::now()
            ]),
            'last_month' => $query->whereMonth('created_at', Carbon::now()->subMonth()->month),
            'this_month' => $query->whereMonth('created_at', Carbon::now()->month),
            default => null,
        };

        // ✅ USE paginate()
        $clients = Client::where('created_by', $user->id)
            ->withCount('users')
            ->withCount('shortUrls')
            ->withSum('shortUrls', 'total_hits')
            ->paginate(10);

        $urls = $query->latest()->limit(10)->get();

        return view('super_admin.clientdashboard', compact('clients', 'urls'));
    }


    public function export(Request $request): StreamedResponse
    {
        $filter = $request->get('filter');

        $query = ShortUrl::query();

        // Apply the same filter logic as index method
        match ($filter) {
            'today' => $query->whereDate('created_at', Carbon::today()),
            'last_week' => $query->whereBetween('created_at', [
                Carbon::now()->subWeek(),
                Carbon::now()
            ]),
            'last_month' => $query->whereMonth(
                'created_at',
                Carbon::now()->subMonth()->month
            ),
            'this_month' => $query->whereMonth(
                'created_at',
                Carbon::now()->month
            ),
            default => null,
        };

        return response()->streamDownload(function () use ($query) {
            echo "Short URL,Long URL,Hits,Created At\n";
            $query->chunk(100, function ($urls) {
                foreach ($urls as $url) {
                    $shortUrl = url("http://127.0.0.1:8000/s/{$url->short_code}");
                    echo "{$shortUrl},{$url->long_url},{$url->hits},{$url->created_at}\n";
                }
            });
        }, 'short_urls.csv');
    }
    public function memberCsvExport(Request $request): StreamedResponse
    {
        $filter = $request->get('filter');
        $user = Auth::user();
        $query = ShortUrl::where('user_id', $user->id)
            ->orderBy('created_at', 'desc');

        // Apply the same filter logic as index method
        match ($filter) {
            'today' => $query->whereDate('created_at', Carbon::today()),
            'last_week' => $query->whereBetween('created_at', [
                Carbon::now()->subWeek(),
                Carbon::now()
            ]),
            'last_month' => $query->whereMonth(
                'created_at',
                Carbon::now()->subMonth()->month
            ),
            'this_month' => $query->whereMonth(
                'created_at',
                Carbon::now()->month
            ),
            default => null,
        };

        return response()->streamDownload(function () use ($query) {
            echo "Short URL,Long URL,Hits,Created At\n";
            $query->chunk(100, function ($urls) {
                foreach ($urls as $url) {
                    $shortUrl = url("http://127.0.0.1:8000/s/{$url->short_code}");
                    echo "{$shortUrl},{$url->long_url},{$url->hits},{$url->created_at}\n";
                }
            });
        }, 'short_urls.csv');
    }

    public function clientindex(Request $request)
    {
        $user = Auth::user();

        $data = Client::where('email', $user->email)->first();

        // 🔹 Base URL query
        $urlsQuery = ShortUrl::with('client')
            ->where('user_id', $user->id);

        // 🔹 Apply filter
        $filter = $request->get('filter');

        match ($filter) {
            'today' => $urlsQuery->whereDate('created_at', Carbon::today()),

            'last_week' => $urlsQuery->whereBetween('created_at', [
                Carbon::now()->subWeek(),
                Carbon::now()
            ]),

            'last_month' => $urlsQuery->whereMonth(
                'created_at',
                Carbon::now()->subMonth()->month
            ),

            'this_month' => $urlsQuery->whereMonth(
                'created_at',
                Carbon::now()->month
            ),

            default => null,
        };

        // 🔹 Paginate AFTER filtering
        $urls = $urlsQuery->latest()->paginate(10)->withQueryString();

        // 🔹 Clients list
        $clients = Client::with('role')
            ->withCount('shortUrls')
            ->withSum('shortUrls', 'total_hits')
            ->where('parent_id', $data->parent_id)
            ->latest()
            ->take(3)
            ->get();

        return view('client_admin.dashboard', compact('clients', 'urls', 'filter'));
    }

    public function memberindex(Request $request)
    {
        $user = Auth::user();
        $query = ShortUrl::where('user_id', $user->id)
            ->orderBy('created_at', 'desc');
        $filter = $request->get('filter');
        match ($filter) {
            'today' => $query->whereDate('created_at', Carbon::today()),
            'last_week' => $query->whereBetween('created_at', [
                Carbon::now()->subWeek(),
                Carbon::now()
            ]),
            'last_month' => $query->whereMonth(
                'created_at',
                Carbon::now()->subMonth()->month
            ),
            'this_month' => $query->whereMonth(
                'created_at',
                Carbon::now()->month
            ),
            default => null,
        };

        $urls = ShortUrl::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')->paginate(10);
        return view('member.dashboard', compact('urls', 'filter'));
    }

    public function getClient()
    {
        $user = Auth::user();
        $data = Client::where('email', $user->email)->first();
        // 🔹 Paginated full list
        $clients = Client::with('role')
            ->withCount('shortUrls')
            ->withSum('shortUrls', 'total_hits')
            ->where('parent_id', $data->parent_id)
            ->latest()
            ->paginate(10);

        return view('client_admin.datadashboard', compact('clients'));
    }
    public function urlData()
    {
        $user = Auth::user();

        $data = Client::where('email', $user->email)->first();

        // 🔹 Base URL query
        $urls = ShortUrl::with('client')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('client_admin.urlAllData', compact('urls'));
    }
    public function superUrlData()
    {
        $user = Auth::user();

        // Get client IDs created by this user
        $clientIds = Client::where('created_by', $user->id)
            ->pluck('id');
        $parent = client::whereIn('parent_id', $clientIds)->pluck('id');

        // Fetch URLs for those clients
        $urls = ShortUrl::whereIn('client_id', $parent)
            ->latest()
            ->paginate(10);

        return view('super_admin.urlDashboard', compact('urls'));
    }
}
