<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display the settings page
     */
    public function index()
    {
        $settings = Setting::all();
        return view('admin.settings.index', compact('settings'));
    }
    
    /**
     * Update settings
     */
    public function update(Request $request)
    {
        try {
            $validated = $request->validate([
                'verification_url' => 'required|url|max:255',
                'service_name' => 'required|string|max:100',
            ]);
            
            // Update settings
            Setting::setValue('verification_url', $validated['verification_url']);
            Setting::setValue('service_name', $validated['service_name']);
            
            return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully');
        } catch (\Exception $e) {
            \Log::error('Settings update failed: ' . $e->getMessage());
            return back()->withInput()->with('error', 'There was a problem updating settings. Please try again.');
        }
    }
}
