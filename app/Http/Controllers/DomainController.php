<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $domains = Domain::where(function ($query) use ($user) {
            $query->where('user_id', $user->id)
                ->orWhere('is_public', true);
        });
        if (request()->has('search')) {
            $domains = $domains->where('domain', 'like', '%' . request()->search . '%');
        }
        $domains = $domains->latest()->paginate(10);
        return view('domains.index', compact('user', 'domains'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        return view('domains.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'domain' => 'required|unique:domains,domain',
        ]);
        $domains = new Domain();
        $user = auth()->user();
        $domains->domain = $request->domain;
        $domains->user_id = $user->id;
        $domains->save();
        return redirect()->route('domains.index');
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
        $domains = Domain::findOrFail($id);
        $this->authorize('destroy', $domains);
        if ($domains->urls()->count() > 0) {
            echo "<script type='text/javascript'>
                    alert('Domain cannot be deleted because it has urls.');
                    window.location.href='/domains';
                  </script>";
        } else {
            $domains->delete();
            return redirect()->route('domains.index');
        }
    }
}
