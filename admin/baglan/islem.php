<?php 

ob_start();

session_start();

include'baglan.php';
include'../production/fonksiyon.php';


if (isset($_POST['userlogin'])) {
	$userad=$_POST['admin_ad'];
	$userpassword=md5($_POST['admin_password']);
	if($userad && $userpassword){
		$usersor=$db->prepare("SELECT * from kullanici where kullanici_ad=:ad and kullanici_password=:password and is_admin=:is_admin");

		$usersor->execute(array(
			'ad'=>$userad,
			'password'=>$userpassword,
			'is_admin'=>1
		));
		$say=$usersor->rowCount();
		if ($say>0){
			$user = $usersor->fetch(PDO::FETCH_ASSOC);
			$_SESSION['user_ad'] = $user["kullanici_ad"];
			$_SESSION['user_id'] = $user["kullanici_id"];
			header('Location:../production/index.php');
		}
		else{
			print_r($_POST);
		}
	}	
}

if (isset($_POST['musterikayit'])) {
	
	if(
		is_null($_POST["kullanici_ad"]) ||
		is_null($_POST["kullanici_password"]) ||
		is_null($_POST["kullanici_mail"])
	){
		// herhangi biri boşsa
	}else{
		$mailKontol = $db->prepare("SELECT * FROM kullanici WHERE kullanici_mail=?");
		$mailKontol->execute(array($_POST["kullanici_mail"]));
		if($mailKontol->rowCount() > 0){
			echo"mail zaten kullanımda";
		}else{
			if(strlen($_POST["kullanici_password"]) > 18){
				echo"şifre 18 karakterden fazla olmamalı";
			}else if(strlen($_POST["kullanici_password"]) < 6){
				echo"şifre 6 karakterden daha az olmamalı";
			}else{
				$usersor=$db->prepare("INSERT INTO kullanici set 
				 	kullanici_ad=:kullanici_ad,		
					kullanici_password=:kullanici_password,
					kullanici_mail	=:kullanici_mail,
					kullanici_resim=:kullanici_resim,		
					kullanici_gsm=:kullanici_gsm,
					kullanici_adres	=:kullanici_adres,
					kullanici_il	=:kullanici_il,
					kullanici_ilce=:kullanici_ilce,		
					is_admin=:is_admin,
					auth_level	=:auth_level	
					");

				$insert=$ayarekle->execute(array(
					'kullanici_ad' => $_POST['kullanici_ad'],
					'kullanici_password' => $_POST['kullanici_password'],
					'kullanici_mail' => $_POST['kullanici_mail'],
					'kullanici_resim' => $_POST['kullanici_resim'],
					'kullanici_gsm' => $_POST['kullanici_gsm'],
					'kullanici_adres' => $_POST['kullanici_adres'],
					'kullanici_il' => $_POST['kullanici_il'],
					'kullanici_ilce' => $_POST['kullanici_ilce'],
					'is_admin' =>0,
					'auth_level' =>0

				));
			}
		}
	}
	
	if ($insert) {
		Header("Location:../../index.php?durum=ok");
	} else {
		Header("Location:../../hesap-olustur.php?durum=no");
	}
}


if (isset($_POST['menukaydet'])) {
	$menu_seourl=seo($_POST['menu_ad']);
	$ayarekle=$db->prepare("INSERT INTO menu SET
		menu_ad=:menu_ad,		
		menu_url=:menu_url,
		menu_sira=:menu_sira		
		");
	$insert=$ayarekle->execute(array(
		'menu_ad' => $_POST['menu_ad'],
		'menu_url' => $menu_seourl,
		'menu_sira' => $_POST['menu_sira']		
	));
	$newLog = $db->prepare("INSERT INTO logs SET user_id = :user_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"user_id" => intval($_SESSION["user_id"]),
		"transaction" => "Menü Eklendi",
		"detail" => $_POST['menu_ad']. " Adlı Menü Eklendi"
	));
	if ($insert) {
		Header("Location:../production/menu.php?durum=ok");
	} else {
		Header("Location:../production/menu.php?durum=no");
	}
}

if ($_GET['menusil']=="ok") {

	$sil=$db->prepare("DELETE from menu where menu_id=:id");
	$kontrol=$sil->execute(array(
		'id' => $_GET['menu_id']
	));
	$newLog = $db->prepare("INSERT INTO logs SET user_id = :user_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"user_id" => intval($_SESSION["user_id"]),
		"transaction" => "Menü Silindi",
		"detail" => $_POST['menu_id']. "ID değerindeki Menü Silindi"
	));
	if ($kontrol) {
		header("location:../production/menu.php?sil=ok");
	} else {
		header("location:../production/menu.php?sil=no");
	}
}

