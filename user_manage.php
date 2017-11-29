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
            .yeni_user {
                width:90%;
                background: navy;
                border-radius:4px;
                padding: 8px;
                margin: 5px auto;
                text-align:center;
            }
        </style>
    </head>
    <body>
        <?php
        include 'db.php';
        mysql_select_db($VT,$Baglanti);
        $User_Listele="SELECT * FROM users";
        $Sonuc=  mysql_query($User_Listele);
        echo"<table id=tablo_users cellspacing=0><tr>";
        echo "<th>Kullanıcı Adı</th><th>Şifresi</th><th>Yetkisi</th> <th> Güncelleme</th><th>Silme</th>";
        while($Satir=mysql_fetch_array($Sonuc))
        {
            echo "<tr>";
            $User=$Satir['user'];
            echo "<td>".$Satir['user']."</td><td>".$Satir['password']."</td><td>".$Satir['role']."</td><td><a style=color:navy href=admin.php?hangi_user=$User >Güncelle</a></td><td><a style=color:navy href=admin.php?silinecek=$User >Sil</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<div class=yeni_user><a href=admin.php?ekle=EVET> Yeni Kullanıcı Ekle</a></div>";
        mysql_close($Baglanti);
        ?>
        <?php
            if(isset($_REQUEST['user']))
            {
                include 'db.php';
                mysql_select_db($VT,$Baglanti);
                $Kullanici_Adi=$_REQUEST['user'];
                $Sifresi=$_REQUEST['sifre'];
                $Yetkisi=$_REQUEST['rol'];

                $User_Ekleme_Sorgu="INSERT INTO users (user,password,role) VALUES ('$Kullanici_Adi','$Sifresi','$Yetkisi')";                            
                $Sonuc=mysql_query($User_Ekleme_Sorgu);
                            
                if($Sonuc==FALSE)
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
            include 'db.php';
            mysql_select_db($VT,$Baglanti);
            if(isset($_REQUEST['ilk_user']))
            {
                $Eski_User=$_REQUEST['ilk_user'];
                //$Yeni_User=$_REQUEST['user'];
                $Yeni_Password=$_REQUEST['sifre'];
                $Guncelleme_Sorgu="UPDATE users SET password='$Yeni_Password' WHERE user='$Eski_User' ";
                $Sonuc=  mysql_query($Guncelleme_Sorgu);
                if($Sonuc==FALSE)
                {
                    echo "Hata!!! : ".mysql_error();
                }
                else
                {
                    echo "<script>alert('Kullanıcı adı - Şifre Güncellendi')</script>";
                    //sleep(1);
                    header('location:admin.php');
                }
                mysql_close($Baglanti);
            }
        ?>    
    </body>
</html>
