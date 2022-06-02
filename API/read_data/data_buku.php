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

$buku  = new buku($db);

// query buku
$stmt = $buku->tampil();
$num = $stmt->rowCount();

// cek jika ditemukan lebih dari 0 data buku
if ($num > 0) {
    // array buku
    $buku_arr = array();
    $buku_arr["records"] = array();

    // mengambil isi tabel
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract baris 
        extract($row);
        $buku_item = array(
            "id_buku" => $id_buku,
            "judul_buku" => $judul_buku,
            "penulis_buku" => $penulis_buku,
            "penerbit_buku" => $penerbit_buku,
            "tahun_penerbit" => $tahun_penerbit,
            "stok" => $stok,
        );
        array_push($buku_arr["records"], $buku_item);
    }

    // set response code - 200 OK
    http_response_code(200);
    // menampilkan data buku dalam format json
    echo json_encode($buku_arr);
} else {

    // set response code - 404 Not found
    http_response_code(404);


    echo json_encode(
        array("message" => "Data tidak ditemukan.")
    );
}
?>

// query buku
$stmt = $buku->tampil();
$num = $stmt->rowCount();

// cek jika ditemukan lebih dari 0 data buku
if($num>0){
// array buku
$buku_arr=array();
$buku_arr["records"]=array();

// mengambil isi tabel
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
// extract baris
extract($row);
$buku_item=array(
"id_buku" => $id_buku,
"judul_buku" => $judul_buku,
"penulis_buku" => $penulis_buku,
"penerbit_buku" => $penerbit_buku,
"tahun_penerbit" => $tahun_penerbit,
"stok" => $stok,
);
array_push($buku_arr["records"], $buku_item);
}

// set response code - 200 OK
http_response_code(200);
// menampilkan data buku dalam format json
echo json_encode($buku_arr);

} else {

// set response code - 404 Not found
http_response_code(404);


echo json_encode(
array("message" => "Data tidak ditemukan.")
);
}
?>