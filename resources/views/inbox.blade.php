<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox - Konfirmasi Pembelian</title>
    <link rel="stylesheet" href="{{ asset('css/stylesinbox.css') }}">
</head>
<body>
    <header class="header">
        <div class="header-content">
            <a href="{{ route('index') }}" class="home-link">Home</a>
            <h1>Inbox</h1>
        </div>
    </header>

    <main class="container">
        <h2>Daftar Konfirmasi Pembelian</h2>
        <div class="inbox-list">
            @foreach ($payments as $payment)
                <div class="inbox-item">
                    <div class="inbox-details">
                        <p><strong>Riot ID:</strong> {{ $payment->riot_id }}</p>
                        <p><strong>Item:</strong> {{ $payment->item }}</p>
                        <p><strong>Metode Pembayaran:</strong> {{ $payment->payment_method }}</p>
                        <p><strong>Total:</strong> Rp {{ number_format($payment->total, 0, ',', '.') }}</p>
                    </div>

                    @if (auth()->user()->is_admin)
                        <!-- Admin: Tombol untuk setujui dan beri redeem code -->
                        <div class="admin-actions">
                            <form action="{{ route('inbox.approve', $payment->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="approve-btn">Setujui Pembayaran</button>
                            </form>

                            <form action="{{ route('inbox.redeem', $payment->id) }}" method="POST">
                                @csrf
                                <input type="text" name="redeem_code" placeholder="Masukkan Redeem Code" required>
                                <button type="submit" class="redeem-btn">Kirim Redeem Code</button>
                            </form>
                        </div>
                    @else
                        <!-- User: Menampilkan status pembayaran -->
                        <div class="user-status">
                            @if ($payment->status == 'approved')
                                <p>Status: Pembayaran Disetujui. Redeem code telah dikirim ke inbox Anda.</p>
                            @else
                                <p>Status: Menunggu Persetujuan Admin.</p>
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </main>

    <footer class="footer">
        <p>&copy; 2024 TokoGame. Semua Hak Dilindungi.</p>
    </footer>
</body>
</html>
