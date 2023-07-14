<?php
include "koneksi.php";

if(isset($_POST['tambahkan'])) {

    $tanggal = date("d M Y");
    date_default_timezone_set('Asia/Jakarta');
    $waktu = date('h:i:s A');
    $jumlah = $_POST['jumlah'];
    $catatan = htmlspecialchars($_POST['catatan']);
    $jenis = $_POST['jenis'];
    $kategori = $_POST['kategori'];
    $kategori_lainnya = htmlspecialchars($_POST['kategori-lainnya']);

    // jika user menginput lewat lainnya
    if($kategori == "") {

        // cek apakah tanggal sudah ada atau belum
        $cek = mysqli_query($conn, "SELECT * FROM tanggal WHERE tanggal = '$tanggal'");
        $hasil = mysqli_num_rows($cek);

        // jika sudah ada
        if($hasil > 0) {
            echo "";

        // jika belum ada
        } else {
            $masukkan_tanggal = mysqli_query($conn, "INSERT INTO tanggal(tanggal) VALUES ('$tanggal')");
        }

        $insert = mysqli_query($conn, "INSERT INTO keuangan (jenis, kategori, jumlah, tanggal, waktu, catatan) VALUES ('$jenis','$kategori_lainnya','$jumlah','$tanggal','$waktu','$catatan')");

        if($insert) {
            ?>
            <script>
                document.location="index.php";
            </script>
            <?php
        }

    // jika user memilih kategori yang sudah disediakan
    } else if($kategori_lainnya == "") {

        // cek apakah tanggal sudah ada atau belum
        $cek = mysqli_query($conn, "SELECT * FROM tanggal WHERE tanggal = '$tanggal'");
        $hasil = mysqli_num_rows($cek);

        // jika sudah ada
        if($hasil > 0) {
            echo "";

        // jika belum ada
        } else {
            $masukkan_tanggal = mysqli_query($conn, "INSERT INTO tanggal(tanggal) VALUES ('$tanggal')");
        }

        $insert = mysqli_query($conn, "INSERT INTO keuangan (jenis, kategori, jumlah, tanggal, waktu, catatan) VALUES ('$jenis','$kategori','$jumlah','$tanggal','$waktu','$catatan')");

        if($insert) {
            ?>
            <script>
                document.location="index.php";
            </script>
            <?php
        }

    // jika kedua-duanya tidak diisi
    } else if($kategori == "kosong" && $kategori_lainnya == "" ){
        ?>
        <script>
            document.location="tambah.php?alert=kategori_kosong";
        </script>
        <?php

    // jika kedua-duanya diisi
    } else {
        ?>
        <script>
            document.location="tambah.php?alert=kategori_tv";
        </script>
        <?php
    }

    

// fungsi remove all
} else if(isset($_GET['remove_all'])) {
    if($_GET['remove_all'] == "yes") {

        $hapus_tanggal = mysqli_query($conn, "DELETE FROM tanggal");

        if($hapus_tanggal) {

            $hapus_keuangan = mysqli_query($conn, "DELETE FROM keuangan");

            if($hapus_keuangan) {
                ?>
                <script>
                    document.location="index.php?alert=remove_all_berhasil";
                </script>
                <?php
            }
        } else {
            echo "gagal";
        }
    }

// fungsi hapus pada detail.php
} else if(isset($_GET['hapus'])) {
    $id_keuangan = $_GET['id'];
    $tanggal = $_GET['tgl'];

    // cek apakah daftar tinggal satu atau berapa
    $cek = mysqli_query($conn, "SELECT * FROM keuangan WHERE tanggal='$tanggal'");
    $hasil = mysqli_num_rows($cek);

    // jika lebih dari satu maka cukup hapus dibagian keuangan
    if($hasil > 1) {

    $hapus = mysqli_query($conn, "DELETE FROM keuangan WHERE id_keuangan='$id_keuangan'");

    if($hapus) {
        ?>
        <script>
            document.location="detail.php?alert=hapus&tgl=<?=$tanggal?>";
        </script>
        <?php
    }

    // jika lebih dari dua maka hapus dengan tanggalnya karena tidak digunakan lagi
    } else {

    $hapus_tanggal = mysqli_query($conn, "DELETE FROM tanggal WHERE tanggal='$tanggal'");
    $hapus = mysqli_query($conn, "DELETE FROM keuangan WHERE id_keuangan='$id_keuangan'");

    if($hapus) {
        ?>
        <script>
            document.location="index.php?alert=hapus_semuaSM";
        </script>
        <?php
    }

    }

// fungsi hapus semua pada detail.php
} else if(isset($_GET['hapus_semua'])) {
    $tanggal = $_GET['tgl'];

    $hapus = mysqli_query($conn, "DELETE FROM keuangan WHERE tanggal='$tanggal'");
    $hapus_2 = mysqli_query($conn, "DELETE FROM tanggal WHERE tanggal='$tanggal'");

    if($hapus) {
        ?>
        <script>
            document.location="index.php?alert=hapus_semua";
        </script>
        <?php
    }

// fungsi edit pada file edit.php
} else if(isset($_POST['edit'])) {

    $id_keuangan = $_POST['id_keuangan'];
    $tanggal = date("d M Y");
    $waktu_lama = $_POST['waktu_lama'];
    date_default_timezone_set('Asia/Jakarta');
    $waktu = date('h:i:s A');
    $tanggal = $_POST['tanggal'];
    $jumlah = $_POST['jumlah'];
    $catatan = htmlspecialchars($_POST['catatan']);
    $jenis = $_POST['jenis'];
    $kategori = $_POST['kategori'];
    $kategori_lainnya = htmlspecialchars($_POST['kategori-lainnya']);

    // jika user menginput lewat lainnya
    if($kategori == "") {

        $insert = mysqli_query($conn, "UPDATE keuangan SET jenis='$jenis', kategori='$kategori_lainnya', jumlah='$jumlah', waktu='$waktu_lama', catatan='$catatan', status='diubah', ket_wkt_diubah='$waktu' WHERE id_keuangan='$id_keuangan'");

        if($insert) {
            ?>
            <script>
                document.location="detail.php?tgl=<?=$tanggal?>";
            </script>
            <?php
        }

    // jika user memilih kategori yang sudah disediakan
    } else if($kategori_lainnya == "") {

        $insert = mysqli_query($conn, "UPDATE keuangan SET jenis='$jenis', kategori='$kategori', jumlah='$jumlah', waktu='$waktu', catatan='$catatan', status='diubah', ket_wkt_diubah='$waktu' WHERE id_keuangan='$id_keuangan'");

        if($insert) {
            ?>
            <script>
                document.location="detail.php?tgl=<?=$tanggal?>";
            </script>
            <?php
        }
        
    // jika kedua duanya tidak diisi
    } else if($kategori == "" && $kategori_lainnya == "") {
        ?>
        <script>
            document.location="edit.php?alert=kategori_kosong&id=<?=$id_keuangan?>";
        </script>
        <?php

    // jika kedua-duanya diisi
    } else {
        ?>
        <script>
            document.location="edit.php?alert=kategori_tv&id=<?=$id_keuangan?>";
        </script>
        <?php
    }

}
?>