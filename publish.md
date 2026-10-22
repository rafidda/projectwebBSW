itg

# 🚀 Panduan Implementasi Produksi (Hosting) & Operasional WP-Admin

**Project:** Website Resmi PT BPRS Wakalumi (Bank Syariah Wakalumi)
**Environment Asal (Local):** `http://wakalumibprscoid.local`
**Target Produksi:** Hosting Resmi (contoh: `https://bprswakalumi.co.id` atau `https://wakalumibprs.co.id`)

---

## 📌 Daftar Isi

1. [Arsitektur &amp; Infrastruktur Sistem](#1-arsitektur--infrastruktur-sistem)
2. [Daftar URL &amp; Konfigurasi yang Perlu Diubah Saat Pindah ke Hosting](#2-daftar-url--konfigurasi-yang-perlu-diubah-saat-pindah-ke-hosting)
3. [Tahapan Step-by-Step Migrasi dari LocalWP ke Hosting](#3-tahapan-step-by-step-migrasi-dari-localwp-ke-hosting)
4. [Proteksi Otomatis yang Sudah Ditanamkan (Bug-Fix &amp; Auto-Domain Guard)](#4-proteksi-otomatis-yang-sudah-ditanamkan-bug-fix--auto-domain-guard)
5. [Panduan Operasional Lengkap WP-Admin (Tata Cara Edit Konten)](#5-panduan-operasional-lengkap-wp-admin-tata-cara-edit-konten)
6. [Checklist Pemeriksaan Akhir Setelah Publish](#6-checklist-pemeriksaan-akhir-setelah-publish)

---

## 1. Arsitektur & Infrastruktur Sistem

Project website Bank Syariah Wakalumi dibangun menggunakan arsitektur **Custom Hybrid WordPress CMS** yang menggabungkan kemudahan pengelolaan konten melalui panel WP-Admin dengan performa frontend modern setara aplikasi web masa kini.

### A. Stack Infrastruktur & Bahasa Pemrograman

| Komponen                 | Teknologi / Versi                  | Keterangan & Fungsi                                                                                                                                |
| :----------------------- | :--------------------------------- | :------------------------------------------------------------------------------------------------------------------------------------------------- |
| **Core CMS**       | WordPress `6.4+`                 | Sistem manajemen konten utama dan manajemen hak akses user/admin.                                                                                  |
| **Bahasa Backend** | PHP `8.1` / `8.2+`             | Eksekusi template tema, pemrosesan custom admin panel (`inc/admin-*.php`), dan AJAX PDF Streamer.                                                |
| **Database**       | MySQL `8.0+` / MariaDB `10.5+` | Menyimpan seluruh halaman, berita, pengaturan `wp_options`, dan metadata produk.                                                                 |
| **Web Server**     | Nginx / Apache / LiteSpeed         | Mendukung `mod_rewrite` untuk struktur URL ramah SEO (*Pretty Permalinks*).                                                                    |
| **CSS Framework**  | Tailwind CSS `v4.1` + PostCSS    | Styling komponen modern, *Dual-Tone Cards*, *Glassmorphism*, dan dukungan penuh *Dark Mode*.                                                 |
| **Asset Bundler**  | Vite `v5.4`                      | Mengompilasi source CSS (`assets/src/css/main.css`) & JS (`assets/src/js/app.js`) ke `assets/build/`.                                        |
| **SPA Navigation** | Swup.js `v4.8`                   | Transisi perpindahan antar-halaman secara instan tanpa reload penuh (*Single Page Application feel*).                                            |
| **Animasi & UI**   | AOS (`v2.3`) + Custom Vanilla JS | Animasi scroll halus, kalkulator finansial syariah interaktif, dan waktu sholat real-time.                                                         |
| **PDF Engine**     | PDF.js + Custom PHP Streamer       | Menampilkan pratinjau dokumen PDF (Brosur & Laporan OJK) langsung di dalam popup modal tanpa dibajak oleh aplikasi download manager (seperti IDM). |

### B. Struktur Penyimpanan Data di Database

1. **Custom Admin Modules (`wp_options`)**:
   - Hampir seluruh konten halaman statis dan katalog (Tentang Kami, Legalitas, Pengurus, Jaringan Kantor, Tabungan, Deposito, Pembiayaan, Brosur, Laporan Publikasi, Pengaduan, Pengumuman, Lelang, Kegiatan, Galeri, Tim Kami, Karir, serta Literasi & Inklusi) disimpan secara terstruktur di tabel `wp_options` dengan prefix `options_*` dan `wakalumi_*`.
   - **Keunggulan**: Sangat cepat diakses, tidak membebani query database, dan setiap modul memiliki data *fallback* (default) otomatis jika belum diisi.
2. **Custom Post Types (`wp_posts` & `wp_postmeta`)**:
   - Digunakan untuk konten berbasis artikel dan entitas dinamis seperti **Berita & Artikel (`berita`)**, **Hero Slider (`hero_slide`)**, **Produk (`produk`)**, dan **Anggota Tim (`anggota_tim`)**.

### C. Lokasi Direktori Tema

Perhatikan bahwa struktur tema ini berada langsung di dalam folder `wp-content/themes/` (atau dapat dimasukkan ke dalam subfolder tema `wp-content/themes/wakalumi/`):

- File konfigurasi & fungsi utama: `functions.php`
- Modul-modul halaman admin: `inc/admin-*.php`
- Template halaman frontend: `front-page.php`, `header.php`, `footer.php`, `page-*.php`, `archive-berita.php`, `single-berita.php`
- Hasil kompilasi produksi (siap upload): `assets/build/css/app.css` & `assets/build/js/app.js`

---

## 2. Daftar URL & Konfigurasi yang Perlu Diubah Saat Pindah ke Hosting

Karena website ini dikembangkan di environment LocalWP dengan domain `http://wakalumibprscoid.local`, saat dipindahkan ke hosting produksi (misalnya `https://bprswakalumi.co.id`), berikut adalah **4 titik konfigurasi** yang wajib disesuaikan:

### 1. Kredensial Database di `wp-config.php`

Pada aplikasi LocalWP, konfigurasi default menggunakan user `root` dan password `root`. Saat di hosting (cPanel/VPS), ubah bagian berikut di file `wp-config.php`:

```php
define( 'DB_NAME', 'nama_db_hosting_anda' );
define( 'DB_USER', 'user_db_hosting_anda' );
define( 'DB_PASSWORD', 'password_db_hosting_anda' );
define( 'DB_HOST', 'localhost' ); // Umumnya tetap 'localhost' di cPanel

// Nonaktifkan mode debug di server produksi:
define( 'WP_DEBUG', false );
define( 'WP_DEBUG_LOG', false );
define( 'WP_DEBUG_DISPLAY', false );
```

### 2. URL Utama Website (`siteurl` & `home`) di Tabel `wp_options`

Di dalam database tabel `wp_options`, terdapat 2 baris utama yang menentukan alamat website:

- `option_name = 'siteurl'` ➡️ Ubah dari `http://wakalumibprscoid.local` menjadi `https://bprswakalumi.co.id` (tanpa garis miring `/` di paling belakang).
- `option_name = 'home'` ➡️ Ubah dari `http://wakalumibprscoid.local` menjadi `https://bprswakalumi.co.id` (tanpa garis miring `/` di paling belakang).

### 3. URL Gambar & Dokumen PDF di Dalam Database (*Serialized Data*)

Saat mengunggah foto pengurus, gambar berita, brosur PDF, atau laporan publikasi di LocalWP, WordPress menyimpan URL lengkap seperti `http://wakalumibprscoid.local/wp-content/uploads/2026/...` di dalam tabel `wp_options` dan `wp_postmeta`.

- **PERINGATAN PENTING**: Jangan melakukan *Find & Replace* manual menggunakan Notepad/VS Code langsung pada file `.sql`! Mengapa? Karena WordPress menyimpan array pengaturan dalam format **PHP Serialized** (contoh: `s:58:"http://wakalumibprscoid.local/wp-content/uploads/foto.jpg";`). Jika panjang karakter domain berubah tanpa memperbarui angka `s:58`, array tersebut bisa ter-reset.
- **Solusi Aman**:
  1. **Otomatis (Sudah Kami Tanamkan)**: Kami telah menambahkan fitur **Auto-Domain Normalizer** di `functions.php` yang secara otomatis mengubah URL `wakalumibprscoid.local` menjadi domain hosting aktif saat halaman dimuat tanpa merusak data *serialized*!
  2. **Pembersihan Permanen Database**: Setelah berhasil login ke WP-Admin di hosting, Anda cukup menginstal plugin gratis **Better Search Replace** (atau menjalankan perintah WP-CLI `wp search-replace 'http://wakalumibprscoid.local' 'https://bprswakalumi.co.id' --all-tables`), yang akan memperbarui seluruh URL di database dengan aman.

### 4. Konfigurasi `.htaccess` & Permalink

Setelah pindah ke hosting, struktur URL halaman (seperti `/profil/tentang-kami/` atau `/produk/tabungan-syariah/`) memerlukan file `.htaccess` yang sesuai dengan server hosting. Cara memperbaruinya sangat mudah: cukup buka **WP-Admin ➡️ Settings ➡️ Permalinks**, lalu klik tombol **Save Changes** satu kali tanpa mengubah apa pun.

---

## 3. Tahapan Step-by-Step Migrasi dari LocalWP ke Hosting

Ikuti langkah-langkah berurutan berikut untuk meng-online-kan website ke hosting produksi:

### Tahap 1: Pastikan Build Asset Terbaru & Ekspor dari LocalWP

1. Pastikan file CSS/JS sudah ter-build versi produksi terbaru di komputer lokal:
   ```bash
   cd "app/public/wp-content/themes"
   npm run build
   ```

   *(Catatan: Di server hosting nanti Anda **tidak perlu** menjalankan `npm` atau meng-upload folder `node_modules`, karena hasil jadi di `assets/build/` sudah siap pakai).*
2. Buka aplikasi **LocalWP**:
   - Klik kanan pada site **wakalumibprscoid** ➡️ pilih **Export** (atau buka tab **Database ➡️ Open AdminerEvo ➡️ Export** untuk mengunduh file database `.sql`).
   - Jika memilih menyalin manual, kompres isi folder `app/public/` menjadi `website-wakalumi.zip` (**kecuali** folder `wp-content/themes/node_modules` agar ukuran file zip ringan dan cepat di-upload).

### Tahap 2: Siapkan Database di Hosting (cPanel / Plesk / VPS)

1. Login ke cPanel hosting Anda (`https://namadomain.co.id/cpanel`).
2. Buka menu **MySQL® Database Wizard**:
   - Buat database baru (misal: `bprswaka_wp`).
   - Buat user database baru beserta password yang kuat.
   - Centang **ALL PRIVILEGES** untuk menghubungkan user tersebut ke database.
3. Buka menu **phpMyAdmin** di cPanel:
   - Pilih database yang baru dibuat di sidebar kiri.
   - Klik tab **Import** ➡️ pilih file `.sql` hasil ekspor dari LocalWP ➡️ klik **Import / Go**.
4. Masih di **phpMyAdmin**, buka tabel **`wp_options`**:
   - Ubah nilai `siteurl` dan `home` menjadi `https://bprswakalumi.co.id` (sesuaikan dengan domain resmi Anda).

### Tahap 3: Upload File Website ke Hosting

1. Buka menu **File Manager** di cPanel ➡️ masuk ke direktori **`public_html`**.
2. Upload file `website-wakalumi.zip` lalu **Extract** di dalam `public_html`.
3. Klik kanan pada file **`wp-config.php`** ➡️ pilih **Edit**:
   - Masukkan `DB_NAME`, `DB_USER`, dan `DB_PASSWORD` sesuai yang dibuat pada Tahap 2.
   - Simpan perubahan.

### Tahap 4: Sinkronisasi Domain & Permalinks di WP-Admin Hosting

1. Buka browser dan login ke **`https://bprswakalumi.co.id/wp-admin`**.
2. Buka menu **Settings (Pengaturan) ➡️ Permalinks**:
   - Pastikan terpilih **Post name** (`/%postname%/`), lalu klik **Save Changes** agar file `.htaccess` di hosting ter-generate secara otomatis.
3. *(Opsional namun Direkomendasikan)* Untuk memperbarui seluruh URL gambar lama di database secara permanen:
   - Buka **Plugins ➡️ Add New**, cari **Better Search Replace**, lalu Install & Activate.
   - Buka **Tools ➡️ Better Search Replace**:
     - **Search for**: `http://wakalumibprscoid.local`
     - **Replace with**: `https://bprswakalumi.co.id`
     - Pilih semua tabel (`Ctrl + A`), hilangkan centang *Run as dry run*, lalu klik **Run Search/Replace**.
   - Setelah selesai, plugin Better Search Replace dapat dihapus kembali.

---

## 4. Proteksi Otomatis yang Sudah Ditanamkan (Bug-Fix & Auto-Domain Guard)

Untuk memastikan website langsung berjalan mulus begitu di-upload ke hosting, kami telah menanamkan beberapa pengaman otomatis di dalam kode tema:

1. **Auto-Domain Normalizer (`functions.php`)**:
   - Fungsi `wakalumi_normalize_domain_deep()` secara otomatis mendeteksi apabila website sudah tidak berada di `wakalumibprscoid.local`. Seluruh URL gambar, foto pengurus, logo, dan dokumen PDF yang tersimpan di `wp_options` maupun konten berita akan otomatis dikonversi mengikuti domain aktif (`home_url()`) secara *real-time*.
2. **Domain-Agnostic PDF Streamer (`functions.php`)**:
   - Fitur pratinjau PDF (Brosur & Laporan Publikasi) mengekstrak path relatif `/wp-content/uploads/...` langsung ke sistem file server lokal hosting tanpa bergantung pada nama domain lama, sehingga pratinjau PDF dijamin tetap berfungsi 100% setelah migrasi.
3. **Auto-Redirect Halaman Induk (`functions.php`)**:
   - Mengarahkan pengunjung yang mengakses URL induk kosong (`/profil/`, `/produk/`, `/informasi/`) secara otomatis ke sub-halaman utama masing-masing (`/profil/tentang-kami/`, `/produk/tabungan-syariah/`, `/informasi/laporan-publikasi/`).
4. **Standarisasi Kontras Dark Mode & Hero Section**:
   - Seluruh halaman internal telah menggunakan sistem warna teks adaptif (`dark:text-slate-200` / `dark:text-white`) serta *Hero Surface* yang menyatu sempurna dengan *Navbar*.

---

## 5. Panduan Operasional Lengkap WP-Admin (Tata Cara Edit Konten)

Panduan ini ditujukan bagi **Tim Admin / Humas / IT Bank Syariah Wakalumi** untuk mengelola dan memperbarui konten website sehari-hari setelah dipublikasikan tanpa perlu menyentuh kode pemrograman.

### 🔐 Cara Login ke Dashboard Admin

1. Akses alamat: **`https://bprswakalumi.co.id/wp-admin`**
2. Masukkan **Username / Email** dan **Password** Administrator.
3. Setelah masuk, di sidebar sebelah kiri terdapat **2 kelompok menu utama** yang akan sering Anda gunakan:
   - **Menu `Pengaturan Wakalumi` (Ikon Gedung Bank)**: Pusat kendali untuk mengedit seluruh halaman statis, produk, tabel nisbah, brosur, laporan publikasi OJK, pengumuman, lelang, galeri, karir, hingga literasi.
   - **Menu `Berita & Artikel` (`Posts/Berita`) & `Hero Slider`**: Untuk mempublikasikan artikel berita kegiatan terbaru dan mengelola slide gambar banner utama di Beranda.

---

### A. Mengelola Pengaturan Global, Kontak, Nisbah & Footer

Di sidebar kiri WP-Admin, arahkan kursor ke **`Pengaturan Wakalumi`**. Terdapat 5 sub-menu pengaturan global di bagian paling atas:

#### 1. Umum & Pengumuman (`Pengaturan Wakalumi ➡️ Umum & Pengumuman`)

- **Top Bar & Running Text**: Mengubah teks pengumuman berjalan di bagian atas website, label tombol darurat/info, dan status aktif/nonaktifnya.
- **Identitas & Statistik Beranda**: Mengubah angka statistik pencapaian bank di beranda (misal: Tahun Berdiri, Jumlah Nasabah, Rasio Keuangan).

#### 2. Kontak & Maps (`Pengaturan Wakalumi ➡️ Kontak & Maps`)

- **Nomor WhatsApp Utama & Call Center**: Mengubah nomor WhatsApp Customer Service (format `62815...`), nomor telepon kantor, dan alamat email resmi. Perubahan di sini otomatis memperbarui tombol WhatsApp mengambang (*Floating WA*) dan kontak di seluruh halaman.
- **Alamat Kantor Pusat & Embed Google Maps**: Mengubah alamat teks dan tautan iframe Google Maps.

#### 3. Layanan & Media (`Pengaturan Wakalumi ➡️ Layanan & Media`)

- **4 Kartu Layanan Cepat Beranda**: Mengubah judul, deskripsi, link tujuan, pilihan ikon, atau mengunggah gambar kustom untuk 4 kartu akses cepat di bawah banner utama beranda.
- **Video Profil & Ringkasan Tentang Kami di Beranda**: Mengubah tautan video YouTube, gambar sampul (*thumbnail*), dan teks perkenalan singkat di halaman depan.
- **Logo Regulasi Hero & Badge Jaminan LPS**: Menambah/mengubah logo lembaga regulasi (OJK, LPS, dll.) serta teks informasi batas maksimal penjaminan simpanan LPS (Rp 2 Miliar).

#### 4. Informasi Nisbah (`Pengaturan Wakalumi ➡️ Informasi Nisbah`) — *Single Source of Truth*

- **Sangat Penting (Update Bulanan)**: Menu ini adalah **pusat data tunggal** untuk tabel bagi hasil (Nisbah) Tabungan dan Deposito.
- Anda cukup mengubah **Periode Bulan** (misal: `Oktober 2026`) serta persentase **Nisbah Nasabah : Bank** dan **Indikasi Equivalent Rate (%)** di halaman ini.
- Setelah klik **Simpan**, data akan **otomatis ter-update secara serentak** di:
  1. Widget Tabel Nisbah di Halaman Beranda,
  2. Tabel Nisbah & Kartu Tenor di Halaman Deposito Syariah, serta
  3. Rumus Kalkulator Simulasi Deposito!

#### 5. Footer & Jam Kerja (`Pengaturan Wakalumi ➡️ Footer & Jam Kerja`)

- Mengubah deskripsi singkat bank di bagian bawah website (Footer), jadwal jam operasional layanan kas/kantor, tautan media sosial (Instagram, Facebook, YouTube, TikTok, LinkedIn), serta deretan logo mitra/regulator di bagian bawah halaman.

---

### B. Mengelola Banner Utama Beranda (Hero Slider)

Untuk mengganti gambar spanduk promosi/informasi besar di bagian paling atas Halaman Beranda:

1. Lihat menu **`Hero Slider`** di sidebar kiri WP-Admin (atau melalui **`Pengaturan Wakalumi ➡️ Hero & Slider`**).
2. Untuk menambah slide baru: Klik **Tambah Slide Baru (Add New)**:
   - Isi **Judul Slide** dan **Sub-judul / Deskripsi Singkat**.
   - Unggah gambar banner pada kolom **Featured Image / Gambar Slide** (Rekomendasi ukuran: **1920 x 1080 px**, format JPG/WebP, ukuran file di bawah `500 KB` agar cepat dimuat).
   - Isi teks dan URL tombol CTA (misal: *"Buka Tabungan Sekarang"* mengarah ke `/produk/tabungan-syariah/`).
   - Atur nomor urut pada kotak **Attributes ➡️ Order** (angka lebih kecil tampil lebih dulu), lalu klik **Publish / Update**.

---

### C. Mengelola Halaman Profil Perusahaan

Seluruh sub-halaman pada menu **Profil** di navigasi atas dikelola melalui sub-menu di bawah **`Pengaturan Wakalumi`**:

1. **Profil: Tentang Kami (`Pengaturan Wakalumi ➡️ Profil: Tentang Kami`)**:
   - Mengubah teks Sejarah Pendirian, Visi & Misi, Nilai-Nilai Budaya Perusahaan (*Core Values*), serta tahapan Jejak Langkah (*Milestone* tahun ke tahun).
2. **Profil: Legalitas (`Pengaturan Wakalumi ➡️ Profil: Legalitas`)**:
   - Mengubah daftar Akta Pendirian/Perubahan, SK Kemenkumham, Izin Usaha OJK/BI, NPWP, serta kepesertaan LPS dan asosiasi perbankan (Perbarindo/Asbisindo).
3. **Profil: Pengurus (`Pengaturan Wakalumi ➡️ Profil: Pengurus`)**:
   - Mengelola daftar **Dewan Pengawas Syariah (DPS)**, **Dewan Komisaris**, dan **Direksi**.
   - Anda dapat mengunggah foto resmi masing-masing pengurus, mengubah jabatan, riwayat karir, latar belakang pendidikan, sertifikasi profesi, status izin OJK, hingga mengganti gambar **Bagan Struktur Organisasi**.
4. **Profil: Jaringan Kantor (`Pengaturan Wakalumi ➡️ Profil: Kantor`)**:
   - Menambah atau mengubah data **Kantor Pusat**, **Kantor Kas**, dan titik layanan.
   - Setiap kantor dilengkapi pengaturan alamat lengkap, nomor telepon, jam buka, foto gedung kantor, dan tautan titik koordinat Google Maps.

---

### D. Mengelola Halaman Produk & Katalog Brosur

Seluruh halaman di bawah menu **Produk** dikelola melalui sub-menu berikut:

1. **Produk: Tabungan & Deposito (`Pengaturan Wakalumi ➡️ Produk: Simpanan`)**:
   - **Tab Tabungan Syariah**: Mengelola daftar produk tabungan (Tabungan Tawakal, Pendidikan, Haji & Umroh, Ukhuwah, dll.), mengubah syarat pembukaan rekening, keunggulan produk, warna tema kartu, tabel perbandingan, FAQ, dan preset Kalkulator Rencana Menabung.
   - **Tab Deposito Syariah**: Mengelola kartu pilihan tenor (1, 3, 6, 12 Bulan), gambar kartu tenor, keunggulan Deposito Mudharabah, persyaratan dokumen perorangan vs badan usaha, dan pengaturan kalkulator bagi hasil.
2. **Produk: Pembiayaan (`Pengaturan Wakalumi ➡️ Produk: Pembiayaan`)**:
   - Mengelola katalog 8 produk pembiayaan syariah (Pembiayaan 1000 Pedagang, 1000 Guru, Murabahah, Mudharabah, Musyarakah, Ijarah, Multijasa, Qardhul Hasan).
   - Mengatur jenis akad, plafon, tenor maksimal, syarat dokumen, matriks perbandingan, alur 4 langkah pengajuan, nomor WhatsApp khusus *Relationship Manager*, serta Kalkulator Simulasi Angsuran.
3. **Produk: Brosur (`Pengaturan Wakalumi ➡️ Produk: Brosur`)**:
   - Mengunggah file PDF **Brosur Utama (Katalog Komprehensif)** beserta gambar sampulnya.
   - Menambah/mengubah daftar **Brosur Spesifik per Produk** (file PDF + gambar cover + kategori). Pengunjung dapat langsung melihat pratinjau PDF di layar atau mengunduhnya.

---

### E. Mengelola Halaman Informasi, Regulasi OJK & Berita

1. **Laporan Publikasi & Tata Kelola (`Pengaturan Wakalumi ➡️ Info: Laporan OJK`)**:
   - Digunakan untuk mengunggah dokumen PDF kewajiban regulasi OJK:
     - **Laporan Keuangan Publikasi Triwulanan** (Maret, Juni, September, Desember)
     - **Laporan Tata Kelola (GCG)**
     - **Laporan Tahunan (*Annual Report*)**
     - **Laporan Keuangan Berkelanjutan (LKB / *Sustainability Report*)**
   - Cara tambah laporan: Klik **+ Tambah Dokumen Laporan**, pilih Kategori, masukkan Tahun (misal `2026`), Judul Laporan, dan klik **Unggah File PDF** dari Media Library, lalu klik **Simpan Perubahan**. Filter tahun dan kategori di halaman depan akan otomatis menyesuaikan!
2. **Berita & Artikel (`Menu Sidebar Kiri ➡️ Berita / Posts`)**:
   - Klik **Tambah Berita Baru**:
     - Masukkan **Judul Berita** dan tulis isi berita di editor utama.
     - Pilih **Kategori Berita** di panel kanan dan unggah **Gambar Utama (*Featured Image*)**.
     - **Fitur Khusus Liputan Media Eksternal**: Jika berita tersebut adalah liputan dari portal berita luar (misal *Republika*, *Detik*, *Kompas*), Anda dapat mencentang opsi **Berita Eksternal**, mengisi nama media sumber, URL berita asli, dan memilih apakah pengunjung akan membaca ringkasannya dulu atau langsung dialihkan (*Direct Link*) ke portal media tersebut.
3. **Pengaduan Konsumen (`Pengaturan Wakalumi ➡️ Info: Pengaduan`)**:
   - Mengelola informasi resmi Mekanisme & Alur Pengaduan Nasabah sesuai POJK Pelindungan Konsumen, SLA waktu penyelesaian, kanal pengaduan resmi, dan integrasi LAPS SJK / Kontak OJK 157.
4. **Literasi & Inklusi Keuangan (`Pengaturan Wakalumi ➡️ Info: Literasi`)**:
   - Mengelola materi edukasi perbankan syariah, kamus istilah akad (Wadiah, Mudharabah, Murabahah, Ijarah, dll.), tabel perbandingan Bank Syariah vs Bank Konvensional, tips keamanan transaksi digital, dan FAQ literasi.
5. **Pengumuman Resmi (`Pengaturan Wakalumi ➡️ Info: Pengumuman`)**:
   - Mempublikasikan pengumuman operasional bank (misal: Jadwal Libur Hari Raya, Perubahan Jam Layanan, Pemenang Undian Tabungan, atau Himbauan Resmi) lengkap dengan lampiran dokumen PDF jika ada.
6. **Katalog Lelang Agunan (`Pengaturan Wakalumi ➡️ Info: Lelang`)**:
   - Mengelola daftar aset/properti agunan yang dilelang atau dijual sukarela, lengkap dengan foto properti, harga limit, lokasi, spesifikasi luas tanah/bangunan, status lelang, tautan KPKNL, dan tombol kontak petugas lelang.
7. **Dokumentasi Kegiatan, Galeri Foto, Tim Kami & Karir**:
   - **`Info: Kegiatan`**: Mengelola daftar agenda & dokumentasi kegiatan sosial/edukasi/korporat bank.
   - **`Info: Galeri`**: Mengelola album foto dokumentasi fasilitas dan aktivitas bank.
   - **`Info: Tim Kami`**: Mengelola profil tim manajemen & staf pelayanan.
   - **`Info: Karir`**: Membuka/menutup informasi lowongan kerja resmi di Bank Syariah Wakalumi beserta kualifikasi dan tata cara melamar.

---

### 💡 Tips Terbaik Operasional Admin

- **Ukuran Gambar**: Sebelum mengunggah foto ke Media Library, usahakan ukuran dimensi gambar proporsional (maksimal lebar `1600px` - `1920px`) dengan ukuran file di bawah **`500 KB`** (format `.jpg`, `.png`, atau `.webp`) agar website selalu terasa sangat cepat saat dibuka oleh nasabah melalui smartphone.
- **Penamaan File PDF**: Saat mengunggah file PDF Laporan Publikasi atau Brosur, gunakan nama file tanpa karakter spesial yang aneh (contoh baik: `Laporan-Publikasi-Triwulan-I-2026-BPRS-Wakalumi.pdf`).
- **Tombol Simpan**: Setiap kali selesai mengubah teks atau mengunggah gambar di halaman **`Pengaturan Wakalumi`**, jangan lupa gulir ke bagian bawah halaman dan klik tombol biru/hijau **"Simpan Perubahan"**.

---

## 6. Panduan Manajemen SEO & Optimasi Mesin Pencari (Google & Share WhatsApp)

Tema **Wakalumi** telah dilengkapi dengan **Mesin SEO & Open Graph Otomatis (Built-in Smart SEO Engine)** tanpa memerlukan plugin tambahan yang memberatkan server:

### A. Cara Mengatur SEO & Thumbnail Share WhatsApp di WP-Admin

1. Masuk ke **WP-Admin ➡️ Pengaturan Website ➡️ Umum & Logo Brand**.
2. Gulir ke bawah menuju bagian **"🔍 Pengaturan SEO & Pratinjau Mesin Pencari (Google & Share WhatsApp)"**:
   - **Deskripsi Meta Google (Meta Description)**: Isi dengan ringkasan resmi Bank Syariah Wakalumi (ideal 140–165 karakter). Teks ini akan tampil di bawah judul website pada hasil pencarian Google dan saat link website dibagikan di chat WhatsApp.
   - **Kata Kunci Pencarian (Meta Keywords)**: Kata kunci target pencarian nasabah (contoh: `Bank Syariah Wakalumi, BPRS Wakalumi, BSW, Bank Syariah Ciputat, Tabungan Syariah, Deposito Syariah, Pembiayaan Syariah`).
   - **Gambar Thumbnail Share WhatsApp (OG Image)**: Unggah gambar banner berukuran `1200 x 630 px` agar setiap kali link website dibagikan di WhatsApp/Telegram/Facebook, muncul gambar kartu pratinjau resmi bank. (Jika dikosongkan, sistem otomatis memakai Logo Utama Bank).
   - **Kode Verifikasi Google Search Console**: Tempelkan kode verifikasi HTML tag dari Google Search Console di kolom ini jika diperlukan.
3. Klik tombol **"Simpan Identitas, WhatsApp & SEO"**.

### B. Fitur SEO Otomatis yang Sudah Aktif di Tema

- **Dynamic Meta Title & Description per Halaman**: Untuk halaman berita/artikel, sistem otomatis mengambil cuplikan isi berita (*excerpt*) dan gambar sampul (*Featured Image*) sebagai pratinjau WhatsApp & Google.
- **Schema.org JSON-LD (`BankOrCreditUnion`)**: Sistem secara otomatis menyematkan struktur data resmi lembaga keuangan/perbankan syariah di kode halaman agar algoritma Google mengenali nama resmi **PT BPRS Wakalumi (Bank Syariah Wakalumi / BSW)**, nomor telepon, logo, dan alamat kantor pusat.
- **Kompatibilitas Penuh dengan Plugin SEO (Opsional)**: Jika di kemudian hari tim IT ingin memasang plugin **Yoast SEO** atau **Rank Math**, mesin SEO bawaan tema akan otomatis menonaktifkan tag duplikat dan menyerahkan kendali ke plugin tersebut.

### C. Langkah Agar Cepat Tampil di Halaman Pertama Google (Setelah Publish)

1. Pastikan opsi **`Settings ➡️ Reading ➡️ Search engine visibility`** ("Discourage search engines from indexing this site") **TIDAK DICENTANG** di WP-Admin.
2. Buka [Google Search Console](https://search.google.com/search-console/) menggunakan akun Google resmi perusahaan.
3. Tambahkan properti domain `https://bprswakalumi.co.id`, lalu salin kode verifikasi *HTML Tag* ke menu **WP-Admin ➡️ Pengaturan Website ➡️ Umum & Logo Brand ➡️ Kode Verifikasi Google Search Console**.
4. Di dashboard Google Search Console, masuk ke menu **Sitemaps** lalu kirimkan URL peta situs bawaan WordPress:
   ```text
   https://bprswakalumi.co.id/wp-sitemap.xml
   ```

---

## 7. Checklist Pemeriksaan Akhir Setelah Publish

Setelah website selesai dimigrasikan ke hosting, lakukan pengecekan singkat berikut (kurang lebih 5 menit):

- [ ] Buka `https://bprswakalumi.co.id` — pastikan gembok **SSL (HTTPS)** aktif dan halaman Beranda tampil sempurna dengan font baru **BSW (Rounded Water Philosophy — Nunito & Quicksand)**.
- [ ] Klik menu navigasi satu per satu (**Profil**, **Produk**, **Informasi**, **Kontak**) — pastikan perpindahan halaman berjalan mulus dan tidak ada error `404 Not Found`.
- [ ] Uji tombol **Mode Gelap / Terang (Dark Mode)** di bagian kanan atas navbar.
- [ ] Buka halaman **Laporan Publikasi** dan **Brosur**, lalu klik tombol **Lihat Pratinjau PDF** — pastikan modal pembaca PDF terbuka dengan lancar.
- [ ] Uji kirim link `https://bprswakalumi.co.id` ke chat **WhatsApp** untuk memastikan gambar pratinjau (OG Image) dan deskripsi SEO tampil rapi.
