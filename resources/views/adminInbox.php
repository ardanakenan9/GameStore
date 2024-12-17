<!-- adminInbox.blade.php untuk Admin -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox - Admin</title>
    <link rel="stylesheet" href="{{ asset('css/stylesinbox.css') }}">
</head>
<body>
    <h2>Inbox Pembayaran</h2>
    <table>
        <thead>
            <tr>
                <th>Riot ID</th>
                <th>Item</th>
                <th>Metode Pembayaran</th>
                <th>Total</th>
                <th>Status</th>
                <th>Bukti Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
                <tr>
                    <td>{{ $payment->user->name }}#{{ $payment->user->id }}</td>
                    <td>{{ $payment->item }}</td>
                    <td>{{ $payment->payment_method }}</td>
                    <td>Rp {{ number_format($payment->total, 2) }}</td>
                    <td>{{ $payment->status }}</td>
                    <td><a href="{{ asset('storage/' . $payment->payment_proof) }}" target="_blank">Lihat Bukti</a></td>
                    <td>
                        @if($payment->status == 'pending')
                            <form action="{{ route('approvePayment', $payment->id) }}" method="POST">
                                @csrf
                                <button type="submit">Setujui</button>
                            </form>
                            <form action="{{ route('rejectPayment', $payment->id) }}" method="POST">
                                @csrf
                                <button type="submit">Tolak</button>
                            </form>
                        @else
                            <span>Diproses</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
