<?php include ('header.php'); ?>
<style>
@media only screen and (min-width: 960px){

  table input[type="submit"]{background: #367FA9; border:0px; height: 30px; color:#fff;  font-size:15px}
  .bilgi-listeleme{width: 46%;   padding: 0 1%;  float: left;  margin-left: 2%; margin-top: 20px;}
  .bilgi-listeleme table{height: 170px; width: 100%; margin-top: 30px}
  .bilgi-listeleme table td{padding-left: 10px;}
  .bilgi-listeleme table input{width: 70%; margin-left: 15%; padding: 5px 7px;}


}
@media only screen and (min-width: 801px) and (max-width: 959px)  {
  table input[type="submit"]{background: #367FA9; border:0px; height: 30px; color:#fff;  font-size:15px}
  .bilgi-listeleme{width: 70%;   padding: 0 15%;  float: left;  margin-left: 2%; margin-top: 20px;}
  .bilgi-listeleme table{height: 170px; width: 100%;}
  .bilgi-listeleme table td{padding-left: 10px; }
  .bilgi-listeleme table input{width: 70%; margin-left: 15%; padding: 5px 7px;}



}
@media only screen and (min-width: 481px) and (max-width: 800px) {

  table input[type="submit"]{background: #367FA9; border:0px; height: 30px; color:#fff;  font-size:15px}
  .bilgi-listeleme{width: 60%;   padding: 0 20%;    margin-top: 20px;}
  .bilgi-listeleme table{height: 170px; width: 100%;}
  .bilgi-listeleme table td{padding-left: 10px; }
  .bilgi-listeleme table input{width: 60%; margin-left: 20%; padding: 5px 7px;}


}
@media only screen and (max-width: 480px){

  table input[type="submit"]{background: #367FA9; border:0px; height: 30px; color:#fff;  font-size:15px}
  .bilgi-listeleme{width: 98%;   padding: 0 1%;  margin-top: 20px;}
  .bilgi-listeleme table{height: 170px; width: 100%; margin-top: 50px}
  .bilgi-listeleme table td{padding-left: 10px; }
  .bilgi-listeleme table input{width: 70%; margin-left: 15%; padding: 5px 7px;}


}



</style>


<div id="sidebar">
  <?php
    include ('sidebar.php');
  ?>
</div>
<div id="content">
	<div class="bilgi-listeleme" >
    <!--
    *********************************************************************************
                                            Tarih İle Bilgi Listeleme
    *********************************************************************************
    -->
    <form  action="bilgi-listele-sonuc.php" method="post" name="tarihe-gore-listele">
    <table>
        <!--DatePicker Fonksiyon Çağırma-->

        <script type="text/javascript">

          $(function() {
            $( "#datepicker" ).datepicker({


            });

            $( "#date" ).datepicker({

            });
          });


        </script>
    <tr >
      <td style="background:#F39C12; color:#FFF; text-align:left;">Sipariş Durum ve Ödeme Bilgileri</td>
    </tr>
    <tr >
      <td><input style="padding:2px 5px; margin-top:5px;" name="tarih-ilk"  type="text"  autocomplete="off"  required placeholder="Başlangıç Tarihi Seçin..." id="datepicker" /></td>
    </tr>
    <tr >
      <td> <input style="padding:2px 5px; margin-top:5px;" name="tarih-bitis"  type="text" autocomplete="off" required placeholder="Bitiş Tarihi Seçin..." id="date" />	</td>
    </tr>
    <tr>
        <td> <input  type="submit" name="tarihe-gore-listele-buton"  value="Listele" id="buton" /></td>
    </tr>

    </table>
  </form>
</div>
      <!--
      *********************************************************************************
                                              İd İle Bilgi Listeleme
      *********************************************************************************
    -->
    <div class="bilgi-listeleme">

  <form  action="bilgi-listele-sonuc.php" method="post" name="musteriid_siparis_listele">
    <table>
      <tr >
        <td style="background:#F39C12; color:#FFF; text-align:left;">Sipariş Durum ve Ödeme Bilgileri</td>
      </tr>
      <tr>
        <td ><input style="padding:2px 5px; margin-top:5px;" name="musteri_id"  type="text" pattern="[0-9]*" title="İd Sadece Sayılardan Oluşabilir"  autocomplete="off"  required placeholder="Müşteri İD"  /></td>
        </tr>
        <tr>
          <td> <input  type="submit" name="musteri_id_ile_listeleme"  value="Listele" id="buton" /></td>
        </tr>
    </table>
  </form>
</div>
    <!--
    *********************************************************************************
                                            İd İle Bilgi Listeleme
    *********************************************************************************
    -->
    <div class="bilgi-listeleme">

        <form action="bilgi-listele-sonuc.php" method="post">
    <table>

      <tr >
        <td style="background:#F39C12; color:#FFF; text-align:left;">Sipariş Durum ve Ödeme Bilgileri</td>
      </tr>
    <tr>
      <td > <input   type="submit" name="musteri_listele" id="buton" value="Müşterileri Listele"></td>
    </tr>
    <tr>
      <td > <input   type="submit" name="para_durumu_listele" id="buton" value="Para Durumu Listele"/></td>
    </tr>
    <tr>
      <td > <input   type="submit" name="stok_durumu_listele" id="buton" value="Stok Durumu Listele" /></td>
    </tr>
    </table>
        </form>

	</div>
</div>

</body>
</html>
<!--nozver&&gereksizadam-->
