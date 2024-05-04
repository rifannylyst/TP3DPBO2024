<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Peringatan.php');
include('classes/Produksi.php');
include('classes/Obat.php');
include('classes/Template.php');

// buat instance obat
$listobat = new Obat($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$listobat->open();
// tampilkan data obat
$listobat->getObatJoin();

// cari obat
if (isset($_POST['btn-cari'])) {
    // methode mencari data obat
    $listobat->searchObat($_POST['cari']);
} else {
    // method menampilkan data obat
    $listobat->getObatJoin();
}

$data = null;

// ambil data obat
// gabungkan dgn tag html
// untuk di passing ke skin/template
while ($row = $listobat->getResult()) {
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 obat-thumbnail">
        <a href="detail.php?id=' . $row['id_obat'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['obat_foto'] . '" class="card-img-top" alt="' . $row['obat_foto'] . '">
            </div>
            <div class="card-body">
                <p class="card-text obat-nama my-0">' . $row['nama_obat'] . '</p>
                <p class="card-text peringatan-nama">' . $row['nama_peringatan'] . '</p>
                <p class="card-text produksi-nama my-0">' . $row['nama_produksi'] . '</p>
            </div>
        </a>
    </div>    
    </div>';
}

// tutup koneksi
$listobat->close();

// buat instance template
$home = new Template('templates/skin.html');

// simpan data ke template
$home->replace('DATA_OBAT', $data);
$home->write();
