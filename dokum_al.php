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
    </head>
    <body>
        <?php
            $Secilen_Uzman=$_GET['kim'];
            include 'db.php';
            mysql_select_db($VT,$Baglanti);
            include 'Tablo_Goster.php';
            Tablo_Goster($Secilen_Uzman, "mhsb");
            echo "<div style=text-align:center><a href=admin\admin.php> GERİ DÖN </a></div>";
        ?>
    </body>
</html>
