<?php
include "header.php";

/*---------- musteri kaydi islemleri ----------*/
if (isset($_POST["musteri_kaydet"])){

/*post ile gelen degiskenler aliniyor*/
$benzer_icerik = false;
$musteri_ad = strtolower_utf8(trim($_POST["musteri_ad"]));
$musteri_soyad = strtolower_utf8(trim($_POST["musteri_soyad"]));
$musteri_tel = trim($_POST["musteri_tel"]);
$musteri_adres = trim($_POST["musteri_adres"]);
$musteri_not = trim($_POST["musteri_not"]);

$secim_musterikaydi = $db->prepare("SELECT musteri_ad,musteri_soyad FROM musteriler");
$secim_musterikaydi -> execute(array());
$sonuc_musterikaydi = $secim_musterikaydi->fetchAll();
foreach ($sonuc_musterikaydi as $key => $value) {
   if($value["musteri_ad"] == $musteri_ad && $value["musteri_soyad"] == $musteri_soyad){
     echo "<script> alert(\" aynı kullanıcı ismi ile birden fazla kayıt yapılamaz\")</script>";
     $benzer_icerik = true;
     echo "<script> window.location = \"musteri-kaydi.php\"</script>";
   }
}

if (!$benzer_icerik){
$secim = $db->prepare("INSERT INTO musteriler SET
musteri_ad = ?,
musteri_soyad = ?,
musteri_adres = ?,
musteri_tel = ?,
musteri_not = ?");
$ekleme = $secim->execute(array(
   $musteri_ad, $musteri_soyad, $musteri_adres,
   $musteri_tel,  $musteri_not
));
if ( $ekleme ){
  $last_id = $db->lastInsertId();?>
  <script type="text/javascript">
    alert("Müşteri kaydı başarılı bir şekilde yapılmıştır");
    window.location="musteri-kaydi.php";
  </script>
<?php
}
}
}
?>

<?php
/*---------- siparis kaydi islemleri ----------*/
if (isset($_POST["siparis_kayit"])){

 /*post ile gelen degiskenler aliniyor*/


 $siparisler_sutun_isimleri = unserialize($_POST["siparis_sutunlari"]) ;
 $siparis_sutun_ilac = unserialize($_POST["siparis_sutun_ilac"]) ;

 $secim_kontrol = $db->prepare("SELECT * FROM musteriler where musteri_id=?");
 $secim_kontrol -> execute(array($_POST["musteri_id"]));
 $sonuc_kontrol = $secim_kontrol->fetchAll();

 if (count($sonuc_kontrol) != 0) {

   $secim = $db->prepare("INSERT INTO siparisler SET musteri_id = ?");
   $ekleme = $secim->execute(array($_POST["musteri_id"]));
   $last_id = $db->lastInsertId();

   foreach ($siparisler_sutun_isimleri as $value) {

     $secim_1 = $db->prepare("UPDATE siparisler SET $value = ? WHERE siparis_id = ?");
     $ekleme_1 = $secim_1->execute(array($_POST[$value],$last_id));

   }

   $secim_borc_1 = $db->prepare("UPDATE siparisler SET kalan_borc = ? WHERE siparis_id = ?");
   $secim_borc_1 -> execute(array($_POST["siparis_tutari"]-$_POST["odenen_tutar"],$last_id));

   $siparis_listele = $db->prepare("SELECT * FROM siparisler where siparis_id=?");
   $siparis_listele -> execute(array($last_id));
   $siparis_listele_sonuc = $siparis_listele -> fetchAll();

   $depo_ekle = $db->prepare("INSERT INTO depo_listesi SET siparis_id = ?");
   $depo_ekle -> execute(array($last_id));


   foreach ($siparis_listele_sonuc as $key => $value) {

     $depo_update_odenen = $db->prepare("UPDATE depo_listesi SET depo_para = ? WHERE siparis_id = ?");
     $depo_update_odenen -> execute(array($value["odenen_tutar"],$last_id));

     foreach ($siparis_sutun_ilac as $v) {
       $sutun = str_replace(" ","_",$value[$v]);
       $depo_update = $db->prepare("UPDATE depo_listesi SET $sutun = ? WHERE siparis_id = ?");
       $depo_update -> execute(array("-".$value[$v."_adet"],$last_id));

     }

   }


   }

   if ( $ekleme_1 ){?>
     <script type="text/javascript">
       alert("siparis kaydı başarılı bir şekilde yapılmıştır");
       window.location="siparis-girisi.php";
     </script>
 <?php
   }else {
     echo "<script> alert(\"böyle bir id bulunamadı\"); window.location = \"siparis-girisi.php\"</script>";
   }

   }
?>
<!--nozver&&gereksizadam-->
