<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="stiller.css"/>
        <script>
            function uyari()
            {
                alert("KAYIT EDİLDİ");
            }
            </script>
    </head>
    <body>
        <?php
            $Gelen_Randevu=$_GET['numara'];
            //echo $Gelen_Randevu;
            include 'db.php';
            mysql_select_db($VT,$Baglanti);
            $Secilen_Uzman=$_COOKIE['secilen'];
            //echo $Secilen;
            $Randevu_Secme_Sorgusu="SELECT * FROM $Secilen_Uzman WHERE Numarator='$Gelen_Randevu'";
            $Randevu_Veri=  mysql_query($Randevu_Secme_Sorgusu);
            $Randevu_Veri_Satir=  mysql_fetch_array($Randevu_Veri);                        
        ?>
        <form method="post" aciton="ucret_giris.php">
            <table align="center">
                <tr>
                    <td>Adı Soyadı : </td>
                    <td> <input type="text" name="isim" value="<?php echo $Randevu_Veri_Satir['Randevu'];?>" disabled="disabled"/></td>
                </tr>
                <tr>
                    <td>Tarih : </td>
                    <td> <input type="text" name="tarih" value="<?php echo $Randevu_Veri_Satir['Tarih'];?>" disabled="disabled"/></td>
                </tr>
                <tr>
                    <td>Saat : </td>
                    <td> <input type="text" name="saat" value="<?php echo $Randevu_Veri_Satir['Saat'];?>" disabled="disabled"/></td>
                </tr>
                <tr>
                    <td>Süpervizör : </td>
                    <td> <input type="text" name="supervisor" value="<?php echo $Randevu_Veri_Satir['Yonlendirme'];?>" disabled="disabled"/></td>
                </tr>                
                <tr>
                    <td>Ücret :</td>
                    <td> <input type="number" name="para" min="1" max="1000 "/></td>
                </tr>
                <tr>
                    <td>Kredi Kartı? :</td>
                    <td> 
                        <select name="kredi">
                            <option value="H"> HAYIR</option>
                            <option value="E"> EVET</option>
                        </select> 
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" on value="KAYDET"/></td>
                </tr>
            </table>
        </form>
    <?php
        if(isset($_REQUEST['para']) and $_REQUEST['para'] > 0 )
        {
            if ($Randevu_Veri_Satir['Yonlendirme']=="Yok")
            {
                $Para=$_REQUEST['para'];
                $Kredi_Kart=$_REQUEST['kredi'];                
                //$Kredi_Kart= ($Kredi_Kart=="EVET" ? "E":"H");
                
                //$Ucret=$Randevu_Veri_Satir['Ucret'];
                $Kurum_Para=$Para*0.6;
                $Uzman_Para=$Para*0.4;
                
                $Ortak_Para=$Kurum_Para/3;
                
                $Sorgu_Ucret_Giris="UPDATE $Secilen_Uzman SET Ucret='$Para',Kredi_Karti='$Kredi_Kart',para_uzman='$Uzman_Para', para_sirket='$Kurum_Para', para_sirket_ortak1='$Ortak_Para', para_sirket_ortak2='$Ortak_Para',para_sirket_ortak3='$Ortak_Para' WHERE Numarator='$Gelen_Randevu'";
                if($Kredi_Kart=="H")
                {
                    if(mysql_query($Sorgu_Ucret_Giris))
                    {
                        echo "<div style=text-align:center> Kayıt alındı </div>";
                        echo "<div style=text-align:center>". "<img src=OK.png />". "</div>";
                        echo "<div style=text-align:center><a href=sekreter_ekran.php> GERİ DÖN </a></div>";
                    }
                    else 
                    {
                        echo "Hata: " .mysql_error();
                    }
                }
                else{
                    echo "<div style=text-align:center><h3>Lütfen ücreti giriniz !!! </h3></div>";
                }
                
                if($Kredi_Kart=="E")
                {
                    $Kurum_Para=$Para*0.6*0.72;
                    $Uzman_Para=$Para*0.4*0.72;                
                    $Ortak_Para=$Kurum_Para/3;
                    
                    $Sorgu_Ucret_Giris_Kredi="UPDATE $Secilen_Uzman SET Ucret='$Para',KDV=18,Kredi_Karti='$Kredi_Kart',para_uzman='$Uzman_Para', para_sirket='$Kurum_Para', para_sirket_ortak1='$Ortak_Para', para_sirket_ortak2='$Ortak_Para',para_sirket_ortak3='$Ortak_Para' WHERE Numarator='$Gelen_Randevu'";
                    
                    if(mysql_query($Sorgu_Ucret_Giris_Kredi))
                    {
                        echo "<div style=text-align:center> Kayıt alındı </div>";
                        echo "<div style=text-align:center>". "<img src=OK.png />". "</div>";
                        echo "<div style=text-align:center><a href=sekreter_ekran.php> GERİ DÖN </a></div>";
                    }
                    else 
                    {
                        echo "Hata: " .mysql_error();
                    }
                }
                
            }
            else
            {
                $Kredi_Kart=$_REQUEST['kredi']; 
                if($Kredi_Kart=="H")
                {
                    $Yonlendiren=$Randevu_Veri_Satir['Yonlendirme'];
                    $Super_Visor_Bul_Sorgu="SELECT * FROM supervisor WHERE isim='$Yonlendiren'";
                    $Sorgu_Yuzde_Bul=  mysql_query($Super_Visor_Bul_Sorgu);
                    $Satir_Yuzde_Bul=  mysql_fetch_array($Sorgu_Yuzde_Bul);

                    $Para=$_REQUEST['para'];                
                    $Kredi_Kart=$_REQUEST['kredi'];
                    $Kredi_Kart= ($Kredi_Kart=="EVET" ? "E":"H");

                    $Kurum_Para=$Para*($Satir_Yuzde_Bul['kurum']/100);
                    $Supervisor_Para=$Para*($Satir_Yuzde_Bul['yuzde']/100);
                    $Uzman_Para=$Para-($Supervisor_Para+$Kurum_Para);

                    $Ortak_Para=$Kurum_Para/3;

                    //$Ucret=$Randevu_Veri_Satir['Ucret'];                

                    $Sorgu_Ucret_Giris="UPDATE $Secilen_Uzman SET Ucret='$Para',Kredi_Karti='$Kredi_Kart',para_uzman='$Uzman_Para',para_supervisor='$Supervisor_Para', para_sirket='$Kurum_Para', para_sirket_ortak1='$Ortak_Para', para_sirket_ortak2='$Ortak_Para',para_sirket_ortak3='$Ortak_Para' WHERE Numarator='$Gelen_Randevu'";
                    if(mysql_query($Sorgu_Ucret_Giris))
                    {
                        echo "<div style=text-align:center> Kayıt alındı </div>";
                        echo "<div style=text-align:center>". "<img src=OK.png />". "</div>";
                        echo "<div style=text-align:center><a href=sekreter_ekran.php> GERİ DÖN </a></div>";
                    }
                    else 
                    {
                        echo "Hata: " .mysql_error();
                    }
                }
                if($Kredi_Kart=="E")
                {
                    
                }
            }
            
            
            
        }
        else
        {
            echo "<div style=text-align:center><h3>Lütfen ücreti giriniz !!! </h3></div>";
        }
    ?>
    </body>
</html>
