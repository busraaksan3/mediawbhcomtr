<?php 
include ("header.php");
include ("sidebar.php");
$slidersor=$db->prepare("SELECT * FROM slider order by slider_id DESC");
$slidersor->execute();
?>  
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>slider Listeleme <small>
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
              <a href="slider-ekle.php"><button class="btn btn-success btn-xs"> Yeni Ekle</button></a>
            </div>
          </div>
          <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Ad</th>                  
                  <th>Başlık </th>
                  <th>Küçük Yazı  </th>
                  <th>Resim</th>
                  <th>Sıra</th>
                  <th>Ayar</th>
                </tr>
              </thead>
              <tbody>
                <?php                 
                while($slidercek=$slidersor->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                 <td width="20"><?php echo $slidercek['slider_id'] ?></td>
                 <td><?php echo $slidercek['slider_ad'] ?></td>                 
                 <td><?php echo $slidercek['slider_h'] ?></td>
                 <td><?php echo $slidercek['slider_p'] ?></td>
                 <td><img style="width:175px; height:100px; " src="../../<?php echo $slidercek['slider_resimyol'] ?>" ></td> 
                  <td><?php echo $slidercek['slider_sira'] ?></td>            
                 <td><center><a href="slider-duzenle.php?slider_id=<?php echo $slidercek['slider_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center>
            <center><a href="../baglan/islem.php?slider_id=<?php echo $slidercek['slider_id']; ?>&slidersil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
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
