<div id="uzman_sec">
        <form method="post" action="sekreter_ekran.php">
            <table align="center">
                <caption>UZMAN SEÇ</caption>
                <tr>
                    <td>
                        <select name="uzmanlar">
                        <?php
                        if(isset($_SESSION['kullanicimiz']))
                        {
                            mysql_connect("localhost","root","") or die("Bağlantı Hatası".mysql_error());
                            $result=  mysql_list_tables("danisman");
                            mysql_query("SET NAMES UTF8");
                            $Satir_Sayisi=mysql_num_rows($result); 
                                for($i=0;$i<$Satir_Sayisi;$i++)
                                    {
                                        $Uzman=  mysql_tablename($result, $i);
                                        if(!($Uzman=="users" or $Uzman=="supervisor" ))
                                        {
                                        echo "<option value=$Uzman> $Uzman </option>";
                                        }
                                    }   
                        }
                        else
                        {header('location:index.php');}                        
                        ?>        
                        </select>        
                    </td>
                </tr>
                <tr>
                    <td> <input type="submit" class="dugme" value="SEÇ"/></td>
                </tr>
            </table>

        </form>
        </div>