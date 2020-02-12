<?php 
include ("header.php");
include ("sidebar.php");
$referanssor=$db->prepare("SELECT * FROM referans");
$referanssor->execute();
?>  
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>referans Listeleme <small>
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
              <a href="referans-ekle.php"><button class="btn btn-success btn-xs"> Yeni Ekle</button></a>
            </div>
          </div>
          <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Referans Ad</th>
                  <th>Referans Url</th>
                  <th>Referans Resim</th>
                  <th>Yapılan İşler</th>                
                  <th>Oluşturma Zaman</th>
                  <th>Düzenleme Zaman</th>                  
                </tr>
              </thead>
              <tbody>
                <?php 
                $say=0;
                while($referanscek=$referanssor->fetch(PDO::FETCH_ASSOC)) { $say++?>
                  <tr>
                   <td width="20"><?php echo $say ?></td>
                   <td><?php echo $referanscek['ad'] ?></td>
                   <td><?php echo $referanscek['link'] ?></td>
                   <td><img src="<?php echo $referanscek['resim'] ?>"></td>  
                   <td><?php echo $referanscek['yapilan_isler'] ?></td> 
                   <td><?php echo $referanscek['created_at'] ?></td> 
                   <td><?php echo $referanscek['updated_at'] ?></td>                             
                   <td><center><a href="referans-duzenle.php?referans_id=<?php echo $referanscek['referans_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center>
                    <center><a href="../baglan/islem.php?referans_id=<?php echo $referanscek['referans_id']; ?>&referanssil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
                  </tr>
                <?php  }?>
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
