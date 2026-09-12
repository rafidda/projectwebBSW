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

---

## ⏭️ 6. STATUS SAAT INI & NEXT STEPS
- **Status Beranda**: 100% Selesai untuk tahapan UI/UX (*Cleaned & Optimized*).
- **Tugas Selanjutnya (Pending)**: 
  - (Menunggu arahan *user*) Membangun halaman statis lain (seperti Profil, Tentang Kami, Detail Produk).
  - Mengintegrasikan *Advanced Custom Fields (ACF)* di halaman admin agar admin Wakalumi bisa mengganti teks/gambar di beranda tanpa mengubah *coding*.

*(AI Note: Bacalah dokumen ini sepenuhnya setiap kali *session* diperbarui agar arsitektur dan gaya kelas Tailwind (*Glassmorphism/Shadow*) tidak melenceng dari standar ini.)*
