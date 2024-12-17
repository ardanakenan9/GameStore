<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Game;

class PageController extends Controller
{
    /**
     * Menampilkan halaman index dengan data games dan akses user/admin
     */
    public function index()
    {
        $games = Game::all();
    
        // Periksa apakah admin atau user
        $isAdmin = Auth::guard('admin')->check();
        $isUser = Auth::guard('web')->check();
    
        // Debugging untuk memastikan status login
        $isAdmin = Auth::guard('admin')->check(); // Periksa apakah admin login
    
        return view('index', compact('games', 'isAdmin', 'isUser'));
    }
    
    

    /**
     * Menampilkan halaman login
     */
    public function login()
    {
        return view('login');
    }

    /**
     * Menampilkan halaman pembuatan akun
     */
    public function createAccount()
    {
        return view('akun');
    }

    /**
     * Menampilkan halaman pengaturan profil
     */
    public function profileSettings()
    {
        return view('setting');
    }

    /**
     * Menampilkan halaman riwayat pemesanan
     */
    public function orderHistory()
    {
        return view('history');
    }

    /**
     * Menampilkan halaman inbox
     */
    public function inbox()
    {
        return view('inbox');
    }

    /**
     * Menampilkan halaman top-up berdasarkan game yang dipilih
     */
    public function topUp($game)
    {
        $view = match ($game) {
            'valorant' => 'valorant',
            'ml' => 'ml',
            'hok' => 'hok',
            'fc24' => 'fc24',
            default => '404',
        };

        return view($view);
    }

    /**
     * Proses registrasi akun pengguna
     */
    public function registerAccount(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users,username|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Simpan data ke database
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redirect ke halaman login
        return redirect()->route('login')->with('success', 'Account created successfully! Please login.');
    }

    /**
     * Proses login untuk user dan admin
     */
    public function loginProcess(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'user_type' => 'required|in:user,admin', // Jenis pengguna
        ]);
    
        // Logout dari semua guard sebelum login
        Auth::guard('admin')->logout();
        Auth::guard('web')->logout();
    
        // Tentukan guard berdasarkan user_type
        $guard = $request->user_type === 'admin' ? 'admin' : 'web';
    
        // Login menggunakan guard yang sesuai
        if (Auth::guard($guard)->attempt(['email' => $request->email, 'password' => $request->password])) {
            if ($guard === 'admin') {
                return redirect()->route('index')->with('success', 'Welcome Admin!');
            }
            return redirect()->route('index')->with('success', 'Welcome User!');
        }
    
        // Jika gagal login
        return back()->withErrors(['error' => 'Invalid email or password.'])->withInput();
    }
    
    
    /**
     * Menampilkan dashboard admin (tidak terpakai, opsional)
     */
    public function adminDashboard()
    {
        $games = Game::all();
        $isAdmin = Auth::guard('admin')->check();
        $isUser = Auth::guard('web')->check();

        return view('index', compact('games', 'isAdmin', 'isUser'));
    }

    /**
     * Menampilkan halaman pengaturan akun
     */
    public function accountSettings()
    {
        $user = Auth::user();
        return view('setting', compact('user'));
    }

    /**
     * Proses pembaruan pengaturan akun
     */
    public function updateAccountSettings(Request $request)
    {
        $request->validate([
            'username' => 'required|max:255|unique:users,username,' . Auth::id(),
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'current_password' => 'nullable',
            'new_password' => 'nullable|min:6|confirmed',
        ]);

        $user = Auth::user();

        $user->update([
            'username' => $request->username,
            'email' => $request->email,
        ]);

        if ($request->filled('current_password') || $request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.'])->withInput();
            }

            $user->update([
                'password' => Hash::make($request->new_password),
            ]);
        }

        return redirect()->route('accountSettings')->with('success', 'Account details updated successfully!');
    }

    /**
     * Menampilkan halaman game berdasarkan nama game
     */
    public function gamePage($game)
    {
        $validGames = [
            'valorant' => 'Valorant',
            'ml' => 'Mobile Legends',
            'hok' => 'Honor of Kings',
            'fc24' => 'FC 24',
        ];

        if (!array_key_exists($game, $validGames)) {
            abort(404, 'Game not found');
        }

        return view('games.' . $game, ['gameName' => $validGames[$game]]);
    }
}
