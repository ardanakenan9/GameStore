<link rel="stylesheet" href="{{ asset('css/stylesinbox.css') }}">

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Inbox Konfirmasi Pembelian</h2>

        @if(auth()->user()->is_admin)
            <h3>Admin View - Semua Pembayaran</h3>
            @foreach($payments as $payment)
                <div class="payment-item">
                    <p><strong>Game:</strong> {{ $payment->game_title }}</p>
                    <p><strong>Item:</strong> {{ $payment->item }}</p>
                    <p><strong>Total:</strong> Rp {{ number_format($payment->total, 0, ',', '.') }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($payment->status) }}</p>

                    @if($payment->status == 'pending')
                        <form action="{{ route('inbox.approve', $payment->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit">Setujui Pembayaran</button>
                        </form>

                        <form action="{{ route('inbox.reject', $payment->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit">Tolak Pembayaran</button>
                        </form>
                    @endif
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
