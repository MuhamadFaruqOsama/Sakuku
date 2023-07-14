<?php
include "koneksi.php";
include "header.php";

$query = mysqli_query($conn, "SELECT * FROM tanggal ORDER BY id_tanggal DESC");

?>

<div class="dekstop-mode">
    <h3 class="text-light position-absolute top-50 start-50 translate-middle">Maaf, Aplikasi ini belum tersedia di versi Desktop</h3>
</div>

<div class="mobile-mode">
<!-- section pertama, untuk jumlah uang -->
<section id="header-1" class="header-1 shadow" style="background: linear-gradient(to bottom, rgb(0, 119, 216), rgb(71, 164, 240));">
    <div class="container">
        <div class="row">
            <div class="col-auto">
                <small style="color:rgba(255, 255, 255, 0.562);"><i class="bi bi-house-fill"></i> Beranda</small>
            </div>
        </div>
        <div class="tanggal">
            <div class="row justify-content-between mt-2">
                <div class="col-auto">
                    <small class="text-end"><i class="bi bi-calendar2-week me-3"></i> <?php $tanggal = date('d M Y'); echo $tanggal ?></small>
                </div>
                <div class="col-auto">
                    <a href="setting.php" class="text-light fs-4" style="text-decoration:none;"><i class="bi bi-gear"></i></a>
                </div>
            </div>
            
            <h2 class="fw-bold">
                <?php
                // untuk mencari pemasukan
                $pemasukan = mysqli_query($conn, "SELECT SUM(jumlah) AS pemasukan FROM keuangan WHERE jenis='pemasukan'");
                $jumlah_pemasukan = mysqli_fetch_array($pemasukan);

                // untuk mencari pengeluaran
                $pengeluaran = mysqli_query($conn, "SELECT SUM(jumlah) AS pengeluaran FROM keuangan WHERE jenis='pengeluaran'");
                $jumlah_pengeluaran = mysqli_fetch_array($pengeluaran);

                $jumlah_sisa_uang = $jumlah_pemasukan['pemasukan'] - $jumlah_pengeluaran['pengeluaran'];

                echo "Rp. " . number_format($jumlah_sisa_uang);
                ?>
            </h2>
            <div class="row">
                <div class="col-6">
                    <small class="pengeluaran">
                        <small>Pengeluaran:</small>
                        <small>Rp. <?=number_format($jumlah_pengeluaran['pengeluaran'])?></small>
                    </small>
                </div>
                <div class="col-6">
                    <small class="pemasukan">
                        <small>Pemasukan:</small>
                        <small>Rp. <?=number_format($jumlah_pemasukan['pemasukan'])?></small>
                    </small>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- akhiran section pertama, untuk jumlah uang -->

