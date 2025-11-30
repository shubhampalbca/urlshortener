<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Company;
use App\Models\ShortUrl;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth.login');
    }

    public function login(Request $r)
    {
        $user = User::where('email', $r->email)->first();
        if (!$user || !Hash::check($r->password, $user->password)) {
            return back()->with('error', 'Invalid credentials');
        }
        auth()->login($user);
        return redirect('/dashboard');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }

    public function dashboard()
    {
        $user = auth()->user();
        return match ($user->role) {
            'SuperAdmin' => redirect()->route('super.admin.dashboard'),
            'Admin'      => redirect()->route('admin.dashboard'),
            'Member'     => redirect()->route('member.dashboard'),
            default      => abort(403, 'No role assigned'),
        };
    }

    public function superAdminView()
    {
        $user = auth()->user();
        return view('dashboard.super_admin', [
            'companies' => Company::all(),
            'urls'      => ShortUrl::all(),
            'user'     => $user,

        ]);
    }
    public function adminView()
    {
        $user = auth()->user();
        $myUrls = ShortUrl::where('created_by', $user->id)->get();
        $otherUrls = ShortUrl::where('company_id', '!=', $user->company_id)->get();
        $members = User::where('company_id', $user->company_id)->get();

        return view('dashboard.admin', compact('myUrls', 'otherUrls', 'members', 'user'));
    }


   public function memberView()
    {
       $user = auth()->user();
        //dd($user);
        $urls = ShortUrl::where('created_by', $user->id)->get();
        return view('dashboard.member', compact('urls', 'user'));
    }

}
