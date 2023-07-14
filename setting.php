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
                <small style="color:rgba(255, 255, 255, 0.562);"><i class="bi bi-house-fill"></i> Beranda <i class="bi bi-chevron-right"></i> <i class="bi bi-gear"></i> Setting</small>
            </div>
        </div>
        <div class="tanggal">
            <div class="row justify-content-between mt-2">
                <div class="col-auto">
                    <small class="text-end"><i class="bi bi-calendar2-week me-3"></i> <?php $tanggal = date('d M Y'); echo $tanggal ?></small>
                </div>
            </div>
            
            <h2 class="fw-bold mt-2">
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

<!-- untuk setting -->
<section class="setting">
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="content col-11 text-secondary" style="margin-bottom: 15vh;">

                    <p class="text-secondary mb-0 mt-2">
                        Kategori
                    </p>
                    <hr class="mt-1 mb-0">

                    <!-- untuk bagian pemasukan -->
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                Pemasukan
                            </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                            <?php

                                // untuk menghitung keseluruhan
                                $hitung = mysqli_query($conn, "SELECT SUM(jumlah) AS total FROM keuangan WHERE jenis='pemasukan'");
                                $total = mysqli_fetch_array($hitung);

                                if($total['total'] == 0) {

                                    $presentase_hadiah = 0;
                                    $total_hadiah = 0;

                                    $presentase_asuransi = 0;
                                    $total_asuransi = 0;

                                    $presentase_BBM = 0;
                                    $total_BBM = 0;

                                    $presentase_sekolah = 0;
                                    $total_sekolah = 0;

                                    $presentase_belanja = 0;
                                    $total_belanja = 0;

                                    $presentase_gaji = 0;
                                    $total_gaji = 0;

                                    $presentase_makanan = 0;
                                    $total_makanan = 0;

                                    $presentase_transportasi = 0;
                                    $total_transportasi = 0;

                                    $presentase_investasi = 0;
                                    $total_investasi = 0;

                                    $presentase_tabungan = 0;
                                    $total_tabungan = 0;

                                    $presentase_pakaian = 0;
                                    $total_pakaian = 0;

                                    $presentase_lainnya = 0;
                                    $total_lainnya = 0;

                                } else {

                                // untuk menghitung kategori hadiah
                                $hitung_hadiah = mysqli_query($conn, "SELECT SUM(jumlah) AS total_hadiah FROM keuangan WHERE jenis='pemasukan' AND kategori='Hadiah'");
                                $total_hadiah = mysqli_fetch_array($hitung_hadiah);

                                if($total_hadiah == 0) {
                                $presentase_hadiah = 0;
                                } else {
                                $presentase_hadiah = ($total_hadiah['total_hadiah'] / $total['total']) * 100;
                                }

                                // untuk menghitung kategori belanja
                                $hitung_belanja = mysqli_query($conn, "SELECT SUM(jumlah) AS total_belanja FROM keuangan WHERE jenis='pemasukan' AND kategori='Belanja'");
                                $total_belanja = mysqli_fetch_array($hitung_belanja);

                                if($total_belanja == 0) {
                                $presentase_belanja = 0;
                                } else {
                                $presentase_belanja = ($total_belanja['total_belanja'] / $total['total']) * 100;
                                }

                                // untuk menghitung kategori gaji
                                $hitung_gaji = mysqli_query($conn, "SELECT SUM(jumlah) AS total_gaji FROM keuangan WHERE jenis='pemasukan' AND kategori='Gaji'");
                                $total_gaji = mysqli_fetch_array($hitung_gaji);

                                if($total_gaji == 0) {
                                $presentase_gaji = 0;
                                } else {
                                $presentase_gaji = ($total_gaji['total_gaji'] / $total['total']) * 100;
                                }

                                // untuk menghitung kategori makanan
                                $hitung_makanan = mysqli_query($conn, "SELECT SUM(jumlah) AS total_makanan FROM keuangan WHERE jenis='pemasukan' AND kategori='Makanan'");
                                $total_makanan = mysqli_fetch_array($hitung_makanan);

                                if($total_makanan == 0) {
                                $presentase_makanan = 0;
                                } else {
                                $presentase_makanan = ($total_makanan['total_makanan'] / $total['total']) * 100;
                                }

                                // untuk menghitung kategori Transportasi
                                $hitung_transportasi = mysqli_query($conn, "SELECT SUM(jumlah) AS total_transportasi FROM keuangan WHERE jenis='pemasukan' AND kategori='Transportasi'");
                                $total_transportasi = mysqli_fetch_array($hitung_transportasi);

                                if($total_transportasi == 0) {
                                $presentase_transportasi = 0;
                                } else {
                                $presentase_transportasi = ($total_transportasi['total_transportasi'] / $total['total']) * 100;
                                }

                                // untuk menghitung kategori investasi
                                $hitung_investasi = mysqli_query($conn, "SELECT SUM(jumlah) AS total_investasi FROM keuangan WHERE jenis='pemasukan' AND kategori='Investasi'");
                                $total_investasi = mysqli_fetch_array($hitung_investasi);

                                if($total_investasi == 0) {
                                $presentase_investasi = 0;
                                } else {
                                $presentase_investasi = ($total_investasi['total_investasi'] / $total['total']) * 100;
                                }

                                // untuk menghitung kategori tabungan
                                $hitung_tabungan = mysqli_query($conn, "SELECT SUM(jumlah) AS total_tabungan FROM keuangan WHERE jenis='pemasukan' AND kategori='Tabungan'");
                                $total_tabungan = mysqli_fetch_array($hitung_tabungan);

                                if($total_tabungan == 0) {
                                $presentase_tabungan = 0;
                                } else {
                                $presentase_tabungan = ($total_tabungan['total_tabungan'] / $total['total']) * 100;
                                }

                                // untuk menghitung kategori pakaian
                                $hitung_pakaian = mysqli_query($conn, "SELECT SUM(jumlah) AS total_pakaian FROM keuangan WHERE jenis='pemasukan' AND kategori='Pakaian'");
                                $total_pakaian = mysqli_fetch_array($hitung_pakaian);

                                if($total_pakaian == 0) {
                                $presentase_pakaian = 0;
                                } else {
                                $presentase_pakaian = ($total_pakaian['total_pakaian'] / $total['total']) * 100;
                                }

                                // untuk menghitung kategori sekolah
                                $hitung_sekolah = mysqli_query($conn, "SELECT SUM(jumlah) AS total_sekolah FROM keuangan WHERE jenis='pemasukan' AND kategori='Sekolah'");
                                $total_sekolah = mysqli_fetch_array($hitung_sekolah);

                                if($total_sekolah == 0) {
                                $presentase_sekolah = 0;
                                } else {
                                $presentase_sekolah = ($total_sekolah['total_sekolah'] / $total['total']) * 100;
                                }

                                // untuk menghitung kategori asuransi
                                $hitung_asuransi = mysqli_query($conn, "SELECT SUM(jumlah) AS total_asuransi FROM keuangan WHERE jenis='pemasukan' AND kategori='Asuransi'");
                                $total_asuransi = mysqli_fetch_array($hitung_asuransi);

                                if($total_asuransi == 0) {
                                $presentase_asuransi = 0;
                                } else {
                                $presentase_asuransi = ($total_asuransi['total_asuransi'] / $total['total']) * 100;
                                }

                                // untuk menghitung kategori BBM
                                $hitung_BBM = mysqli_query($conn, "SELECT SUM(jumlah) AS total_BBM FROM keuangan WHERE jenis='pemasukan' AND kategori='BBM'");
                                $total_BBM = mysqli_fetch_array($hitung_BBM);

                                if($total_BBM == 0) {
                                $presentase_BBM = 0;
                                } else {
                                $presentase_BBM = ($total_BBM['total_BBM'] / $total['total']) * 100;
                                }

                                // untuk menghitung kategori lainnya
                                $hitung_lainnya = mysqli_query($conn, "SELECT SUM(jumlah) AS total_lainnya FROM keuangan WHERE jenis='pemasukan' AND kategori != 'Hadiah' AND kategori != 'Belanja' AND kategori !='Gaji' AND kategori !='Makanan' AND kategori !='Transportasi' AND kategori !='Investasi' AND kategori !='Tabungan' AND kategori !='Pakaian'");
                                $total_lainnya = mysqli_fetch_array($hitung_lainnya);

                                if($total_lainnya == 0) {
                                $presentase_lainnya = 0;
                                } else {
                                $presentase_lainnya = ($total_lainnya['total_lainnya'] / $total['total']) * 100;
                                }

                                }

                                ?>
                                <div class="row justify-content-between">
                                    <div class="col-auto fw-bold">Kategori</div>
                                    <div class="col-auto fw-bold">Presentase</div>
                                    <hr class="mb-0 mt-2">

                                    <!-- bagian Asuransi -->
                                    <a data-bs-toggle="collapse" href="#collapse-1" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <div class="row justify-content-between text-secondary">
                                            <div class="col-8 mt-2">
                                                <button class="btn btn-sm btn-danger me-3" style="border-radius:50%;"><i class="bi bi-building-fill-check text-light"></i></button> Asuransi
                                            </div>
                                            <div class="col-auto mt-2">
                                                <p class="mb-0"> <?=number_format($presentase_asuransi, 3,',','')?>%</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="collapse" id="collapse-1">
                                        <div class="card card-body mt-2">
                                            <div class="row justify-content-between">
                                                <div class="col-auto">
                                                    Total
                                                </div>
                                                <div class="col-auto">
                                                    Rp. <?=number_format($total_asuransi['total_asuransi'])?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- bagian BBM -->
                                    <a data-bs-toggle="collapse" href="#collapse-2" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <div class="row justify-content-between text-secondary">
                                            <div class="col-8 mt-2">
                                                <button class="btn btn-sm btn-warning me-3" style="border-radius:50%;"><i class="bi bi-fuel-pump text-light"></i></button> BBM
                                            </div>
                                            <div class="col-auto mt-2">
                                                <p class="mb-0"> <?=number_format($presentase_BBM, 3,',','')?>%</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="collapse" id="collapse-2">
                                        <div class="card card-body mt-2">
                                            <div class="row justify-content-between">
                                                <div class="col-auto">
                                                    Total
                                                </div>
                                                <div class="col-auto">
                                                    Rp. <?=number_format($total_BBM['total_BBM'])?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- bagian belanja -->
                                    <a data-bs-toggle="collapse" href="#collapse-3" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <div class="row justify-content-between text-secondary">
                                            <div class="col-8 mt-2">
                                                <button class="btn btn-sm btn-success me-3" style="border-radius:50%;"><i class="bi bi-cart4 text-light"></i></button> Belanja
                                            </div>
                                            <div class="col-auto mt-2">
                                                <p class="mb-0"> <?=number_format($presentase_belanja, 3,',','')?>%</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="collapse" id="collapse-3">
                                        <div class="card card-body mt-2">
                                            <div class="row justify-content-between">
                                                <div class="col-auto">
                                                    Total
                                                </div>
                                                <div class="col-auto">
                                                    Rp. <?=number_format($total_belanja['total_belanja'])?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- bagian gaji -->
                                    <a data-bs-toggle="collapse" href="#collapse-4" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <div class="row justify-content-between text-secondary">
                                            <div class="col-8 mt-2">
                                                <button class="btn btn-sm btn-primary me-3" style="border-radius:50%;"><i class="bi bi-tags-fill text-light"></i></button> Gaji
                                            </div>
                                            <div class="col-auto mt-2">
                                                <p class="mb-0"> <?=number_format($presentase_gaji, 3,',','')?>%</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="collapse" id="collapse-4">
                                        <div class="card card-body mt-2">
                                            <div class="row justify-content-between">
                                                <div class="col-auto">
                                                    Total
                                                </div>
                                                <div class="col-auto">
                                                    Rp. <?=number_format($total_gaji['total_gaji'])?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- bagian hadiah -->
                                    <a data-bs-toggle="collapse" href="#collapse-5" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <div class="row justify-content-between text-secondary">
                                            <div class="col-8 mt-2">
                                                <button class="btn btn-sm btn-info me-3" style="border-radius:50%;"><i class="bi bi-gift-fill text-light"></i></button> Hadiah
                                            </div>
                                            <div class="col-auto mt-2">
                                                <p class="mb-0"> <?=number_format($presentase_hadiah, 3,',','')?>%</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="collapse" id="collapse-5">
                                        <div class="card card-body mt-2">
                                            <div class="row justify-content-between">
                                                <div class="col-auto">
                                                    Total
                                                </div>
                                                <div class="col-auto">
                                                    Rp. <?=number_format($total_hadiah['total_hadiah'])?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- bagian investasi -->
                                    <a data-bs-toggle="collapse" href="#collapse-6" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <div class="row justify-content-between text-secondary">
                                            <div class="col-8 mt-2">
                                                <button class="btn btn-sm btn-secondary me-3" style="border-radius:50%;"><i class="bi bi-clipboard-data"></i></button> Investasi
                                            </div>
                                            <div class="col-auto mt-2">
                                                <p class="mb-0"> <?=number_format($presentase_investasi, 3,',','')?>%</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="collapse" id="collapse-6">
                                        <div class="card card-body mt-2">
                                            <div class="row justify-content-between">
                                                <div class="col-auto">
                                                    Total
                                                </div>
                                                <div class="col-auto">
                                                    Rp. <?=number_format($total_investasi['total_investasi'])?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- bagian Makanan -->
                                    <a data-bs-toggle="collapse" href="#collapse-7" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <div class="row justify-content-between text-secondary">
                                            <div class="col-8 mt-2">
                                                <button class="btn btn-sm btn-danger me-3" style="border-radius:50%;"><i class="bi bi-cup-hot-fill text-light"></i></button> Makanan
                                            </div>
                                            <div class="col-auto mt-2">
                                                <p class="mb-0"> <?=number_format($presentase_makanan, 3,',','')?>%</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="collapse" id="collapse-7">
                                        <div class="card card-body mt-2">
                                            <div class="row justify-content-between">
                                                <div class="col-auto">
                                                    Total
                                                </div>
                                                <div class="col-auto">
                                                    Rp. <?=number_format($total_makanan['total_makanan'])?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- bagian pakaian -->
                                    <a data-bs-toggle="collapse" href="#collapse-8" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <div class="row justify-content-between text-secondary">
                                            <div class="col-8 mt-2">
                                                <button class="btn btn-sm btn-warning me-3" style="border-radius:50%;"><i class="bi bi-tencent-qq text-light"></i></button> Pakaian
                                            </div>
                                            <div class="col-auto mt-2">
                                                <p class="mb-0"> <?=number_format($presentase_pakaian, 3,',','')?>%</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="collapse" id="collapse-8">
                                        <div class="card card-body mt-2">
                                            <div class="row justify-content-between">
                                                <div class="col-auto">
                                                    Total
                                                </div>
                                                <div class="col-auto">
                                                    Rp. <?=number_format($total_pakaian['total_pakaian'])?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- bagian sekolah -->
                                    <a data-bs-toggle="collapse" href="#collapse-9" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <div class="row justify-content-between text-secondary">
                                            <div class="col-8 mt-2">
                                                <button class="btn btn-sm btn-success me-3" style="border-radius:50%;"><i class="bi bi-journal-code text-light"></i></button> Sekolah
                                            </div>
                                            <div class="col-auto mt-2">
                                                <p class="mb-0"> <?=number_format($presentase_sekolah, 3,',','')?>%</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="collapse" id="collapse-9">
                                        <div class="card card-body mt-2">
                                            <div class="row justify-content-between">
                                                <div class="col-auto">
                                                    Total
                                                </div>
                                                <div class="col-auto">
                                                    Rp. <?=number_format($total_sekolah['total_sekolah'])?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- bagian tabungan -->
                                    <a data-bs-toggle="collapse" href="#collapse-10" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <div class="row justify-content-between text-secondary">
                                            <div class="col-8 mt-2">
                                                <button class="btn btn-sm btn-primary me-3" style="border-radius:50%;"><i class="bi bi-bank text-light"></i></button> Tabungan
                                            </div>
                                            <div class="col-auto mt-2">
                                                <p class="mb-0"> <?=number_format($presentase_tabungan, 3,',','')?>%</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="collapse" id="collapse-10">
                                        <div class="card card-body mt-2">
                                            <div class="row justify-content-between">
                                                <div class="col-auto">
                                                    Total
                                                </div>
                                                <div class="col-auto">
                                                    Rp. <?=number_format($total_tabungan['total_tabungan'])?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- bagian transportasi -->
                                    <a data-bs-toggle="collapse" href="#collapse-11" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <div class="row justify-content-between text-secondary">
                                            <div class="col-8 mt-2">
                                                <button class="btn btn-sm btn-info me-3" style="border-radius:50%;"><i class="bi bi-bus-front text-light"></i></button> Transportasi
                                            </div>
                                            <div class="col-auto mt-2">
                                                <p class="mb-0"> <?=number_format($presentase_transportasi, 3, ',', '')?>%</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="collapse" id="collapse-11">
                                        <div class="card card-body mt-2">
                                            <div class="row justify-content-between">
                                                <div class="col-auto">
                                                    Total
                                                </div>
                                                <div class="col-auto">
                                                    Rp. <?=number_format($total_transportasi['total_transportasi'])?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- bagian lainnya -->
                                    <a data-bs-toggle="collapse" href="#collapse-12" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <div class="row justify-content-between text-secondary">
                                            <div class="col-8 mt-2">
                                                <button class="btn btn-sm btn-secondary me-3" style="border-radius:50%;"><i class="bi bi-grid-fill text-light"></i></button> Lainnya
                                            </div>
                                            <div class="col-auto mt-2">
                                                <p class="mb-0"> <?=number_format($presentase_lainnya, 3,',','')?>%</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="collapse" id="collapse-12">
                                    <div class="card card-body mt-2">
                                        <div class="row justify-content-between">
                                            <div class="col-auto">
                                                Total
                                            </div>
                                            <div class="col-auto">
                                                Rp. <?=number_format($total_lainnya['total_lainnya'])?>
                                            </div>
                                        </div>
                                    </div>
                                    </div>

                                    <!-- untuk total pemasukan -->
                                    <hr class="mt-3">
                                    <div class="col-auto">
                                        Total
                                    </div>
                                    <div class="col-auto">
                                        Rp. <?=number_format($jumlah_pemasukan['pemasukan'])?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- akhiran accordion-item pertama -->


                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                Pengeluaran
                            </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <div class="row justify-content-between">
                                    <?php

                                        // untuk menghitung keseluruhan
                                        $hitung_png = mysqli_query($conn, "SELECT SUM(jumlah) AS total FROM keuangan WHERE jenis='pengeluaran'");
                                        $total_png = mysqli_fetch_array($hitung_png);

                                        if($total_png['total'] == 0) {

                                            $presentase_hadiah_png = 0;
                                            $total_hadiah_png = 0;

                                            $presentase_belanja_png = 0;
                                            $total_belanja_png = 0;

                                            $presentase_gaji_png = 0;
                                            $total_gaji_png = 0;

                                            $presentase_makanan_png = 0;
                                            $total_makanan_png = 0;

                                            $presentase_transportasi_png = 0;
                                            $total_transportasi_png = 0;

                                            $presentase_investasi_png = 0;
                                            $total_investasi_png = 0;

                                            $presentase_tabungan_png = 0;
                                            $total_tabungan_png = 0;

                                            $presentase_pakaian_png = 0;
                                            $total_pakaian_png = 0;

                                            $presentase_lainnya_png = 0;
                                            $total_lainnya_png = 0;

                                            $presentase_asuransi_png = 0;
                                            $total_asuransi_png = 0;

                                            $presentase_BBM_png = 0;
                                            $total_BBM_png = 0;

                                            $presentase_sekolah_png = 0;
                                            $total_sekolah_png = 0;

                                        } else {

                                        // untuk menghitung kategori hadiah
                                        $hitung_hadiah_png = mysqli_query($conn, "SELECT SUM(jumlah) AS total_hadiah FROM keuangan WHERE jenis='pengeluaran' AND kategori='Hadiah'");
                                        $total_hadiah_png = mysqli_fetch_array($hitung_hadiah_png);

                                        if($total_hadiah_png == 0) {
                                        $presentase_hadiah_png = 0;
                                        } else {
                                        $presentase_hadiah_png = ($total_hadiah_png['total_hadiah'] / $total_png['total']) * 100;
                                        }

                                        // untuk menghitung kategori belanja
                                        $hitung_belanja_png = mysqli_query($conn, "SELECT SUM(jumlah) AS total_belanja FROM keuangan WHERE jenis='pengeluaran' AND kategori='Belanja'");
                                        $total_belanja_png = mysqli_fetch_array($hitung_belanja_png);

                                        if($total_belanja_png == 0) {
                                        $presentase_belanja_png = 0;
                                        } else {
                                        $presentase_belanja_png = ($total_belanja_png['total_belanja'] / $total_png['total']) * 100;
                                        }

                                        // untuk menghitung kategori gaji
                                        $hitung_gaji_png = mysqli_query($conn, "SELECT SUM(jumlah) AS total_gaji FROM keuangan WHERE jenis='pengeluaran' AND kategori='Gaji'");
                                        $total_gaji_png = mysqli_fetch_array($hitung_gaji_png);

                                        if($total_gaji_png == 0) {
                                        $presentase_gaji_png = 0;
                                        } else {
                                        $presentase_gaji_png = ($total_gaji_png['total_gaji'] / $total_png['total']) * 100;
                                        }

                                        // untuk menghitung kategori makanan
                                        $hitung_makanan_png = mysqli_query($conn, "SELECT SUM(jumlah) AS total_makanan FROM keuangan WHERE jenis='pengeluaran' AND kategori='Makanan'");
                                        $total_makanan_png = mysqli_fetch_array($hitung_makanan_png);

                                        if($total_makanan_png == 0) {
                                        $presentase_makanan_png = 0;
                                        } else {
                                        $presentase_makanan_png = ($total_makanan_png['total_makanan'] / $total_png['total']) * 100;
                                        }

                                        // untuk menghitung kategori Transportasi
                                        $hitung_transportasi_png = mysqli_query($conn, "SELECT SUM(jumlah) AS total_transportasi FROM keuangan WHERE jenis='pengeluaran' AND kategori='Transportasi'");
                                        $total_transportasi_png = mysqli_fetch_array($hitung_transportasi_png);

                                        if($total_transportasi_png == 0) {
                                        $presentase_transportasi_png = 0;
                                        } else {
                                        $presentase_transportasi_png = ($total_transportasi_png['total_transportasi'] / $total_png['total']) * 100;
                                        }

                                        // untuk menghitung kategori investasi
                                        $hitung_investasi_png = mysqli_query($conn, "SELECT SUM(jumlah) AS total_investasi FROM keuangan WHERE jenis='pengeluaran' AND kategori='Investasi'");
                                        $total_investasi_png = mysqli_fetch_array($hitung_investasi_png);

                                        if($total_investasi_png == 0) {
                                        $presentase_investasi_png = 0;
                                        } else {
                                        $presentase_investasi_png = ($total_investasi_png['total_investasi'] / $total_png['total']) * 100;
                                        }

                                        // untuk menghitung kategori tabungan
                                        $hitung_tabungan_png = mysqli_query($conn, "SELECT SUM(jumlah) AS total_tabungan FROM keuangan WHERE jenis='pengeluaran' AND kategori='Tabungan'");
                                        $total_tabungan_png = mysqli_fetch_array($hitung_tabungan_png);

                                        if($total_tabungan_png == 0) {
                                        $presentase_tabungan_png = 0;
                                        } else {
                                        $presentase_tabungan_png = ($total_tabungan_png['total_tabungan'] / $total_png['total']) * 100;
                                        }

                                        // untuk menghitung kategori pakaian
                                        $hitung_pakaian_png = mysqli_query($conn, "SELECT SUM(jumlah) AS total_pakaian FROM keuangan WHERE jenis='pengeluaran' AND kategori='Pakaian'");
                                        $total_pakaian_png = mysqli_fetch_array($hitung_pakaian_png);

                                        if($total_pakaian_png == 0) {
                                        $presentase_pakaian_png = 0;
                                        } else {
                                        $presentase_pakaian_png = ($total_pakaian_png['total_pakaian'] / $total_png['total']) * 100;
                                        }

                                        // untuk menghitung kategori sekolah
                                        $hitung_sekolah_png = mysqli_query($conn, "SELECT SUM(jumlah) AS total_sekolah FROM keuangan WHERE jenis='pengeluaran' AND kategori='Sekolah'");
                                        $total_sekolah_png = mysqli_fetch_array($hitung_sekolah_png);

                                        if($total_sekolah_png == 0) {
                                        $presentase_sekolah_png = 0;
                                        } else {
                                        $presentase_sekolah_png = ($total_sekolah_png['total_sekolah'] / $total_png['total']) * 100;
                                        }

                                        // untuk menghitung kategori asuransi
                                        $hitung_asuransi_png = mysqli_query($conn, "SELECT SUM(jumlah) AS total_asuransi FROM keuangan WHERE jenis='pengeluaran' AND kategori='Asuransi'");
                                        $total_asuransi_png = mysqli_fetch_array($hitung_asuransi_png);

                                        if($total_asuransi_png == 0) {
                                        $presentase_asuransi_png = 0;
                                        } else {
                                        $presentase_asuransi_png = ($total_asuransi_png['total_asuransi'] / $total_png['total']) * 100;
                                        }

                                        // untuk menghitung kategori BBM
                                        $hitung_BBM_png = mysqli_query($conn, "SELECT SUM(jumlah) AS total_BBM FROM keuangan WHERE jenis='pengeluaran' AND kategori='BBM'");
                                        $total_BBM_png = mysqli_fetch_array($hitung_BBM_png);

                                        if($total_BBM_png == 0) {
                                        $presentase_BBM_png = 0;
                                        } else {
                                        $presentase_BBM_png = ($total_BBM_png['total_BBM'] / $total_png['total']) * 100;
                                        }

                                        // untuk menghitung kategori lainnya
                                        $hitung_lainnya_png = mysqli_query($conn, "SELECT SUM(jumlah) AS total_lainnya FROM keuangan WHERE jenis='pengeluaran' AND kategori != 'Hadiah' AND kategori != 'Belanja' AND kategori !='Gaji' AND kategori !='Makanan' AND kategori !='Transportasi' AND kategori !='Investasi' AND kategori !='Tabungan' AND kategori !='Pakaian' AND kategori !='Asuransi' AND kategori !='BBM' AND kategori !='Sekolah'");
                                        $total_lainnya_png = mysqli_fetch_array($hitung_lainnya_png);

                                        if($total_lainnya_png == 0) {
                                        $presentase_lainnya_png = 0;
                                        } else {
                                        $presentase_lainnya_png = ($total_lainnya_png['total_lainnya'] / $total_png['total']) * 100;
                                        }

                                        }

                                        ?>
                                        <div class="col-auto fw-bold">Kategori</div>
                                        <div class="col-auto fw-bold">Presentase</div>
                                        <hr class="mb-0 mt-2">

                                        <!-- bagian Asuransi -->
                                    <a data-bs-toggle="collapse" href="#collapse-13" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <div class="row justify-content-between text-secondary">
                                            <div class="col-8 mt-2">
                                                <button class="btn btn-sm btn-danger me-3" style="border-radius:50%;"><i class="bi bi-building-fill-check text-light"></i></button> Asuransi
                                            </div>
                                            <div class="col-auto mt-2">
                                                <p class="mb-0"> <?=number_format($presentase_asuransi_png, 3,',','')?>%</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="collapse" id="collapse-13">
                                        <div class="card card-body mt-2">
                                            <div class="row justify-content-between">
                                                <div class="col-auto">
                                                    Total
                                                </div>
                                                <div class="col-auto">
                                                    Rp. <?=number_format($total_asuransi_png['total_asuransi'])?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- bagian BBM -->
                                    <a data-bs-toggle="collapse" href="#collapse-14" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <div class="row justify-content-between text-secondary">
                                            <div class="col-8 mt-2">
                                                <button class="btn btn-sm btn-warning me-3" style="border-radius:50%;"><i class="bi bi-fuel-pump text-light"></i></button> BBM
                                            </div>
                                            <div class="col-auto mt-2">
                                                <p class="mb-0"> <?=number_format($presentase_BBM_png, 3,',','')?>%</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="collapse" id="collapse-14">
                                        <div class="card card-body mt-2">
                                            <div class="row justify-content-between">
                                                <div class="col-auto">
                                                    Total
                                                </div>
                                                <div class="col-auto">
                                                    Rp. <?=number_format($total_BBM_png['total_BBM'])?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- bagian belanja -->
                                    <a data-bs-toggle="collapse" href="#collapse-15" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <div class="row justify-content-between text-secondary">
                                            <div class="col-8 mt-2">
                                                <button class="btn btn-sm btn-success me-3" style="border-radius:50%;"><i class="bi bi-cart4 text-light"></i></button> Belanja
                                            </div>
                                            <div class="col-auto mt-2">
                                                <p class="mb-0"> <?=number_format($presentase_belanja_png, 3,',','')?>%</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="collapse" id="collapse-15">
                                        <div class="card card-body mt-2">
                                            <div class="row justify-content-between">
                                                <div class="col-auto">
                                                    Total
                                                </div>
                                                <div class="col-auto">
                                                    Rp. <?=number_format($total_belanja_png['total_belanja'])?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- bagian gaji -->
                                    <a data-bs-toggle="collapse" href="#collapse-16" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <div class="row justify-content-between text-secondary">
                                            <div class="col-8 mt-2">
                                                <button class="btn btn-sm btn-primary me-3" style="border-radius:50%;"><i class="bi bi-tags-fill text-light"></i></button> Gaji
                                            </div>
                                            <div class="col-auto mt-2">
                                                <p class="mb-0"> <?=number_format($presentase_gaji_png, 3,',','')?>%</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="collapse" id="collapse-16">
                                        <div class="card card-body mt-2">
                                            <div class="row justify-content-between">
                                                <div class="col-auto">
                                                    Total
                                                </div>
                                                <div class="col-auto">
                                                    Rp. <?=number_format($total_gaji_png['total_gaji'])?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- bagian hadiah -->
                                    <a data-bs-toggle="collapse" href="#collapse-17" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <div class="row justify-content-between text-secondary">
                                            <div class="col-8 mt-2">
                                                <button class="btn btn-sm btn-info me-3" style="border-radius:50%;"><i class="bi bi-gift-fill text-light"></i></button> Hadiah
                                            </div>
                                            <div class="col-auto mt-2">
                                                <p class="mb-0"> <?=number_format($presentase_hadiah_png, 3,',','')?>%</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="collapse" id="collapse-17">
                                        <div class="card card-body mt-2">
                                            <div class="row justify-content-between">
                                                <div class="col-auto">
                                                    Total
                                                </div>
                                                <div class="col-auto">
                                                    Rp. <?=number_format($total_hadiah_png['total_hadiah'])?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- bagian investasi -->
                                    <a data-bs-toggle="collapse" href="#collapse-18" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <div class="row justify-content-between text-secondary">
                                            <div class="col-8 mt-2">
                                                <button class="btn btn-sm btn-secondary me-3" style="border-radius:50%;"><i class="bi bi-clipboard-data"></i></button> Investasi
                                            </div>
                                            <div class="col-auto mt-2">
                                                <p class="mb-0"> <?=number_format($presentase_investasi_png, 3,',','')?>%</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="collapse" id="collapse-18">
                                        <div class="card card-body mt-2">
                                            <div class="row justify-content-between">
                                                <div class="col-auto">
                                                    Total
                                                </div>
                                                <div class="col-auto">
                                                    Rp. <?=number_format($total_investasi_png['total_investasi'])?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- bagian Makanan -->
                                    <a data-bs-toggle="collapse" href="#collapse-19" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <div class="row justify-content-between text-secondary">
                                            <div class="col-8 mt-2">
                                                <button class="btn btn-sm btn-danger me-3" style="border-radius:50%;"><i class="bi bi-cup-hot-fill text-light"></i></button> Makanan
                                            </div>
                                            <div class="col-auto mt-2">
                                                <p class="mb-0"> <?=number_format($presentase_makanan_png, 3,',','')?>%</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="collapse" id="collapse-19">
                                        <div class="card card-body mt-2">
                                            <div class="row justify-content-between">
                                                <div class="col-auto">
                                                    Total
                                                </div>
                                                <div class="col-auto">
                                                    Rp. <?=number_format($total_makanan_png['total_makanan'])?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- bagian pakaian -->
                                    <a data-bs-toggle="collapse" href="#collapse-20" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <div class="row justify-content-between text-secondary">
                                            <div class="col-8 mt-2">
                                                <button class="btn btn-sm btn-warning me-3" style="border-radius:50%;"><i class="bi bi-tencent-qq text-light"></i></button> Pakaian
                                            </div>
                                            <div class="col-auto mt-2">
                                                <p class="mb-0"> <?=number_format($presentase_pakaian_png, 3,',','')?>%</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="collapse" id="collapse-20">
                                        <div class="card card-body mt-2">
                                            <div class="row justify-content-between">
                                                <div class="col-auto">
                                                    Total
                                                </div>
                                                <div class="col-auto">
                                                    Rp. <?=number_format($total_pakaian_png['total_pakaian'])?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- bagian sekolah -->
                                    <a data-bs-toggle="collapse" href="#collapse-21" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <div class="row justify-content-between text-secondary">
                                            <div class="col-8 mt-2">
                                                <button class="btn btn-sm btn-success me-3" style="border-radius:50%;"><i class="bi bi-journal-code text-light"></i></button> Sekolah
                                            </div>
                                            <div class="col-auto mt-2">
                                                <p class="mb-0"> <?=number_format($presentase_sekolah_png, 3,',','')?>%</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="collapse" id="collapse-21">
                                        <div class="card card-body mt-2">
                                            <div class="row justify-content-between">
                                                <div class="col-auto">
                                                    Total
                                                </div>
                                                <div class="col-auto">
                                                    Rp. <?=number_format($total_sekolah_png['total_sekolah'])?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- bagian tabungan -->
                                    <a data-bs-toggle="collapse" href="#collapse-22" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <div class="row justify-content-between text-secondary">
                                            <div class="col-8 mt-2">
                                                <button class="btn btn-sm btn-primary me-3" style="border-radius:50%;"><i class="bi bi-bank text-light"></i></button> Tabungan
                                            </div>
                                            <div class="col-auto mt-2">
                                                <p class="mb-0"> <?=number_format($presentase_tabungan_png, 3,',','')?>%</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="collapse" id="collapse-22">
                                        <div class="card card-body mt-2">
                                            <div class="row justify-content-between">
                                                <div class="col-auto">
                                                    Total
                                                </div>
                                                <div class="col-auto">
                                                    Rp. <?=number_format($total_tabungan_png['total_tabungan'])?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- bagian transportasi -->
                                    <a data-bs-toggle="collapse" href="#collapse-23" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <div class="row justify-content-between text-secondary">
                                            <div class="col-8 mt-2">
                                                <button class="btn btn-sm btn-info me-3" style="border-radius:50%;"><i class="bi bi-bus-front text-light"></i></button> Transportasi
                                            </div>
                                            <div class="col-auto mt-2">
                                                <p class="mb-0"> <?=number_format($presentase_transportasi_png, 3, ',', '')?>%</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="collapse" id="collapse-23">
                                        <div class="card card-body mt-2">
                                            <div class="row justify-content-between">
                                                <div class="col-auto">
                                                    Total
                                                </div>
                                                <div class="col-auto">
                                                    Rp. <?=number_format($total_transportasi_png['total_transportasi'])?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- bagian lainnya -->
                                    <a data-bs-toggle="collapse" href="#collapse-24" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <div class="row justify-content-between text-secondary">
                                            <div class="col-8 mt-2">
                                                <button class="btn btn-sm btn-secondary me-3" style="border-radius:50%;"><i class="bi bi-grid-fill text-light"></i></button> Lainnya
                                            </div>
                                            <div class="col-auto mt-2">
                                                <p class="mb-0"> <?=number_format($presentase_lainnya_png, 3,',','')?>%</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="collapse" id="collapse-24">
                                    <div class="card card-body mt-2">
                                        <div class="row justify-content-between">
                                            <div class="col-auto">
                                                Total
                                            </div>
                                            <div class="col-auto">
                                                Rp. <?=number_format($total_lainnya_png['total_lainnya'])?>
                                            </div>
                                        </div>
                                    </div>
                                    </div>

                                         <!-- untuk total pengeluaran -->
                                    <hr class="mt-3">
                                        <div class="col-auto">
                                            Total
                                        </div>
                                        <div class="col-auto">
                                            Rp. <?=number_format($jumlah_pengeluaran['pengeluaran'])?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- akhiran accordion-item kedua -->
                    </div>
                    <p class="text-secondary mb-0 mt-2">
                        Lainnya
                    </p>
                    <hr class="mt-1 mb-0">
                    <div class="accordion" id="accordionExample">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-hapus" aria-expanded="false" aria-controls="flush-collapseOne">
                            Hapus semua daftar
                        </button>
                        </h2>
                        <div id="flush-collapse-hapus" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample_hapus">
                        <div class="accordion-body">
                            <small class="text-secondary" style="font-size:13px;">
                            <i class="bi bi-exclamation-circle-fill text-danger fs-4 me-2"></i> Jika anda menghapus semua daftar, semua akan <i> terreset </i> dan data dari awal Anda menggunakan aplikasi ini akan ikut terhapus,  tetap lanjutkan?
                            </small>
                            <div class="row justify-content-end">
                                <div class="col-auto fw-bold">
                                    <a href="t_act.php?remove_all=yes" class="text-danger" style="font-size:14px; text-decoration:underline;">Hapus semua daftar</a>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>
<!-- untuk akhiran setting -->

</div>
<!-- akhiran untuk mobile-mode -->

<?php
include "navbar-2.php";
include "footer.php";
?>