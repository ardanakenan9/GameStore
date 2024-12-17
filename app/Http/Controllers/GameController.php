<?php

namespace App\Http\Controllers;

use Facade\Ignition\Support\Packagist\Package;
use Illuminate\Http\Request;
use App\Models\Game;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\PaymentMethod;
use App\Models\GamePackage;




class GameController extends Controller
{
    /**
     * Tambah game baru (Hanya untuk Admin)
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|max:255',
            'image_path' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'link' => 'nullable|url',
        ]);
        
    
        // Simpan file gambar ke storage
        $imagePath = $request->file('image_path')->store('games', 'public');

    
        // Simpan game baru
        $game = Game::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'image_path' => $imagePath,
            'link' => $request->link,
        ]);
    
        // Pastikan game tersimpan dan generate view
        $this->generateGameView($game);
    
        return redirect()->route('index')->with('success', 'Game added successfully!');
    }
    
    public function generateGameView($game)
    {
        // Nama file Blade sesuai nama game
        $fileName = "{$game->slug}.blade.php";
        $filePath = resource_path("views/games/{$fileName}");
    
        // Template HTML dengan Blade Directive
        $htmlContent = <<<HTML
    @extends('templates.game')
    
    @section('gameTitle', "{$game->title}")
    @section('gameIdLabel', "ID {$game->title}")
    HTML;
    
        // Pastikan direktori views/games ada
        if (!file_exists(resource_path('views/games'))) {
            mkdir(resource_path('views/games'), 0755, true);
        }
    
        // Simpan file Blade
        file_put_contents($filePath, $htmlContent);
    }
    
    public function show($slug)
{
    // Cari game berdasarkan slug
    $game = Game::where('slug', $slug)->firstOrFail();

    // Return view dengan data game
    return view('templates.game', compact('game'));
}

    
    

    /**
     * Hapus game (Hanya untuk Admin)
     */
    public function deletegame($id)
    {
        $game = Game::findOrFail($id);

        // Hapus file gambar jika ada
        if ($game->image_path && Storage::exists('public/' . $game->image_path)) {
            Storage::delete('public/' . $game->image_path);
        }

        // Hapus file HTML untuk game
        $fileName = "{$game->slug}.blade.php";
        $filePath = resource_path("views/games/{$fileName}");
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Hapus dari database
        $game->delete();

        return redirect()->route('index')->with('success', 'Game deleted successfully!');
    }




    //editt isi game!!!!!!!!!!!!!!!!!
    public function addGamePackage(Request $request, $game_id)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ]);

        GamePackage::create([
            'game_id' => $game_id,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return redirect()->route('game.edit', $game_id)->with('success', 'Game package added successfully.');
    }

    // Fungsi untuk menghapus game package
    public function deleteGamePackage($package_id)
    {
        $package = GamePackage::findOrFail($package_id);
        $package->delete();

        return back()->with('success', 'Game package deleted successfully.');
    }

    // Fungsi untuk menambah metode pembayaran game
    public function addPaymentMethod(Request $request, $game_id)
    {
        $request->validate([
            'name' => 'required|string',
            'account_number' => 'nullable|string',
        ]);

        PaymentMethod::create([
            'game_id' => $game_id,
            'name' => $request->name,
            'account_number' => $request->account_number,
        ]);

        return redirect()->route('game.edit', $game_id)->with('success', 'Payment method added successfully.');
    }

    // Fungsi untuk menghapus metode pembayaran game
    public function deletePaymentMethod($payment_method_id)
    {
        $paymentMethod = PaymentMethod::findOrFail($payment_method_id);
        $paymentMethod->delete();

        return back()->with('success', 'Payment method deleted successfully.');
    }

    // Halaman untuk edit game
    public function edit($game_id)
    {
        $game = Game::findOrFail($game_id);
        $gamePackages = GamePackage::where('game_id', $game_id)->get();
        $paymentMethods = PaymentMethod::where('game_id', $game_id)->get();

        return view('games.edit', compact('game', 'gamePackages', 'paymentMethods'));
    }
    
}







