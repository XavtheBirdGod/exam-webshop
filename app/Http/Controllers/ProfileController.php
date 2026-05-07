<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'shipping_address' => ['nullable', 'string'],
            'birthday' => ['nullable', 'date'],
        ]);

        $user->update($validated);

        return redirect()->route('account')->with('status', 'profile-updated');
    }
}
