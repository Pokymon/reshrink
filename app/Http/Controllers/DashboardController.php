<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\Url;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $urls = Url::where('user_id', $user->id);
        $domains = Domain::where(function ($query) use ($user) {
            $query->where('user_id', $user->id)
                ->orWhere('is_public', true);
        });
        if (request()->has('search')) {
            $urls = $urls->where('url', 'like', '%' . request()->search . '%')
                ->orWhere('code', 'like', '%' . request()->search . '%');
            $domains = $domains->where('domain', 'like', '%' . request()->search . '%');
        }
        $urls = $urls->latest()->paginate(5);
        $domains = $domains->latest()->paginate(5);
        return view('dashboard', compact('user', 'urls', 'domains'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
