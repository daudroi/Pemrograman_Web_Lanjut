# LAPORAN PRAKTIKUM JOBSHEET 1
## Instalasi dan Setup Filament PHP v4 pada Laravel 11

**Mata Kuliah:** Pemrograman Web Lanjut  
**Topik:** Instalasi dan Setup Filament PHP v4 pada Laravel 11  
**Tanggal Praktikum:** 29 Maret 2026  
**Nama Praktikan:** Achmad Daud Roichan

---

## A. PENGENALAN FILAMENT PHP

### Definisi Filament
Filament adalah framework UI open-source berbasis Laravel yang digunakan untuk membangun admin panel dengan cepat dan elegan. Filament menyediakan solusi lengkap untuk membuat interface administratif dengan fitur-fitur modern tanpa perlu menulis banyak kode HTML, CSS, dan JavaScript.

### Teknologi yang Digunakan
Filament dibangun menggunakan beberapa teknologi utama:
- **Laravel** - Framework PHP backend
- **Livewire** - Real-time reactive components
- **Alpine.js** - Lightweight JavaScript framework
- **Tailwind CSS** - Utility-first CSS framework

### Website Resmi
Website: https://filamentphp.com

---

## B. REQUIREMENT SISTEM

### Software yang Diperlukan

| Software | Versi Minimum |
|----------|--------------|
| PHP | ≥ 8.2 |
| Laravel | ≥ 11 |
| Tailwind CSS | ≥ 4.0 |
| Database | MySQL / SQLite |
| Node.js & npm | Terbaru |
| Composer | Terbaru |

### Konfigurasi Server Lokal
Praktikum ini menggunakan Laragon sebagai server lokal dengan konfigurasi:
- PHP 8.5.1
- MySQL tersedia via Laragon
- Database: SQLite (untuk development awal)

---

## C. LANGKAH-LANGKAH PRAKTIKUM

### Langkah 1 - Membuat Project Laravel Baru

**Perintah yang dijalankan:**
```bash
composer create-project laravel/laravel filament-pwl
```

**Hasil:**
- Project Laravel berhasil dibuat di direktori `week-05/filament-pwl`
- Folder struktur standar Laravel 11 tercipta dengan baik
- File konfigurasi dasar sudah tersedia

**Output Terminal:**
```
Creating a "laravel/laravel" project at "./filament-pwl"
...
Application ready! Build something amazing.
```

---

### Langkah 2 - Konfigurasi Database

**File yang dimodifikasi:** `.env`

**Konfigurasi awal menggunakan SQLite:**
```
DB_CONNECTION=sqlite
DB_HOST=
DB_PORT=
DB_DATABASE=database/database.sqlite
DB_USERNAME=
DB_PASSWORD=
```

**Perintah migrasi database:**
```bash
php artisan migrate
```

**Hasil:**
```
INFO  Preparing database.
Creating migration table ...................................... 54.10ms DONE

INFO  Running migrations.
0001_01_01_000000_create_users_table ......................... 149.41ms DONE
0001_01_01_000001_create_cache_table .......................... 87.41ms DONE
0001_01_01_000002_create_jobs_table .......................... 117.56ms DONE
```

Semua migrasi default Laravel berhasil dijalankan dan tabel users, cache, dan jobs sudah terbuat.

---

### Langkah 3 - Instalasi Filament v4

**Perintah instalasi:**
```bash
composer require filament/filament
```

**Versi yang diinstall:**
- Filament v5.4.2 (versi terbaru, lebih advanced dari v4)
- Livewire v4.2.2
- Tailwind CSS dan dependencies lainnya

**Packages yang terinstall:**
- filament/actions v5.4.2
- filament/forms v5.4.2
- filament/tables v5.4.2
- filament/widgets v5.4.2
- filament/infolists v5.4.2
- filament/notifications v5.4.2
- livewire/livewire v4.2.2
- blade-ui-kit/blade-icons dan blade-heroicons
- Semua dependencies support lainnya

**Panel Builder Installation:**
```bash
php artisan filament:install --panels
```

**Hasil:**
Filament panel sudah terinstall dan siap digunakan untuk membuat admin dashboard.

---

### Langkah 4 - Membuat User Admin

**File yang dibuat:** `database/seeders/UserSeeder.php`

**Isi Seeder:**
```php
<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'remember_token' => null,
        ]);

        User::create([
            'name' => 'Admin Developer',
            'email' => 'developer@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'remember_token' => null,
        ]);
    }
}
```

