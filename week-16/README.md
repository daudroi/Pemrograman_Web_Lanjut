# LAPORAN PRAKTIKUM PERTEMUAN 16
## Implementasi RESTful API & Token Authentication dengan Laravel Sanctum

## Identitas Mahasiswa
**Nama:** Achmad Daud Roichan  
**NIM:** 244107020005  
**Kelas:** TI-2F  
**Semester:** 2026/2027  

---

**Mata Kuliah:** Pemrograman Web Lanjut  
**Pertemuan:** 16  
**Topik:** RESTful API & Token Authentication  
**Tanggal Praktikum:** 2026  

---

## I. CAPAIAN PEMBELAJARAN

Setelah mengikuti praktikum ini, mahasiswa mampu:
- ✅ Memahami konsep dasar RESTful API (Stateless, HTTP Methods, JSON Response).
- ✅ Mengimplementasikan autentikasi berbasis Token menggunakan Laravel Sanctum.
- ✅ Membangun fitur Registrasi, Login, dan Logout API.
- ✅ Membangun CRUD API untuk resource Todo dengan perlindungan hak akses (Authorization).
- ✅ Mengatur penanganan Exception global khusus request API agar tetap mengembalikan format JSON.

---

## II. LATAR BELAKANG

RESTful API (Representational State Transfer) adalah arsitektur layanan web yang menggunakan protokol HTTP untuk bertukar data secara *stateless*. Berbeda dengan aplikasi web berbasis session/cookie, API menggunakan token (Personal Access Token) yang dikirimkan pada header HTTP (`Authorization: Bearer <token>`) sebagai penanda identitas pengguna.

Pada praktikum ini, kita membangun RESTful API untuk aplikasi Todo List sederhana yang dilengkapi dengan sistem otentikasi Sanctum dan otorisasi kepemilikan resource, sehingga pengguna hanya dapat mengelola data Todo milik mereka sendiri.

---

## III. IMPLEMENTASI RESTful API & SANCTUM

### A. Pengaturan Trait HasApiTokens pada Model User

**File:** `app/Models/User.php`

**Kode:**
```php
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    // ...
}
```

---

### B. Trait Standarisasi Response API

**File:** `app/Traits/ApiResponse.php`

**Kode:**
```php
<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    protected function success($data = null, string $message = null, int $code = 200): JsonResponse
    {
        return response()->json([
            'status' => 'Success',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function error(string $message = null, int $code = 400, $errors = null): JsonResponse
    {
        return response()->json([
            'status' => 'Error',
            'message' => $message,
            'errors' => $errors
        ], $code);
    }
}
```

---

### C. Pembuatan AuthController & Kustomisasi Request

**1. RegisterRequest (`app/Http/Requests/RegisterRequest.php`)**
```php
class RegisterRequest extends ApiRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
}
```

**2. LoginRequest (`app/Http/Requests/LoginRequest.php`)**
```php
class LoginRequest extends ApiRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ];
    }
}
```

**3. AuthController (`app/Http/Controllers/Api/AuthController.php`)**
```php
class AuthController extends Controller
{
    use ApiResponse;

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->success([
            'user' => $user,
            'token' => $token,
        ], 'User registered successfully', 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->error('Credentials do not match', 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->success([
            'user' => $user,
            'token' => $token,
        ], 'Login successful');
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return $this->success(null, 'Tokens revoked');
    }
}
```

---

### D. Penanganan Exception & Route API

**1. Penanganan Global Exception (`bootstrap/app.php`)**
```php
->withExceptions(function (Exceptions $exceptions): void {
    $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e, \Illuminate\Http\Request $request) {
        if ($request->is('api/*')) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Resource not found'
            ], 404);
        }
    });
})
```

**2. Route API (`routes/api.php`)**
```php
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('todos', TodoController::class);
});
```

---

### E. CRUD Resource Todo

**1. Model Todo (`app/Models/Todo.php`)**
```php
class Todo extends Model
{
    protected $fillable = ['user_id', 'todo', 'done'];
    protected $hidden = ['user_id'];
    protected $casts = ['done' => 'boolean'];

    public function user() { return $this->belongsTo(User::class); }
}
```

**2. Validation Request (`app/Http/Requests/TodoRequest.php`)**
```php
class TodoRequest extends ApiRequest
{
    public function authorize(): bool
    {
        if ($this->isMethod('post')) {
            return true;
        }

        $todo = $this->route('todo');
        return $todo && $todo->user_id === $this->user()->id;
    }

    public function rules(): array
    {
        return [
            'todo' => 'required|string|max:255',
            'done' => 'sometimes|boolean',
        ];
    }
}
```

