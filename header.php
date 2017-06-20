<?php include "giris-kontrol.php" ?>
<?php include "baglan.php"; ?>
<?php
function strtolower_utf8($string){
$convert_to = array(
"a", "b", "c", "d", "e", "f", "g", "h", "ı", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
"v", "w", "x", "y", "z", "à", "á", "â", "ã", "ä", "å", "æ", "ç", "è", "é", "ê", "ë", "ì", "í", "î", "ï",
"ð", "ñ", "ò", "ó", "ô", "õ", "ö", "ø", "ù", "ú", "û", "ü", "ý", "а", "б", "в", "г", "д", "е", "ё", "ж",
"з", "и", "й", "к", "л", "м", "н", "о", "п", "р", "с", "т", "у", "ф", "х", "ц", "ч", "ш", "щ", "ъ", "ы",
"ь", "э", "ю", "я","i","ş","ğ"
);
$convert_from = array(
"A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U",
"V", "W", "X", "Y", "Z", "À", "Á", "Â", "Ã", "Ä", "Å", "Æ", "Ç", "È", "É", "Ê", "Ë", "Ì", "Í", "Î", "Ï",
"Ð", "Ñ", "Ò", "Ó", "Ô", "Õ", "Ö", "Ø", "Ù", "Ú", "Û", "Ü", "Ý", "А", "Б", "В", "Г", "Д", "Е", "Ё", "Ж",
"З", "И", "Й", "К", "Л", "М", "Н", "О", "П", "Р", "С", "Т", "У", "Ф", "Х", "Ц", "Ч", "Ш", "Щ", "Ъ", "Ъ",
"Ь", "Э", "Ю", "Я","İ","Ş","Ğ"
);

return str_replace($convert_from, $convert_to, $string);
}
?>

<?php
	function ozelKarakterKontrol($string){
		$karakter = array("é","\"","!","\'","^","#","+","$","%","&","/","(",")","{","[","]","=",
											"}","*","?","\\",",",";","~","@","€",".",":","<",">","|","-");
	foreach ($karakter as $value) {
		if (strstr($string,$value)) {
			return true;
		}
	}
	return false;
	}
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="tr">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="style.css" rel="stylesheet" type="text/css" />
	<link href="js/datepicker.css" rel="stylesheet" type="text/css" />

	<link href="https://fonts.googleapis.com/css?family=Merriweather:900" rel="stylesheet">
	<title>Yönetim Paneline Hoşgeldiniz</title>

	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/ui.js"></script>
	<script type="text/javascript" src="js/ayar.js"></script>

</head>
<body>
	<div id="header-left">
		<a href="#"><img src="menu.png" /></a>
	</div>
	<div id="header-right">
		<a href="index.php"><span>Meloxcin</span></a>
		<a href="log-out.php"><img src="exit.png" /></a>
		<a href="depo-islem.php"><img src="depo.png" /></a>
	</div>
<!--nozver&&gereksizadam-->
