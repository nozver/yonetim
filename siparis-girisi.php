<?php include "header.php" ?>



<div id="sidebar">
	<?php
		include ('sidebar.php');
	?>
</div>
<div id="content">
	<div class="contenticerik">
		<?php

			/*--------------------ilac ekleme ve cikarma---------------------------*/

			$gelen_veri = strtolower_utf8(@$_GET["veri-eklenen"]);
			$gelen_tablo_adi = strtolower_utf8(@$_GET["tablo-adi"]);
			$eksilen_veri = strtolower_utf8(@$_GET["veri-eksilen"]);
			$sutun_adi = str_replace(" ","_",$gelen_veri);


		if((@$_GET["veri-eklenen"] != "" && @$_GET["veri-eklenen"] != "null") && (@$_GET["tablo-adi"] != "" && @$_GET["tablo-adi"] != "null")  ){
			if (!ozelKarakterKontrol($sutun_adi)) {
				$secim = $db->prepare("INSERT INTO $gelen_tablo_adi SET ilac_isim = ?");
				$ekleme = $secim->execute(array($gelen_veri));
				if ($ekleme ){

				/*tabloya sutun ekleme islemleri*/


				$sutun_ekle_depo = $db -> exec("ALTER TABLE depo_listesi ADD $sutun_adi INT(11) NOT NULL");

				$last_id = $db->lastInsertId();
				echo "<script> alert(\"ilac ekleme başarılı\") </script>";
				echo "<script type=\"text/javascript\">
							window.location = \"siparis-girisi.php\"
							</script>";

		}
		}else {
			echo "<script> alert(\"ilaç ekleme başarısız. ilaç isminde harf, sayı ve boşluk dışında karakter kullanılamaz\") </script>";
		}
	}
		?>

		<?php
		if((@$_GET["veri-eksilen"] != "" && @$_GET["veri-eksilen"] != "null") && (@$_GET["tablo-adi"] != "" && @$_GET["tablo-adi"] != "null")) {

			$query = $db->prepare("DELETE FROM $gelen_tablo_adi WHERE ilac_isim = ?");
			$del = $query->execute(array($eksilen_veri));
			if($del){
				echo "<script> alert(\"ilac silme başarılı\") </script>";?>
				<script type="text/javascript">
					window.location = "siparis-girisi.php"
				</script>

		<?php
		}
		}
		?>

		<?php

			/*-------------------- ilac_tablo_listesi adlı tabloya ilac tablosu ekleniyor ---------------------------*/

			$gelen_tablo_adi = strtolower_utf8(@$_GET["eklenen-tablo"]);
			$gelen_tablo_adi_ilk_secenek = $gelen_tablo_adi." seçiniz...";
			$gelen_tablo_adi = str_replace(" ","_",$gelen_tablo_adi);
			$sutun_adi_isim = $gelen_tablo_adi;
			$sutun_adi_adet = $sutun_adi_isim."_adet";

			$ozel_karakter_varmi = ozelKarakterKontrol($gelen_tablo_adi);

		if(@$_GET["eklenen-tablo"] != "" && @$_GET["eklenen-tablo"] != "null" ){

			if (!$ozel_karakter_varmi) {
				$giris_kontrol = $db->prepare("SELECT * FROM ilac_tablo_listesi where tablo_ad=?");
		    $giris_kontrol -> execute(array($gelen_tablo_adi));
		    $sonuc_kontrol = $giris_kontrol->fetchAll();

				if (count($sonuc_kontrol) == 0) {

				$secim = $db->prepare("INSERT INTO ilac_tablo_listesi SET tablo_ad = ?");
				$ekleme = $secim->execute(array($gelen_tablo_adi));

				if ($ekleme){

				$db -> exec( "CREATE TABLE $gelen_tablo_adi
					(
					   ilac_id INT(11) unsigned not null auto_increment primary key,
					   ilac_isim VARCHAR(55)
					)");

					$sutun_ekle_siparis_isim = $db -> exec("ALTER TABLE siparisler ADD $sutun_adi_isim VARCHAR(55) NOT NULL");
					$sutun_ekle_siparis_adet = $db -> exec("ALTER TABLE siparisler ADD $sutun_adi_adet INT(11) NOT NULL");

					$ilk_satir_secim = $db->prepare("INSERT INTO $gelen_tablo_adi SET ilac_isim=?");
					$ilk_satir_secim -> execute(array($gelen_tablo_adi_ilk_secenek));

					$last_id = $db->lastInsertId();
					echo "<script> alert(\"yeni ilaç satırı eklendi\") </script>";?>
					<script type="text/javascript">
						window.location = "siparis-girisi.php";
					</script>
				<?php
			}
			}else{
				echo "<script> alert(\"böyle bir ilaç zaten bulunmakta\"); window.location = \"siparis-girisi.php\"</script>";
			}
		}else {
			echo "<script> alert(\"tablo ekleme başarısız. tablo isminde harf, sayı ve boşluk dışında karakter kullanılamaz\") </script>";
		}

	}
		?>

		<?php

			/*-------------------- ilac_tablo_listesi adlı tablodan ilac tablosu siliniyor ---------------------------*/

			$gelen_tablo_adi = strtolower_utf8(@$_GET["silinen-tablo"]);
			$gelen_tablo_adi = str_replace(" ","_",$gelen_tablo_adi);

		if(@$_GET["silinen-tablo"] != "" && @$_GET["eklenen-tablo"] != "null" ){

			$query = $db->prepare("DELETE FROM ilac_tablo_listesi WHERE tablo_ad = ?");
			$del = $query->execute(array($gelen_tablo_adi));
			if($del){
				$db -> exec("DROP TABLE $gelen_tablo_adi");
				$db -> exec("ALTER TABLE siparisler DROP COLUMN $gelen_tablo_adi");
				$db -> exec("ALTER TABLE siparisler DROP COLUMN ".$gelen_tablo_adi."_adet");


				echo "<script> alert(\"ilac satırı silme başarılı\") </script>";?>
				<script type="text/javascript">
					window.location = "siparis-girisi.php"
				</script>

		<?php
		}
		}
		?>


		<script type="text/javascript">

			/*--------------- ilac satiri ekleme fonksiyonlari-------------------------*/
			function ilacSatiriEkle(){
				var eklenen_tablo = window.prompt("veri tabanı için bir tablo adı giriniz boşluk ve türkçe karakter içermemeli");
				window.location = "siparis-girisi.php?eklenen-tablo=" + eklenen_tablo;

			}

			function ilacSatiriSil(){
				var silinen_tablo = window.prompt("veri tabanı için bir tablo adı giriniz boşluk ve türkçe karakter içermemeli");
				window.location = "siparis-girisi.php?silinen-tablo=" + silinen_tablo;

			}

			/*--------------- ilac ekleme fonksiyonlari-------------------------*/

			function ilacEkle(tablo_adi){

				var eklenen_ilac = window.prompt("eklemek istediğiniz ilacın tam adını giriniz");
				window.location = "siparis-girisi.php?veri-eklenen=" + eklenen_ilac +"&tablo-adi=" + tablo_adi;

			}

		/*--------------- ilac silme fonksiyonlari-------------------------*/

			function ilacCikar(tablo_adi){

				var eksilen_ilac = window.prompt("silmek istediğiniz ilacın tam adını giriniz");
				window.location = "siparis-girisi.php?veri-eksilen=" + eksilen_ilac +"&tablo-adi=" + tablo_adi;

			}

		</script>


		<form action="islem.php" method="POST">
			<table style="text-align:center">

				<tr>
					<td colspan="5" style="background:#F39C12; color:#FFF; text-align:left;">Sipraiş Girişi</td>
				</tr>
				<?php

					$secim = $db->prepare("SELECT * FROM ilac_tablo_listesi");
					$sonuc = $secim -> execute(array());
					$sonuc = $secim->fetchAll();
					$siparisler_sutun_isimleri = array("musteri_id","siparis_tutari","odenen_tutar","kargo_durumu","kargo_ucreti","kalan_borc");
					$siparis_sutun_ilac = array();

					if ($sonuc){

						foreach($sonuc as $key => $value) {

									array_push($siparisler_sutun_isimleri,$value[1]);
									array_push($siparis_sutun_ilac,$value[1]);
									array_push($siparisler_sutun_isimleri,$value[1]."_adet");
									echo '<tr>
										<td style="width:200px"><select name="'.$value[1].'">';

											$secim = $db->prepare("SELECT * FROM $value[1]");
											$sonuc = $secim -> execute(array());
											$sonuc = $secim->fetchAll();
											if ($sonuc){

												foreach($sonuc as $k => $v) {
															echo "<option>".$v[1]."</<option>";
												}
											}
									 	echo '</select></td>
										<td style="width:30px"><label style="font-size:17px; font-family:arial">X</label></td>
										<td style="width:30px"><input style="width:22px" type="text" title="Sipariş Adedi Sadece Sayılardan Oluşabilir Boşluk İçeremez" pattern=[0-9]* name="'.$value[1].'_adet" placeholder=""  /></td>
										<ul><li><td style="width:30px"><input style="width:30px" type="button" onclick = "ilacEkle(this.id)" value="+" id="'.$value[1].'" /></li></ul></td>
										<td style="width:30px"><input style="width:30px" type="button" onclick = "ilacCikar(this.id)" value="-" id="'.$value[1].'" /></td>

									</tr>';
						}
					}

				 ?>

				<tr>
					<td colspan="5" style="background:#F39C12; color:#FFF; text-align:left;">Sipariş Durum ve Ödeme Bilgileri</td>
				</tr>
				<tr>
					<td><input type="number" name="siparis_tutari" step="0.01"; placeholder="Sipariş Tutarı" /></td>
					<td colspan="4"><input type="number" name="odenen_tutar" step="0.01"; placeholder="Ödenen Tutar" /></td>
				</tr>
				<tr>
					<td><select name = "kargo_durumu"><option>Kargolanmadı</option><option>Kargolandı</option></select></td>
					<td colspan="4"><input type="number" name="kargo_ucreti" step=0.1; placeholder="Kargo Ücreti" /></td>
				</tr>
				<tr>
					<td><input type="text" name="musteri_id" title="İd Sadece Sayılardan Oluşabilir Boşluk İçeremez"  pattern=[0-9]* required placeholder="Müşteri İD Giriniz" /></td>
					<td colspan="4"></td>
				</tr>

				<tr>
					<td style="padding-top:90px; text-align:left" colspan="1">
						<input style="width:40px"  type="button" onclick="ilacSatiriSil()" name="ilac_satiri_silme"  value="sil"/>
						<input style="width:40px" type="button" onclick="ilacSatiriEkle()" name="ilac_satiri_ekleme" value="Ekle" />
				</td>

				<td style="padding-top:90px; text-align:right" colspan="4">
					<textarea style="display:none" name="siparis_sutunlari" value=""><?php  echo serialize($siparisler_sutun_isimleri); ;?></textarea>
					<textarea style="display:none" name="siparis_sutun_ilac" value=""><?php  echo serialize($siparis_sutun_ilac); ;?></textarea>
					<button type="submit" name="siparis_kayit" >Kaydet</button>
				</td>

				</tr>
			</table>

		</form>

	</div>

</div>

</body>
</html>
<!--nozver&&gereksizadam-->
