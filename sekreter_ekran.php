<?php
    session_start();
    ob_start();
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="stiller.css"/>
        <style type="text/css">

            h3 {
                font-size:10pt;
                text-align: center;
                background: darkslategray;
                border-radius:4px;
                color:white;
                padding:3px;
            }
        </style>
            
    </head>
    <body>

        <table class="cerceve" align="center">
            <tr>
                <td colspan="2" class="baslik">
                    <table width="100%">
                        <tr>
                            <td width="30%">&nbsp;</td>
                            <td width="40%"><h1>- RANDEVU GİRİŞİ -</h1></td>
                            <td align="right">
                                <?php 
                                    echo "<a class=cikis href=cikis_yap.php?cikis=logout> Çıkış Yap </a>";                            
                                ?> 
                            </td>
                        </tr>
                    </table>                                     
                   
                </td>
            </tr>
            <tr>
                <td valign="top" width="120" bgcolor="darkgray">
                    <?php
                        if(isset($_SESSION['kullanicimiz']) && $_SESSION['rolu']=="sktr")
                        {
                            include('uzmanlar.php');
                            Uzmanlar_Listele("sekreter_ekran.php");
                            echo "<table align=center><tr><td>";
                            include 'takvim.php';
                            echo "</td></tr></table>";
                        }
                        else
                        {
                            header('location:index.php');                        
                        } 
                    ?>
                </td>
                <td valign="top" align="left">
                     <?php
                     
        if(isset($_GET['kim']))
        {            
            
            $Uzman_Secilen=$_GET['kim'];
            $Uzman_Isim=explode("_",$Uzman_Secilen);
            setcookie("secilen", $Uzman_Secilen);
            echo '<div id="secilen_uzman">'. ucfirst($Uzman_Isim[0])." ". strtoupper($Uzman_Isim[1]).'</div>';
            echo '<table align=center width=100%><tr><td valign=top width=300>';
                                                 
            include 'kayit_form.php';            
            echo "</td><td valign=top>";
            //include 'takvim.php';
            $Bugun=date("y-m-d");
            include 'db.php';
            mysql_select_db($VT,$Baglanti);
            $Tarihler_Sorgusu="SELECT * FROM $Uzman_Secilen WHERE Tarih >='$Bugun' ORDER BY Tarih ASC";
            $Sonuc=  mysql_query($Tarihler_Sorgusu);            
            echo "<ul class=randevu_liste>";
            echo "<h3>". ucfirst($Uzman_Isim[0])." ". strtoupper($Uzman_Isim[1])." RANDEVULARI</h3>";
            while($Satir=  mysql_fetch_array($Sonuc))
            {
                $Numara=$Satir['Numarator'];
                $newDate = date("d-M-Y", strtotime($Satir['Tarih']));
                if($newDate==date("d-M-Y"))
                {
                    echo "<a href=ucret_giris.php?numara=$Numara><li style=background:red>".$newDate." &nbsp; ". "|&nbsp; Saat: ".substr($Satir['Saat'],0,5)." | ".$Satir['Randevu']."</li>";
                }
                else
                {
                    echo "<a href=ucret_giris.php?numara=$Numara><li>".$newDate." &nbsp; ". "|&nbsp; Saat: ".substr($Satir['Saat'],0,5)." | ".$Satir['Randevu']."</li>";
                }
            }
            echo "</td></tr></table>";                            
        }
        else
        {
            include 'kayit_form.php';
        }    
        
        if(isset($_REQUEST['randevu']))
        {
            $Randevu=$_REQUEST['randevu'];
            $Yonlendirme=mysql_real_escape_string($_REQUEST['yonlendiren']);
            $Iptal=$_REQUEST['iptal'];
            //$Iptal= ($Iptal=="EVET" ? "E":"H");

            //echo $Yonlendirme;
            //$Ucret=$_REQUEST['ucret'];
            //$KDV=$_REQUEST['kdv'];
            /*$Kredi_K=$_REQUEST['kredi'];
            $Kredi_K= ($Kredi_K=="Evet" ? "E":"H");*/                           
            $Tarih=$_REQUEST['tarih'];
            //echo $Tarih;
            $Saat=$_REQUEST['saat'];

            /*if($Kredi_K=="H")
            {
            $Para_Uzman=$Ucret*0.3;
            }                       */
            $Secilen=$_COOKIE['secilen'];
            include 'db.php';
            mysql_select_db($VT,$Baglanti);
            $Ekleme_Sorgusu="INSERT INTO $Secilen (Randevu, Iptal, Yonlendirme, Tarih, Saat) VALUES ('$Randevu','$Iptal','$Yonlendirme','$Tarih','$Saat')";
            $Sonucum=mysql_query($Ekleme_Sorgusu);
                if ($Sonucum)
                {
                    echo  "<div style=text-align:center> RandevuBaşarıyla kaydedildi</div>";
                    echo "<script> alert(' RANDEVU KAYDEDİLDİ ')</script>";
                }
                else {
                    echo "Hata".mysql_error();

                }
                mysql_close($Baglanti);
            
        }                        
        ?>

                </td>
            </tr>
        </table>
        
       
        
    </body>
</html>
