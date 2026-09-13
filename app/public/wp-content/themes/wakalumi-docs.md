# 📘 WAKALUMI BPRS - KNOWLEDGE BASE & DOKUMENTASI

Dokumen ini berfungsi sebagai **Landasan Konteks (Context Memory)** utama untuk pengembangan AI dan panduan teknis proyek. Tujuannya adalah agar AI tidak kehilangan arah, memahami arsitektur secara keseluruhan, alat yang digunakan, gaya desain, dan sejarah pengerjaan secara rinci.

---

## 🏛️ 1. VISI & ARSITEKTUR PROYEK
Proyek ini adalah pembuatan ulang (revamp) antarmuka website **BPRS Wakalumi**. Fokus utamanya adalah menghadirkan kesan modern, profesional, transparan (khas perbankan syariah), dan responsif, tanpa membebani server dengan *page builder* (seperti Elementor).

**Pola Arsitektur Tema:**
- **Custom WordPress Theme**: Tema dibangun dari nol (*scratch*) di atas WordPress (Local WP).
- **Component-Driven (PHP)**: Memecah bagian-bagian web ke dalam file PHP spesifik (`header.php`, `footer.php`, `front-page.php`) agar modular.
- **Headless-feel (Swup.js)**: Menggunakan Swup.js agar perpindahan antar halaman terasa seperti *Single Page Application* (SPA) tanpa *reload* browser.

---

## 🛠️ 2. STACK TEKNOLOGI & TOOLS
Berikut adalah alat dan dependensi yang wajib diikuti dalam pengembangan:
1. **Environment**: Local WP (WordPress)
2. **Build System**: **Vite.js** (Sangat cepat, menggantikan Webpack/Gulp).
   - *Command*: `npm run dev` (untuk *live reload*) & `npm run build` (untuk *production*).
3. **Styling**: **Tailwind CSS v3** (Utility-first framework). Tidak ada CSS konvensional yang panjang; sebagian besar dikendalikan via *class* Tailwind di HTML.
4. **JavaScript**: Vanilla ES6 Modules. Ditempatkan di `assets/src/js/app.js`.
5. **Animasi**: 
   - **AOS (Animate On Scroll)** untuk elemen yang muncul saat di-scroll.
   - **Custom Keyframes (Tailwind)** untuk animasi *preloader* dan efek melayang (*floating*).

---

## 🎨 3. GAYA DESAIN (STYLING GUIDELINES)
Untuk mempertahankan konsistensi visual, AI dan Developer wajib mematuhi panduan desain berikut:

### A. Palet Warna (Brand Colors)
- **Primary (Ocean Teal)**: `#088395` (Dominan untuk teks utama, tombol, logo).
- **Secondary (Bright Teal)**: `#24B1B1` (Untuk gradasi dan elemen sekunder).
- **Accent (Mint Glow)**: `#5DF8D8` (Untuk aksen neon, *glow effect* di *dark mode*, dan status sukses).
- **Dark Mode Surface**: `#0B1120` (Biru dongker pekat untuk latar belakang utama *dark mode*).

### B. Konsep UI "Glassmorphism & Parallax"
- **Glassmorphism**: Digunakan secara ekstensif pada *card* (kartu). Resep rahasianya: Latar semi-transparan (`bg-white/40`), efek buram (`backdrop-blur-md`), dan batas garis putih tipis (`border border-white/50`). Pada *dark mode*, gunakan `bg-dark-surface/40`.
- **Shadow Brand**: Hindari bayangan hitam kaku. Gunakan bayangan dengan warna *brand* (contoh: `shadow-primary-500/40`) saat elemen disentuh (*hover*).
- **Transisi Halus**: Selalu gunakan `transition-all duration-500 ease-out` untuk memastikan perubahan (*hover*) terasa sangat profesional dan tidak kasar.
- **Efek Menumpuk (Stacking Parallax)**: Bagian pertama halaman (*Hero*) bersifat lengket (`sticky`), dan bagian berikutnya ditarik ke atas menggunakan margin negatif (contoh: `-mt-24`) agar menutupi/menabrak *Hero* secara mulus saat di-scroll.

