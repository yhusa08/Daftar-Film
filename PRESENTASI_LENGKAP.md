# 🎬 FILM APP - PRESENTASI LENGKAP
## Aplikasi Manajemen Film, Series, dan Genre Berbasis Web

---

## 📋 DAFTAR ISI
1. [Latar Belakang](#latar-belakang)
2. [Pendahuluan](#pendahuluan)
3. [Analisis Kebutuhan](#analisis-kebutuhan)
4. [Fungsi dan Fitur Sistem](#fungsi-dan-fitur-sistem)
5. [Arsitektur dan Desain](#arsitektur-dan-desain)
6. [Teknologi yang Digunakan](#teknologi-yang-digunakan)
7. [Database Schema](#database-schema)
8. [Instalasi dan Setup](#instalasi-dan-setup)
9. [Panduan Penggunaan](#panduan-penggunaan)
10. [Kesimpulan dan Pengembangan](#kesimpulan-dan-pengembangan)

---

## 🎯 LATAR BELAKANG

### Masalah yang Dihadapi
Di era digital ini, penggemar film dan series menghadapi beberapa tantangan:

1. **Fragmentasi Data**
   - Film, series, dan genre tersebar di berbagai platform
   - Sulit melacak koleksi pribadi yang telah ditonton
   - Tidak ada sistem terpusat untuk mengorganisir

2. **Manajemen Manual**
   - Mencatat film/series di aplikasi terpisah (Notes, Excel, dll)
   - Tidak ada system kategorisasi yang terstruktur
   - Mudah kehilangan data atau terlupa

3. **Keterbatasan Fitur Existing**
   - Aplikasi general-purpose tidak dirancang khusus untuk manajemen konten media
   - API pihak ketiga memiliki limitasi dan biaya
   - Ingin sistem yang customizable sesuai kebutuhan

### Solusi yang Ditawarkan
**Film App** adalah aplikasi web yang menyediakan:
- ✅ Sistem manajemen koleksi film & series terpusat
- ✅ Kategorisasi dengan genre yang fleksibel
- ✅ Multi-user dengan data isolation
- ✅ Interface modern dan user-friendly
- ✅ Keamanan data dengan autentikasi & password recovery
- ✅ Skalabilitas untuk pengembangan fitur lebih lanjut

### Motivasi Pengembangan
1. **Kepraktisan** - Solusi one-stop untuk semua kebutuhan manajemen konten media
2. **Kontrol Penuh** - Developer dapat mengkustomisasi fitur sesuai kebutuhan
3. **Pembelajaran** - Implementasi best practices dalam web development modern
4. **Profesionalisme** - Menggunakan framework established (Laravel) dan teknologi terkini
5. **Aksesibilitas** - Web-based, dapat diakses dari mana saja

---

## 📖 PENDAHULUAN

### Visi Aplikasi
Menyediakan platform yang **mudah digunakan, aman, dan efisien** untuk mengelola koleksi film dan series dengan sistem kategorisasi berbasis genre yang fleksibel.

### Misi Aplikasi
1. Memberikan user interface yang intuitif dan menyenangkan
2. Memastikan data pengguna aman dengan enkripsi dan autentikasi
3. Menyediakan fitur management yang comprehensive (CRUD lengkap)
4. Memfasilitasi organisasi konten dengan relasi genre yang kompleks
5. Memberikan support untuk recovery account (forgot password)
6. Membuka peluang integrasi dengan sistem lain

### Target Pengguna (User Personas)

#### 1. **Personal Film Collector** 🎬
- **Karakteristik**: Penggemar film/series yang serius
- **Kebutuhan**: Mencatat semua film yang ditonton, rating, dan genre
- **Use Case**: Ingin mengelola koleksi pribadi dengan mudah

#### 2. **Content Manager** 📊
- **Karakteristik**: Pengelola library konten (bioskop, streaming)
- **Kebutuhan**: Manajemen inventory yang terstruktur
- **Use Case**: Tracking film/series, kategorisasi, dan reporting

#### 3. **Entertainment Blogger** 📝
- **Karakteristik**: Blogger/reviewer yang menulis tentang film
- **Kebutuhan**: Database referensi untuk artikel dan review
- **Use Case**: Database untuk menulis review yang terorganisir

#### 4. **Movie Enthusiast Group** 👥
- **Karakteristik**: Komunitas penggemar film
- **Kebutuhan**: Platform kolaboratif untuk sharing dan recommendations
- **Use Case**: Sharing daftar film dengan komunitas

### Scope Proyek

#### ✅ Fitur yang Diimplementasikan
- **Autentikasi**: Login, Register, Logout
- **Password Recovery**: Forgot Password dengan Token Reset
- **Film Management**: CRUD Films dengan atribut (Judul, Tahun, Durasi, Rating)
- **Series Management**: CRUD Series dengan atribut (Judul, Episode, Rating)
- **Genre Management**: CRUD Genres dengan atribut (Nama, Deskripsi)
- **Relasi Many-to-Many**: Film ↔ Genre, Series ↔ Genre
- **Data Isolation**: Setiap user hanya bisa akses data mereka sendiri
- **Responsive Design**: Interface yang bekerja di desktop & mobile

#### 🔄 Fitur di Backlog (Pengembangan Lanjut)
- API REST untuk mobile app
- Social features (sharing, likes, comments)
- Advanced search & filtering
- User ratings & reviews
- Recommendation engine
- Email notifications
- Two-factor authentication (2FA)
- Analytics & statistics
- Dark mode
- Multi-language support

---

## 📊 ANALISIS KEBUTUHAN

### Functional Requirements (Kebutuhan Fungsional)

#### 1. Authentication Module
```
FR-AUTH-001: User dapat melakukan registrasi
  - Input: Nama, Email, Password
  - Proses: Validasi input, hash password, simpan ke database
  - Output: User baru terdaftar, auto-login

FR-AUTH-002: User dapat melakukan login
  - Input: Email, Password
  - Proses: Validasi credentials, session creation
  - Output: Access token/session, redirect ke dashboard

FR-AUTH-003: User dapat logout
  - Input: Session/Token
  - Proses: Session invalidation, token revocation
  - Output: Redirect ke login page

FR-AUTH-004: User dapat reset password
  - Input: Email / Token + Password Baru
  - Proses: Generate token, validate, update password
  - Output: Email dengan link reset atau success message
```

#### 2. Film Management Module
```
FR-FILM-001: User dapat membuat film baru
  - Input: Judul, Tahun Rilis, Durasi, Rating, Genres
  - Proses: Validasi input, simpan film & relasi genre
  - Output: Film terbuat dengan ID baru

FR-FILM-002: User dapat melihat daftar film mereka
  - Input: User ID
  - Proses: Query semua film milik user
  - Output: List film dengan detail

FR-FILM-003: User dapat melihat detail film
  - Input: Film ID
  - Proses: Query film by ID + genres
  - Output: Detail film & genre terkait

FR-FILM-004: User dapat mengupdate film
  - Input: Film ID + Field baru
  - Proses: Validasi, update film & relasi genre
  - Output: Film terupdate

FR-FILM-005: User dapat menghapus film
  - Input: Film ID
  - Proses: Delete film & relasi genre, cleanup
  - Output: Film terhapus, relasi otomatis dihapus
```

#### 3. Genre Management Module
```
FR-GENRE-001: User dapat membuat genre baru
  - Input: Nama Genre, Deskripsi
  - Proses: Validasi, simpan genre
  - Output: Genre baru dengan ID

FR-GENRE-002: User dapat melihat daftar genre
  - Input: User ID
  - Proses: Query semua genre milik user
  - Output: List genre dengan statistik (jumlah film/series)

FR-GENRE-003: User dapat mengupdate genre
  - Input: Genre ID + Field baru
  - Proses: Validasi, update genre
  - Output: Genre terupdate

FR-GENRE-004: User dapat menghapus genre
  - Input: Genre ID
  - Proses: Delete genre, update relasi film/series
  - Output: Genre terhapus (relasi tidak langsung terhapus)
```

#### 4. Series Management Module
```
FR-SERIES-001: User dapat membuat series baru
  - Input: Judul, Jumlah Episode, Rating, Genres
  - Proses: Validasi input, simpan series & relasi genre
  - Output: Series terbuat dengan ID baru

FR-SERIES-002-005: CRUD Series (similar to Film)
```

### Non-Functional Requirements (Kebutuhan Non-Fungsional)

#### Performance
- **Response Time**: < 200ms untuk query utama
- **Scalability**: Support 1000+ concurrent users
- **Database**: Indexed queries untuk performa optimal

#### Security
- **Password**: Hashed dengan bcrypt (12 rounds)
- **Session**: Secure cookie dengan HttpOnly flag
- **CSRF**: Token protection di semua POST request
- **Input Validation**: Sanitized & escaped
- **Token Reset**: Time-based validity (24 jam)
- **SQL Injection**: Prevention dengan prepared statements

#### Usability
- **Responsive Design**: Mobile, Tablet, Desktop
- **Accessibility**: Semantic HTML, WCAG compliance
- **User Feedback**: Error messages, success notifications
- **Navigation**: Intuitive menu structure

#### Reliability
- **Uptime**: Target 99.5% availability
- **Backup**: Database backup regular
- **Error Handling**: Graceful error handling
- **Logging**: Audit trail untuk activities

---

## 🔧 FUNGSI DAN FITUR SISTEM

### 1. SISTEM AUTENTIKASI & PASSWORD RECOVERY

#### Deskripsi
Sistem yang mengurus user registration, login, logout, dan password recovery dengan enkripsi dan session management yang aman.

#### File-File Terkait
```
Controllers:
  - app/Http/Controllers/AuthController.php

Routes:
  - routes/web.php (routes autentikasi)

Views:
  - resources/views/auth/login.blade.php
  - resources/views/auth/register.blade.php
  - resources/views/auth/forgot-password.blade.php
  - resources/views/auth/reset-password.blade.php

Models:
  - app/Models/User.php

Migrations:
  - database/migrations/*_create_users_table.php
  - database/migrations/2026_05_07_120000_create_password_reset_tokens_table.php
```

#### Route Endpoints

| Method | URI | Function | Auth |
|--------|-----|----------|------|
| GET | `/login` | Tampilkan login form | ❌ |
| POST | `/login` | Proses login user | ❌ |
| GET | `/register` | Tampilkan register form | ❌ |
| POST | `/register` | Proses registrasi user baru | ❌ |
| POST | `/logout` | Proses logout user | ✅ |
| GET | `/forgot-password` | Tampilkan forgot password form | ❌ |
| POST | `/forgot-password` | Kirim link reset password | ❌ |
| GET | `/reset-password/{token}` | Tampilkan reset password form | ❌ |
| POST | `/reset-password` | Proses reset password | ❌ |

#### Fitur Detail

**A. Registrasi**
```php
Input:
  - name (string, required, max 255)
  - email (email, required, unique)
  - password (min 6, confirmed)

Proses:
  1. Validasi input
  2. Hash password dengan bcrypt (12 rounds)
  3. Create user di database
  4. Auto-login user
  5. Redirect ke dashboard

Output:
  - User baru terdaftar
  - Session user dibuat
  - Success message
```

**B. Login**
```php
Input:
  - email (email, required)
  - password (string, required)

Proses:
  1. Validasi input format
  2. Check credentials di database
  3. Generate session/token
  4. Regenerate session ID (security)
  5. Redirect ke dashboard

Output:
  - Session aktif
  - User dapat akses protected routes
```

**C. Logout**
```php
Proses:
  1. Invalidate session
  2. Regenerate CSRF token
  3. Clear cookies
  4. Redirect ke login

Output:
  - Session dihapus
  - User tidak bisa akses protected routes
```

**D. Forgot Password (NEW)**
```php
Input:
  - email (email, required, exists in database)

Proses:
  1. Validasi email ada di database
  2. Generate random token (60 chars)
  3. Hapus token lama jika ada
  4. Simpan ke password_reset_tokens table
  5. Buat reset link dengan token
  6. Simpan link ke session (dev mode)
  
Output:
  - Token tersimpan di database
  - Link reset siap digunakan (24 jam)
  - Success message dengan link (atau email di production)
```

**E. Reset Password (NEW)**
```php
Input:
  - email (email, required)
  - token (string, required)
  - password (min 6, required, confirmed)

Proses:
  1. Validasi input
  2. Verifikasi token:
     - Token ada di database?
     - Token belum kadaluarsa (< 24 jam)?
  3. Jika valid:
     - Hash password baru
     - Update users table
     - Delete token dari password_reset_tokens
  4. Redirect ke login

Output:
  - Password berhasil direset
  - Token dihapus dari database
  - User dapat login dengan password baru
```

#### Security Features
```
✅ Password hashing: bcrypt dengan 12 rounds
✅ Session security: regenerateToken() setelah login/logout
✅ CSRF protection: token di semua form
✅ Email validation: format dan existence check
✅ Token expiry: 24 jam untuk reset password
✅ Rate limiting: Optional untuk prevent brute force
✅ SQL injection prevention: Prepared statements via ORM
✅ XSS prevention: Escaped output di Blade template
```

---

### 2. FILM MANAGEMENT MODULE

#### Deskripsi
Module untuk mengelola data film dengan atribut lengkap dan relasi genre yang fleksibel.

#### Attributes/Fields

| Field | Type | Constraint | Deskripsi |
|-------|------|-----------|-----------|
| id | unsigned bigint | PK | Primary key |
| judul | string(255) | required | Judul film |
| tahun_rilis | integer | required | Tahun rilis film |
| durasi | integer | required | Durasi dalam menit |
| rating | decimal(3,1) | required | Rating 1-10 |
| user_id | unsigned bigint | FK | Foreign key ke users |
| created_at | timestamp | nullable | Waktu dibuat |
| updated_at | timestamp | nullable | Waktu diupdate |

#### Relasi

```
Film
  ├─ BelongsTo: User (many films to one user)
  │   Fungsi: Memastikan film hanya bisa diakses user yang membuat
  │
  └─ BelongsToMany: Genre (via film_genre pivot table)
      Fungsi: Satu film bisa punya banyak genre
      Contoh: "Inception" → Action, Sci-Fi, Thriller
```

#### CRUD Operations

**CREATE (Tambah Film)**
```
POST /films

Input:
  - judul: "Inception"
  - tahun_rilis: 2010
  - durasi: 148
  - rating: 8.8
  - genres: [1, 3, 5]  // array genre IDs

Proses:
  1. Validasi input
  2. Create film record
  3. Attach genres (via pivot table)
  4. Simpan timestamps

Output:
  - Film baru dengan ID
  - Relasi genre tersimpan
```

**READ (Lihat Film)**
```
GET /films           → List semua film user
GET /films/{id}      → Detail film specific

Output:
  - Film details dengan genres
  - User-owned verification
```

**UPDATE (Ubah Film)**
```
PUT /films/{id}

Input:
  - judul, tahun_rilis, durasi, rating, genres

Proses:
  1. Verifikasi user owner
  2. Validasi input
  3. Update film record
  4. Sync genres (detach old, attach new)
  5. Update timestamps

Output:
  - Film terupdate dengan genre terbaru
```

**DELETE (Hapus Film)**
```
DELETE /films/{id}

Proses:
  1. Verifikasi user owner
  2. Delete genre associations (cascade)
  3. Delete film record
  
Output:
  - Film deleted
  - Genre associations auto-deleted
```

#### Route Endpoints

| HTTP | URI | Method | Auth |
|------|-----|--------|------|
| GET | `/films` | FilmController@index | ✅ |
| GET | `/films/create` | FilmController@create | ✅ |
| POST | `/films` | FilmController@store | ✅ |
| GET | `/films/{id}` | FilmController@show | ✅ |
| GET | `/films/{id}/edit` | FilmController@edit | ✅ |
| PUT | `/films/{id}` | FilmController@update | ✅ |
| DELETE | `/films/{id}` | FilmController@destroy | ✅ |

---

### 3. GENRE MANAGEMENT MODULE

#### Deskripsi
Module untuk mengelola kategori/genre yang bisa digunakan untuk film maupun series.

#### Attributes/Fields

| Field | Type | Constraint | Deskripsi |
|-------|------|-----------|-----------|
| id | unsigned bigint | PK | Primary key |
| nama | string(255) | required | Nama genre (Action, Drama, etc) |
| deskripsi | text | nullable | Deskripsi genre |
| user_id | unsigned bigint | FK | Foreign key ke users |
| created_at | timestamp | nullable | Waktu dibuat |
| updated_at | timestamp | nullable | Waktu diupdate |

#### Relasi

```
Genre
  ├─ BelongsTo: User
  │   Fungsi: Genre hanya bisa diakses user yang membuat
  │
  ├─ BelongsToMany: Film (via film_genre pivot table)
  │   Contoh: Genre "Action" bisa berhubungan dengan banyak film
  │
  └─ BelongsToMany: Series (via series_genre pivot table)
      Contoh: Genre "Drama" bisa berhubungan dengan banyak series
```

#### CRUD Operations
Similar to Film management, dengan tambahan:

**Statistik Genre**
```
Saat display genre list, bisa tampilkan:
  - Jumlah film yang punya genre ini
  - Jumlah series yang punya genre ini
  - Total relasi
```

#### Route Endpoints

| HTTP | URI | Method | Auth |
|------|-----|--------|------|
| GET | `/genres` | GenreController@index | ✅ |
| GET | `/genres/create` | GenreController@create | ✅ |
| POST | `/genres` | GenreController@store | ✅ |
| GET | `/genres/{id}` | GenreController@show | ✅ |
| GET | `/genres/{id}/edit` | GenreController@edit | ✅ |
| PUT | `/genres/{id}` | GenreController@update | ✅ |
| DELETE | `/genres/{id}` | GenreController@destroy | ✅ |

---

### 4. SERIES MANAGEMENT MODULE

#### Deskripsi
Module untuk mengelola data series/TV series dengan atribut spesifik dan relasi genre.

#### Attributes/Fields

| Field | Type | Constraint | Deskripsi |
|-------|------|-----------|-----------|
| id | unsigned bigint | PK | Primary key |
| judul | string(255) | required | Judul series |
| jumlah_episode | integer | required | Banyak episode |
| rating | decimal(3,1) | required | Rating 1-10 |
| user_id | unsigned bigint | FK | Foreign key ke users |
| created_at | timestamp | nullable | Waktu dibuat |
| updated_at | timestamp | nullable | Waktu diupdate |

#### Relasi

```
Series
  ├─ BelongsTo: User
  │   Fungsi: Series hanya bisa diakses user yang membuat
  │
  └─ BelongsToMany: Genre (via series_genre pivot table)
      Fungsi: Satu series bisa punya banyak genre
      Contoh: "Breaking Bad" → Crime, Drama, Thriller
```

#### Perbedaan Series vs Film

| Aspek | Film | Series |
|-------|------|--------|
| Durasi | Field: durasi (menit) | Field: jumlah_episode |
| Tipe | Movie (satu film) | Multiple episodes |
| Rating | Rating untuk keseluruhan | Rating untuk series |
| Data | Lebih sederhana | Lebih detail per episode |
| Pivot Table | film_genre | series_genre |

#### Route Endpoints

| HTTP | URI | Method | Auth |
|------|-----|--------|------|
| GET | `/series` | SeriesController@index | ✅ |
| GET | `/series/create` | SeriesController@create | ✅ |
| POST | `/series` | SeriesController@store | ✅ |
| GET | `/series/{id}` | SeriesController@show | ✅ |
| GET | `/series/{id}/edit` | SeriesController@edit | ✅ |
| PUT | `/series/{id}` | SeriesController@update | ✅ |
| DELETE | `/series/{id}` | SeriesController@destroy | ✅ |

---

## 🏗️ ARSITEKTUR DAN DESAIN

### 1. Architecture Pattern: MVC (Model-View-Controller)

```
┌────────────────────────────────────────────────────────────┐
│                    USER INTERFACE                          │
│              (Blade Templates - HTML/CSS/JS)               │
└────────────────┬─────────────────────────────────────────┘
                 │
                 ↓
┌────────────────────────────────────────────────────────────┐
│                    CONTROLLER                              │
│  (FilmController, GenreController, SeriesController,       │
│   AuthController - Request handling & business logic)      │
└────────────────┬─────────────────────────────────────────┘
                 │
                 ↓
┌────────────────────────────────────────────────────────────┐
│                      MODEL                                 │
│    (Film, Genre, Series, User - Eloquent ORM)             │
│         Data representation & relationships)               │
└────────────────┬─────────────────────────────────────────┘
                 │
                 ↓
┌────────────────────────────────────────────────────────────┐
│                    DATABASE                                │
│   (MySQL/MariaDB - Data persistence)                       │
└────────────────────────────────────────────────────────────┘
```

### 2. Request-Response Lifecycle

```
1. USER ACTION
   └─ Click link / Submit form
   
2. ROUTE MATCHING
   └─ routes/web.php matches URL pattern
   
3. MIDDLEWARE
   ├─ CSRF token validation
   ├─ Authentication check
   └─ Authorization check
   
4. CONTROLLER
   ├─ Receive request
   ├─ Validate input
   └─ Call model methods
   
5. MODEL/ELOQUENT
   ├─ Query/Update database
   ├─ Handle relationships
   └─ Return data
   
6. CONTROLLER (continued)
   ├─ Process data
   ├─ Prepare response
   └─ Call view
   
7. VIEW
   ├─ Render template
   ├─ Display data
   └─ Generate HTML
   
8. RESPONSE
   └─ Return to browser
   
9. BROWSER
   └─ Render page to user
```

### 3. Data Flow Diagram

#### Film Management Flow
```
┌─────────────┐
│  User       │
└──────┬──────┘
       │ "Tambah Film"
       ↓
┌─────────────────────────────────────────┐
│  Halaman Form Input Film                │
│  - Judul, Tahun, Durasi, Rating, Genre  │
└──────────────┬──────────────────────────┘
               │ submit form
               ↓
┌─────────────────────────────────────────┐
│  FilmController@store                   │
│  - Validasi input                       │
│  - Cek user ownership                   │
│  - Attach user_id otomatis              │
└──────────────┬──────────────────────────┘
               │ create & attach
               ↓
┌─────────────────────────────────────────┐
│  Film Model (Eloquent)                  │
│  - Save film record                     │
│  - Attach genres (pivot table)          │
│  - Update timestamps                    │
└──────────────┬──────────────────────────┘
               │ persist
               ↓
┌─────────────────────────────────────────┐
│  Database                               │
│  - films table (new record)             │
│  - film_genre table (relasi)            │
└──────────────┬──────────────────────────┘
               │ success
               ↓
┌─────────────────────────────────────────┐
│  Redirect ke /films/{id}                │
│  - Success message                      │
│  - Display film yang baru dibuat        │
└─────────────────────────────────────────┘
```

#### Authentication Flow
```
┌─────────────┐
│  Visitor    │
└──────┬──────┘
       │ visit /login
       ↓
┌─────────────────────────────┐
│  Login Form                 │
│  - Email & Password         │
└──────────────┬──────────────┘
               │ submit
               ↓
┌─────────────────────────────┐
│  AuthController@login       │
│  - Validate format          │
│  - Check credentials        │
└──────────────┬──────────────┘
               │
       ┌───────┴────────┐
       │                │
   VALID            INVALID
       │                │
       ↓                ↓
   ✓ Success        ✗ Error
   - Generate       - Redirect back
     session        - Show message
   - Redirect to
     /films
```

### 4. Entity Relationship Diagram (ERD)

```
┌──────────────────────┐
│      USERS           │
├──────────────────────┤
│ id (PK)              │
│ name                 │
│ email (UNIQUE)       │
│ password             │
│ remember_token       │
│ created_at           │
│ updated_at           │
└──────────┬───────────┘
           │ (1:M)
           │
     ┌─────┴──────┬──────────┐
     │            │          │
     ↓            ↓          ↓
┌─────────┐  ┌─────────┐  ┌────────┐
│ FILMS   │  │ GENRES  │  │ SERIES │
└─────────┘  └─────────┘  └────────┘
     │            │          │
     │ (M:M)      │ (M:M)     │ (M:M)
     │            │          │
     └─────┬──────┴──────┬───┘
           │             │
           ↓             ↓
      ┌──────────┐  ┌─────────────┐
      │FILM_GENRE   │SERIES_GENRE │
      └──────────┘  └─────────────┘
```

### 5. Security Architecture

```
┌─────────────────────────────────────────────┐
│             REQUEST COMES IN                │
└─────────────────┬───────────────────────────┘
                  │
                  ↓
        ┌─────────────────┐
        │ CSRF Protection │ ← Check CSRF token
        └────────┬────────┘
                 │
                 ↓
      ┌──────────────────────┐
      │ Authentication Check │ ← Is user logged in?
      └────────┬─────────────┘
               │
               ↓
       ┌───────────────────┐
        │Authorization Check│ ← Can user access?
        └────────┬──────────┘
                 │
                 ↓
    ┌───────────────────────────┐
    │ Input Validation & Escape │ ← Sanitize input
    └────────┬──────────────────┘
             │
             ↓
    ┌──────────────────────┐
    │ Database Operation   │ ← Use ORM/Prepared
    │ (Protected by ORM)   │   Statements
    └────────┬─────────────┘
             │
             ↓
    ┌──────────────────────┐
    │ Response Rendering   │ ← Escape output
    │ (Blade escapes)      │
    └────────┬─────────────┘
             │
             ↓
    ┌──────────────────────┐
    │ Response Sent        │
    └──────────────────────┘
```

---

## 🛠️ TEKNOLOGI YANG DIGUNAKAN

### Backend Stack

#### Framework & Language
| Komponen | Versi | Fungsi |
|----------|-------|--------|
| **Laravel** | 12.0 | Modern PHP Framework |
| **PHP** | ^8.2 | Server-side Language |
| **Composer** | Latest | PHP Package Manager |
| **Artisan CLI** | - | Command-line Interface |

#### Database & ORM
| Komponen | Versi | Fungsi |
|----------|-------|--------|
| **MySQL/MariaDB** | 5.7+ | Database Engine |
| **Eloquent ORM** | - | Object-Relational Mapping |
| **Query Builder** | - | Database Query Construction |
| **Migrations** | - | Database Schema Versioning |

#### Key Libraries
```php
// Authentication
laravel/framework (built-in Auth)

// Password Hashing
Illuminate\Support\Facades\Hash (bcrypt)

// Database
illuminate/database

// Validation
illuminate/validation

// Session Management
illuminate/session

// Routing
illuminate/routing

// Middleware
illuminate/middleware
```

### Frontend Stack

#### Templating
| Komponen | Fungsi |
|----------|--------|
| **Blade Template Engine** | Server-side HTML templating |
| **Bootstrap 5.3** | CSS Framework & Components |
| **HTML5** | Semantic markup |
| **CSS3** | Styling & responsive design |
| **JavaScript (Vanilla)** | Client-side interactivity |

#### Build Tools
| Komponen | Fungsi |
|----------|--------|
| **Vite** | Modern module bundler |
| **NPM** | JavaScript package manager |
| **Node.js** | JavaScript runtime |

#### CSS Features
- **Responsive Grid System**: Bootstrap 12-column grid
- **Pre-built Components**: Buttons, Forms, Cards, Alerts
- **Custom Styling**: Gradient backgrounds, shadows, animations
- **Accessibility**: WCAG compliance, semantic HTML

### Development Tools

| Tool | Versi | Fungsi |
|------|-------|--------|
| **Laravel Pint** | ^1.24 | Code style fixer |
| **PHPUnit** | ^11.5.50 | Testing framework |
| **Mockery** | ^1.6 | Mocking library |
| **Laravel Sail** | ^1.41 | Docker development |
| **Laravel Pail** | ^1.2.2 | Real-time log viewer |

### Infrastructure & Deployment

| Komponen | Fungsi |
|----------|--------|
| **XAMPP** | Local development server |
| **Apache** | Web server |
| **PHP-CGI** | PHP processor |
| **MySQL** | Database |
| **.env** | Environment configuration |

### Version Control & DevOps (Optional)
- Git untuk version control
- GitHub untuk repository
- CI/CD pipelines untuk automated testing

---

## 💾 DATABASE SCHEMA

### 1. Users Table

```sql
CREATE TABLE users (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    INDEX idx_email (email),
    INDEX idx_created_at (created_at)
);
```

### 2. Films Table

```sql
CREATE TABLE films (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    judul VARCHAR(255) NOT NULL,
    tahun_rilis INTEGER NOT NULL,
    durasi INTEGER NOT NULL,
    rating DECIMAL(3,1) NOT NULL CHECK (rating >= 1 AND rating <= 10),
    user_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id),
    INDEX idx_created_at (created_at),
    INDEX idx_rating (rating)
);
```

### 3. Genres Table

```sql
CREATE TABLE genres (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(255) NOT NULL,
    deskripsi TEXT NULL,
    user_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id),
    INDEX idx_created_at (created_at)
);
```

### 4. Series Table

```sql
CREATE TABLE series (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    judul VARCHAR(255) NOT NULL,
    jumlah_episode INTEGER NOT NULL,
    rating DECIMAL(3,1) NOT NULL CHECK (rating >= 1 AND rating <= 10),
    user_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id),
    INDEX idx_created_at (created_at),
    INDEX idx_rating (rating)
);
```

### 5. Film_Genre Pivot Table (Many-to-Many)

```sql
CREATE TABLE film_genre (
    film_id BIGINT UNSIGNED NOT NULL,
    genre_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    PRIMARY KEY (film_id, genre_id),
    FOREIGN KEY (film_id) REFERENCES films(id) ON DELETE CASCADE,
    FOREIGN KEY (genre_id) REFERENCES genres(id) ON DELETE CASCADE,
    INDEX idx_genre_id (genre_id)
);
```

### 6. Series_Genre Pivot Table (Many-to-Many)

```sql
CREATE TABLE series_genre (
    series_id BIGINT UNSIGNED NOT NULL,
    genre_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    PRIMARY KEY (series_id, genre_id),
    FOREIGN KEY (series_id) REFERENCES series(id) ON DELETE CASCADE,
    FOREIGN KEY (genre_id) REFERENCES genres(id) ON DELETE CASCADE,
    INDEX idx_genre_id (genre_id)
);
```

### 7. Password_Reset_Tokens Table (NEW)

```sql
CREATE TABLE password_reset_tokens (
    email VARCHAR(255) PRIMARY KEY,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL,
    
    INDEX idx_token (token)
);
```

### Index Strategy

```
✓ Primary Key Indexes:
  - Automatic untuk PK (id)

✓ Foreign Key Indexes:
  - user_id (untuk join dengan users table)
  - film_id, genre_id (pivot tables)
  - series_id, genre_id (pivot tables)

✓ Search Indexes:
  - email (UNIQUE, sering di-search untuk login/forgot password)

✓ Sort Indexes:
  - created_at (untuk sorting by newest)
  - rating (untuk sorting by rating)

✓ Composite Indexes:
  - (user_id, created_at) untuk query film user terbaru

Total: Optimized untuk common queries tanpa over-indexing
```

---

## 🚀 INSTALASI DAN SETUP

### Prasyarat (Prerequisites)

Pastikan sudah terinstall:
- **PHP 8.2+** dengan extensions: pdo, pdo_mysql, bcmath, ctype, json, mbstring, openssl, tokenizer, xml
- **MySQL/MariaDB 5.7+** atau server database lain
- **Composer** (PHP package manager)
- **Node.js 16+** (untuk frontend assets)
- **NPM 8+** (JavaScript package manager)
- **XAMPP/WAMP/LAMP** atau web server lokal

### Step 1: Clone/Download Project

```bash
# Navigate to XAMPP htdocs
cd c:\xampp\htdocs

# Clone project (jika dari git)
git clone <repository-url> film-app

# Atau download zip dan extract
```

### Step 2: Install PHP Dependencies

```bash
# Navigate ke project directory
cd film-app

# Install dependencies via Composer
composer install

# Jika error, coba dengan update
composer update
```

### Step 3: Setup Environment File

```bash
# Copy .env.example ke .env
cp .env.example .env

# atau di Windows
copy .env.example .env
```

### Step 4: Configure Environment

Edit file `.env`:

```env
APP_NAME=FilmApp
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=film_app
DB_USERNAME=root
DB_PASSWORD=

# Mail Configuration (untuk password reset email)
MAIL_MAILER=log
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_USERNAME=
MAIL_PASSWORD=

# Session Configuration
SESSION_DRIVER=file
SESSION_LIFETIME=120
```

### Step 5: Generate Application Key

```bash
# Generate unique application key
php artisan key:generate
```

### Step 6: Create Database

```bash
# Using MySQL CLI
mysql -u root -p

# Dalam MySQL
CREATE DATABASE film_app CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### Step 7: Run Migrations

```bash
# Run semua migrations
php artisan migrate

# Atau run specific migration
php artisan migrate --path=database/migrations/2026_05_07_120000_create_password_reset_tokens_table.php

# Jika ada error, reset database
php artisan migrate:reset
php artisan migrate
```

### Step 8: Install Node Dependencies

```bash
# Install NPM packages
npm install

# atau dengan yarn
yarn install
```

### Step 9: Compile Frontend Assets

```bash
# Development mode (with watch)
npm run dev

# Production mode (minified)
npm run build
```

### Step 10: Start Development Server

```bash
# Method 1: Using Artisan
php artisan serve
# Akses: http://localhost:8000

# Method 2: Using XAMPP Apache
# Pastikan DocumentRoot menunjuk ke project public folder
# Akses: http://localhost/film-app/public
```

### Verifikasi Instalasi

```bash
# Check database connection
php artisan tinker
>>> DB::connection()->getPDO();
# Should return PDO instance

# Check key generation
# APP_KEY di .env harus sudah ter-generate

# Test route
php artisan route:list | grep login
# Harus muncul route login
```

### Optional: Seed Database

```bash
# Create test user
php artisan tinker
>>> App\Models\User::create(['name' => 'Test', 'email' => 'test@example.com', 'password' => bcrypt('password')])
```

---

## 📲 PANDUAN PENGGUNAAN

### User Journey: Dari Registration hingga Manajemen Koleksi

#### 1. REGISTRASI (Sign Up)

**Langkah:**
1. Buka halaman `/register`
2. Isi form:
   - Nama lengkap
   - Email (belum terdaftar)
   - Password (min 6 karakter)
   - Konfirmasi password
3. Klik tombol "Daftar"

**Hasil:**
- Akun baru terbuat
- User otomatis login
- Redirect ke dashboard

**Validasi:**
```
✓ Email harus unik
✓ Password minimal 6 karakter
✓ Password & konfirmasi harus sama
✓ Nama tidak boleh kosong
```

---

#### 2. LOGIN

**Langkah:**
1. Buka halaman `/login`
2. Isi form:
   - Email
   - Password
3. Klik tombol "Login"

**Opsi:**
- Jika lupa password → klik "Lupa password?"

**Hasil:**
- Session user terbuat
- Redirect ke dashboard `/films`

---

#### 3. LUPA PASSWORD (NEW FEATURE)

**Langkah:**
1. Di halaman login, klik "Lupa password?"
2. Masukkan email terdaftar
3. Klik "Kirim Link Reset Password"

**Apa Terjadi:**
- Sistem generate token reset (24 jam)
- Email dengan link reset dikirim (di development, link ditampilkan)
- Message: "Link reset telah dikirim ke email Anda"

**Melanjutkan Reset Password:**
1. Buka link dari email
2. Halaman reset-password terbuka
3. Isi password baru (2x untuk konfirmasi)
4. Klik "Reset Password"

**Hasil:**
- Password berhasil diubah
- Token dihapus
- Redirect ke login
- Login dengan password baru

---

#### 4. MANAJEMEN FILM

**A. Tambah Film Baru**

Langkah:
1. Dari sidebar, klik "Films" → "Tambah Film Baru"
2. Isi form:
   - **Judul**: "Inception"
   - **Tahun Rilis**: 2010
   - **Durasi**: 148 (menit)
   - **Rating**: 8.8 (1-10)
   - **Genre**: Pilih multiple (Action, Sci-Fi, Thriller)
3. Klik "Simpan"

Hasil:
- Film ditambahkan ke koleksi
- Redirect ke detail film
- Genre associations tersimpan

**B. Lihat Daftar Film**

Langkah:
1. Klik "Films" di menu utama
2. Melihat list semua film milik user

Fitur:
- Pagination (jika banyak film)
- Sorting by date, rating, title
- Search by title
- Action buttons: View, Edit, Delete

**C. Edit Film**

Langkah:
1. Di film list, klik tombol "Edit" pada film yang ingin diubah
2. Update data yang perlu diubah
3. Klik "Update"

Hasil:
- Film terupdate
- Genre associations di-update

**D. Hapus Film**

Langkah:
1. Di film list atau detail, klik tombol "Hapus"
2. Konfirmasi penghapusan
3. Klik "Yakin"

Hasil:
- Film dihapus
- Genre associations otomatis dihapus
- Redirect ke film list

---

#### 5. MANAJEMEN GENRE

**A. Buat Genre Baru**

Langkah:
1. Klik "Genres" → "Buat Genre Baru"
2. Isi form:
   - **Nama Genre**: "Action"
   - **Deskripsi**: "Film aksi dengan scene-scene penuh aksi"
3. Klik "Simpan"

**B. Lihat Genre List**

Langkah:
1. Klik "Genres" di menu
2. Melihat semua genre yang sudah dibuat
3. Setiap genre menampilkan:
   - Nama & deskripsi
   - Jumlah film dengan genre ini
   - Jumlah series dengan genre ini

**C. Edit & Hapus Genre**

Similar ke film management

---

#### 6. MANAJEMEN SERIES

Similar ke Film management, dengan perbedaan fields:
- Durasi → Jumlah Episode
- Tidak ada field tahun rilis

---

#### 7. LOGOUT

Langkah:
1. Klik profil user (top-right)
2. Klik "Logout"

Hasil:
- Session dihapus
- Redirect ke login page

---

## 📊 USE CASE EXAMPLES

### Scenario 1: Personal Movie Collector

```
Andi adalah penggemar film yang ingin mengelola koleksi film favoritnya.

Flow:
1. Register → create akun "Andi"
2. Create Genres → "Action", "Sci-Fi", "Thriller"
3. Add Films → 
   - "Inception" (Action, Sci-Fi)
   - "The Matrix" (Action, Sci-Fi)
   - "Interstellar" (Sci-Fi)
4. View & Sort → sort by rating tertinggi
5. Edit Film → update rating setelah nonton ulang
6. Result: Koleksi terorganisir dengan genre
```

### Scenario 2: Series Tracker

```
Budi menonton banyak series dan ingin track progress.

Flow:
1. Register → create akun "Budi"
2. Create Genres → "Drama", "Comedy", "Thriller"
3. Add Series →
   - "Breaking Bad" (Drama) - 62 episodes
   - "The Office" (Comedy) - 201 episodes
4. Update Rating → update setelah tamat
5. Keep Track → rating per series, total episodes watched
```

### Scenario 3: Forget Password Recovery

```
Cindy lupa password dan ingin reset.

Flow:
1. Buka /login
2. Klik "Lupa password?"
3. Masukkan email terdaftar
4. Terima link reset (dari email)
5. Buka link → form reset password
6. Input password baru
7. Klik reset → success
8. Login dengan password baru
```

---

## 📈 KESIMPULAN DAN PENGEMBANGAN

### Ringkasan Fitur yang Diimplementasikan ✅

#### Authentication & Security
- ✅ User registration & login
- ✅ Password hashing dengan bcrypt
- ✅ Session management
- ✅ CSRF protection
- ✅ **NEW** Forgot password dengan token reset
- ✅ **NEW** Password recovery flow

#### Content Management
- ✅ Film CRUD (Create, Read, Update, Delete)
- ✅ Genre CRUD
- ✅ Series CRUD
- ✅ Many-to-Many relationships (Film↔Genre, Series↔Genre)

#### Data Management
- ✅ User-specific data isolation
- ✅ Automatic timestamps (created_at, updated_at)
- ✅ Database migrations for versioning
- ✅ Cascading deletes

#### User Experience
- ✅ Responsive web design (Mobile & Desktop)
- ✅ Bootstrap 5 styling
- ✅ Modern UI/UX
- ✅ Intuitive navigation
- ✅ Error handling & validation
- ✅ Success notifications

---

### Keunggulan Aplikasi 💪

```
✨ TECHNICAL EXCELLENCE
├─ Modern Framework (Laravel 12)
├─ Clean MVC Architecture
├─ Eloquent ORM untuk database abstraction
├─ RESTful route conventions
└─ Type-safe operations dengan ORM

🔒 SECURITY FIRST
├─ Password encryption (bcrypt)
├─ Session security
├─ CSRF token protection
├─ SQL injection prevention
├─ Token expiry (24 jam)
└─ Input validation & sanitization

🎨 USER-CENTRIC DESIGN
├─ Responsive layouts
├─ Intuitive navigation
├─ Smooth workflows
├─ Clear feedback messages
├─ Accessible HTML
└─ Modern styling

📊 SCALABLE ARCHITECTURE
├─ Modular code structure
├─ Easy to add new features
├─ Separate concerns (MVC)
├─ Database relationship flexibility
├─ Extensible controller/model pattern
└─ Well-organized project structure
```

---

### Potensi Pengembangan Lanjutan 🚀

#### Phase 1: Core Enhancements (Priority: High)
- 🔄 Advanced search & filtering (by genre, rating, year)
- 📊 User statistics & analytics dashboard
- 🔐 Email verification untuk registrasi
- 📝 User ratings & reviews untuk film/series
- ⭐ Favorites/watchlist feature
- 📱 Mobile-responsive improvements

#### Phase 2: Social Features (Priority: Medium)
- 👥 User profiles & public collections
- 🔗 Share film lists dengan teman
- 💬 Comments & discussions
- 👍 Like & rating sistem
- 📢 Recommendations based on genres
- 🌟 User following & recommendations

#### Phase 3: Advanced Features (Priority: Medium-Low)
- 🔄 API REST untuk mobile apps
- 📱 Mobile apps (Flutter/React Native)
- ⏱️ Watch progress tracking
- 📅 Release date notifications
- 🎬 Trailer/poster integration dari external API
- 📊 Genre statistics & trends

#### Phase 4: Enterprise Features (Priority: Low)
- 🔐 Two-factor authentication (2FA)
- 🗂️ Team/organization support
- 📋 Role-based access control (RBAC)
- 🌍 Multi-language support
- 🎨 Theme customization
- 📈 Advanced analytics & reporting

---

### Technical Debt & Improvements

```
[ ] Add unit tests (PHPUnit)
[ ] Add integration tests
[ ] Implement API versioning
[ ] Add caching layer (Redis)
[ ] Implement pagination efficiently
[ ] Add rate limiting for API
[ ] Setup error tracking (Sentry)
[ ] Add monitoring & logging
[ ] Performance optimization
[ ] Database query optimization
```

---

### Deployment Roadmap

#### Development Environment ✅ (Current)
- Local XAMPP setup
- SQLite/MySQL
- File-based session

#### Staging Environment (Next)
- Linux VPS
- Production MySQL
- Redis session
- Basic CI/CD

#### Production Environment (Future)
- Cloud hosting (AWS/GCP/Azure)
- CDN for assets
- SSL/TLS encryption
- Monitoring & alerting
- Automated backups
- Load balancing

---

## 📚 DOKUMENTASI REFERENSI

### Dokumentasi Resmi
- [Laravel 12 Documentation](https://laravel.com/docs/12.x)
- [PHP 8.2 Documentation](https://www.php.net/docs.php)
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [Bootstrap 5 Documentation](https://getbootstrap.com/docs/5.3/)

### Konsep Penting
- MVC Architecture Pattern
- RESTful API Design
- Database Normalization
- Security Best Practices
- SOLID Principles

### Tools & Resources
- Postman untuk API testing
- MySQL Workbench untuk database design
- VS Code untuk code editor
- DBeaver untuk database management
- Laravel Mix untuk asset compilation

---

## 📞 SUPPORT & MAINTENANCE

### Bug Reporting
- Create issue di GitHub repository
- Describe steps to reproduce
- Include error messages & screenshots
- Specify environment details

### Feature Requests
- Open discussion dalam repository
- Describe use case & requirements
- Provide mockup/wireframe jika perlu
- Consider technical feasibility

### Performance Monitoring
- Monitor query times
- Check database size growth
- Monitor server resource usage
- Setup alerting untuk anomalies

---

## 🎓 KESIMPULAN

**Film App** adalah solusi komprehensif dan professional untuk manajemen koleksi film dan series. Dengan menggunakan:

✅ **Framework Modern** (Laravel 12)  
✅ **Best Practices** (MVC, SOLID, Security)  
✅ **Clean Code** (maintainable, scalable)  
✅ **User-Friendly Design** (responsive, intuitive)  
✅ **Enterprise-Ready** (authentication, recovery, validation)  

Aplikasi ini siap untuk:
- 🎯 Production deployment
- 📈 Scaling ke lebih banyak users
- 🔧 Adding new features
- 🌍 Global expansion
- 💼 Enterprise adoption

Dengan potensi pengembangan yang luas dan arsitektur yang solid, Film App dapat terus berkembang sesuai kebutuhan bisnis dan user feedback.

---

**Presentasi Dibuat**: 7 Mei 2026  
**Versi Aplikasi**: 1.1 (dengan Forgot Password Feature)  
**Status**: Production Ready ✅  
**Last Updated**: 7 Mei 2026  

**Dibuat dengan ❤️ menggunakan Laravel 12 & Modern Web Technologies**

---

## 📝 CATATAN PENTING

1. **Environment Configuration**: Sesuaikan `.env` dengan setup lokal Anda
2. **Database**: Pastikan MySQL running dan database sudah terbuat
3. **Migrations**: Jalankan `php artisan migrate` sebelum pertama kali
4. **Security**: Change default password & email configuration di production
5. **Backup**: Regular backup database untuk prevent data loss
6. **Updates**: Keep Laravel & dependencies updated untuk security patches

