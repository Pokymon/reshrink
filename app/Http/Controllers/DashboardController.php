<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
  public function index()
  {
    $links = Auth::user()->links()->withCount('clicks')->latest()->get();

    return Inertia::render('dashboard', [
      'links' => $links,
    ]);
  }
}
