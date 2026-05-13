<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoDonate - Rating</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/ecodonate-rating.css') }}">
</head>
<body>

<!-- NAVBAR -->
<nav>
    <div class="logo">Eco<span>Donate</span></div>

    <ul class="nav-links">
        <li><a href="#">Beranda</a></li>
        <li><a href="#">Organisasi</a></li>
        <li><a href="#">Donasi</a></li>
        <li><a href="#" style="color:var(--dark)">Ulasan</a></li>
    </ul>

    <button class="nav-btn">Donasi Sekarang</button>
</nav>

<!-- HERO -->
<div class="hero-strip">
    <h1>Rating & Ulasan Volunteer</h1>
    <p>Bagikan pengalaman Anda dan bantu pendonasi lain menemukan organisasi terbaik</p>
</div>

<!-- MAIN -->
<div class="container">

    <div class="grid">

        <!-- LEFT -->
        <div>

            <!-- ORGANISASI -->
            <div class="org-card">
                <div class="org-logo">🌿</div>

                <div class="org-info">
                    <h2>Yayasan Hijau Nusantara</h2>

                    <p>
                        Berfokus pada pelestarian lingkungan,
                        penghijauan kota, dan edukasi alam bebas.
                    </p>

                    <div class="org-tags">
                        <span class="tag">Lingkungan</span>
                        <span class="tag">Volunteer</span>
                        <span class="tag">Penghijauan</span>
                    </div>
                </div>
            </div>

            <!-- SUMMARY -->
            <div class="rating-summary">

                <h3>Ringkasan Penilaian</h3>

                <div class="rating-big">

                    <div class="big-score">4.7</div>

                    <div>
                        <div class="stars">
                            ★★★★★
                        </div>

                        <div class="total-reviews">
                            dari 124 ulasan
                        </div>
                    </div>
                </div>
            </div>

            <!-- FORM -->
            <div class="review-form">

                <h3>Tulis Ulasan</h3>

                <label>Nama</label>
                <input type="text" id="nameInput">

                <label>Kategori</label>
                <select id="categoryInput">
                    <option>Volunteer</option>
                    <option>Transparansi</option>
                    <option>Lingkungan</option>
                </select>

                <label>Ulasan</label>
                <textarea id="reviewInput"></textarea>

                <button class="submit-btn" onclick="submitReview()">
                    Kirim Ulasan
                </button>

            </div>

            <!-- REVIEW LIST -->
            <div class="reviews-section">

                <h3>Semua Ulasan</h3>

                <div id="reviewList"></div>

            </div>

        </div>

        <!-- SIDEBAR -->
        <div class="sidebar">

            <div class="sidebar-card">

                <h4>Statistik</h4>

                <div class="stat-grid">

                    <div class="stat-item">
                        <div class="stat-num">1.2K</div>
                        <div class="stat-lbl">Volunteer</div>
                    </div>

                    <div class="stat-item">
                        <div class="stat-num">48</div>
                        <div class="stat-lbl">Program</div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="{{ asset('js/ecodonate-rating.js') }}"></script>

</body>
</html>