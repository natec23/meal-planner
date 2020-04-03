<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile');
    }

    public function changePassword(Request $request)
    {
        $data = $request->validate([
            'password' => 'required|min:8',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($data['password']);
        $user->save();

        return redirect('profile')->with('change_password', 'Successfully changed password');
    }
}
