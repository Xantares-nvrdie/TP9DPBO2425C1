<?php
class Sponsor {
    private $id;
    private $nama;
    private $negara;
    private $pendanaan;

    public function __construct($id, $nama, $negara, $pendanaan) {
        $this->id = $id;
        $this->nama = $nama;
        $this->negara = $negara;
        $this->pendanaan = $pendanaan;
    }

    public function getId(){ return $this->id; }
    public function getNama(){ return $this->nama; }
    public function getNegara(){ return $this->negara; }
    public function getPendanaan(){ return $this->pendanaan; }
}
