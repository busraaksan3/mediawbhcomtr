<?php 
include ("header.php");
include ("sidebar.php");
$sor=$db->prepare("SELECT * FROM paket_icerikleri order by id DESC");
$sor->execute();
?>  
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Paket içerikleri <small>
              <?php 
              if ($_GET['durum']=="ok") {?>
              <b style="color:green;">İşlem Başarılı...</b>
              <?php } elseif ($_GET['durum']=="no") {?>
              <b style="color:red;">İşlem Başarısız...</b>
              <?php }
              ?>
            </small></h2>
            <div class="clearfix"></div>
            <div align="right">
              <a href="paket-icerik-ekle.php"><button class="btn btn-success btn-xs"> Yeni Ekle</button></a>
            </div>
          </div>
          <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Ad</th>
                   <th>İcon</th>
                  <th>Ayar</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                
                while($cek=$sor->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                 <td width="20"><?php echo $cek['id'] ?></td>
                 <td><?php echo $cek['baslik'] ?></td>
                 <td><i class="fa fa-<?php echo $cek['icon'] ?>"></i></td>             
                       
                 <td><center><a href="paket-icerik-duzenle.php?id=<?php echo $cek['id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center>
            <center><a href="../baglan/islem.php?id=<?php echo $cek['id']; ?>&paketiceriksil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
          </tr>
          <?php  } ?>
        </tbody>
      </table>

    </div>
  </div>
</div>
</div>
</div>
</div>
 <?php 
 include ("footer.php");?>
