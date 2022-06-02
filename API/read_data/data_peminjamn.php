<?php

// header untuk membatasi akses dan jenis konten
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include file database dan object
include_once '../config/database.php';
include_once '../objects/perpustakaan.php';

// inisialisasi database dan objek
$database = new database();
$db = $database->getConnection();

$peminjaman = new peminjaman($db);

// query buku
$stmt = $peminjaman->tampil();
$num = $stmt->rowCount();

// cek jika ditemukan lebih dari 0 data buku
if ($num > 0) {
    // array peminjaman
    $peminjaman_arr = array();
    $peminjaman_arr["records"] = array();

    // mengambil isi tabel
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract baris 
        extract($row);
        $peminjaman_item = array(
            "id_peminjaman" => $id_peminjaman,
            "tanggal_pinjam" => $tanggal_pinjam,
            "id_anggota" => $id_anggota,
            "id_petugas" => $id_petugas,



        );
        array_push($peminjaman_arr["records"], $peminjaman_item);
    }

    // set response code - 200 OK
    http_response_code(200);
    // menampilkan data peminjaman dalam format json
    echo json_encode($peminjaman_arr);
} else {

    // set response code - 404 Not found
    http_response_code(404);


    echo json_encode(
        array("message" => "buku sudah dipinjam")
    );
}
