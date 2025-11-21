<?php

include_once("KontrakPresenterSponsor.php");
include_once("models/Sponsor.php");

class PresenterSponsor implements KontrakPresenterSponsor {
    private $tabelSponsor;
    private $viewSponsor;

    public function __construct($tabelSponsor, $viewSponsor){
        $this->tabelSponsor = $tabelSponsor;
        $this->viewSponsor = $viewSponsor;
    }

    public function tampilkanSponsor() {
        //ambil data raw array asosiatif dari model
        $data = $this->tabelSponsor->getAllSponsor();
        
        //konversi array asosiatif menjadi array of objects class sponsor
        $listSponsor = [];
        foreach($data as $row){
            $listSponsor[] = new Sponsor(
                $row['id'], 
                $row['nama'], 
                $row['negara'], 
                $row['pendanaan']
            );
        }
        
        //kirim array objek ke view
        return $this->viewSponsor->tampilSponsor($listSponsor);
    }

    public function tampilkanFormSponsor($id = null) {
        $data = null;
        if ($id) {
            //ambil data spesifik untuk mode edit
            $data = $this->tabelSponsor->getSponsorById($id);
        }
        //tampilkan form data kosong jika add data terisi jika edit
        return $this->viewSponsor->tampilFormSponsor($data);
    }

    public function tambahSponsor($nama, $negara, $pendanaan) {
        $this->tabelSponsor->addSponsor($nama, $negara, $pendanaan);
    }

    public function ubahSponsor($id, $nama, $negara, $pendanaan) {
        $this->tabelSponsor->updateSponsor($id, $nama, $negara, $pendanaan);
    }

    public function hapusSponsor($id) {
        $this->tabelSponsor->deleteSponsor($id);
    }
}
?>
