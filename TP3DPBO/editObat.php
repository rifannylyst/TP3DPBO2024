<?php

// Mengimpor file konfigurasi database dan kelas-kelas yang diperlukan
include('config/db.php');
include('classes/DB.php');
include('classes/Obat.php'); // Mengimpor kelas Obat
include('classes/Peringatan.php'); // Mengimpor kelas Peringatan
include('classes/Produksi.php'); // Mengimpor kelas Produksi
include('classes/Template.php');

// Membuat objek obat, peringatan, dan produksi dengan koneksi ke database
$obat = new Obat($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$obat->open();

$peringatan = new Peringatan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$peringatan->open();

$optionsPeringatan = ''; // Definisikan variabel $optionsPeringatan
$peringatan->getPeringatan();
while ($row = $peringatan->getResult()) {
    $optionsPeringatan .= '<option value="' . $row['id_peringatan'] . '">' . $row['nama_peringatan'] . '</option>';
}

$produksi = new Produksi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$produksi->open();

$optionsProduksi = ''; // Definisikan variabel $optionsProduksi
$produksi->getProduksi();
while ($row = $produksi->getResult()) {
    $optionsProduksi .= '<option value="' . $row['id_produksi'] . '">' . $row['nama_produksi'] . '</option>';
}

// Mendapatkan ID obat dari URL (misalnya, melalui parameter GET)
$id_obat = $_GET['id_obat']; // Anda mungkin perlu menambahkan validasi dan perlindungan terhadap input ini

// Memanggil fungsi getObatById untuk mendapatkan data obat berdasarkan ID
$obatData = $obat->getObatById($id_obat)->getResult();

$form = '<form action="updateObat.php" method="POST" enctype="multipart/form-data">
<div class="mb-3">
    <label for="nama_obat" class="form-label">Nama Obat</label>
    <input type="text" class="form-control" id="nama_obat" name="nama_obat" value="' . $obatData['nama_obat'] . '" required>
</div>
<div class="mb-3">
    <label for="obat_foto" class="form-label">Foto Obat</label>
    <input type="file" class="form-control" id="obat_foto" name="obat_foto" accept="image/*" required>
</div>
<div class="mb-3">
    <label for="bentuk_obat" class="form-label">Bentuk Obat</label>
    <input type="text" class="form-control" id="bentuk_obat" name="bentuk_obat" value="' . $obatData['bentuk_obat'] . '" required>
</div>
<div class="mb-3">
    <label for="expired_obat" class="form-label">Expired Obat</label>
    <input type="date" class="form-control" id="expired_obat" name="expired_obat" value="' . $obatData['expired_obat'] . '" required>
</div>
<div class="mb-3">
    <select class="form-select" id="id_peringatan" name="nama_peringatan" required>
        <option selected disabled>Pilih Peringatan</option>';
$form .= $optionsPeringatan;
$form .= '</select>
</div>
<div class="mb-3">
    <label for="id_produksi" class="form-label">ID Produksi</label>
    <select class="form-select" id="id_produksi" name="id_produksi" required>
        <option selected disabled>Pilih Produksi</option>';
$form .= $optionsProduksi;
$form .= '</select>
</div>
<button type="submit" class="btn btn-primary">Update Obat</button>
</form>';

$obat->close();

// Menggunakan template untuk tampilan
$view = new Template('templates/skinform.html'); // Anda mungkin perlu menyesuaikan template yang digunakan

// Menyiapkan variabel-variabel untuk tampilan
$mainTitle = 'Edit Obat'; // Mengubah judul halaman
$header = ''; // Header tabel tidak diperlukan untuk formulir edit/update obat
$data = ''; // Data tidak diperlukan untuk formulir edit/update obat
$btn = 'Update'; // Mengubah teks tombol
$title = 'Edit'; // Mengubah judul halaman
$formLabel = 'obat'; // Label formulir tidak perlu diubah

// Mengganti placeholder pada template dengan nilai yang sesuai
$view->replace('JUDUL_TABEL', $mainTitle);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TABEL', $data);
$view->replace('DATA_FORM', $form);
$view->write();
