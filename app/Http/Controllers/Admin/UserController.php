<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = \App\Models\UserProfile::with('backgroundCheck')->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = \App\Models\UserProfile::with('backgroundCheck')->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function destroy($id)
    {
        $user = \App\Models\UserProfile::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
    
    /**
     * Toggle user verification status
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleVerification($id)
    {
        $user = \App\Models\UserProfile::findOrFail($id);
        
        // Check if user already has a background check
        $backgroundCheck = $user->backgroundCheck;
        
        if ($backgroundCheck) {
            // Toggle status
            $backgroundCheck->verified = !$backgroundCheck->verified;
            $backgroundCheck->verification_date = $backgroundCheck->verified ? now() : null;
            $backgroundCheck->save();
            
            $status = $backgroundCheck->verified ? 'verified' : 'pending';
            $message = "User verification status changed to {$status}";
        } else {
            // Create new background check record
            \App\Models\BackgroundCheck::create([
                'user_profile_id' => $user->id,
                'verified' => true,
                'verification_date' => now(),
            ]);
            
            $message = 'User marked as verified';
        }
        
        return redirect()->route('admin.users.show', $id)->with('success', $message);
    }
}
