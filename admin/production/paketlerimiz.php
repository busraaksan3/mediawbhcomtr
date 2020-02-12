<?php
include("header.php");
include("sidebar.php");
$paketsor = $db->prepare("SELECT * FROM paket order by paket_id DESC");
$paketsor->execute();
?>
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Paket Listeleme <small>
                                <?php
                                if ($_GET['durum'] == "ok") { ?>
                                    <b style="color:green;">İşlem Başarılı...</b>
                                <?php } elseif ($_GET['durum'] == "no") { ?>
                                    <b style="color:red;">İşlem Başarısız...</b>
                                <?php }
                                ?>
                            </small></h2>
                        <div class="clearfix"></div>
                        <div align="right">
                            <a href="paket-ekle.php">
                                <button class="btn btn-success btn-xs"> Yeni Paket Ekle</button>
                            </a>
                        </div>
                        <div align="left">
                            <a href="paket-icerik.php">
                                <button class="btn btn-success btn-xs"> Paket İçerikleri</button>
                            </a>
                        </div>
                    </div>
                    <div class="x_content">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"
                               cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ad</th>
                                <th>Fiyat</th>
                                <th>İçerik</th>
                                <th>Ayar</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php foreach ($paketsor as $paket): ?>
                                <tr>
                                    <td><?= $paket["paket_id"] ?></td>
                                    <td><?= $paket["paket_ad"] ?></td>
                                    <td><?= $paket["paket_fiyat"] ?></td>
                                    <td>
                                        <?php
                                        $paketListesi = explode(",", $paket["paket_icerik"]);
                                        $returnArray = [];
                                        foreach ($paketListesi as $icerik) {
                                            $icerikID = str_replace('"', "", $icerik);
                                            $icerikNesnesi = $db->query("SELECT * FROM paket_icerikleri WHERE id = '{$icerikID}'")->fetch(PDO::FETCH_ASSOC);
                                            ?>
                                            <i class="fa fa-<?= $icerikNesnesi["icon"] ?>"></i> <?= $icerikNesnesi["baslik"] ?>
                                            <br>
                                        <?php } ?>
                                    </td>
                                    <td><a href="blog-duzenle.php?blog_id=<?php echo $blogcek['blog_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a>
                                    <a href="../baglan/islem.php?blog_id=<?php echo $blogcek['blog_id']; ?>&blogsil=ok"><button class="btn btn-danger btn-xs">Sil</button></a> </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include("footer.php"); ?>
