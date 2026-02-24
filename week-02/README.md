# LAPORAN PRAKTIKUM PEMROGRAMAN WEB LANJUT (PWL) - WEEK 2

**Nama:** Achmad Daud Roichan  
**NIM:** 244107020005  
**Kelas:** TI-2F  
**Semester:** 2026/2027

---

## Daftar Isi
- [Praktikum 1 - Routing](#praktikum-1---routing)
- [Praktikum 2 - Controller](#praktikum-2---controller)
- [Praktikum 3 - View](#praktikum-3---view)

---

## Praktikum 1 - Routing

```php
Route::get('/user/{name}', function ($name) {
    return 'Nama saya ' . $name;
});
```

**Screenshot:**  
![Route Parameters](/img/user-parameter.png)

**Pengamatan:** Parameter berhasil ditangkap dari URL.

---

### Route Posts Comments

```php
Route::get('/posts/{post}/comments/{comment}', function ($postId, $commentId) {
    return 'Pos ke-' . $postId . " Komentar ke-: " . $commentId;
});
```

**Screenshot:**  
![Route Posts Comments](/img/posts-comments.png)

**Pengamatan:** Route dapat menangkap multiple parameter dari URL.

---

### Membuat Route Articles dengan ID

```php
Route::get('/articles/{id}', function ($id) {
    return 'Halaman Artikel dengan ID ' . $id;
});
```

**Screenshot:**  
![Route Articles](/img/articles.png)

**Pengamatan:** Route dapat menampilkan halaman artikel sesuai dengan ID yang dikirim.

---

### Optional Parameters

```php
Route::get('/user/{name?}', function ($name = null) {
    return 'Nama saya ' . $name;
});
```

**Screenshot:**  
![Optional Parameters](/img/optional-parameter.png)

**Pengamatan:** Route dapat diakses dengan atau tanpa parameter.

---

### Route Names & Redirect

```php
Route::get('/user/profile', function () {
    return 'Halaman Profile User';
})->name('profile');

Route::redirect('/here', '/about');
```

**Screenshot About Route:**  
![About Route](/img/about.png)

**Pengamatan:** Named routes mempermudah referensi, redirect routes mengarahkan ke URL lain.

---

### View Routes

```php
Route::view('/welcome', 'welcome');
```

**Pengamatan:** View routes menampilkan view langsung tanpa controller.

---

## Praktikum 2 - Controller

### PageController - Modifikasi Route dengan Controller

```php
class PageController extends Controller
{
    public function index() {
        return 'Selamat Datang';
    }

    public function about() {
        return 'Nama : Achmad Daud Roichan <br> NIM : 244107020005 <br> Kelas : TI-2F';
    }

    public function articles($id) {
        return 'Halaman Artikel dengan ID ' . $id;
    }
}
```

**Pengamatan:** Menggunakan controller membuat route lebih terorganisir.

---

### Single Action Controllers

```php
class HomeController extends Controller
{
    public function index() {
        return 'Selamat Datang';
    }
}

class AboutController extends Controller
{
    public function about() {
        return 'Nama : Achmad Daud Roichan <br> NIM : 244107020005 <br> Kelas : TI-2F';
    }
}

class ArticleController extends Controller
{
    public function articles($id) {
        return 'Halaman Artikel dengan ID ' . $id;
    }
}
```

**Pengamatan:** Single Action Controller membuat kode lebih modular.

---

### Resource Controller - PhotoController

```bash
php artisan make:controller PhotoController --resource
```

**Methods yang di-generate:**
- `index()`, `create()`, `store()`, `show()`, `edit()`, `update()`, `destroy()`

```php
Route::resource('photos', PhotoController::class);
```

**Pengamatan:** Resource controller otomatis membuat 7 routes untuk CRUD.

#### Route Resource dengan Only

```php
Route::resource('photos', PhotoController::class)->only(['index', 'show']);
```

#### Route Resource dengan Except

```php
Route::resource('photos', PhotoController::class)->except(['create', 'store', 'update', 'destroy']);
```

---

## Praktikum 3 - View

### Membuat View hello.blade.php

```html
<html>
<body>
    <h1>Hello, {{ $name }}</h1>
</body>
</html>
```

**Pengamatan:** File view menggunakan sintaks Blade untuk menampilkan variabel.

---

### Menampilkan View melalui Route

```php
Route::get('/greeting', function () {
    return view('hello', ['name' => 'Andi']);
});
```

**Pengamatan:** Helper function `view()` digunakan untuk menampilkan view dengan data.

---

### View dalam Direktori

```php
Route::get('/greeting', function () {
    return view('blog.hello', ['name' => 'Andi']);
});
```

**Pengamatan:** Dot notation digunakan untuk mereferensikan file view dalam subdirectory.

---

### Menampilkan View dari Controller

```php
class WelcomeController extends Controller
{
    public function greeting() {
        return view('blog.hello', ['name' => 'Andi']);
    }
}
```

```php
Route::get('/greeting', [WelcomeController::class, 'greeting']);
```

**Pengamatan:** Logika view dapat dipisahkan ke controller untuk organisasi kode yang lebih baik.

---

### Meneruskan Data ke View dengan Method with()

```php
public function greeting() {
    return view('blog.hello')
        ->with('name', 'Andi')
        ->with('occupation', 'Astronaut');
}
```

```html
<html>
<body>
    <h1>Hello, {{ $name }}</h1>
    <h1>You are {{ $occupation }}</h1>
</body>
</html>
```

**Screenshot:**  
![Greeting Route](/img/greeting.png)

**Pengamatan:** Method `with()` memungkinkan passing data ke view dengan cara yang lebih readable.

---

## Kesimpulan

Praktikum week 2 telah mempelajari:

✅ **Routing:** Parameter, multiple parameters, optional parameters, named routes, redirect, view routes

✅ **Controller:** Controller dasar, single action controllers, resource controllers

✅ **View:** View files, view dalam direktori, view dari controller, passing data ke view

---

**Status:** ✅ Selesai  
**Tanggal:** 24 Februari 2026

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