---

## 📂 4. STRUKTUR FILE & DATA
- `header.php`: 
  - Navbar Dropdown ("Produk Dana", "Pembiayaan", dll).
  - Animasi *Preloader* bertema "Air Mengisi Logo".
  - *Fixed Global Background Parallax* (`wm-wkl.png` skala besar) yang ada di seluruh halaman.
- `footer.php`: 
  - Kontak statis (Phone: `(021) 7401667`, WA: `+62 815-1738-0388`).
  - Ikon sosial media (Instagram, Facebook, LinkedIn - *YouTube/TikTok dihapus*).
- `front-page.php`: Halaman Beranda dengan 8 section:
  1. **Hero Slider**: Punya panah navigasi *hover* (kanan/kiri) dan logo OJK/LPS yang diangkat ke `bottom-32` agar tidak tertutup konten di bawahnya.
  2. **Layanan Cepat**: 3 Kartu Glassmorphism (Pembiayaan, Produk Dana, Simulasi).
  3. **Produk Preview**
  4. **Tentang Kami**: Menggunakan foto HD (`about-photo.jpg`).
  5. **Nisbah**: Kartu beranimasi *slide* logo dari kiri ke kanan dengan bayangan *teal*.
  6. **Video Profil**: Thumbnail foto kantor (`video-thumb.jpg`) murni tanpa filter *blur* agar jernih.
  7. **Sosial Media (Instagram)**: Format **CSS Grid Auto-Columns** (Tinggi menyesuaikan isi secara natural agar rapi dan bisa di-scroll horizontal tanpa patah/jelek).
  8. **CTA Bawah**: Tombol langsung menuju ke URL WhatsApp yang benar.
- `assets/img/`: Menyimpan semua aset gambar HD (`about-photo.jpg`, `video-thumb.jpg`, `wm-wkl.png`, `logo-new-1.png`).

---

## 🚀 5. RIWAYAT PROGRESS (STEP-BY-STEP)
Agar konteks tidak hilang, ini adalah urutan pengembangan yang telah dilalui:

* **Tahap 1: Scaffolding & Setup**
  - Menginisialisasi Vite dan Tailwind.
  - Membangun kerangka HTML *header* dan *footer*.
  - Mengimplementasikan Dark Mode *toggle*.
* **Tahap 2: Pembangunan Beranda (V1)**
  - Menyusun 8 *section* di `front-page.php`.
  - Membuat *slider* Hero sederhana.
  - Menyiapkan wadah *embed* Instagram.
* **Tahap 3: Penyempurnaan UX & Desain (Revisi Pengguna - Selesai)**
  - Mengubah warna menjadi gaya khas Wakalumi.
  - Mengembalikan efek *loading preloader* bergaya "Air" menggunakan logo baru.
  - Menambahkan Parallax Watermark global di `header.php`.
  - Mengembalikan efek menabrak/menumpuk (-mt-24) di bawah Hero.
  - Mengatur tinggi *embed* Instagram agar berbasis Grid alami (sehingga tidak buram/patah ukurannya).
  - Menghapus efek `mix-blend-luminosity` pada thumbnail foto agar tampilan HD tidak "burik".
  - Mengupdate CTA WA dan mengubah kata "Pendanaan" menjadi "Produk Dana".
  - Mengamankan logo OJK & LPS agar posisinya pas di atas kartu kaca (*glassmorphism*).
* **Tahap 4: Pure CSS Background Emblem Layering (Window Cutout)**
  - Mengubah sistem watermark emblem dari JS Fade menjadi Pure CSS physical layering pada `z-[1]`.
  - Section pekat (Hero `z-[2]`, Layanan Cepat, Produk, Tentang Kami, Video, Berita, Footer `z-10`) secara fisik menutupi emblem.
  - Section terbuka (Realisasi Nisbah & Sosial Media) dibuat `bg-transparent relative z-10` sebagai "jendela tembus" ke background.
  - Menyeimbangkan kontras Dark Mode (`dark:bg-slate-800/60`, `dark:border-slate-700/60`, `opacity-30`) dan Light Mode (`opacity-35`) agar lembut sebagai watermark.
