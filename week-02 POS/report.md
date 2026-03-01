# Laporan Praktikum Jobsheet 03 - PWL 2025/2026

## Identitas Mahasiswa
**Nama:** Achmad Daud Roichan  
**NIM:** 244107020005  
**Kelas:** TI-2F  
**Semester:** 2026/2027  

---

## Praktikum 2.1 - Pembuatan File Migrasi Tanpa Relasi

### Langkah-Langkah

1. Membuat file migrasi untuk tabel `m_level`
```bash
php artisan make:migration create_m_level_table
```

2. Modifikasi file migrasi, menambahkan kolom: `level_id`, `level_kode`, `level_nama`, `timestamps`

3. Membuat tabel `m_kategori` dengan cara yang sama

4. Menjalankan migrasi
```bash
php artisan migrate
```

### Screenshot Hasil:
![Hasil Migrasi](./img/praktikum2.1_migrate.png)

Hasil: ✅ Tabel `m_level` dan `m_kategori` berhasil dibuat di database

---

## Praktikum 2.2 - Pembuatan File Migrasi Dengan Relasi

### Langkah-Langkah

1. Membuat file migrasi untuk tabel `m_user` dengan foreign key ke `m_level`
```bash
php artisan make:migration create_m_user_table
```

2. Menambahkan foreign key constraint:
```php
$table->foreign('level_id')->references('level_id')->on('m_level');
```

3. Membuat tabel-tabel lainnya dengan relasi:
   - `m_barang` → foreign key ke `m_kategori`
   - `t_penjualan` → foreign key ke `m_user`
   - `t_penjualan_detail` → foreign key ke `t_penjualan` dan `m_barang`

4. Menjalankan migrasi
```bash
php artisan migrate
```

### Screenshot Hasil:
![Hasil Migrasi Relasi](./img/praktikum2.2_migrate_relasi.png)

Hasil: ✅ Semua tabel dengan relasi foreign key berhasil dibuat ✅ Relasi antar tabel terbentuk dengan benar

---

## Praktikum 2.3 - Membuat File Seeder

### Langkah-Langkah

1. Membuat file seeder:
```bash
php artisan make:seeder LevelSeeder
php artisan make:seeder KategoriSeeder
php artisan make:seeder UserSeeder
php artisan make:seeder BarangSeeder
php artisan make:seeder PenjualanSeeder
php artisan make:seeder PenjualanDetailSeeder
```

2. Mengisi data di setiap seeder menggunakan `DB::table()->insert()`

3. Mendaftarkan semua seeder di `DatabaseSeeder.php`

4. Menjalankan seeder:
```bash
php artisan db:seed
```

| No | Tabel | Jumlah Record | Keterangan |
|----|-------|---------------|------------|
| 1 | m_level | 3 | Administrator, Manager, Staff |
| 2 | m_kategori | 4 | Makanan, Minuman, Kebersihan, Kesehatan |
| 3 | m_user | 3 | admin, manager, staff1 |
| 4 | m_barang | 6 | 6 produk dari berbagai kategori |
| 5 | t_penjualan | 3 | 3 transaksi penjualan |
| 6 | t_penjualan_detail | 7 | 7 detail item transaksi |

### Screenshot Hasil:
![Hasil Seeder di DBeaver](./img/praktikum2.3_seeder.png)

Hasil: ✅ Semua seeder berhasil dibuat dan dijalankan

---

## Praktikum 4 - Implementasi DB Facade

### Langkah-Langkah

1. Membuat `LevelController`
```bash
php artisan make:controller LevelController
```

2. Menambahkan route
```php
Route::get('/level', [LevelController::class, 'index']);
```

3. Insert data dengan `DB::insert()`
```php
DB::insert(
    'insert into m_level(level_kode, level_nama) values(?, ?) ON CONFLICT (level_kode) DO NOTHING',
    ['CUS', 'Pelanggan']
);
```

4. Update data dengan `DB::update()`
```php
DB::update(
    'update m_level set level_nama = ? where level_kode = ?',
    ['Customer', 'CUS']
);
```

5. Select data dengan `DB::select()`
```php
$data = DB::select('select * from m_level');
return view('level.index', ['data' => $data]);
```

6. Membuat view `resources/views/level/index.blade.php`

### Screenshot Hasil:
![View Level - DB Facade](./img/praktikum4_level.png)

Hasil: ✅ Operasi INSERT, UPDATE berhasil dilakukan ✅ Data berhasil ditampilkan di view

---

## Praktikum 5 - Implementasi Query Builder

### Langkah-Langkah

1. Membuat `KategoriController`
```bash
php artisan make:controller KategoriController
```

2. Menambahkan route
```php
Route::get('/kategori', [KategoriController::class, 'index']);
```

3. Insert data
```php
DB::table('m_kategori')->insertOrIgnore([
    'kategori_kode' => 'OTH',
    'kategori_nama' => 'Lainnya',
]);
```

