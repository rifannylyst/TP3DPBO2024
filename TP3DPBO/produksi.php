<?php

// Mengimpor file konfigurasi database dan kelas-kelas yang diperlukan
include('config/db.php');
include('classes/DB.php');
include('classes/Produksi.php');
include('classes/Template.php');

// Membuat objek produksi dengan koneksi ke database
$produksi = new Produksi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$produksi->open();

// Mengambil data produksi dari database
$produksi->getProduksi();

// Menangani penambahan data produksi
if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        // Menambahkan data produksi ke database dan memberikan feedback kepada pengguna
        if ($produksi->addProduksi($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'produksi.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'produksi.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

// Menggunakan template untuk tampilan
$view = new Template('templates/skintabel.html');

// Menyiapkan variabel-variabel untuk tampilan
$mainTitle = 'Produksi';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Produksi</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'produksi';

// Mengisi data tabel dengan hasil query
while ($div = $produksi->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['nama_produksi'] . '</td>
    <td style="font-size: 22px;">
        <a href="tambahObat.php?id=' . $div['id_produksi'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="produksi.php?hapus=' . $div['id_produksi'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

// Menangani proses update data produksi
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            // Mengubah data produksi di database dan memberikan feedback kepada pengguna
            if ($produksi->updateProduksi($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'produksi.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'produksi.php';
            </script>";
            }
        }

        // Mendapatkan data produksi yang akan diubah
        $produksi->getProduksiById($id);
        $row = $produksi->getResult();

        $dataUpdate = $row['nama_produksi'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

// Menangani proses penghapusan data produksi
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        // Menghapus data produksi dari database dan memberikan feedback kepada pengguna
        if ($produksi->deleteProduksi($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'produksi.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'produksi.php';
            </script>";
        }
    }
}

// Menutup koneksi database
$produksi->close();

// Mengganti placeholder pada template dengan nilai yang sesuai
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
