<!DOCTYPE html>
<html class="scroll-smooth" lang="id">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>EcoDon — Donasi Barang & Volunteer Lingkungan</title>

  <link href="https://fonts.googleapis.com" rel="preconnect" />
  <link crossorigin href="https://fonts.gstatic.com" rel="preconnect" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <script>
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          colors: {
            background: "#fff8f5",
            surface: "#fff8f5",
            "surface-container-low": "#fcf2eb",
            "surface-container": "#f6ece6",
            "surface-container-high": "#f0e6e0",
            "surface-container-highest": "#eae1da",
            primary: "#003527",
            "primary-container": "#064e3b",
            secondary: "#006c49",
            "secondary-container": "#6cf8bb",
            "on-secondary-container": "#002113",
            "on-surface": "#1f1b17",
            "on-surface-variant": "#404944",
            outline: "#707974",
            "outline-variant": "#bfc9c3"
          },
          borderRadius: {
            DEFAULT: "1rem",
            lg: "1.5rem",
            xl: "2rem",
            full: "9999px"
          },
          fontFamily: {
            headline: ["Manrope", "sans-serif"],
            body: ["Inter", "sans-serif"]
          },
          boxShadow: {
            soft: "0 18px 45px rgba(31, 27, 23, 0.08)"
          }
        }
      }
    }
  </script>

  <style>
    .material-symbols-outlined {
      font-variation-settings: "FILL" 0, "wght" 400, "GRAD" 0, "opsz" 24;
    }

    .cta-gradient {
      background: linear-gradient(135deg, #003527 0%, #006c49 100%);
    }

    .hero-blob {
      background:
        radial-gradient(circle at 20% 20%, rgba(108, 248, 187, 0.65), transparent 30%),
        radial-gradient(circle at 80% 20%, rgba(149, 211, 186, 0.45), transparent 28%),
        radial-gradient(circle at 60% 85%, rgba(246, 236, 230, 1), transparent 42%),
        linear-gradient(135deg, #fff8f5 0%, #f6ece6 100%);
    }

    .eco-pattern {
      background-image:
        radial-gradient(rgba(0, 108, 73, 0.12) 1px, transparent 1px),
        radial-gradient(rgba(0, 53, 39, 0.08) 1px, transparent 1px);
      background-position: 0 0, 18px 18px;
      background-size: 36px 36px;
    }

    .fade-up {
      opacity: 0;
      transform: translateY(18px);
      transition: opacity .6s ease, transform .6s ease;
    }

    .fade-up.show {
      opacity: 1;
      transform: translateY(0);
    }

    .tab-active {
      background: #003527;
      color: #fff8f5;
    }

    /* Navbar active underline */
    .nav-link {
      position: relative;
      padding-bottom: 0.35rem;
      transition: color 0.25s ease;
    }

    .nav-link::after {
      content: "";
      position: absolute;
      left: 0;
      bottom: 0;
      width: 0;
      height: 2px;
      background: #006c49;
      transition: width 0.25s ease;
    }

    .nav-link.active {
      color: #006c49;
    }

    .nav-link.active::after {
      width: 100%;
    }
  </style>
</head>

<body class="bg-background text-on-surface font-body selection:bg-secondary-container selection:text-on-secondary-container">
  <!-- Navbar -->
  <nav class="fixed top-0 w-full z-50 bg-[#fff8f5]/85 backdrop-blur-xl shadow-[0_10px_28px_rgba(31,27,23,0.06)]">
    <div class="flex justify-between items-center px-6 md:px-8 py-4 max-w-7xl mx-auto">
      <a class="text-2xl font-extrabold text-primary font-headline tracking-tight" href="#">EcoDon</a>

      <div class="hidden md:flex items-center gap-8 font-headline text-sm font-semibold">
        <a class="nav-link active" href="#impact">Impact</a>
        <a class="nav-link" href="#kebutuhan">Kebutuhan</a>
        <a class="nav-link" href="#blog">Blog</a>
        <a class="nav-link" href="#cara-kerja">Cara Kerja</a>
      </div>

      <div class="hidden md:flex items-center gap-3">
        <a href="/login">
          <button class="px-5 py-2.5 text-primary font-bold font-headline transition-all hover:opacity-75">Sign In</button>
        </a>
        <a href="/register">
          <button class="px-6 py-2.5 cta-gradient text-white rounded-full font-bold font-headline shadow-lg hover:scale-95 active:opacity-80 transition-all">Join Now</button>
        </a>
      </div>

      <button id="mobileMenuButton" class="md:hidden w-10 h-10 rounded-full bg-surface-container-highest flex items-center justify-center text-primary">
        <span class="material-symbols-outlined">menu</span>
      </button>
    </div>

    <div id="mobileMenu" class="hidden md:hidden px-6 pb-5">
      <div class="grid gap-3 p-4 rounded-lg bg-white shadow-soft">
        <a class="mobile-nav text-primary font-bold" href="#impact">Impact</a>
        <a class="mobile-nav text-primary font-bold" href="#kebutuhan">Kebutuhan</a>
        <a class="mobile-nav text-primary font-bold" href="#blog">Blog</a>
        <a class="mobile-nav text-primary font-bold" href="#cara-kerja">Cara Kerja</a>
        <div class="flex gap-3 pt-2">
          <a class="flex-1" href="/login">
            <button class="w-full px-4 py-2.5 rounded-full bg-surface-container-highest text-primary font-bold">Sign In</button>
          </a>
          <a class="flex-1" href="/register">
            <button class="w-full px-4 py-2.5 rounded-full cta-gradient text-white font-bold">Join Now</button>
          </a>
        </div>
      </div>
    </div>
  </nav>

  <main class="pt-24 overflow-hidden">
    <!-- Hero -->
    <section class="relative px-6 md:px-8 py-16 lg:py-28 max-w-7xl mx-auto">
      <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
        <div class="z-10 fade-up">
          <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-secondary-container text-on-secondary-container text-xs font-extrabold uppercase tracking-wider mb-6">
            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">eco</span>
            Donasi Limbah Jadi Lebih Terarah
          </span>

          <h1 class="text-4xl md:text-5xl lg:text-7xl font-headline font-extrabold text-primary leading-[1.08] tracking-tight mb-7">
            Salurkan Limbah, <br />
            Dukung <span class="text-secondary">Aksi Lingkungan</span>
          </h1>

          <p class="text-base md:text-lg text-on-surface-variant max-w-xl mb-9 leading-relaxed">
            EcoDon membantu pendonasi menemukan organisasi sosial yang membutuhkan donasi barang dan dukungan volunteer dalam satu platform yang mudah diakses.
          </p>

          <div class="flex flex-wrap gap-4">
            <a href="/login">
              <button class="px-8 py-4 cta-gradient text-white rounded-full font-bold text-base md:text-lg shadow-xl hover:scale-95 transition-all">
                Mulai Donasi
              </button>
            </a>
            <a href="#kebutuhan">
              <button class="px-8 py-4 bg-surface-container-highest text-on-surface rounded-full font-bold text-base md:text-lg hover:bg-surface-container-high transition-all">
                Lihat Kebutuhan
              </button>
            </a>
          </div>
        </div>

        <div class="relative fade-up">
          <div class="hero-blob eco-pattern aspect-square rounded-xl p-6 md:p-10 shadow-2xl">
            <div class="grid grid-cols-2 gap-4 h-full">
              <button data-feature="donasi" class="feature-card text-left bg-white/85 backdrop-blur rounded-lg p-5 shadow-soft border border-white hover:-translate-y-1 transition-all">
                <span class="material-symbols-outlined text-secondary text-4xl mb-4">recycling</span>
                <h3 class="font-headline text-xl font-extrabold text-primary">Donasi Barang</h3>
                <p class="text-sm text-on-surface-variant mt-2">Salurkan barang atau limbah sesuai kebutuhan organisasi.</p>
              </button>

              <button data-feature="volunteer" class="feature-card text-left bg-white/85 backdrop-blur rounded-lg p-5 shadow-soft border border-white hover:-translate-y-1 transition-all mt-8">
                <span class="material-symbols-outlined text-secondary text-4xl mb-4">groups</span>
                <h3 class="font-headline text-xl font-extrabold text-primary">Volunteer</h3>
                <p class="text-sm text-on-surface-variant mt-2">Ikut kegiatan sosial yang dibuka oleh organisasi.</p>
              </button>

              <button data-feature="blog" class="feature-card text-left bg-white/85 backdrop-blur rounded-lg p-5 shadow-soft border border-white hover:-translate-y-1 transition-all -mt-4">
                <span class="material-symbols-outlined text-secondary text-4xl mb-4">article</span>
                <h3 class="font-headline text-xl font-extrabold text-primary">Blog Edukasi</h3>
                <p class="text-sm text-on-surface-variant mt-2">Baca dan bagikan cerita tentang aksi lingkungan.</p>
              </button>

              <div class="bg-primary text-white rounded-lg p-5 shadow-soft flex flex-col justify-between">
                <div>
                  <span class="material-symbols-outlined text-secondary-container text-4xl mb-4">verified</span>
                  <h3 class="font-headline text-xl font-extrabold">Organisasi Terverifikasi</h3>
                </div>
                <p class="text-sm text-white/75 mt-4">Badge membantu pengguna mengenali organisasi yang kredibel.</p>
              </div>
            </div>
          </div>

          <div id="featureInfo" class="absolute -bottom-8 left-4 right-4 md:left-10 md:right-auto p-5 bg-white/95 backdrop-blur-md rounded-lg shadow-xl md:max-w-sm">
            <p class="text-primary font-extrabold font-headline text-xl mb-1">Donasi Barang</p>
            <p class="text-on-surface-variant text-sm leading-relaxed">Pengguna dapat melihat kebutuhan organisasi dan menyalurkan barang yang sesuai.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Impact / Features -->
    <section id="impact" class="px-6 md:px-8 py-20 bg-surface-container-low">
      <div class="max-w-7xl mx-auto">
        <div class="mb-12 text-center max-w-2xl mx-auto fade-up">
          <h2 class="text-3xl md:text-4xl font-headline font-extrabold text-primary mb-4">Fokus Utama EcoDon</h2>
          <p class="text-on-surface-variant">Platform ini dirancang untuk membantu proses publikasi kebutuhan, penyaluran donasi barang, kegiatan volunteer, dan edukasi lingkungan.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <a href="#kebutuhan" class="fade-up group bg-surface-container rounded-lg p-8 hover:bg-white hover:-translate-y-1 hover:shadow-soft transition-all">
            <div class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container mb-6 group-hover:scale-110 transition-transform">
              <span class="material-symbols-outlined">inventory_2</span>
            </div>
            <h3 class="text-xl font-headline font-extrabold text-primary mb-3">Kebutuhan Donasi</h3>
            <p class="text-on-surface-variant mb-6">Organisasi dapat menampilkan kebutuhan barang secara jelas agar pendonasi tahu apa yang perlu disalurkan.</p>
            <span class="inline-flex items-center gap-2 text-secondary font-bold">Lihat kebutuhan <span class="material-symbols-outlined text-sm">arrow_forward</span></span>
          </a>

          <a href="#kebutuhan" class="fade-up group bg-primary text-white rounded-lg p-8 hover:-translate-y-1 hover:shadow-soft transition-all">
            <div class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container mb-6 group-hover:scale-110 transition-transform">
              <span class="material-symbols-outlined">volunteer_activism</span>
            </div>
            <h3 class="text-xl font-headline font-extrabold mb-3">Volunteer</h3>
            <p class="text-white/75 mb-6">Pengguna dapat menemukan kegiatan volunteer dan mendaftar sesuai minat serta kebutuhan organisasi.</p>
            <span class="inline-flex items-center gap-2 text-secondary-container font-bold">Cari kegiatan <span class="material-symbols-outlined text-sm">arrow_forward</span></span>
          </a>

          <a href="#blog" class="fade-up group bg-surface-container rounded-lg p-8 hover:bg-white hover:-translate-y-1 hover:shadow-soft transition-all">
            <div class="w-12 h-12 rounded-full bg-secondary/10 flex items-center justify-center text-secondary mb-6 group-hover:scale-110 transition-transform">
              <span class="material-symbols-outlined">edit_note</span>
            </div>
            <h3 class="text-xl font-headline font-extrabold text-primary mb-3">Blog Lingkungan</h3>
            <p class="text-on-surface-variant mb-6">Pengguna dan organisasi dapat berbagi informasi, pengalaman, dan edukasi terkait lingkungan.</p>
            <span class="inline-flex items-center gap-2 text-secondary font-bold">Baca blog <span class="material-symbols-outlined text-sm">arrow_forward</span></span>
          </a>
        </div>
      </div>
    </section>

    <!-- Needs -->
    <section id="kebutuhan" class="px-6 md:px-8 py-20 max-w-7xl mx-auto">
      <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-6 mb-10 fade-up">
        <div>
          <h2 class="text-3xl md:text-4xl font-headline font-extrabold text-primary mb-3">Kebutuhan Terbaru</h2>
          <p class="text-on-surface-variant max-w-2xl">Pilih kategori untuk melihat contoh kebutuhan yang dapat dipublikasikan organisasi di EcoDon.</p>
        </div>

        <div class="flex flex-wrap gap-3">
          <button class="need-tab tab-active px-5 py-2.5 rounded-full font-bold transition-all" data-filter="all">Semua</button>
          <button class="need-tab px-5 py-2.5 rounded-full bg-surface-container-highest text-primary font-bold transition-all" data-filter="barang">Donasi Barang</button>
          <button class="need-tab px-5 py-2.5 rounded-full bg-surface-container-highest text-primary font-bold transition-all" data-filter="volunteer">Volunteer</button>
        </div>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        <article class="need-card fade-up bg-white rounded-lg p-6 border border-outline-variant/20 shadow-sm" data-type="barang">
          <div class="flex items-center justify-between mb-5">
            <span class="px-3 py-1 rounded-full bg-secondary-container text-on-secondary-container text-xs font-extrabold">Donasi Barang</span>
            <span class="material-symbols-outlined text-secondary">compost</span>
          </div>
          <h3 class="text-xl font-headline font-extrabold text-primary mb-2">Limbah Organik Rumah Tangga</h3>
          <p class="text-on-surface-variant text-sm mb-5">Dibutuhkan bahan organik bersih untuk kegiatan pengolahan kompos komunitas.</p>
          <div class="flex items-center justify-between text-sm">
            <span class="font-bold text-primary">Komunitas Hijau</span>
            <button class="open-detail text-secondary font-extrabold" data-title="Limbah Organik Rumah Tangga" data-body="Kebutuhan ini berfokus pada limbah organik bersih seperti kulit buah dan sisa sayur yang dapat digunakan untuk pengolahan kompos komunitas.">Detail</button>
          </div>
        </article>

        <article class="need-card fade-up bg-white rounded-lg p-6 border border-outline-variant/20 shadow-sm" data-type="barang">
          <div class="flex items-center justify-between mb-5">
            <span class="px-3 py-1 rounded-full bg-secondary-container text-on-secondary-container text-xs font-extrabold">Donasi Barang</span>
            <span class="material-symbols-outlined text-secondary">oil_barrel</span>
          </div>
          <h3 class="text-xl font-headline font-extrabold text-primary mb-2">Minyak Jelantah Terkumpul</h3>
          <p class="text-on-surface-variant text-sm mb-5">Organisasi membuka pengumpulan minyak jelantah untuk diolah secara bertanggung jawab.</p>
          <div class="flex items-center justify-between text-sm">
            <span class="font-bold text-primary">Bank Sampah Mitra</span>
            <button class="open-detail text-secondary font-extrabold" data-title="Minyak Jelantah Terkumpul" data-body="Pengguna dapat menyalurkan minyak jelantah dalam wadah tertutup. Organisasi akan melakukan pencatatan dan proses penerimaan barang.">Detail</button>
          </div>
        </article>

        <article class="need-card fade-up bg-white rounded-lg p-6 border border-outline-variant/20 shadow-sm" data-type="volunteer">
          <div class="flex items-center justify-between mb-5">
            <span class="px-3 py-1 rounded-full bg-primary text-white text-xs font-extrabold">Volunteer</span>
            <span class="material-symbols-outlined text-secondary">groups_3</span>
          </div>
          <h3 class="text-xl font-headline font-extrabold text-primary mb-2">Relawan Sortir Donasi</h3>
          <p class="text-on-surface-variant text-sm mb-5">Dibutuhkan relawan untuk membantu sortir barang dan pencatatan donasi masuk.</p>
          <div class="flex items-center justify-between text-sm">
            <span class="font-bold text-primary">EcoHub Selatan</span>
            <button class="open-detail text-secondary font-extrabold" data-title="Relawan Sortir Donasi" data-body="Kegiatan volunteer ini membantu organisasi dalam memilah donasi barang dan mencatat data kontribusi pengguna.">Detail</button>
          </div>
        </article>

        <article class="need-card fade-up bg-white rounded-lg p-6 border border-outline-variant/20 shadow-sm" data-type="volunteer">
          <div class="flex items-center justify-between mb-5">
            <span class="px-3 py-1 rounded-full bg-primary text-white text-xs font-extrabold">Volunteer</span>
            <span class="material-symbols-outlined text-secondary">campaign</span>
          </div>
          <h3 class="text-xl font-headline font-extrabold text-primary mb-2">Edukasi Pemilahan Sampah</h3>
          <p class="text-on-surface-variant text-sm mb-5">Relawan dibutuhkan untuk membantu kegiatan edukasi lingkungan di area komunitas.</p>
          <div class="flex items-center justify-between text-sm">
            <span class="font-bold text-primary">Teman Pilah</span>
            <button class="open-detail text-secondary font-extrabold" data-title="Edukasi Pemilahan Sampah" data-body="Relawan akan membantu penyampaian materi sederhana tentang pemilahan sampah dan pencatatan peserta kegiatan.">Detail</button>
          </div>
        </article>

        <article class="need-card fade-up bg-white rounded-lg p-6 border border-outline-variant/20 shadow-sm" data-type="barang">
          <div class="flex items-center justify-between mb-5">
            <span class="px-3 py-1 rounded-full bg-secondary-container text-on-secondary-container text-xs font-extrabold">Donasi Barang</span>
            <span class="material-symbols-outlined text-secondary">local_drink</span>
          </div>
          <h3 class="text-xl font-headline font-extrabold text-primary mb-2">Botol Plastik Bersih</h3>
          <p class="text-on-surface-variant text-sm mb-5">Dibutuhkan botol plastik yang sudah dibersihkan untuk kegiatan daur ulang.</p>
          <div class="flex items-center justify-between text-sm">
            <span class="font-bold text-primary">Rumah Daur Ulang</span>
            <button class="open-detail text-secondary font-extrabold" data-title="Botol Plastik Bersih" data-body="Botol plastik yang diterima sebaiknya dalam kondisi kosong dan bersih agar proses sortir lebih mudah dilakukan.">Detail</button>
          </div>
        </article>

        <article class="need-card fade-up bg-white rounded-lg p-6 border border-outline-variant/20 shadow-sm" data-type="volunteer">
          <div class="flex items-center justify-between mb-5">
            <span class="px-3 py-1 rounded-full bg-primary text-white text-xs font-extrabold">Volunteer</span>
            <span class="material-symbols-outlined text-secondary">event_available</span>
          </div>
          <h3 class="text-xl font-headline font-extrabold text-primary mb-2">Pendamping Kegiatan Komunitas</h3>
          <p class="text-on-surface-variant text-sm mb-5">Organisasi membutuhkan relawan untuk membantu koordinasi kegiatan lapangan.</p>
          <div class="flex items-center justify-between text-sm">
            <span class="font-bold text-primary">Green Action</span>
            <button class="open-detail text-secondary font-extrabold" data-title="Pendamping Kegiatan Komunitas" data-body="Relawan bertugas membantu alur registrasi peserta, dokumentasi kegiatan, dan koordinasi sederhana saat acara berlangsung.">Detail</button>
          </div>
        </article>
      </div>
    </section>

    <!-- How It Works -->
    <section id="cara-kerja" class="px-6 md:px-8 py-20 bg-surface-container-low">
      <div class="max-w-7xl mx-auto">
        <div class="mb-12 max-w-2xl fade-up">
          <h2 class="text-3xl md:text-4xl font-headline font-extrabold text-primary mb-4">Cara Kerja EcoDon</h2>
          <p class="text-on-surface-variant">Alur dibuat sederhana agar pendonasi dan organisasi dapat saling terhubung dengan lebih jelas.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
          <div class="fade-up bg-white p-7 rounded-lg border border-outline-variant/20">
            <div class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center font-headline font-extrabold text-primary mb-5">1</div>
            <h4 class="text-lg font-extrabold text-primary mb-2">Cari Kebutuhan</h4>
            <p class="text-sm text-on-surface-variant">Pengguna melihat kebutuhan donasi barang atau volunteer yang dipublikasikan organisasi.</p>
          </div>

          <div class="fade-up bg-white p-7 rounded-lg border border-outline-variant/20">
            <div class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center font-headline font-extrabold text-primary mb-5">2</div>
            <h4 class="text-lg font-extrabold text-primary mb-2">Ajukan Donasi</h4>
            <p class="text-sm text-on-surface-variant">Pengguna mengisi form donasi barang atau pendaftaran volunteer sesuai kebutuhan.</p>
          </div>

          <div class="fade-up bg-white p-7 rounded-lg border border-outline-variant/20">
            <div class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center font-headline font-extrabold text-primary mb-5">3</div>
            <h4 class="text-lg font-extrabold text-primary mb-2">Divalidasi Organisasi</h4>
            <p class="text-sm text-on-surface-variant">Organisasi menerima, menolak, atau memperbarui status pengajuan yang masuk.</p>
          </div>

          <div class="fade-up bg-primary p-7 rounded-lg text-white">
            <div class="w-12 h-12 rounded-full bg-secondary flex items-center justify-center font-headline font-extrabold text-white mb-5">4</div>
            <h4 class="text-lg font-extrabold mb-2">Pantau Aktivitas</h4>
            <p class="text-sm text-white/75">Pengguna dapat melihat riwayat kontribusi, status donasi, poin reward, dan informasi kegiatan.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Blog -->
    <section id="blog" class="px-6 md:px-8 py-20 max-w-7xl mx-auto">
      <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-10 fade-up">
        <div>
          <h2 class="text-3xl md:text-4xl font-headline font-extrabold text-primary mb-3">Blog EcoDon</h2>
          <p class="text-on-surface-variant max-w-2xl">Ruang berbagi cerita, edukasi, dan informasi kegiatan dari pengguna maupun organisasi.</p>
        </div>
        <div class="relative w-full md:w-80">
          <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">search</span>
          <input id="blogSearch" class="w-full rounded-full border-outline-variant bg-white pl-12 pr-4 py-3 focus:ring-secondary focus:border-secondary" placeholder="Cari artikel..." type="text" />
        </div>
      </div>

      <div id="blogList" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <article class="blog-card fade-up bg-white rounded-lg overflow-hidden border border-outline-variant/20 shadow-sm" data-title="cara memilah limbah organik">
          <div class="h-44 eco-pattern bg-surface-container-highest flex items-center justify-center">
            <span class="material-symbols-outlined text-secondary text-7xl">compost</span>
          </div>
          <div class="p-7">
            <p class="text-xs text-on-surface-variant font-bold mb-2">Edukasi • 5 min read</p>
            <h3 class="text-xl font-headline font-extrabold text-primary mb-3">Cara Memilah Limbah Organik dari Rumah</h3>
            <p class="text-on-surface-variant text-sm mb-6">Panduan sederhana untuk memisahkan limbah organik agar lebih mudah disalurkan.</p>
            <button class="blog-read text-sm font-extrabold text-secondary" data-title="Cara Memilah Limbah Organik dari Rumah">Baca Selengkapnya</button>
          </div>
        </article>

        <article class="blog-card fade-up bg-white rounded-lg overflow-hidden border border-outline-variant/20 shadow-sm" data-title="cerita volunteer lingkungan komunitas">
          <div class="h-44 eco-pattern bg-surface-container-highest flex items-center justify-center">
            <span class="material-symbols-outlined text-secondary text-7xl">diversity_3</span>
          </div>
          <div class="p-7">
            <p class="text-xs text-on-surface-variant font-bold mb-2">Volunteer • 4 min read</p>
            <h3 class="text-xl font-headline font-extrabold text-primary mb-3">Cerita Volunteer di Kegiatan Lingkungan</h3>
            <p class="text-on-surface-variant text-sm mb-6">Pengalaman singkat tentang bagaimana relawan membantu kegiatan sortir donasi.</p>
            <button class="blog-read text-sm font-extrabold text-secondary" data-title="Cerita Volunteer di Kegiatan Lingkungan">Baca Selengkapnya</button>
          </div>
        </article>

        <article class="blog-card fade-up bg-white rounded-lg overflow-hidden border border-outline-variant/20 shadow-sm" data-title="donasi barang yang sering dibutuhkan">
          <div class="h-44 eco-pattern bg-surface-container-highest flex items-center justify-center">
            <span class="material-symbols-outlined text-secondary text-7xl">inventory</span>
          </div>
          <div class="p-7">
            <p class="text-xs text-on-surface-variant font-bold mb-2">Donasi • 6 min read</p>
            <h3 class="text-xl font-headline font-extrabold text-primary mb-3">Jenis Barang yang Sering Dibutuhkan</h3>
            <p class="text-on-surface-variant text-sm mb-6">Beberapa contoh barang dan limbah yang biasanya dibutuhkan organisasi mitra.</p>
            <button class="blog-read text-sm font-extrabold text-secondary" data-title="Jenis Barang yang Sering Dibutuhkan">Baca Selengkapnya</button>
          </div>
        </article>
      </div>

      <p id="emptyBlog" class="hidden text-center text-on-surface-variant mt-10">Artikel tidak ditemukan.</p>
    </section>

    <!-- CTA -->
    <section class="px-6 md:px-8 py-20">
      <div class="max-w-7xl mx-auto cta-gradient rounded-xl p-8 md:p-12 text-white relative overflow-hidden">
        <div class="absolute right-0 bottom-0 opacity-10">
          <span class="material-symbols-outlined text-[220px]">eco</span>
        </div>
        <div class="relative z-10 max-w-2xl">
          <h2 class="text-3xl md:text-4xl font-headline font-extrabold mb-4">Mulai kontribusi kecil dari hari ini.</h2>
          <p class="text-white/75 mb-8">Daftar sebagai pengguna untuk melihat kebutuhan donasi barang, mengikuti organisasi, atau mendaftar kegiatan volunteer.</p>
          <div class="flex flex-wrap gap-4">
            <a href="/register">
              <button class="px-7 py-3.5 bg-white text-primary rounded-full font-extrabold hover:scale-95 transition-all">Join Now</button>
            </a>
            <a href="/login">
              <button class="px-7 py-3.5 bg-white/10 text-white rounded-full font-extrabold hover:bg-white/15 transition-all">Sign In</button>
            </a>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- Modal -->
  <div id="modal" class="fixed inset-0 z-[80] hidden items-center justify-center px-6">
    <div id="modalBackdrop" class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>
    <div class="relative bg-white max-w-lg w-full rounded-xl shadow-2xl p-7">
      <button id="closeModal" class="absolute top-4 right-4 w-9 h-9 rounded-full bg-surface-container-highest flex items-center justify-center">
        <span class="material-symbols-outlined">close</span>
      </button>
      <div class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center text-primary mb-5">
        <span class="material-symbols-outlined">info</span>
      </div>
      <h3 id="modalTitle" class="text-2xl font-headline font-extrabold text-primary mb-3">Detail</h3>
      <p id="modalBody" class="text-on-surface-variant leading-relaxed">Informasi detail.</p>
      <div class="mt-7 flex justify-end">
        <a href="/login">
          <button class="px-6 py-3 cta-gradient text-white rounded-full font-extrabold">Lanjutkan</button>
        </a>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-primary w-full py-16 px-6 md:px-8 text-[#fff8f5] font-body text-sm">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 max-w-7xl mx-auto">
      <div>
        <a class="text-2xl font-extrabold text-white font-headline mb-5 block" href="#">EcoDon</a>
        <p class="text-white/60 mb-7 max-w-xs leading-relaxed">
          Platform donasi berbasis lingkungan yang menghubungkan pendonasi, organisasi sosial, dan kegiatan volunteer.
        </p>
        <div class="flex gap-3">
          <a class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-secondary transition-colors" href="#">
            <span class="material-symbols-outlined text-lg">alternate_email</span>
          </a>
          <a class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-secondary transition-colors" href="#">
            <span class="material-symbols-outlined text-lg">public</span>
          </a>
        </div>
      </div>

      <div>
        <h4 class="text-white font-extrabold mb-5">Menu</h4>
        <ul class="space-y-3">
          <li><a class="text-white/60 hover:text-secondary-container transition-colors" href="#impact">Impact</a></li>
          <li><a class="text-white/60 hover:text-secondary-container transition-colors" href="#kebutuhan">Kebutuhan</a></li>
          <li><a class="text-white/60 hover:text-secondary-container transition-colors" href="#blog">Blog</a></li>
          <li><a class="text-white/60 hover:text-secondary-container transition-colors" href="#cara-kerja">Cara Kerja</a></li>
        </ul>
      </div>

      <div>
        <h4 class="text-white font-extrabold mb-5">Aksi</h4>
        <ul class="space-y-3">
          <li><a class="text-white/60 hover:text-secondary-container transition-colors" href="/login">Mulai Donasi</a></li>
          <li><a class="text-white/60 hover:text-secondary-container transition-colors" href="/login">Daftar Volunteer</a></li>
          <li><a class="text-white/60 hover:text-secondary-container transition-colors" href="/register">Buat Akun</a></li>
        </ul>
      </div>

      <div>
        <h4 class="text-white font-extrabold mb-5">Update EcoDon</h4>
        <p class="text-white/60 mb-5">Dapatkan informasi terbaru terkait kebutuhan donasi dan kegiatan volunteer.</p>
        <form id="newsletterForm" class="flex">
          <input class="bg-white/10 border-none rounded-l-lg px-4 py-3 text-white placeholder:text-white/40 focus:ring-1 focus:ring-secondary w-full" placeholder="Email" type="email" required />
          <button class="bg-secondary px-4 rounded-r-lg hover:opacity-90 transition-opacity" type="submit">
            <span class="material-symbols-outlined">send</span>
          </button>
        </form>
        <p id="newsletterMsg" class="hidden mt-3 text-secondary-container font-semibold">Terima kasih, email kamu sudah tercatat.</p>
      </div>
    </div>

    <div class="max-w-7xl mx-auto mt-12 pt-7 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-4">
      <p class="text-white/45">© 2026 EcoDon. Platform donasi berbasis lingkungan.</p>
      <div class="flex gap-6">
        <a class="text-white/45 hover:text-white" href="#">Privacy</a>
        <a class="text-white/45 hover:text-white" href="#">Contact</a>
      </div>
    </div>
  </footer>

  <script>
    const mobileMenuButton = document.getElementById("mobileMenuButton");
    const mobileMenu = document.getElementById("mobileMenu");

    mobileMenuButton.addEventListener("click", () => {
      mobileMenu.classList.toggle("hidden");
    });

    document.querySelectorAll(".mobile-nav").forEach((link) => {
      link.addEventListener("click", () => mobileMenu.classList.add("hidden"));
    });

    const navLinks = document.querySelectorAll(".nav-link");

    navLinks.forEach((link) => {
      link.addEventListener("click", () => {
        navLinks.forEach((item) => item.classList.remove("active"));
        link.classList.add("active");
      });
    });

    const featureCopy = {
      donasi: {
        title: "Donasi Barang",
        body: "Pengguna dapat melihat kebutuhan organisasi dan menyalurkan barang yang sesuai."
      },
      volunteer: {
        title: "Volunteer",
        body: "Pengguna dapat memilih kegiatan volunteer dan mendaftar melalui platform."
      },
      blog: {
        title: "Blog Edukasi",
        body: "Blog menjadi ruang berbagi informasi, cerita, dan edukasi lingkungan."
      }
    };

    document.querySelectorAll(".feature-card").forEach((card) => {
      card.addEventListener("click", () => {
        const key = card.dataset.feature;
        document.querySelector("#featureInfo p:first-child").textContent = featureCopy[key].title;
        document.querySelector("#featureInfo p:last-child").textContent = featureCopy[key].body;
      });
    });

    const tabs = document.querySelectorAll(".need-tab");
    const cards = document.querySelectorAll(".need-card");

    tabs.forEach((tab) => {
      tab.addEventListener("click", () => {
        tabs.forEach((item) => {
          item.classList.remove("tab-active");
          item.classList.add("bg-surface-container-highest", "text-primary");
        });

        tab.classList.add("tab-active");
        tab.classList.remove("bg-surface-container-highest", "text-primary");

        const filter = tab.dataset.filter;
        cards.forEach((card) => {
          const isVisible = filter === "all" || card.dataset.type === filter;
          card.classList.toggle("hidden", !isVisible);
        });
      });
    });

    const modal = document.getElementById("modal");
    const modalTitle = document.getElementById("modalTitle");
    const modalBody = document.getElementById("modalBody");
    const closeModal = document.getElementById("closeModal");
    const modalBackdrop = document.getElementById("modalBackdrop");

    function openModal(title, body) {
      modalTitle.textContent = title;
      modalBody.textContent = body;
      modal.classList.remove("hidden");
      modal.classList.add("flex");
    }

    function hideModal() {
      modal.classList.add("hidden");
      modal.classList.remove("flex");
    }

    document.querySelectorAll(".open-detail").forEach((button) => {
      button.addEventListener("click", () => {
        openModal(button.dataset.title, button.dataset.body);
      });
    });

    document.querySelectorAll(".blog-read").forEach((button) => {
      button.addEventListener("click", () => {
        openModal(button.dataset.title, "Artikel ini akan menampilkan detail konten blog ketika fitur blog sudah terhubung dengan data sistem.");
      });
    });

    closeModal.addEventListener("click", hideModal);
    modalBackdrop.addEventListener("click", hideModal);

    const blogSearch = document.getElementById("blogSearch");
    const blogCards = document.querySelectorAll(".blog-card");
    const emptyBlog = document.getElementById("emptyBlog");

    blogSearch.addEventListener("input", (event) => {
      const keyword = event.target.value.toLowerCase().trim();
      let visibleCount = 0;

      blogCards.forEach((card) => {
        const matched = card.dataset.title.includes(keyword);
        card.classList.toggle("hidden", !matched);
        if (matched) visibleCount += 1;
      });

      emptyBlog.classList.toggle("hidden", visibleCount !== 0);
    });

    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("show");
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12 });

    document.querySelectorAll(".fade-up").forEach((element) => observer.observe(element));

    document.getElementById("newsletterForm").addEventListener("submit", (event) => {
      event.preventDefault();
      document.getElementById("newsletterMsg").classList.remove("hidden");
      event.target.reset();
    });
  </script>
</body>
</html>
