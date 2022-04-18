<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    public function updateProfile(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'password' => 'min:8|same:confirm_password',
        ]);
        if ($request->profile) {
            $file = $request->profile;
            $image_name = time() . '.' . $file->getClientOriginalExtension();
            $file->move('profiles', $image_name);
        };
        $user = User::find(auth()->user()->id);
        $user->update([
            'name' => $request->first_name.' '.$request->last_name,
            'password' => \Hash::make($request->password)
        ]);
        if($request->profile){
            $user->update('image',$image_name);
        }
        return redirect()->back();
    }
}
