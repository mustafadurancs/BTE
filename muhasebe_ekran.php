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
            
            h1 {
                font-family: Verdana;
                font-size:16pt;
                letter-spacing: 6pt;
                text-align: center;
            }
            #menu_muhasebe {
                width:30%;
                background: lightgrey;
                border-radius: 20px;
                padding: 15px;
                margin: 80px auto 20px;                
            }
            
            #menu_muhasebe ul {
                background: lightslategray;
                border-radius: 15px;
                padding: 10px;
                list-style:none;
                padding: 10px;
            }
            
            #menu_muhasebe li {
                background: lightgray;
                border-radius: 10px;
                margin: 10px;
                padding: 5px;                                
             }
             #menu_muhasebe a:link {
                font-family: Verdana;
                font-size:14pt;
                text-decoration: none;
                color:black;
             }                                                    
        </style>
        
    </head>
    <body>
        
        <div id="menu_muhasebe">
        <h1> -- İŞLEMLER --</h1>    
            <ul>
                <li><a href="supervisor.php"> SÜPERVİZÖR YÜZDE GİR </a></li>                
                
                <li><a href=<?php echo 'muhasebe_ekran.php?uzman=deger';?>>UZMANLARI LİSTELE </a></li>            
            </ul>
        </div>
        <?php
        session_start();
        ob_start();
        if(isset($_SESSION['kullanici']) && $_SESSION['rolu']=="mhsb")
        {
            if(isset($_GET['uzman']))
            {
                include 'uzmanlar.php';
                Uzmanlar_Listele("dokum_al.php");
            }
        }
        else
        {
            header('location:index.php');
        }
        ?>

    </body>
</html>
