<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DebugController extends Controller
{
    public function index()
    {
        $dbConnection = true;
        $dbError = '';
        
        try {
            // Test database connection
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            $dbConnection = false;
            $dbError = $e->getMessage();
        }
        
        return view('debug.index', compact('dbConnection', 'dbError'));
    }
    
    public function testSession(Request $request)
    {
        // Set a test value in session
        session(['test_key' => 'Session is working at ' . now()]);
        
        return back()->with('success', 'Session test completed');
    }
}
