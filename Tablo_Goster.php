<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="stiller.css"/>
        <style type="text/css">

        </style>
    </head>
    <body>
        <?php
function Tablo_Goster($Uzman_IDsi,$yetki)
{    
    //include 'db.php';
    //mysql_select_db($VT,$Baglanti) or die ('Veri tabanı seçilemedi' . mysql_error());;    
    if(isset($_GET['iptaller']))
    {        
        
        if($_GET['iptaller']=="EVET")
        {
            $Listele= "SELECT * FROM kayitlar WHERE uzman_id='$Uzman_IDsi' AND Iptal='E'";
        }
        elseif($_GET['iptaller']=="HAYIR") 
        {
            $Listele= "SELECT * FROM kayitlar WHERE uzman_id='$Uzman_IDsi'";
        }        
    }
    else {
        $Listele= "SELECT * FROM kayitlar WHERE uzman_id='$Uzman_IDsi'";
    }
    
    $Sonuc = mysql_query($Listele);
    include 'fonksiyonlar.php';
    $Uzman_Ismi=  Uzman_Bul($Uzman_IDsi);
    if ($yetki=="mhsb")
    {
    //$Uzman_Ismi=explode("_",$Tablo);
    echo "<table class=tablo align='center'>";
    echo "<caption>".$Uzman_Ismi. " &nbsp;RANDEVU DÖKÜMÜ</caption>";
        echo "<tr>";
            echo "<th>No</th>";
            echo "<th>Randevu</th>";
            if(isset($_GET['iptaller']))
            {
                if($_GET['iptaller']=="HAYIR")
                {    
                    $url="dokum_al.php?kim=$Uzman_IDsi"."&"."iptaller=EVET";
                }
                elseif($_GET['iptaller']=="EVET")
                {
                    $url="dokum_al.php?kim=$Uzman_IDsi"."&"."iptaller=HAYIR";
                }
            }
            else
            {
                $url="dokum_al.php?kim=$Uzman_IDsi"."&"."iptaller=EVET";
            }
            echo "<th><a href=$url>İptal</a></th>";
            echo "<th>Süpervizör</th>";
            echo "<th>Ücret</th>";
            echo "<th>Kredi Kartı</th>";
            echo "<th>Tarih</th>";
            echo "<th>Saat</th>";
            echo "<th>Uzman Ücret</th>";
            echo "<th>Süpervizör Ücret</th>";
            echo "<th>Kurum Ücret</th>";
            echo "<th>Ortak1 Ücret</th>";
            echo "<th>Ortak2 Ücret</th>";
            echo "<th>Ortak3 Ücret</th>";
            
        echo "</tr>";    
            
            while ($Satir = mysql_fetch_array($Sonuc))	
            {
                echo "<tr>";
                $Odeme=$Satir['Ucret'];
                //echo $Odeme."-";
                if($Odeme==0)
                {
                echo "<td style=background:red>".$Satir['Numarator']."</td>";
                echo "<td style=background:red>".$Satir['Randevu']."</td>";
                echo "<td style=background:red>".$Satir['Iptal']."</td>";
                echo "<td style=background:red>".$Satir['Yonlendirme']."</td>";
                echo "<td style=background:red>".$Satir['Ucret']."</td>";
                echo "<td style=background:red>".$Satir['Kredi_Karti']."</td>";
                echo "<td style=background:red>".$Satir['Tarih']."</td>";
                echo "<td style=background:red>".substr($Satir['Saat'],0,5)."</td>";
                echo "<td style=background:red>".$Satir['para_uzman']."</td>";
                echo "<td style=background:red>".$Satir['para_supervisor']."</td>";
                echo "<td style=background:red>".$Satir['para_sirket']."</td>";
                echo "<td style=background:red>".$Satir['para_sirket_ortak1']."</td>";
                echo "<td style=background:red>".$Satir['para_sirket_ortak2']."</td>";
                echo "<td style=background:red>".$Satir['para_sirket_ortak3']."</td>";
                }
                else
                {                                    
                echo "<td>".$Satir['Numarator']."</td>";
                echo "<td>".$Satir['Randevu']."</td>";
                echo "<td>".$Satir['Iptal']."</td>";
                echo "<td>".$Satir['Yonlendirme']."</td>";
                echo "<td>".$Satir['Ucret']."</td>";
                echo "<td>".$Satir['Kredi_Karti']."</td>";
                echo "<td>".$Satir['Tarih']."</td>";
                echo "<td>".substr($Satir['Saat'],0,5)."</td>";
                echo "<td>".$Satir['para_uzman']."</td>";
                echo "<td>".$Satir['para_supervisor']."</td>";
                echo "<td>".$Satir['para_sirket']."</td>";
                echo "<td>".$Satir['para_sirket_ortak1']."</td>";
                echo "<td>".$Satir['para_sirket_ortak2']."</td>";
                echo "<td>".$Satir['para_sirket_ortak3']."</td>";

                }                
            }
                echo "</tr>";
                
                $Toplam_Ucret="SELECT SUM(Ucret) AS toplam_ucret FROM kayitlar WHERE uzman_id='$Uzman_IDsi'";
                $Sonuc_Toplam=  mysql_query($Toplam_Ucret);
                $Satir_Toplam=  mysql_fetch_array($Sonuc_Toplam);
                echo "<tr>";
                echo "<td colspan=3 style=background:#333>TOPLAM ÜCRET :</td>";
                echo "<td style=background:#333>".number_format($Satir_Toplam['toplam_ucret'],2)." TL"."</td>";
                
				$Toplam_Ucret_Uzman="SELECT SUM(para_uzman) AS toplam_para_uzman FROM kayitlar WHERE uzman_id='$Uzman_IDsi'";
                $Sonuc_Toplam_Uzman=  mysql_query($Toplam_Ucret_Uzman);
                $Satir_Toplam_Uzman=  mysql_fetch_array($Sonuc_Toplam_Uzman);
                
                echo "<td colspan=4 style=background:#333>TOPLAM UZMAN ÜCRET :</td>";
                echo "<td style=background:#333>".number_format($Satir_Toplam_Uzman['toplam_para_uzman'],2)." TL"."</td>";
				
		$Toplam_Ucret_Uzman="SELECT SUM(para_supervisor) AS toplam_para_supervisor FROM kayitlar WHERE uzman_id='$Uzman_IDsi'";
                $Sonuc_Toplam_Uzman=  mysql_query($Toplam_Ucret_Uzman);
                $Satir_Toplam_Uzman=  mysql_fetch_array($Sonuc_Toplam_Uzman);
		echo "<td style=background:#333>".number_format($Satir_Toplam_Uzman['toplam_para_supervisor'],2)." TL"."</td>";
				
		$Toplam_Ucret_Uzman="SELECT SUM(para_sirket) AS toplam_para_sirket FROM kayitlar WHERE uzman_id='$Uzman_IDsi'";
                $Sonuc_Toplam_Uzman=  mysql_query($Toplam_Ucret_Uzman);
                $Satir_Toplam_Uzman=  mysql_fetch_array($Sonuc_Toplam_Uzman);
				echo "<td style=background:#333>".number_format($Satir_Toplam_Uzman['toplam_para_sirket'],2)." TL"."</td>";
				
				$Toplam_Ucret_Uzman="SELECT SUM(para_sirket_ortak1) AS toplam_para_sirket_ortak1 FROM kayitlar WHERE uzman_id='$Uzman_IDsi'";
                $Sonuc_Toplam_Uzman=  mysql_query($Toplam_Ucret_Uzman);
                $Satir_Toplam_Uzman=  mysql_fetch_array($Sonuc_Toplam_Uzman);
				echo "<td style=background:#333>".number_format($Satir_Toplam_Uzman['toplam_para_sirket_ortak1'],2)." TL"."</td>";
								
				$Toplam_Ucret_Uzman="SELECT SUM(para_sirket_ortak2) AS toplam_para_sirket_ortak2 FROM kayitlar WHERE uzman_id='$Uzman_IDsi'";
                $Sonuc_Toplam_Uzman=  mysql_query($Toplam_Ucret_Uzman);
                $Satir_Toplam_Uzman=  mysql_fetch_array($Sonuc_Toplam_Uzman);
				echo "<td style=background:#333>".number_format($Satir_Toplam_Uzman['toplam_para_sirket_ortak2'],2)." TL"."</td>";
				
				$Toplam_Ucret_Uzman="SELECT SUM(para_sirket_ortak3) AS toplam_para_sirket_ortak3 FROM kayitlar WHERE uzman_id='$Uzman_IDsi'";
                $Sonuc_Toplam_Uzman=  mysql_query($Toplam_Ucret_Uzman);
                $Satir_Toplam_Uzman=  mysql_fetch_array($Sonuc_Toplam_Uzman);
				echo "<td style=background:#333>".number_format($Satir_Toplam_Uzman['toplam_para_sirket_ortak3'],2)." TL"."</td>";
				
				echo "</tr>";
    echo "</table>";

    //mysql_close($Baglanti);
    }
    elseif ($yetki=="uzm")
    {

        echo "<table class=tablo align='center'>";
        echo "<caption> $Uzman_Ismi RANDEVU DÖKÜMÜ</caption>";
        echo "<tr>";
            //echo "<th>No</th>";
            echo "<th>Randevu</th>";
            echo "<th>İptal</th>";
            echo "<th>Süpervizör</th>";
            //echo "<th>Ücret</th>";
            //echo "<th>KDV</th>";
            //echo "<th>Kredi Kartı</th>";
            echo "<th>Tarih</th>";
            echo "<th>Saat</th>";
        echo "</tr>";    
            while ($Satir = mysql_fetch_array($Sonuc))	
            {
                echo "<tr>";
                //echo "<td>".$Satir['Numarator']."</td>";
                echo "<td>".$Satir['Randevu']."</td>";
                echo "<td>".$Satir['Iptal']."</td>";
                echo "<td>".$Satir['Yonlendirme']."</td>";
                //echo "<td>".$Satir['Ucret']."</td>";
                //echo "<td>".$Satir['KDV']."</td>";
                //echo "<td>".$Satir['Kredi_Karti']."</td>";
                echo "<td>".$Satir['Tarih']."</td>";
                echo "<td>".$Satir['Saat']."</td>";
                echo "</tr>";


            }
    echo "</table>";

    //mysql_close($Baglanti);
    }
}       
        ?>
    </body>
</html>
