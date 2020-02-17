<?php include ("admin/baglan/baglan.php");?>
<!doctype html>
<html lang="en">
<head>	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">	
	<title>Media WBH</title>
	<style>
		.bg-soft-black{
			background-color: #262626;
		}
		body{
			
		}
		.link:hover{
			color: #3b79ae!important;}
		
	</style>
</head>
<body>	
	<div class="navbar navbar-expand-lg d-none d-md-block" style="z-index:999;">
		<div class="container">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a href="#" target="_blank" class="nav-link text-white"><i class="fa fa-facebook-square"></i></a>
				</li>
				<li class="nav-item">
					<a href="#" target="_blank" class="nav-link text-white"><i class="fa fa-twitter-square"></i></a>
				</li>
				<li class="nav-item">
					<a href="#" target="_blank" class="nav-link text-white pr-4"><i class=" fa fa-instagram "></i></a>
				</li>
				<li class="nav-item">
					<a href="hesap-olustur.php" class="nav-link text-white pr-3"><i class=" fa fa-user-plus"></i> Hesap Oluştur</a>
				</li>
				<li class="nav-item">
					<a href="#" data-toggle="modal" data-target="#modal2" class="nav-link text-white"><i class=" fa fa-user-circle-o"></i> Müşteri Paneli</a>
				</li>
			</ul>
		</div>
	</div>
	 <div class="modal fade bd-example-modal-sm" id="modal2">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Giriş Yap</h5>
            <button type="button" class="close" data-dismiss="modal">
              <span>&times;</span>
            </button>
          </div>

          <div class="modal-body">
         <div class="form-group">
           <label class="form-control-label">Kullanıcı Adı:</label>
           <input type="text" class="form-control" placeholder="Kullanıcı adı ya da eposta girin" name="">
         </div>
         <div class="form-group">
           <label class="form-control-label">Parola:</label>
           <input type="text" class="form-control" placeholder="Paloranızı girin" name="">
         </div>
          </div>

          <div class="modal-footer">
            <button type="submit" name="girisyap" class="btn btn-success" style="background-color:#3b79ae;">Giriş Yap</button>
            <button type="button" class="btn btn-warning" data-dismiss="modal" >Parolamı unuttum</button>

          </div>
        </div>
      </div>
    </div>
	<nav class="navbar navbar-expand-lg d-none d-lg-block" style="z-index:999;">
		<div class="container py-2">
			<a href="#" class="navbar-brand"><img src="img/logo.png" style="width: 175px; height: 60px;"></a>
			<ul class="navbar-nav">
				<?php 
            $menusor=$db->prepare("SELECT * FROM menu order by menu_sira");
            $menusor->execute();
            $say=0;
              while($menucek=$menusor->fetch(PDO::FETCH_ASSOC)) { $say++?>
				<li class="nav-item mx-2"><a href="<?php echo $menucek['menu_url'] ?>" class="nav-link text-white link"><strong><?php echo $menucek['menu_ad'] ?></strong></a></li>
				<?php } ?>
			</ul>
		</div>
	</nav>
	<section style="margin-top:-160px; background:#000; " class="d-none d-md-block">	
		<div class="bd-example">
			<div id="carouselExampleCaptions" class="carousel slide carousel-fade d-none d-md-block" data-ride="carousel">

				<div class="carousel-inner">
					<div class="carousel-item active">
						<img src="img/igor-miske-Px3iBXV-4TU-unsplash.jpg" class="d-block w-100" style="height:550px; opacity:0.4; filter:alpha(opacity=40);" alt="MediaWBH">
						<div class="carousel-caption d-none d-md-block">
							<h5>Web Tasarım</h5>
							<p>Profesyonel Web Çözümleri</p>
						</div>
					</div>
					<div class="carousel-item">
						<img src="img/timothy-muza-6VjPmyMj5KM-unsplash.jpg" class="d-block w-100" style="height:550px; opacity:0.4; filter:alpha(opacity=40);" alt="MediaWBH">
						<div class="carousel-caption d-none d-md-block">
							<h5>Profesyonel Hosting Hizmetleri</h5>
							<p>Güçlü, Dinamik, Hızlı. Farklı özelliklerdeki çözümlerimizden size en uygun olanı tercih edin.</p>
						</div>
					</div>
					<div class="carousel-item">
						<img src="img/william-iven-SpVHcbuKi6E-unsplash.jpg" class="d-block w-100" style="height:550px; opacity:0.4; filter:alpha(opacity=40);" alt="MediaWBH">
						<div class="carousel-caption d-none d-md-block">
							<h5>Google SEO</h5>
							<p>Google'da ilk sayfada çıkmak artık hayal değil! Firmamız Google SEO çalışmaları konusunda yılların bilgi birikimi ve uzmanlığına sahiptir.</p>
						</div>
					</div>
				</div>    
			</div>
		</div>
	</section>
	<section align="center">
		<div class="container py-5">
		<h2>Alan Adı Tescil</h2> <hr>											
			<form action="baglan/islem.php" method="post">
				<div class="row">
					<div class="col-md-6" >
					<input type="text" style="margin-left:220px;" name="" class="form-control w-75"  placeholder="Alan Adı Yazınız(Uzantı olmadan)">
					</div>
					<div class="col-md-6">
					<select class="form-control w-25" style="margin-left:70px;" id="exampleFormControlSelect1">
						<option>com</option>
						<option>com.tr</option>
						<option>net</option>
						<option>org</option>
						
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<button class="btn btn-outline-secondary mt-4"><i class="fa fa-search"></i> Sorgula</button>
				</div>
			</div>					
			</form>
		</div>			
	</div>
	</section>
	<secİtion>
		<div class="container py-5">
		<h2 align="center">Paketlerimiz</h2><hr>
		<div class="row">
			<div class="col-md-4">
			<div class="card text-center">
				<div class="card-header bg-dark text-white "><h4>S LİMİTSİZ</h4></div>
				<div class="card-body bg-dark text-white">
					<h1 class="Kart Başlığı">33.90 ₺</h1>
					<p class="card-text">Aylık </p>
					<button style="background-color:#3b79ae;" class="btn btn-primary"> Hemen satın al</button>
					</div>
					<ul class="list-group list-group-flush">
						<li class="list-group-item"><i class="fa fa-server"></i>	Limitsiz Site Barındırma</li>
							<li class="list-group-item"><i class="fa fa-signal"></i>	Limitsiz SSD Disk Alanı</li>
							<li class="list-group-item"><i class="fa fa-database"></i>	Limitsiz Aylık Trafik</li>
							<li class="list-group-item"><i class="fa fa-gear"></i>	Limitsiz FTP & E-Posta</li>
					</ul>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card text-center">
					<div class="card-header bg-dark text-white "><h4>M LİMİTSİZ</h4></div>
					<div class="card-body bg-dark text-white">
						<h1 class="Kart Başlığı">41.90 ₺</h1>
						<p class="card-text">Aylık </p>
						<button style="background-color:#3b79ae;" class="btn btn-primary"> Hemen satın al</button>
						</div>
						<ul class="list-group list-group-flush">
							<li class="list-group-item"><i class="fa fa-server"></i>	Limitsiz Site Barındırma</li>
							<li class="list-group-item"><i class="fa fa-signal"></i>	Limitsiz SSD Disk Alanı</li>
							<li class="list-group-item"><i class="fa fa-database"></i>	Limitsiz Aylık Trafik</li>
							<li class="list-group-item"><i class="fa fa-gear"></i>	Limitsiz FTP & E-Posta</li>
						</ul>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card text-center">
						<div class="card-header bg-dark text-white "><h4>L LİMİTSİZ</h4></div>
						<div class="card-body bg-dark text-white">
							<h1 class="Kart Başlığı">68.90 ₺</h1>
							<p class="card-text">Aylık </p>
							<button style="background-color:#3b79ae;" class="btn btn-primary"> Hemen satın al</button>
							</div>
							<ul class="list-group list-group-flush">
								<li class="list-group-item"><i class="fa fa-server"></i>	Limitsiz Site Barındırma</li>
							<li class="list-group-item"><i class="fa fa-signal"></i>	Limitsiz SSD Disk Alanı</li>
							<li class="list-group-item"><i class="fa fa-database"></i>	Limitsiz Aylık Trafik</li>
							<li class="list-group-item"><i class="fa fa-gear"></i>	Limitsiz FTP & E-Posta</li>
							</ul>
						</div>
					</div>							
		</div>
	</div>
	</secİtion>
	<section>
		<div class="container py-5">
			<h2 align="center">Neler yaptık?</h2> <hr>
			<div class="row">
				<div id="carouselExampleControls1" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
					  <div class="carousel-item active ">
						<div class="row">
						<div class="col-2 mb-1"><a href="#">
						  <img class="img-fluid" style="height: 170px;" src="img/gvfdghb.png" alt="First slide">
						</a></div>
						<div class="col-2 mb-1"><a href="#">
							<img class="img-fluid" style="height: 170px;" src="img/cfserfgre.png" alt="First slide">
						  </a></div>
						  <div class="col-2 mb-1"><a href="#">
							<img class="img-fluid" style="height: 170px;" src="img/gfthfh.png" alt="First slide">
						  </a></div>
						  <div class="col-2 mb-1"><a href="#">
							<img class="img-fluid" style="height: 170px;" src="img/timothy-muza-6VjPmyMj5KM-unsplash.jpg" alt="First slide">
						  </a></div>
						  <div class="col-2 mb-1"><a href="#">
							<img class="img-fluid" style="height: 170px;" src="img/timothy-muza-6VjPmyMj5KM-unsplash.jpg" alt="First slide">
						  </a></div>
						  <div class="col-2 mb-1"><a href="#">
							<img class="img-fluid" style="height: 170px;" src="img/timothy-muza-6VjPmyMj5KM-unsplash.jpg" alt="First slide">
						  </a></div>						
						</div>
					  </div>
					  <div class="carousel-item">
						<div class="row">
							<div class="col-2 mb-1"><a href="#">
								<img class="img-fluid" style="height: 170px;" src="img/timothy-muza-6VjPmyMj5KM-unsplash.jpg" alt="First slide">
							  </a></div>
							  <div class="col-2 mb-1"><a href="#">
								  <img class="img-fluid" style="height: 170px;" src="img/timothy-muza-6VjPmyMj5KM-unsplash.jpg" alt="First slide">
								</a></div>
								<div class="col-2 mb-1"><a href="#">
								  <img class="img-fluid" style="height: 170px;" src="img/timothy-muza-6VjPmyMj5KM-unsplash.jpg" alt="First slide">
								</a></div>
								<div class="col-2 mb-1"><a href="#">
								  <img class="img-fluid" style="height: 170px;" src="img/timothy-muza-6VjPmyMj5KM-unsplash.jpg" alt="First slide">
								</a></div>
								<div class="col-2 mb-1"><a href="#">
								  <img class="img-fluid" style="height: 170px;" src="img/timothy-muza-6VjPmyMj5KM-unsplash.jpg" alt="First slide">
								</a></div>
								<div class="col-2 mb-1"><a href="#">
								  <img class="img-fluid" style="height: 170px;" src="img/timothy-muza-6VjPmyMj5KM-unsplash.jpg" alt="First slide">
								</a></div>
						</div>
					  </div>					
					<a class="carousel-control-prev" href="#carouselExampleControls1" role="button" data-slide="prev">
					  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
					  <span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next " href="#carouselExampleControls1" role="button" data-slide="next">
					  <span class="carousel-control-next-icon" aria-hidden="true"></span>
					  <span class="sr-only">Next</span>
					</a>
				  </div>
				</div>
				</div>				
	</section>
	<section>
		<div class="container py-5">
			<h2 align="center">Web sitenizi barındırmak için neden <strong style="color: #3b79ae;">	MediaWBH  </strong> kullanmalısınız?</h2> <hr>
			<div class="row" >
				<div class="col-md-3 py-4 link" align="center">
					<i class="fa fa-rocket fa-4x link"></i> <br><br>	<h2>Hızlı</h2>
				</div>
				<div class="col-md-3 py-4 link" align="center">
					<i class="fa fa-tachometer fa-4x"></i> <br><br>	<h2>Ölçeklenebilir</h2>
				</div>
				<div class="col-md-3 py-4 link" align="center">
					<i class="fa fa-comments fa-4x link"></i> <br><br><h2>Destek İmkanı</h2>
				</div>
				<div class="col-md-3 py-4 link" align="center">
					<i class="fa fa-line-chart fa-4x link"></i> <br><br>	<h2>Dürüst</h2>
				</div>
			</div>
			</div>
	</section>	
	<?php include "footer.php"; ?>