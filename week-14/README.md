# LAPORAN PRAKTIKUM PERTEMUAN 14
## Implementasi Relation pada Filament (HasMany)

## Identitas Mahasiswa
**Nama:** Achmad Daud Roichan  
**NIM:** 244107020005  
**Kelas:** TI-2F  
**Semester:** 2026/2027  

---

**Mata Kuliah:** Pemrograman Web Lanjut  
**Pertemuan:** 14  
**Topik:** Implementasi Relation pada Filament (HasMany)  
**Tanggal Praktikum:** 2026  

---

## I. CAPAIAN PEMBELAJARAN

Setelah mengikuti praktikum ini, mahasiswa mampu:
- ✅ Memahami konsep relationship pada Laravel dan Filament
- ✅ Menggunakan method `relationship()` pada form Filament
- ✅ Mengimplementasikan searchable relationship dropdown
- ✅ Menampilkan data relasi pada tabel Filament
- ✅ Membuat Relationship Manager
- ✅ Mengelola relasi HasMany pada Filament Admin Panel

---

## II. LATAR BELAKANG

Dalam aplikasi web, sering ditemukan hubungan antar tabel database (relationship). Pada praktikum ini, kita mengimplementasikan relasi One-to-Many antara model `Category` dan `Post` (di mana satu `Category` memiliki banyak `Post`, dan satu `Post` hanya memiliki satu `Category`). 

Pada Filament, relationship dapat diintegrasikan secara seamless untuk:
- Mengisi dropdown category secara dinamis dari database.
- Melakukan pencarian data relasi menggunakan fitur `searchable()`.
- Menampilkan data relasi (seperti nama kategori) di tabel `Posts`.
- Mengelola data postingan yang terkait langsung dari halaman edit kategori menggunakan `Relationship Manager`.

---

## III. IMPLEMENTASI RELATIONSHIP

### A. Pengaturan Relasi pada Model Eloquent

**1. Model Post (`app/Models/Post.php`)**
```php
public function category()
{
    return $this->belongsTo(Category::class);
}
```

**2. Model Category (`app/Models/Category.php`)**
```php
public function posts()
{
    return $this->hasMany(Post::class);
}
```

---

### B. Implementasi Dropdown Relationship & Searchable pada Form

**File:** `app/Filament/Admin/Resources/Posts/Schemas/PostForm.php`

**Kode:**
```php
Select::make('category_id')
    ->relationship('category', 'name')
    ->preload() // Memuat data di awal untuk efisiensi jika opsi sedikit
    ->searchable() // Mengaktifkan fitur pencarian pada dropdown untuk dataset besar
    ->required(),
```

**Hasil:**
- Dropdown kategori secara otomatis memuat data dari tabel `categories`.
- Menggunakan `searchable()` sehingga pengguna dapat mencari kategori dengan mengetikkan nama kategori.
- Menggunakan `preload()` untuk mempercepat pemuatan data kategori di awal.

---

### C. Menampilkan Data Relasi pada Table

**File:** `app/Filament/Admin/Resources/Posts/Tables/PostsTable.php`

**Kode:**
```php
TextColumn::make('category.name')
    ->searchable()
    ->sortable()
    ->label('Category')
    ->toggleable(),
```

**Hasil:**
- Tabel Posts menampilkan kolom "Category" yang berisi nama kategori yang berelasi.
- Kolom kategori dapat dicari (`searchable()`) dan diurutkan (`sortable()`).

---

### D. Pembuatan dan Registrasi Relationship Manager

**1. Generate Relationship Manager**
Dibuat menggunakan command Artisan:
```bash
php artisan make:filament-relation-manager CategoryResource posts title
```

**2. Hubungkan ke CategoryResource (`app/Filament/Admin/Resources/Categories/CategoryResource.php`)**
```php
use App\Filament\Admin\Resources\Categories\RelationManagers\PostsRelationManager;

public static function getRelations(): array
{
    return [
        PostsRelationManager::class,
    ];
}
```

---

### E. Konfigurasi PostsRelationManager

**File:** `app/Filament/Admin/Resources/Categories/RelationManagers/PostsRelationManager.php`

**Kode:**
```php
public function form(Schema $schema): Schema
{
    return $schema
        ->components([
            TextInput::make('title')
                ->required()
                ->maxLength(255),
            TextInput::make('slug')
                ->required()
                ->maxLength(255),
        ]);
}

public function table(Table $table): Table
{
    return $table
        ->recordTitleAttribute('title')
        ->columns([
            TextColumn::make('title')
                ->searchable()
                ->sortable(),
            TextColumn::make('slug')
                ->searchable()
                ->sortable(),
            TextColumn::make('created_at')
                ->dateTime()
                ->sortable(),
        ])
        // ...
}
```

