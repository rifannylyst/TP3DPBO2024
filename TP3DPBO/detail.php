<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Peringatan.php');
include('classes/Produksi.php');
include('classes/Obat.php');
include('classes/Template.php');

$obat = new Obat($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$obat->open();

$data = nulL;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $obat->getObatById($id);
        $row = $obat->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['nama_obat'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['obat_foto'] . '" class="img-thumbnail" alt="' . $row['obat_foto'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>' . $row['nama_obat'] . '</td>
                                </tr>
                                <tr>
                                    <td>Bentuk</td>
                                    <td>:</td>
                                    <td>' . $row['bentuk_obat'] . '</td>
                                </tr>
                                <tr>
                                    <td>Expired</td>
                                    <td>:</td>
                                    <td>' . $row['expired_obat'] . '</td>
                                </tr>
                                <tr>
                                    <td>Peringatan</td>
                                    <td>:</td>
                                    <td>' . $row['nama_peringatan'] . '</td>
                                </tr>
                                <tr>
                                    <td>Produksi</td>
                                    <td>:</td>
                                    <td>' . $row['nama_produksi'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="tambahObat.php?id=<?php echo $id; ?>"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
                <a href="index.php"><button type="button" class="btn btn-danger">Hapus Data</button></a>
            </div>';
    }
}

$obat->close();
$detail = new Template('templates/skindetail.html');
$detail->replace('DATA_DETAIL_OBAT', $data);
$detail->write();
