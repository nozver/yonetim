<?php
session_start();
include "baglan.php";

if(isset($_POST["giris"])){

  $k_adi = $_POST["k_adi"];
  $k_sifre = md5($_POST["k_sifre"]);

  if ($k_adi && $k_sifre){

    $kullanici_bilgi = $db->prepare("SELECT * FROM kullanici");
    $kullanici_bilgi->execute();
    $kullanici_bilgi_sonuc = $kullanici_bilgi -> fetchAll(PDO::FETCH_ASSOC);
    foreach( $kullanici_bilgi_sonuc as $row ){
       if (($row["k_adi"] == $k_adi) && ($row["k_sifre"] == $k_sifre)){

         $_SESSION["kullanici_adi"] = $k_adi;
         echo '<script> window.location = "index.php"</script>';
       }else {
		 echo '<script> window.location = "login.php?login=no"</script>';
       }
    }
  }else {
     echo '<script> window.location = "login.php"</script>';

  }
}

echo '<script> window.location = "index.php"</script>';

?>