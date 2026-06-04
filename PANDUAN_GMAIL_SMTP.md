# 📧 PANDUAN KONFIGURASI GMAIL SMTP UNTUK FILM APP

## Status Saat Ini

File `.env` Anda sekarang:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_ENCRYPTION=tls
MAIL_SCHEME=tls
MAIL_USERNAME=your_email@gmail.com          ← Ganti dengan email Gmail Anda
MAIL_PASSWORD=your_email_app_password       ← Perlu App Password atau password akun
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="Film App"
```

---

## ✅ CARA MENDAPATKAN APP PASSWORD GMAIL

### Prasyarat
- Akun Gmail Anda harus mengaktifkan **Two-Factor Authentication (2FA/Verifikasi 2 Langkah)**
- Browser dengan akses ke Google Account settings

### Langkah Demi Langkah

#### 1. Buka Google Account Settings
- Kunjungi: [https://myaccount.google.com](https://myaccount.google.com)
- Login dengan akun Gmail Anda

#### 2. Navigasi ke Security
- Pilih **Security** dari menu sidebar kiri
- Atau langsung: [https://myaccount.google.com/security](https://myaccount.google.com/security)

#### 3. Pastikan 2FA Sudah Aktif
```
Langkah-langkah:
1. Cari "2-Step Verification" 
2. Jika belum aktif, klik "Enable 2-Step Verification"
3. Ikuti instruksi (pilih phone number, verifikasi kode)
4. Setelah aktif, lanjut ke langkah 4
```

#### 4. Buka App Passwords
```
Setelah 2FA aktif:
1. Kembali ke Security page
2. Cari "App passwords" (akan muncul jika 2FA aktif)
3. Klik "App passwords"
4. Pilih:
   - Select app: Mail
   - Select device: Windows Computer
5. Klik "Generate"
```

#### 5. Copy App Password
```
Google akan generate password seperti: 
xxxx xxxx xxxx xxxx (16 karakter dengan spasi)

Contoh: abcd efgh ijkl mnop
```

---

## 🔧 UPDATE FILE .ENV

### Sebelum (Placeholder)
```env
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_email_app_password
MAIL_FROM_ADDRESS=your_email@gmail.com
```

### Sesudah (Dengan Nilai Asli)
```env
MAIL_USERNAME=nama.anda@gmail.com
MAIL_PASSWORD=abcd efgh ijkl mnop
MAIL_FROM_ADDRESS=nama.anda@gmail.com
```

**Catatan:** 
- Copy App Password tanpa spasi untuk `.env`
- Contoh: `abcdefghijklmnop`

---

## 📋 KONFIGURASI LENGKAP UNTUK BERBAGAI PROVIDER

### ✅ Gmail (dengan 2FA + App Password)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_ENCRYPTION=tls
MAIL_SCHEME=tls
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="Film App"
```

### ✅ Gmail (Tanpa 2FA - NOT RECOMMENDED)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_ENCRYPTION=tls
MAIL_SCHEME=tls
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_account_password
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="Film App"

# Catatan: Metode ini tidak aman dan sering diblokir Google
# Gunakan App Password lebih direkomendasikan
```

### ✅ Outlook/Hotmail
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.office365.com
MAIL_PORT=587
MAIL_ENCRYPTION=tls
MAIL_SCHEME=tls
MAIL_USERNAME=your_email@outlook.com
MAIL_PASSWORD=your_account_password
MAIL_FROM_ADDRESS=your_email@outlook.com
MAIL_FROM_NAME="Film App"
```

### ✅ Yahoo Mail
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mail.yahoo.com
MAIL_PORT=587
MAIL_ENCRYPTION=tls
MAIL_SCHEME=tls
MAIL_USERNAME=your_email@yahoo.com
MAIL_PASSWORD=your_app_password
MAIL_FROM_ADDRESS=your_email@yahoo.com
MAIL_FROM_NAME="Film App"