* **Tahap 6: Sinkronisasi Penuh Frontend & WP-Admin (100% Zero-Cost CMS)**
  - Menghubungkan seluruh bagian beranda yang sebelumnya hardcoded ke panel admin native.
  - **Google Maps**: Menambahkan input sematan URL Google Maps (`options_maps_embed`) di `Pengaturan Website -> Kontak & Maps`.
  - **Layanan Cepat**: Menjadikan 4 kartu kaca (Pembiayaan, Produk Dana, Simulasi, Laporan) dapat diedit judul, deskripsi, dan linknya di `Pengaturan Website -> Layanan & Media`.
  - **Video Profil**: Menjadikan judul, sub-teks, URL YouTube, dan thumbnail dapat diedit, serta menambahkan pop-up modal pemutar video otomatis ketika tombol Play diklik.
  - **Instagram Feed**: Membuat 3 tautan postingan Instagram dapat diganti secara dinamis dari admin.
  - **Announcement Bar**: Memberikan saklar aktif/nonaktif, teks, tautan, dan pilihan warna banner di `Pengaturan Website -> Umum & Pengumuman`.
  - **Jam Operasional & Disclaimer**: Menjadikan jam kerja weekday/weekend, hak cipta, dan pernyataan regulasi OJK/LPS dinamis di `Pengaturan Website -> Footer & Jam Kerja`.
  - **Panduan Laman Beranda**: Menambahkan kotak panduan visual di halaman edit Beranda dan membersihkan form ganda yang membingungkan.

---

## 🏛️ 6. ARSITEKTUR KONTEN 100% GRATIS (ZERO-COST CMS)

Agar website bisa dikustomisasi secara penuh tanpa biaya lisensi plugin berbayar (ACF Pro, Elementor Pro, dll), arsitektur dibagi menjadi 3 pilar:

### 1. Custom Post Types (CPT) — Native WordPress
- Lokasi: `inc/cpt.php`
- Digunakan untuk konten berulang / dinamis:
  - **Slider Hero** (`post_type=hero_slide`): Mengelola slide gambar banner, judul besar, sub-headline, dan 2 tombol aksi di beranda.
  - **Berita** (`post_type=berita`): Dilengkapi kategori berita, featured image, dan Gutenberg support.
  - **Produk** (`post_type=produk`): Untuk produk tabungan, deposito, dan pembiayaan. Terdapat field `featured` untuk memilih 4 produk unggulan di beranda.
  - **Tim Kami** (`post_type=anggota_tim`): Untuk susunan pengurus & manajemen.

### 2. Pengaturan Website Terpusat — Native Admin Options
- Lokasi: `inc/admin-options.php`
- Menyediakan 5 Submenu di bawah **Pengaturan Website** di WP-Admin:
  1. **Umum & Pengumuman**: Saklar Announcement Bar, isi teks, tautan, tipe banner, dan nomor WhatsApp CS global beserta template pesan.
  2. **Kontak & Maps**: Nomor telepon kantor, email resmi, alamat lengkap, dan URL Embed Google Maps (dengan panduan salin-tempel).
  3. **Layanan & Media**: 
     - Pengaturan teks dan link untuk 4 Kartu Layanan Cepat.
     - Video Profil: Judul, sub-teks, thumbnail, dan URL YouTube (dengan popup modal player otomatis).
     - **Instagram Feed Dinamis**: Tabel dinamis (repeater) dengan tombol *+ Tambah Postingan Instagram* dan tombol hapus, memungkinkan admin menampilkan 3, 5, atau puluhan postingan Instagram yang otomatis di-scroll horizontal di beranda.
  4. **Informasi Nisbah**: Pengaturan periode bulan dan tabel dinamis bagi hasil nasabah vs bank beserta equivalent rate.
  5. **Footer & Jam Kerja**: Jam kerja hari kerja & akhir pekan, hak cipta (copyright), pernyataan pengawasan OJK & LPS, serta tautan media sosial.

