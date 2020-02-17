<?php 
include "header.php";
?>
<section>		
	<div class="container py-5">	
		<div class="row">
			<div class=" col-md-8"> <h4>İçerik</h4>
				 <form enctype="multipart/form-data" action="admin/baglan/islem.php" method="POST" >
					<div class="form-group">
						<label>Kullanıcı Adı</label>
						<input type="text" class="form-control" name="kullanici_ad" placeholder="kullanıcı adınızı giriniz.">
					</div>
					<div class="form-group">
						<label for="formGroupExampleInput2">e-mail</label>
						<input type="email" class="form-control" name="kullanici_mail" placeholder="E-mail adresinizi giriniz.">
					</div>
					<div class="form-group">
						<label for="formGroupExampleInput2">Parola</label>
						<input type="password" class="form-control" name="kullanici_password" placeholder="Parolanızı giriniz">
					</div>
					<button type="submit" name="musterikayit" class="btn btn-primary">Kaydol</button>
				</form>				
			</div>
			<div class=" col-md-4"> <h4>Blog'tan Son Yazılar</h4>
			</div>
			
		</div>
	</div>
</section>  
<?php include "footer.php"; ?>