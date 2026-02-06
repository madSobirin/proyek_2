<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Account;

class ProfileController extends Controller
{

    public function halamanProfile()
    {
        $title = "Profil";
        $user = Auth::user();
        return view('pages.profile', compact('user', 'title'));
    }
    public function update(Request $request)
    {
        $user = Account::findOrFail(Auth::id());

        $request->validate([
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:accounts,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'birthdate' => 'nullable|date',
            'weight' => 'nullable|numeric',
            'height' => 'nullable|numeric',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('profile', 'public');

            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            $user->photo = $path;
        }

        $user->nama_lengkap = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->birthdate = $request->birthdate;
        $user->weight = $request->weight;
        $user->height = $request->height;
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
