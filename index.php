<?php include "header.php"; ?>

<div id="sidebar">
	<?php
		include ('sidebar.php');
	?>
</div>
<div id="content">
	<div class="contenticerik">





		<?php

		/*---------- musteri id ulasma ----------*/
		if (isset($_POST["musteri_id_ulas"])) {

			$musteri_ad = strtolower_utf8(trim($_POST["musteri_ad"]));
			$musteri_soyad = strtolower_utf8(trim($_POST["musteri_soyad"]));
			$secim = $db->prepare("SELECT * FROM musteriler where musteri_ad=? and musteri_soyad=?");
			$secim -> execute(array($musteri_ad,$musteri_soyad));
			$sonuc = $secim->fetchAll();
			if ($sonuc){
				foreach($sonuc as $k=>$v) {
							$ulasilan_id = $v["musteri_id"];
				}
			}else {
				echo "<script>alert(\"böyle bir müşteri kayıtlı değil\")</script>";
			}
		}
		 ?>
		<form action="" method="POST">
			<table>

				<tr>
					<td style="background:#F39C12; color:#fff; font-size:18px;" colspan="3">Müşteri İD Sorgu</td>
				</tr>
				<tr>
					<td><input type="text" name="musteri_ad" autofocus="on" autocomplete="off" required placeholder="Müşteri İsmini Giriniz" /></td>
				</tr>
				<tr>
					<td><input type="text" name="musteri_soyad" autofocus="on" autocomplete="off" required placeholder="Müşteri Soyismini Giriniz" /></td>
				</tr>
				<tr>
					<td><span>Müşteri İD : <?php echo @$ulasilan_id; ?></span></td>

				</tr>

				<tr>
					<td><span>Müşteri Kalan Borç :</span></td>

				</tr>
				<tr>
					<td style="text-align:right"><button type="submit" name="musteri_id_ulas" >İD Bul </button></td>
				</tr>
			</table>
		</form>

	</div>

</div>

</body>
</html>
<!--nozver&&gereksizadam-->
