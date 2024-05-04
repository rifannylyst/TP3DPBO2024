<?php

class Obat extends DB
{
    function getObatJoin()
    {
        $query = "SELECT * FROM obat JOIN peringatan ON obat.id_peringatan=peringatan.id_peringatan JOIN produksi ON obat.id_produksi=produksi.id_produksi ORDER BY obat.id_obat";

        return $this->execute($query);
    }

    function getObat()
    {
        $query = "SELECT * FROM obat";
        return $this->execute($query);
    }

    function getObatById($id)
    {
        $query = "SELECT * FROM obat JOIN peringatan ON obat.id_peringatan=peringatan.id_peringatan JOIN produksi ON obat.id_produksi=produksi.id_produksi WHERE id_obat=$id";
        return $this->execute($query);
    }

    function searchObat($keyword)
    {
        $query = "SELECT * FROM obat 
                  JOIN peringatan ON obat.id_peringatan=peringatan.id_peringatan 
                  JOIN produksi ON obat.id_produksi=produksi.id_produksi 
                  WHERE obat.nama LIKE '%$keyword%' OR peringatan.nama LIKE '%$keyword%' OR produksi.nama LIKE '%$keyword%'";
        return $this->execute($query);
    }

    function addObat($data)
    {
        $namaObat = $data['nama_obat'];
        $fotoObat = $data['obat_foto'];
        $bentukObat = $data['bentuk_obat'];
        $expiredObat = $data['expired_obat'];
        $id_peringatan = $data['id_peringatan'];
        $id_produksi = $data['id_produksi'];
        
        $query = "INSERT INTO obat (nama_obat, obat_foto, bentuk_obat, expired_obat, id_peringatan, id_produksi) 
                VALUES ('$namaObat', '$fotoObat', '$bentukObat', '$expiredObat', '$id_peringatan', '$id_produksi')";
        
        return $this->executeAffected($query);
    }


    function updateObat($id, $data)
    {
        $nama = $data['nama'];
        $id_peringatan = $data['id_peringatan'];
        $id_produksi = $data['id_produksi'];
        
        $query = "UPDATE obat SET nama='$nama', id_peringatan='$id_peringatan', id_produksi='$id_produksi' WHERE id_obat=$id";
        
        return $this->execute($query);
    }

    function deleteData($id)
    {
        $query = "DELETE FROM obat WHERE id_obat=$id";
        
        return $this->execute($query);
    }
}
?>