**Perintah menjalankan seeder:**
```bash
php artisan db:seed --class=UserSeeder
```

**Hasil:**
```
INFO  Seeding database.
Database seeding completed successfully.
```

**User yang dibuat:**
1. **User Admin Utama**
   - Nama: Admin User
   - Email: admin@gmail.com
   - Password: 123456
   - Status: Terverifikasi

2. **User Admin Developer**
   - Nama: Admin Developer
   - Email: developer@gmail.com
   - Password: 123456
   - Status: Terverifikasi

---

### Langkah 5 - Menjalankan Aplikasi

**Perintah menjalankan development server:**
```bash
php artisan serve
```

**Output Server:**
```
INFO  Server running on: http://127.0.0.1:8000
```

**Akses Admin Panel:**
- URL: http://localhost:8000/admin
- Login: Gunakan salah satu akun yang telah dibuat di atas

---

## D. HASIL YANG DICAPAI

### 1. Project Structure
```
filament-pwl/
├── app/
│   ├── Http/
│   ├── Models/
│   │   └── User.php
│   └── Providers/
├── database/
│   ├── migrations/
│   ├── seeders/
│   │   └── UserSeeder.php
│   └── database.sqlite
├── routes/
├── resources/
├── vendor/
├── .env
├── artisan
├── composer.json
└── composer.lock
```

### 2. Database Status
- **Database Type:** SQLite
- **Database File:** `database/database.sqlite`
- **Tables Created:**
  - users (5 kolom: id, name, email, email_verified_at, password, remember_token, created_at, updated_at)
  - cache
  - cache_locks
  - jobs
  - job_batches
  - failed_jobs
  - migrations

### 3. Filament Panel Status
- ✅ Panel Admin berhasil terinstall
- ✅ Routing ke `/admin` sudah aktif
- ✅ Authentication system sudah terintegrasi
- ✅ UI dark mode tersedia
- ✅ Dashboard minimal sudah siap

### 4. User Authentication
- ✅ 2 user admin berhasil dibuat
- ✅ Password sudah di-hash dengan bcrypt
- ✅ Email terverifikasi
- ✅ Siap untuk login ke admin panel

---

## E. ANALISIS & DISKUSI

### Pertanyaan 1: Apa kelebihan Filament dibanding membuat admin panel manual?

**Jawaban:**

Filament memiliki banyak kelebihan dibanding membuat admin panel secara manual:

1. **Time Efficiency (Efisiensi Waktu)**
   - Dengan Filament, developer dapat membuat admin panel kompleks dalam hitungan jam, bukan hari/minggu
   - Resource CRUD dapat di-generate otomatis dengan satu command
   - Tidak perlu menulis HTML, CSS, dan JavaScript dari nol

2. **Built-in Features (Fitur Bawaan)**
   - Authentication dan authorization sudah terintegrasi
   - Fitur pencarian dan filtering otomatis pada tabel
   - Export ke CSV/Excel sudah built-in
   - Validasi form dengan error handling yang baik
   - Pagination dan sorting sudah tersedia
   - Dark mode support

3. **Responsive Design (Desain Responsif)**
   - Menggunakan Tailwind CSS, otomatis responsive di mobile dan desktop
   - CSS sudah di-optimize dan cepat

4. **Customization (Kustomisasi)**
   - Meskipun otomatis, Filament sangat customizable
   - Dapat menambah field custom, validation custom, dan action custom
   - Plugin ecosystem yang kaya

5. **Security (Keamanan)**
   - CSRF protection built-in
   - SQL injection prevention via Eloquent ORM
   - Password hashing otomatis
   - Authorization policies terintegrasi

6. **Maintenance (Pemeliharaan)**
   - Kode lebih clean dan terstruktur
   - Mudah untuk update dan maintenance
   - Community support yang besar

7. **Developer Experience (Pengalaman Developer)**
   - IDE intellisense yang baik
   - Error handling yang jelas
   - Dokumentasi lengkap dan aktual

---

### Pertanyaan 2: Mengapa Filament menggunakan Livewire?

**Jawaban:**

Filament memilih Livewire sebagai core technology untuk beberapa alasan strategis:

1. **Real-time Reactivity (Reaktivitas Real-Time)**
   - Livewire memungkinkan update UI secara real-time tanpa full page reload
   - User experience lebih smooth dan responsif
   - Membuat form validation terasa instant

