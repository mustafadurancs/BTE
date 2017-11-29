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
        if(isset($_GET['saat']))
        {
            $Gelen_Tarih=$_GET['saat'];
            //$Gun_Ay=  explode("-", $Gelen_Tarih);
            //echo $Gelen_Tarih;
            setcookie("saat",$Gelen_Tarih);
            include 'db.php';
            mysql_select_db($VT);
            $Secilen_Uzman=$_COOKIE['secilen'];
            $Uzman_Ismi=explode("_",$Secilen_Uzman) ;
            $Sorgu_Saatler="SELECT * FROM $Secilen_Uzman WHERE Tarih='$Gelen_Tarih'";
            $Sonuclar=mysql_query($Sorgu_Saatler);
            echo "<table class=tablo align=center>";
            echo "<caption>". $Gelen_Tarih. "  RANDEVULAR "."<br/>". ucfirst($Uzman_Ismi[0])." ". strtoupper($Uzman_Ismi[1]). "</caption>";
            echo "<tr>";
            echo "<th> ADI SOYADI</th><th>RANDEVU SAATİ</th><th>İptal mi?</th>";
            echo "</tr>";
            while($Satir=  mysql_fetch_array($Sonuclar))
            {
                echo "<tr>";
                $Slot=substr($Satir['Saat'],0,2);
                $Slot=$Slot+1;
                $Slot=$Slot.substr($Satir['Saat'],2,3);
                echo "<td>".$Satir['Randevu']."</td><td>".substr($Satir['Saat'],0,5)." - ".$Slot."</td>";
                $Numara=$Satir['Numarator'];
                echo "<td><a href=Randevu_Saatler.php?hangi_randevu=$Numara> RANDEVU SİL</a></td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "<div style=text-align:center><a href=sekreter_ekran.php> GERİ DÖN </a></div>";
            mysql_close($Baglanti);
        }
        if(isset($_GET['hangi_randevu']))
        {
            include 'db.php';
            $Secilen_Uzman=$_COOKIE['secilen'];
            $Silinecek_Randevu=$_GET['hangi_randevu'];
            $Sorgu_Randevu_Silme="DELETE FROM $Secilen_Uzman WHERE Numarator='$Silinecek_Randevu'";
            if(mysql_query($Sorgu_Randevu_Silme))
            {
                echo "<div style=text-align:center>RANDEVU SİLİNDİ</div>";
                sleep(1);
                header('location:sekreter_ekran.php');
            }
            else
            {
                echo "Hata: ".mysql_error();
            }
        }       
        ?>
    </body>
</html>
