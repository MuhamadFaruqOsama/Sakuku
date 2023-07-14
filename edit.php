<?php
include "koneksi.php";
include "header.php";

if(isset($_GET['id'])) {
    $id_keuangan = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM keuangan WHERE id_keuangan='$id_keuangan'");
}

$data = mysqli_fetch_array($query);

?>

<div class="dekstop-mode">
    <h3 class="text-light position-absolute top-50 start-50 translate-middle">Maaf, Aplikasi ini belum tersedia di versi Desktop</h3>
</div>

<div class="mobile-mode">

<!-- untuk section pertama -->
<section class="header-1 shadow" style="background: linear-gradient(to bottom, rgb(0, 119, 216), rgb(71, 164, 240));">
    <div class="container">
        <div class="row">
            <div class="col-auto">
                <small style="color:rgba(255, 255, 255, 0.562);"><i class="bi bi-house-fill"></i> Beranda <i class="bi bi-chevron-right"></i> <i class="bi bi-eye"></i> Detail <i class="bi bi-chevron-right"></i> <i class="bi bi-pencil-square"></i> Edit </small>
            </div>
        </div>
    </div>
    <div class="row p-3" style="width:100%;">
        <div class="col-12">
            <form action="t_act.php" method="post" class="form-tambah">
                <div class="row">
                    <div class="col-2 mt-2">
                        <h1 class="fw-bold">Rp.</h1>
                    </div>
                    <div class="col-10">
                        <input type="number" name="jumlah" class="input-option-jumlah" placeholder="Masukan nominal" autocomplete="off" value="<?=$data['jumlah']?>" required>
                    </div>
                </div>
            <input type="hidden" name="id_keuangan" value="<?=$data['id_keuangan']?>">
            <input type="hidden" name="tanggal" value="<?=$data['tanggal']?>">
            <input type="hidden" name="waktu_lama" value="<?=$data['waktu']?>">
        </div>
    </div>
</section>
<!-- akhiran untuk section pertama -->

