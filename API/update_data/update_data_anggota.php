<?php
            // required headers
            header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=UTF-8");
            header("Access-Control-Allow-Methods: POST");
            header("Access-Control-Max-Age: 3600");
            header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
            
            // include database and object files
            include_once '../config/database.php';
            include_once '../objects/perpustakaan.php';
            
            // koneksi database
            $database = new Database();
            $db = $database->getConnection();
            
            // menyiapkan obat object
            $anggota = new anggota($db);
            
            // mendapatkan kode_obat dari obat yang akan diedit
            $data = json_decode(file_get_contents("php://input"));
            
            // set ID property of product to be edited
            $anggota->kode_anggota = $data->kode_anggota;
            
            // set product property values
            $anggota->id_anggota = $data->id_anggota;
            $anggota->nama_anggota = $data->nama_anggota;
            $anggota->jk_anggota = $data->jk_anggota;
            $anggota->jurusan_anggota = $data->jurusan_anggota;
            $anggota->no_telp_anggota = $data->no_telp_anggota;
            $anggota->alamat_anggota = $data->alamat_anggota;
            $anggota->email_anggota = $data->email_anggota;
            $anggota->pass_anggota = $data->pass_anggota;
            
            // update the product
            if($anggota->ubah()){

                // set response code - 200 ok
                http_response_code(200);
            
                // tell the user
                echo json_encode(array("message" => "Data anggota telah diubah."));
            }
            
            // if unable to update the product, tell the user
            else{
            
                // set response code - 503 service unavailable
                http_response_code(503);
            
                // tell the user
                echo json_encode(array("message" => "Gagal mengubah data anggota."));
            }
        ?>