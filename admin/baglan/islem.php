<?php 

ob_start();

session_start();

include'baglan.php';

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

if (isset($_POST['menukaydet'])) {
	$ayarekle=$db->prepare("INSERT INTO menu SET
		menu_ad=:menu_ad,		
		menu_url=:menu_url,
		menu_sira=:menu_sira		
		");
	$insert=$ayarekle->execute(array(
		'menu_ad' => $_POST['menu_ad'],
		'menu_url' => $_POST['menu_url'],
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
	$ayarkaydet=$db->prepare("UPDATE menu SET
		menu_ad=:menu_ad,		
		menu_url=:menu_url,
		menu_sira=:menu_sira
		WHERE menu_id={$_POST['menu_id']}");
	$update=$ayarkaydet->execute(array(
		'menu_ad' => $_POST['menu_ad'],		
		'menu_url' => $_POST['menu_url'],
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
		'blog_url' => $_POST['blog_url'],
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

	$ayarkaydet=$db->prepare("UPDATE blog SET
			blog_ad=:blog_ad,		
			blog_url=:blog_url,
			blog_icerik=:blog_icerik,
			blog_resim=:blog_resim
			WHERE blog_id={$_POST['blog_id']}");

		$update=$ayarkaydet->execute(array(
			'blog_ad' => $_POST['blog_ad'],		
			'blog_url' => $_POST['blog_url'],
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


?>