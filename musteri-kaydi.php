<?php include "header.php" ?>



<div id="sidebar">
	<?php
		include ('sidebar.php');
	?>
</div>
<div id="content">
	<div class="contenticerik">

		<form action="islem.php" method="POST">
			<table id="buyuktablo">


				<tr>
					<td style="background:#F39C12; color:#fff; font-size:18px;" colspan="3">Müşteri Bilgileri</td>
				</tr>
				<tr>
					<td><input type="text" name="musteri_ad" autofocus="on" autocomplete="off" required placeholder="Müşteri İsmini Giriniz" /></td>
					<td><input type="text" name="musteri_soyad" autofocus="on" autocomplete="off" required placeholder="Müşteri Soyismini Giriniz" /></td>
					<td><input type="text" name="musteri_tel" autofocus="on" autocomplete="off" required placeholder="Müşteri Telefon Giriniz" /></td>
				</tr>
				<tr>
					<td colspan="3"><textarea name="musteri_adres" placeholder="Müşteri Adresi Giriniz" ></textarea>
					<textarea name="musteri_not" placeholder="Müşteri Notu Girebilirsiniz " ></textarea></td>

				</tr>

				<tr>
					<td></td>
					<td></td>
					<td style="text-align:right"><button type="submit" name="musteri_kaydet" > Kaydet </button></td>
				</tr>
			</table>
		</form>

		<form action="islem.php" method="POST" >
			<table id="kucuktablo">
				<tr>
					<td style="background:#F39C12; color:#fff; font-size:18px;" colspan="3">Müşteri Bilgileri</td>
				</tr>
				<tr>
					<td><input type="text" name="musteri_ad" autofocus="on" autocomplete="off" required placeholder="Müşteri İsmini Giriniz" /></td>
				</tr>
				<tr>
					<td><input type="text" name="musteri_soyad" autofocus="on" autocomplete="off" required placeholder="Müşteri Soyismini Giriniz" /></td>
				</tr>
				<tr>
					<td><input type="text" name="musteri_tel" autofocus="on" autocomplete="off" required placeholder="Müşteri Telefon Giriniz" /></td>
				</tr>
				<tr>
					<td colspan="3"><textarea name="musteri_adres" placeholder="Müşteri Adresi Giriniz" ></textarea></td>
				</tr>
				<tr>
					<td><textarea name="musteri_not" placeholder="Müşteri Notu Girebilirsiniz " ></textarea></td>
				</tr>
				<tr>

				</tr>

				<tr>
					<td style="text-align:right"><button type="submit" name="musteri_kaydet" > Kaydet </button></td>
				</tr>
			</table>
		</form>
	</div>

</div>

</body>
</html>
<!--nozver&&gereksizadam-->
