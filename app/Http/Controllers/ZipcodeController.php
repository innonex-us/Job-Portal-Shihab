<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZipcodeController extends Controller
{
    public function index()
    {
        return view('zipcode.index');
    }
    
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'zipcode' => [
                    'required',
                    'string',
                    'max:10',
                    'regex:/^\d{5}(-\d{4})?$/' // Format: 12345 or 12345-6789
                ],
            ]);
            
            // Store in session for later use
            session(['zipcode' => $validated['zipcode']]);
            
            // Store in database
            \App\Models\Zipcode::create([
                'zipcode' => $validated['zipcode'],
                'ip_address' => $request->ip(),
            ]);
            
            return redirect()->route('user-info.index');
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Zipcode storage failed: ' . $e->getMessage());
            
            // Return back with error
            return back()->withInput()->with('error', 'There was a problem saving your zipcode. Please try again.');
        }
    }
}