<!-- untuk bagian pengaturan -->
<section id="content">
    <div class="container mt-3">
            <div class="row justify-content-center">

               <!-- untuk alert -->
               <?php
                    if(isset($_GET['alert'])) {
                        if($_GET['alert'] == "kategori_tv") {
                            ?>
                                <div class="col-11 option ps-2 pt-1 pb-1 text-secondary mb-3" data-aos="fade-zoom-in" data-aos-delay="250" data-aos-offset="0">
                                    <p class="mb-0"><i class="bi bi-exclamation-octagon-fill text-danger fs-2 me-2"></i> <i style="font-size: 12px;">Anda tidak bisa mengisi kedua kategori sekaligus!</i></p>
                                </div>
                            <?php
                        }
                    }
                ?>

                <div class="col-11 option p-3 text-secondary">

                    <!-- untuk tanggal -->
                    <p class="mb-0">
                        <div class="row justify-content-between">
                            <div class="col-auto fw-bold mt-1">
                                <button class="btn btn-sm btn-danger me-3" style="border-radius:50%;"><i class="bi bi-calendar2-week text-light"></i></button> Tanggal
                            </div>
                            <div class="col-auto mt-1">
                                <?=$data['tanggal']; ?>
                            </div>
                        </div>
                    <hr class="ms-0 me-0">

                    <!-- untuk catatan -->
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Catatan
                            </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <input type="text" name="catatan" class="input-option-catatan" placeholder="Tulis catatan" autocomplete="off" value="<?=$data['catatan']?>">
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Kategori
                            </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row justify-content-center">
                                    <div class="col-12">
                                        <?php
                                        if($data['jenis'] == "pengeluaran") {
                                            ?>
                                            <select name="jenis" id="" class="form-select">
                                                <option value="pengeluaran">Pengeluaran</option>
                                                <option value="pemasukan">Pemasukan</option>
                                            </select>
                                            <?php
                                        } else {
                                            ?>
                                            <select name="jenis" id="" class="form-select">
                                                <option value="pemasukan">Pemasukan</option>
                                                <option value="pengeluaran">Pengeluaran</option>
                                            </select>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Jenis
                            </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <?php
                                if($data['kategori'] == "Asuransi") {
                                    ?>
                                    <select name="kategori" id="" class="form-select">
                                        <option value="Asuransi"> Asuransi </option>
                                        <option value="BBM"> BBM </option>
                                        <option value="Belanja">  Belanja  </option>
                                        <option value="Gaji"> Gaji </option>
                                        <option value="Hadiah"> Hadiah  </option>
                                        <option value="Investasi"> Investasi </option>
                                        <option value="Makanan">  Makanan  </option>
                                        <option value="Pakaian">  Pakaian  </option>
                                        <option value="Sekolah">  Sekolah  </option>
                                        <option value="Tabungan"> Tabungan </option>
                                        <option value="Transportasi"> Transportasi  </option>
                                        <option value=""> Kategori lainnya </option>
                                    </select>
                                    <?php
                                } else if($data['kategori'] == "BBM") {
                                    ?>
                                    <select name="kategori" id="" class="form-select">
                                        <option value="BBM"> BBM </option>
                                        <option value="Asuransi"> Asuransi </option>
                                        <option value="Belanja">  Belanja  </option>
                                        <option value="Gaji"> Gaji </option>
                                        <option value="Hadiah"> Hadiah  </option>
                                        <option value="Investasi"> Investasi </option>
                                        <option value="Makanan">  Makanan  </option>
                                        <option value="Pakaian">  Pakaian  </option>
                                        <option value="Sekolah">  Sekolah  </option>
                                        <option value="Tabungan"> Tabungan </option>
                                        <option value="Transportasi"> Transportasi  </option>
                                        <option value=""> Kategori lainnya </option>
                                    </select>
                                    <?php
                                } else if($data['kategori'] == "Belanja") {
                                    ?>
                                    <select name="kategori" id="" class="form-select">
                                        <option value="Belanja">  Belanja  </option>
                                        <option value="Asuransi"> Asuransi </option>
                                        <option value="BBM"> BBM </option>
                                        <option value="Gaji"> Gaji </option>
                                        <option value="Hadiah"> Hadiah  </option>
                                        <option value="Investasi"> Investasi </option>
                                        <option value="Makanan">  Makanan  </option>
                                        <option value="Pakaian">  Pakaian  </option>
                                        <option value="Sekolah">  Sekolah  </option>
                                        <option value="Tabungan"> Tabungan </option>
                                        <option value="Transportasi"> Transportasi  </option>
                                        <option value=""> Kategori lainnya </option>
                                    </select>
                                    <?php
                                } else if($data['kategori'] == "Gaji") {
                                    ?>
                                    <select name="kategori" id="" class="form-select">
                                        <option value="Gaji"> Gaji </option>
                                        <option value="Asuransi"> Asuransi </option>
                                        <option value="BBM"> BBM </option>
                                        <option value="Belanja">  Belanja  </option>
                                        <option value="Hadiah"> Hadiah  </option>
                                        <option value="Investasi"> Investasi </option>
                                        <option value="Makanan">  Makanan  </option>
                                        <option value="Pakaian">  Pakaian  </option>
                                        <option value="Sekolah">  Sekolah  </option>
                                        <option value="Tabungan"> Tabungan </option>
                                        <option value="Transportasi"> Transportasi  </option>
                                        <option value=""> Kategori lainnya </option>
                                    </select>
                                    <?php
                                } else if($data['kategori'] == "Hadiah") {
                                    ?>
                                    <select name="kategori" id="" class="form-select">
                                        <option value="Hadiah"> Hadiah  </option>
                                        <option value="Asuransi"> Asuransi </option>
                                        <option value="BBM"> BBM </option>
                                        <option value="Belanja">  Belanja  </option>
                                        <option value="Gaji"> Gaji </option>
                                        <option value="Investasi"> Investasi </option>
                                        <option value="Makanan">  Makanan  </option>
                                        <option value="Pakaian">  Pakaian  </option>
                                        <option value="Sekolah">  Sekolah  </option>
                                        <option value="Tabungan"> Tabungan </option>
                                        <option value="Transportasi"> Transportasi  </option>
                                        <option value=""> Kategori lainnya </option>
                                    </select>
                                    <?php
                                } else if($data['kategori'] == "Investasi") {
                                    ?>
                                    <select name="kategori" id="" class="form-select">
                                        <option value="Investasi"> Investasi </option>
                                        <option value="Asuransi"> Asuransi </option>
                                        <option value="BBM"> BBM </option>
                                        <option value="Belanja">  Belanja  </option>
                                        <option value="Gaji"> Gaji </option>
                                        <option value="Hadiah"> Hadiah  </option>
                                        <option value="Makanan">  Makanan  </option>
                                        <option value="Pakaian">  Pakaian  </option>
                                        <option value="Sekolah">  Sekolah  </option>
                                        <option value="Tabungan"> Tabungan </option>
                                        <option value="Transportasi"> Transportasi  </option>
                                        <option value=""> Kategori lainnya </option>
                                    </select>
                                    <?php
                                } else if($data['kategori'] == "Makanan") {
                                    ?>
                                    <select name="kategori" id="" class="form-select">
                                        <option value="Makanan">  Makanan  </option>
                                        <option value="Asuransi"> Asuransi </option>
                                        <option value="BBM"> BBM </option>
                                        <option value="Belanja">  Belanja  </option>
                                        <option value="Gaji"> Gaji </option>
                                        <option value="Hadiah"> Hadiah  </option>
                                        <option value="Investasi"> Investasi </option>
                                        <option value="Pakaian">  Pakaian  </option>
                                        <option value="Sekolah">  Sekolah  </option>
                                        <option value="Tabungan"> Tabungan </option>
                                        <option value="Transportasi"> Transportasi  </option>
                                        <option value=""> Kategori lainnya </option>
                                    </select>
                                    <?php
                                } else if($data['kategori'] == "Pakaian") {
                                    ?>
                                    <select name="kategori" id="" class="form-select">
                                        <option value="Pakaian">  Pakaian  </option>
                                        <option value="Asuransi"> Asuransi </option>
                                        <option value="BBM"> BBM </option>
                                        <option value="Belanja">  Belanja  </option>
                                        <option value="Gaji"> Gaji </option>
                                        <option value="Hadiah"> Hadiah  </option>
                                        <option value="Investasi"> Investasi </option>
                                        <option value="Makanan">  Makanan  </option>
                                        <option value="Sekolah">  Sekolah  </option>
                                        <option value="Tabungan"> Tabungan </option>
                                        <option value="Transportasi"> Transportasi  </option>
                                        <option value=""> Kategori lainnya </option>
                                    </select>
                                    <?php
                                } else if($data['kategori'] == "Sekolah") {
                                    ?>
                                    <select name="kategori" id="" class="form-select">
                                        <option value="Sekolah">  Sekolah  </option>
                                        <option value="Asuransi"> Asuransi </option>
                                        <option value="BBM"> BBM </option>
                                        <option value="Belanja">  Belanja  </option>
                                        <option value="Gaji"> Gaji </option>
                                        <option value="Hadiah"> Hadiah  </option>
                                        <option value="Investasi"> Investasi </option>
                                        <option value="Makanan">  Makanan  </option>
                                        <option value="Pakaian">  Pakaian  </option>
                                        <option value="Tabungan"> Tabungan </option>
                                        <option value="Transportasi"> Transportasi  </option>
                                        <option value=""> Kategori lainnya </option>
                                    </select>
                                    <?php
                                } else if($data['kategori'] == "Tabungan") {
                                    ?>
                                    <select name="kategori" id="" class="form-select">
                                        <option value="Tabungan"> Tabungan </option>
                                        <option value="Asuransi"> Asuransi </option>
                                        <option value="BBM"> BBM </option>
                                        <option value="Belanja">  Belanja  </option>
                                        <option value="Gaji"> Gaji </option>
                                        <option value="Hadiah"> Hadiah  </option>
                                        <option value="Investasi"> Investasi </option>
                                        <option value="Makanan">  Makanan  </option>
                                        <option value="Pakaian">  Pakaian  </option>
                                        <option value="Sekolah">  Sekolah  </option>
                                        <option value="Transportasi"> Transportasi  </option>
                                        <option value=""> Kategori lainnya </option>
                                    </select>
                                    <?php
                                } else if($data['kategori'] == "Transportasi") {
                                    ?>
                                    <select name="kategori" id="" class="form-select">
                                        <option value="Transportasi"> Transportasi  </option>
                                        <option value="Asuransi"> Asuransi </option>
                                        <option value="BBM"> BBM </option>
                                        <option value="Belanja">  Belanja  </option>
                                        <option value="Gaji"> Gaji </option>
                                        <option value="Hadiah"> Hadiah  </option>
                                        <option value="Investasi"> Investasi </option>
                                        <option value="Makanan">  Makanan  </option>
                                        <option value="Pakaian">  Pakaian  </option>
                                        <option value="Sekolah">  Sekolah  </option>
                                        <option value="Tabungan"> Tabungan </option>
                                        <option value=""> Kategori lainnya </option>
                                    </select>
                                    <?php
                                } else {
                                    ?>
                                    <select name="kategori" id="" class="form-select">
                                        <option value=""> Pilih kategori </option>
                                        <option value="Asuransi"> Asuransi </option>
                                        <option value="BBM"> BBM </option>
                                        <option value="Belanja">  Belanja  </option>
                                        <option value="Gaji"> Gaji </option>
                                        <option value="Hadiah"> Hadiah  </option>
                                        <option value="Investasi"> Investasi </option>
                                        <option value="Makanan">  Makanan  </option>
                                        <option value="Pakaian">  Pakaian  </option>
                                        <option value="Sekolah">  Sekolah  </option>
                                        <option value="Tabungan"> Tabungan </option>
                                        <option value="Transportasi"> Transportasi  </option>
                                    </select>
                                    <?php
                                }
                                ?>
                                <hr class="ms-0 me-0">
                                <?php
                                if(
                                    $data['kategori'] == "Asuransi" || 
                                    $data['kategori'] == "BBM" || 
                                    $data['kategori'] == "Belanja" || 
                                    $data['kategori'] == "Gaji" || 
                                    $data['kategori'] == "Hadiah" || 
                                    $data['kategori'] == "Investasi" || 
                                    $data['kategori'] == "Makanan" || 
                                    $data['kategori'] == "Pakaian" || 
                                    $data['kategori'] == "Sekolah" || 
                                    $data['kategori'] == "Tabungan" || 
                                    $data['kategori'] == "Transportasi"
                                ) {
                                ?>
                                <input type="text" name="kategori-lainnya" class="input-option-catatan" placeholder="Kategori lainnya" value="">
                                <?php
                                } else {
                                ?>
                                <input type="text" name="kategori-lainnya" class="input-option-catatan" placeholder="Kategori lainnya" value="<?=$data['kategori']?>">
                                <?php } ?>
                            </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="float-end">
                <button name="edit" style="background-color:transparent; border:none; margin-right: 3vh; margin-bottom:15vh;"><p style="font-size:60px;" class="text-danger"><i class="bi bi-check-circle-fill"></i></p></button>
            </div>
        </form>
    </div>
</section>
<!-- akhiran bagian pengaturan -->

</div>
<!-- akhiran mobile mode -->

<?php
include "navbar-3.php";
include "footer.php";
?>