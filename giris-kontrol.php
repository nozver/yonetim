<?php

if(!isset($_SESSION))
{
session_start();
}
if (!isset($_SESSION["kullanici_adi"])){

  header("Location:login.php");
}
#<!--nozver&&gereksizadam-->#
  ?>

