<?php
include "koneksi.php";
include "header.php";

if(isset($_GET['tgl'])) {
    $tanggal = $_GET['tgl'];

    $query = mysqli_query($conn, "SELECT * FROM keuangan WHERE tanggal='$tanggal'");
    $data = mysqli_fetch_array($query);
}

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
                <small style="color:rgba(255, 255, 255, 0.562);"><i class="bi bi-house-fill"></i> Beranda <i class="bi bi-chevron-right"></i> <i class="bi bi-eye"></i> Detail</small>
            </div>
        </div>
        <div class="tanggal">
            <div class="row justify-content-between mt-2">
                <div class="col-auto">
                    <small class="text-end"><i class="bi bi-calendar2-week me-3"></i> <?=$data['tanggal']?></small>
                </div>
            </div>
            
            <h2 class="fw-bold mt-2">
                <?php
                // untuk mencari pemasukan
                $pemasukan = mysqli_query($conn, "SELECT SUM(jumlah) AS pemasukan FROM keuangan WHERE jenis='pemasukan' AND tanggal='$tanggal' ");
                $jumlah_pemasukan = mysqli_fetch_array($pemasukan);

                // untuk mencari pengeluaran
                $pengeluaran = mysqli_query($conn, "SELECT SUM(jumlah) AS pengeluaran FROM keuangan WHERE jenis='pengeluaran' AND tanggal='$tanggal' ");
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
                    if($_GET['alert'] == "hapus") {
                        ?>
                            <div class="col-11 option ps-2 pt-1 pb-1 text-secondary mb-3" data-aos="fade-zoom-in" data-aos-delay="250" data-aos-offset="0">
                                <p class="mb-0">
                                    <i class="bi bi-exclamation-octagon-fill text-danger fs-2 me-2"></i> <i style="font-size: 12px;">Berhasil dihapus!</i></p>
                            </div>
                        <?php
                    }
                }
                ?>

            <div class="col-11 content mb-3" data-aos="fade-up" data-aos-delay="250" data-aos-offset="0">
                <div class="row keterangan justify-content-start">
                    <div class="col-12">
                        <small class="text-secondary"><i class="bi bi-exclamation-triangle-fill me-1 text-danger"></i> klik salah satu content jika Anda ingin mengubahnya</small>
                    </div>
                </div>
                    <?php
                    $try = mysqli_query($conn, "SELECT * FROM keuangan WHERE tanggal='$tanggal' ORDER BY id_keuangan DESC ");
                    $i = 25;
                    $j = 1234;
                    while($hasil = mysqli_fetch_array($try)) {
                        $i ++
                    ?>
                    
                    <hr class="mb-0 mt-0">
                        <a data-bs-toggle="collapse" href="#collapse-<?=$i?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <div class="row justify-content-between text-secondary">
                                <div class="col-auto mt-2">
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
                                </div>
                                <div class="col-auto mt-2">
                                    <p class="mb-0">
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
                                                ?> <small class="text-secondary ms-1"><i class="bi bi-pencil-square"></i></small> <?php
                                            }
                                            ?>
                                            </p>
                                            <?php
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </a>
                        <div class="collapse" id="collapse-<?=$i?>">
                            <?php
                            if($hasil['kategori'] == "Asuransi") {
                                ?> <div class="card card-header bg-danger text-light"> <?php
                            } else if($hasil['kategori'] == "BBM") {
                                ?> <div class="card card-header bg-warning text-light"> <?php
                            } else if($hasil['kategori'] == "Belanja") {
                                ?> <div class="card card-header bg-success text-light"> <?php
                            } else if($hasil['kategori'] == "Gaji") {
                                ?> <div class="card card-header bg-primary text-light"> <?php
                            } else if($hasil['kategori'] == "Hadiah") {
                                ?> <div class="card card-header bg-info text-light"> <?php
                            } else if($hasil['kategori'] == "Investasi") {
                                ?> <div class="card card-header bg-secondary text-light"> <?php
                            } else if($hasil['kategori'] == "Makanan") {
                                ?> <div class="card card-header bg-danger text-light"> <?php
                            } else if($hasil['kategori'] == "Pakaian") {
                                ?> <div class="card card-header bg-warning text-light"> <?php
                            } else if($hasil['kategori'] == "Sekolah") {
                                ?> <div class="card card-header bg-success text-light"> <?php
                            } else if($hasil['kategori'] == "Tabungan") {
                                ?> <div class="card card-header bg-primary text-light"> <?php
                            } else if($hasil['kategori'] == "Transportasi") {
                                ?> <div class="card card-header bg-info text-light"> <?php
                            } else {
                                ?> <div class="card card-header bg-secondary text-light"> <?php
                            }
                            ?>
                                <div class="row justify-content-between">
                                    <div class="col-auto">
                                        <small style="font-size:13px; font-weight:bold;">Keterangan</small>
                                    </div>
                                    <div class="col-auto">
                                        <a href="edit.php?id=<?=$hasil['id_keuangan']?>" class="text-light">
                                            <p class="p-0 m-0 text-end fs-5">
                                                <i class="bi bi-pencil-square"></i>
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-body mt-1 mb-2">
                                <div class="row justify-content-between text-secondary mt-0">
                                    <div class="col-5">
                                        <small style="font-size:13px;">Nominal : </small>
                                    </div>
                                    <div class="col-auto">
                                        <small style="font-size:13px;">Rp. <?=number_format($hasil['jumlah'])?></small>
                                    </div>
                                    <hr class="mb-0">
                                    <div class="col-5">
                                        <small style="font-size:13px;">Tanggal : </small>
                                    </div>
                                    <div class="col-auto">
                                        <small style="font-size:13px;"><?=$hasil['tanggal']?></small>
                                    </div>
                                    <hr class="mb-0">
                                    <div class="col-5">
                                        <small style="font-size:13px;">Waktu : </small>
                                    </div>
                                    <div class="col-auto">
                                        <small style="font-size:13px;"><?=$hasil['waktu']?></small>
                                    </div>
                                    <hr class="mb-0">
                                    <div class="col-5">
                                        <small style="font-size:13px;">Kategori : </small>
                                    </div>
                                    <div class="col-auto">
                                        <?php
                                        if($hasil['jenis'] == "pemasukan") {
                                            ?> <small style="font-size:13px;" class="text-success"><?=$hasil['jenis']?></small> <?php
                                        } else {
                                            ?> <small style="font-size:13px;" class="text-danger"><?=$hasil['jenis']?></small> <?php
                                        }
                                        ?>
                                        
                                    </div>
                                    <hr class="mb-0">
                                    <div class="col-5">
                                        <small style="font-size:13px;">Jenis : </small>
                                    </div>
                                    <div class="col-auto">
                                        <small style="font-size:13px;"><?=$hasil['kategori']?></small>
                                    </div>
                                    <hr class="mb-0">
                                    <div class="col-5">
                                        <small style="font-size:13px;">Catatan : </small>
                                    </div>
                                    <div class="col-auto">
                                        <small style="font-size:13px;"><?=$hasil['catatan']?></small>
                                    </div>
                                    <?php
                                    if($hasil['status'] == "") {
                                        echo "";
                                    }else {
                                        ?>
                                        <hr class="mb-0">
                                        <div class="col-5">
                                            <small style="font-size:13px;">Status : </small>
                                        </div>
                                        <div class="col-auto">
                                            <small style="font-size:13px;" class="text-success"><?=$hasil['status']?></small>
                                        </div>
                                        <hr class="mb-0">
                                        <div class="col-5">
                                            <small style="font-size:13px;">Waktu diubah : </small>
                                        </div>
                                        <div class="col-auto">
                                            <small style="font-size:13px;"><?=$hasil['ket_wkt_diubah']?></small>
                                        </div>
                                        <?php
                                    }
                                    $j ++
                                    ?>
                                    <hr class="mb-0">
                                    <div class="col-12 text-end">
                                            <p class="mb-0">
                                                    <a class="text-danger fw-bold mt-1 mb-0" data-bs-toggle="collapse" href="#collapseExample-<?=$j?>" role="button" aria-expanded="false" aria-controls="collapseExample" style="font-size:13px; text-decoration:underline;">
                                                        Hapus
                                                    </a>
                                            </p>
                                            <div class="collapse" id="collapseExample-<?=$j?>">
                                                <div class="card text-start card-body text-secondary pt-2 pb-1">
                                                        <small style="font-size:12px;">Apakah anda yakin ingin menghapus <?=$hasil['kategori']?> dari daftar?</small>
                                                        <hr class="mb-0 mt-0">
                                                    <div class="container">
                                                        <div class="row justify-content-end">
                                                            <div class="col-auto">
                                                                <div class="d-grid">
                                                                    <a href="t_act.php?hapus=yes&tgl=<?=$tanggal?>&id=<?=$hasil['id_keuangan']?>" class="text-danger fw-bold mt-1" style="border-radius:none; font-size:12px; text-decoration:underline;">Hapus</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <!-- <div class="col-11 content mb-3" data-aos="fade-up" data-aos-delay="250" data-aos-offset="0">
                    <p class="mb-0 text-center mt-1 mb-2">
                        <a class="text-center text-secondary mt-2" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        Lainnya <i class="bi bi-chevron-down"></i>
                        </a>
                    </p>
                    <div class="collapse" id="collapseExample">
                        <div class="">
                            <div class="row justify-content-start">
                                <div class="col-12 mb-0 pb-0">
                                    <p class="mb-0">
                                        <div class="d-grid mb-0">
                                            <a class="text-secondary btn btn-sm border" data-bs-toggle="collapse" href="#collapseExample-1" role="button" aria-expanded="false" aria-controls="collapseExample" style="font-size:13px;">
                                                            Hapus semua daftar tanggal <?=$tanggal?>
                                            </a>
                                        </div>
                                        </p>
                                            <div class="collapse" id="collapseExample-1">
                                                <div class="card card-body mb-3 text-secondary pt-2 pb-1">
                                                    <small style="font-size:12px;">Apakah anda yakin ingin menghapus semua daftar tanggal <?=$tanggal?>?</small>
                                                    <hr class="mb-0 mt-0">
                                                <div class="container">
                                            <div class="row justify-content-end">
                                                <div class="col-auto">
                                                    <div class="d-grid">
                                                        <a href="t_act.php?hapus_semua=yes&tgl=<?=$tanggal?>" class="text-danger fw-bold mt-1" style="border-radius:none; font-size:12px; text-decoration:underline;">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</section>

</div>
<!-- akhiran untuk mobile-mode -->

<?php
include "navbar-2.php";
include "footer.php";
?>