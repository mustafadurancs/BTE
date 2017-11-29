<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="stiller.css"/>
        <script src="kontrol.js"></script>
    </head>
    <body>
        <div id="kayit_form">
            <form method="post" action="sekreter_ekran.php" name="kayit" onsubmit="return validateForm('kayit')">
                <table align="center">
                    <tr>
                        <td> Adı ve Soyadı : </td>
                        <td><input type="text" name="randevu"/></td>
                    </tr>
                    <tr>
                        <td> İptal mi? : </td>
                        <td>
                            <select name="iptal">
                                <option value="H">HAYIR</option>
                                <option value="E">EVET</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Bağlanma Terapisi :</td>
                        <td> 
                            <select name="yonlendiren">                                
                        <?php
                            include 'db.php';                        
                            mysql_select_db("$VT");
                            $Sorgu_Listele="SELECT * FROM supervisor";
                            $Sonuclar=  mysql_query($Sorgu_Listele); 
                                
                                while($Satir = mysql_fetch_array($Sonuclar))
                                    {                                        
                                        $SuperVis=$Satir['isim'];
                                        echo "<option size=40 value='".$Satir['isim']."'>".$SuperVis. "</option>";
                                    }   
                        ?>     
                        <option value="Yok">Yok</option>        
                        </select>        
                        </td>    
                    </tr>
                    <tr>
                        <td>Tarih :</td>
                        <td>
                            <input type="date" name="tarih"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Saat :</td>
                        <td>
                            <select name="saat">
                                <?php
                                for ($i=9;$i<22;$i++)
                                {
                                    $Bir=$i.":00";
                                    $Iki=$i. ":30";
                                    echo "<option value='".$Bir."'>" .$Bir. "</option>";
                                    echo "<option value='".$Iki."'>" .$Iki. "</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td> &nbsp;</td>
                        <td><input type="submit" value="Kaydet"/></td>
                    </tr>
                
                </table>
            </form>
            
        </div>
    </body>
</html>