# Catatan: Yahoo juga perlu App Password untuk keamanan
```

### ✅ Custom SMTP Server
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.your-domain.com
MAIL_PORT=587
MAIL_ENCRYPTION=tls
MAIL_SCHEME=tls
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_FROM_ADDRESS=your_email@your-domain.com
MAIL_FROM_NAME="Film App"
```

---

## 🧪 TEST KONFIGURASI MAIL

### Setelah mengisi `.env`, test dengan artisan command:

```bash
# Test basic mail configuration
php artisan tinker

>>> Mail::raw('Test email body', function ($message) {
    $message->to('test@example.com')->subject('Test Email');
});

# Jika ada error, akan ditampilkan di sini
# Jika success, check inbox email tujuan
```

### Alternative: Test dengan route temporary

Tambahkan route sementara di `routes/web.php`:

```php
Route::get('/test-mail', function () {
    Mail::to('your_email@gmail.com')->send(new \App\Mail\ResetPasswordMail('http://test.com'));
    return 'Email sent!';
});
```

Kemudian buka: `http://localhost:8000/test-mail`

---

## ⚠️ TROUBLESHOOTING

### Error: "SMTP Error: Could not authenticate"
**Penyebab:** Username atau password salah
**Solusi:**
1. Pastikan 2FA sudah aktif di akun Gmail
2. Generate App Password lagi
3. Copy paste tanpa spasi ke `.env`
4. Restart Laravel dengan `php artisan serve`

### Error: "Connection timed out"
**Penyebab:** Port atau host salah
**Solusi:**
1. Pastikan `MAIL_PORT=587` (untuk TLS)
2. Jika ingin SSL, gunakan `MAIL_PORT=465` dan `MAIL_ENCRYPTION=ssl`
3. Check firewall apakah blokir port 587

### Error: "From address not verified"
**Penyebab:** `MAIL_FROM_ADDRESS` berbeda dengan `MAIL_USERNAME`
**Solusi:**
```env
# Pastikan sama
MAIL_USERNAME=email@gmail.com
MAIL_FROM_ADDRESS=email@gmail.com
```

### Email tidak masuk ke inbox (masuk Spam)
**Penyebab:** Email dari aplikasi lokal dianggap suspicious
**Solusi:**
1. Check folder Spam/Junk di email tujuan
2. Tambahkan sender ke contacts
3. Di production, reputasi domain akan membantu
4. Gunakan DKIM/SPF records di domain Anda (production only)

---

## ✅ CHECKLIST SETUP

```
☐ 2FA sudah aktif di Gmail
☐ App Password sudah generate
☐ MAIL_USERNAME diisi dengan email Gmail
☐ MAIL_PASSWORD diisi dengan App Password (tanpa spasi)
☐ MAIL_FROM_ADDRESS sama dengan MAIL_USERNAME
☐ MAIL_HOST=smtp.gmail.com
☐ MAIL_PORT=587
☐ MAIL_ENCRYPTION=tls
☐ File .env sudah disave
☐ Laravel sudah di-restart (php artisan serve)
☐ Test email terkirim ke inbox
```

---

## 📌 IMPORTANT NOTES

1. **Security:** Jangan commit file `.env` ke Git repository
2. **App Password:** Hanya berlaku untuk akun Google Anda, aman untuk digunakan
3. **Production:** Gunakan environment variables dari hosting provider, jangan hardcode di `.env`
4. **Test Dulu:** Sebelum production, test pengiriman email di local dulu

---

## 🔗 HELPFUL LINKS

- [Google Account Security Settings](https://myaccount.google.com/security)
- [Gmail SMTP Settings](https://support.google.com/mail/answer/7126229)
- [Laravel Mail Documentation](https://laravel.com/docs/12.x/mail)
- [Generate Gmail App Password](https://myaccount.google.com/apppasswords)

---

**Setelah selesai setup, reply saya dengan status dan saya bisa bantu test lebih lanjut!**
