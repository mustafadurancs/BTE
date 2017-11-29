<?php
    if(isset($_GET['hangisi']))
    {
        include '../db.php';
        mysql_select_db($VT,$Baglanti);
        $Secilen_Uzman_Update=$_GET['hangisi'];
        //echo $Secilen_User;
        $Secilen_Uzman_Sorgu="SELECT * FROM uzmanlar WHERE id='$Secilen_Uzman_Update'";
        $Sonuc_tek=  mysql_query($Secilen_Uzman_Sorgu);
        $Satir_tek=  mysql_fetch_array($Sonuc_tek);
        $Butun_Uzmanlar="SELECT * FROM uzmanlar WHERE sil=0";
    
    
?>
<form method="post" action="admin.php">
        <table align="center">
            <caption>Uzman Süpervizör Oranları</caption>
            <tr>
                <input type="text" name="idsi" value="<?php echo $Satir_tek['id']?>" hidden="hidden"/>
                <input type="text" name="uzman_sec" value="<?php echo $Satir_tek['uzman_isim']?>" hidden="hidden"/>
                <td> Uzman Adı:</td> 
            <td><input type="text" name="uzmanimiz" value="<?php echo $Satir_tek['uzman_isim']?>" disabled="disabled"/></td>
            </tr>
            <tr>
                <td colspan="2"><h3>SÜPERVİZÖR OLDUĞUNDA YÜZDESİ</h3></td>
                
            </tr>
                <?php
                    $Sonuc=  mysql_query($Butun_Uzmanlar);                
                    $id_ler_isimler=fopen("id_ler_isimler.txt","w"); 
                    
                    while($Satir=  mysql_fetch_array($Sonuc))
                    {
                       $uzman_ID=$Satir['id'];
                       $uzman_isim=$Satir['uzman_isim'];                       
                                                                    
                       if($Satir_tek['id']!=$uzman_ID)
                       {
                       fwrite($id_ler_isimler,$uzman_ID.";".$uzman_isim.",");
                       echo "<tr>";
                       echo "<td>$uzman_isim :</td>";
                       ?>
                       <td><input type="number" min="1" max="99" name="id[]"/></td>
                       <?php
                       echo "</tr>";
                       }
                                              
                    }
                    fclose($id_ler_isimler);
                ?>
            <tr>
                <td> &nbsp;</td>
                <td><input type="submit" value="KAYDET"/></td>
            </tr>
        </table>
     </form>
<?php                                                
mysql_close($Baglanti);
}
?>    
                
           