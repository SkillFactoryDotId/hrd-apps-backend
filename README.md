# HRD Apps Api
Repo ini merupakan API dari aplikasi HRD dengan fitur:
- Pengajuan cuti karyawan
- Approval cuti
- Melihat sisa cuti

## Tech Stack
- Laravel 8.0
- Mysql

## Langkah Instalasi
- Lalu, sesuaikan konfigurasi anda dengan membuat file `.env`, silahkan contoh file `.env.example`
- Masuk ke direktori lalu jalankan command `php composer intall`
- jalankan `php artisan passport:keys`
- jalankan command `php artisan passport:client --password`. Simpan *Client ID* & *Client secret* yang muncul di layar

## Menjalankan aplikasi
- Jalankan command `php artisan serve`
- Aplikasi secara default diakses meggunakan port 8000
```sh
http://localhost:8000
```

## API Collection
Tersedia Collection Postman di file `api_postman_collection.json`
