<?php
include "../config.php";
include "session.php";
$sql_avatar = "SELECT name,Avatar from users WHERE username ='".$_SESSION["username"]."'";
$result_avatar = mysqli_query($link,$sql_avatar);
$row_avatar = mysqli_fetch_array($result_avatar);
$image_src = $row_avatar['Avatar'];
$Name = $row_avatar['name'];

function getCapitals(string $name): string
{
    $capitals = '';
    $words = preg_split('/[\s-]+/', $name);
    $words = [array_shift($words), array_pop($words)];
    foreach ($words as $word) {
        if (ctype_digit($word) && strlen($word) == 1) {
            $capitals .= $word;
        } else {
            $first = substr($word, 0, 1);
            $capitals .= ctype_digit($first) ? '' : $first;
        }
    }
    return strtoupper($capitals);
}

function getColor(string $name): string
{
    // level 600, see: materialuicolors.co
    $colors = [
        '#e53935', // red
        '#d81b60', // pink
        '#8e24aa', // purple
        '#5e35b1', // deep-purple
        '#3949ab', // indigo
        '#1e88e5', // blue
        '#039be5', // light-blue
        '#00acc1', // cyan
        '#00897b', // teal
        '#43a047', // green
        '#7cb342', // light-green
        '#c0ca33', // lime
        '#fdd835', // yellow
        '#ffb300', // amber
        '#fb8c00', // orange
        '#f4511e', // deep-orange
        '#6d4c41', // brown
        '#757575', // grey
        '#546e7a', // blue-grey
    ];
    $unique = hexdec(substr(md5($name), -8));
    return $colors[$unique % count($colors)];
}

$Color=getColor($Name);
$Initials = getCapitals($Name);	
	echo'<div class="initials-avatar large" style="background: '.$Color.';">'.$Initials.'</div>';

?>