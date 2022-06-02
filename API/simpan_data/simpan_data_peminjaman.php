<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// koneksi database dan inisialisasi object
include_once '../config/database.php';
include_once '../objects/perpustakaan.php';

$database = new Database();
$db = $database->getConnection();

$peminjaman = new peminjaman($db);

// mendapatkan data yang telah ada
$data = json_decode(file_get_contents("php://input"));

// memastikan data tidak kosong
if(
!empty($data->id_pengembalian) &&
!empty($data->tanggal_pinjam) &&
!empty($data->tanggal_pengembalian) &&
!empty($data->denda) &&
!empty($data->id_buku) &&
!empty($data->id_anggota) &&
!empty($data->id_petugas)
){

// mengatur nilai property obat
$data->id_pengembalian = $data->id_pengembalian;
$data->tanggal_pinjam = $data->tanggal_pinjam;
$data->tanggal_pengembalian = $data->tanggal_pengembalian;
$data->denda = $data->denda;
$data->id_buku = $data->id_buku;
$data->d_anggota = $data->id_anggota;
$data->d_petugas = $data->d_petugas;

// menyimpan obat
if($peminjaman->simpan()){

// set response code - 201 created
http_response_code(201);

// data obat berhasil tersimpan
echo json_encode(array("message" => "Data buku tersimpan."));
}
else{

// set response code - 503 service unavailable
http_response_code(503);

// menampilkan ke user bahwa data obat gagal disimpan
echo json_encode(array("message" => "Gagal menyimpan data buku."));
}
}
// jika data tidak komplet
else{

// set response code - 400 bad request
http_response_code(400);

// data yang dimasukkan kurang lengkap
echo json_encode(array("message" => "Gagal menambahkan data buku. Data tidak lengkap."));
}
