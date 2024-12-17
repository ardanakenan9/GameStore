<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Game Store</title>
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

</head>
<body>
    <header>
        <div class="header-content">
          <!-- Search Bar -->
          <div class="search-bar">
            <input type="text" placeholder="Search...">
          </div>
<!-- Navbar dengan Dropdown Menu -->
<div class="navbar">
  <!-- Hamburger Menu -->
  <div class="hamburger" onclick="toggleMenu()">
    <div></div>
    <div></div>
    <div></div>
  </div>
  
  <!-- Navbar Links -->
  <ul class="navbar-links">
    <li class="dropdown">
      <a href="javascript:void(0)">
        <svg width="32" height="41" viewBox="0 0 32 41" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M28 17.0833H4M28 10.25H4M28 23.9167H4M28 30.75H4" stroke="#1E1E1E" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </a>
      <ul class="dropdown-content">
        <li> <a href="{{ route('accountSettings') }}">Account Settings</a></li>
        <li><a href="history.html">History Order</a></li>
      </ul>
    </li>
  </ul>
</div>

<div class="inbox-icon">
    <a href="{{ route('inbox.index') }}">
        <img src="{{ asset('assets/inbox.png') }}" alt="Inbox" title="Inbox">
    </a>
</div>

      </header>
  

<!-- Header dengan berita game -->
<header class="news-header">
    <h2>Berita Game Terkini</h2>
    <div class="news-carousel">
      <!-- Slider -->
      <div class="carousel">
        <div class="carousel-item">
          <img src="assets/14793336.jpg" alt="Game News 1">
          <div class="carousel-caption">Game X Update Baru</div>
        </div>
        <div class="carousel-item">
          <img src="https://static-src.vocagame.com/gopay/GG-MLBB%20FREE%20DM%2059%20DEC%20WEB%20BANNER-562a-original.webp" alt="Game News 2">
          <div class="carousel-caption">Game Y Dapatkan Fitur Baru!</div>
        </div>
        <div class="carousel-item">
          <img src="assets/one-piece-character-5120x2880-15328.jpeg" alt="Game News 3">
          <div class="carousel-caption">Game Z Menjadi Game Terpopuler!</div>
        </div>
      </div>
    </div>
  </header>

  <script>
    let currentIndex = 0;
    const items = document.querySelectorAll('.carousel-item');
    const totalItems = items.length;
  
    function nextSlide() {
      // Menyembunyikan gambar yang sedang ditampilkan
      items[currentIndex].style.opacity = '0';
      
      // Menghitung slide berikutnya
      currentIndex = (currentIndex + 1) % totalItems;
      
      // Menampilkan gambar berikutnya
      items[currentIndex].style.opacity = '1';
      
      // Menambahkan transisi geser
      document.querySelector('.carousel').style.transform = `translateX(-${currentIndex * 100}%)`;
    }
  
    // Menjalankan slide otomatis setiap 4 detik
    setInterval(nextSlide, 4000);
  
    // Menampilkan gambar pertama
    items[currentIndex].style.opacity = '1';
  </script>
  
  <section class="popular-section">
    <h2>Popular Items</h2>
    <div class="popular-grid">
        <div class="popular-item">
        <a href="{{ route('gamePage', 'valorant') }}">
                <img src="assets/valorant.png" alt="Popular Item 1">
            </a>
        </div>
        <div class="popular-item">
        <a href="{{ route('gamePage', 'ml') }}">
                <img src="assets/ml.png" alt="Popular Item 2">
            </a>
        </div>
        <div class="popular-item">
        <a href="{{ route('gamePage', 'hok') }}">
                <img src="assets/hok.png" alt="Popular Item 3">
            </a>
        </div>
        <div class="popular-item">
        <a href="{{ route('gamePage', 'fc24') }}">
                <img src="assets/fc.png" alt="Popular Item 4">
            </a>
        </div>
    </div>
</section>

<div class="section new">

        <h2>GAME</h2>   
    
<div class="card-container">
@foreach ($games as $game)
            <div class="card">
                <img src="{{ asset('storage/' . $game->image_path) }}" alt="{{ $game->title }}">
                <p>{{ $game->title }}</p>

                @if ($isAdmin ?? false) <!-- Cek apakah user adalah admin -->
                    <div class="action-buttons">
                        <!-- Tombol Edit -->
                        <a href="{{ route('game.edit', $game->id) }}" class="btn btn-edit">Edit</a>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('games.delete', $game->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete">Delete</button>
                        </form>
                    </div>
                @endif
            </div>
          
            @endforeach
</div>
</div>

@if ($isAdmin)
<form action="{{ route('games.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="title">Game Title:</label>
    <input type="text" id="title" name="title" required>

    <label for="image_path">Game Image:</label>
    <input type="file" id="image_path" name="image_path" required>


    <button type="submit">Add Game</button>
</form>

@endif



  <div class="footer-container">
    <div class="footer-section">
        <h4>About Us</h4>
        <p>asu</p>
    </div>
    <div class="footer-section">
        <h4>Contact</h4>
        <p>08</p>
    </div>
    <div class="footer-section">
        <h4>Follow Us</h4>
        <div class="social-icons">
            <a href="#" class="social-icon"><img src="facebook-icon.png" alt="Facebook"></a>
            <a href="#" class="social-icon"><img src="twitter-icon.png" alt="Twitter"></a>
            <a href="#" class="social-icon"><img src="instagram-icon.png" alt="Instagram"></a>
        </div>
    </div>
</div>



  



</body>
</html>
