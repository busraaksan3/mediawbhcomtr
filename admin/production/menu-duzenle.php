<?php 
include ("header.php");
include ("sidebar.php");

$menusor=$db->prepare("SELECT * FROM menu where menu_id=:id");
$menusor->execute(array(
  'id' => $_GET['menu_id']
  ));
$menucek=$menusor->fetch(PDO::FETCH_ASSOC);
?>  
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Menü Düzenleme </h2>
            <div class="clearfix"></div>
            <div class="x_content">
            <br />
            <form action="../baglan/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Menü Ad <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="menu_ad"  required="required" value="<?php echo $menucek['menu_ad'] ?>" class="form-control col-md-7 col-xs-12">
                </div>
              </div>            
            <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Menü Url <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="menu_url" value="<?php echo $menucek['menu_url'] ?>" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Menü Sıra <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="menu_sira"  required="required" value="<?php echo $menucek['menu_sira'] ?>"  class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              </label>      
               </div>
             </div>
             <input type="hidden" name="menu_id" value="<?php echo $menucek['menu_id'] ?>"> 
             <div class="ln_solid"></div>
             <div class="form-group">
              <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" name="menuduzenle" class="btn btn-success">Kaydet</button>
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
