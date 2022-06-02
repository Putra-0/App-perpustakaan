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

$pengembalin  = new pengembalian($db);

// query pengembalin
$stmt = $pengembalin->tampil();
$num = $stmt->rowCount();

// cek jika ditemukan lebih dari 0 data pengembalin
if ($num > 0) {
    // array pengembalin
    $pengembalian_arr = array();
    $pengembalian_arr["records"] = array();

    // mengambil isi tabel
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract baris 
        extract($row);
        $pengembalian_item = array(
            "id_pengembalian" => $id_pengembalian,
            "tanggal_pinjam" => $tanggal_pinjam,
            "tanggal_pengembalian" => $tanggal_pengembalian,
            "denda" => $denda,
            "id_buku" => $id_buku,
            "id_anggota" => $id_anggota,
            "id_petugas" => $id_petugas,
        );
        array_push($pengembalian_arr["records"], $pengembalian_item);
    }

    // set response code - 200 OK
    http_response_code(200);
    // menampilkan data pengembalin dalam format json
    echo json_encode($pengembalian_arr);
} else {

    // set response code - 404 Not found
    http_response_code(404);


    echo json_encode(
        array("message" => "Data tidak ditemukan.")
    );
}
