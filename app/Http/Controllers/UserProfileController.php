<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index()
    {
        return view('user-info.index');
    }
    
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'firstName' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20|regex:/^[0-9]{3}[- ]?[0-9]{3}[- ]?[0-9]{4}$/',
                'age' => 'required|integer|min:18|max:100',
                'gender' => 'required|string|in:Male,Female,Other,Prefer not to say',
            ]);
            
            // Create user profile
            $userProfile = \App\Models\UserProfile::create([
                'first_name' => $validated['firstName'],
                'last_name' => $validated['lastName'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'age' => $validated['age'],
                'gender' => $validated['gender'],
                'zipcode' => session('zipcode'),
                'ip_address' => $request->ip(),
            ]);
            
            // Store user profile ID in session for background check
            session(['user_profile_id' => $userProfile->id]);
            
            return redirect()->route('background-check.index');
        } catch (\Exception $e) {
            // Log the error
            \Log::error('User profile creation failed: ' . $e->getMessage());
            
            // Return back with error
            return back()->withInput()->with('error', 'There was a problem saving your information. Please try again.');
        }
    }
}
