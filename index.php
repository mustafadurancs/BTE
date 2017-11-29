<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="stiller.css"/>
        <style type="text/css">
               h1{
                   text-align: center;
                   margin-top: 100px;;
                   margin-bottom: -130px;
               }
        </style>
    </head>
    <body class="arkaplan_login">
        <h1>BAĞLANMA TERAPİSİ GİRİŞ EKRANI</h1>
        <div id="login">
        <form method="post" action="index.php">
            <table border="0">
                <tr>
                    <td class="saga_yasla"><label>Kullanıcı Adı :</label></td>
                    <td><input type="text" name="kullanici"/></td>
                </tr>
                <tr>
                    <td class="saga_yasla"><label>Şifre :</label></td>
                    <td><input type="password" name="sifre"/></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right"><input type="submit" value="Giriş" class="login_dugme"/></td>
                </tr>                                                                                    
            </table>                     
        </form>
        </div>
        <?php
        session_start();
        include ('db.php');
		
        if(isset($_REQUEST['kullanici']))
        {
            $User_Name=$_REQUEST['kullanici'];
            $Password=$_REQUEST['sifre'];

            $User_Name =  stripcslashes($User_Name);
            $User_Name = mysql_real_escape_string($User_Name);
            $Password =  stripcslashes($Password);
            $Password = mysql_real_escape_string($Password);            
            
            mysql_select_db($VT,$Baglanti);
            $Sorgumuz = "SELECT * FROM users WHERE user = '$User_Name' AND password='$Password'";
            $Sonuc = mysql_query($Sorgumuz);
            $Sayi=mysql_num_rows($Sonuc); 
            $Satir=mysql_fetch_array($Sonuc);
            $Rolu= $Satir['role'];
            echo $Satir['role'];
                if($Sayi==1)
                    {
                        $_SESSION['kullanicimiz'] = $User_Name;
                        $_SESSION['sifre_icin'] = $Password;
                        $_SESSION['rolu']=$Rolu;
						echo "session: ".$_SESSION['rolu'];
                        if($Rolu=="sktr")
                        {
                           header ('location:sekreter\sekreter_ekran.php'); 
                        }
                        elseif ($Rolu=="mhsb")
                        {
                            header ('location:muhasebe\muhasebe_ekran.php');
                        }
                        elseif ($Rolu=="admin")
                        {
                            header ('location:admin\admin.php');
                        }
                        elseif ($Rolu=="uzm")
                        {
                           header('location:uzman\uzman_ekran.php');
                        }
			else
			{
                            echo "SAYFA BULUNAMADI";
			}
                        
                    }
                else
                    {
                        echo '<div id="mesaj">'. "Kullanıcı adı ya da şifre yanlış!!!".'</div>' ;		
                    }
        }
        ?>
    </body>
</html>
