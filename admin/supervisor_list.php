
<?php
/**
 * Created by PhpStorm.
 * User: mustafaduran
 * Date: 24.12.2015
 * Time: 23:54
 */
include '../db.php';
mysql_selectdb($VT,$Baglanti);
$Sonuc_IDler=mysql_query("SELECT * FROM uzmanlar");
echo "<ul>";
$Satir_Sayisi=mysql_num_rows($Sonuc_IDler);
while($Satir=mysql_fetch_array($Sonuc_IDler))
{
    $Dosya_Adi=$Satir['id'].".txt";


    if(!file_exists($Dosya_Adi))
    {
        echo "<li style='background: red'>".$Satir['uzman_isim']. "  için süperzivör bilgileri girilmemiş "."</li>";
    }
    else
    {
        $Dosyamiz=fopen($Dosya_Adi,"r");
        echo "<li style='background: black'>".$Satir['uzman_isim']. "  Süperzivör Bilgileri: "."</li>";
        echo "<ul style='list-style:circle inside'>";
        for ($i=1;$i<$Satir_Sayisi;$i++)
        {
            $Row=fgets($Dosyamiz);
            $Bilgiler=explode(";",$Row);
            if (isset($Bilgiler[0])) {
                echo "<li>" . $Bilgiler[1] . " = " . $Bilgiler[2] . "</li>";
            }

        }
        echo "</ul>";
    }
}
echo "</ul>";
?>

</div>