<?php

namespace App\Http\Controllers;

// PERUBAHAN 1: Gunakan Model User (bukan Account)
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AuthCustomController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    // 🔥 tambah ini
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'user',
        ]);

        return to_route('auth.login')
            ->with('success', 'Akun berhasil dibuat, silakan login.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // dd(Auth::attempt($request->only('email', 'password')));


        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->with('error', 'Email atau password salah');
        }

        $request->session()->regenerate();

        return redirect()->route('home');
    }


    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            // PERUBAHAN 6: Update status di tabel users
            // Karena Auth::user() sudah mengembalikan object User, kita bisa langsung pakai
            // Tapi kalau mau find ulang:
            $dbUser = User::find($user->id);

            if ($dbUser) {
                if (Schema::hasColumn('users', 'is_active')) {
                    $dbUser->is_active = false;
                }
                $dbUser->save();
            }
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login')->with('success', 'Anda telah berhasil logout.');
    }
}