**3. TodoController (`app/Http/Controllers/Api/TodoController.php`)**
```php
class TodoController extends Controller
{
    use ApiResponse;

    public function index(Request $request): JsonResponse
    {
        return $this->success($request->user()->todos);
    }

    public function store(TodoRequest $request): JsonResponse
    {
        $todo = $request->user()->todos()->create($request->validated());
        return $this->success($todo, 'Todo created successfully', 201);
    }

    public function show(Todo $todo): JsonResponse
    {
        if ($todo->user_id !== auth()->id()) {
            return $this->error('Unauthorized', 403);
        }
        return $this->success($todo);
    }

    public function update(TodoRequest $request, Todo $todo): JsonResponse
    {
        $todo->update($request->validated());
        return $this->success($todo, 'Todo updated successfully');
    }

    public function destroy(TodoRequest $request, Todo $todo): JsonResponse
    {
        $todo->delete();
        return $this->success(null, 'Todo deleted successfully');
    }
}
```

---

## IV. DAFTAR ENDPOINT API YANG DIIMPLEMENTASIKAN

| No | Endpoint | HTTP Method | Middleware | Deskripsi |
|:--:|:--------:|:-----------:|:----------:|:---------:|
| 1 | `/api/register` | `POST` | *None* | Mendaftarkan akun user baru & mengembalikan token |
| 2 | `/api/login` | `POST` | *None* | Login & mengembalikan token autentikasi baru |
| 3 | `/api/logout` | `POST` | `auth:sanctum` | Menghapus current token (Logout) |
| 4 | `/api/user` | `GET` | `auth:sanctum` | Mengambil info profil user yang sedang login |
| 5 | `/api/todos` | `GET` | `auth:sanctum` | Mendapatkan daftar seluruh todo milik user |
| 6 | `/api/todos` | `POST` | `auth:sanctum` | Membuat data todo baru |
| 7 | `/api/todos/{id}` | `GET` | `auth:sanctum` | Mengambil detail todo spesifik |
| 8 | `/api/todos/{id}` | `PUT/PATCH` | `auth:sanctum` | Memperbarui data todo spesifik |
| 9 | `/api/todos/{id}` | `DELETE` | `auth:sanctum` | Menghapus data todo spesifik |

---

## V. ANALISIS & DISKUSI

### 1. Jelaskan konsep stateless pada RESTful API!

**Jawaban:**
Konsep *stateless* berarti setiap request HTTP yang dikirim oleh klien ke server harus berdiri sendiri dan memuat seluruh informasi yang diperlukan agar server dapat memproses request tersebut. Server **tidak menyimpan state/informasi session** tentang klien di memorinya. Jika klien ingin mengakses halaman terproteksi, klien harus mengirimkan token autentikasi pada header setiap kali mengirim request.

---

### 2. Mengapa token digunakan untuk menggantikan session pada API?

**Jawaban:**
- **Skalabilitas**: Pada arsitektur multi-server/microservices, data session yang disimpan di satu server lokal tidak akan dikenali oleh server lain tanpa integrasi database session terpusat (seperti Redis). Token yang disimpan di sisi klien (biasanya di LocalStorage/cookie) membuat server bebas dari beban manajemen memori session.
- **Cross-Platform Compatibility**: Mobile apps (iOS/Android), IoT devices, dan Single Page Applications (SPA) tidak memiliki mekanisme penanganan browser cookie/session secara default seperti web tradisional. Penggunaan token mempermudah autentikasi multi-platform karena token hanya berupa string teks biasa yang mudah dikirim via header request.

---

### 3. Sebutkan HTTP method yang umum digunakan pada RESTful API beserta fungsinya!

**Jawaban:**
- **GET**: Meminta/mengambil data dari resource tertentu (Read).
- **POST**: Mengirimkan data baru ke server untuk membuat resource baru (Create).
- **PUT**: Memperbarui seluruh data resource yang sudah ada secara menyeluruh (Update/Replace).
- **PATCH**: Memperbarui sebagian kecil field dari resource yang sudah ada (Partial Update).
- **DELETE**: Menghapus resource tertentu dari database (Delete).

---

### 4. Jelaskan fungsi dari middleware `auth:sanctum` pada route!

**Jawaban:**
Middleware `auth:sanctum` bertindak sebagai penjaga gerbang (guard) pada route API. Fungsinya adalah memverifikasi string token yang dikirim oleh klien pada header HTTP request (`Authorization: Bearer <token>`). Jika token valid dan terdaftar di database, request akan diteruskan ke controller dan user yang terautentikasi dapat diakses menggunakan method `$request->user()`. Jika token tidak ada atau tidak valid, request akan langsung dibatalkan dengan respon error HTTP 401 (Unauthorized).

---

## VI. KESIMPULAN

Pada praktikum ini, kita telah mempelajari dan mengimplementasikan pembangunan RESTful API yang aman dengan menggunakan Laravel Sanctum. Kita berhasil memisahkan proses validasi ke Form Request (`ApiRequest`), mengelola otentikasi (register, login, logout), serta merancang operasi CRUD terproteksi pada resource Todo dengan response standar JSON yang aman dan konsisten.
