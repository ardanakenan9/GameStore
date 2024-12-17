@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Game: {{ $game->title }}</h2>

        <form action="{{ route('game.update', $game->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="form-group">
                <label for="title">Game Title</label>
                <input type="text" class="form-control" name="title" value="{{ old('title', $game->title) }}" required>
            </div>

            <div class="form-group">
                <label for="image_path">Game Image</label>
                <input type="file" class="form-control" name="image_path">
                @if($game->image_path)
                    <img src="{{ asset('storage/' . $game->image_path) }}" alt="Game Image" width="100">
                @endif
            </div>

            <div class="form-group">
                <label for="link">Game Link</label>
                <input type="text" class="form-control" name="link" value="{{ old('link', $game->link) }}">
            </div>

            <button type="submit" class="btn btn-primary">Update Game</button>
        </form>

        <h3>Packages</h3>
        <ul>
        @foreach ($gamePackages as $package)
    <div class="package-item">
        <p><strong>Package Name:</strong> {{ $package->name }}</p>
        <p><strong>Price:</strong> Rp {{ number_format($package->price, 2) }}</p>
        <p><strong>Description:</strong> {{ $package->description }}</p>
        <form action="{{ route('game.deletePackage', $package->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete">Delete Package</button>
        </form>
    </div>
@endforeach
        </ul>

        <h3>Add New Package</h3>
        <form action="{{ route('game.addPackage', $game->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Package Name</label>
                <input type="text" class="form-control" name="name" required>
            </div>

            <div class="form-group">
                <label for="price">Package Price</label>
                <input type="number" class="form-control" name="price" required>
            </div>

            <div class="form-group">
                <label for="description">Package Description</label>
                <input type="text" class="form-control" name="description" required>
            </div>

            <button type="submit" class="btn btn-success">Add Package</button>
        </form>

        <h3>Payment Methods</h3>
        <ul>
            @foreach($paymentMethods as $paymentMethod)
                <li>{{ $paymentMethod->name }} 
                    <form action="{{ route('game.deletePaymentMethod', [$game->id, $paymentMethod->id]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>

        <h3>Add New Payment Method</h3>
        <form action="{{ route('game.addPaymentMethod', $game->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Payment Method Name</label>
                <input type="text" class="form-control" name="name" required>
            </div>

            <div class="form-group">
                <label for="account_number">Account Number (Optional)</label>
                <input type="text" class="form-control" name="account_number">
            </div>

            <button type="submit" class="btn btn-success">Add Payment Method</button>
        </form>
    </div>
@endsection
