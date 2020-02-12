<?php 
include ("header.php");
include ("sidebar.php");
$paketsor=$db->prepare("SELECT * FROM paket_icerikleri");
$paketsor->execute();
?>  
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>paket Ekleme </h2>
            <div class="clearfix"></div>
            <div class="x_content">
            <br />
          <form enctype="multipart/form-data" action="../baglan/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
           
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Adı<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="baslik"  required="required" placeholder="Paket Adını giriniz" class="form-control col-md-7 col-xs-12">
                </div>
              </div>            
            <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">İkon <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="icon"   placeholder="İkonun kodunu yazınız" class="form-control col-md-7 col-xs-12">
              </div>
            </div>                        
               
               </div>
             </div>
             <div class="ln_solid"></div>
             <div class="form-group">
              <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" name="paketicerikekle" class="btn btn-success">Kaydet</button>
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
