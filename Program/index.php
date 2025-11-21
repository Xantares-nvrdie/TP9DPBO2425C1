<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("models/DB.php");

//load component pembalap
include_once("models/TabelPembalap.php");
include_once("views/ViewPembalap.php");
include_once("presenters/PresenterPembalap.php");

//load component sponsor
include_once("models/TabelSponsor.php");
include_once("views/ViewSponsor.php");
include_once("presenters/PresenterSponsor.php");

//koneksi database
$host = 'localhost';
$db = 'mvp_db';
$user = 'root';
$pass = '';

//cek menu di url, default pembalap
$menu = isset($_GET['menu']) ? $_GET['menu'] : 'pembalap';

if ($menu == 'sponsor') {
    //setup mvp buat sponsor
    $tabelSponsor = new TabelSponsor($host, $db, $user, $pass);
    $viewSponsor = new ViewSponsor();
    $presenter = new PresenterSponsor($tabelSponsor, $viewSponsor);

    //cek menampilkan form atau edit
    if (isset($_GET['screen'])) {
        if ($_GET['screen'] == 'add') {
            echo $presenter->tampilkanFormSponsor();
        } elseif ($_GET['screen'] == 'edit' && isset($_GET['id'])) {
            echo $presenter->tampilkanFormSponsor($_GET['id']);
        }
    } 
    //handling post submit data
    elseif (isset($_POST['action'])) {
        if ($_POST['action'] == 'add') {
            $presenter->tambahSponsor($_POST['nama'], $_POST['negara'], $_POST['pendanaan']);
        } elseif ($_POST['action'] == 'edit') {
            $presenter->ubahSponsor($_POST['id'], $_POST['nama'], $_POST['negara'], $_POST['pendanaan']);
        } elseif ($_POST['action'] == 'delete') { 
            $presenter->hapusSponsor($_POST['id']);
        }
        
        //redirect biar ga resubmit pas refresh
        header("Location: index.php?menu=sponsor");
        exit();
    } else {
        //tampilkan list utama sponsor
        echo $presenter->tampilkanSponsor();
    }

} else {
    //logic bawaan pembalap
    $tabelPembalap = new TabelPembalap($host, $db, $user, $pass);
    $viewPembalap = new ViewPembalap();
    $presenter = new PresenterPembalap($tabelPembalap, $viewPembalap);

    //tampilin form kalau ada
    if (isset($_GET['screen'])) {
        if ($_GET['screen'] == 'add') {
            echo $presenter->tampilkanFormPembalap();
        } elseif ($_GET['screen'] == 'edit' && isset($_GET['id'])) {
            echo $presenter->tampilkanFormPembalap($_GET['id']);
        }
    } 
    //eksekusi crud data
    elseif (isset($_POST['action'])) {
        if ($_POST['action'] == 'add') {
            $presenter->tambahPembalap($_POST['nama'], $_POST['tim'], $_POST['negara'], $_POST['poinMusim'], $_POST['jumlahMenang']);
        } elseif ($_POST['action'] == 'edit') {
            $presenter->ubahPembalap($_POST['id'], $_POST['nama'], $_POST['tim'], $_POST['negara'], $_POST['poinMusim'], $_POST['jumlahMenang']);
        } elseif ($_POST['action'] == 'delete') {
            $presenter->hapusPembalap($_POST['id']);
        }
        
        //balikin lagi ke index
        header("Location: index.php"); 
        exit();
    } else {
        //render list pembalap
        echo $presenter->tampilkanPembalap();
    }
}
?>
