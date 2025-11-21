<?php

interface KontrakPresenterSponsor
{
    // Method untuk menampilkan daftar sponsor
    public function tampilkanSponsor();

    // Method untuk menampilkan form sponsor
    public function tampilkanFormSponsor($id = null);

    // Method untuk CRUD sponsor
    public function tambahSponsor($nama, $negara, $pendanaan);
    public function ubahSponsor($id, $nama, $negara, $pendanaan);
    public function hapusSponsor($id);
}

?>
