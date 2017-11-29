<?php
function Uzman_ID_Bul($Uzman_Ismi)
{
    //include 'db.php';
    //mysql_select_db($VT,$Baglanti);
    $ID_Bulma_Sorgusu="SELECT * FROM uzmanlar WHERE uzman_isim='$Uzman_Ismi'";
    $ID_Sonuc=  mysql_query($ID_Bulma_Sorgusu);
    $ID_Satir=  mysql_fetch_array($ID_Sonuc);
    $Uzman_ID=$ID_Satir['id'];
    
    return $Uzman_ID;
    
    mysql_close($Baglanti);
}
function Uzman_Bul($Uzman_ID_Gelen)
{
    //include 'db.php';
    //mysql_select_db($VT,$Baglanti);
    $Uzman_Bulma_Sorgusu="SELECT * FROM uzmanlar WHERE id='$Uzman_ID_Gelen'";
    $Uzman_Sonuc=  mysql_query($Uzman_Bulma_Sorgusu);
    if($Uzman_Sonuc==FALSE)
	{
		echo "Hata !! :".mysql_error();
	}
	$Uzman_Satir=  mysql_fetch_array($Uzman_Sonuc);
    $Uzman_Isim=$Uzman_Satir['uzman_isim'];
    
    return $Uzman_Isim;
    
    mysql_close($Baglanti);
}
function Numaratorden_ID_Bul ($Numara)
{
    //include 'db.php';
    //mysql_select_db($VT,$Baglanti);
    $Uzman_Bulma_Sorgusu="SELECT * FROM kayitlar WHERE Numarator='$Numara'";
    $Uzman_Sonuc=  mysql_query($Uzman_Bulma_Sorgusu);
    $Uzman_Satir=  mysql_fetch_array($Uzman_Sonuc);
    $Uzman_ID=$Uzman_Satir['uzman_id'];
    
    return $Uzman_ID;
    
    mysql_close($Baglanti);    
}
?>