<!-- section kedua, awaaln untuk kontent -->
<section id="content">
    <div class="container mt-3">
        <div class="row justify-content-center">

             <!-- untuk alert -->
             <?php
                if(isset($_GET['alert'])) {
                    if($_GET['alert'] == "hapus_semua") {
                        ?>
                            <div class="col-11 option ps-2 pt-1 pb-1 text-secondary mb-3" data-aos="fade-zoom-in" data-aos-delay="250" data-aos-offset="0">
                                <p class="mb-0"><i class="bi bi-exclamation-octagon-fill text-danger fs-2 me-2"></i> <i style="font-size: 12px;">Daftar berhasil dihapus!</i></p>
                            </div>
                        <?php
                    } else if($_GET['alert'] == "hapus_semuaSM") {
                        ?>
                            <div class="col-11 option ps-2 pt-1 pb-1 text-secondary mb-3" data-aos="fade-zoom-in" data-aos-delay="250" data-aos-offset="0">
                                <p class="mb-0"><i class="bi bi-exclamation-octagon-fill text-danger fs-2 me-2"></i> <i style="font-size: 12px;">Berhasil dihapus, daftar otomatis ikut terhapus!</i></p>
                            </div>
                        <?php
                    } else if($_GET['alert'] == "remove_all_berhasil") {
                        ?>
                            <div class="col-11 option ps-2 pt-1 pb-1 text-secondary mb-3" data-aos="fade-zoom-in" data-aos-delay="250" data-aos-offset="0">
                                <p class="mb-0"><i class="bi bi-exclamation-octagon-fill text-danger fs-2 me-2"></i> <i style="font-size: 12px;">Semua daftar berhasil dihapus!</i></p>
                            </div>
                        <?php
                    }
                }
            ?>

            <?php
            // untuk pengulangan
            while($data = mysqli_fetch_array($query)) {

                // untuk menghitung jumlah pemasukan
                $jumlah_pemasukan_tanggal = mysqli_query($conn, "SELECT SUM(jumlah) AS pemasukan FROM keuangan WHERE tanggal='$data[tanggal]' AND jenis='pemasukan' ");
                $pemasukan_tanggal = mysqli_fetch_array($jumlah_pemasukan_tanggal);

                // untuk menghitung jumlah pengeluaran
                $jumlah_pemasukan_tanggal = mysqli_query($conn, "SELECT SUM(jumlah) AS pengeluaran FROM keuangan WHERE tanggal='$data[tanggal]' AND jenis='pengeluaran' ");
                $pengeluaran_tanggal = mysqli_fetch_array($jumlah_pemasukan_tanggal);

            ?>
            <div class="content col-11 mb-3" data-aos="fade-up" data-aos-delay="250" data-aos-offset="0">
                <a href="detail.php?tgl=<?=$data['tanggal']?>" class="link-content">
                    <div class="header-content">
                        <div class="row keterangan text-secondary justify-content-around">
                            <div class="col-auto">
                                <small>
                                    <?php

                                    // hari ini
                                    $hari_ini = date('d M Y');

                                    // kemarin
                                    $satu = date('d');
                                    $hasil = $satu - 1;
                                    $kemarin = date("$hasil M Y");

                                    if($data['tanggal'] == $hari_ini){
                                        echo "Hari ini";
                                    } else if($data['tanggal'] == $kemarin) {
                                        echo "Kemarin";
                                    } else {
                                        echo $data['tanggal'];
                                    }
                                    ?>
                                </small>
                            </div>
                            <div class="col-auto">
                                <small>keluar: Rp. <?=number_format($pengeluaran_tanggal['pengeluaran'])?></small>
                            </div>
                            <div class="col-auto">
                                <small>masuk: Rp. <?=number_format($pemasukan_tanggal['pemasukan'])?></small>
                            </div>
                        </div>
                    </div>
                    <?php
                    $kategori = mysqli_query($conn, "SELECT * FROM keuangan WHERE tanggal='$data[tanggal]' ORDER BY id_keuangan DESC LIMIT 6");
                    while($hasil = mysqli_fetch_array($kategori)) {
                    ?>
                    <hr class="mb-0 mt-0">
                    <div class="row isi-content justify-content-between p-2">
                        <div class="col-auto">
                            <p class="mb-0 text-secondary fw-bold">
                                <?php
                                if($hasil['kategori'] == "Hadiah") {
                                    ?> <button class="btn btn-sm btn-info me-3" style="border-radius:50%;"><i class="bi bi-gift-fill text-light"></i></button> <?=$hasil['kategori']?><?php
                                } else if($hasil['kategori'] == "Belanja") {
                                    ?> <button class="btn btn-sm btn-success me-3" style="border-radius:50%;"><i class="bi bi-cart4 text-light"></i></button> <?=$hasil['kategori']?><?php
                                } else if($hasil['kategori'] == "Gaji") {
                                    ?> <button class="btn btn-sm btn-primary me-3" style="border-radius:50%;"><i class="bi bi-cash-stack text-light"></i></button>   <?=$hasil['kategori']?><?php
                                } else if($hasil['kategori'] == "Makanan") {
                                    ?> <button class="btn btn-sm btn-danger me-3" style="border-radius:50%;"><i class="bi bi-cup-hot-fill text-light"></i></button> <?=$hasil['kategori']?><?php
                                } else if($hasil['kategori'] == "Transportasi") {
                                    ?> <button class="btn btn-sm btn-info me-3" style="border-radius:50%;"><i class="bi bi-bus-front text-light"></i></button>  <?=$hasil['kategori']?><?php
                                } else if($hasil['kategori'] == "Investasi") {
                                    ?> <button class="btn btn-sm btn-secondary me-3" style="border-radius:50%;"><i class="bi bi-clipboard-data"></i></button>  <?=$hasil['kategori']?><?php
                                } else if($hasil['kategori'] == "Tabungan") {
                                    ?> <button class="btn btn-sm btn-primary me-3" style="border-radius:50%;"><i class="bi bi-bank text-light"></i></button>  <?=$hasil['kategori']?><?php
                                } else if($hasil['kategori'] == "Pakaian") {
                                    ?> <button class="btn btn-sm btn-warning me-3" style="border-radius:50%;"><i class="bi bi-tencent-qq text-light"></i></button>  <?=$hasil['kategori']?><?php
                                } else if($hasil['kategori'] == "BBM") {
                                    ?> <button class="btn btn-sm btn-warning me-3" style="border-radius:50%;"><i class="bi bi-fuel-pump text-light"></i></button>  <?=$hasil['kategori']?><?php
                                } else if($hasil['kategori'] == "Sekolah") {
                                    ?> <button class="btn btn-sm btn-success me-3" style="border-radius:50%;"><i class="bi bi-journal-code text-light"></i></button>  <?=$hasil['kategori']?><?php
                                } else if($hasil['kategori'] == "Asuransi") {
                                    ?> <button class="btn btn-sm btn-danger me-3" style="border-radius:50%;"><i class="bi bi-building-fill-check text-light"></i></button>  <?=$hasil['kategori']?><?php
                                } else {
                                    ?> <button class="btn btn-sm btn-secondary me-3" style="border-radius:50%;"><i class="bi bi-grid-fill text-light"></i></button> <?=$hasil['kategori']?><?php
                                }
                                ?> 
                            </p>
                        </div>
                        <div class="col-auto">
                                <?php
                                if($hasil['jenis'] == "pengeluaran") {
                                    ?>
                                    <p class="text-danger mb-0 pb-0"> - <?=number_format($hasil['jumlah'])?>
                                    <?php
                                    if($hasil['status'] == "") {
                                        echo "";
                                    } else {
                                        ?> <small class="text-secondary ms-1"><i class="bi bi-pencil-square"></i></small> <?php
                                    }
                                    ?>
                                    </p>
                                    
                                    <?php
                                } else if($hasil['jenis'] == "pemasukan") {
                                    ?>
                                    <p class="text-success mb-0 pb-0"> + <?=number_format($hasil['jumlah'])?>
                                    <?php
                                    if($hasil['status'] == "") {
                                        echo "";
                                    } else {
                                        ?> <small class="ms-1 text-secondary"><i class="bi bi-pencil-square"></i></small> <?php
                                    }
                                    ?>
                                    </p>
                                    <?php
                                }
                                ?>
                        </div>
                    </div>
                   <?php

                    }

                    $hitung_sisa = mysqli_query($conn, "SELECT * FROM keuangan WHERE tanggal='$data[tanggal]'");
                    $hasil_HS = mysqli_num_rows($hitung_sisa);

                    if($hasil_HS > 6) {
                        $sisa = $hasil_HS - 6;
                        ?>
                            <hr class="mb-0 mt-0">
                            <div class="text-end text-secondary">
                                <small class="mt-0">
                                    + <?=$sisa?>
                                </small>
                            </div>
                        <?php
                    } else {
                        echo "";
                    }
                   ?>
                </a>
            </div>
            <?php } ?>


        </div>
        <!-- akhiran row -->
    </div>
    <!-- akhiran container -->
</section>
<!-- section kedua, akhiran untuk kontent -->
</div>

<?php
include "navbar.php";
include "footer.php";
?>
    