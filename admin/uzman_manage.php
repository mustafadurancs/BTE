<?php
ob_start();
?>
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
        <style type="text/css">
            .yeni_uzman {
                width:50%;
                background: navy;
                border-radius:0px 0px 8px 8px;
                padding: 8px;
                margin:auto;
                margin-top:0px;
                text-align:center;
            }
            .baslik {
                width:50%;
                background: navy;
                border-radius:8px 8px 0px 0px;
                padding: 8px;
                margin:auto;
                margin-top:0px;
                text-align:center;
                color:white;
            }
        </style>        
    </head>
    <body>
        <?php
        include '../db.php';
        mysql_select_db($VT,$Baglanti);
        $Uzman_Listele="SELECT * FROM uzmanlar";
        $Sonuc=  mysql_query($Uzman_Listele);
        echo "<div class=baslik>- Uzman Ekleme / Silme / Düzenleme -</div>";
        echo"<table id=tablo_users cellspacing=0><tr>";
        echo "<th>Uzman Adı</th><th>Uzman ID</th><th>Gizle</th><th>Kurum Yüzde</th><th>Ortak1 Yüzde</th><th>Ortak2 Yüzde</th><th>Ortak3 Yüzde</th><th> Güncelle</th><th>Sil</th>";
        while($Satir=mysql_fetch_array($Sonuc))
        {
            echo "<tr>";
            $Uzman_ID=$Satir['id'];
            echo "<td style=white-space:nowrap>".$Satir['uzman_isim']."</td>";
            echo "<td>".$Satir['id']."</td>";
            echo "<td>".$Satir['sil']."</td>";
            echo "<td>".$Satir['yuzde']."</td>";
            //echo "<td>".$Satir['supervisor_yuzde']."</td>";
            echo "<td style=border-bottom:double solid navy>".$Satir['ortak1_yuzde']."</td>";
            echo "<td style=border-bottom:double solid navy>".$Satir['ortak2_yuzde']."</td>";
            echo "<td style=border-bottom:double solid navy>".$Satir['ortak3_yuzde']."</td>";
            echo "<td><a style=color:navy href=admin.php?hangi_uzman=$Uzman_ID >Güncelle</a>";
            echo "</td><td><a style=color:navy href=admin.php?silinecek_uzman=$Uzman_ID >Sil</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<div class=yeni_uzman><a href=admin.php?uzman_ekle=EVET> Yeni Uzman Ekle</a></div>";
        mysql_close($Baglanti);
        ?>
        <?php
            //UZMAN EKLEME
            if(isset($_REQUEST['uzman_ekle']))
            {
                include '../db.php';
                mysql_select_db($VT,$Baglanti);
                $Uzman_Adi=$_REQUEST['uzman_ekle'];
                $Uzman_Id=$_REQUEST['uzman_id_ekle'];
                $Uzman_User=$_REQUEST['uzman_user_ekle'];
                $Uzman_Password=$_REQUEST['uzman_sifre_ekle'];
                $Uzman_Yuzde=$_REQUEST['yuzdesi'];
                $Orta1_Yuzde=$_REQUEST['ortak1'];
                $Orta2_Yuzde=$_REQUEST['ortak2'];
                $Orta3_Yuzde=$_REQUEST['ortak3'];

                $Dosya_Adi=$Uzman_Id.".txt";
                fopen($Dosya_Adi,"w");
                $User_Ekleme_Sorgu="INSERT INTO uzmanlar (uzman_isim,id,yuzde,ortak1_yuzde,ortak2_yuzde,ortak3_yuzde) VALUES ('$Uzman_Adi','$Uzman_Id','$Uzman_Yuzde','$Orta1_Yuzde','$Orta2_Yuzde','$Orta3_Yuzde')";
                $Sonuc=mysql_query($User_Ekleme_Sorgu);

                $Sonuc_User=mysql_query("INSERT INTO users (role,user,password,id) VALUES ('uzm','$Uzman_User','$Uzman_Password','$Uzman_Id')");

                if($Sonuc==FALSE OR $Sonuc_User)
                {                            
                    echo "Hata!!! : ".mysql_error();
                }
                else
                {
                    header('location:admin.php');
                }
                mysql_close($Baglanti);            
            }
        ?>
        <?php
            //UZMAN GÜNCELLEME
            include '../db.php';
            mysql_select_db($VT,$Baglanti);
            if(isset($_REQUEST['id']))
            {
                $Uzman_Id=$_REQUEST['id'];
                //$Yeni_User=$_REQUEST['user'];
                $Yeni_Uzman_Ismi=$_REQUEST['uzman'];
                $Yeni_Yuzde=$_REQUEST['yuzde'];
                $Yeni_Ortak1_Yuzde=$_REQUEST['ortak1'];
                $Yeni_Ortak2_Yuzde=$_REQUEST['ortak2'];
                $Yeni_Ortak3_Yuzde=$_REQUEST['ortak3'];
                $Guncelleme_Sorgu="UPDATE uzmanlar SET Uzman_isim='$Yeni_Uzman_Ismi',yuzde='$Yeni_Yuzde',ortak1_yuzde='$Yeni_Ortak1_Yuzde',ortak2_yuzde='$Yeni_Ortak2_Yuzde',ortak3_yuzde='$Yeni_Ortak3_Yuzde' WHERE id='$Uzman_Id' ";
                $Sonuc=  mysql_query($Guncelleme_Sorgu);
                if($Sonuc==FALSE)
                {
                    echo "Hata!!! : ".mysql_error();
                }
                else
                {
                    echo "<script>alert('Uzman İsmi Değiştirildi')</script>";
                    //sleep(1);
                    header('location:admin.php');
                }
                mysql_close($Baglanti);
            }
        ?>  
    </body>
</html>
