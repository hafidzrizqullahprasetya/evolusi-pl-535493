# evolusi-pl-535493

Repository tugas **Konstruksi dan Evolusi Perangkat Lunak 2026** — Pertemuan 1: Manajemen GitHub & Prinsip CI.

- NIM: **24/535493/SV/24243** (535493)
- Nama: **Hafidz Rizqullah Prasetya**
- Kelas: **PL5A1**
- Org: [KEPL2026](https://github.com/KEPL2026)

Aplikasi web sederhana **Laravel 13** — Kalkulator IP Semester (port PHP dari `ip.js` contoh `KEPL2026/evolusi-pl-contoh`).

## Menjalankan lokal

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --force
php artisan serve      # http://127.0.0.1:8000
composer test          # php artisan test
./vendor/bin/pint --test  # cek style
```

## Struktur

| Berkas | Isi |
|---|---|
| `app/Services/IpCalculator.php` | Logika murni `bobot()` & `hitungIP()` |
| `resources/views/welcome.blade.php` | Halaman beranda |
| `resources/views/ip.blade.php` | Halaman kalkulator IP |
| `tests/Unit/IpCalculatorTest.php` | Pengujian unit |
| `tests/Feature/IpPageTest.php` | Pengujian halaman |

## Alur branch

```
feature/<sesuatu> --PR--> dev --PR--> main
```

`main` dan `dev` diproteksi — tidak boleh push langsung, wajib lewat PR dan status check hijau.

## CI

`.github/workflows/ci.yml` — dua job paralel (`uji` & `lint`) jalan di setiap push/PR ke `dev` & `main`.

## NIM

535493
# test protection
