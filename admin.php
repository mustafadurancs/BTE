<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="admin.css"/>
    </head>
    <body>
        <table id="tablo_cerceve">
            <caption>..::: YÖNETİM PANELİ :::..</caption>
            <tr> 
                <?php
                session_start();
                ob_start();

                if(isset($_SESSION['kullanicimiz']) && $_SESSION['rolu']=="admin")
                {
                    echo "<td width=40% valign=top>";
                        echo "<ul>";
                            echo "<li><a href=admin.php?sayfa=users>Kullanıcı Girişi Yönetimi</a> </li>";
                            echo "<li><a href=admin.php?sayfa=uzmanlar>Uzman Ekleme / Yönetme</a></li> ";
                            echo "<li><a href=admin.php?sayfa=randevular>Randevu Dökümü</a> </li>";
                            echo "<li><a href=cikis_yap.php> Çıkış</a> </li>";
                        echo "</nul>";
                    echo "</td>";
                    
                }
                else
                {
                    header('Location:index.php');
                }
                ?>
                <td valign="top">
                    <?php
                    if(isset($_GET['sayfa']))
                    {
                        $Hangi_Sayfa=$_GET['sayfa'];
                        if($Hangi_Sayfa=="users")
                        {
                            include ('user_manage.php');
                                                        
                        }
                        elseif($Hangi_Sayfa=="uzmanlar")
                        {
                            echo "UZMANLAR";
                        }
                        elseif($Hangi_Sayfa=="randevular")
                        {
                            include 'uzmanlar.php';
                            Uzmanlar_Listele("dokum_al.php");
                        }                                                                       
                    }
                    if(isset($_GET['hangi_user']))
                    {
                        include 'db.php';
                        mysql_select_db($VT,$Baglanti);
                        $Secilen_User=$_GET['hangi_user'];
                        //echo $Secilen_User;
                        $Secilen_User_Sorgu="SELECT * FROM users WHERE user='$Secilen_User'";
                        $Sonuc=  mysql_query($Secilen_User_Sorgu);
                        $Satir=  mysql_fetch_array($Sonuc);
                    ?>
                        <form method="post" action="user_manage.php">
                            <table> 
                                <tr>
                                    <td> Kullanıcı Adı:</td> <input type="text" name="ilk_user" value="<?php echo $Satir['user']?>" hidden="hidden"/>
                                <td><input type="text" name="user" value="<?php echo $Satir['user']?>" disabled="disabled"/></td>
                                </tr>
                                <tr>
                                    <td>Şifre:</td>
                                    <td><input type="text" name="sifre" value="<?php echo $Satir['password']?>" /></td>
                                <tr/>
                                <tr>
                                    <td> &nbsp;</td>
                                    <td><input type="submit" value="Değiştir"/></td>
                                </tr>
                            </table>
                         </form>
                    <?php
                        
                        mysql_close($Baglanti);                    
                    }
                    
                    if(isset($_GET['silinecek']))
                    {
                        include 'db.php';
                        mysql_select_db($VT,$Baglanti);
                        $Silinecek_User=$_GET['silinecek'];
                        //echo $Secilen_User;
                        $Silinecek_User_Sorgu="DELETE FROM users WHERE user='$Silinecek_User'";
                        $Sonuc=  mysql_query($Silinecek_User_Sorgu);
                        if($Sonuc==FALSE)
                        {
                            echo "Hata!!! : " .mysql_error();
                        }
                        else
                        {
                            echo "<script>alert('Silindi')</script>";
                        }
                        mysql_close($Baglanti);
                    }
                        
                    ?>
                    <?php
                        if (isset($_GET['ekle']))
                        {
                    ?>
                        <form method="post" action="user_manage.php">
                            <table> 
                                <tr>
                                    <td>Kullanıcı Adı:</td>
                                    <td><input type="text" name="user"/></td>
                                <tr/>
                                <tr>
                                    <td>Şifre:</td>
                                    <td><input type="text" name="sifre" /></td>
                                <tr/>
                                <tr>
                                    <td>Yetkisi : </td>
                                    <td>
                                        <select name="rol">
                                            <option value="sktr"> SEKRETER</option>
                                            <option value="mhsb"> MUHASEBE</option>
                                            <option value="uzm"> UZMAN</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td> &nbsp;</td>
                                    <td><input type="submit" value="Kaydet"/></td>
                                </tr>
                            </table>
                         </form>
                    <?php
                    }
                    ?>
                    
                </td>
            </tr>
        </table>
    </body>
</html>
