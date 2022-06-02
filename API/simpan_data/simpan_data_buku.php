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
            
            $buku = new buku($db);
            
            // mendapatkan data yang telah ada
            $data = json_decode(file_get_contents("php://input"));
            
            // memastikan data tidak kosong
            if(
                !empty($data->id_buku) &&
                !empty($data->kode_buku) &&
                !empty($data->judul_buku) &&
                !empty($data->penulis_buku) &&
                !empty($data->penerbit_buku) &&
                !empty($data->tahun_penerbit) &&
                !empty($data->stok)
            ){
            
                // mengatur nilai property obat
                $data->id_buku = $data->id_buku;
                $data->kode_buku = $data->kode_buku;
                $data->judul_buku = $data->judul_buku;
                $data->penerbit_buku = $data->penerbit_buku;
                $data->tahun_penerbit = $data->tahun_penerbit;
                $data->stok = $data->stok;
            
                // menyimpan obat
                if($buku->simpan()){
            
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
        ?>