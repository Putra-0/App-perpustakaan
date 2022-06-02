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
            $buku = new buku($db);
            
            // mendapatkan kode_obat dari obat yang akan diedit
            $data = json_decode(file_get_contents("php://input"));
            
            // set ID property of product to be edited
            $buku->kode_buku = $data->kode_buku;
            
            // set product property values
            $buku->id_buku = $data->id_buku;
            $buku->judul_buku = $data->judul_buku;
            $buku->penulis_buku = $data->penulis_buku;
            $buku->penerbit_buku = $data->penerbit_buku;
            $buku->tahun_penerbit = $data->tahun_penerbit;
            $buku->stok = $data->stok;
            
            // update the product
            if($buku->ubah()){

                // set response code - 200 ok
                http_response_code(200);
            
                // tell the user
                echo json_encode(array("message" => "Data buku telah diubah."));
            }
            
            // if unable to update the product, tell the user
            else{
            
                // set response code - 503 service unavailable
                http_response_code(503);
            
                // tell the user
                echo json_encode(array("message" => "Gagal mengubah data buku."));
            }
        ?>