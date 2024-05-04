<?php

class Peringatan extends DB
{
    function getPeringatan()
    {
        $query = "SELECT * FROM peringatan";
        return $this->execute($query);
    }

    function getPeringatanById($id)
    {
        $query = "SELECT * FROM peringatan WHERE id_peringatan=$id";
        return $this->execute($query);
    }

    function addPeringatan($data)
    {
        $nama_peringatan = $data['nama_peringatan'];
        $query = "INSERT INTO peringatan (nama_peringatan) VALUES ('$nama_peringatan')";
        return $this->executeAffected($query);
    }

    function updatePeringatan($id, $data)
    {
        $nama_peringatan = $data['nama_peringatan'];
        $query = "UPDATE peringatan SET nama_peringatan='$nama_peringatan' WHERE id_peringatan=$id";
        return $this->executeAffected($query);
    }

    function deletePeringatan($id)
    {
        $query = "DELETE FROM peringatan WHERE id_peringatan=$id";
        return $this->executeAffected($query);
    }

    function getPeringatanArray()
    {
        $query = "SELECT id_peringatan, nama_peringatan FROM peringatan";
        $result = $this->execute($query);
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }
}
