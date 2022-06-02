<?php

include_once '../config/conn.php';

if ($_POST) {

    //data
    $email = $_POST['email'] ?? '';
    $pass = $_POST['pass'] ?? '';

    $respone = [];

    //cek di database
    $userQuery = $conn->prepare("SELECT * FROM petugas where email = ?");
    $userQuery->execute(array($email));
    $query = $userQuery->fetch();

    if ($userQuery->rowCount() == 0) {
        $respone['status'] = false;
        $respone['message'] = "Email Tidak Terdaftar";
    } else {
        //ambil pass
        $passDB = $query['pass'];

        // if (password_verify($pass, $passDB) === 0) {
        if (password_verify($pass, $passDB)) {
            $respone['status'] = true;
            $respone['message'] = "Login Berhasil!";
            $respone['data'] = [
                'id_admin' => $query['id_petugas'],
                'email' => $query['email'],
                'admin_name' => $query['nama']
            ];
        } else {
            $respone['status'] = false;
            $respone['message'] = "Password Anda Salah!";
        }
    }



    //jadi json
    $json = json_encode($respone, JSON_PRETTY_PRINT);
    echo $json;
}
