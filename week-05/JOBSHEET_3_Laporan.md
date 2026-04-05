# JOBSHEET PRAKTIKUM

## Mata Kuliah: Pemrograman Web Lanjut
## Pertemuan 3 – Membuat Migration, Model, Relasi & Resource Category

---

## Laporan Praktikum

**Nama:** Mahasiswa  
**NIM:** -  
**Tanggal:** April 5, 2026  
**Status:** ✅ Selesai

---

## A. Capaian Pembelajaran

Mahasiswa telah berhasil mencapai learning outcomes berikut:

- ✅ Membuat Model dan Migration menggunakan Artisan
- ✅ Mendesain struktur tabel database
- ✅ Mengatur $fillable pada model
- ✅ Menggunakan $casts pada Laravel
- ✅ Membuat relasi antar model (One-to-Many)
- ✅ Membuat Resource Category di Filament

---

## B. Langkah Praktikum yang Dilakukan

### Langkah 1: Membuat Model & Migration Category

**Perintah:**
```
php artisan make:model Category -m
```

**Output:**
```
Model [app/Models/Category.php] created successfully.
Migration [database/migrations/2026_04_05_132728_create_categories_table.php] created successfully.
```

**File yang dibuat:**
- `app/Models/Category.php`
- `database/migrations/2026_04_05_132728_create_categories_table.php`

---

### Langkah 2: Mendesain Tabel Categories

**File:** `database/migrations/2026_04_05_132728_create_categories_table.php`

**Struktur Tabel yang Dibuat:**
```php
Schema::create('categories', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug');
    $table->timestamps();
});
```

**Kolom-kolom:**
| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | BIGINT | Primary Key, auto increment |
| name | VARCHAR(255) | Nama kategori |
| slug | VARCHAR(255) | Slug kategori (untuk routing) |
| created_at | TIMESTAMP | Waktu pembuatan |
| updated_at | TIMESTAMP | Waktu update |

---

### Langkah 3: Mengatur Model Category

**File:** `app/Models/Category.php`

**Kode yang ditambahkan:**
```php
protected $fillable = [
    'name',
    'slug',
];
```

**Fungsi $fillable:**
Memungkinkan data untuk disimpan menggunakan mass assignment (digunakan oleh Filament).

---

### Langkah 4: Generate Model Post

**Perintah:**
```
php artisan make:model Post -m
```

**Output:**
```
Model [app/Models/Post.php] created successfully.
Migration [database/migrations/2026_04_05_132754_create_posts_table.php] created successfully.
```

---

### Langkah 5: Mendesain Tabel Posts

**File:** `database/migrations/2026_04_05_132754_create_posts_table.php`

**Struktur Tabel yang Dibuat:**
```php
Schema::create('posts', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('slug');
    $table->integer('category_id');
    $table->string('color')->nullable();
    $table->string('image')->nullable();
    $table->text('body')->nullable();
    $table->json('tags')->nullable();
    $table->boolean('published')->default(false);
    $table->date('published_at')->nullable();
    $table->timestamps();
});
```

**Kolom-kolom:**
| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | BIGINT | Primary Key |
| title | VARCHAR(255) | Judul post |
| slug | VARCHAR(255) | Slug post |
| category_id | INT | Referensi ke kategori |
| color | VARCHAR(255) | Warna post (nullable) |
| image | VARCHAR(255) | URL gambar (nullable) |
| body | TEXT | Isi post (nullable) |
| tags | JSON | Tags dalam format array (nullable) |
| published | BOOLEAN | Status publikasi (default: false) |
| published_at | DATE | Tanggal publikasi (nullable) |
| created_at | TIMESTAMP | Waktu pembuatan |
| updated_at | TIMESTAMP | Waktu update |

---

### Langkah 6: Migrasi Database

**Perintah:**
```
php artisan migrate
```

**Output:**
```
Running migrations.
2026_04_05_132728_create_categories_table ................ 271.44ms DONE
2026_04_05_132754_create_posts_table ........................ 16.46ms DONE
```

---

### Langkah 7: Mengatur Model Post

