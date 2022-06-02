<?php

include '../config/conn.php';

if ($_POST) {

    //post data
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
    $no_telp = filter_input(INPUT_POST, 'no_telp', FILTER_SANITIZE_STRING);
    $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);

    $response = [];

    //cek email di database
    $userQuery = $conn->prepare("SELECT * FROM petugas where email = ?");
    $userQuery->execute(array($email));


    //cek table
    if ($userQuery->rowCount() != 0) {
        //response
        $response['status'] = false;
        $response['message'] = "Email Sudah Digunakan!";
    } else {
        $insertDat = 'INSERT INTO petugas (email,pass,nama,no_telp,alamat) values (:email,:pass,:nama,:no_telp,:alamat)';
        $stmt = $conn->prepare($insertDat);

        try {
            $stmt->execute([
                ':email' => $email,
                ':pass' => $hashed_password = password_hash($pass, PASSWORD_DEFAULT),
                ':nama' => $nama,
                ':no_telp' => $no_telp,
                ':alamat' => $alamat
            ]);
            //response
            $response['status'] = true;
            $response['message'] = "Data Berhasil Ditambahkan";
            $response['data'] = [
                'email' => $email,
                'nama' => $nama
            ];
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //json
    $json = json_encode($response, JSON_PRETTY_PRINT);
    echo $json;
}
