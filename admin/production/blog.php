<?php 
include ("header.php");
include ("sidebar.php");
$blogsor=$db->prepare("SELECT * FROM blog order by blog_id DESC");
$blogsor->execute();
?>  
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Blog Listeleme <small>
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
              <a href="blog-ekle.php"><button class="btn btn-success btn-xs"> Yeni Ekle</button></a>
            </div>
          </div>
          <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Ad</th>
                  <th>Url</th>
                  <th>İçerik </th>
                  <th>Resim</th>
                  <th>Ayar</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                
                while($blogcek=$blogsor->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                 <td width="20"><?php echo $blogcek['blog_id'] ?></td>
                 <td><?php echo $blogcek['blog_ad'] ?></td>
                 <td><?php echo $blogcek['blog_url'] ?></td>
                 <td><?php echo substr( $blogcek['blog_icerik'],0,90) ?></td>
                 <td><img style="width:175px; height:100px; " src="../../<?php echo $blogcek['blog_resim'] ?>" ></td>             
                 <td><center><a href="blog-duzenle.php?blog_id=<?php echo $blogcek['blog_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center>
            <center><a href="../baglan/islem.php?blog_id=<?php echo $blogcek['blog_id']; ?>&blogsil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
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
