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
						<a href="#" class="nav-link text-white pr-3"><i class=" fa fa-user-plus"></i> Hesap Oluştur</a>
					</li>
					<li class="nav-item">
						<a href="#" target="_blank" class="nav-link text-white"><i class=" fa fa-user-circle-o"></i> Müşteri Paneli</a>
					</li>
				</ul>
			</div>
		</div>
		<nav class="navbar navbar-expand-lg d-none d-lg-block" style="z-index:999;">
			<div class="container">
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
		<div style="background:#000; margin-top:-150px;">
			<img src="img/sergi-kabrera-2xU7rYxsTiM-unsplash.jpg" class="d-block w-100" style="height:200px; opacity:0.4; filter:alpha(opacity=40);">
		</div>