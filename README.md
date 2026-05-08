# PWL Laravel - Pemrograman Web Lanjut

Repository ini digunakan untuk menyimpan seluruh tugas praktikum dan laporan mata kuliah **Pemrograman Web Lanjut** menggunakan *framework* Laravel dan Filament PHP.

## Informasi Mahasiswa

| Data   | Keterangan |
| :---   | :--- |
| **NIM**    | 244107020005 |
| **Nama**   | Achmad Daud Roichan |
| **Kelas**  | TI-2F |

*(Catatan: Sesuaikan nama dan NIM di atas jika ada perubahan)*

---

## 📂 Daftar Praktikum

Repository ini dibagi menjadi beberapa direktori berdasarkan minggu pertemuan:

- **`week-01/`** — Instalasi, Konfigurasi Awal Laravel, dan Struktur Direktori
- **`week-02/`** — Routing, Controller, dan Views (Aplikasi POS)
- **`week-04/`** — Model, Migration, Factory, dan Database Seeder
- **`week-05/`** — Implementasi Otentikasi dan Middleware
- **`week-06/`** — Setup Filament Admin Panel & Basic CRUD
- **`week-07/`** — Wizard Form, Multi-step Form & Infolist di Filament
- **`week-10/`** — Sorting Dataset (Ascending/Descending) pada Tabel Filament

> **Note:** Setiap folder pertemuan biasanya dilengkapi dengan file `Laporan.md` / `report.md` yang memuat dokumentasi, analisis, dan *screenshot* hasil praktikum.

---

## 🚀 Cara Menjalankan Project (Lokal)

Jika kamu ingin menjalankan salah satu folder project di komputermu sendiri, ikuti langkah-langkah berikut:

1. Buka terminal dan masuk ke folder minggu yang dituju:
   ```bash
   cd week-X
   ```
2. Install semua dependency PHP:
   ```bash
   composer install
   ```
3. Copy file environment dan sesuaikan pengaturan database (nama DB, port, dsb):
   ```bash
   cp .env.example .env
   ```
4. Generate key aplikasi:
   ```bash
   php artisan key:generate
   ```
5. (Opsional) Sesuaikan link storage untuk gambar:
   ```bash
   php artisan storage:link
   ```
6. Lakukan migrasi database dan *seeding* data awal:
   ```bash
   php artisan migrate --seed
   ```
7. Jalankan *development server*:
   ```bash
   php artisan serve
   ```