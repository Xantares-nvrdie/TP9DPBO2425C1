# TP9DPBO2425C1
TUGAS PRAKTIKUM 9 DPBO MVP PHP Bintang Fajar Putra Pamungkas (2405073) Ilmu Komputer C1 Universitas Pendidikan Indonesia

Aplikasi sederhana berbasis web untuk mengelola data **Pembalap** dan **Sponsor**. Aplikasi ini dibangun menggunakan bahasa pemrograman PHP Native dengan menerapkan arsitektur **MVP (Model-View-Presenter)** secara ketat.


## JANJI
Saya Bintang Fajar Putra Pamungkas mengerjakan evaluasi Tugas Praktikum 9 dalam mata kuliah Desain Pemrograman Berbasis Objek untuk keberkahan-Nya, maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

## 🚀 Fitur Utama

* **CRUD Pembalap**: Create, Read, Update, Delete data pembalap F1.
* **CRUD Sponsor**: Create, Read, Update, Delete data sponsor balapan.
* **Routing Menu**: Navigasi perpindahan antara fitur Pembalap dan Sponsor.
* **Interface Contracts**: Penerapan kontrak (interface) untuk setiap komponen MVP guna menjaga konsistensi kode.
* **Template Engine Sederhana**: Pemisahan logika PHP dan tampilan HTML menggunakan sistem *parsing template*.

## 📂 Desain & Struktur Program

Program ini memisahkan kode menjadi tiga layer utama sesuai pola MVP:

1.  **Model**: Bertanggung jawab untuk koneksi database dan manipulasi data (query SQL).
2.  **View**: Bertanggung jawab untuk menampilkan antarmuka (HTML) ke pengguna. Tidak boleh ada logika database di sini.
3.  **Presenter**: Bertanggung jawab sebagai jembatan. Menerima input dari View, memprosesnya lewat Model, dan mengembalikan hasilnya ke View.

### Struktur Folder
```
/project-root
│
├── index.php                  # Entry point & Routing utama
├── mvp_db.sql                 # File database SQL
│
├── models/                    # Layer Data Access & Interface Model
│   ├── DB.php                 
│   ├── KontrakModel.php       
│   ├── KontrakSponsor.php     
│   ├── TabelPembalap.php      
│   ├── TabelSponsor.php       
│   ├── Pembalap.php           
│   └── Sponsor.php            
│
├── views/                     # Layer Tampilan Logic & Interface View
│   ├── KontrakView.php        
│   ├── KontrakViewSponsor.php 
│   ├── ViewPembalap.php       
│   └── ViewSponsor.php        
│
├── presenters/                # Layer Logic Bisnis & Interface Presenter
│   ├── KontrakPresenter.php       
│   ├── KontrakPresenterSponsor.php
│   ├── PresenterPembalap.php  
│   └── PresenterSponsor.php   
│
└── template/                  # File HTML Murni (Skin)
    ├── skin.html              
    ├── form.html              
    ├── skinSponsor.html       
    └── formSponsor.html
```

## 🔄 Alur Program (Program Flow)

1.  **Inisialisasi**: User mengakses `index.php`.
2.  **Routing**: Sistem mengecek parameter URL `?menu=`.
    * Jika `menu=sponsor`, sistem memuat komponen MVP Sponsor.
    * Jika kosong/default, sistem memuat komponen MVP Pembalap.
3.  **Read (Tampil Data)**:
    * `index.php` memanggil `Presenter->tampilkan...()`
    * `Presenter` meminta data ke `Model`.
    * `Model` query `SELECT` ke database dan mengembalikan array data.
    * `Presenter` mengolah data menjadi Objek dan mengirimnya ke `View`.
    * `View` memuat file HTML dari folder `template/`, me-replace *placeholder* data, dan merender halaman.
4.  **Create/Update/Delete (Aksi)**:
    * Form mengirim data via `POST` ke `index.php`.
    * `index.php` menangkap `$_POST['action']` (add/edit/delete).
    * `Presenter` diperintahkan mengeksekusi metode yang sesuai di `Model`.
    * Setelah sukses, halaman di-*redirect* kembali ke daftar tabel.

## 💿 Struktur Program

### 📂 1. Root Folder (Folder Utama)
Tempat "pintu masuk" aplikasi berada.

* **📄 `index.php`**
    * **Fungsi:** Entry point utama (Router).
    * **Analogi:** **"Si Bos"** atau Resepsionis.
    * **Tugas:** Menerima semua request dari browser, mengecek URL (`?menu=sponsor`), dan memanggil Presenter yang sesuai. File ini juga menangani logika *redirect* setelah submit form.