2. **Simplified State Management**
   - Tidak perlu JavaScript framework kompleks seperti Vue atau React
   - State management ditangani di Laravel backend, lebih familiar untuk Laravel developer
   - Mengurangi kompleksitas kode client-side

3. **PHP-First Approach**
   - Developer hanya perlu menulis PHP, tidak perlu JavaScript
   - Lebih mudah dipelajari oleh backend developer Laravel
   - Mengurangi context switching antara bahasa

4. **Seamless Integration with Laravel**
   - Livewire dirancang khusus untuk Laravel
   - Mengikuti Laravel conventions dan patterns
   - Mudah mengakses model, validation, dan authorization dari Laravel

5. **Built-in SPA without SPA Complexity**
   - Memberikan pengalaman Single Page Application tanpa kompleksitas setup SPA
   - Performance baik dengan minimal JavaScript overhead

6. **Component-Based Architecture**
   - Livewire base Filament mendukung reusable components
   - Easier testing dan maintenance
   - Scalable untuk aplikasi besar

7. **Minimal Dependency**
   - Hanya bergantung pada Alpine.js untuk interaksi DOM minimal
   - Lightweight dan cepat di-load

---

### Pertanyaan 3: Apa perbedaan SQLite dan MySQL dalam development?

**Jawaban:**

SQLite dan MySQL adalah dua database system yang berbeda dengan kelebihan dan kekurangan masing-masing:

| Aspek | SQLite | MySQL |
|-------|--------|-------|
| **Setup** | Zero-configuration, file berbasis | Perlu instalasi, server-based |
| **Performa Read** | Cepat untuk data kecil-menengah | Cepat untuk data besar |
| **Performa Write** | Terbatas (single-threaded) | Lebih baik untuk concurrent writes |
| **Concurrency** | Buruk, locking pada file level | Baik, row-level locking |
| **Scalability** | Terbatas pada beberapa GB | Sangat scalable |
| **Storage** | Satu file | Multiple files & directories |
| **Replikasi** | Tidak ada | Full-featured replication |
| **Use Case** | Desktop app, embedded, dev | Production, web app, high-traffic |

**Untuk Development:**

**SQLite lebih cocok untuk:**
- Prototyping cepat
- Development awal project
- Testing dan CI/CD
- Database kecil
- Project offline-first
- Learning RDBMS concept

**MySQL lebih cocok untuk:**
- Production environment
- Multi-user concurrent access
- Large datasets
- High traffic application
- Team collaboration
- Enterprise systems

**Dalam context praktikum ini:** SQLite dipilih karena:
- Setup cepat tanpa konfigurasi server
- Fokus pada pembelajaran Filament, bukan database
- File database dapat di-version control
- Testing dan reset database mudah
- Sufficient untuk development phase

---

### Pertanyaan 4: Apa fungsi Panel Builder?

**Jawaban:**

Panel Builder adalah komponen Filament yang berfungsi sebagai foundation untuk membangun admin panel. Fungsi utama Panel Builder:

1. **Scaffolding dan Initialization**
   - Membuat struktur dasar admin panel
   - Generate routes untuk `/admin`
   - Setup middleware authentication
   - Konfigurasi default theme dan layout

2. **Route Management**
   - Automatic route registration untuk resources dan pages
   - URL grouping untuk `/admin/*`
   - Prefix automatic tanpa konfigurasi manual

3. **Authentication Integration**
   - Setup login/logout routes
   - Guard configuration
   - Session management
   - Password reset functionality

4. **Styling dan Theming**
   - Default Tailwind CSS styling
   - Dark mode configuration
   - Theme customization point
   - CSS purging setup

5. **Resource Registration**
   - Central place untuk register CRUD resources
   - Custom pages registration
   - Widget registration
   - Plugin registration

6. **Navigation Builder**
   - Automatic sidebar generation
   - Menu item grouping
   - Icon support
   - Permission-based menu visibility

7. **Middleware Configuration**
   - Admin panel middleware stack
   - Authentication verification
   - Custom middleware support

**Contoh Penggunaan:**
```php
// Di app/Providers/Filament/AdminPanelProvider.php
public function panel(Panel $panel): Panel
{
    return $panel
        ->default()
        ->id('admin')
        ->path('admin')
        ->login()
        ->colors([...])
        ->resources([...])
        ->pages([...])
        ->widgets([...]);
}
```

