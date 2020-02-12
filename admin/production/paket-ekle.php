<?php 
include ("header.php");
include ("sidebar.php");
$paketsor=$db->prepare("SELECT * FROM paket");
$paketsor->execute();
?>  
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Paket Ekleme </h2>
            <div class="clearfix"></div>
            <div class="x_content">
              <br />
              <form enctype="multipart/form-data" action="../baglan/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Paket Adı<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="paket_ad"  required="required" placeholder="Başlık giriniz" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
               <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Paket içeriklerini seç<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                 <select multiple="" class="form-control" name="id">
                  <?php 
                  $paketiceriksor=$db->prepare("SELECT * FROM paket_icerikleri order by id ASC");
                  $paketiceriksor->execute();
                  while($paketicerikcek=$paketiceriksor->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                  <option value="<?php echo $paketicerikcek['id'] ?>"><i class="fa fa-<?php echo $paketicerikcek['icon'];?>"></i>
                 <?php echo $paketicerikcek['baslik']; ?></option>
                <?php } ?>
                </select>
              </div>
            </div>                          
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Paket Fiyatı <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="paket_url"   placeholder="Paket Fiyatını giriniz" class="form-control col-md-7 col-xs-12">
              </div>
            </div>                        

          </div>
        </div>
        <div class="ln_solid"></div>
        <div class="form-group">
          <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <button type="submit" name="paketekle" class="btn btn-success">Kaydet</button>
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
