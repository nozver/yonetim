<?php include ('header.php'); ?>
<style>
#listele{width: 96%; margin: 0px auto; margin-top: 60px;}
.listele{width: 100%; overflow: auto; height:520px; text-align: center; padding:20px 0px; }
.listele table {width:auto; border:3px solid #666;  margin: 0 auto; margin-bottom: 20px;}
.listele table tr{height: 40px; width: auto;}
.listele table tr td{padding: 3px 7px;}

</style>
<?php

    $tarih_dogru = false;
    if (isset($_POST["tarihe-gore-listele-buton"])){

      $tarih_1 = $_POST['tarih-ilk'];
      $tarih_2 = $_POST['tarih-bitis'];
      if ($tarih_1 < $tarih_2) {
        $tarih_dogru = true;
      }else {
            echo "<script> alert ('başlangıç tarihi bitiş tarihinden sonra olamaz');  window.location='bilgi-listeleme.php';</script>";
      }

}

 ?>

 <?php

  /*---------------------siparisler tablosundaki sutun isimlerine ilac_tablo_listesi tablosundan ulasiliyor ---------------------------*/

   $siparisler_sutun_isimleri = array("siparis_id","siparis_tarihi","musteri_id","siparis_tutari","odenen_tutar","kargo_durumu","kargo_ucreti","kalan_borc");
   $sutun_secim = $db->prepare("SELECT tablo_ad FROM ilac_tablo_listesi");
   $sutun_secim -> execute();
   $sutun_secim_sonuc = $sutun_secim -> fetchAll();
   foreach ($sutun_secim_sonuc as $key => $value) {
     array_push($siparisler_sutun_isimleri,$value[0]);
     array_push($siparisler_sutun_isimleri,$value[0]."_adet");
   }

 ?>


<div id="sidebar" style="display:none">
  <?php
    include ('sidebar.php');
  ?>
</div>
  <div id="listele">
      <div class="listele">
        <table>

            <?php
            if (isset($_POST["tarihe-gore-listele-buton"]) && $tarih_dogru){
            ?>

            <tr style="background:#ccc">
              <td></td>
              <?php
                foreach ($siparisler_sutun_isimleri as $value) {
                  $value = str_replace("_"," ", $value);
                  echo "<td>".$value."</td>";
                }
               ?>
            </tr>

            <?php

              $dogru_tarih_1 = $_POST['tarih-ilk'];
              $dogru_tarih_2 = $_POST['tarih-bitis'];

              $tarih_secim = $db->prepare("SELECT * FROM siparisler WHERE siparis_tarihi >= ? and siparis_tarihi <= ? ");
              $tarih_secim->execute(array($dogru_tarih_1,$dogru_tarih_2));
              $tarih_secim_sonuc = $tarih_secim -> fetchAll();
              $satir_rengi = false;
              $satir_no = 1;
              foreach (array_reverse($tarih_secim_sonuc) as $key => $value) {
                if ($satir_rengi) {
                  echo "<tr style='background:#ccc'><td>".$satir_no."</td>";

                  foreach ($siparisler_sutun_isimleri as $v) {
                    if ($v == "musteri_id"){
                      $isim_ulas = $db->prepare("SELECT musteri_ad,musteri_soyad FROM musteriler WHERE musteri_id = ?");
                      $isim_ulas -> execute(array($value[$v]));
                      $isim_ulas_sonuc =   $isim_ulas -> fetchAll();
                      foreach ( $isim_ulas_sonuc as $i => $j) {
                        $isim = $j["musteri_ad"]." ".$j["musteri_soyad"];
                      }
                      echo "<td>".$isim."</td>";
                    }else{
                    echo "<td>".$value[$v]."</td>";
                  }
                  }
                  echo "</tr>";
                  $satir_rengi = !$satir_rengi;
                }else {
                  echo "<tr><td>".$satir_no."</td>";

                  foreach ($siparisler_sutun_isimleri as $v) {
                    if ($v == "musteri_id"){
                      $isim_ulas = $db->prepare("SELECT musteri_ad,musteri_soyad FROM musteriler WHERE musteri_id = ?");
                      $isim_ulas -> execute(array($value[$v]));
                      $isim_ulas_sonuc =   $isim_ulas -> fetchAll();
                      foreach ( $isim_ulas_sonuc as $i => $j) {
                        $isim = $j["musteri_ad"]." ".$j["musteri_soyad"];
                      }
                      echo "<td>".$isim."</td>";
                    }else{
                    echo "<td>".$value[$v]."</td>";
                  }
                  }
                  echo "</tr>";
                  $satir_rengi = !$satir_rengi;
                }
                $satir_no++;
              }
            }elseif(isset($_POST["musteri_id_ile_listeleme"])){
            ?>

            <tr style="background:#ccc">
              <td></td>
              <?php
                foreach ($siparisler_sutun_isimleri as $value) {
                  $value = str_replace("_"," ", $value);
                  echo "<td>".$value."</td>";
                }
               ?>
            </tr>

            <?php
              $gelen_musteri_id = $_POST["musteri_id"];
              $musteri_id_kontrol = $db->prepare("SELECT * FROM musteriler WHERE musteri_id = ?");
              $musteri_id_kontrol -> execute(array($gelen_musteri_id));
              $musteri_id_kontrol_sonuc = $musteri_id_kontrol->fetchAll();
              if (count($musteri_id_kontrol_sonuc) != 0) {

                $siparis_secim = $db->prepare("SELECT * FROM siparisler WHERE musteri_id = ? ");
                $siparis_secim->execute(array($gelen_musteri_id));
                $siparis_secim_sonuc = $siparis_secim -> fetchAll();
                $satir_no = 1;
                $satir_rengi = false;
                if (count($siparis_secim_sonuc) != 0) {
                  foreach ($siparis_secim_sonuc as $key => $value) {

                    if ($satir_rengi) {
                      echo "<tr  style='background:#ccc'><td>".$satir_no."</td>";
                      foreach ($siparisler_sutun_isimleri as $v) {
                        if ($v == "musteri_id"){
                          $isim_ulas = $db->prepare("SELECT musteri_ad,musteri_soyad FROM musteriler WHERE musteri_id = ?");
                          $isim_ulas -> execute(array($value[$v]));
                          $isim_ulas_sonuc =   $isim_ulas -> fetchAll();
                          foreach ( $isim_ulas_sonuc as $i => $j) {
                            $isim = $j["musteri_ad"]." ".$j["musteri_soyad"];
                          }
                          echo "<td>".$isim."</td>";
                        }else{
                        echo "<td>".$value[$v]."</td>";
                      }
                      }
                      echo "</tr>";
                      $satir_no++;
                      $satir_rengi = !$satir_rengi;

                    }else {
                      echo "<tr><td>".$satir_no."</td>";
                      foreach ($siparisler_sutun_isimleri as $v) {
                        if ($v == "musteri_id"){
                          $isim_ulas = $db->prepare("SELECT musteri_ad,musteri_soyad FROM musteriler WHERE musteri_id = ?");
                          $isim_ulas -> execute(array($value[$v]));
                          $isim_ulas_sonuc =   $isim_ulas -> fetchAll();
                          foreach ( $isim_ulas_sonuc as $i => $j) {
                            $isim = $j["musteri_ad"]." ".$j["musteri_soyad"];
                          }
                          echo "<td>".$isim."</td>";
                        }else{
                        echo "<td>".$value[$v]."</td>";
                      }
                      }
                      echo "</tr>";
                      $satir_no++;
                      $satir_rengi = !$satir_rengi;
                    }


                  }
                }else {
                  echo "<script>alert(\"müşteriye kayıtlı sipariş bulunamadı\");window.location = \"bilgi-listeleme.php\";</script>";
                }

              }else {
                echo "<script>alert(\"girdiğiniz id ye sahip bir müşteri bulunamadı\"); window.location = \"bilgi-listeleme.php\";</script>";
              }



            }elseif (isset($_POST["musteri_listele"])) {
                echo '</table><table style="text-align:left">';
                echo "<tr style='background:#ccc'><td></td><td>Müşteri İD</td><td>Müşteri Adı</td><td>Müşteri Soyadı</td><td>Müşteri Adresi</td><td>Müşteri Telefon</td><td>Müşteri Not</td></tr>";
              $musteriler_ulas = $db->prepare("SELECT * FROM musteriler");
              $musteriler_ulas -> execute();
              $musteriler_ulas_sonuc = $musteriler_ulas -> fetchAll();
              $satir_no = 1;
              $satir_rengi = false;
              foreach (array_reverse($musteriler_ulas_sonuc) as $key => $value) {
                if ($satir_rengi) {
                  echo "<tr style = \"background:#ccc\"><td>".$satir_no."</td>
                            <td>".$value[0]."</td>
                            <td>".$value[1]."</td>
                            <td>".$value[2]."</td>
                            <td>".$value[3]."</td>
                            <td>".$value[4]."</td>
                            <td>".$value[5]."</td>
                      </tr>";
                      $satir_rengi = !$satir_rengi;
                }else {
                  echo "<tr><td>".$satir_no."</td>
                            <td>".$value[0]."</td>
                            <td>".$value[1]."</td>
                            <td>".$value[2]."</td>
                            <td>".$value[3]."</td>
                            <td>".$value[4]."</td>
                            <td>".$value[5]."</td>
                      </tr>";
                      $satir_rengi = !$satir_rengi;
                }

                $satir_no++;
              }



            }elseif (isset($_POST["para_durumu_listele"])) {

              $depo_para_ulas = $db->prepare("SELECT islem_tarihi,siparis_id,depo_para,islem_not FROM depo_listesi");
              $depo_para_ulas -> execute();
              $depo_para_ulas_sonuc = $depo_para_ulas -> fetchAll();
              $toplam_para = 0;
              foreach ($depo_para_ulas_sonuc as $key => $value) {
                $toplam_para += $value["depo_para"];
              }

              $alacak_ulas = $db->prepare("SELECT kalan_borc FROM siparisler");
              $alacak_ulas -> execute();
              $alacak_ulas_sonuc = $alacak_ulas -> fetchAll();
              $toplam_alacak = 0;
              foreach ($alacak_ulas_sonuc as $key => $value) {
                $toplam_alacak += $value["kalan_borc"];
              }

            ?>


            <tr style="background:#ccc;">

                  <td>Kasa Para Toplamı</td>
                  <td><?php echo $toplam_para; ?></td>
                  <td>Toplam Alacak Miktarı</td>
                  <td><?php echo $toplam_alacak; ?></td>

            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>

            <tr style="background:#ccc;">

                  <td>İşlem Tarihi</td>
                  <td>Para İşlemleri</td>
                  <td>İşlem Notu</td>
                  <td>Siparis İD</td>

            </tr>

            <?php

              $satir_rengi = false;
              foreach (array_reverse($depo_para_ulas_sonuc) as $key => $value) {
                  if ($value['siparis_id'] == 0) {
                      $siparis_id_degistirme = "Elle Giriş";
                  }else {
                    $siparis_id_degistirme =$value['siparis_id'];
                  }
                if ($satir_rengi) {
                  echo "<tr style = \"background:#ccc;\"><td>".$value["islem_tarihi"]."</td><td>"
                      .$value["depo_para"]."</td><td>"
                      .$value["islem_not"]."</td><td>"
                      .$siparis_id_degistirme."</td></tr>";
                      $satir_rengi = !$satir_rengi;
                }else {
                  echo "<tr><td>".$value["islem_tarihi"]."</td><td>"
                      .$value["depo_para"]."</td><td>"
                      .$value["islem_not"]."</td><td>"
                      .$siparis_id_degistirme."</td></tr>";
                      $satir_rengi = !$satir_rengi;
                }

              }

            }elseif (isset($_POST["stok_durumu_listele"])) {

              echo "</table><table style = \"text-align:left;\">";

              $ilac_sutun_isimleri = $db->prepare("DESCRIBE depo_listesi");
              $ilac_sutun_isimleri->execute();
              $ilac_sutun_isimleri_sonuc = $ilac_sutun_isimleri->fetchAll(PDO::FETCH_COLUMN);



              $bos_don = 1;
              $sutun_rengi = false;

              foreach ($ilac_sutun_isimleri_sonuc as $value) {
                if ($bos_don < 6) {
                  $bos_don++;
                  continue;
                }else {

                  $toplam_urun_miktari = 0;
                  $stok_bilgi = $db->prepare("SELECT $value FROM depo_listesi");
                  $stok_bilgi -> execute();
                  $stok_bilgi_sonuc = $stok_bilgi -> fetchAll();
                  foreach ($stok_bilgi_sonuc as $k => $v) {
                    $toplam_urun_miktari += $v[$value];
                  }

                  if (!$sutun_rengi) {
                    echo "<tr style = \"background:#ccc;\"><td>".str_replace("_"," ",$value)."</td><td style = \"text-align:center;\">".$toplam_urun_miktari."</td></tr>";
                    $sutun_rengi = !$sutun_rengi;
                  }else {
                    echo "<tr><td>".str_replace("_"," ",$value)."</td><td style = \"text-align:center;\">".$toplam_urun_miktari."</td></tr>";
                    $sutun_rengi = !$sutun_rengi;
                  }


                }
              }




            }


             ?>
        </table>
      </div>
  </div>

</body>
</html>

<!--nozver&&gereksizadam-->
