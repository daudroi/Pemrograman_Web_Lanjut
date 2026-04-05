# LAPORAN PRAKTIKUM JOBSHEET 2
## Membuat CRUD Resource dengan Filament v4

**Mata Kuliah:** Pemrograman Web Lanjut  
**Topik:** Membuat CRUD Resource dengan Filament v4  
**Tanggal Praktikum:** 5 April 2026  
**Nama Praktikan:** Achmad Daud Roichan

---

## A. CAPAIAN PEMBELAJARAN

Setelah mengikuti praktikum ini, mahasiswa mampu:
1. ✅ Memahami konsep Resource pada Filament
2. ✅ Membuat CRUD (Create, Read, Update, Delete) menggunakan perintah artisan
3. ✅ Mengelola Form Builder pada Filament
4. ✅ Mengelola Table Builder pada Filament
5. ✅ Mengubah ikon menu resource

---

## B. KONSEP RESOURCE DI FILAMENT

### Pengertian Resource
Resource pada Filament adalah fitur untuk membuat halaman CRUD secara otomatis berbasis Model Laravel. Saat membuat resource, Filament secara otomatis akan membuat:
- File Resource utama
- Halaman List (daftar data)
- Halaman Create (tambah data)
- Halaman Edit (ubah data)
- File Form Schema
- File Table Schema

### Struktur Folder yang Dihasilkan
```
app/Filament/Admin/Resources/Users/
├── Pages/
│   ├── CreateUser.php
│   ├── EditUser.php
│   └── ListUsers.php
├── Schemas/
│   └── UserForm.php
├── Tables/
│   └── UsersTable.php
└── UserResource.php
```

---

## C. TAHAPAN PRAKTIKUM

### Langkah 1: Setup Filament
#### Command yang Dijalankan:
```bash
php artisan filament:install
```

#### Hasil:
- ✅ Assets Filament berhasil dipublikasikan
- ✅ Route cache dihapus
- ✅ View cache dibersihkan
- ✅ Filament berhasil di-upgrade

### Langkah 2: Membuat Resource User
Resource dibuat dengan structure manual karena custom needs, menghasilkan:
- UserResource.php (File Resource utama)
- CreateUser.php (Halaman Create)
- EditUser.php (Halaman Edit)
- ListUsers.php (Halaman List)
- UserForm.php (Form Schema)
- UsersTable.php (Table Schema)

### Langkah 3: Konfigurasi Panel Admin
Membuat `AdminPanelProvider.php` untuk konfigurasi:
- Path: `/admin`
- Login requirement: Ya
- Resource discovery otomatis
- Widget dan Dashboard

### Langkah 4: Membuat Form Input (Create & Edit)
#### Field yang Ditambahkan:
```php
TextInput::make('name')
    ->required()
    ->maxLength(255)

TextInput::make('email')
    ->email()
    ->required()
    ->maxLength(255)
    ->unique(ignoreRecord: true)

TextInput::make('password')
    ->password()
    ->minLength(6)
    ->hiddenOn('edit')
    ->required(fn(string $operation) => $operation === 'create')
```

#### Validasi yang Diterapkan:
- ✅ Email harus unik (unique)
- ✅ Password minimal 6 karakter
- ✅ Password tidak ditampilkan saat edit

### Langkah 5: Menampilkan Data pada Tabel
#### Kolom yang Ditampilkan:
```php
TextColumn::make('name')
    ->searchable()
    ->sortable()

TextColumn::make('email')
    ->searchable()
    ->sortable()

TextColumn::make('created_at')
    ->dateTime()
    ->sortable()
```

#### Fitur Tambahan:
- ✅ Search untuk name dan email
- ✅ Sorting pada semua kolom
- ✅ Edit action
- ✅ Delete action
- ✅ Bulk delete action

### Langkah 6: Mengubah Icon Menu Resource
Icon diatur pada class UserResource:
```php
protected static ?string $navigationIcon = 'heroicon-o-user-group';
```

#### Icon yang Digunakan:
- **Sebelum:** Default icon
- **Sesudah:** `heroicon-o-user-group` (Icon pengguna grup)

Semua icon menggunakan Heroicons dari https://heroicons.com

---

## D. DATABASE

### Struktur Tabel Users
```
users
├── id (Primary Key)
├── name (String)
├── email (String, Unique)
├── password (String, Hashed)
├── email_verified_at (Timestamp)
├── remember_token (String)
├── created_at (Timestamp)
└── updated_at (Timestamp)
```

### Data yang Ditambahkan (Seeding)
Menggunakan DatabaseSeeder untuk membuat test user:
1. **Admin User**
   - Name: Admin User
   - Email: admin@gmail.com
   - Password: password123 (hashed)