if (isset($_POST['menuduzenle'])) {
	$menu_id=$_POST['menu_id'];	
	$menu_seourl=seo($_POST['menu_ad']);	
	$ayarkaydet=$db->prepare("UPDATE menu SET
		menu_ad=:menu_ad,		
		menu_url=:menu_url,
		menu_sira=:menu_sira
		WHERE menu_id={$_POST['menu_id']}");
	$update=$ayarkaydet->execute(array(
		'menu_ad' => $_POST['menu_ad'],		
		'menu_url' => $menu_seourl,
		'menu_sira' => $_POST['menu_sira']				
	));
	$newLog = $db->prepare("INSERT INTO logs SET user_id = :user_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"user_id" => intval($_SESSION["user_id"]),
		"transaction" => "Menü Güncellendi",
		"detail" => $_POST['menu_ad']. " Adlı Menü Düzenlendi"
	));
	if ($update) {
		Header("Location:../production/menu-duzenle.php?menu_id=$menu_id&durum=ok");
	} else {
		Header("Location:../production/menu-duzenle.php?menu_id=$menu_id&durum=no");
	}
}


if(isset($_POST['blogekle'])){
	if(isset($_FILES["blog_resim"]) && $_FILES["blog_resim"]["size"] > 0){
		$izinli_uzantilar=array('jpg','gif','png','pdf');
		$ext=strtolower(substr($_FILES['blog_resim']["name"],strpos($_FILES['blog_resim']["name"],'.')+1));
		if(in_array($ext, $izinli_uzantilar)===false){
			echo "Uzantı kabul edilmiyor";
			header("Location:../blog.php?durum=formathatali");
			exit;
		}
		$blog_seourl=seo($_POST['blog_ad']);
		$uploads_dir = '../../img/upload/';
		@$tmp_name = $_FILES['blog_resim']["tmp_name"];
		@$name = $_FILES['blog_resim']["name"];
		$benzersizad=strtotime(date("YmdHis"));
		$refimgyol=substr($uploads_dir, 6)."/".$benzersizad.$name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
	}else{
		$refimgyol = $_POST["old_img_url"];	}
	$icerikkaydet=$db->prepare("INSERT INTO blog SET
		blog_ad=:blog_ad,
		blog_url=:blog_url,
		blog_icerik=:blog_icerik,
		blog_resim=:blog_resim		
		");
	$update=$icerikkaydet->execute(array(
		'blog_ad' => $_POST['blog_ad'],
		'blog_url' => $blog_seourl,
		'blog_icerik' => $_POST['blog_icerik'],	
		'blog_resim'=>$refimgyol

	));
	$newLog = $db->prepare("INSERT INTO logs SET user_id = :user_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"user_id" => intval($_SESSION["user_id"]),
		"transaction" => "Blog Ekleme",
		"detail" => $_POST['blog_ad']. " Başlğında Yeni Haber Eklendi"
	));
	if ($update) {
		header("Location:../production/blog.php?durum=ok");
	} else {
		header("Location:../production/blog.php?durum=no");

	}
}

if ($_GET['blogsil']=="ok") {

	$sil=$db->prepare("DELETE from blog where blog_id=:id");
	$kontrol=$sil->execute(array(
		'id' => $_GET['blog_id']
	));

	$newLog = $db->prepare("INSERT INTO logs SET user_id = :user_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"user_id" => intval($_SESSION["user_id"]),
		"transaction" => "Blog Silindi",
		"detail" => $_GET['blog_id']. " ID Değerindeki Blog Yazısı Silindi"
	));

	if ($kontrol) {
		header("location:../production/blog.php?sil=ok");
	} else {
		header("location:../production/blog.php?sil=no");
	}
}


