# TP3DPBO2024

Saya Rifanny Lysara Annastasya [2200163] mengerjakan TP3 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek (DPBO) untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

### Desain Program:

### Struktur Database
1. **Tabel Obat**: Menyimpan informasi tentang obat, seperti nama obat, bentuk, expired date, ID peringatan, dan ID produksi.
2. **Tabel Peringatan**: Berisi daftar peringatan terkait penggunaan obat, misalnya efek samping atau aturan minum.
3. **Tabel Produksi**: Menyimpan informasi tentang produsen obat, seperti nama produsen.

### Kelas PHP
1. **DB**: Kelas untuk melakukan koneksi ke database dan menjalankan kueri SQL.
2. **Obat**: Kelas untuk mengelola data obat, termasuk operasi CRUD (Create, Read, Update, Delete) seperti menambah, mengambil, memperbarui, dan menghapus obat.
3. **Peringatan**: Kelas untuk mengelola data peringatan terkait obat.
4. **Produksi**: Kelas untuk mengelola data produsen obat.
5. **Template**: Kelas untuk mengelola tampilan UI menggunakan template.

### Antarmuka Pengguna (UI)
1. **Tambah Obat**: Halaman untuk menambah obat baru ke dalam database. Pengguna dapat mengisi formulir dengan informasi obat seperti nama, bentuk, expired date, peringatan, dan produsen.
2. **Edit Obat**: Halaman untuk mengedit obat yang sudah ada berdasarkan ID obat. Pengguna dapat mengubah informasi obat yang telah ada.
3. **Detail Obat**: Halaman untuk menampilkan detail obat berdasarkan ID obat. Pengguna dapat melihat informasi detail tentang obat, termasuk gambar, nama, bentuk, expired date, peringatan, dan produsen.
4. **Daftar Obat**: Halaman untuk menampilkan daftar semua obat yang tersedia. Pengguna dapat melihat daftar obat dan melakukan tindakan seperti mengedit atau menghapus obat.

### Penjelasan Alur:

### Tambah Obat (addObat.php)
1. **Inisialisasi**: Koneksi ke database dilakukan melalui objek `Obat`.
2. **Pengambilan Data**: Data peringatan dan produksi diambil dari database untuk digunakan dalam formulir tambah obat.
3. **Formulir**: Formulir HTML disiapkan dengan opsi dropdown untuk peringatan dan produksi.
4. **Penanganan Formulir**: Saat pengguna mengirimkan formulir, data obat yang diisi dikirimkan ke server menggunakan metode POST.
5. **Validasi**: Validasi sederhana dapat dilakukan pada data yang diterima dari formulir.
6. **Penyimpanan**: Jika data valid, informasi obat baru disimpan ke database menggunakan metode `updateObat` dari objek `Obat`.
7. **Pesan Feedback**: Pesan sukses atau gagal ditampilkan kepada pengguna menggunakan JavaScript `alert`.
8. **Penutup**: Koneksi database ditutup.

### Edit Obat (editObat.php)
1. **Inisialisasi**: Koneksi ke database dilakukan melalui objek `Obat`.
2. **Pengambilan Data**: Data obat yang akan diedit diambil dari database berdasarkan ID yang diberikan.
3. **Formulir**: Formulir HTML disiapkan dengan data obat yang diambil dari langkah sebelumnya.
4. **Penanganan Formulir**: Saat pengguna mengirimkan formulir, data obat yang diisi dikirimkan ke server menggunakan metode POST.
5. **Validasi**: Validasi sederhana dapat dilakukan pada data yang diterima dari formulir.
6. **Pembaruan**: Jika data valid, informasi obat diperbarui di database menggunakan metode `updateObat` dari objek `Obat`.
7. **Pesan Feedback**: Pesan sukses atau gagal ditampilkan kepada pengguna menggunakan JavaScript `alert`.
8. **Penutup**: Koneksi database ditutup.

### Detail Obat (detailObat.php)
1. **Inisialisasi**: Koneksi ke database dilakukan melalui objek `Obat`.
2. **Pengambilan Data**: Data obat yang akan ditampilkan diambil dari database berdasarkan ID yang diberikan.
3. **Tampilan**: Informasi obat ditampilkan dalam bentuk tabel atau kartu menggunakan HTML.
4. **Pembaruan Obat**: Pengguna dapat mengklik tombol "Ubah Data" untuk menuju halaman edit obat.

### Koneksi Database (DB.php)
1. **Inisialisasi**: Koneksi ke database MySQL dilakukan menggunakan fungsi bawaan PHP `mysqli`.
2. **Eksekusi Query**: Metode `execute` digunakan untuk menjalankan kueri SQL di database.
3. **Penanganan Kesalahan**: Kesalahan kueri ditangani dan dilemparkan sebagai pengecualian untuk ditangani oleh pemanggil kelas.

### Kelas Obat (Obat.php)
1. **Metode `getObatById`**: Mengambil informasi obat dari database berdasarkan ID.
2. **Metode `updateObat`**: Memperbarui informasi obat di database.


### Desain Database:

**Tabel "obat"**
- `id_obat` (Primary Key): Menyimpan ID unik untuk setiap obat.
- `nama_obat`: Menyimpan nama obat.
- `obat_foto`: Menyimpan path atau URL ke gambar obat (jika ada).
- `bentuk_obat`: Menyimpan informasi tentang bentuk fisik obat (tablet, kapsul, sirup, dll.).
- `expired_obat`: Menyimpan tanggal kedaluwarsa obat.
- `peringatan_id` (Foreign Key): Menghubungkan ke tabel "peringatan" untuk menunjukkan peringatan yang terkait dengan obat.
- `produksi_id` (Foreign Key): Menghubungkan ke tabel "produksi" untuk menunjukkan pabrik mana yang memproduksi obat.

**Tabel "peringatan"**
- `id_peringatan` (Primary Key): Menyimpan ID unik untuk setiap peringatan.
- `nama_peringatan`: Menyimpan deskripsi peringatan.

**Tabel "produksi"**
- `id_produksi` (Primary Key): Menyimpan ID unik untuk setiap pabrik produksi.
- `nama_produksi`: Menyimpan nama pabrik produksi.

### Penjelasan:

1. **Tabel "obat"**: Tabel ini berisi informasi rinci tentang setiap obat, termasuk nama, foto, bentuk fisik, tanggal kedaluwarsa, serta kunci asing yang merujuk ke tabel "peringatan" dan "produksi". Misalnya, jika kita memiliki obat tertentu dengan ID 1, kita dapat menemukan informasi tentang obat tersebut di sini, seperti namanya, gambar, bentuk fisik, dan kapan akan kedaluwarsa. Kunci asing `peringatan_id` akan merujuk ke tabel "peringatan" untuk menunjukkan peringatan apa yang terkait dengan obat tersebut. Kunci asing `produksi_id` akan merujuk ke tabel "produksi" untuk menunjukkan pabrik mana yang memproduksi obat tersebut.

2. **Tabel "peringatan"**: Tabel ini berisi daftar peringatan yang mungkin terkait dengan obat tertentu. Misalnya, peringatan tentang efek samping atau interaksi obat dapat disimpan di sini.

3. **Tabel "produksi"**: Tabel ini berisi daftar pabrik produksi yang memproduksi obat-obatan. Informasi tentang pabrik produksi, seperti nama dan lokasi, dapat disimpan di sini.

### Dokumentasi:
![TP3DPBO](https://github.com/rifannylyst/TP3DPBO2024/assets/147616851/c32e293e-69ce-4130-bafe-48fcc391bca5)