2. **Sample User**
   - Name: Teknik satu
   - Email: teknik1@gmail.com
   - Password: password123 (hashed)

---

## E. HASIL IMPLEMENTASI

### Fitur CRUD yang Berhasil Dibuat:

#### 1. READ (Daftar User)
- Menampilkan tabel dengan kolom: Name, Email, Created At
- Fitur search untuk Name dan Email
- Fitur sorting pada semua kolom
- Action Edit dan Delete

#### 2. CREATE (Tambah User)
- Form input: Name, Email, Password
- Validasi email unik
- Validasi password minimal 6 karakter
- Password otomatis di-hash oleh Laravel

#### 3. UPDATE (Edit User)
- Form edit tanpa field password
- Data bisa diubah dengan validasi yang sama
- Pesan sukses setelah update

#### 4. DELETE (Hapus User)
- Action delete per record
- Bulk delete untuk multiple records
- Konfirmasi sebelum menghapus

---

## F. FILE YANG DIBUAT/DIMODIFIKASI

### File Baru
```
app/Filament/Admin/
├── Resources/
│   ├── UserResource.php
│   └── Users/
│       ├── Pages/
│       │   ├── CreateUser.php
│       │   ├── EditUser.php
│       │   └── ListUsers.php
│       ├── Schemas/
│       │   └── UserForm.php
│       └── Tables/
│           └── UsersTable.php
├── Pages/
│   └── Dashboard.php
└── Widgets/
└── (Folder created)

app/Providers/
└── AdminPanelProvider.php (Baru)
```

### File Dimodifikasi
```
bootstrap/providers.php
- Menambahkan AdminPanelProvider

database/seeders/DatabaseSeeder.php
- Menambahkan logic membuat test user
```

---

## G. KONTEN FORM & TABEL

### Form Schema (UserForm.php)
Menggunakan Filament Form Builder dengan field:
- TextInput untuk Name
- TextInput dengan validasi email untuk Email
- TextInput dengan type password untuk Password

### Table Schema (UsersTable.php)
Menggunakan Filament Table Builder dengan:
- TextColumn untuk Name, Email, Created At
- Search functionality
- Sortable columns
- Action buttons (Edit, Delete)
- Bulk action (Delete multiple)

---

## H. HASIL YANG DICAPAI

✅ **Membuat CRUD User** - User dapat membuat, membaca, mengupdate, dan menghapus data user

✅ **Menambahkan Field Form** - Berhasil add name, email, password dengan validasi

✅ **Menampilkan Kolom Tabel** - Berhasil tampilkan name, email, created_at di list

✅ **Mengedit dan Menghapus Data** - Edit action dan delete action berfungsi dengan baik

✅ **Mengubah Icon Resource** - Icon berhasil diubah menggunakan heroicon

---

## I. ANALISIS & DISKUSI

### 1. Mengapa Filament dapat membuat CRUD tanpa banyak coding?
**Jawab:** Filament menggunakan architecture berbasis Schema dan Builder Pattern. Filament telah menyediakan component-component siap pakai yang bisa dikonfigurasi melalui fluent interface, sehingga developer tinggal define schema tanpa perlu menulis HTML/CSS/JS.

### 2. Apa perbedaan Form Schema dan Table Schema?
**Jawab:** 
- **Form Schema** - Memanage input data (create/edit), berfokus pada validasi dan user input
- **Table Schema** - Memanage display data (list), berfokus pada presentasi dan filtering data

### 3. Bagaimana jika kita ingin menambahkan validasi email unik?
**Jawab:** Menggunakan method `->unique(ignoreRecord: true)` pada field email. Ini akan validasi email unique kecuali untuk record yang sedang diedit.

### 4. Mengapa password tidak perlu kita hash manual?
**Jawab:** Laravel User Model memiliki mutator otomatis melalui attribute cast `'password' => 'hashed'`. Password otomatis di-hash saat disimpan ke database.

---

## J. KESIMPULAN

Praktikum membuat CRUD Resource dengan Filament v4 berhasil dilaksanakan. Mahasiswa telah memahami:
- Konsep Resource pada Filament
- Pembuatan CRUD otomatis dengan mudah
- Penggunaan Form Builder untuk input data
- Penggunaan Table Builder untuk menampilkan data
- Kustomisasi icon dan tampilan resource

Filament terbukti sangat efisien dalam membangun admin panel karena meminimalkan boilerplate code dan fokus pada bisnis logik.

---

## K. REFERENSI

- Filament Documentation: https://filamentphp.com/docs
- Heroicons: https://heroicons.com
- Laravel Documentation: https://laravel.com/docs
- Laravel Validation: https://laravel.com/docs/validation

---

**Selesai pada:** April 5, 2026
