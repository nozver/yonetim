-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 20 Haz 2017, 02:56:17
-- Sunucu sürümü: 10.1.21-MariaDB
-- PHP Sürümü: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `taha`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `depo_listesi`
--

CREATE TABLE `depo_listesi` (
  `islem_id` int(11) NOT NULL,
  `islem_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `siparis_id` int(11) NOT NULL,
  `depo_para` decimal(13,2) NOT NULL,
  `islem_not` varchar(55) COLLATE utf8_turkish_ci NOT NULL,
  `meloxcin_erkek_şişe` int(11) NOT NULL,
  `meloxcin_vip_erkek_şişe` int(11) NOT NULL,
  `meloxcin_kadın_şişe` int(11) NOT NULL,
  `meloxcin_vip_kadın_şişe` int(11) NOT NULL,
  `dermaroller_025mm` int(11) NOT NULL,
  `dermaroller_050mm` int(11) NOT NULL,
  `dermastamp_025mm` int(11) NOT NULL,
  `aspirin_100mg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ilac_tablo_listesi`
--

CREATE TABLE `ilac_tablo_listesi` (
  `tablo_id` int(11) NOT NULL,
  `tablo_ad` varchar(50) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici`
--

CREATE TABLE `kullanici` (
  `k_id` int(11) NOT NULL,
  `k_adi` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `k_sifre` varchar(50) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `musteriler`
--

CREATE TABLE `musteriler` (
  `musteri_id` int(11) NOT NULL,
  `musteri_ad` varchar(55) COLLATE utf8_turkish_ci NOT NULL,
  `musteri_soyad` varchar(55) COLLATE utf8_turkish_ci NOT NULL,
  `musteri_adres` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
  `musteri_tel` bigint(12) NOT NULL,
  `musteri_not` varchar(500) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparisler`
--

CREATE TABLE `siparisler` (
  `siparis_id` int(11) NOT NULL,
  `siparis_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `musteri_id` int(11) NOT NULL,
  `siparis_tutari` decimal(13,2) NOT NULL,
  `odenen_tutar` decimal(13,2) NOT NULL,
  `kargo_durumu` varchar(55) COLLATE utf8_turkish_ci NOT NULL,
  `kargo_ucreti` decimal(55,0) NOT NULL,
  `kalan_borc` decimal(13,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `depo_listesi`
--
ALTER TABLE `depo_listesi`
  ADD PRIMARY KEY (`islem_id`);

--
-- Tablo için indeksler `ilac_tablo_listesi`
--
ALTER TABLE `ilac_tablo_listesi`
  ADD PRIMARY KEY (`tablo_id`);

--
-- Tablo için indeksler `kullanici`
--
ALTER TABLE `kullanici`
  ADD PRIMARY KEY (`k_id`);

--
-- Tablo için indeksler `musteriler`
--
ALTER TABLE `musteriler`
  ADD PRIMARY KEY (`musteri_id`);

--
-- Tablo için indeksler `siparisler`
--
ALTER TABLE `siparisler`
  ADD PRIMARY KEY (`siparis_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `depo_listesi`
--
ALTER TABLE `depo_listesi`
  MODIFY `islem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
--
-- Tablo için AUTO_INCREMENT değeri `ilac_tablo_listesi`
--
ALTER TABLE `ilac_tablo_listesi`
  MODIFY `tablo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- Tablo için AUTO_INCREMENT değeri `kullanici`
--
ALTER TABLE `kullanici`
  MODIFY `k_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Tablo için AUTO_INCREMENT değeri `musteriler`
--
ALTER TABLE `musteriler`
  MODIFY `musteri_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- Tablo için AUTO_INCREMENT değeri `siparisler`
--
ALTER TABLE `siparisler`
  MODIFY `siparis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
