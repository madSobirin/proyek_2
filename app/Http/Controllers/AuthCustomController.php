<?php

namespace App\Http\Controllers;

// PERUBAHAN 1: Gunakan Model User (bukan Account)
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AuthCustomController extends Controller
{
    public function index()
    {
        return view('auth.index');
    }

    public function register(Request $request)
    {
        // PERUBAHAN 2: Validasi unique ke tabel 'users', bukan 'accounts'
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'required|string|min:4',
        ]);

        // generate username
        $username = strtolower(str_replace(' ', '', $request->nama_lengkap));
        $baseUsername = $username;
        $counter = 1;

        // PERUBAHAN 3: Cek duplikat username di tabel users
        while (User::where('username', $username)->exists()) {
            $username = $baseUsername . $counter;
            $counter++;
        }

        $role = ($baseUsername === 'admin') ? 'admin' : 'user';

        // Pastikan kolom-kolom ini ada di tabel 'users' kamu
        $payload = [
            'nama_lengkap' => $request->nama_lengkap, // Sesuaikan jika di User pakainya 'name'
            'username'     => $username,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'role'         => $role,
        ];

        // Cek kolom tambahan di tabel users
        if (Schema::hasColumn('users', 'is_active')) {
            $payload['is_active'] = false; // Atau true tergantung logic kamu
        }
        if (Schema::hasColumn('users', 'last_login_at')) {
            $payload['last_login_at'] = null;
        }

        // PERUBAHAN 4: Simpan ke User
        User::create($payload);

        return back()->with('success', "Pendaftaran berhasil! Username Anda: $username.");
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // PERUBAHAN 5: Cari data di tabel User (users)
        $user = User::where('username', $request->username)->first();

        // --- Hapus dd() lama jika sudah yakin, atau update dd untuk User ---
        /*
        dd([
            'Cek Tabel' => 'users',
            'Input Username' => $request->username,
            'User Ditemukan?' => $user ? 'YA' : 'TIDAK',
        ]); 
        */

        if (! $user) {
            return back()->with('error', 'Nama atau password salah.');
        }

        if (! Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Nama atau password salah.');
        }

        Auth::login($user);
        $request->session()->regenerate();

        // update status login di tabel users
        if (Schema::hasColumn('users', 'is_active')) {
            $user->is_active = true;
        }
        if (Schema::hasColumn('users', 'last_login_at')) {
            $user->last_login_at = now();
        }
        $user->save();

        $isAdmin = strcasecmp($user->role ?? '', 'admin') === 0
            || str_starts_with(strtolower($user->username), 'admin');

        return redirect()->intended(
            $isAdmin ? route('admin.dashboard') : route('home')
        );
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

        return redirect()->route('auth.index')->with('success', 'Anda telah berhasil logout.');
    }
}
