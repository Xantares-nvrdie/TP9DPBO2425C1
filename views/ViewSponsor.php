<?php

include_once("KontrakViewSponsor.php");
include_once("models/Sponsor.php");

class ViewSponsor implements KontrakViewSponsor {

    public function tampilSponsor($listSponsor): string {
        $tbody = "";
        $no = 1;
        foreach ($listSponsor as $sponsor) {
            $tbody .= "<tr>
                <td>$no</td>
                <td>" . htmlspecialchars($sponsor->getNama()) . "</td>
                <td>" . htmlspecialchars($sponsor->getNegara()) . "</td>
                <td>" . htmlspecialchars($sponsor->getPendanaan()) . "</td>
                <td>
                    <a href='index.php?menu=sponsor&screen=edit&id=" . $sponsor->getId() . "' class='btn btn-edit'>Edit</a>
                    <button class='btn btn-delete' data-id='" . $sponsor->getId() . "'>Hapus</button>
                </td>
            </tr>";
            $no++;
        }

        $templatePath = __DIR__ . '/../template/skinSponsor.html'; 
        
        if(file_exists($templatePath)){
            $template = file_get_contents($templatePath);
            
            //ganti teks data_tabel dengan isi tabel tbody
            $template = str_replace('DATA_TABEL', $tbody, $template);
            
            $template = str_replace('Total:', 'Total: ' . count($listSponsor), $template);
            return $template;
        } else {
            return "Error: Template skinSponsor.html tidak ditemukan.";
        }
    }

    public function tampilFormSponsor($data = null): string {
        $templatePath = __DIR__ . '/../template/formSponsor.html';
        
        if(file_exists($templatePath)){
            $template = file_get_contents($templatePath);

            //default values buat mode add
            $valAction = 'add';
            $valId = '';
            $valNama = '';
            $valNegara = '';
            $valPendanaan = '';

            //kalau ada data mode edit isi variabel dengan data tersebut
            if ($data) {
                $valAction = 'edit';
                $valId = htmlspecialchars($data['id']);
                $valNama = htmlspecialchars($data['nama']);
                $valNegara = htmlspecialchars($data['negara']);
                $valPendanaan = htmlspecialchars($data['pendanaan']);
            }

            //replace placeholder html dengan variabel php
            $template = str_replace('DATA_ACTION', $valAction, $template);
            $template = str_replace('DATA_ID', $valId, $template);
            $template = str_replace('DATA_NAMA', $valNama, $template);
            $template = str_replace('DATA_NEGARA', $valNegara, $template);
            $template = str_replace('DATA_PENDANAAN', $valPendanaan, $template);

            return $template;
        } else {
            return "Error: Template formSponsor.html tidak ditemukan.";
        }
    }
}
?>