### 3. Pembersihan Menu Admin & Peta Navigasi (Anti-Ambiguitas)
- Lokasi: `inc/theme-setup.php`
- **Pembersihan Menu Default**:
  - Menu bawaan WordPress **Pos (Posts)** yang berisi "Hello World!" dan **Komentar (Comments)** disembunyikan via `wakalumi_cleanup_admin_sidebar()`. Hal ini karena website perbankan syariah menggunakan CPT **Berita** (`/berita`) untuk publikasi resmi, sehingga tidak ada lagi kebingungan antara "Pos" vs "Berita".
- **Dashboard Roadmap Widget**:
  - Di halaman utama `/wp-admin`, widget kustom *🏛️ Panduan Struktur Konten Website BPRS Wakalumi* menampilkan tabel panduan lengkap pemetaan seluruh menu ke bagian frontend.
- **Menu Pintasan Cepat (Admin Bar Quick Links)**:
  - Saat admin yang sedang login menelusuri halaman depan (frontend), bilah hitam atas (*Admin Bar*) memiliki menu dropdown **⚡ Edit Konten Web** yang bisa langsung diklik untuk melompat ke halaman pengaturan terkait secara instan.

### 4. Mengenai "Real-Time / Live Front-End Editing"
- **Analisis**: Di ekosistem WordPress, fitur edit teks langsung di tampilan depan umumnya hadir dalam dua bentuk:
  1. *WordPress Theme Customizer* (`wp.customize`): Memiliki panel kontrol di kiri dan iframe preview di kanan. Baik untuk warna dan teks sederhana, namun kaku untuk tabel nisbah dan repeater.
  2. *Visual Page Builders* (Elementor / Divi / Gutenberg FSE): Memungkinkan klik langsung pada teks di halaman, namun membutuhkan plugin berat yang membebani kecepatan server, menghasilkan ribuan baris HTML div berlebih (bloated DOM), dan seringkali berbayar untuk fitur lengkap.
- **Keputusan Arsitektur Wakalumi**: Mempertahankan pendekatan **High-Performance Clean CMS (Tailwind + Native Options)**. Keunggulannya adalah kecepatan loading super kilat (hanya 138 kB CSS), kode bersih, zero plugin cost, dan desain aman tidak rusak. Kemudahan edit diakomodasi melalui **Admin Bar Quick Links** di bagian atas layar frontend.

---

---

## 🔒 7. KEAMANAN AKSES ADMIN & PINTASAN QUICK-EDIT

### Mengapa Menu Pintasan (`⚡ Edit Konten Web`) 100% Aman Tanpa Risiko?
1. **Pengecekan Izin Server-Side (`current_user_can('manage_options')`)**:
   - Kode PHP memeriksa apakah pengguna yang membuka halaman memiliki sesi aktif dengan role Administrator.
   - Jika pengunjung umum / publik / belum login membuka web, fungsi langsung berhenti (*early exit*). Menu pintasan ini **sama sekali tidak di-render atau dikirim ke browser / HTML**.
2. **Proteksi URL Inti WordPress**:
   - Seluruh tautan mengarah ke `/wp-admin/admin.php?page=...`.
   - Jika seseorang dengan keahlian teknis mencoba menebak atau mengetik langsung URL tersebut di browser, inti WordPress (*core security*) otomatis menolak dengan error `HTTP 403 Forbidden / Sorry, you are not allowed to access this page` kecuali mereka memiliki *authentication cookie* SHA-256 yang valid.
   - Tidak ada *backdoor* atau endpoint API publik baru yang dibuka.

---

## 📱 8. KENDALI DINAMIS LOGO, GAMBAR & TAMPILAN MOBILE/DESKTOP

1. **Struktur Baris Bawah Footer (Bottom Bar)**:
   - **Logo Regulasi (OJK & LPS)**: Tampil tepat di atas pernyataan resmi, dilengkapi opsi tampil/sembunyi di Desktop dan Mobile.
   - **Pernyataan Regulasi Resmi**: Menguraikan legalitas perbankan syariah di bawah pengawasan OJK dan penjaminan LPS.
   - **Teks Hak Cipta (Copyright)**: Diposisikan di **baris paling bawah** sesuai regulasi perbankan Indonesia (`&copy; [Tahun] Bank Syariah Wakalumi...`).