if (isset($_POST['blogduzenle'])) {
	if(isset($_FILES["blog_resim"]) && $_FILES["blog_resim"]["size"] > 0){
		$izinli_uzantilar=array('jpg','gif','png','pdf');
		$ext=strtolower(substr($_FILES['blog_resim']["name"],strpos($_FILES['blog_resim']["name"],'.')+1));
		if(in_array($ext, $izinli_uzantilar)===false){
			echo "Uzantı kabul edilmiyor";
			header("Location:../blog.php?durum=formathatali");
			exit;
		}
		$blog_seourl=seo($_POST['blog_ad']);
		$uploads_dir = '../../img/upload/';

		@$tmp_name = $_FILES['blog_resim']["tmp_name"];

		@$name = $_FILES['blog_resim']["name"];

		$benzersizad=strtotime(date("YmdHis"));

		$refimgyol=substr($uploads_dir, 6)."/".$benzersizad.$name;

		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
	}else{
		$refimgyol = $_POST["old_img_url"];
	}



	$blog_id=$_POST['blog_id'];	
	$blog_seourl=seo($_POST['blog_ad']);

	$ayarkaydet=$db->prepare("UPDATE blog SET
			blog_ad=:blog_ad,		
			blog_url=:blog_url,
			blog_icerik=:blog_icerik,
			blog_resim=:blog_resim
			WHERE blog_id={$_POST['blog_id']}");

		$update=$ayarkaydet->execute(array(
			'blog_ad' => $_POST['blog_ad'],		
			'blog_url' => $blog_seourl,
			'blog_icerik' => $_POST['blog_icerik'],
			'blog_resim'=>$refimgyol				
		));

	$newLog = $db->prepare("INSERT INTO logs SET user_id = :user_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"user_id" => intval($_SESSION["user_id"]),
		"transaction" => "Blog Güncellendi",
		"detail" => $_POST['blog_ad']. " Başlıklı Blog Yazısı Düzenlendi"
	));

	if ($update) {
		Header("Location:../production/blog-duzenle.php?blog_id=$blog_id&durum=ok");
	} else {
		Header("Location:../production/blog-duzenle.php?blog_id=$blog_id&durum=no");
	}
}

if (isset($_POST['paketicerikekle'])) {
	$ayarekle=$db->prepare("INSERT INTO paket_icerikleri SET
		baslik=:baslik,		
		icon=:icon
				
		");
	$insert=$ayarekle->execute(array(
		'baslik' => $_POST['baslik'],
		'icon' => $_POST['icon']
				
	));
	$newLog = $db->prepare("INSERT INTO logs SET user_id = :user_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"user_id" => intval($_SESSION["user_id"]),
		"transaction" => "Paket İçeriği Eklendi",
		"detail" => $_POST['baslik']. " Adlı Paket İçeriği Eklendi"
	));
	if ($insert) {
		Header("Location:../production/paketlerimiz.php?durum=ok");
	} else {
		Header("Location:../production/paketlerimiz.php?durum=no");
	}
}

if ($_GET['paketiceriksil']=="ok") {

	$sil=$db->prepare("DELETE from paket_icerikleri where id=:idd");
	$kontrol=$sil->execute(array(
		'idd' => $_GET['id']
	));

	$newLog = $db->prepare("INSERT INTO logs SET user_id = :user_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"user_id" => intval($_SESSION["user_id"]),
		"transaction" => "Paket içeriği Silindi",
		"detail" => $_GET['id']. " ID Değerindeki Paket İçeriği Silindi"
	));

	if ($kontrol) {
		header("location:../production/paket-icerik.php?sil=ok");
	} else {
		header("location:../production/paket-icerik.php?sil=no");
	}
}

