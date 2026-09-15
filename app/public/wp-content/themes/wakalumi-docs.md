# 📘 WAKALUMI BPRS - KNOWLEDGE BASE & DOKUMENTASI ARSITEKTUR

Dokumen ini berfungsi sebagai **Landasan Konteks (Context Memory)** utama, cetak biru teknis (*technical blueprint*), dan panduan operasional proyek website **PT BPRS Wakalumi**. Tujuannya adalah agar seluruh pengembang (baik AI maupun Software Engineer) memiliki pemahaman yang presisi mengenai arsitektur sistem, infrastruktur server, struktur direktori, logika data, standar desain visual, hingga panduan deployment.

---

## 🏛️ 1. VISI & PRINSIP ARSITEKTUR UTAMA

Proyek ini adalah pembuatan ulang (*revamp*) antarmuka dan sistem manajemen konten website **PT BPRS Wakalumi**.

> [!IMPORTANT]
> **PENEGASAN TEKNOLOGI: 100% PURE WORDPRESS CMS (BUKAN LARAVEL)**
> Proyek ini adalah tema kustom **WordPress murni (Native PHP & WordPress Core APIs)** yang berjalan di atas Local by Flywheel. Website ini **sama sekali TIDAK menggunakan framework Laravel** (tidak ada file `artisan`, Eloquent ORM, maupun Blade templating).
> *Catatan Editor*: Jika muncul pesan popup `"Not a Laravel project. The artisan file was not found in the workspace"`, pesan tersebut berasal dari ekstensi VS Code lokal pengguna (misal *Laravel Extra Intellisense* / *Laravel Artisan*) yang aktif mendeteksi file `.php`. Ekstensi tersebut telah dinonaktifkan untuk workspace ini melalui konfigurasi `.vscode/settings.json`.

### Prinsip Utama Pengembangan:
1. **100% Zero-Cost WordPress Stack**:
   - Tidak menggunakan plugin berbayar, lisensi tahunan (No ACF Pro, No Elementor Pro, No WP Rocket berbayar).
   - Seluruh kustomisasi menggunakan fitur native WordPress (Settings API, Custom Post Types, Native Media Library API, REST/AJAX).
2. **High-Performance & Anti-Bloat**:
   - Menghindari *visual page builder* berat yang menghasilkan ribuan DOM div berlebih (*bloated DOM*).
   - Menggunakan **Vite 5** dan **Tailwind CSS v3 JIT** yang hanya mengompilasi *utility classes* yang benar-benar dipakai, menghasilkan berkas CSS produksi yang super ringan (~157 kB tak terkompresi / ~20 kB gzip).
3. **Headless & Modern SPA-Feel**:
   - Ditenagai **Swup.js** untuk transisi perpindahan halaman mulus tanpa *hard reload* browser.
   - Didukung **AOS (Animate On Scroll)** untuk pengalaman visual modern setara perbankan nasional.
4. **Desain Perbankan Syariah Modern**:
   - Mengombinasikan transparansi modern (*Glassmorphism*), kedalaman (*Stacking Parallax Layering*), dan palet warna korporat yang kokoh (*Ocean Teal* & *Bright Teal*).

---

## 🖥️ 2. INFRASTRUKTUR SERVER & LINGKUNGAN HOSTING

