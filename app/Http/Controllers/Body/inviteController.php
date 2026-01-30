<?php

namespace App\Http\Controllers\Body;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\Role;
use App\Models\ShortUrl;
use App\Models\User;

class inviteController extends Controller
{
    // Show invite form
    public function index()
    {
        return view('super_admin.invite');
    }
    // Handle invite submit
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email'   => 'required|email|unique:clients,email|unique:users,email',
        ]);

        $client = Client::create([
            'client_name'     => $request->name,
            'email'           => strtolower($request->email),
            'created_by'      => Auth::id(),
            'role_id'         => 2,
            'super_admin_id'  => Auth::id(),
        ]);

        // Set parent_id as self
        $client->update([
            'parent_id' => $client->id,
        ]);

        // Create User
        User::create([
            'name'      => $request->name,
            'email'     => strtolower($request->email),
            'password'  => bcrypt('Abc@12345'), // safer
            'role_id'   => 2,
            'client_id' => $client->id,
        ]);

        return redirect()
            ->route('invite.index')
            ->with('success', 'Invite sent successfully!');
    }
    public function getMember()
    {

        return view('client_admin.invite');
    }



    public function createMember(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|unique:clients,email',
            'role_id' => 'required|exists:roles,id',
        ]);
        $data = Client::where('email', $user->email)->first();
        Client::create([
            'client_name' => $request->name,
            'email'       => strtolower($request->email),
            'role_id'    => $request->role_id,
            'created_by'  => Auth::id(),
            'super_admin_id'  => $data->super_admin_id,
            'parent_id' => $data->parent_id
        ]);

        $userdata = new User();
        $userdata->name = $request->name;
        $userdata->email = strtolower($request->email);
        $userdata->password = bcrypt('Abc@12345');
        $userdata->role_id = $request->role_id;
        $userdata->client_id = Client::where('email', strtolower($request->email))->first()->id;
        $userdata->save();

        return redirect()
            ->route('inviteMember.index')
            ->with('success', 'Invite sent successfully!');
    }

    public function roleList()
    {
        $role = Role::where('id', '!=', 1)->get();
        return response()->json($role);
    }

    public function redirect($code)
    {
        $url = ShortUrl::where('short_code', $code)->firstOrFail();

        // ✅ increment hit count
        $url->increment('total_hits');

        return redirect()->away($url->long_url);
    }
}
