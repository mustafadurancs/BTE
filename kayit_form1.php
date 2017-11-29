<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="stiller.css"/>
    </head>
    <body>
        <div id="kayit_form">
            <form method="post" action="deneme.php">
                <table align="center">
                    <tr>
                        <td> Adı ve Soyadı : </td>
                        <td><input type="text" name="randevu"/></td>
                    </tr>
                    <tr>
                        <td> İptal mi? : </td>
                        <td>
                            <select name="iptal">
                                <option>Evet</option>
                                <option>Hayır</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Yönlendiren Kişi :</td>
                        <td> 
                            <select name="yonlendiren">
                        <?php
                        
                            mysql_connect("localhost","root","") or die("Bağlantı Hatası".mysql_error());
                            mysql_select_db("danisman");
                            $Sorgu_Listele="SELECT * FROM supervisor";
                            $Sonuclar=  mysql_query($Sorgu_Listele); 
                                
                                while($Satir = mysql_fetch_array($Sonuclar))
                                    {                                        
                                        $SuperVis=$Satir['isim'];
                                        echo "<option value=$SuperVis> $SuperVis </option>";
                                    }   
                        ?>                
                        </select>        
                        </td>    
                    </tr>
                    <tr>
                        <td>Ücret :</td>
                        <td> <input type="number" name="ucret"/></td> 
                    </tr>
                    <tr>
                        <td> KDV : </td>
                        <td> <input type="number" name="kdv"/> </td>
                    </tr>
                    <tr>
                        <td> Kredi Kartı ? :</td>
                        <td>
                            <select name="kredi">
                                <option>Evet</option>
                                <option>Hayır</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Tarih :</td>
                        <td><input type="date" name="tarih"/></td>
                    </tr>
                    <tr>
                        <td>Saat :</td>
                        <td><input type="time" name="saat"/></td>
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