Panel Builder menjadi tulang punggung Filament yang menghubungkan semua komponen menjadi satu sistem admin panel yang utuh.

---

## F. KESIMPULAN

### Pembelajaran yang Didapat

Setelah menyelesaikan praktikum Jobsheet 1, telah dipelajari dan dipahami:

1. ✅ **Konsep Filament PHP**
   - Framework UI open-source berbasis Laravel
   - Digunakan untuk membuat admin panel modern dengan cepat
   - Built dengan Laravel, Livewire, Alpine.js, dan Tailwind CSS

2. ✅ **Requirement Sistem**
   - PHP minimum 8.2
   - Laravel 11+
   - Tailwind CSS 4.0+
   - Database MySQL atau SQLite
   - Supporting tools seperti Node.js dan npm

3. ✅ **Instalasi Laravel 11**
   - Proses instalasi menggunakan Composer
   - Project structure dan konfigurasi dasar
   - Database setup dengan migrasi

4. ✅ **Instalasi Filament v5.4.2**
   - Composer package installation
   - Panel Builder setup dan configuration
   - Dependencies dan supporting libraries

5. ✅ **Konfigurasi Database**
   - Using SQLite untuk development
   - Migration dan seeding
   - User table untuk authentication

6. ✅ **Pembuatan User Admin**
   - Dua user admin berhasil dibuat
   - Password hashing dengan bcrypt
   - Email verification setup
   - Ready untuk login ke admin panel

7. ✅ **Running Admin Panel**
   - Development server setup
   - Admin panel accessible di `/admin`
   - Basic dark mode dan dashboard

### Teknologi yang Digunakan

- **Framework:** Laravel 11 + Filament 5.4.2
- **Database:** SQLite (development)
- **Frontend:** Livewire + Alpine.js + Tailwind CSS
- **Authentication:** Laravel default auth
- **Server:** PHP 8.5.1 via Laragon

### Status Praktikum

🟢 **SELESAI DENGAN SUKSES**

Semua tahap praktikum telah diselesaikan:
- ✅ Install Laravel project
- ✅ Konfigurasi database
- ✅ Install Filament
- ✅ Setup Panel Builder
- ✅ Membuat user admin (2 user)
- ✅ Menjalankan application

### Praktikum Selanjutnya

Setelah menguasai materi ini, praktikum berikutnya akan meliputi:

1. **Resource CRUD** - Membuat CRUD resource untuk tabel-tabel
2. **Form & Table Builder** - Advanced form dan tabel configuration
3. **Database Relations** - One-to-many, many-to-many, etc
4. **Custom Dashboard Widgets** - Widget custom dan dashboard customization
5. **Multi-Panel System** - Sistem panel multi-role dan multi-tenant
6. **Advanced Features** - Activity logging, audit trail, dll

---

## Catatan Implementasi

### Database Configuration
- Database: SQLite (database/database.sqlite)
- Tables: users, cache, sessions, jobs, migrations
- User count: 2 admin users

### Filament Setup
- Panel ID: admin
- Route: /admin
- Authentication: Built-in with user model
- UI: Tailwind CSS + Dark Mode support

### Kendala dan Solusi Selama Praktikum

**Kendala 1: Versi Filament v4.0.0 ada security advisory**
- Solusi: Menggunakan versi terbaru Filament v5.4.2

**Kendala 2: MySQL tidak terconnect di awal**
- Solusi: Sementara menggunakan SQLite untuk development, dapat di-switch ke MySQL di production

**Kendala 3: Interactive command line untuk pembuatan user**
- Solusi: Menggunakan PHP Seeder untuk membuat user secara scripted

### Rekomendasi

1. Untuk production, gunakan MySQL atau database server yang proper
2. Aktifkan HTTPS dan security headers
3. Setup proper logging dan monitoring
4. Implement role-based access control (RBAC)
5. Regular backup database
6. Optimize queries dan indexing

---

**Laporan Disusun:** 29 Maret 2026  
**Status:** ✅ Selesai Praktikum  
**Versi Filament:** v5.4.2 (Latest)  
**Versi Laravel:** 11.x  

---

*Praktikum ini merupakan bagian dari mata kuliah Pemrograman Web Lanjut yang membahas teknologi modern dalam pengembangan web application dengan Laravel dan Filament.*
