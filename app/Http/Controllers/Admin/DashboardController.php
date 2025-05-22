<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $totalUsers = \App\Models\UserProfile::count();
        $totalVerified = \App\Models\BackgroundCheck::where('verified', true)->count();
        $recentUsers = \App\Models\UserProfile::latest()->take(5)->get();
        
        return view('admin.dashboard', compact('totalUsers', 'totalVerified', 'recentUsers'));
    }
}
