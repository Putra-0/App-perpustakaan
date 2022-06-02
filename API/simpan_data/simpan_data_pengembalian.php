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

$pengembalian  = new pengembalian($db);

// query pengembalin
$stmt = $pengembalian->tampil();
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

// koneksi database dan inisialisasi object
include_once '../config/database.php';
include_once '../objects/perpustakaan.php';

$database = new Database();
$db = $database->getConnection();

$pengembalian = new pengembalian($db);

// mendapatkan data yang telah ada
$data = json_decode(file_get_contents("php://input"));

// memastikan data tidak kosong
if (
    !empty($data->id_pengembalian) &&
    !empty($data->tanggal_pinjam) &&
    !empty($data->tanggal_pengembalian) &&
    !empty($data->denda) &&
    !empty($data->id_buku) &&
    !empty($data->id_anggota) &&
    !empty($data->id_petugas)
) {

    // mengatur nilai property obat
    $data->id_pengembalian = $data->id_pengembalian;
    $data->tanggal_pinjam = $data->tanggal_pinjam;
    $data->tanggal_pengembalian = $data->tanggal_pengembalian;
    $data->denda = $data->denda;
    $data->id_buku = $data->id_buku;
    $data->id_anggota = $data->id_anggota;
    $data->id_petugas = $data->pass_anggoid_petugas;


    // menyimpan obat
    if ($pengembalian->simpan()) {

        // set response code - 201 created
        http_response_code(201);

        // data obat berhasil tersimpan
        echo json_encode(array("message" => "Data pengembalian tersimpan."));
    } else {

        // set response code - 503 service unavailable
        http_response_code(503);

        // menampilkan ke user bahwa data obat gagal disimpan
        echo json_encode(array("message" => "Gagal menyimpan data pengembalian."));
    }
}
// jika data tidak komplet
else {

    // set response code - 400 bad request
    http_response_code(400);

    // data yang dimasukkan kurang lengkap
    echo json_encode(array("message" => "Gagal menambahkan data pengembalian. Data tidak lengkap."));
}
