<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LinkController extends Controller
{
  use AuthorizesRequests;

  private function generateRandomString($length = 3)
  {
    $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
    return substr(str_shuffle(str_repeat($characters, $length)), 0, $length);
  }

  public function index()
  {
    $links = Auth::user()->links()->withCount('clicks')->latest()->get();

    return Inertia::render('links', [
      'links' => $links,
    ]);
  }

  public function store(Request $request)
  {
    $request->validate([
      'url' => ['required', 'url', 'max:255'],
      'short_url' => [
        'nullable',
        'string',
        'lowercase',
        'max:255',
        'regex:/^[a-z0-9_-]+$/',
        'unique:links,short_url,NULL,id,user_id,' . Auth::id() . ',deleted_at,NULL',
      ],
    ]);

    if ($request->get('short_url')) {
      $shortUrl = $request->get('short_url');
    } else {
      do {
        $shortUrl = $this->generateRandomString(3);
      } while (Link::where('user_id', Auth::id())
        ->where('short_url', $shortUrl)
        ->exists()
      );
    }

    $link = new Link();
    $link->url = $request->get('url');
    $link->short_url = $shortUrl;
    $link->user_id = Auth::id();
    $link->save();

    return back()->with([
      'flash' => ['success' => 'Link telah ditambahkan ke daftar link.'],
    ]);
  }

  public function show(Link $link)
  {
    $link->clicks()->create([
      'ip_address' => request()->getClientIp(),
      'user_agent' => request()->userAgent(),
    ]);

    return redirect($link->url);
  }

  public function update(Request $request, Link $link)
  {
    $this->authorize('update', $link);

    $request->validate([
      'url' => ['required', 'url', 'max:255'],
      'short_url' => [
        'required',
        'string',
        'lowercase',
        'max:255',
        'regex:/^[a-z0-9_-]+$/',
        'unique:links,short_url,' . $link->id . ',id,user_id,' . Auth::id() . ',deleted_at,NULL',
      ],
    ]);

    $link->url = $request->get('url');
    $link->short_url = $request->get('short_url');
    $link->save();

    return back()->with([
      'flash' => ['success' => 'Link telah diperbarui.'],
    ]);
  }

  public function destroy(Link $link)
  {
    $this->authorize('destroy', $link);

    $link->delete();

    return back()->with([
      'flash' => ['success' => 'Link telah dihapus dari daftar link.'],
    ]);
  }
}
