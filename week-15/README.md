# LAPORAN PRAKTIKUM PERTEMUAN 15
## Implementasi Many-to-Many Relationship pada Filament

## Identitas Mahasiswa
**Nama:** Achmad Daud Roichan  
**NIM:** 244107020005  
**Kelas:** TI-2F  
**Semester:** 2026/2027  

---

**Mata Kuliah:** Pemrograman Web Lanjut  
**Pertemuan:** 15  
**Topik:** Implementasi Many-to-Many Relationship pada Filament  
**Tanggal Praktikum:** 2026  

---

## I. CAPAIAN PEMBELAJARAN

Setelah mengikuti praktikum ini, mahasiswa mampu:
- ✅ Memahami konsep Many-to-Many Relationship pada database.
- ✅ Membuat tabel relasi (pivot table) pada Laravel.
- ✅ Menghubungkan model menggunakan `belongsToMany`.
- ✅ Menggunakan multiple select relationship pada form Filament.
- ✅ Membuat Tag Resource pada Filament Admin Panel.
- ✅ Mengelola relasi menggunakan Relationship Manager.

---

## II. LATAR BELAKANG

Pada sistem blog, satu `Post` dapat memiliki banyak `Tag`, dan satu `Tag` dapat digunakan oleh banyak `Post`. Sebelumnya, tag disimpan dalam format JSON di dalam tabel posts. Namun, metode penyimpanan JSON memiliki kelemahan yaitu data sulit dimodifikasi, rawan terjadi duplikasi data, dan tidak efisien untuk query database yang kompleks.

Sebagai solusi, kita mengimplementasikan Many-to-Many Relationship dengan menggunakan pivot table (`post_tag`) untuk menghubungkan tabel `posts` dan `tags`. Di Filament, relasi ini dikelola menggunakan field `Select` berganda (`multiple`) dan `Relationship Manager` untuk mengaitkan (`attach`) dan memutuskan kaitan (`detach`) secara dinamis.

---

## III. IMPLEMENTASI MANY-TO-MANY RELATIONSHIP

### A. Migrasi Database (Tabel Pivot & Tags)

**File:** `database/migrations/2026_04_05_132754_create_posts_table.php`

**1. Schema Creation (`up` method):**
```php
public function up(): void
{
    Schema::create('posts', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('slug');
        $table->integer('category_id');
        $table->string('color')->nullable();
        $table->string('image')->nullable();
        $table->text('body')->nullable();
        $table->boolean('published')->default(false);
        $table->date('published_at')->nullable();
        $table->timestamps();
        
        $table->foreign('category_id')
            ->references('id')
            ->on('categories')
            ->onDelete('cascade');
    });

    Schema::create('tags', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->timestamps();
    });

    Schema::create('post_tag', function (Blueprint $table) {
        $table->foreignId('post_id')
            ->constrained()
            ->cascadeOnDelete();
        $table->foreignId('tag_id')
            ->constrained()
            ->cascadeOnDelete();
        $table->primary(['post_id','tag_id']);
    });
}
```

**2. Schema Destruction (`down` method):**
```php
public function down(): void
{
    Schema::dropIfExists('post_tag');
    Schema::dropIfExists('tags');
    Schema::dropIfExists('posts');
}
```

---

### B. Hubungan Relasi pada Model Eloquent

**1. Model Post (`app/Models/Post.php`)**
```php
public function tags()
{
    return $this->belongsToMany(Tag::class, 'post_tag');
}
```

**2. Model Tag (`app/Models/Tag.php`)**
```php
protected $fillable = [
    'name'
];

public function posts()
{
    return $this->belongsToMany(Post::class, 'post_tag');
}
```

---

### C. Implementasi Multiple Select pada Form Post

**File:** `app/Filament/Admin/Resources/Posts/Schemas/PostForm.php`

**Kode:**
```php
Select::make('tags')
    ->relationship('tags', 'name')
    ->multiple()
    ->preload()
    ->searchable(),
```

**Hasil:**
- Input tags pada form Post kini berupa multiple select dropdown.
- User dapat memilih banyak tag sekaligus.
- Pilihan tag tersimpan secara otomatis ke dalam tabel pivot `post_tag`.

---

### D. Konfigurasi Tag Resource & Redirect Halaman

**1. Skema Form Tag (`app/Filament/Admin/Resources/Tags/Schemas/TagForm.php`)**
```php
TextInput::make('name')
    ->required()
    ->maxLength(255),
```

**2. Tabel Tag (`app/Filament/Admin/Resources/Tags/Tables/TagsTable.php`)**
```php
TextColumn::make('name')
    ->searchable()
    ->sortable(),
```

**3. Redirect URL setelah Create & Edit (`app/Filament/Admin/Resources/Tags/Pages/CreateTag.php` & `EditTag.php`)**
```php
protected function getRedirectUrl(): string
{
    return $this->getResource()::getUrl('index');
}
```

