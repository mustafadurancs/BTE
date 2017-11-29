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
        <link rel="stylesheet" type="text/css" href="stiller.css"/>
        <style type="text/css">
        
        .bslk{
            background: darkblue;    
        }
        </style>
        
    </head>
    <body>
        <div id="supervis_form"> 
        <?php
        
        include ('db.php');
        mysql_select_db($VT);            
            $Listele= "SELECT * FROM supervisor";
            $Sonuc = mysql_query($Listele);
       
            echo "<table align='center'>";
            echo "<caption> SÜPERVİZÖR LİSTESİ </caption>";
            echo "<tr>";
            echo "<th class=bslk>Adı Soyadı</th>";
            echo "<th class=bslk>Yüzde Miktarı</th>";
            echo "<th class=bslk>Kurum Yüzdesi</th>";             
            echo "</tr>";    
            
            while ($Satir = mysql_fetch_array($Sonuc))	
            {
                echo "<tr>";
                echo "<td>".$Satir['isim']."</td>";
                echo "<td>".$Satir['yuzde']."</td>";
                echo "<td>".$Satir['kurum']."</td>";
                echo "</tr>";
            }
        echo "</table>";
        mysql_close($Baglanti);
        ?>
        </div>   
        <?php 
        if (isset($_REQUEST['isim']))
        {
            
            
            if(isset($_REQUEST['isim']))
            {
                $SuperVisor_Isim=$_REQUEST['isim'];
                $SuperVisor_Yuzde=$_REQUEST['yuzde']; 
                mysql_select_db($VT,$Baglanti) or die("Hata".mysql_error());
                mysql_query("SET NAMES UTF8");
                $Kayit_Ekle="INSERT INTO supervisor (isim,yuzde) VALUES ('$SuperVisor_Isim','$SuperVisor_Yuzde')";
                if(mysql_query($Kayit_Ekle))
                {
                    echo "OK";
                }
                else {
                    echo "HATA:".mysql_error();
                }
            }            
            
        }
        else 
        {            
            include ('supervisor_form.html');
        }
        echo "<div style=text-align:center><a href=muhasebe_ekran.php> GERİ DÖN </a></div>";
        ?>
    </body>
</html>
