<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackgroundCheckController extends Controller
{
    public function index()
    {
        return view('background-check.index');
    }
    
    public function verify(Request $request)
    {
        try {
            $userProfileId = session('user_profile_id');
            
            if (!$userProfileId) {
                return redirect()->route('zipcode.index')
                    ->with('error', 'Please start from the beginning');
            }
            
            // Create background check record
            \App\Models\BackgroundCheck::create([
                'user_profile_id' => $userProfileId,
                'verified' => true,
                'verification_date' => now(),
            ]);
            
            // Clear session data
            session()->forget(['zipcode', 'user_profile_id']);
            
            // Redirect to external site or a thank you page
            return redirect('https://www.youtube.com');
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Background check verification failed: ' . $e->getMessage());
            
            // Return back with error
            return back()->with('error', 'There was a problem with verification. Please try again.');
        }
    }
}
