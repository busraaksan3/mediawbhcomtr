<?php 
include ("header.php");
include ("sidebar.php");
$sor=$db->prepare("SELECT * FROM logs order by id DESC");
$sor->execute();
?>  
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Geçmiş İşlemler <small>
              <?php 
              if ($_GET['durum']=="ok") {?>
                <b style="color:green;">İşlem Başarılı...</b>
              <?php } elseif ($_GET['durum']=="no") {?>
                <b style="color:red;">İşlem Başarısız...</b>
              <?php }
              ?>
            </small></h2>
            <div class="clearfix"></div>
            
          </div>
          <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Olay</th>
                  <th>Detay</th>
                  <th>Oluşturulma Zamanı</th>                 
                  <th>Düzenleme Zamanı</th> 
                  <th>Yazar</th>  

                </tr>
              </thead>
              <tbody>
                <?php 
                $say=0;
                while($cek=$sor->fetch(PDO::FETCH_ASSOC)) { $say++?>
                  <tr>
                   <td width="20"><?php echo $say ?></td>
                   <td><?php echo $cek['transaction'] ?></td>
                   <td><?php echo $cek['detail'] ?></td>              
                   <td><?php echo $cek['created_at'] ?></td> 
                   <td><?php echo $cek['updated_at'] ?></td>                             
                   <td><?php echo $cek['user_id'] ?></td>
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
