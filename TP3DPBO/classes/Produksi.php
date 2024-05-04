<?php

class Produksi extends DB
{
    function getProduksi()
    {
        $query = "SELECT * FROM produksi";
        return $this->execute($query);
    }

    function getProduksiById($id)
    {
        $query = "SELECT * FROM produksi WHERE id_produksi=$id";
        return $this->execute($query);
    }

    function addProduksi($data)
    {
        $nama_produksi = $data['nama_produksi'];
        $query = "INSERT INTO produksi (nama_produksi) VALUES ('$nama_produksi')";
        return $this->executeAffected($query);
    }

    function updateProduksi($id, $data)
    {
        $nama_produksi = $data['nama_produksi'];
        $query = "UPDATE produksi SET nama_produksi='$nama_produksi' WHERE id_produksi=$id";
        return $this->executeAffected($query);
    }

    function deleteProduksi($id)
    {
        $query = "DELETE FROM produksi WHERE id_produksi=$id";
        return $this->executeAffected($query);
    }

    function getProduksiArray()
    {
        $query = "SELECT id_produksi, nama_produksi FROM produksi";
        $result = $this->execute($query);
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }
}