---

### E. Tags Relationship Manager pada Post Resource

**1. Pembuatan Relation Manager**
```bash
php artisan make:filament-relation-manager PostResource tags name
```

**2. Registrasi di PostResource (`app/Filament/Admin/Resources/Posts/PostResource.php`)**
```php
use App\Filament\Admin\Resources\Posts\RelationManagers\TagsRelationManager;

public static function getRelations(): array
{
    return [
        TagsRelationManager::class,
    ];
}
```

---

## IV. DAFTAR ACTIONS & COMPONENT DI IMPLEMENTASIKAN

| No | Component/Action | Lokasi | Method | Fungsi |
|:--:|:----------------:|:------:|:------:|:------:|
| 1 | `Select` | `PostForm` | `multiple()` | Memungkinkan pemilihan lebih dari satu tag |
| 2 | `Select` | `PostForm` | `relationship('tags', 'name')` | Menghubungkan dropdown dengan relasi Many-to-Many |
| 3 | `TextColumn` | `PostsTable` | `tags.name` / `badge()` | Menampilkan nama-nama tag berelasi dalam bentuk badge |
| 4 | `AttachAction` | `TagsRelationManager` | `AttachAction::make()` | Mengaitkan tag yang sudah ada ke post |
| 5 | `DetachAction` | `TagsRelationManager` | `DetachAction::make()` | Memutuskan kaitan tag dari post tanpa menghapus tag tersebut |

---

## V. ANALISIS & DISKUSI

### 1. Apa perbedaan HasMany dan Many-to-Many?

**Jawaban:**
- **`HasMany` (One-to-Many)**:
  - Hubungan di mana satu record di tabel induk memiliki banyak record di tabel anak, namun record anak hanya boleh dimiliki oleh **satu** record induk.
  - Kunci asing (`foreign_key`) disimpan langsung pada tabel anak.
  - Contoh: Satu Kategori memiliki banyak Post. Post hanya memiliki satu Kategori.
- **`Many-to-Many`**:
  - Hubungan di mana satu record di tabel A memiliki banyak record di tabel B, dan sebaliknya satu record di tabel B memiliki banyak record di tabel A.
  - Hubungan ini **wajib** menggunakan tabel perantara (pivot table) untuk menyimpan pasangan foreign key kedua tabel.
  - Contoh: Satu Post memiliki banyak Tag, dan satu Tag memiliki banyak Post.

---

### 2. Mengapa pivot table diperlukan?

**Jawaban:**
- **Menghindari Redudansi dan Melakukan Normalisasi**: Tanpa pivot table, kita terpaksa menduplikasi data atau menyimpan data dalam format tidak terstruktur (seperti string JSON/CSV).
- **Efisiensi Relasi**: Pivot table bertindak sebagai jembatan yang menghubungkan ID dari kedua tabel utama tanpa mengganggu struktur internal dari kedua tabel tersebut. Hal ini membuat pencarian dan pemfilteran data menjadi jauh lebih cepat di tingkat database.

---

### 3. Apa fungsi attach dan detach pada Filament?

**Jawaban:**
- **`attach`**: Berfungsi untuk **menghubungkan** record yang sudah ada ke record saat ini (membuat baris baru di pivot table `post_tag`). Aksi ini tidak membuat data tag baru di tabel `tags`, melainkan hanya memasangkan `post_id` dan `tag_id`.
- **`detach`**: Berfungsi untuk **memutuskan hubungan** antara record (menghapus baris dari pivot table `post_tag`). Aksi ini hanya menghapus pasangan relasi saja, tanpa menghapus data record tag dari tabel `tags`.

---

### 4. Mengapa JSON column kurang baik untuk relasi?

**Jawaban:**
- **Performa Query Rendah**: Database harus melakukan scanning teks penuh (full text search) untuk mencari data relasional di dalam kolom JSON, yang sangat lambat dibanding indeks numerik biasa.
- **Integritas Data Lemah**: Tidak mendukung foreign key constraints, sehingga jika tag dihapus dari tabel utama, data tag di kolom JSON post tidak akan terhapus otomatis (menyebabkan data yatim/broken references).
- **Query Susah**: Logika SQL join menjadi sangat rumit ketika ingin mengambil semua post yang memiliki tag tertentu.

---

## VI. KESIMPULAN

Pada praktikum ini, kita telah berhasil bermigrasi dari penyimpanan tag format JSON ke Many-to-Many Relationship dengan tabel pivot `post_tag`. Implementasi ini meningkatkan integritas data dan performa aplikasi. Kita juga mengintegrasikan input select ganda dan Relationship Manager pada Filament untuk memudahkan admin melakukan attach/detach tag secara efisien.
