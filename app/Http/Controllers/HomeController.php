<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Rules\ValidUrl;
use Exception;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('welcome');
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
        $request->validate([
            'url' => ['required', new ValidUrl],
        ]);

        try {
            $url = new Url();
            $code = $url->generateCode();

            $url->url = $request->url;
            $url->code = $code;
            $url->domain_id = 1;
            $url->user_id = 1;
            $url->save();

            // Construct the shortened URL
            $shortenedUrl = url('/') . '/' . $code;

            // Flash a success message and the shortened URL to the session
            session()->flash('success', 'URL created successfully!');
            session()->flash('shortenedUrl', $shortenedUrl);

        } catch (Exception $e) {
            // Flash an error message to the session
            session()->flash('error', 'Failed to create URL: ' . $e->getMessage());
        }

        return redirect()->route('index');
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
