<?php 
include ("header.php");
include ("sidebar.php");
$paketiceriksor=$db->prepare("SELECT * FROM paket_icerikleri where id=:paketicerik_id");
$paketiceriksor->execute(array(
  'paketicerik_id' => $_GET['id']
  ));
$paketicerikcek=$paketiceriksor->fetch(PDO::FETCH_ASSOC);
?>  
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Paket İçerik düzenleme</h2>
            <div class="clearfix"></div>
            <div class="x_content">
            <br />
          <form enctype="multipart/form-data" action="../baglan/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
           
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Başlık<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="baslik"  required="required" value="<?php echo $paketicerikcek['baslik']; ?>" class="form-control col-md-7 col-xs-12">
                </div>
              </div>            
            <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">İcon<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="icon"  value="<?php echo $paketicerikcek['icon']; ?>" class="form-control col-md-7 col-xs-12">
              </div>
            </div>         
            
             </div>
              <input type="hidden" name="id" value="<?php echo $paketicerikcek['id'] ?>">
             <div class="ln_solid"></div>
             <div class="form-group">
              <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" name="paketicerikduzenle" class="btn btn-success">Kaydet</button>
              </div>
            </div>
          </form>              
    </div>
  </div>
</div>
</div>
</div>
</div>
 <?php 
 include ("footer.php");?>
