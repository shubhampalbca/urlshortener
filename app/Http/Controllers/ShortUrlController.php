<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShortUrlController extends Controller
{
    public function create(Request $r)
    {
        $code = Str::random(6);

        ShortUrl::create([
            'code'        => $code,
            'original_url' => $r->url,
            'created_by'  => $r->user_id,       // user id from form
            'company_id'  => $r->company_id,    // company id from form
        ]);

        return back()->with('success', "Short URL Created: $code");
    }


    public function list()
    {
        $user = auth()->user();

        $urls = match ($user->role) {
            'SuperAdmin' => ShortUrl::where('created_by', $user->id)->get(),
            'Admin'      => ShortUrl::where('company_id', '!=', $user->company_id)->get(),
            'Member'     => ShortUrl::where('created_by', '!=', $user->id)->get(),
        };

        return view('short.list', compact('urls'));
    }

    public function resolve($code)
    {
        $url = ShortUrl::where('code', $code)->first();
        if (!$url) return abort(404, 'Invalid URL');

        if (!auth()->check()) return abort(403, 'Unauthorized'); // Not publicly resolvable

        return redirect($url->original_url);
    }
}