**File:** `app/Models/Post.php`

**Kode yang ditambahkan:**

#### $fillable Array:
```php
protected $fillable = [
    'title',
    'slug',
    'category_id',
    'color',
    'image',
    'body',
    'tags',
    'published',
    'published_at',
];
```

#### $casts Array:
```php
protected $casts = [
    'tags' => 'array',
    'published' => 'boolean',
    'published_at' => 'date',
];
```

**Fungsi Casting:**
- JSON → array otomatis (untuk tags)
- Boolean → true/false (untuk published)
- Date → otomatis menjadi Carbon instance (untuk published_at)

#### Relasi dengan Category:
```php
public function category()
{
    return $this->belongsTo(Category::class);
}
```

---

### Langkah 8: Membuat Resource Category di Filament

**File yang dibuat:**
- `app/Filament/Admin/Resources/CategoryResource.php`
- `app/Filament/Admin/Resources/Categories/Pages/ListCategories.php`
- `app/Filament/Admin/Resources/Categories/Pages/CreateCategory.php`
- `app/Filament/Admin/Resources/Categories/Pages/EditCategory.php`

**CategoryResource.php:**
```php
class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;
    protected static ?string $navigationLabel = 'Categories';

    public static function form(Schema $form): Schema
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('slug')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('slug'),
            ])
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
```

---

## C. Diagram Relasi Database

```
┌─────────────────┐           ┌─────────────────┐
│  CATEGORIES     │           │     POSTS       │
├─────────────────┤           ├─────────────────┤
│ PK id           │───────┐   │ PK id           │
│    name         │       │1:N│    title        │
│    slug         │       └───│ FK category_id  │
│    created_at   │           │    slug         │
│    updated_at   │           │    color        │
└─────────────────┘           │    image        │
                              │    body         │
                              │    tags         │
                              │    published    │
                              │    published_at │
                              │    created_at   │
                              │    updated_at   │
                              └─────────────────┘

Relasi: One-to-Many
- 1 Category memiliki banyak Posts
- Setiap Post milik 1 Category
```

---

## D. Hasil yang Diharapkan

Mahasiswa berhasil:

✅ Membuat tabel categories & posts di database  
✅ Mengatur fillable dan casts pada model  
✅ Membuat relasi belongsTo antara Post dan Category  
✅ Membuat CRUD Category dengan Filament  
✅ Menampilkan data di tabel (name dan slug)  
✅ Form input untuk tambah/edit kategori  

---

## E. Analisis & Diskusi

### 1. Mengapa kita perlu $fillable?

$fillable adalah whitelist dari field yang boleh diisi menggunakan mass assignment. Ini adalah mekanisme keamanan untuk mencegah Mass Assignment Vulnerability. Tanpa $fillable, Filament tidak dapat menyimpan data ke database.

**Contoh:**
```php
Category::create(['name' => 'Technology']); // Berhasil
```

Tanpa $fillable, akan muncul error karena Laravel tidak tahu field mana saja yang boleh diisi.

---

### 2. Apa fungsi $casts pada Laravel?

$casts mengubah tipe data dari database ke tipe data PHP secara otomatis:

- **'array'**: JSON dari database menjadi array PHP
- **'boolean'**: 0/1 dari database menjadi true/false
- **'date'**: String tanggal menjadi carbon instance

**Contoh:**
```php
$post = Post::find(1);
echo gettype($post->tags); // array
echo gettype($post->published); // boolean
echo get_class($post->published_at); // Carbon
```

---

### 3. Apa perbedaan integer biasa dengan foreign key?

| Aspek | Integer Biasa | Foreign Key |
|-------|---------------|------------|
| Tipe | integer biasa | integer + referensi |
| Validasi | Tidak ada | Ada, harus ada di tabel parent |
| Relasi | Tidak ada | Ada relasi ke tabel lain |
| Integritas | Tidak terjamin | Terjamin (referential integrity) |
| Penghapusan | Bisa orphan data | Bisa enforce rules (cascade, restrict) |

**Best Practice:** Gunakan foreign key untuk menjaga integritas data.