4. Update data
```php
DB::table('m_kategori')
    ->where('kategori_kode', 'OTH')
    ->update(['kategori_nama' => 'Produk Lainnya']);
```

5. Select data
```php
$data = DB::table('m_kategori')->get();
return view('kategori.index', ['data' => $data]);
```

6. Membuat view `resources/views/kategori/index.blade.php`

### Screenshot Hasil:
![View Kategori - Query Builder](./img/praktikum5_kategori.png)

Hasil: ✅ Operasi CRUD berhasil dilakukan dengan Query Builder ✅ Data berhasil ditampilkan di view

---

## Praktikum 6 - Implementasi Eloquent ORM

### Langkah-Langkah

1. Menggunakan `UserModel` yang sudah dibuat
```php
protected $table = 'm_user';
protected $primaryKey = 'user_id';
protected $fillable = ['level_id', 'username', 'nama_lengkap', 'password'];
```

2. Menambahkan route
```php
Route::get('/user', [UserController::class, 'index']);
```

3. Insert data dengan Eloquent
```php
UserModel::firstOrCreate(
    ['username' => 'staff2'],
    ['level_id' => 3, 'nama_lengkap' => 'Staff Kasir Dua', 'password' => Hash::make('password123')]
);
```

4. Update data dengan Eloquent
```php
UserModel::where('username', 'staff2')
    ->update(['nama_lengkap' => 'Staff Kasir 2']);
```

5. Select dengan relasi (Eager Loading)
```php
$data = UserModel::with('level')->get();
return view('user.index', ['data' => $data]);
```

6. Membuat view `resources/views/user/index.blade.php`

### Screenshot Hasil:
![View User - Eloquent ORM](./img/praktikum6_user.png)

Hasil: ✅ Data berhasil di-insert, update, dan ditampilkan menggunakan Eloquent ORM

---

## Konfigurasi Database

**Database:** PostgreSQL (DBeaver)  
**DB_CONNECTION:** pgsql  
**DB_HOST:** 127.0.0.1  
**DB_PORT:** 5432  
**DB_DATABASE:** PWL_POS  
**DB_USERNAME:** postgres  

> **Catatan:** Extension `pdo_pgsql` dan `pgsql` diaktifkan secara manual di `php.ini` Laragon karena tidak aktif secara default.

---

## Teknologi yang Digunakan

- **Framework:** Laravel 12
- **Language:** PHP 8.5.1
- **Database:** PostgreSQL 15 (via DBeaver)
- **PHP Extension:** pdo_pgsql, pgsql
- **Tools:** Laragon, DBeaver


---

## Jobsheet 03 - Migration, Model, dan Seeder

### Deskripsi
Praktikum ini membahas tentang penggunaan Laravel Migration untuk membuat struktur database, Eloquent Model untuk berinteraksi dengan tabel, dan Seeder untuk mengisi data awal.

---

### Praktikum 2.1 - Membuat Migration

Migration dibuat menggunakan perintah `php artisan make:migration`. Terdapat 6 tabel utama untuk sistem POS:

#### File Migration yang Dibuat:

| File | Tabel |
|------|-------|
| `2026_03_01_225050_create_m_level_table.php` | `m_level` |
| `2026_03_01_225051_create_m_kategori_table.php` | `m_kategori` |
| `2026_03_01_225051_create_m_user_table.php` | `m_user` |
| `2026_03_01_225052_create_m_barang_table.php` | `m_barang` |
| `2026_03_01_225052_create_t_penjualan_table.php` | `t_penjualan` |
| `2026_03_01_225053_create_t_penjualan_detail_table.php` | `t_penjualan_detail` |

#### Struktur Tabel:

**m_level**
```php
$table->id('level_id');
$table->string('level_kode', 10)->unique();
$table->string('level_nama', 100);
$table->timestamps();
```

**m_kategori**
```php
$table->id('kategori_id');
$table->string('kategori_kode', 10)->unique();
$table->string('kategori_nama', 100);
$table->timestamps();
```

**m_user**
```php
$table->id('user_id');
$table->unsignedBigInteger('level_id');
$table->string('username', 20)->unique();
$table->string('nama_lengkap', 100);
$table->string('password');
$table->text('data_lengkap')->nullable();
$table->timestamps();
$table->foreign('level_id')->references('level_id')->on('m_level');
```

**m_barang**
```php
$table->id('barang_id');
$table->unsignedBigInteger('kategori_id');
$table->string('barang_kode', 20)->unique();
$table->string('barang_nama', 100);
$table->decimal('harga_beli', 10, 2);
$table->decimal('harga_jual', 10, 2);
$table->timestamps();
$table->foreign('kategori_id')->references('kategori_id')->on('m_kategori');
```

**t_penjualan**
```php
$table->id('penjualan_id');
$table->unsignedBigInteger('user_id');
$table->string('penjualan_kode', 20)->unique();
$table->string('pembeli', 50);
$table->dateTime('penjualan_tanggal');
$table->timestamps();
$table->foreign('user_id')->references('user_id')->on('m_user');
```

