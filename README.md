# evolusi-pl-535493

Tugas Konstruksi dan Evolusi Perangkat Lunak 2026 - Pertemuan 1: Manajemen GitHub & Prinsip CI

NIM: 24/535493/SV/24243
Nama: Hafidz Rizqullah Prasetya - PL5A1
Organisasi: KEPL2026

Kalkulator IP semester sederhana menggunakan Laravel 13. Logika perhitungan diambil dari contoh `KEPL2026/evolusi-pl-contoh` dan diimplementasikan ulang dalam PHP.

## Menjalankan lokal

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
# buka http://127.0.0.1:8000/ip
```

Pengujian dan cek style:

```bash
composer test
./vendor/bin/pint --test
```

## Struktur

- `app/Services/IpCalculator.php` - logika `bobot()`, `hitungIP()`, dan `validasiNIM()`
- `resources/views/ip.blade.php` - halaman kalkulator (/ip)
- `routes/web.php` - route `/ip` dan `/ip/hitung`
- `tests/Unit/IpCalculatorTest.php` - unit test

## Alur branch

Alur branch menggunakan `feature/* -> dev -> main`. Branch `dev` dan `main` diproteksi sehingga perubahan harus melalui Pull Request. CI dikonfigurasi pada `.github/workflows/ci.yml` dengan dua job (uji dan lint) yang berjalan pada setiap push dan pull request ke `dev` dan `main`.