* **📄 `mvp_db.sql`**
    * **Fungsi:** Skema Database.
    * **Analogi:** **"Cetak Biru"**.
    * **Tugas:** Berisi perintah SQL untuk membuat database `mvp_db` beserta tabel `pembalap` dan `sponsor`.


### 📂 2. Folder `models/` (Layer Data)
Folder ini adalah **"Gudang"**. Isinya hanya peduli soal koneksi database, query SQL, dan struktur data. Tidak peduli soal tampilan/warna.

* **📄 `DB.php`**
    * **Fungsi:** Wrapper koneksi database menggunakan PDO.
    * **Tugas:** Menghubungkan PHP ke MySQL dengan aman (mencegah SQL Injection).
* **📄 `Pembalap.php` & `Sponsor.php`**
    * **Fungsi:** Data Object Class (POJO).
    * **Analogi:** **"Wadah/Kontainer"**.
    * **Tugas:** Hanya kerangka untuk menampung data (seperti `id`, `nama`, `negara`). Tidak ada query SQL di sini.
* **📄 `TabelPembalap.php` & `TabelSponsor.php`**
    * **Fungsi:** Data Access Object (DAO).
    * **Analogi:** **"Petugas Gudang"**.
    * **Tugas:** Melakukan pekerjaan berat seperti query `SELECT`, `INSERT`, `UPDATE`, dan `DELETE` ke database.
* **📄 `KontrakModel.php` & `KontrakSponsor.php`**
    * **Fungsi:** Interface.
    * **Analogi:** **"Surat Kontrak Kerja"**.
    * **Tugas:** Menetapkan aturan wajib metode apa saja yang harus dimiliki oleh Model (misal: wajib punya fungsi `add()`, `delete()`).


### 📂 3. Folder `views/` (Layer Tampilan Logic)
Folder ini adalah **"Tukang Dekor"**. Tugasnya menyiapkan data agar siap ditampilkan di HTML.

* **📄 `ViewPembalap.php` & `ViewSponsor.php`**
    * **Fungsi:** Template Engine logic.
    * **Tugas:** Membaca file HTML mentah dari folder `template/`, lalu mencari "Kata Kunci" (seperti `DATA_TABEL` atau `DATA_NAMA`) dan menimpanya dengan data asli dari database.
* **📄 `KontrakView.php` & `KontrakViewSponsor.php`**
    * **Fungsi:** Interface View.
    * **Tugas:** Menetapkan aturan standar bahwa setiap View wajib memiliki metode untuk menampilkan data dan menampilkan form.


### 📂 4. Folder `presenters/` (Layer Logika Bisnis)
Folder ini adalah **"Manajer"**. Model dan View tidak saling kenal, mereka dihubungkan oleh Presenter.

* **📄 `PresenterPembalap.php` & `PresenterSponsor.php`**
    * **Fungsi:** Otak utama aplikasi.
    * **Analogi:** **"Koki/Chef"**.
    * **Tugas:**
        1.  Diperintah oleh `index.php`.
        2.  Meminta data mentah ke `Model`.
        3.  Mengolah data tersebut.
        4.  Menyerahkan data matang ke `View` untuk ditampilkan.
* **📄 `KontrakPresenter.php` & `KontrakPresenterSponsor.php`**
    * **Fungsi:** Interface Presenter.
    * **Analogi:** **"SOP Manajer"**.
    * **Tugas:** Menentukan fitur apa saja yang harus tersedia (CRUD: Tambah, Ubah, Hapus, Tampil).


### 📂 5. Folder `template/` (Skin / UI)
Folder ini berisi **HTML Murni**. Ibarat "baju" atau "piring" aplikasi.

* **📄 `skin.html` & `skinSponsor.html`**
    * **Fungsi:** Kerangka halaman tabel (List Data).
    * **Fitur:** Berisi struktur tabel HTML dan placeholder `DATA_TABEL` yang nanti akan diganti oleh PHP.
* **📄 `form.html` & `formSponsor.html`**
    * **Fungsi:** Kerangka halaman formulir (Input Data).
    * **Fitur:** Berisi input field dan placeholder `DATA_NAMA`, `DATA_ID` untuk fitur *pre-fill* saat Edit data.
 
## 📸 Demo

https://github.com/user-attachments/assets/b22ce810-475c-4d12-b690-1d65f6f03339