if (isset($_POST['paketicerikduzenle'])) {
	$p_id=$_POST['id'];		
	$ayarkaydet=$db->prepare("UPDATE paket_icerikleri SET
		baslik=:baslik,		
		icon=:icon		
		WHERE id={$_POST['id']}");
	$update=$ayarkaydet->execute(array(
		'baslik' => $_POST['baslik'],		
		'icon' => $_POST['icon']				
	));
	$newLog = $db->prepare("INSERT INTO logs SET user_id = :user_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"user_id" => intval($_SESSION["user_id"]),
		"transaction" => "Paket içeriği Güncellendi",
		"detail" => $_POST['baslik']. " Adlı Paket İçeriği Düzenlendi"
	));
	if ($update) {
		Header("Location:../production/paket-icerik-duzenle.php?id=$p_id&durum=ok");
	} else {
		Header("Location:../production/paket-icerik-duzenle.php?id=$p_id&durum=no");
	}
}

if(isset($_POST['sliderekle'])){
	if(isset($_FILES["slider_resimyol"]) && $_FILES["slider_resimyol"]["size"] > 0){
		$izinli_uzantilar=array('jpg','gif','png','pdf');
		$ext=strtolower(substr($_FILES['slider_resimyol']["name"],strpos($_FILES['slider_resimyol']["name"],'.')+1));
			if(in_array($ext, $izinli_uzantilar)===false){
				echo "Uzantı kabul edilmiyor";
				header("Location:../blog.php?durum=formathatali");
				exit;}
			$uploads_dir = '../../img/upload/';
			@$tmp_name = $_FILES['slider_resimyol']["tmp_name"];
			@$name = $_FILES['slider_resimyol']["name"];
			$benzersizad=strtotime(date("YmdHis"));
			$refimgyol=substr($uploads_dir, 6)."/".$benzersizad.$name;
			@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
		}else{
			$refimgyol = $_POST["old_img_url"];
		}	

		$siraKontrol = $db->prepare("SELECT * FROM slider WHERE slider_sira=?");
		$siraKontrol->execute(array($_POST["slider_sira"]));
		if($siraKontrol->rowCount() > 0){
			echo "Bu Sıra Zaten Kullanılıyor";
		}else{

			$icerikkaydet=$db->prepare("INSERT INTO slider SET
				slider_ad=:slider_ad,
				slider_h=:slider_h,
				slider_p=:slider_p,
				slider_sira=:slider_sira,
				slider_resimyol=:slider_resimyol		
			");		

			$update=$icerikkaydet->execute(array(
				'slider_ad' => $_POST['slider_ad'],
				'slider_h' => $_POST['slider_h'],
				'slider_p' => $_POST['slider_p'],
				'slider_sira' => $_POST['slider_sira'],	
				'slider_resimyol'=>$refimgyol
			));

			$newLog = $db->prepare("INSERT INTO logs SET user_id = :user_id, transaction = :transaction, detail = :detail");
			$logControl = $newLog->execute(array(
				"user_id" => intval($_SESSION["user_id"]),
				"transaction" => "Slider Ekleme",
				"detail" => $_POST['slider_ad']. " Başlğında Yeni Slider Eklendi"
			));
			
			if ($update) {
				header("Location:../production/slider.php?durum=ok");
			} else {
				header("Location:../production/slider.php?durum=no");

			}
		}	

		
		
	}

if ($_GET['slidersil']=="ok") {

	$sil=$db->prepare("DELETE from slider where slider_id=:id");
	$kontrol=$sil->execute(array(
	'id' => $_GET['slider_id']
	));

	$newLog = $db->prepare("INSERT INTO logs SET user_id = :user_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
	"user_id" => intval($_SESSION["user_id"]),
	"transaction" => "slider Silindi",
	"detail" => $_GET['slider_id']. " ID Değerindeki Slider Silindi"
	));
	if ($kontrol) {
	header("location:../production/slider.php?sil=ok");
	} else {
	header("location:../production/slider.php?sil=no");
	}
}