### A. Lingkungan Pengembangan Lokal (Local Development)
- **Runtime Tool**: [Local by Flywheel](https://localwp.com/) (Local WP).
- **Web Server**: Nginx (atau Apache 2.4).
- **PHP Engine**: PHP 8.2.x (mendukung typed properties, arrow functions, dan match expressions).
- **Database Engine**: MySQL 8.0.x / MariaDB 10.4+.
- **Protokol**: HTTPS Lokal dengan sertifikat SSL bawaan Local WP (*One-click Trust Certificate*).
- **Domain Lokal**: `http://wakalumibprscoid.local/` atau `https://wakalumibprscoid.local/`.

### B. Arsitektur Basis Data (Database Schema)
Seluruh data website dikelola secara efisien menggunakan tabel relasional standar WordPress **tanpa membuat tabel custom** yang rentan korupsi saat migrasi:
1. **`wp_options`**:
   - Menyimpan seluruh pengaturan global website (`Pengaturan Website`): informasi kontak kantor, peta Google Maps, saklar announcement bar, repeater logo regulasi, jam operasional, dan parameter kartu layanan cepat.
   - Semua data berulang (*repeater*) disimpan dalam format array PHP terserialisasi (*serialized array*) yang aman dan otomatis dikonversi oleh fungsi `get_option()` dan `update_option()`.
2. **`wp_posts` & `wp_postmeta`**:
   - Menyimpan data konten dinamis melalui **Custom Post Types (CPT)**:
     - `hero_slide`: Banner promosi beranda, judul, subtitle, tombol CTA, serta gambar responsive desktop & mobile.
     - `produk`: Katalog tabungan, deposito, dan pembiayaan syariah.
     - `berita`: Publikasi berita perbankan, artikel literasi keuangan, dan edukasi syariah.
     - `anggota_tim`: Struktur dewan komisaris, dewan pengawas syariah, dan direksi.
3. **`wp_terms` & `wp_term_relationships`**:
   - Mengelola taksonomi dan kategori berita serta kategori produk.

### C. Penyimpanan Berkas & Media Storage
- Berkas gambar dan dokumen diunggah melalui **WordPress Native Media Library (`wp.media`)** dan tersimpan di:
  ```
  app/public/wp-content/uploads/YYYY/MM/
  ```
- Setiap berkas yang diunggah otomatis dibuatkan variasi resolusi (thumbnail, medium, large, full) oleh WordPress, sehingga dapat dimanfaatkan untuk performa tampilan mobile dan desktop yang efisien.

### D. Strategi Deployment & Opsi Hosting
| Kebutuhan | Lingkungan Rekomendasi | Metode & Catatan Teknis |
| :--- | :--- | :--- |
| **Demo Cepat / Review Klien** | **LocalWP Live Link** atau **InstaWP / Ngrok** | Menembus localhost ke URL publik HTTPS sementara tanpa perlu export database. |
| **Hosting Produksi Standar** | **cPanel / DirectAdmin / Shared Hosting** | Web server LiteSpeed/Apache + MySQL. Cukup zip folder tema dan export database `.sql` via phpMyAdmin / WP-CLI. |
| **Hosting Produksi Enterprise** | **Cloud VPS (DigitalOcean, Linode, AWS EC2)** | Ubuntu Server + Nginx + PHP 8.2-FPM + MariaDB + Redis Object Cache. Menjamin responsifitas tinggi saat volume pengunjung melonjak. |
| **Analisis Khusus: Vercel / Netlify** | *Hanya jika Static Export* | Vercel dirancang untuk Node.js/Edge/Next.js dan **tidak memiliki runtime PHP + MySQL native**. Untuk demo di Vercel, website harus di-export menjadi file HTML statis menggunakan plugin *Simply Static* atau di-convert menjadi arsitektur Decoupled/Headless. |

### E. Manajemen Source Control (Git Workflow)
- **Root Git**: Berada pada direktori `c:\Users\arifr\Local Sites\wakalumibprscoid` (atau pada level tema `app/public/wp-content/themes/`).
- **File & Folder yang Diabaikan (`.gitignore`)**:
  - `node_modules/` (dependensi build JS).
  - `wp-config.php` (kredensial database lokal).
  - `wp-content/uploads/` (file media besar sebaiknya di-backup terpisah atau via rsync).
  - Berkas log dan cache sistem (`.log`, `.vite`).
- **Folder Wajib Di-commit**:
  - `app/public/wp-content/themes/` (seluruh kode PHP tema, konfigurasi `vite.config.js`, `tailwind.config.js`, `package.json`, source code assets `assets/src/`, dan hasil build `assets/build/`).

---

## 📂 3. PETA DETAIL STRUKTUR FILE & DIREKTORI PROYEK

Berikut adalah pohon direktori utama tema (`wp-content/themes/`):

```
app/public/wp-content/themes/
├── assets/
│   ├── build/                     # Berkas hasil kompilasi produksi Vite
│   │   ├── css/
│   │   │   └── app.css            # Bundle CSS final Tailwind JIT (~146 kB)
│   │   └── js/
│   │       └── app.js             # Bundle JS ES6 (Swup, AOS, Nav, DarkMode)
│   ├── img/                       # Aset grafis statis tema
│   │   ├── logo-new-1.png         # Logo resmi BPRS Wakalumi (Transparan HD)
│   │   ├── logo-new.png           # Alternatif logo horizontal
│   │   ├── wm-wkl.png             # Watermark emblem fisik background besar
│   │   ├── about-photo.jpg        # Foto kantor / gedung default
│   │   └── video-thumb.jpg        # Foto thumbnail video profil default
│   ├── js/
│   │   └── admin-media.js         # Bridge interaksi WordPress wp.media uploader
│   └── src/                       # Berkas sumber pra-kompilasi
│       ├── css/
│       │   └── app.css            # Directives @tailwind base, components, utilities
│       └── js/
│           └── app.js             # Vanilla ES6 router, Alpine/Swup, Theme logic
├── inc/                           # Modul logika backend WordPress (Zero-Cost CMS)
│   ├── acf-fields.php             # Definisi field fallback tanpa ACF Pro
│   ├── admin-options.php          # 5 Panel Pengaturan Terpusat (Settings API + Repeater)
│   ├── cpt.php                    # Pendaftaran Custom Post Types (Slide, Produk, Berita, Tim)
│   └── theme-setup.php            # Asset enqueue, admin bar, clean-up menu, SVG support
├── footer.php                     # Global footer (Kontak, Maps, Jam Kerja, Logo Regulasi, LPS)
├── front-page.php                 # Template Beranda utama (8 Section Terintegrasi Admin)
├── functions.php                  # Bootstrapper tema, autoloader inc/, vite asset resolver
├── header.php                     # HTML head, Preloader air, Navbar dinamis, Emblem z-[1]
├── index.php                      # Fallback template standar WordPress
├── package.json                   # Konfigurasi dependensi Node.js (Vite, Tailwind, PostCSS)
├── page.php                       # Template halaman standar WordPress
├── tailwind.config.js             # Konfigurasi tema Tailwind (Palet warna, Fonts, Animasi)
├── vite.config.js                 # Konfigurasi bundler Vite (Entry point, Output paths)
└── wakalumi-docs.md               # Master technical documentation & context memory
```

### Rincian Tanggung Jawab Berkas Utama:
1. **`functions.php`**:
   - Menginisialisasi konstanta tema (`WAKALUMI_VERSION`, `WAKALUMI_DIR`, `WAKALUMI_URI`).
   - Memuat berkas pendukung dari direktori `inc/` (`theme-setup.php`, `cpt.php`, `admin-options.php`, `acf-fields.php`).
   - Mendaftarkan mekanisme pemuatan aset cerdas: mendeteksi mode Vite dev server atau memuat bundle `assets/build/` pada mode produksi.
2. **`header.php`**:
   - Berisi metadata HTML5, OpenGraph tags, viewport, dan deklarasi `wp_head()`.
   - Menjalankan efek **Preloader Air Mengisi Logo** saat awal halaman dimuat.
   - Menempatkan **Fixed Physical Watermark Emblem (`wm-wkl.png`)** pada layer `z-[1]`.
   - Mengelola Navbar transparan adaptif dengan dropdown produk, saklar tema (*Dark/Light Mode*), dan drawer menu mobile.
3. **`front-page.php`**:
   - Menjadi tulang punggung beranda dengan 8 section modular:
     1. *Hero Slider*: Slider banner responsive, tombol navigasi, regulatory badge, dan LPS Rp2 Miliar badge.
     2. *Layanan Cepat*: 4 Kartu Glassmorphism dengan ikon preset atau unggah gambar grafis kustom.
     3. *Produk Unggulan*: Menampilkan produk pilihan dari CPT `produk`.
     4. *Tentang Kami*: Profil singkat bank dengan foto gedung yang dapat diatur tata letaknya di mobile.
     5. *Kinerja Nisbah Bagi Hasil*: Kartu realisasi nisbah interaktif dengan watermark logo animasi dan single-segmented ratio bar.
     6. *Video Profil*: Pemutar video YouTube dalam pop-up modal interaktif tanpa membebani loading awal halaman.
     7. *Instagram Feed*: Grid horizontal postingan media sosial resmi.
     8. *CTA WhatsApp*: Penutup konversi cepat ke layanan pelanggan resmi.
4. **`footer.php`**:
   - Menampilkan alamat kantor pusat, nomor kontak resmi, dan email.
   - Peta navigasi situs (sitemap links) dan jam kerja operasional (weekday vs weekend).
   - Repeater logo pengawasan regulasi (OJK, LPS, Bank Indonesia, dsb.).
   - Baris copyright paling bawah sesuai standar perbankan nasional.
5. **`inc/admin-options.php`**:
   - Membangun menu terpusat **Pengaturan Website** dengan 5 sub-halaman:
     - `Umum & WhatsApp`: Announcement banner & nomor WhatsApp resmi.
     - `Kontak & Maps`: Alamat, nomor telepon, email, & URL embed Google Maps.
     - `Beranda: Media & Kartu`: 4 Kartu Layanan Cepat, Video Profil, Tentang Kami, & Repeater Instagram Feed.
     - `Beranda: Kinerja Nisbah`: Periode pembaruan nisbah & tabel dinamis bagi hasil.
     - `Footer & Jam Kerja`: Jam operasional, teks copyright, dan repeater logo regulasi footer.
6. **`assets/js/admin-media.js`**:
   - Menghubungkan tombol "Unggah Gambar" di antarmuka admin dengan pop-up modal `wp.media` bawaan WordPress.
   - Mendukung pratinjau langsung (*live thumbnail preview*), pemilihan gambar dari perpustakaan media yang sudah ada, serta tombol hapus instan.

---

## 🎨 4. GAYA DESAIN, PALET WARNA & SISTEM LAYER FISIK

### A. Palet Warna Resmi (Brand Colors)
- **Primary Ocean Teal (`#088395`)**: Warna korporat utama melambangkan stabilitas, ketenangan, dan kepercayaan finansial. Digunakan pada headline, tombol utama, dan aksen dominan.
- **Secondary Bright Teal (`#24B1B1`)**: Warna sekunder untuk gradasi modern, hover state, dan garis aksen.
- **Accent Mint Glow (`#5DF8D8`)**: Aksen kontras tinggi untuk lencana (*badge*), indikator status sukses, dan efek pencahayaan pada Dark Mode.
- **Dark Surface (`#0B1120`)**: Biru gelap pekat (*deep navy*) untuk latar belakang utama mode malam, menciptakan nuansa premium dan nyaman di mata (*eye-friendly*).
- **Light Surface (`#F8FAFC`)**: Latar belakang abu-abu sangat muda (*slate-50*) untuk kontras bersih di mode terang.

### B. Konsep Stacking Layer Fisik (Z-Index Hierarchy & Window Cutout)
Website menggunakan sistem tumpukan fisik z-index yang terstruktur untuk menciptakan ilusi kedalaman tanpa memberatkan GPU:
```
┌─────────────────────────────────────────────────────────────┐
│ [Z-50] Modal Video Popup, Alert Preloader                   │
├─────────────────────────────────────────────────────────────┤
│ [Z-20] Header Nav & Mobile Drawer Menu                      │
├─────────────────────────────────────────────────────────────┤
│ [Z-10] Body Sections (-mt-24 overlap Hero)                  │
│        ├── Solid Sections: Layanan Cepat, Produk, Tentang   │
│        └── Window Cutout (Transparent): Nisbah & IG Feed    │
├─────────────────────────────────────────────────────────────┤
│ [Z-2]  Sticky Hero Slider (Tetap di atas saat awal scroll)  │
├─────────────────────────────────────────────────────────────┤
│ [Z-1]  Fixed Background Emblem Watermark (wm-wkl.png)       │
└─────────────────────────────────────────────────────────────┘
```

- **Mekanisme Window Cutout**:
  - Logo watermark raksasa (`wm-wkl.png`) ditempatkan secara tetap (`fixed inset-0 pointer-events-none z-[1]`).
  - Section dengan background padat (*solid/glass*) menutupi watermark ini secara fisik.
  - Section **Kinerja Nisbah** dan **Instagram Feed** disengaja memiliki latar belakang transparan (`bg-transparent relative z-10`), sehingga berfungsi seperti jendela kaca tembus pandang yang memperlihatkan lambang emblem di belakangnya.

---

## 💫 5. INTERAKSI KHUSUS: KARTU REALISASI NISBAH

Bagian Realisasi Nisbah Bagi Hasil di Beranda memiliki desain dan animasi mutakhir yang menggabungkan presisi perbankan syariah dan keindahan visual:

### A. Animasi Watermark Logo Interaktif (Hover Physics)
Setiap kartu nisbah dilengkapi lambang logo Wakalumi monokrom di latar belakang kartu dengan perilaku fisika berikut:
1. **Posisi Awal (Default State)**:
   - **Posisi**: Berada di sisi kiri kartu (`absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[25%]`).
   - **Geometri Pemotongan**: Karena kartu memiliki `overflow-hidden` dan wadah logo digeser `-25%` ke arah kiri, maka **tepat 25% (1/4) sisi kiri logo terpotong** di luar kartu, dan **75% (3/4) bagian kanan logo tampil jelas** di dalam kartu.
   - **Ukuran**: Skala proporsional 3/4 tinggi kartu (`w-48 h-48 sm:w-52 sm:h-52 md:w-56 md:h-56`).
   - **Opasitas**: Sangat halus dan tidak mengganggu keterbacaan teks (`opacity-[0.035]` di Light Mode, `opacity-[0.045]` di Dark Mode).
2. **Posisi Saat Kursor Masuk (Hover State)**:
   - **Posisi**: Meluncur mulus ke sisi kanan kartu (`group-hover:left-full group-hover:-translate-x-1/2`).
   - **Geometri Pemotongan**: Titik pusat logo berpindah persis di batas tepi kanan kartu (`left: 100%` dengan `-translate-x: 50%`). Akibatnya, **separuh kanan logo terpotong** di luar kartu, dan **separuh kiri (1/2) logo tampak jelas** di dalam kartu.
   - **Ukuran**: Membesar secara dramatis memenuhi seluruh tinggi kartu (`group-hover:scale-[1.35]`).
   - **Opasitas**: Meningkat lembut menjadi `group-hover:opacity-[0.07]` (Light) dan `group-hover:opacity-[0.08]` (Dark).
   - **Transisi**: `transition-all duration-700 ease-out` memberikan efek meluncur anggun dan elastis khas produk perbankan berkelas tinggi.

### B. Batang Rasio Bersambung (Single Segmented Ratio Bar)
- Menggantikan tampilan 2 baris terpisah yang membingungkan.
- Porsi Nasabah (kiri) dan porsi Bank (kanan) kini disajikan dalam **satu garis rasio terintegrasi 100%**.
- Sisi nasabah dan bank memiliki warna gradien yang kontras namun serasi, dilengkapi teks label persentase di kedua sisi dan transisi lebar animasi saat dimuat.

### C. Harmonisasi Warna Teal Bank
- **Produk Tabungan**: Gradasi Emerald-Teal segar (`from-emerald-400 via-primary-500 to-teal-400`).
- **Produk Deposito**: Gradasi Ocean-Cyan Teal elegan (`from-teal-500 via-cyan-600 to-teal-400`).
- Kedua tipe produk kini berada dalam payung keluarga warna biru-hijau toska resmi Wakalumi, menghilangkan disparitas warna ungu/biru tua yang sebelumnya terlalu kontras.

---

## 🛠️ 6. SISTEM CMS 100% GRATIS (NATIVE WORDPRESS)

Arsitektur konten didesain agar staf admin bank dapat memperbarui seluruh elemen website tanpa menyentuh satu baris kode pun:

### A. Pengaturan Beranda Dinamis
1. **Slider Hero Multi-Device**:
   - Gambar latar dapat diunggah terpisah untuk versi **Desktop** (`1920×800 px`) dan versi **Mobile** (`750×1000 px` potret / `800×800 px` kotak).
   - Menggunakan tag HTML5 `<picture>` sehingga browser hanya mengunduh 1 berkas yang relevan, menghemat kuota pengguna smartphone.
2. **Repeater Logo Regulasi (OJK, LPS, BI, dll)**:
   - Di Hero Slider dan Footer, logo pengawas tidak lagi terkunci statis.
   - Admin dapat menambah baris logo baru melalui tombol **"+ Tambah Logo"**, mengunggah gambar logo transparan, dan mengisi label nama regulasi.
   - **Perilaku Tampilan**: Lencana logo regulasi di Hero Slider tetap menetap (*stay*) saat halaman di-scroll (tidak lagi memudar/fade-out buatan via JS), dan baru tertutup secara natural ketika section konten di bawahnya meluncur naik menabrak hero (*stacking parallax*).
3. **Lencana Penjaminan LPS Rp2 Miliar**:
   - Panel khusus di admin untuk mengaktifkan lencana resmi penjaminan simpanan nasabah oleh LPS hingga Rp2 Miliar per nasabah per bank.
4. **4 Kartu Layanan Cepat**:
   - Admin dapat memilih ikon dari 10 variasi ikon preset (chart, ATM card, kalkulator, laporan, koin tabungan, gedung deposito, berkas pembiayaan, transfer, perisai, pertumbuhan investasi) ATAU mengunggah gambar ilustrasi kustom sendiri.

### B. Keamanan & Kebersihan Panel Admin
1. **Pembersihan Sidebar**:
   - Menghilangkan menu bawaan "Pos (Posts)" dan "Komentar (Comments)" agar tidak memicu kebingungan dengan CPT "Berita".
   - Menghilangkan emoticon informal pada label sidebar admin, menggantikannya dengan Dashicons resmi WordPress.
2. **Pengecekan Otorisasi Kuat**:
   - Seluruh endpoint simpan dan halaman konfigurasi dilindungi fungsi `current_user_can('manage_options')` dan WordPress Nonces (`check_admin_referer`), mencegah ancaman CSRF dan akses tanpa hak.

---

## 📋 7. PANDUAN BUILD & WORKFLOW PENGEMBANGAN

### Perintah Utama (NPM Scripts):
Masuk ke direktori tema: `c:\Users\arifr\Local Sites\wakalumibprscoid\app\public\wp-content\themes`
```bash
# Menjalankan Vite Development Server (Live Hot-Reload saat mengubah CSS/JS):
npm run dev

# Mengompilasi Aset Produksi Final (Wajib dijalankan sebelum deploy / setelah edit template PHP):
npm run build
```

### Panduan Penambahan Halaman Baru:
1. Buat berkas PHP di dalam tema: `page-{slug}.php` (contoh: `page-tentang-kami.php`, `page-susunan-pengurus.php`).
2. Sertakan header template dan struktur standar:
   ```php
   <?php
   /**
    * Template Name: Tentang Kami
    */
   get_header();
   ?>
   <main id="swup" class="transition-fade min-h-screen pt-28 pb-16">
       <!-- Konten Halaman menggunakan Tailwind CSS -->
   </main>
   <?php
   get_footer();
   ```
3. Tambahkan halaman melalui dashboard WordPress: **Laman (Pages) -> Tambah Baru**, pilih template yang sesuai, lalu publikasikan.
4. Hubungkan ke menu navigasi melalui **Tampilan (Appearance) -> Menu**.
5. Jalankan `npm run build` untuk memastikan seluruh *utility class* Tailwind baru terkompilasi ke dalam `assets/build/css/app.css`.

---

## 🎯 8. ROADMAP & STATUS PENGEMBANGAN HALAMAN PROFIL
1. **Pembangunan Modul Halaman Profil Bank**:
   - ✅ **Halaman Tentang Kami (`/profil/tentang-kami`)**: Selesai 100%! Dilengkapi 6 section lengkap (Header Banner, Sekilas Sejarah, 4 Statistik Kunci, Visi & Misi Dinamis, Budaya Kerja A-M-A-N-A-H, Makna Logo, Legalitas & CTA WhatsApp), terintegrasi panel admin terpusat dan auto-ensuring page hierarchy.
   - ⏳ **Halaman Legalitas Perusahaan (`/profil/legalitas`)**: *(Tahap Selanjutnya)* Menampilkan izin usaha BI/OJK, keanggotaan penjaminan LPS, surat keputusan Kemenkumham, dan fatwa/izin DSN-MUI.
   - ⏳ **Halaman Susunan Pengurus (`/profil/susunan-pengurus`)**: Mengaktifkan kembali CPT `anggota_tim` untuk profil Dewan Komisaris, Dewan Pengawas Syariah (DPS), dan Direksi.
   - ⏳ **Halaman Jaringan Kantor (`/profil/jaringan-kantor`)**: Lokasi kantor pusat dan kantor kas operasional dengan integrasi peta Google Maps dinamis.
2. **Penyelarasan Menu Navbar**:
   - Seluruh tautan navbar di `header.php` telah dirancang secara modular mengarah ke hierarki `/profil/...` tanpa bertabrakan satu sama lain.

---

## 🏛️ 9. ARSITEKTUR MODUL PROFIL: TENTANG KAMI (`/profil/tentang-kami`)

Modul ini telah dibangun secara utuh dengan standar perbankan syariah modern tanpa plugin berbayar:

### A. Komponen Frontend (`page-tentang-kami.php`)
- **Template Name**: `Tentang Kami` (terpasang pada halaman child ber-slug `tentang-kami` dengan parent `profil`).
- **URL Publik**: `http://wakalumibprscoid.local/profil/tentang-kami/`
- **6 Section Kaya Konten**:
  1. **Header Banner & Breadcrumbs**: Navigasi hierarkis Beranda &rarr; Profil &rarr; Tentang Kami, dilengkapi badge kicker dan judul dramatis.
  2. **Sekilas Perusahaan & Sejarah**: Narasi 2 paragraf beraksen perbankan syariah, foto gedung kantor representatif dengan frame floating experience badge, dan 4 kotak indikator statistik (30+ Tahun, 10.000+ Nasabah, 100% Syariah, Rp2 Miliar LPS).
  3. **Visi & Misi Strategis**: Kartu Visi berdesain Glassmorphism gelap megah dengan latar emblem watermark, serta grid kartu Misi bernomor modern (`01`, `02`, `03`, dll.).
  4. **Nilai-Nilai Budaya Perusahaan (Core Values)**: 6 kartu interaktif Budaya Kerja **A-M-A-N-A-H** (Akuntabel, Melayani, Amanah, Nyaman, Adil, Handal) dengan hover teal-glow.
  5. **Makna & Filosofi Logo**: Visualisasi logo resmi pada panel gelap kontras dengan breakdown 3 pilar filosofi (Gelombang Air Berkah, Warna Ocean/Bright Teal, Aksen Mint Glow).
  6. **Ajakan Bertindak (Call to Action / CTA)**: Kartu konversi modern dan megah dengan tombol konsultasi WhatsApp serta tautan katalog produk.
  7. **Footer 4-Kolom Seragam**: Seluruh halaman (termasuk Tentang Kami dan Beranda) memiliki footer seragam yang kaya informasi dengan fitur Jadwal Sholat dan Google Maps.
- **Dukungan Dark Mode Penuh**: Seluruh teks, latar belakang, dan batas kartu memiliki pasangan styling `dark:...` yang kontras dan nyaman di mata.
- **Integrasi Swup.js**: Berjalan mulus di dalam container `#swup` tanpa *hard refresh* browser.

### B. Panel Admin Pengelola Konten (`inc/admin-about.php`)
- **Akses WP-Admin**: `Pengaturan Website -> Profil: Tentang Kami` (URL: `/wp-admin/admin.php?page=wakalumi-about`).
- **Pintasan Admin Bar**: Saat admin login melihat frontend, bilah atas memiliki tombol cepat `⚡ Edit Konten Web -> 🏛️ Profil: Tentang Kami & Visi Misi`.
- **Fitur Pengelolaan**:
  - Formulir Banner & Narasi Sejarah.
  - Upload Foto Kantor via **WordPress Media Library (`wp.media`)** dengan live preview dan tombol hapus.
  - Pengaturan 4 Nilai Statistik Kunci.
  - Form Visi & **Repeater Tabel Misi Dinamis** (bisa menambah/menghapus butir misi via JavaScript tanpa reload).
  - **Repeater Tabel Nilai Budaya** (bisa mengedit huruf akronim, nama nilai, dan uraian perilaku).
  - Pengaturan Makna Logo (unggah logo & uraian 3 pilar filosofi).
  - Pengaturan Seksi CTA (Judul, Teks, Tombol WhatsApp, Tombol Produk).
  - Saklar Tampil/Sembunyi (*Section Visibility Checkboxes*) untuk fleksibilitas kontrol publikasi.
- **Skema Opsi Database**:
  - `options_about_page_badge`, `options_about_page_title`, `options_about_page_subtitle`
  - `options_about_page_sec_badge`, `options_about_page_sec_title`, `options_about_page_narrative_1`, `options_about_page_narrative_2`, `options_about_page_image`
  - `options_about_page_stat_{1-4}_val`, `options_about_page_stat_{1-4}_lbl`
  - `options_about_page_vision_badge`, `options_about_page_vision_title`, `options_about_page_vision_desc`
  - `options_about_page_missions` (array serialized)
  - `options_about_page_values` (array serialized `[acronym, title, desc]`)
  - `options_about_page_logo_img`, `options_about_page_logo_desc`, `options_about_page_logo_p{1-3}_*`
  - `options_about_page_cta_badge`, `options_about_page_cta_title`, `options_about_page_cta_desc`, `options_about_page_cta_btn{1,2}_*`
  - `options_about_page_show_{stats,vision,values,logo,cta}`

### C. Otomasi Pendaftaran Halaman (`inc/theme-setup.php`)
- Melalui fungsi `wakalumi_ensure_profile_pages()`, tema secara otomatis mengecek keberadaan halaman parent `profil` dan child `tentang-kami` di basis data. Jika belum ada, sistem langsung mendaftarkannya dengan status `publish` dan menugaskan template `page-tentang-kami.php`.
- Hal ini menjamin bahwa tautan navigasi di `header.php` (`/profil/tentang-kami`) langsung aktif seketika tanpa memerlukan konfigurasi manual yang membingungkan.

---

## 🕌 10. MODUL JADWAL WAKTU SHOLAT & PENANGGALAN HIJRIYAH (`inc/prayer-times.php`)

Modul ini diintegrasikan langsung pada footer global untuk seluruh halaman website:
- **100% Gratis Tanpa Biaya**: Menggunakan Aladhan API (Kemenag standard, calculation method 11) tanpa memerlukan API key berbayar.
- **High Performance Caching**: Menggunakan WordPress Transient API (`get_transient` & `set_transient`) yang menyimpan data selama 12 jam, sehingga kueri jaringan hanya terjadi 1-2 kali per hari dan waktu respon server tetap 0 milidetik.
- **Informasi yang Ditampilkan**:
  - 5 Waktu Sholat: Subuh, Dzuhur, Ashar, Maghrib, Isya.
  - Tanggal Hijriyah resmi (format bulan Indonesia: Muharram, Safar, Rabiul Awal, Rabiul Akhir, dst.).
  - Indikator otomatis waktu sholat berikutnya (*Next Prayer Highlight*) dengan badge animasi.
  - Fallback astronomis offline presisi wilayah Tangerang Selatan & Jabodetabek (WIB).
- **Pengaturan di WP-Admin**: Dikelola melalui menu **Pengaturan Website &rarr; Footer & Jam Kerja** (saklar on/off dan nama kota acuan).

---

## 🧭 11. KEPUTUSAN ARSITEKTUR & RESOLUSI NAVIGASI MENU PRODUK

> [!NOTE]
> **Resolusi Ambiguitas Navigasi Menu "Produk":**
> 1. **Perilaku Awal (Konsep Landing Page)**: Menu "Produk" di navbar sebelumnya diarahkan menggunakan *anchor link* (`#section-produk`) ke seksi produk di Beranda (`front-page.php`). Akibatnya, saat diklik, halaman akan menggulir ke seksi produk di Beranda, dan seksi di bawahnya (Tentang Kami ringkas, Realisasi Nisbah Bagi Hasil, Berita) tetap terlihat.
> 2. **Keputusan Arsitektur Final**: Telah disepakati bahwa menu "Produk" akan dialihkan ke **halaman katalog tersendiri (`/produk/`)** yang berdiri sendiri (*standalone catalog page*), sehingga saat pengunjung membuka halaman Produk, antarmuka murni hanya menampilkan katalog produk tabungan, deposito, dan pembiayaan tanpa menampilkan seksi-seksi beranda lainnya.

---

## 🏛️ 12. KORPUS DATA RESMI PERUSAHAAN (BERDASARKAN PROFIL PERUSAHAAN.MD)

Semua konten profil dan legalitas wajib mengacu pada korpus data autentik ini:
- **Nama Resmi Perusahaan**: PT. Bank Perekonomian Rakyat Syariah Wakalumi
- **Yayasan Pendiri**: Yayasan Wakalumi (Wakaf Karyawan dan Alumni Muslim Citibank)
- **Motto Perusahaan**: *"Membangun kualitas hidup berkah sesuai Syariah"*
- **Jati Diri Perusahaan**: Lembaga Keuangan Syariah yang memiliki fokus pada jasa keuangan dan pemberdayaan ekonomi umat dan masyarakat sesuai syariah.
- **Keyakinan Inti (Core Beliefs)**: BPRS Wakalumi berkomitmen untuk selalu melakukan **ISHLAH**, yakni kami terus melakukan perbaikan.
- **Visi**: 
  - *"Menjadi BPR Syariah yang sehat, besar dan bermanfaat bagi umat"*
  - Filosofi: *"Menjadikan BPRS Wakalumi ibarat sebuah pohon yang memiliki akar dan batang yang kuat, daun yang lebat dan buah yang manis"*
- **5 Butir Misi Strategis**:
  1. Memberdayakan ekonomi umat dengan fokus usaha mikro, kecil dan menengah
  2. Memberikan layanan prima dan amanah bagi nasabah
  3. Menjalankan fungsi inklusi dan literasi ekonomi syariah bagi masyarakat
  4. Memberikan manfaat optimal bagi para stakeholder
  5. Membangun sistem dan tata kerja yang unggul dengan sumber daya insani yang professional, kompeten, handal dan menjunjung tinggi ukhuwah islamiyah
- **Budaya Kerja Perusahaan — SAPA (Skill, Action, Pray, Attitude)**:
  - **Skill**: Selalu mengasah kompetensi agar dapat menciptakan peluang
  - **Action**: Melakukan tindakan profesional yang penuh tanggungjawab
  - **Pray**: Menghadirkan Allah dalam setiap aktifitas kerja, ibadah dan doa yang penuh nilai kebaikan
  - **Attitude**: Memiliki sikap dan prilaku positif yang memberi warna kebaikan
- **Perizinan & Registrasi Fiskal**:
  - NIB (Nomor Induk Berusaha): `129.200.032.0036`
  - NPWP (Nomor Pokok Wajib Pajak): `1.484.259.5-411.000`
  - NPWZ (Nomor Pokok Wajib Zakat): `B1 000 005 8 411 000`
  - Kantor Pusat: Komp. Ciputat Mutiara Center Blok B1, Jl. Dewi Sartika Ciputat - Tangerang. Telp/Fax: 021-7401667 / 021-749084, 021-7442788
- **Landasan Hukum Perbankan**:
  - SK Menteri Keuangan RI Nomor `Kep-016/KM.17/1995` Tanggal 16 Januari 1995 (Izin Usaha Operasi BPR Syariah)
  - SK Bank Indonesia Nomor `13/5/KEP.Dir/Pbs/2011` Tanggal 13 Juli 2011
  - Terdaftar dan Diawasi oleh **Otoritas Jasa Keuangan (OJK)**
  - Peserta Penjaminan **Lembaga Penjamin Simpanan (LPS)** (simpanan dijamin s.d Rp 2 Miliar)
  - Diawasi oleh **Dewan Pengawas Syariah (DPS)**
- **Riwayat Akta Notaris & Pengesahan**:
  - Akta No. 59 tgl 7 Oktober 1989 Notaris Ny. Siti Pertiwi Henny Shidki, SH (SK Menkeh RI No. C2-155.HT.01.01.TH.90 tgl 13 Januari 1990)
  - Akta No. 78 tgl 9 Juni 1994 Notaris B.R.A.Y Mahyastoeti Notonagoro, SH
  - Akta No. 13 tgl 16 Maret 2011 jo SK Menkumham No. AHU-25293.A.H.01.02 Tahun 2011 tgl 20 Mei 2011
  - Akta PKR No. 03 tgl 21 Juni 2024 jo SK Kemenkumham No. AHU-0041765.AH.01.02.Tahun 2024
  - Akta PKR No. 02 tgl 20 November 2024 jo SK Kemenkumham No. AHU-01.03-0214138 & AHU.AHA.01.09-0279901
  - Akta PKR No. 02 tgl 05 Mei 2025 tentang Anggaran Dasar BPRS Wakalumi

---

## 📜 13. ARSITEKTUR MODUL HALAMAN LEGALITAS PERUSAHAAN (`/profil/legalitas`)

Halaman Legalitas Perusahaan dibangun dengan standar tata kelola keterbukaan informasi perbankan syariah:
- **Berkas Template**: `page-legalitas.php` (`Template Name: Legalitas Perusahaan`).
- **Pendaftaran Otomatis**: Melalui `inc/theme-setup.php` (`profil/legalitas`).
- **Modul Admin**: `inc/admin-legalitas.php` (di bawah menu `Pengaturan Website -> Profil: Legalitas`).
- **Footer**: Menggunakan footer seragam yang sama dengan Beranda dan Tentang Kami.

---

## 🛡️ 14. ARSITEKTUR PROTEKSI ROUTING TEMPLATE PERUNTUKAN (ANTI-KOSONG)

Untuk mencegah bug visual di mana pengunjung mengklik Beranda atau menu halaman lain namun hanya melihat header lalu langsung footer (karena WordPress salah memuat template kosong `page.php` atau `index.php`), tema telah dilengkapi **Sistem Proteksi Routing Tiga Lapis**:

1. **Lapis 1: Filter `template_include` Prioritas 99 (`inc/theme-setup.php`)**:
   - Fungsi `wakalumi_enforce_template_routing()` mencegat seleksi template WordPress di level inti:
     - Jika `is_front_page()` atau slug adalah `home`/`beranda` &rarr; Dikunci memuat `front-page.php`.
     - Jika slug `tentang-kami` &rarr; Dikunci memuat `page-tentang-kami.php`.
     - Jika slug `legalitas` &rarr; Dikunci memuat `page-legalitas.php`.
2. **Lapis 2: Fallback Proteksi di `page.php`**:
   - Jika WordPress tetap memanggil `page.php` untuk slug Beranda, Tentang Kami, atau Legalitas, `page.php` tidak akan merender konten kosong, melainkan langsung menyertakan (*include*) berkas template yang seharusnya dan keluar (*return*).
3. **Lapis 3: Fallback Proteksi di `index.php`**:
   - Jika halaman utama diarahkan ke berkas fallback `index.php`, sistem otomatis mengalihkan untuk merender `front-page.php`.
4. **Sinkronisasi `page_on_front` Otomatis**:
   - Fungsi `wakalumi_ensure_front_page()` secara proaktif mengunci opsi `show_on_front = page` dan menyetel metadata `_wp_page_template = front-page.php`.

---

## 📝 15. CATATAN PERBAIKAN & PENYEMPURNAAN ANIMASI (FUTURE REFACTORING & BACKLOG)

> [!NOTE]
> **Catatan Pengarah Desain (Design Feedback)**:
> Menerapkan animasi dinamis penuh (sorot kursor spotlight, kemiringan 3D tilt, serta watermark logo meluncur kiri-ke-kanan) ke **seluruh kartu sekaligus** berpotensi terasa berlebihan (*over-animated* / "lebay") dan dapat mengurangi ketenangan visual (*subtlety*) yang menjadi ciri khas lembaga keuangan perbankan syariah terpercaya.

### Rencana Penyesuaian ke Depan (*Next Polish Iteration*):
1. **Penerapan Selektif (*Selective Animation*)**:
   - Batasi animasi dinamis kursor / geser hanya pada kartu-kartu sorotan utama (*hero cards*), seperti **Kartu Statistik Kunci** dan **Kartu Produk Nisbah**.
   - Kartu berbasis informasi padat dan dokumen hukum (seperti 3 Kartu Registrasi NIB/NPWP/NPWZ, SK Menkeu/BI, dan 6 Linimasa Akta Notaris) dikembalikan ke gaya **statis elegan** dengan mikro-interaksi minimalis (misal hanya border glow halus atau perubahan elevasi ringan tanpa watermark meluncur).
2. **Penghalusan Watermark (*In-Place Subtle Pulse/Fade*)**:
   - Sebagai alternatif animasi geser kiri-ke-kanan yang melintasi isi konten, watermark logo line-art (`untitled4.png`) cukup diposisikan menetap di sudut kartu dengan transisi skala lembut (`scale-105`) dan kenaikan opacity tipis saat di-hover (`opacity-05` &rarr; `opacity-08`).
3. **Penyederhanaan Efek 3D Tilt**:
   - Menonaktifkan efek kemiringan 3D tilt pada kartu-kartu berukuran kecil atau kartu dalam bentuk grid padat agar scrolling tetap nyaman dan tidak membuat mata lelah.

---

## 🌟 16. STANDAR GLOBAL: SINGLE UNIFIED BACKGROUND EMBLEM WATERMARK

Sebagai standar desain visual resmi tema **BPRS Wakalumi**, website menggunakan arsitektur **Satu Watermark Tunggal (Single Unified Background Emblem)** yang berada di layer latar belakang viewport dan secara alami berinteraksi dengan section-section halaman:

### A. Prinsip Kerja & Filosofi Desain
1. **Hanya Ada 1 Watermark di Seluruh Halaman**:
   - Tidak ada duplikasi elemen emblem di dalam masing-masing section.
   - Tepat **1 elemen `#sticky-watermark-emblem`** disematkan di level global layout ([header.php](file:///c:/Users/arifr/Local%20Sites/wakalumibprscoid/app/public/wp-content/themes/header.php) dan [footer.php](file:///c:/Users/arifr/Local%20Sites/wakalumibprscoid/app/public/wp-content/themes/footer.php)) menggunakan arsitektur **CSS Grid Layering**:
     - Wrapper container: `.grid.grid-cols-1.grid-rows-1.relative` di dalam `#swup`.
     - Layer 0: `#sticky-watermark-track` (`col-start-1 row-start-1 z-[1]`) memegang `#sticky-watermark-emblem` dengan class `sticky top-1/2 -translate-y-1/2 h-fit`.
     - Layer 1: `<main>` (`col-start-1 row-start-1 relative z-10`) memuat seluruh section konten.
2. **Scrollable & Terikat Alur Dokumen (Murni CSS `position: sticky`)**:
   - Karena berada di dalam wrapper CSS Grid yang membentang sepanjang `<main>`, emblem **terikat pada scroll window secara alami**:
     - Menempel anggun di tengah layar (`top: 50%`) selama pengguna membaca konten halaman.
     - **Saat mencapai area Footer**: Container `<main>` berakhir, sehingga emblem **ikut tergulung naik dan menghilang secara alami** bersama konten (tidak membeku/menyangkut menutupi footer).
3. **Interaksi Alami Melalui Layering CSS**:
   - **Section Solid (Tertutup)**: Section dengan background pekat (`relative z-10 bg-white dark:bg-dark`, `bg-slate-50 dark:bg-dark-surface`, atau `bg-slate-900`) berada di layer atas `z-10` dan menutupi watermark secara penuh.
   - **Section Transparan (Terbuka / Mengintip)**: Section yang diberi class `relative z-10 bg-transparent` memiliki latar tembus pandang, sehingga watermark tunggal di belakang akan terlihat melayang di balik kartu-kartu konten.
4. **100% Ringan & GPU-Accelerated**:
   - Murni mengandalkan stacking context dan layout engine CSS native browser tanpa JavaScript scroll listener, performa 60fps tanpa lag.

---

### B. Panduan Praktis untuk Halaman Selanjutnya (Developer Guide)

> [!IMPORTANT]
> **ATURAN PENGEMBANGAN HALAMAN BARU**:
> 1. **JANGAN PERNAH** menyisipkan markup HTML `<div id="fixed-watermark-emblem">` atau track sticky emblem lokal di dalam berkas template atau section baru.
> 2. **Jika ingin suatu section MEMPERLIHATKAN watermark**:
>    Cukup beri class `bg-transparent` pada elemen `<section>`:
>    ```html
>    <section id="section-contoh" class="relative z-10 py-20 bg-transparent">
>        <div class="container-wide">
>            <!-- Kartu konten dengan background solid/elevated agar teks terbaca -->
>        </div>
>    </section>
>    ```
> 3. **Jika ingin suatu section MENUTUPI watermark**:
>    Cukup beri background solid pada elemen `<section>`:
>    ```html
>    <section id="section-padat" class="relative z-10 py-20 bg-white dark:bg-dark border-b border-slate-100 dark:border-slate-800">
>        <div class="container-wide">
>            <!-- Konten -->
>        </div>
>    </section>
>    ```

---

### C. Pemetaan Halaman Saat Ini
| Halaman | Bagian yang Menampilkan Watermark (`bg-transparent`) | Bagian yang Menutupi Watermark (Solid) |
|---|---|---|
| **Beranda** (`front-page.php`) | Section Realisasi Nisbah & Section Media Sosial Instagram | Hero Slider, Layanan Cepat, Produk, Simulasi, Video Profil, Berita, Footer |
| **Tentang Kami** (`page-tentang-kami.php`) | Section 2: Visi & Misi Strategis | Header Banner, Section 1 (Sekilas), SAPA, Makna Logo, CTA, Footer |
| **Legalitas** (`page-legalitas.php`) | Section 2: Landasan Izin Usaha Perbankan | Header Banner, Section 1 (NIB/NPWP/NPWZ), Akta Notaris, CTA, Footer |
| **Susunan Pengurus** (`page-susunan-pengurus.php`) | Section Executive Spotlight Parallax Stage | Header Banner, Bagan Organisasi, CTA, Footer |