**t_penjualan_detail**
```php
$table->id('detail_id');
$table->unsignedBigInteger('penjualan_id');
$table->unsignedBigInteger('barang_id');
$table->decimal('harga', 10, 2);
$table->integer('jumlah');
$table->timestamps();
$table->foreign('penjualan_id')->references('penjualan_id')->on('t_penjualan');
$table->foreign('barang_id')->references('barang_id')->on('m_barang');
```

#### Menjalankan Migration:
```bash
php artisan migrate
```

#### Screenshot Hasil:
![php artisan migrate](./img/praktikum2.1_migrate.png)

---

### Praktikum 2.2 - Membuat Model

Model dibuat menggunakan perintah `php artisan make:model`. Setiap model dikonfigurasi dengan `$table`, `$primaryKey`, `$fillable`, dan relasi antar tabel.

#### Model yang Dibuat:

| Model | Tabel | Primary Key |
|-------|-------|-------------|
| `LevelModel` | `m_level` | `level_id` |
| `KategoriModel` | `m_kategori` | `kategori_id` |
| `UserModel` | `m_user` | `user_id` |
| `BarangModel` | `m_barang` | `barang_id` |
| `PenjualanModel` | `t_penjualan` | `penjualan_id` |
| `PenjualanDetailModel` | `t_penjualan_detail` | `detail_id` |

#### Relasi Antar Model:
- `LevelModel` → `hasMany` UserModel
- `KategoriModel` → `hasMany` BarangModel
- `UserModel` → `belongsTo` LevelModel, `hasMany` PenjualanModel
- `BarangModel` → `belongsTo` KategoriModel, `hasMany` PenjualanDetailModel
- `PenjualanModel` → `belongsTo` UserModel, `hasMany` PenjualanDetailModel
- `PenjualanDetailModel` → `belongsTo` PenjualanModel, `belongsTo` BarangModel

#### Screenshot Hasil:
![Model UserModel.php](./img/praktikum2.2_model.png)

---

### Praktikum 2.3 - Membuat Seeder

Seeder dibuat menggunakan perintah `php artisan make:seeder`. Data awal diisi menggunakan `DB::table()->insert()`.

#### Seeder yang Dibuat:

| Seeder | Data |
|--------|------|
| `LevelSeeder` | 3 level (Administrator, Manager, Staff) |
| `KategoriSeeder` | 4 kategori (Makanan, Minuman, Kebersihan, Kesehatan) |
| `UserSeeder` | 3 user (admin, manager, staff1) |
| `BarangSeeder` | 6 barang dari berbagai kategori |
| `PenjualanSeeder` | 3 transaksi penjualan |
| `PenjualanDetailSeeder` | 7 detail item transaksi |

#### Menjalankan Seeder:
```bash
php artisan db:seed
```

#### Hasil di Database (PostgreSQL - DBeaver):

| Tabel | Jumlah Record |
|-------|---------------|
| m_level | 3 |
| m_kategori | 4 |
| m_user | 3 |
| m_barang | 6 |
| t_penjualan | 3 |
| t_penjualan_detail | 7 |

#### Screenshot Hasil:
![DBeaver tabel POS](./img/praktikum2.3_seeder.png)

---

## Konfigurasi Database

**Database:** PostgreSQL (DBeaver)  
**DB_CONNECTION:** pgsql  
**DB_HOST:** 127.0.0.1  
**DB_PORT:** 5432  
**DB_DATABASE:** PWL_POS  
**DB_USERNAME:** postgres  

> **Catatan:** Extension `pdo_pgsql` dan `pgsql` diaktifkan secara manual di `php.ini` Laragon karena tidak aktif secara default.

---

## Struktur File yang Dibuat/Dimodifikasi

```
database/
├── migrations/
│   ├── 2026_03_01_225050_create_m_level_table.php
│   ├── 2026_03_01_225051_create_m_kategori_table.php
│   ├── 2026_03_01_225051_create_m_user_table.php
│   ├── 2026_03_01_225052_create_m_barang_table.php
│   ├── 2026_03_01_225052_create_t_penjualan_table.php
│   └── 2026_03_01_225053_create_t_penjualan_detail_table.php
└── seeders/
    ├── DatabaseSeeder.php      (dimodifikasi)
    ├── LevelSeeder.php
    ├── KategoriSeeder.php
    ├── UserSeeder.php
    ├── BarangSeeder.php
    ├── PenjualanSeeder.php
    └── PenjualanDetailSeeder.php
app/Models/
    ├── LevelModel.php
    ├── KategoriModel.php
    ├── UserModel.php
    ├── BarangModel.php
    ├── PenjualanModel.php
    └── PenjualanDetailModel.php
```

---

## Teknologi yang Digunakan

- **Framework:** Laravel 12
- **Language:** PHP 8.5.1
- **Database:** PostgreSQL 15 (via DBeaver)
- **PHP Extension:** pdo_pgsql, pgsql
- **Tools:** Laragon, DBeaver
