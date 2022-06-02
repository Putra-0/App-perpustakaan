<?php

class buku
{

    // koneksi database beserta nama tabel
    private $conn;
    private $table_name = "buku";

    // object properties (kolom pada tabel buku)
    public $id_buku;
    public $judul_buku;
    public $penulis_buku;
    public $penerbit_buku;
    public $tahun_penerbit;
    public $stok;

    // constructor untuk koneksi database
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // function untuk READ semua data BUKU
    function tampil()
    {
        // query untuk menampilkan semua data
        $query = "SELECT * FROM buku ORDER BY  id_buku  ASC";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // eksekusi query
        $stmt->execute();
        return $stmt;
    }


    // function untuk CREATE data BUKU
    function simpan()
    {
        // query untuk menyimpan data 
        $query = "INSERT INTO " . $this->buku . "
         VALUES(:id_buku, :judul_buku, :penulis_buku, :penerbit_buku, :tahun_penerbit, :stok)";
        // prepare query
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->id_buku = htmlspecialchars(strip_tags($this->id_buku));
        $this->judul_buku = htmlspecialchars(strip_tags($this->judul_buku));
        $this->penulis_buku = htmlspecialchars(strip_tags($this->penulis_buku));
        $this->penerbit_buku = htmlspecialchars(strip_tags($this->penerbit_buku));
        $this->tahun_penerbit = htmlspecialchars(strip_tags($this->tahun_penerbit));
        $this->stok = htmlspecialchars(strip_tags($this->stok));
        // bind nilai property
        $stmt->bindParam(":id_buku", $this->id_buku);
        $stmt->bindParam(":judul_buku", $this->judul_buku);
        $stmt->bindParam(":penulis_buku", $this->penulis_buku);
        $stmt->bindParam(":penerbit_buku", $this->penerbit_buku);
        $stmt->bindParam(":tahun_penerbit", $this->tahun_penerbit);
        $stmt->bindParam(":stok", $this->stok);
        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // function untuk UPDATE data BUKU
    function ubah()
    {
        // query ubah data
        $query = "UPDATE " . $this->buku . "
                SET
                    judul_buku = :judul_buku,
                    penulis_buku = :penulis_buku,
                    penerbit_buku = :penerbit_buku,
                    tahun_penerbit = :tahun_penerbit
                    stok = :stok
                WHERE
                    id_buku = :id_buku";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->judul_buku = htmlspecialchars(strip_tags($this->judul_buku));
        $this->penulis_buku = htmlspecialchars(strip_tags($this->penulis_buku));
        $this->penerbit_buku = htmlspecialchars(strip_tags($this->penerbit_buku));
        $this->tahun_penerbit = htmlspecialchars(strip_tags($this->tahun_penerbit));
        $this->stok = htmlspecialchars(strip_tags($this->stok));
        $this->id_buku = htmlspecialchars(strip_tags($this->id_buku));

        // bind new values
        $stmt->bindParam(':judul_buku', $this->judul_buku);
        $stmt->bindParam(':penulis_buku', $this->penulis_buku);
        $stmt->bindParam(':penerbit_buku', $this->penerbit_buku);
        $stmt->bindParam(':tahun_penerbit', $this->tahun_penerbit);
        $stmt->bindParam(':stok', $this->stok);
        $stmt->bindParam(':id_buku', $this->id_buku);

        // execute the query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // function untuk DELETE data BUKU
    function hapus()
    {
        // query hapus
        $query = "DELETE FROM " . $this->buku . " WHERE id_buku = ?";
        // prepare query
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->id_buku = htmlspecialchars(strip_tags($this->id_buku));
        // bind id_buku of record to delete
        $stmt->bindParam(1, $this->id_buku);
        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}

//
class anggota
{

    // koneksi database beserta nama tabel
    private $conn;
    private $table_name = "anggota";

    // object properties (kolom pada tabel buku)
    public $id_anggota;
    public $nama_anggota;
    public $jk_anggota;
    public $jurusan_anggota;
    public $no_telp_anggota;
    public $alamat_anggota;
    // constructor untuk koneksi database
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // function untuk menampilkan semua data BUKU
    function tampil()
    {
        // query untuk menampilkan semua data
        $query = "SELECT * FROM anggota ORDER BY  id_anggota  ASC";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // eksekusi query
        $stmt->execute();
        return $stmt;
    }

    function simpan()
    {
        // query untuk menyimpan data 
        $query = "INSERT INTO " . $this->anggota . "
        VALUES(:id_anggota, :nama_anggota, :jk_anggota, :jurusan_anggota, :no_telp_anggota, :alamat_anggota)";
        // prepare query
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->id_anggota = htmlspecialchars(strip_tags($this->id_anggota));
        $this->nama_anggota = htmlspecialchars(strip_tags($this->nama_anggota));
        $this->jk_anggota = htmlspecialchars(strip_tags($this->jk_anggota));
        $this->jurusan_anggota = htmlspecialchars(strip_tags($this->jurusan_anggota));
        $this->no_telp_anggota = htmlspecialchars(strip_tags($this->no_telp_anggota));
        $this->alamat_anggota = htmlspecialchars(strip_tags($this->alamat_anggota));
        // bind nilai property
        $stmt->bindParam(":id_anggota", $this->id_anggota);
        $stmt->bindParam(":nama_anggota", $this->nama_anggota);
        $stmt->bindParam(":jk_anggota", $this->jk_anggota);
        $stmt->bindParam(":jurusan_anggota", $this->jurusan_anggota);
        $stmt->bindParam(":no_telp_anggota", $this->no_telp_anggota);
        $stmt->bindParam(":alamat_anggota", $this->alamat_anggota);
        $stmt->bindParam(":email_anggota", $this->email_anggota);
        $stmt->bindParam(":pass_anggota", $this->pass_anggota);
        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // function untuk UPDATE data BUKU
    function ubah()
    {
        // query ubah data
        $query = "UPDATE " . $this->anggota . "
                SET
                    nama_anggota = :nama_anggota,
                    jk_anggota = :jk_anggota,
                    jurusan_anggota = :jurusan_anggota,
                    no_telp_anggota = :no_telp_anggota,
                    alamat_anggota, = :alamat_anggota
                WHERE
                    id_anggota = :id_anggota";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->nama_anggota = htmlspecialchars(strip_tags($this->nama_anggota));
        $this->jk_anggota = htmlspecialchars(strip_tags($this->jk_anggota));
        $this->jurusan_anggota = htmlspecialchars(strip_tags($this->jurusan_anggota));
        $this->no_telp_anggota = htmlspecialchars(strip_tags($this->no_telp_anggota));
        $this->alamat_anggota = htmlspecialchars(strip_tags($this->alamat_anggota));
        $this->email_anggota = htmlspecialchars(strip_tags($this->email_anggota));

        // bind new values
        $stmt->bindParam(':nama_anggota', $this->nama_anggota);
        $stmt->bindParam(':jk_anggota', $this->jk_anggota);
        $stmt->bindParam(':jurusan_anggota', $this->jurusan_anggota);
        $stmt->bindParam(':no_telp_anggota', $this->no_telp_anggota);
        $stmt->bindParam(':alamat_anggota,', $this->alamat_anggota);
        $stmt->bindParam(':id_anggota', $this->id_anggota);

        // execute the query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // function untuk DELETE data anggota
    function hapus()
    {
        // query hapus
        $query = "DELETE FROM " . $this->anggota . " WHERE id_anggota = ?";
        // prepare query
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->id_anggota = htmlspecialchars(strip_tags($this->id_anggota));
        // bind id_anggota of record to delete
        $stmt->bindParam(1, $this->id_anggota);
        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}

class peminjaman
{

    // koneksi database beserta nama tabel
    private $conn;
    private $table_name = "peminjaman";

    // object properties (kolom pada tabel buku)
    public $id_peminjaman;
    public $tanggal_pinjam;
    public $id_buku;
    public $id_anggota;


    // constructor untuk koneksi database
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // function untuk menampilkan semua data BUKU
    function tampil()
    {
        // query untuk menampilkan semua data
        $query = "SELECT * FROM peminjaman ORDER BY  id_peminjaman  ASC";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // eksekusi query
        $stmt->execute();
        return $stmt;
    }

    function simpan()
    {
        // query untuk menyimpan data 
        $query = "INSERT INTO " . $this->peminjaman . "
        VALUES(:id_peminjaman, :tanggal_pinjam, :id_buku, :id_anggota, :id_petugas)";
        // prepare query
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->id_peminjaman = htmlspecialchars(strip_tags($this->id_peminjaman));
        $this->tanggal_pinjam = htmlspecialchars(strip_tags($this->tanggal_pinjam));
        $this->id_buku = htmlspecialchars(strip_tags($this->id_buku));
        $this->id_anggota = htmlspecialchars(strip_tags($this->id_anggota));
        $this->id_petugas = htmlspecialchars(strip_tags($this->id_petugas));

        // bind nilai property
        $stmt->bindParam(":id_peminjaman", $this->id_peminjaman);
        $stmt->bindParam(":tanggal_pinjam", $this->tanggal_pinjam);
        $stmt->bindParam(":id_buku", $this->id_buku);
        $stmt->bindParam(":id_anggota", $this->id_anggota);
        $stmt->bindParam(":id_petugas", $this->id_petugas);
        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}

class pengembalian
{

    // koneksi database beserta nama tabel
    private $conn;
    private $table_name = "pengembalian";

    // object properties (kolom pada tabel buku)
    public $id_pengembalian;
    public $tanggal_pinjam;
    public $tanggal_pengembalian;
    public $denda;
    public $id_buku;
    public $id_anggota;
    public $id_petugas;


    // constructor untuk koneksi database
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // function untuk menampilkan semua data BUKU
    function tampil()
    {
        // query untuk menampilkan semua data
        $query = "SELECT * FROM pengembalian ORDER BY  id_pengembalian  ASC";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // eksekusi query
        $stmt->execute();
        return $stmt;
    }

    function simpan()
    {
        // query untuk menyimpan data 
        $query = "INSERT INTO " . $this->peminjaman . "
        VALUES(:id_pengembalian, :tanggal_pinjam, :tanggal_pengembalian, :denda, :id_buku;, :id_anggota, :id_petugas)";
        // prepare query
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->id_pengembalian = htmlspecialchars(strip_tags($this->id_pengembalian));
        $this->tanggal_pinjam = htmlspecialchars(strip_tags($this->tanggal_pinjam));
        $this->tanggal_pengembalian = htmlspecialchars(strip_tags($this->tanggal_pengembalian));
        $this->denda = htmlspecialchars(strip_tags($this->denda));
        $this->id_buku = htmlspecialchars(strip_tags($this->id_buku));
        $this->id_anggota = htmlspecialchars(strip_tags($this->id_anggota));
        $this->id_petugas = htmlspecialchars(strip_tags($this->id_petugas));

        // bind nilai property
        $stmt->bindParam(":id_pengembalian", $this->id_pengembalian);
        $stmt->bindParam(":tanggal_pinjam", $this->tanggal_pinjam);
        $stmt->bindParam(":denda", $this->denda);
        $stmt->bindParam(":id_buku", $this->id_buku);
        $stmt->bindParam(":anggota", $this->anggota);
        $stmt->bindParam(":id_petugas", $this->id_petugas);
        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