2. **Hero Regulatory Badge**:
   - Lencana melayang "Terdaftar & Diawasi: OJK & LPS" di pojok kanan bawah hero slider kini memiliki kendali terpisah untuk layar Desktop dan Ponsel (Mobile).
   - Di mobile, ukuran dan posisi badge disesuaikan secara proporsional agar tidak menutupi tombol Call-to-Action.
3. **Bagian "Tentang Kami" (Section 4 Beranda)**:
   - Teks, judul, dan foto dapat dikelola dari WP-Admin (tab *Layanan & Media*).
   - Dilengkapi opsi tata letak mobile:
     - `Foto di Atas Teks` (Standar mobile menarik)
     - `Foto di Bawah Teks` (Memprioritaskan teks narasi)
     - `Sembunyikan Foto di Ponsel` (Hanya tampil di Desktop; hemat data & loading kilat).

---

## 🧭 9. PANDUAN PENGEMBANGAN HALAMAN SELANJUTNYA

Ketika hendak membuat halaman baru (misal: *Tentang Kami*, *Legalitas*, *Susunan Pengurus*, *Jaringan Kantor*, *Simulasi*):

1. **Status Modul "Tim Kami"**:
   - Disembunyikan sementara dari sidebar admin agar tidak membingungkan pengguna saat fokus pada beranda.
   - Otomatis diaktifkan kembali saat memulai pengembangan halaman *Susunan Pengurus*.
2. **Buat File Template PHP**:
   - Beri header: `Template Name: Nama Halaman` (misal di `page-tentang-kami.php`).
   - Sertakan `get_header()` dan `get_footer()`.
3. **Gunakan Tailwind CSS & Class Standar**:
   - Gunakan `container-wide` atau `container-narrow`.
   - Gunakan warna brand: `primary-600`, `teal-500`, `slate-900`, dll.
   - Dukung Dark Mode: Selalu pasangkan `bg-white dark:bg-dark` dan `text-slate-900 dark:text-white`.
4. **Kompilasi Aset**:
   - Setiap ada class Tailwind baru atau perubahan JS, jalankan:
     ```bash
     npm run build
     ```
5. **Hubungkan Menu di WP-Admin**:
   - Masuk ke **Tampilan (Appearance)** &rarr; **Menu**.
   - Tambahkan halaman ke dalam menu navigasi utama (*Primary Menu*).

---

---

## 🚀 11. SISTEM MEDIA UPLOAD & REPEATER REGULASI (PEROMBAKAN ADMIN)

1. **Sistem Unggah Gambar Universal (100% Gratis via `wp.media`)**:
   - Seluruh input gambar di panel **Pengaturan Website** (`options_video_thumb`, `options_about_image_url`, `options_quick_card_{i}_image`, `options_lps_badge_logo`) kini terhubung langsung dengan **WordPress Media Library**.
   - Setiap bidang gambar memiliki tombol **"Unggah Gambar"**, pratinjau thumbnail langsung (*preview*), input URL cadangan, dan tombol **"✕ Hapus Gambar"**.
   - Skrip ditangani oleh `assets/js/admin-media.js` dan hanya dimuat di halaman admin terkait via `wakalumi_admin_media_scripts()` demi menjaga performa kilat frontend.

2. **4 Kartu Layanan Cepat (Section 2 Beranda)**:
   - Dilengkapi menu pilihan **Ikon Preset** (chart, kartu ATM, kalkulator, laporan, tabungan, perisai, transfer, dll.).
   - Dilengkapi slot **Unggah Gambar Kustom** jika tim desain menyiapkan grafis bitmap/vektor khusus (otomatis diprioritaskan di atas ikon preset).

