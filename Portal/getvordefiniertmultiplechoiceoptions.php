<?php
    require_once "../config.php";
    //$vordefiniert = $_REQUEST["vordefiniert"];
    $sql="SELECT COUNT(Answers) As Anzahl_Antworten FROM multiplechoice_answers WHERE Fragenspezifisch = 0  ORDER BY post_order_no ASC";
    $result_multi=mysqli_query($link,$sql);
    $rows_multi=mysqli_fetch_array($result_multi);

    $sql_colors="SELECT COUNT(Answers) As Anzahl_Antworten FROM multiplechoice_answers WHERE Fragenspezifisch = 0 ORDER BY post_order_no ASC";
    $result_multi_colors=mysqli_query($link,$sql_colors);
    $rows_multi_colors=mysqli_fetch_array($result_multi_colors);

    $i=0;
    $chartcolors = array();
    $bordercolors = array();
    $hslnumber = 0;
    $hslnumber_max = 360;
    if($rows_multi_colors["Anzahl_Antworten"]==0)
    {
        $colorsteps = 1000;  
    }
    else
    {
        $colorsteps = 360/$rows_multi_colors["Anzahl_Antworten"];
    }
    while($hslnumber <= 360){
        array_push($chartcolors,"hsl(".$hslnumber.", 75%, 85%, 0.2)");
        array_push($bordercolors,"hsl(".$hslnumber.", 75%, 50%, 0.8)");
        $hslnumber = $hslnumber + $colorsteps;
    }
    while($i<$rows_multi["Anzahl_Antworten"])
    {
        try{
            echo"{
                label: legende[".$i."],
                data: array2[".$i."],
                borderColor: [
                    '".$bordercolors[$i]."',
                ],
                backgroundColor: [
                    '".$chartcolors[$i]."',
                ]
            },";
            $i = $i+1;
        }
        catch(Exception $e){
            break;
        }
    }  
?>   