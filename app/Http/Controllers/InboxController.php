<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Inbox;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    public function index()
    {
        $user = auth()->user();// Get the currently authenticated user
    
        // If the user is an admin, show all payments; if not, show only their payments
        if ($user->is_admin) {
            $payments = Payment::all(); 
            $username = optional(auth()->user())->username;

        } else {
            $payments = Inbox::where('user_id', $user->id)->get(); // Regular user sees their own payments
        }
    
        return view('inbox.index', compact('payments'));
    }
    

    

 public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'game_title' => 'required|string',
        'riot_id' => 'required|string', // Riot ID sesuai nama game
        'item' => 'required|string',
        'payment_method' => 'required|string',
        'account_number' => 'required|string',
        'total' => 'required|integer',
        'payment_proof' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Upload file bukti pembayaran
    $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');

    // Simpan data ke tabel Inbox
    Inbox::create([
        'user_id' => auth()->id(), // User yang login
        'game_title' => $request->game_title, // Nama game
        'riot_id' => $request->riot_id, // Riot ID (diambil dari nama game)
        'item' => $request->item, // Item yang dipilih
        'payment_method' => $request->payment_method, // Metode pembayaran
        'account_number' => $request->account_number, // Nomor rekening
        'total' => $request->total, // Total pembayaran
        'payment_proof' => $paymentProofPath, // Lokasi bukti pembayaran
        'status' => 'pending', // Status pembayaran awalnya pending
    ]);

    return redirect()->route('inbox.index')->with('success', 'Pembayaran berhasil dikirim. Menunggu konfirmasi admin.');
}

    
    

    // Admin menyetujui pembayaran
    public function approve(Payment $payment)
    {
        // Setujui pembayaran
        $payment->status = 'approved';
        $payment->save();

        // Kirimkan redeem code ke inbox user (misalnya dengan email atau sistem internal)
        // Anda bisa menambahkan logika untuk mengirimkan redeem code ke user

        return redirect()->route('inbox.index')->with('success', 'Pembayaran disetujui!');
    }

    // Admin memberikan redeem code
    public function redeem(Request $request, payment $payment)
    {
        // Simpan redeem code yang diberikan admin
        $payment->redeem_code = $request->redeem_code;
        $payment->save();

        // Kirim redeem code ke inbox user (misalnya dengan email atau sistem internal)
        return redirect()->route('inbox.index')->with('success', 'Redeem code telah dikirim!');
    }

    // Admin menolak pembayaran
    public function rejectPayment($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->status = 'rejected';
        $payment->save();

        return redirect()->route('inbox.index')->with('error', 'Pembayaran ditolak!');
    }
}
