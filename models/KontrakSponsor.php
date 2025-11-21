<?php

interface KontrakSponsor {
    public function getAllSponsor(): array;
    public function getSponsorById($id): ?array;

    // Method CRUD Sponsor
    public function addSponsor($nama, $negara, $pendanaan): void;
    public function updateSponsor($id, $nama, $negara, $pendanaan): void;
    public function deleteSponsor($id): void;
}
?>