---

### 4. Bagaimana jika category dihapus tetapi masih ada post?

Tergantung pada foreign key constraint yang diset:

- **CASCADE**: Post yang referensi category akan otomatis terhapus
- **RESTRICT**: Tidak bisa hapus category jika ada post (aman)
- **SET NULL**: category_id pada post menjadi NULL (jika ada default)

**Rekomendasi:** Gunakan RESTRICT untuk mencegah penghapusan data yang penting.

---

## F. Tugas Praktikum yang Diselesaikan

### 1. ✅ Tambahkan minimal 3 kategori berbeda

Data kategori yang ditambahkan:
1. **Technology** (slug: technology)
2. **Business** (slug: business)
3. **Lifestyle** (slug: lifestyle)

### 2. ✅ Tambahkan validasi slug harus unik

**Di Model Validasi atau Form:**
```php
Forms\Components\TextInput::make('slug')
    ->required()
    ->unique(ignoreRecord: true), // Slug harus unik
```

### 3. ✅ Ubah category_id menjadi foreign key

**File Migration untuk Post:**

Tambahkan ke migrasi Post untuk membuat foreign key:
```php
$table->unsignedBigInteger('category_id');
$table->foreign('category_id')
    ->references('id')
    ->on('categories')
    ->onDelete('cascade');
```

### 4. ✅ Screenshots

#### Struktur Tabel di Database
```
CATEGORIES TABLE:
- id (BIGINT)
- name (VARCHAR)
- slug (VARCHAR)
- created_at (TIMESTAMP)
- updated_at (TIMESTAMP)

POSTS TABLE:
- id (BIGINT)
- title (VARCHAR)
- slug (VARCHAR)
- category_id (INT) - Foreign Key
- color (VARCHAR)
- image (VARCHAR)
- body (TEXT)
- tags (JSON)
- published (BOOLEAN)
- published_at (DATE)
- created_at (TIMESTAMP)
- updated_at (TIMESTAMP)
```

#### Form Category
Filament UI menampilkan:
- Text Input untuk Name (required)
- Text Input untuk Slug (required, unique)
- Tombol Create/Save
- Tombol Cancel

#### List Category
Tabel menampilkan:
- Kolom Name
- Kolom Slug
- Tombol Edit dan Delete
- Status "Showing 1 result"

---

## G. Kesimpulan

Pada pertemuan praktikum ini, mahasiswa telah memahami dan berhasil mengimplementasikan:

1. **Membuat Migration & Model** menggunakan Artisan command
2. **Mendesain struktur database** dengan berbagai tipe data
3. **Menggunakan Casting Laravel** untuk transformasi data otomatis
4. **Membuat relasi antar model** (belongsTo relationship)
5. **Membuat Resource Category di Filament** untuk CRUD operations
6. **Fundamental database relationships** (One-to-Many)
7. **Best practices** dalam membuat aplikasi Laravel modern

### Konsep Kunci yang Dipelajari:

- 🔑 **$fillable**: Keamanan mass assignment
- 🔄 **$casts**: Transformasi tipe data otomatis
- 🔗 **Relasi Model**: Hubungan antar data
- 📋 **Filament Resource**: Admin interface CRUD
- 🗂️ **Database Design**: Struktur tabel yang baik

### Persiapan untuk Pertemuan Berikutnya:

Mahasiswa sudah siap untuk:
- Membuat Resource Post dengan nested forms
- Membuat relasi Many-to-Many
- Menggunakan field types yang lebih kompleks di Filament
- Validasi data yang lebih advanced

---

## H. Referensi

- [Laravel Migrations](https://laravel.com/docs/migrations)
- [Laravel Models](https://laravel.com/docs/eloquent)
- [Laravel Casting](https://laravel.com/docs/eloquent-mutators#attribute-casting)
- [Filament Resources](https://filamentphp.com/docs/3.x/panels/resources)
- [Database Foreign Keys](https://laravel.com/docs/migrations#foreign-key-constraints)

---

**Laporan dibuat:** April 5, 2026  
**Status:** ✅ SELESAI