if (isset($_POST['sliderduzenle'])) {
	if(isset($_FILES["slider_resimyol"]) && $_FILES["slider_resimyol"]["size"] > 0){
	$izinli_uzantilar=array('jpg','gif','png','pdf');
	$ext=strtolower(substr($_FILES['slider_resimyol']["name"],strpos($_FILES['slider_resimyol']["name"],'.')+1));
		if(in_array($ext, $izinli_uzantilar)===false){
			echo "Uzantı kabul edilmiyor";
			header("Location:../slider.php?durum=formathatali");
			exit;
			}
	$uploads_dir = '../../img/upload/';
	@$tmp_name = $_FILES['slider_resimyol']["tmp_name"];
	@$name = $_FILES['slider_resimyol']["name"];
	$benzersizad=strtotime(date("YmdHis"));
	$refimgyol=substr($uploads_dir, 6)."/".$benzersizad.$name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
			}else{
				$refimgyol = $_POST["old_img_url"];
		}
			$id=$_POST['slider_id'];	
			$ayarkaydet=$db->prepare("UPDATE slider SET
				slider_ad=:slider_ad,		
				slider_h=:slider_h,
				slider_p=:slider_p,
				slider_sira=:slider_sira,
				slider_resimyol=:slider_resimyol
			WHERE slider_id={$_POST['slider_id']}");
			$update=$ayarkaydet->execute(array(
				'slider_ad' => $_POST['slider_ad'],		
				'slider_h' => $_POST['slider_h'],
				'slider_p' => $_POST['slider_p'],
				'slider_sira' => $_POST['slider_sira'],
				'slider_resimyol'=>$refimgyol				
			));
			$newLog = $db->prepare("INSERT INTO logs SET user_id = :user_id, transaction = :transaction, detail = :detail");
			$logControl = $newLog->execute(array(
				"user_id" => intval($_SESSION["user_id"]),
				"transaction" => "Slider Güncellendi",
				"detail" => $_POST['slider_ad']. " Başlıklı Slider Düzenlendi"
			));

			if ($update) {
				Header("Location:../production/slider-duzenle.php?slider_id=$id&durum=ok");
			} else {
				Header("Location:../production/slider-duzenle.php?slider_id=$id&durum=no");
			}
}

if (isset($_POST['logoduzenle'])) {
	$uploads_dir = '../../dimg';
	@$tmp_name = $_FILES['ayar_logo']["tmp_name"];
	@$name = $_FILES['ayar_logo']["name"];
	$benzersizsayi4=rand(20000,32000);
	$refimgyol=substr($uploads_dir, 6)."/".$benzersizsayi4.$name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4$name");	
	$duzenle=$db->prepare("UPDATE ayar SET
		ayar_logo=:logo
		WHERE ayar_id=0");
	$update=$duzenle->execute(array(
		'logo' => $refimgyol
		));
	if ($update) {
		$resimsilunlink=$_POST['eski_yol'];
		unlink("../../$resimsilunlink");
		Header("Location:../production/site-ayar.php?durum=ok");
	} else {
		Header("Location:../production/site-ayar.php?durum=no");
	}

}

if (isset($_POST['genelayarkaydet'])) {

	$ayarkaydet=$db->prepare("UPDATE ayar SET
		ayar_title=:ayar_title,
		ayar_description=:ayar_description,
		ayar_keywords=:ayar_keywords,
		ayar_author=:ayar_author
		WHERE ayar_id=0");

	$update=$ayarkaydet->execute(array(
		'ayar_title' => $_POST['ayar_title'],
		'ayar_description' => $_POST['ayar_description'],
		'ayar_keywords' => $_POST['ayar_keywords'],
		'ayar_author' => $_POST['ayar_author']
		));


	if ($update) {

		header("Location:../production/site-ayar.php?durum=ok");

	} else {

		header("Location:../production/site-ayar.php?durum=no");
	}
	
}

if (isset($_POST['iletisimayarkaydet'])) {
	
	$ayarkaydet=$db->prepare("UPDATE ayar SET
		ayar_tel=:ayar_tel,
		ayar_gsm=:ayar_gsm,
		ayar_faks=:ayar_faks,
		ayar_mail=:ayar_mail,
		ayar_ilce=:ayar_ilce,
		ayar_il=:ayar_il,
		ayar_adres=:ayar_adres,
		ayar_mesai=:ayar_mesai
		WHERE ayar_id=0");

	$update=$ayarkaydet->execute(array(
		'ayar_tel' => $_POST['ayar_tel'],
		'ayar_gsm' => $_POST['ayar_gsm'],
		'ayar_faks' => $_POST['ayar_faks'],
		'ayar_mail' => $_POST['ayar_mail'],
		'ayar_ilce' => $_POST['ayar_ilce'],
		'ayar_il' => $_POST['ayar_il'],
		'ayar_adres' => $_POST['ayar_adres'],
		'ayar_mesai' => $_POST['ayar_mesai']
		));


	if ($update) {

		header("Location:../production/iletisim-ayarlar.php?durum=ok");

	} else {

		header("Location:../production/iletisim-ayarlar.php?durum=no");
	}
	
}


if (isset($_POST['apiayarkaydet'])) {
	
	//Tablo güncelleme işlemi kodları...
	$ayarkaydet=$db->prepare("UPDATE ayar SET
		
		ayar_analystic=:ayar_analystic,
		ayar_maps=:ayar_maps,
		ayar_zopim=:ayar_zopim
		WHERE ayar_id=0");

	$update=$ayarkaydet->execute(array(

		'ayar_analystic' => $_POST['ayar_analystic'],
		'ayar_maps' => $_POST['ayar_maps'],
		'ayar_zopim' => $_POST['ayar_zopim']
		));


	if ($update) {

		header("Location:../production/api-ayarlar.php?durum=ok");

	} else {

		header("Location:../production/api-ayarlar.php?durum=no");
	}
	
}

if (isset($_POST['mailayarkaydet'])) {
	
	$ayarkaydet=$db->prepare("UPDATE ayar SET
		ayar_smtphost=:smtphost,
		ayar_smtpuser=:smtpuser,
		ayar_smtppassword=:smtppassword,
		ayar_smtpport=:smtpport
		WHERE ayar_id=0");
	$update=$ayarkaydet->execute(array(
		'smtphost' => $_POST['ayar_smtphost'],
		'smtpuser' => $_POST['ayar_smtpuser'],
		'smtppassword' => $_POST['ayar_smtppassword'],
		'smtpport' => $_POST['ayar_smtpport']
		));

	if ($update) {

		Header("Location:../production/mail-ayar.php?durum=ok");

	} else {

		Header("Location:../production/mail-ayar.php?durum=no");
	}

}

if (isset($_POST['sosyalayarkaydet'])) {
	
	$ayarkaydet=$db->prepare("UPDATE ayar SET
		ayar_facebook=:ayar_facebook,
		ayar_twitter=:ayar_twitter,
		ayar_google=:ayar_google,
		ayar_youtube=:ayar_youtube
		WHERE ayar_id=0");
	$update=$ayarkaydet->execute(array(
		'ayar_facebook' => $_POST['ayar_facebook'],
		'ayar_twitter' => $_POST['ayar_twitter'],
		'ayar_google' => $_POST['ayar_google'],
		'ayar_youtube' => $_POST['ayar_youtube']
		));

	if ($update) {

		Header("Location:../production/sosyal-ayar.php?durum=ok");

	} else {

		Header("Location:../production/sosyal-ayar.php?durum=no");
	}

}

if (isset($_POST['paketekle'])) {
	$counter = 0;
	$kaydedilecekString = "";
	foreach ($_POST["paket_icerik"] as $icerik) {
		if($counter != 0){
			$kaydedilecekString .= ",";
		}
		$kaydedilecekString .= '"'.$icerik.'"';
		$counter++;
	}
	$paket_seourl=seo($_POST['paket_ad']);
	$ayarekle=$db->prepare("INSERT INTO paket SET
	paket_ad=:paket_ad,		
	paket_icerik=:paket_icerik,
	paket_url=:paket_url,
	paket_fiyat=:paket_fiyat		
	");

	$insert=$ayarekle->execute(array(
	'paket_ad' => $_POST['paket_ad'],
	'paket_icerik' => $kaydedilecekString,
	'paket_url' => $paket_seourl,
	'paket_fiyat' => $_POST['paket_fiyat']		
	));

	$newLog = $db->prepare("INSERT INTO logs SET user_id = :user_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"user_id" => intval($_SESSION["user_id"]),
		"transaction" => "Paket Eklendi",
		"detail" => $_POST['paket_ad']. " Adlı Paket Eklendi"
	));
	if ($insert) {
		Header("Location:../production/paketlerimiz.php?durum=ok");
	} else {
		Header("Location:../production/paketlerimiz.php?durum=no");
	}
}


?>