3. **Slider Hero: Unggah Gambar Responsive (Desktop & Mobile Terpisah)**:
   - **Latar Desktop (Komputer / Laptop)**:
     - **Resolusi**: `1920 × 800 px` (atau `1920 × 1080 px`, rasio landscape ~16:7 / 16:9).
     - **Format**: `WebP` atau `JPG` terkompresi.
     - **Ukuran File**: Rekomendasi `< 300 KB` untuk kecepatan loading maksimal.
   - **Latar Mobile (Smartphone)**:
     - **Resolusi**: `750 × 1000 px` (rasio potret 3:4) atau `800 × 800 px` (persegi 1:1).
     - **Format**: `WebP` atau `JPG`.
     - **Ukuran File**: Rekomendasi `< 150 KB` agar hemat kuota ponsel.
     - *Fallback*: Jika versi mobile dikosongkan, browser otomatis memuat versi desktop.
   - **Teknologi**: Menggunakan elemen HTML5 `<picture>` dengan `<source media="(max-width: 768px)">` sehingga browser hanya mengunduh 1 aset gambar yang sesuai ukuran layar pengguna.
   - **Antarmuka Admin**: Dilengkapi tombol **"Unggah Gambar Desktop"** & **"Unggah Gambar Mobile"** via Media Library langsung di halaman edit Slide.

4. **Logo Regulasi Repeater Fleksibel**:
   - Baik di **Hero Slider** maupun di **Footer**, logo regulator tidak lagi berupa gambar statis.
   - Admin dapat menambah atau menghapus logo pengawasan sebanyak mungkin (OJK, LPS, Bank Indonesia, Keuangan Syariah, ASBISINDO, dsb.) secara dinamis melalui tombol **"+ Tambah Logo"**.
   - Setiap baris logo memiliki pratinjau, tombol unggah, nama label resmi, dan tombol hapus baris.

5. **Ruang Khusus Penjaminan LPS Rp2 Miliar**:
   - Sesuai regulasi perbankan Indonesia, disediakan banner khusus **Penjaminan LPS** di dekat area Hero Section dengan kontrol penuh di admin: aktifkan/nonaktifkan, unggah logo LPS resmi, teks pernyataan penjaminan, dan visibilitas layar desktop/mobile.

6. **Redesign Kartu Realisasi Nisbah Bagi Hasil**:
   - **Harmonisasi Warna Teal Bank**: Tabungan menggunakan emerald-teal segar (`from-emerald-500 to-teal-500`), sedangkan Deposito menggunakan ocean/cyan-teal elegan (`from-teal-600 to-cyan-500`). Keduanya selaras dalam keluarga warna tema utama Bank tanpa warna biru/ungu yang kontras.
   - **Porsi Nisbah 1 Garis Bersambung (*Single Segmented Ratio Bar*)**: Porsi Nasabah (kiri) dan porsi Bank (kanan) disajikan dalam satu garis rasio terintegrasi 100%, lengkap dengan persentase di kedua sisi dan transisi animasi pengisian lembut.
   - **Efek Hover Halus**: Transisi `duration-300 ease-out` dengan pencahayaan latar (*glow overlay*) modern yang proporsional di Dark Mode dan Light Mode.
   - **Tipografi Dramatis**: Angka Equivalent Rate tampil besar dengan gradien elegan dan pemisahan simbol persen.

7. **Sidebar Admin Bersih & Profesional (Bebas Emoticon)**:
   - Emoticon dihilangkan dari label teks sidebar agar tampilan formal dan elegan sesuai standar perbankan, mengandalkan Dashicons bawaan WordPress:
     - `Pengaturan Website`
       - `Umum & WhatsApp`
       - `Kontak & Maps`
       - `Beranda: Media & Kartu`
       - `Beranda: Kinerja Nisbah`
       - `Footer & Jam Kerja`
     - `Slider Hero`
     - `Katalog Produk`
     - `Berita & Artikel`
     - `Susunan Pengurus` *(Disiapkan)*

---

## ⏭️ 12. STATUS SAAT INI
- **Beranda & Sistem Admin**: 100% Selesai, modern, fleksibel, terintegrasi WordPress Media Library tanpa biaya tambahan, responsive desktop/mobile.
- **Tugas Selanjutnya**: Memulai pengerjaan halaman-halaman profil dinamis (*Tentang Kami*, *Legalitas*, *Susunan Pengurus*, *Jaringan Kantor*) dan sinkronisasi struktur navbar.





