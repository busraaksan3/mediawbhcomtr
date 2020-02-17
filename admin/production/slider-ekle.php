<?php 
include ("header.php");
include ("sidebar.php");
$slidersor=$db->prepare("SELECT * FROM slider");
$slidersor->execute();
$slidercek=$slidersor->fetch(PDO::FETCH_ASSOC);
?>  
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>slider Ekleme </h2>
            <div class="clearfix"></div>
            <div class="x_content">
            <br />
          <form enctype="multipart/form-data" action="../baglan/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
            <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Resim Seç<span>*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" id="first-name"  name="slider_resimyol"  class="form-control col-md-5 col-xs-12">               
                  </div>                  
                </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Adı<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="slider_ad"  required="required" placeholder="Slider adını giriniz" class="form-control col-md-7 col-xs-12">
                </div>
              </div>            
            <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Başlık <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="slider_h"   placeholder="Başlık giriniz" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
              <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Alt başlık<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="slider_p"   placeholder="Alt Başlık giriniz" class="form-control col-md-7 col-xs-12">
              </div>
            </div>  
            <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sıra<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="slider_sira"   placeholder="Slider sıra giriniz" class="form-control col-md-7 col-xs-12">
              </div>
            </div>       
             
               </div>
             </div>
             <div class="ln_solid"></div>
             <div class="form-group">
              <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" name="sliderekle" class="btn btn-success">Kaydet</button>
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
