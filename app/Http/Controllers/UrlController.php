<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $urls = Url::where('user_id', $user->id);
        if (request()->has('search')) {
            $urls = $urls->where('url', 'like', '%' . request()->search . '%')
                ->orWhere('code', 'like', '%' . request()->search . '%');
        }
        $urls = $urls->latest()->paginate(10);
        return view('urls.index', compact('user', 'urls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        return view('urls.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'url' => 'required|url',
        ]);
        $urls = new Url();
        $code = $urls->generateCode();
        $user = auth()->user();
        $urls->url = $request->url;
        $urls->code = $code;
        $urls->user_id = $user->id;
        $urls->save();
        return redirect()->route('urls.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $code)
    {
        $url = Url::where('code', $code)->firstOrFail();
        $url->clicks++;
        $url->save();
        return redirect($url->url);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = auth()->user();
        $urls = Url::findOrFail($id);
        return view('urls.edit', compact('user', 'urls'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'code' => 'required|unique:urls,code,' . $id . '|alpha_dash',
        ]);
        $urls = Url::findOrFail($id);
        $urls->code = $request->code;
        $this->authorize('update', $urls);
        $urls->save();
        return redirect()->route('urls.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $urls = Url::findOrFail($id);
        $this->authorize('destroy', $urls);
        $urls->delete();
        return redirect()->route('urls.index');
    }
}
