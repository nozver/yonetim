<?php

try {
     $db = new PDO("mysql:host=localhost; dbname=deneme", "root", "");
     $db->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");
} catch ( PDOException $e ){
     echo "veri tabanına bağlanamadı";
}


 ?>
<!--nozver&&gereksizadam-->
