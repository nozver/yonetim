<?php include "header.php"; ?>

<?php error_reporting(0);?> <!-- bu satir ile alinan hatalarin sayfaya bastirilmasi engelleniyor guvenlik amaclidir-->


<!-- ******************************** sidebar cagriliyor ****************************************** -->
<div id="sidebar">
  <?php
    include ('sidebar.php');
  ?>
</div>
<!-- ********************************************************************************************** -->


<div id="content">

  <div class="contenticerik">

    <?php

     /*----------------- id kullanilarak musteri bilgileri getiriliyor--------------------------*/

    if (isset($_POST["musteri_id_ile_duzenleme"])) {

    	$musteri_id_duzenleme = $_POST["musteri_id_duzenleme"];
    	$secim = $db->prepare("SELECT * FROM musteriler where musteri_id=?");
    	$secim -> execute(array($musteri_id_duzenleme));
    	$sonuc = $secim->fetchAll();

      if (count($sonuc) != 0){
    		foreach($sonuc as $k=>$v) {

    					$musteri_id = $v["musteri_id"];
    					$musteri_adi = $v["musteri_ad"];
    					$musteri_soyadi = $v["musteri_soyad"];
    					$musteri_adres = $v["musteri_adres"];
    					$musteri_tel = $v["musteri_tel"];
    					$musteri_not = $v["musteri_not"];

    		}
    	}else {
    		echo "<script> alert(\"böyle bir id bulunamadı\"); window.location = \"bilgi-duzenleme.php\"</script>";
    	}
    }

    ?>

    <?php
     /*----------------- id kullanilarak siparis bilgileri getiriliyor--------------------------*/
    if (isset($_POST["siparis_id_ile_duzenleme"])) {

    	$siparis_id_duzenleme = $_POST["siparis_id_duzenleme"];
    	$secim = $db->prepare("SELECT * FROM siparisler where siparis_id=?");
    	$secim -> execute(array($siparis_id_duzenleme));
    	$sonuc = $secim->fetchAll(PDO::FETCH_ASSOC);

    /* ------------------------------------------------------------------------------------------------
    html satirlarina gerekli verileri yazdirabilmek icin anahtar deger seklinde bir liste olusturuluyor
    bu listenin icerigi su tarzdir ornegin getirilen_liste["siparis_id"] = 5
    ----------------------------------------------------------------------------------------------------*/
      $getirilen_liste = array();
    	if (count($sonuc) != 0){
    		foreach ($sonuc as $k => $v) {
          foreach (array_keys($v) as $key => $value) {
            array_push($getirilen_liste,$getirilen_liste[$value] = $v[$value]);
          }
    		}
    	}else {
    		echo "<script> alert(\"böyle bir id bulunamadı\"); window.location = \"bilgi-duzenleme.php\"</script>";
    	}
    }

    ?>

    <?php
    /*----------------- musteri bilgileri duzenlendikten sonra kaydediliyor--------------------------*/

    if (isset($_POST["musteri_kaydet_duzenle"])){


      $benzer_icerik_duzenleme = false;
    	$musteri_id_duzenleme = $_POST["musteri_id_duzenleme_sonuc"];
      $musteri_ad_duzenleme = strtolower_utf8($_POST["musteri_ad_duzenleme"]);
      $musteri_soyad_duzenleme = strtolower_utf8($_POST["musteri_soyad_duzenleme"]);
      $musteri_tel_duzenleme = $_POST["musteri_tel_duzenleme"];
      $musteri_adres_duzenleme = $_POST["musteri_adres_duzenleme"];
      $musteri_not_duzenleme = $_POST["musteri_not_duzenleme"];

    	$secim = $db->prepare("SELECT * FROM musteriler WHERE musteri_id = ?");
      $inceleme = $db->prepare("SELECT * FROM musteriler WHERE musteri_id != ?");
    	$secim -> execute(array($musteri_id_duzenleme));
      $inceleme -> execute(array($musteri_id_duzenleme));
    	$sonuc = $secim->fetchAll();
      $inceleme_sonuc = $inceleme->fetchAll();
      foreach ($inceleme_sonuc as $key => $value) {

         if(($value["musteri_ad"] == $musteri_ad_duzenleme && $value["musteri_soyad"] == $musteri_soyad_duzenleme) ){
           echo "<script> alert(\" aynı kullanıcı ismi ile birden fazla kayıt yapılamaz\")</script>";
           $benzer_icerik_duzenleme = true;
           echo "<script> window.location = \"bilgi-duzenleme.php\"</script>";
         }
      }

    	if (count($sonuc) != 0 && !$benzer_icerik_duzenleme){

      $query = $db->prepare("UPDATE musteriler SET
      musteri_ad = ?,
      musteri_soyad = ?,
      musteri_tel = ?,
      musteri_adres = ?,
      musteri_not = ?
      WHERE musteri_id = ?");


      $update = $query->execute(array(
    		$musteri_ad_duzenleme,
    	  $musteri_soyad_duzenleme,
    	  $musteri_tel_duzenleme,
    	  $musteri_adres_duzenleme,
    	  $musteri_not_duzenleme,
    		$musteri_id_duzenleme

      ));

      if ( $update ){
         echo "<script> alert(\"düzenleme başarılı bir şekilde yapıldı\");</script>";
      }
    }else {
    	echo "<script> alert(\"böyle bir id bulunamadı\"); window.location = \"bilgi-duzenleme.php\"</script>";
    }
    }
    ?>



    <script type="text/javascript">

    	/*-----------------arti ve eksi butonlarinin yonlendigi fonksiyon------------------------*/
    	function uyari(){
    		alert("Bu işlemi sipariş girişi bölümünden yapabilirsiniz");
    	}

    </script>

    <form action="" method="POST">
    	<table id="buyuktablo">
    		<tr>
    			<td style="background:#F39C12; color:#fff; font-size:18px;" colspan="3">Düzenlenecek Müşteri İd Giriniz</td>
    		</tr>
    		<tr>
          <td><input type="text" name="musteri_id_duzenleme" autocomplete="off" pattern=[0-9]* placeholder="Müşteri İD Girebilirsiniz" /></td>
          <td><button type="submit" name="musteri_id_ile_duzenleme" >Bilgileri Getir</button></td>
          <td style="display:none"><input type="text" name="musteri_id_duzenleme_sonuc" pattern=[0-9]* placeholder="Müşteri İD Girebilirsiniz" readonly value="<?php echo @$musteri_id ?>"/></td>
    		</tr>

    		<tr>
    			<td style="background:#F39C12; color:#fff; font-size:18px;" colspan="3">Müşteri Bilgileri</td>
    		</tr>
    		<tr>
    			<td><input type="text" name="musteri_ad_duzenleme" autofocus="on" autocomplete="off"  placeholder="Müşteri İsmini Giriniz" value="<?php echo @$musteri_adi ?>" /></td>
    			<td><input type="text" name="musteri_soyad_duzenleme" autofocus="on" autocomplete="off"  placeholder="Müşteri Soyismini Giriniz" value="<?php echo @$musteri_soyadi ?>" /></td>
    			<td><input type="text" name="musteri_tel_duzenleme" autofocus="on" autocomplete="off"  placeholder="Müşteri Telefon Giriniz" value="<?php echo @$musteri_tel ?>"/></td>
    		</tr>
    		<tr>
    			<td colspan="3"><textarea name="musteri_adres_duzenleme" placeholder="Müşteri Adresi Giriniz" ><?php echo @$musteri_adres ?></textarea>
    			<textarea name="musteri_not_duzenleme" placeholder="Müşteri Notu Girebilirsiniz " ><?php echo @$musteri_not ?></textarea></td>

    		</tr>

    		<tr>
    			<td></td>
    			<td></td>
    			<td style="text-align:right"><button type="submit" name="musteri_kaydet_duzenle" > Kaydet </button></td>
    		</tr>
    	</table>
    </form>

    <form action="" method="POST" >
    	<table id="kucuktablo">
    		<tr>
    			<td style="background:#F39C12; color:#fff; font-size:18px;" colspan="3">Düzenlenecek Müşteri İd Giriniz</td>
    		</tr>
    		<tr>
    			<td><input type="text" name="musteri_id_duzenleme" autocomplete="off"  pattern=[0-9]* placeholder="Müşteri İD Girebilirsiniz" value="<?php echo @$musteri_id ?>"/></td>
    			<td><button type="submit" name="musteri_id_ile_duzenleme" >Bilgileri Getir</button></td>
    			<td style="display:none"><input type="text" name="musteri_id_duzenleme_sonuc" pattern=[0-9]* placeholder="Müşteri İD Girebilirsiniz" readonly value="<?php echo @$musteri_id ?>"/></td>
    		</tr>

    		<tr>
    			<td style="background:#F39C12; color:#fff; font-size:18px;" colspan="3">Müşteri Bilgileri</td>
    		</tr>
    		<tr>
    			<td colspan="3"><input type="text" name="musteri_ad_duzenleme" autofocus="on" autocomplete="off"  placeholder="Müşteri İsmini Giriniz" value = "<?php echo @$musteri_adi ?>"/></td>
    		</tr>
    		<tr>
    			<td colspan="3"><input type="text" name="musteri_soyad_duzenleme" autofocus="on" autocomplete="off"  placeholder="Müşteri Soyismini Giriniz" value="<?php echo @$musteri_soyadi ?>"/></td>
    		</tr>
    		<tr>
    			<td colspan="3"><input type="text" name="musteri_tel_duzenleme" autofocus="on" autocomplete="off"  placeholder="Müşteri Telefon Giriniz" value = "<?php echo @$musteri_tel ?>"/></td>
    		</tr>
    		<tr>
    			<td colspan="3"><textarea name="musteri_adres_duzenleme" placeholder="Müşteri Adresi Giriniz" ><?php echo @$musteri_adres ?></textarea></td>
    		</tr>
    		<tr>
    			<td colspan="3"><textarea name="musteri_not_duzenleme" placeholder="Müşteri Notu Girebilirsiniz " ><?php echo @$musteri_not ?></textarea></td>
    		</tr>
    		<tr>

    		</tr>

    		<tr>
    			<td style="text-align:right"><button type="submit" name="musteri_kaydet_duzenle" > Kaydet </button></td>
    		</tr>
    	</table>
    </form>




    <form action="" method="POST">
    	<table style="text-align:center"	>

    		<tr>
    			<td colspan="5" style="background:#F39C12; color:#FFF; text-align:left;">Düzenlenecek Siparis İd Giriniz</td>
    		</tr>
    		<tr>
    			<td><input type="text" name="siparis_id_duzenleme" autocomplete="off" pattern=[0-9]* placeholder="Sipariş İD Girebilirsiniz" /></td>
    			<td><button type="submit" name="siparis_id_ile_duzenleme" >Bilgileri Getir</button></td>
    			<td><input style="display:none" type="text" name="siparis_id_duzenleme_sonuc" pattern=[0-9]* placeholder="Sipariş İD Girebilirsiniz" readonly value="<?php echo $_POST["siparis_id_duzenleme"] ?>"/></td>
    		</tr>
    		<tr>
    			<td colspan="5" style="background:#F39C12; color:#FFF; text-align:left;">Sipraiş Girişi</td>
    		</tr>
        <?php

					$secim = $db->prepare("SELECT * FROM ilac_tablo_listesi");
					$sonuc = $secim -> execute(array());
					$sonuc = $secim->fetchAll();
          $siparisler_sutun_isimleri = array("musteri_id","siparis_tutari","odenen_tutar","kargo_durumu","kargo_ucreti");
					if ($sonuc){

						foreach($sonuc as $key => $value) {

              array_push($siparisler_sutun_isimleri,$value[1]);
              array_push($siparisler_sutun_isimleri,$value[1]."_adet");

              echo '<tr>
                <td style="width:200px"><select name="'.$value[1].'">';

											$secim = $db->prepare("SELECT * FROM $value[1]");
											$sonuc = $secim -> execute(array());
											$sonuc = $secim->fetchAll();
											if ($sonuc){

												foreach($sonuc as $k => $v) {

                          if ($getirilen_liste[$value[1]] == $v[1]) {
                            echo "<option selected>".$v[1]."</<option>";
                          }else{
															echo "<option>".$v[1]."</<option>";
                            }
                        }
											}
                      echo '</select></td>
  										<td style="width:30px"><label style="font-size:17px; font-family:arial">X</label></td>
  										<td style="width:30px"><input style="width:22px" type="text" title="Sipariş Adedi Sadece Sayılardan Oluşabilir Boşluk İçeremez" pattern=[0-9]* name="'.$value[1].'_adet" placeholder="" value ="'.$getirilen_liste[$value[1]."_adet"].'"  /></td>

									</tr>';
						}
					}

				 ?>

    		<tr>
    			<td colspan="5" style="background:#F39C12; color:#FFF; text-align:left;">Sipariş Durum ve Ödeme Bilgileri</td>
    		</tr>
    		<tr>
    			<td><input type="number" name="siparis_tutari" step=0.1; placeholder="Sipariş Tutarı" value="<?php echo $getirilen_liste["siparis_tutari"]; ?>"/></td>
    			<td colspan="4"><input type="number" name="odenen_tutar" step=0.1; placeholder="Ödenen Tutar" value="<?php echo $getirilen_liste["odenen_tutar"]; ?>"/></td>
    		</tr>
    		<tr>
    			<td><select name="kargo_durumu"><?php if ($getirilen_liste["kargo_durumu"] == "Kargolanmadı") {
    				echo "<option selected>Kargolanmadı</option><option>Kargolandı</option";
    			} else {
    				echo "<option>Kargolanmadı</option><option selected>Kargolandı</option>";
    			}
    			?></select></td>
    			<td colspan="4"><input type="number" name="kargo_ucreti" step=0.1; placeholder="Kargo Ücreti" value="<?php echo $getirilen_liste["kargo_ucreti"]; ?>"/></td>
    		</tr>
    		<tr>
    			<td><input type="text" name="musteri_id" pattern=[0-9]* placeholder="Müşteri İD Giriniz" value="<?php echo $getirilen_liste["musteri_id"]; ?>"/></td>
    			<td colspan="4"><button type="submit" name="siparis_girisi_duzenleme" >Kaydet</button></td>
    		</tr>
    	</table>
    </form>

  </div>

</div>

</body>
</html>


<?php

/*----------------- siparis bilgileri duzenlendikten sonra kaydediliyor--------------------------*/

if (isset($_POST["siparis_girisi_duzenleme"])){

  $secim_kontrol = $db->prepare("SELECT * FROM musteriler where musteri_id=?");
  $secim_kontrol -> execute(array($_POST["musteri_id"]));
  $sonuc_kontrol = $secim_kontrol->fetchAll();

  if (count($sonuc_kontrol) != 0) {

    $secim_borc = $db->prepare("UPDATE siparisler SET kalan_borc = ? WHERE siparis_id = ?");
    $secim_borc -> execute(array($_POST["siparis_tutari"] - $_POST["odenen_tutar"] ,$_POST["siparis_id_duzenleme_sonuc"]));

    $depo_para_duzelt = $db->prepare("UPDATE depo_listesi SET depo_para = ? WHERE siparis_id = ?");
    $depo_para_duzelt -> execute(array($_POST["odenen_tutar"],$_POST["siparis_id_duzenleme_sonuc"]));

    foreach ($siparisler_sutun_isimleri as $value) {

      $secim_1 = $db->prepare("UPDATE siparisler SET $value = ? WHERE siparis_id = ?");
      $ekleme_1 = $secim_1->execute(array($_POST[$value],$_POST["siparis_id_duzenleme_sonuc"]));

      if ( $ekleme_1 ){?>
        <script type="text/javascript">
          alert("düzenleme başarılı bir şekilde yapılmıştır");
          window.location="bilgi-duzenleme.php";
        </script>
    <?php
    }
    }
    }else {
      echo "<script> alert(\"böyle bir müşteri id bulunamadı\"); window.location = \"bilgi-duzenleme.php\"</script>";
    }
    }

?>

<!--nozver&&gereksizadam-->
