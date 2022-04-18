<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('profile.index', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'company_name' => 'required',
            'address' => ['string', 'required'],
            'phone' => 'required|numeric',
        ]);
        auth()->user()->update($request->all());
        return back()->with(['success' => 'Profile has been updated successfully']);
    }
}