---

## IV. DAFTAR COMPONENT RELATIONSHIP YANG DIIMPLEMENTASIKAN

| No | Lokasi | Component | Method/Fungsi | Kegunaan |
|:--:|:------:|:---------:|:-------------:|:--------:|
| 1 | PostForm | `Select` | `relationship('category', 'name')` | Menghubungkan dropdown dengan model relasi |
| 2 | PostForm | `Select` | `searchable()` | Mengaktifkan pencarian dinamis kategori |
| 3 | PostForm | `Select` | `preload()` | Memuat data kategori di awal |
| 4 | PostsTable | `TextColumn` | `make('category.name')` | Menampilkan nama kategori yang berelasi |
| 5 | CategoryResource | `getRelations` | `PostsRelationManager::class` | Mendaftarkan Relation Manager ke halaman edit Category |
| 6 | PostsRelationManager | `TextInput` | `make('slug')`, `make('title')` | Input form untuk pembuatan post di dalam Category |

---

## V. ANALISIS & DISKUSI

### 1. Apa perbedaan `relationship()` dengan `options()`?

**Jawaban:**
- **`relationship()`**:
  - Mengambil data relasi secara otomatis langsung dari database Eloquent.
  - Filament akan secara otomatis menangani query, penyimpanan foreign key, dan loading data terkait.
  - Mendukung lazy loading, dynamic searching (`searchable()`), dan pembuatan record baru langsung dari modal dropdown (jika dikonfigurasi).
- **`options()`**:
  - Digunakan untuk memasukkan pilihan data secara statis (hardcoded array) atau manual query (misalnya mengambil data dari enum, config file, atau mapping custom).
  - Developer harus mendefinisikan array `[key => value]` secara manual. Tidak otomatis mengelola foreign key relationship bawaan Laravel Eloquent.

---

### 2. Mengapa `searchable()` penting untuk dataset besar?

**Jawaban:**
- **Kinerja dan Optimasi Memori**: Tanpa `searchable()`, dropdown akan memuat seluruh record dari database sekaligus (misal 10,000+ kategori), yang akan memperlambat load-time halaman (bottleneck pada HTTP payload dan memori browser).
- **UX (User Experience) yang Lebih Baik**: Pengguna tidak perlu scroll sangat panjang untuk mencari satu data. Cukup dengan mengetikkan kata kunci, Filament akan melakukan query AJAX di background secara real-time untuk memfilter data.

---

### 3. Apa fungsi Relationship Manager pada Filament?

**Jawaban:**
- **CRUD Terintegrasi (Inline CRUD)**: Memungkinkan pengguna mengelola data anak (child records) secara langsung di halaman detail/edit data induk (parent record) tanpa harus berpindah halaman.
- **Konsistensi UI**: Menyediakan tabel relasi yang rapi dan terisolasi untuk data-data yang saling berhubungan langsung.
- **Auto-filling Foreign Key**: Saat kita membuat record baru dari dalam Relationship Manager (misal membuat Post di dalam halaman edit Category), foreign key (`category_id`) akan otomatis terisi oleh ID Category induk tersebut.

---

### 4. Kapan menggunakan HasMany dan BelongsTo?

**Jawaban:**
- **`HasMany`**:
  - Digunakan pada model yang menjadi **induk/parent** (One-to-Many).
  - Contoh: Satu `Category` memiliki banyak `Post` (Category **has many** Posts). Model `Category` tidak menyimpan kolom `post_id`, melainkan model `Post` yang menampung kolom `category_id`.
- **`BelongsTo`**:
  - Digunakan pada model yang memiliki/menyimpan **foreign key** (child record).
  - Contoh: Satu `Post` dimiliki oleh satu `Category` (Post **belongs to** Category). Kolom `category_id` terletak pada tabel `posts`.

---

## VI. KESIMPULAN

Pada praktikum ini, kita telah berhasil mengimplementasikan hubungan relasional HasMany/BelongsTo menggunakan Filament Admin Panel. Mulai dari implementasi dropdown yang *searchable*, penampilan data kategori di tabel, hingga integrasi Relationship Manager untuk mempermudah manajemen data relasional secara langsung dari resource utama tanpa mengorbankan performa aplikasi.
