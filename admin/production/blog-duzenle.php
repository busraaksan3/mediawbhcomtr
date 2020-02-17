<?php 
include ("header.php");
include ("sidebar.php");
$blogsor=$db->prepare("SELECT * FROM blog where blog_id=:id");
$blogsor->execute(array(
  'id' => $_GET['blog_id']
  ));
$blogcek=$blogsor->fetch(PDO::FETCH_ASSOC);
?>  
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Blog Ekleme </h2>
            <div class="clearfix"></div>
            <div class="x_content">
            <br />
          <form enctype="multipart/form-data" action="../baglan/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
            <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Resim Seç<span>*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" id="first-name"  name="blog_resim"  class="form-control col-md-5 col-xs-12">
                    <input type="hidden" name="old_img_url" value="<?php echo $blogcek['blog_resim']; ?>">
                    <img src="../../<?php echo $blogcek['blog_resim']; ?>"  style="width: 100%; height: 100%;" >               
                  </div>                  
                </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Başlık<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="blog_ad"  required="required" value="<?php echo $blogcek['blog_ad']; ?>" class="form-control col-md-7 col-xs-12">
                </div>
              </div>            
            <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Blog Url <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="blog_url"  value="<?php echo $blogcek['blog_url']; ?>" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            
            <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Blog İçerik <span class="required">*</span>
                  </label>
                  <div class="col-md-8 col-sm-8 col-xs-12">

                    <textarea  class="ckeditor" id="editor1" name="blog_icerik"><?php echo $blogcek['blog_icerik']; ?></textarea>
                  </div>
                </div>

                <script type="text/javascript">

                 CKEDITOR.replace( 'editor1',

                 {

                  filebrowserBrowseUrl : 'ckfinder/ckfinder.html',

                  filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',

                  filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',

                  filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',

                  filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

                  filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',

                  forcePasteAsPlainText: true

                } 

                );
              </script>
              </label>      
               </div>
             </div>
              <input type="hidden" name="blog_id" value="<?php echo $blogcek['blog_id'] ?>">
             <div class="ln_solid"></div>
             <div class="form-group">
              <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" name="blogduzenle" class="btn btn-success">Kaydet</button>
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
