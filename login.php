
﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="tr">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="style.css" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Merriweather:900" rel="stylesheet">
	<title>Yönetim Paneli Giriş</title>

	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/ui.js"></script>
	<script type="text/javascript" src="js/setting.js"></script>
</head>
<body>
	<div id="header-left">
		<a href="#"><img src="menu.png" /></a>
	</div>
	<div id="header-right">
		<span>Meloxcin</span>
		<a href="log-out.php"><img src="exit.png" /></a>
	</div>

	<div id="sidebar">
		<div class="avatar">
			<img src="avatar.png" /><br />
			<span>
				Hoş Geldiniz <br />
				Sn. <font style="color:#F39C12"><?php echo "Misafir"; ?></font>
			</span>
		</div>
		<div id="nav">
			<ul>
				<li><a href="#">Kullanıcı Girişi</a></li>
			</ul>
			<span>Designed By <a href="#">Nizamettin Özver</a></span>
		</div>
	</div>
	<div id="content">
		<div class="contenticerik">
			<div class="logincontainer">
				<h2>Yönetici Girişi</h2>
				<form action="kontrol.php" method="POST">
					<input type="text" name="k_adi" autofocus="on" autocomplete="off" required placeholder="Kullanıcı Adınızı Giriniz" />
					<input type="password" name="k_sifre" autofocus="on" autocomplete="off" required placeholder="Kullanıcı Şifrenizi Giriniz" />
					<button  style="margin-top:25px"type="submit" name="giris" >Giriş</button>
					<button type="reset" name="temizle">Temizle</button>


				</form>

			</div>
			<div class="a" style="color:red; margin:10px auto; width:300px; font-weight:bold; position:relative; top:-100px; text-align:center"><?php
				if(@$_GET["login"] == "no"){
					echo "kullanıcı adı veya şifre yanlış";
				}
			 ?></div>
		</div>
	</div>

</body>
</html>
<!--nozver&&gereksizadam-->
