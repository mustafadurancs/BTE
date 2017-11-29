
        <?php
        function Uzmanlar_Listele($Linki1,$Linki2)
        {        
            if(!isset($Css))
            {
                $Css="uzmanlar";
            }
            include('../db.php');                
            mysql_select_db($VT,$Baglanti);
            $Uzman_Listele_Sorgu="SELECT * FROM uzmanlar WHERE sil=0";
            $Sonuc=  mysql_query($Uzman_Listele_Sorgu);        
        ?>
        
        <div id="uzmanlar">
        <h1> ..::: UZMAN LİSTESİ :::.. </h1>
        <nav>
            <?php 
            while($Satir=  mysql_fetch_array($Sonuc))
            {                                
                $Uzmanid=$Satir['id'];
                $Uzman=$Satir['uzman_isim'];
                
            ?>    
                <a href="<?php echo $Linki1."?$Linki2=".$Uzmanid?>"> <?php echo $Uzman ?> </a>                                                     
            <?php
            }
            
            ?>
        </nav>
        </div>
        <?php
            mysql_close($Baglanti);
        }
        ?>

