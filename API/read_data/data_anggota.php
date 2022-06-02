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

$anggota  = new anggota($db);

// query anggota
$stmt = $anggota->tampil();
$num = $stmt->rowCount();

// cek jika ditemukan lebih dari 0 data anggota
if($num>0){
    // array anggota
    $anggota_arr=array();
    $anggota_arr["records"]=array();

    // mengambil isi tabel
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract baris 
        extract($row);
        $anggota_item=array(
            "id_anggota" => $id_anggota,
            "nama_anggota" => $nama_anggota,
            "jk_anggota" => $jk_anggota,
            "jurusan_anggota" => $jurusan_anggota,
            "no_telp_anggota" => $no_telp_anggota,
            "alamat_anggota" => $alamat_anggota,
        );
        array_push($anggota_arr["records"], $anggota_item);
    }

    // set response code - 200 OK
    http_response_code(200);
    // menampilkan data anggota dalam format json
    echo json_encode($anggota_arr);

} else {

    // set response code - 404 Not found
    http_response_code(404);

    
    echo json_encode(
        array("message" => "Data tidak ditemukan.")
    );
}
