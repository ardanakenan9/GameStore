<link rel="stylesheet" href="{{ asset('css/stylesinbox.css') }}">

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Inbox Konfirmasi Pembelian</h2>

        @if(count($payments) > 0)
            @foreach ($payments as $payment)
                <div class="inbox-item">
                    <div class="inbox-details">
                        <p><strong>Game:</strong> {{ $payment->game_title }}</p>
                        <p><strong>Riot ID:</strong> {{ $payment->rio }}</p>
                        <p><strong>Item:</strong> {{ $payment->item }}</p>
                        <p><strong>Metode Pembayaran:</strong> {{ $payment->payment_method }}</p>
                        <p><strong>No. Rekening:</strong> {{ $payment->account_number }}</p>
                        <p><strong>Total:</strong> Rp {{ number_format($payment->total, 2) }}</p>
                    </div>

            <div class="redeem-code">
                <p><strong>Kode Redeem:</strong></p>
                <span>{{ $payment->redeem_code ?? 'Belum di konfrimasi' }}</span>
            </div>
    </div>
    @endforeach
        @else
            <h3>User View - Pembayaran Saya</h3>
            @foreach($payments as $payment)
                <div class="payment-item">
                    <p><strong>Game:</strong> {{ $payment->game_title }}</p>
                    <p><strong>Item:</strong> {{ $payment->item }}</p>
                    <p><strong>Total:</strong> Rp {{ number_format($payment->total, 0, ',', '.') }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($payment->status) }}</p>
                    <p><strong>Riot ID:</strong> {{ $payment->riot_id }}</p> <!-- Ambil Riot ID -->

                    @if($payment->status == 'pending')
                        <p>Menunggu konfirmasi dari admin.</p>
                    @elseif($payment->status == 'approved')
                        <p>Pembayaran telah disetujui. Terima kasih!</p>
                    @elseif($payment->status == 'rejected')
                        <p>Pembayaran ditolak.</p>
                    @endif
                </div>
            @endforeach
        @endif
    </div>
@endsection

@foreach ($games as $game)
    <div class="card">
        <img src="{{ asset('storage/' . $game->image_path) }}" alt="{{ $game->title }}">
        <p>{{ $game->title }}</p>

        @if (auth()->check() && auth()->user()->is_admin) <!-- Memeriksa apakah user yang login adalah admin -->
            <div class="action-buttons">
                <!-- Tombol Edit -->
                <a href="{{ route('game.edit', $game->id) }}" class="btn btn-edit">Edit</a>
                <!-- Tombol Delete -->
                <form action="{{ route('games.delete', $game->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete">Delete</button>
                </form>
            </div>
        @endif
    </div>
@endforeach
