<?php

namespace App\Http\Controllers\Body;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UrlGeneratorController extends Controller
{
    public function generate()
    {
        return view('member.urlGenerator');
    }
    public function urlGenerate()
    {
        return view('client_admin.urlGenerator');
    }

    public function urlStore(Request $request)
    {
        $request->validate([
            'long_url' => 'required|url'
        ]);

        $user = Auth::user();

        $shortCode = Str::random(6);
        $client = Client::where('email', $user->email)->pluck('id')->first();

        $generate = new ShortUrl();
        $generate->long_url = $request->long_url;
        $generate->short_code = $shortCode;
        $generate->user_id = $user->id;
        $generate->client_id = $client;
        $generate->save();

        $shortUrl = url('/s/' . $shortCode);

        return back()->with('short_url');
    }

    public function index()
    {
        $user = Auth::user();
        $urls = ShortUrl::with('client')->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('member.dashboard', compact('urls'));
    }
}
