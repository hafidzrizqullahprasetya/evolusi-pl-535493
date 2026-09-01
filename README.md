# evolusi-pl-535493

Tugas KEPL 2026 Pertemuan 1 - Manajemen GitHub & Prinsip CI

NIM: 24/535493/SV/24243 (535493)
Nama: Hafidz Rizqullah Prasetya
Kelas: PL5A1

Aplikasi kalkulator IP semester sederhana pakai Laravel 13. Buat tugas KEPL, logikanya ngikutin contoh dari KEPL2026/evolusi-pl-contoh tapi aku port ke PHP.

## Cara jalanin

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
# buka http://127.0.0.1:8000/ip
```

test & cek style:

```bash
composer test
./vendor/bin/pint --test
```

## File penting

- `app/Services/IpCalculator.php` - logic hitung IP sama validasi NIM
- `resources/views/ip.blade.php` - halaman kalkulator (/ip)
- `routes/web.php` - route /ip sama /ip/hitung
- `tests/Unit/IpCalculatorTest.php` - unit test

## Alur branch

aku pakai `feature/* -> dev -> main`, yang `dev` sama `main` diprotect jadi harus lewat PR baru bisa ke-merge. CI nya ada di `.github/workflows/ci.yml` isinya 2 job (uji sama lint) jalan tiap push/PR ke dev & main.
