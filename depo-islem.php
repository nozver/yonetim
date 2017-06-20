<?php include "header.php" ?>



<div id="sidebar">
	<?php
		include ('sidebar.php');
	?>
</div>
  <div id="content">
  	<div class="contenticerik">
      <form action="" method="POST">
			<table>
				<tr>
					<td style="background:#F39C12; color:#fff; font-size:18px;">Stok Girişi Kasa İşlemleri</td>
				</tr>
			</table>
				 <?php

					$secim = $db->prepare("SELECT * FROM ilac_tablo_listesi");
					$sonuc = $secim -> execute(array());
					$sonuc = $secim->fetchAll();
					$depo_sutun_isimleri = array("depo_para","islem_not");

					if ($sonuc){

						foreach($sonuc as $key => $value) {

							$secim = $db->prepare("SELECT * FROM $value[1] WHERE ilac_id != 1");
							$sonuc = $secim -> execute(array());
							$sonuc = $secim->fetchAll();
							if ($sonuc){

								foreach($sonuc as $k => $v) {
									$isim = str_replace(" ","_",$v["ilac_isim"]);
									array_push($depo_sutun_isimleri,$isim);
									echo "<table id='depotablosu'>
												<tr>
													<td>".$v['ilac_isim']."</td>"."
													<td>
														<input style='width:45px; border-radius:5px; padding:5px' type='text' autocomplete='off' placeholder='Adet' pattern=[0-9]* name='".$isim."' />
													</td>
												</tr>
											</table>";
								}
							}
						}
					}

				 ?>

           <table id="kasaislembuton">
						 <tr>
							 <td colspan = "2"><input type="number" step="0.01" autocomplete="off" placeholder="Para Ekleyebilirsiniz" name="depo_para" /> </td>

						 </tr>
             <tr>
                 <td><input type="text" autocomplete="off" placeholder="Kısa İşlem Notu Ekleyebilirsiniz" name="islem_not" /> </td>

                 <td style="text-align:right">
					<button name="depo_cikar" type="submit">Çıkar</button>
                    <button type="submit" name="depo_ekle">Ekle</button>
                </td>
             </tr>

           </table>
      </form>
    </div>
  </div>
</body>
</html>

<?php

	function alanKontrol($dizi){
		foreach ($dizi as $value) {

			if ($_POST[$value] != 0) {
				return true;
			}
		}
		return false;
	}

?>

<?php




	if (isset($_POST["depo_ekle"])) {

		$dolu_mu = alanKontrol($depo_sutun_isimleri);

			if ($dolu_mu) {

				$secim = $db->prepare("INSERT INTO depo_listesi SET siparis_id = ?");
				$sonuc = $secim -> execute(array(0));
				$islem_id = $db -> lastInsertId();

				if ($sonuc){

					foreach($depo_sutun_isimleri as $value) {

						$secim_1 = $db->prepare("UPDATE depo_listesi SET $value = ? WHERE islem_id = ?");
						$sonuc_1 = $secim_1 -> execute(array($_POST[$value],$islem_id));

					}
					if (isset($sonuc_1)){
						echo "<script>alert(\"depo ekleme işlemi başarılı\")</script>";
					}else {
						echo "<script>alert(\"depo ekleme işlemi başarısız\")</script>";
					}
				}
			}else {
				echo "<script>alert(\"hiçbir girdi yapmadınız\")</script>";
			}
		}



?>

<?php

	if (isset($_POST["depo_cikar"])) {

		$dolu_mu = alanKontrol($depo_sutun_isimleri);

			if ($dolu_mu) {

				$secim = $db->prepare("INSERT INTO depo_listesi SET siparis_id = ?");
				$sonuc = $secim -> execute(array(0));
				$islem_id = $db -> lastInsertId();

				if ($sonuc){

					foreach($depo_sutun_isimleri as $value) {

						$secim_1 = $db->prepare("UPDATE depo_listesi SET $value = ? WHERE islem_id = ?");
						$sonuc_1 = $secim_1 -> execute(array("-".$_POST[$value],$islem_id));

					}
					if (isset($sonuc_1)){
						echo "<script>alert(\"depo çıkarma işlemi başarılı\")</script>";
					}else {
						echo "<script>alert(\"depo çıkarma işlemi başarısız\")</script>";
					}
				}
			}else {
				echo "<script>alert(\"hiçbir girdi yapmadınız\")</script>";
			}
		}



?>
<!--nozver&&gereksizadam-->
