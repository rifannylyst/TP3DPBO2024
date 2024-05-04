<?php

// Mengimpor file konfigurasi database dan kelas-kelas yang diperlukan
include('config/db.php');
include('classes/DB.php');
include('classes/Peringatan.php');
include('classes/Template.php');

// Membuat objek peringatan dengan koneksi ke database
$peringatan = new Peringatan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$peringatan->open();

// Mengambil data peringatan dari database
$peringatan->getPeringatan();

// Menangani penambahan data peringatan
if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        // Menambahkan data peringatan ke database dan memberikan feedback kepada pengguna
        if ($peringatan->addPeringatan($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'peringatan.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'peringatan.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

// Menggunakan template untuk tampilan
$view = new Template('templates/skintabel.html');

// Menyiapkan variabel-variabel untuk tampilan
$mainTitle = 'Peringatan';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Peringatan</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'peringatan';

// Mengisi data tabel dengan hasil query
while ($div = $peringatan->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['nama_peringatan'] . '</td>
    <td style="font-size: 22px;">
        <a href="tambahObat.php?id=' . $div['id_peringatan'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="peringatan.php?hapus=' . $div['id_peringatan'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

// Menangani proses update data peringatan
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            // Mengubah data peringatan di database dan memberikan feedback kepada pengguna
            if ($peringatan->updatePeringatan($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'peringatan.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'peringatan.php';
            </script>";
            }
        }

        // Mendapatkan data peringatan yang akan diubah
        $peringatan->getPeringatanById($id);
        $row = $peringatan->getResult();

        $dataUpdate = $row['nama_peringatan'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

// Menangani proses penghapusan data peringatan
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        // Menghapus data peringatan dari database dan memberikan feedback kepada pengguna
        if ($peringatan->deletePeringatan($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'peringatan.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'peringatan.php';
            </script>";
        }
    }
}

// Menutup koneksi database
$peringatan->close();

// Mengganti placeholder pada template dengan nilai yang sesuai
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
