# 🎬 PRESENTASI FILM APP
## Aplikasi Manajemen Film dan Series Berbasis Web

---

## 📋 DAFTAR ISI
1. [Latar Belakang](#latar-belakang)
2. [Pendahuluan](#pendahuluan)
3. [Fungsi Codingan](#fungsi-codingan)
4. [Arsitektur Sistem](#arsitektur-sistem)
5. [Fitur Utama](#fitur-utama)
6. [Teknologi yang Digunakan](#teknologi-yang-digunakan)

---

## 🎯 LATAR BELAKANG

### Konteks Masalah
Saat ini, terdapat kebutuhan bagi penggemar film dan series untuk dapat:
- **Mengelola koleksi** film dan series favorit mereka
- **Mengorganisir** berdasarkan genre/kategori
- **Menyimpan informasi** penting seperti durasi, tahun rilis, dan rating
- **Membedakan antara film dan series** dengan atribut masing-masing
- **Mengakses data pribadi** hanya untuk diri sendiri (multi-user support)

### Motivasi Pengembangan
- Memberikan solusi **terpusat dan terorganisir** untuk manajemen koleksi film/series
- Memudahkan pengguna untuk **mencari dan mengkategorikan** konten hiburan mereka
- Implementasi dengan **teknologi modern** dan **best practices** web development
- Sistem berbasis web yang dapat **diakses dari mana saja**

---

## 📖 PENDAHULUAN

### Definisi Aplikasi
**Film App** adalah aplikasi web yang memungkinkan pengguna untuk:
- Mendaftar dan login ke sistem
- Membuat, membaca, mengubah, dan menghapus (CRUD) data film
- Membuat, membaca, mengubah, dan menghapus (CRUD) data series
- Membuat, membaca, mengubah, dan menghapus (CRUD) data genre
- Menghubungkan film dan series dengan genre tertentu

### Target Pengguna
1. **Penggemar Film & Series** - yang ingin mengelola koleksi mereka
2. **Content Curator** - yang ingin mengorganisir rekomendasi konten
3. **Movie Enthusiast** - yang ingin mencatat dan membagikan rating

### Scope Proyek
- ✅ Autentikasi pengguna (login/register)
- ✅ Manajemen Film (CRUD)
- ✅ Manajemen Series (CRUD)
- ✅ Manajemen Genre (CRUD)
- ✅ Relasi Many-to-Many antara Film/Series dengan Genre
- ✅ Data isolation per pengguna
- ✅ Interface web responsif

---

## 🔧 FUNGSI CODINGAN

### 1. **SISTEM AUTENTIKASI & LUPA PASSWORD**
**Fungsi**: Mengamankan akses aplikasi, mengelola session, dan membantu recovery akun

**File Terkait**:
- `app/Http/Controllers/AuthController.php` - Logic autentikasi
- `routes/web.php` - Route login/register/logout/password reset
- `resources/views/auth/` - View authentication pages
- `database/migrations/2026_05_07_120000_create_password_reset_tokens_table.php` - Migration untuk token reset

**Fungsionalitas**:
```
GET  /login                    → Halaman login
POST /login                    → Login user dengan email & password
GET  /register                 → Halaman registrasi
POST /register                 → Registrasi user baru
POST /logout                   → Logout dan end session
GET  /forgot-password          → Form lupa password (input email)
POST /forgot-password          → Kirim link reset password
GET  /reset-password/{token}   → Form reset password (input password baru)
POST /reset-password           → Proses perubahan password
```

**Fitur Autentikasi**:
- ✅ Register user baru dengan validasi
- ✅ Login dengan email & password
- ✅ Logout dengan session invalidation
- ✅ Lupa password dengan token berbasis waktu
- ✅ Reset password dengan verifikasi token
- ✅ Remember token untuk session persistent

**Keamanan**:
- Password di-hash dengan algoritma bcrypt (12 rounds)
- Session middleware untuk proteksi route
- CSRF token protection di semua form
- Token reset berlaku hanya 24 jam
- Token otomatis dihapus setelah digunakan
- Email validation & existence check
- Password confirmation untuk keamanan
- Rate limiting optional untuk brute force protection

---

### 2. **MANAJEMEN FILM**
**Fungsi**: Memungkinkan CRUD operasi data film dengan atribut lengkap

**File Terkait**:
- `app/Models/Film.php` - Model Film
- `app/Http/Controllers/FilmController.php` - Controller Film
- `resources/views/films/` - View untuk Film
- `database/migrations/2026_04_07_025718_create_films_table.php` - Migration

**Atribut Film**:
```
- judul        (string) - Nama film
- tahun_rilis  (integer) - Tahun rilis
- durasi       (integer) - Durasi dalam menit
- rating       (decimal) - Rating 1-10
- user_id      (foreign key) - Pemilik film
```

**Operasi yang Didukung**:
```
GET    /films              → Tampilkan semua film user
GET    /films/{id}         → Tampilkan detail film
GET    /films/create       → Form tambah film baru
POST   /films              → Simpan film baru
GET    /films/{id}/edit    → Form edit film
PUT    /films/{id}         → Update film
DELETE /films/{id}         → Hapus film
```

**Relasi**:
```
Film --BelongsTo--> User
Film --BelongsToMany--> Genre (melalui film_genre)
```

---

### 3. **MANAJEMEN GENRE**
**Fungsi**: Mengorganisir film dan series ke dalam kategori/genre

**File Terkait**:
- `app/Models/Genre.php` - Model Genre
- `app/Http/Controllers/GenreController.php` - Controller Genre
- `resources/views/genres/` - View untuk Genre
- `database/migrations/2026_04_07_035031_create_genres_table.php` - Migration

**Atribut Genre**:
```
- nama         (string) - Nama genre (Action, Drama, etc)
- deskripsi    (text)   - Deskripsi genre
- user_id      (foreign key) - Pemilik genre
```

**Operasi yang Didukung**:
```
GET    /genres              → Tampilkan semua genre user
GET    /genres/{id}         → Tampilkan detail genre
GET    /genres/create       → Form tambah genre baru
POST   /genres              → Simpan genre baru
GET    /genres/{id}/edit    → Form edit genre
PUT    /genres/{id}         → Update genre
DELETE /genres/{id}         → Hapus genre
```

**Relasi**:
```
Genre --BelongsTo--> User
Genre --BelongsToMany--> Film (melalui film_genre)
Genre --BelongsToMany--> Series (melalui series_genre)
```

---

### 4. **MANAJEMEN SERIES**
**Fungsi**: Mengelola data series/serial dengan jumlah episode dan rating

**File Terkait**:
- `app/Models/Series.php` - Model Series
- `app/Http/Controllers/SeriesController.php` - Controller Series
- `resources/views/series/` - View untuk Series
- `database/migrations/2026_04_07_035032_create_series_table.php` - Migration

**Atribut Series**:
```
- judul          (string)  - Nama series
- jumlah_episode (integer) - Banyak episode
- rating         (decimal) - Rating 1-10
- user_id        (foreign key) - Pemilik series
```

**Operasi yang Didukung**:
```
GET    /series              → Tampilkan semua series user
GET    /series/{id}         → Tampilkan detail series
GET    /series/create       → Form tambah series baru
POST   /series              → Simpan series baru
GET    /series/{id}/edit    → Form edit series
PUT    /series/{id}         → Update series
DELETE /series/{id}         → Hapus series
```

**Relasi**:
```
Series --BelongsTo--> User
Series --BelongsToMany--> Genre (melalui series_genre)
```

---

### 5. **SISTEM RELASI DATABASE**
**Fungsi**: Menghubungkan entitas dengan relationship yang tepat

**Many-to-Many: Film ↔ Genre**
- Pivot Table: `film_genre`
- Kolom: film_id, genre_id, timestamps
- Fungsi: Satu film bisa punya banyak genre, satu genre bisa punya banyak film

**Many-to-Many: Series ↔ Genre**
- Pivot Table: `series_genre`
- Kolom: series_id, genre_id, timestamps
- Fungsi: Satu series bisa punya banyak genre, satu genre bisa punya banyak series

**One-to-Many: User → Film/Genre/Series**
- Fungsi: Memastikan data isolation - setiap user hanya melihat data mereka sendiri

---

## 🏗️ ARSITEKTUR SISTEM

### Model-View-Controller (MVC)
```
┌─────────────────────────────────────────────┐
│                   USER                      │
└─────────────────────────────────────────────┘
                      ↓
┌─────────────────────────────────────────────┐
│              VIEW (Blade Template)          │
│        resources/views/films/               │
│        resources/views/genres/              │
│        resources/views/series/              │
└─────────────────────────────────────────────┘
                      ↓
┌─────────────────────────────────────────────┐
│            CONTROLLER (Routes)              │
│        FilmController                       │
│        GenreController                      │
│        SeriesController                     │
│        AuthController                       │
└─────────────────────────────────────────────┘
                      ↓
┌─────────────────────────────────────────────┐
│              MODEL (Eloquent)               │
│        Film.php                             │
│        Genre.php                            │
│        Series.php                           │
│        User.php                             │
└─────────────────────────────────────────────┘
                      ↓
┌─────────────────────────────────────────────┐
│              DATABASE                       │
│        films, genres, series                │
│        film_genre, series_genre             │
│        users, migrations                    │
└─────────────────────────────────────────────┘
```

### Flow Aplikasi
```
1. User membuka aplikasi
   ↓
2. Jika belum login → tampilkan halaman login/register
   ↓
3. Jika sudah login → redirect ke home page
   ↓
4. User dapat:
   - Membuka halaman Films/Genres/Series
   - Membuat data baru (Create)
   - Melihat detail (Read)
   - Mengubah data (Update)
   - Menghapus data (Delete)
   ↓
5. Semua operasi data terasosiasi dengan user_id yang login
```

---

## ✨ FITUR UTAMA

### 1. **Authentication & Authorization**
- ✅ Register pengguna baru dengan validasi
- ✅ Login dengan email & password
- ✅ Logout dan session management
- ✅ Password hashing dengan bcrypt (12 rounds)
- ✅ Protected routes dengan middleware 'auth'
- ✅ **NEW** Lupa password dengan token reset
- ✅ **NEW** Reset password dengan link via email (simulated)
- ✅ Token reset berlaku 24 jam
- ✅ Email validation pada forgot password
- ✅ Password confirmation untuk keamanan

### 2. **Film Management**
- ✅ CRUD Film lengkap
- ✅ Atribut: Judul, Tahun Rilis, Durasi, Rating
- ✅ Assign multiple genres ke satu film
- ✅ Validasi input data
- ✅ User-specific data (setiap user punya film sendiri)

### 3. **Genre Management**
- ✅ CRUD Genre lengkap
- ✅ Atribut: Nama, Deskripsi
- ✅ Reusable genres across films & series
- ✅ User-specific genres
- ✅ Can be used for multiple films and series

### 4. **Series Management**
- ✅ CRUD Series lengkap
- ✅ Atribut: Judul, Jumlah Episode, Rating
- ✅ Assign multiple genres ke satu series
- ✅ Different attributes dari film
- ✅ User-specific data

### 5. **Data Management**
- ✅ Many-to-Many relationship (Film↔Genre, Series↔Genre)
- ✅ Automatic timestamps (created_at, updated_at)
- ✅ Data validation & error handling
- ✅ Database migrations untuk versioning schema

### 6. **User Experience**
- ✅ Web interface responsif (Blade Templates)
- ✅ Bootstrap styling untuk UI
- ✅ Navigation menu yang jelas
- ✅ Error messages & success notifications

---

## 🛠️ TEKNOLOGI YANG DIGUNAKAN

### Backend
| Teknologi | Versi | Fungsi |
|-----------|-------|--------|
| **Laravel** | 12.0 | Framework PHP modern |
| **PHP** | ^8.2 | Server-side language |
| **Eloquent ORM** | - | Database abstraction layer |
| **Migrations** | - | Database versioning |

### Frontend
| Teknologi | Fungsi |
|-----------|--------|
| **Blade Template Engine** | Server-side HTML templating |
| **Bootstrap 5** | CSS framework untuk styling |
| **Vite** | Modern bundler untuk assets |
| **JavaScript** | Interactivity (vanilla/alpine) |

### Database
| Sistem | Fungsi |
|--------|--------|
| **MySQL/MariaDB** | Primary data storage |
| **Migrations** | Database schema versioning |
| **Seeders** | Data population untuk testing |

### Development Tools
| Tool | Fungsi |
|------|--------|
| **Composer** | PHP dependency manager |
| **NPM** | JavaScript package manager |
| **PHPUnit** | Testing framework |
| **Artisan CLI** | Command-line interface |

---────────┐
│    USERS             │
├──────────────────────┤
│ id (PK)              │
│ name                 │
│ email                │
│ password             │
│ remember_token       │
│ created_at           │
│ updated_at           │
└──────┬───────────────┘
       │
       ├─────────────┬───────────────┐
       │             │               │
       ▼             ▼               ▼
┌──────────────┐ ┌──────────────┐ ┌──────────────┐
│    FILMS     │ │    GENRES    │ │    SERIES    │
├──────────────┤ ├──────────────┤ ├──────────────┤
│ id (PK)      │ │ id (PK)      │ │ id (PK)      │
│ judul        │ │ nama         │ │ judul        │
│ tahun_rilis  │ │ deskripsi    │ │ jumlah_ep    │
│ durasi       │ │ user_id (FK) │ │ rating       │
│ rating       │ │ created_at   │ │ user_id (FK) │
│ user_id (FK) │ │ updated_at   │ │ created_at   │
│ created_at   │ └──────────────┘ │ updated_at   │
│ updated_at   │                  └──────────────┘
└──────┬───────┘
       │         ┌───────────────┬──────────────┐
       └────────▶│ FILM_GENRE    │ SERIES_GENRE │
                 ├───────────────┼──────────────┤
                 │ film_id (FK)  │series_id(FK) │
                 │ genre_id (FK) │ genre_id(FK) │
                 │ created_at    │ created_at   │
                 │ updated_at    │ updated_at   │
                 └───────────────┴──────────────┘

┌─────────────────────────────┐
│PASSWORD_RESET_TOKENS (NEW)  │
├─────────────────────────────┤
│ email (PK)                  │
│ token                       │
│ created_at                  │
└─────────────────────────────┘
        (Untuk recovery password)
```

**Penjelasan Password Reset Table**:
```
┌──────────────────────────────────────────────────┐
│    USERS                                         │
│ email: user@example.com                          │
└──────────────────────────────────────────────────┘
                    ↓
        User klik "Lupa Password"
                    ↓
┌──────────────────────────────────────────────────┐
│  PASSWORD_RESET_TOKENS                           │
│  email: user@example.com                         │
│  token: abc123xyz789...                          │
│  created_at: 2026-05-07 12:00:00                 │
│  Berlaku sampai: 2026-05-08 12:00:00 (24 jam)   │
└──────────────────────────────────────────────────┘
                    ↓
   User menerima link reset password
   /reset-password/abc123xyz789
                    ↓
   User input password baru
                    ↓
   Verifikasi token (masih valid?)
                    ↓
   ✓ Update USERS p (termasuk password reset tokens table)
php artisan migrate

# 7. Install Node dependencies
npm install

# 8. Compile assets
npm run build

# 9. Start development server
php artisan serve
```

### Migration yang Baru
```bash
# Untuk menjalankan migration password reset tokens saja:
php artisan migrate --path=database/migrations/2026_05_07_120000_create_password_reset_tokens_table.php
```

---

## 📲 FLOW FITUR LUPA PASSWORD

### Proses Reset Password Step-by-Step:

```
1. USER LUPA PASSWORD
   ├─ Klik "Lupa Password?" di halaman login
   └─ Masuk ke form forgot-password
        ↓
2. SUBMIT EMAIL
   ├─ User masukkan email yang terdaftar
   ├─ Sistem validasi email (harus ada di database)
   └─ Jika valid, lanjut ke step 3
        ↓
3. GENERATE TOKEN
   ├─ Buat random token (60 karakter)
   ├─ Hapus token lama jika ada
   ├─ Simpan ke password_reset_tokens:
   │  • email: user@example.com
   │  • token: random_token_xxx
   │  • created_at: now
   └─ Token berlaku 24 jam
        ↓
4. KIRIM LINK
   ├─ Buat link: /reset-password/random_token_xxx?email=user@example.com
   ├─ Sistem sekarang: simpan di session (untuk testing tanpa email)
   └─ Production: kirim via email SMTP
        ↓
5. USER KLIK LINK
   ├─ Link dibuka → /reset-password/{token}
   ├─ Sistem verifikasi:
   │  • Token ada di database?
   │  • Token belum kadaluarsa (< 24 jam)?
   ├─ Jika valid → tampilkan form reset password
   └─ Jika tidak valid → error + redirect ke login
        ↓
6. INPUT PASSWORD BARU
   ├─ User masukkan password baru (minimal 6 karakter)
   ├─ User konfirmasi password (harus sama)
   └─ Submit form
        ↓
7. PROSES RESET
   ├─ Validasi input (password & confirmation)
   ├─ Verifikasi token sekali lagi
   ├─ Update password user:
   │  • Hash password dengan bcrypt
   │  • Update di tabel users
   ├─ Hapus token dari password_reset_tokens
   └─ Lanjut ke step 8
        ↓
8. BERHASIL & REDIRECT
   ├─ Tampilkan success message
   ├─ Redirect ke halaman login
   └─ User bisa login dengan password baru
```

### Database Changes Saat Reset Password:

**Sebelum Reset:**
```sql
-- PASSWORD_RESET_TOKENS
SELECT * FROM password_reset_tokens;
+---------------------+--------------------------------------+---------------------+
| email               | token                                | created_at          |
+---------------------+--------------------------------------+---------------------+
| user@example.com    | abc123xyz789def456ghi789jkl012...   | 2026-05-07 12:00:00 |
+---------------------+--------------------------------------+---------------------+

-- USERS (password lama)
SELECT * FROM users;
+----+-------+---------------------+----------+
| id | name  | email               | password |
+----+-------+---------------------+----------+
| 1  | John  | user@example.com    | $2y$12$... (hash lama) |
+----+-------+---------------------+----------+
```

**Setelah Reset Berhasil:**dengan recovery  
✅ **User-Friendly** - Interface yang intuitif dan modern  
✅ **Professional Architecture** - Mengikuti Laravel best practices  
✅ **Data Isolated** - Setiap user punya data terpisah  
✅ **Flexible Relations** - Many-to-many untuk fleksibilitas  
✅ **Password Recovery** - Fitur lupa password dengan token berbasis waktu
✅ **Time-based Token** - Token reset berlaku 24 jam untuk keamanan

-- USERS (password baru)
SELECT * FROM users;
+----+-------+---------------------+----------+
| id | name  | email               | password |
+----+-------+---------------------+----------+
| 1  | John  | user@example.com    | $2y$12$... (hash baru) |
+----+-------+-------------
- ✉️ Real email sending untuk password reset
- 🔐 Two-factor authentication (2FA)
- 📝 Email verification untuk registrasi baru
- ⏱️ Rate limiting untuk forgot password form
- 📋 Password reset history & audit log--------+----------+
## 📊 DIAGRAM RELASI DATABASE

```
┌──────────────┐
│    USERS     │
├──────────────┤
│ id (PK)      │
│ name         │
│ email        │
│ password     │
│ created_at   │
└──────┬───────┘
       │
       ├─────────────┬───────────────┐
       │             │               │
       ▼             ▼               ▼
┌──────────────┐ ┌──────────────┐ ┌──────────────┐
│    FILMS     │ │    GENRES    │ │    SERIES    │
├──────────────┤ ├──────────────┤ ├──────────────┤
│ id (PK)      │ │ id (PK)      │ │ id (PK)      │
│ judul        │ │ nama         │ │ judul        │
│ tahun_rilis  │ │ deskripsi    │ │ jumlah_ep    │
│ durasi       │ │ user_id (FK) │ │ rating       │
│ rating       │ │ created_at   │ │ user_id (FK) │
│ user_id (FK) │ └──────────────┘ │ created_at   │
│ created_at   │                  └──────────────┘
└──────┬───────┘
       │         ┌───────────────┬──────────────┐
       └────────▶│ FILM_GENRE    │ SERIES_GENRE │
                 ├───────────────┼──────────────┤
                 │ film_id (FK)  │series_id(FK) │
                 │ genre_id (FK) │ genre_id(FK) │
                 │ created_at    │ created_at   │
                 └───────────────┴──────────────┘
```

---

## 🚀 INSTALASI DAN SETUP

### Prerequisites
- PHP 8.2+
- Composer
- NPM/Node.js
- MySQL/MariaDB
- XAMPP atau web server lainnya

### Langkah Instalasi
```bash
# 1. Clone atau download project
cd c:\xampp\htdocs\film-app

# 2. Install PHP dependencies
composer install

# 3. Copy environment file
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Setup database di .env
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_DATABASE=film_app
# DB_USERNAME=root
# DB_PASSWORD=

# 6. Run migrations
php artisan migrate

# 7. Install Node dependencies
npm install

# 8. Compile assets
npm run build

# 9. Start development server
php artisan serve
```

---

## 📈 KESIMPULAN

### Keunggulan Aplikasi
✅ **Modular & Scalable** - Mudah ditambah fitur baru  
✅ **Secure** - Built-in authentication & authorization  
✅ **User-Friendly** - Interface yang intuitif  
✅ **Professional Architecture** - Mengikuti Laravel best practices  
✅ **Data Isolated** - Setiap user punya data terpisah  
✅ **Flexible Relations** - Many-to-many untuk fleksibilitas  

### Potensi Pengembangan
- 🔄 API REST untuk mobile app
- 📱 Mobile app (Flutter/React Native)
- ⭐ Update Terbaru (v1.1)
**Fitur Lupa Password Ditambahkan:**
- ✅ Forgot password form untuk input email
- ✅ Sistem token reset berbasis waktu (24 jam)
- ✅ Reset password form dengan password confirmation
- ✅ Email validation & token verification
- ✅ Secure password hashing dengan bcrypt
- ✅ Automatic token cleanup setelah digunakan
- ✅ User-friendly UI dengan Bootstrap styling

**Database Migration Baru:**
- `password_reset_tokens` table untuk menyimpan reset tokens

**Routes Baru:**
- `/forgot-password` - GET & POST
- `/reset-password/{token}` - GET & POST

### Penutup
Film App adalah solusi lengkap dan modern untuk manajemen koleksi film dan series. Dengan menggunakan Laravel dan teknologi terkini, aplikasi ini dilengkapi dengan sistem autentikasi yang aman termasuk fitur password recovery. Siap untuk scaling dan pengembangan lebih lanjut sesuai kebutuhan bisnis.

---

**Presentasi Diupdate**: 7 Mei 2026  
**Versi Aplikasi**: 1.1 (dengan fitur Lupa Password)  - 🎨 Dark mode & customization
- 🌍 Multi-language support

### Penutup
Film App adalah solusi lengkap dan modern untuk manajemen koleksi film dan series. Dengan menggunakan Laravel dan teknologi terkini, aplikasi ini siap untuk scaling dan pengembangan lebih lanjut sesuai kebutuhan bisnis.

---

**Dibuat dengan ❤️ menggunakan Laravel 12**
