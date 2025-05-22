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
}
