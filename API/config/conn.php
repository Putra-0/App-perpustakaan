<?php

$conn = null;

try {
    $host = "localhost";
    $db_name = "perpustakaan";
    $username = "root";
    $password = "";

    $db = "mysql:dbname=$db_name;host=$host";
    $conn = new PDO($db, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    /* if ($conn) {
        echo "koneksi ok";
    } else {
        echo "koneksi gagal";
    } */
} catch (PDOException $e) {
    echo "ERORR!!" . $e->getMessage();
    die;
}
