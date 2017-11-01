<?php
$Sunucu="localhost";
$Kullanici="root";
$Sifre="";
$VT="danisman";
$Baglanti=  mysql_pconnect($Sunucu,$Kullanici,$Sifre) or die ("Hata!!:".mysql_error());
mysql_query("SET NAMES UTF8");
?>
