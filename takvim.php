<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
<link href="calendar.css" type="text/css" rel="stylesheet" />
<style type="text/css">
    .secilen_uzman_takvim {
        text-align:center;
        background:#333;
        color:white;
        padding:4px;
        border-radius:4px;        
    }
</style>

</head>
<body>
<?php
//Mysql Kısmı
include 'db.php';
mysql_select_db($VT);
if (isset($_COOKIE['secilen']))
{
    $Secilen=$_COOKIE['secilen'];
    echo "<div class=secilen_uzman_takvim>".$Secilen."</div>";
}

$time = time();
$numDay = date('d', $time);
//echo $numDay;
$numMonth = date('m', $time);
$strMonth = date('F', $time);
$numYear = date('Y', $time);
$firstDay = mktime(0,0,0,$numMonth,1,$numYear);
$daysInMonth = cal_days_in_month(0, $numMonth, $numYear);
$dayOfWeek = date('w', $firstDay);
if (isset($Secilen))
{
    $Sorgu_Randevular="SELECT * FROM $Secilen";
    $Sonuclar=  mysql_query($Sorgu_Randevular);
    $Sayac=0;
        while($Satir=  mysql_fetch_array($Sonuclar))
            {
                $Tarih=$Satir['Tarih'];
                //echo $Tarih."*";
                $Gunu_Bul=  explode("-", $Tarih);
                //echo $Gunu_Bul[1]."*";            

                if($Gunu_Bul[1]==$numMonth)
                {
                   $Indis[$Sayac]=$Gunu_Bul[2];                                            
                   $Sayac++;
                   //echo $Sayac;
                }

            }
}
?>
    <table class="takvim">
<caption><?php echo($strMonth); ?></caption>
<thead>
<tr>
<th abbr="Pazar" scope="col" title="Pazar">P</th>
<th abbr="Pazartesi" scope="col" title="Pazartesi">P</th>
<th abbr="Salı" scope="col" title="Salı">S</th>
<th abbr="Çarşamba" scope="col" title="Çarşamba">Ç</th>
<th abbr="Perşembe" scope="col" title="Perşembe">P</th>
<th abbr="Cuma" scope="col" title="Cuma">C</th>
<th abbr="Cumartesi" scope="col" title="Cumartesi">C</th>

</tr>
</thead>
<tbody>
<tr>
<?php
    if(0 != $dayOfWeek) 
    { 
        echo('<td colspan="'.$dayOfWeek.'"> </td>');         
    }
    for($i=1;$i<=$daysInMonth;$i++) 
    {

        if($i == $numDay) 
        { 
            echo('<td id="today">');     
        } 
        else 
        { 
            echo("<td>");     
        }        
        if (isset($Secilen))
        {
            $Key=  in_array($i,$Indis);
            if($Key)
            {
                echo "<a href=Randevu_Saatler.php?saat=$numYear-$numMonth-$i class=randevu>$i</a>";   
            }
            else
            {
                echo $i;        
            }
        }
        else {
            echo $i;
        }
        echo("</td>");

        if(date('w', mktime(0,0,0,$numMonth, $i, $numYear)) == 6) 
        {
            echo("</tr><tr>");
        }
    }
?>
</tr>
</tbody>
</table>
</body>
</html>