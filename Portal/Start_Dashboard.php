<?php
require_once "../config.php";
require_once "session.php";

    $Trainer = $_REQUEST["Trainer"];
    echo'<div class="überschrift"><b>Singlechoice</b> </div> <div class="überschrift"><b>Total</b></div> <div class="überschrift"><b>Trend</b> </div>';
    include "Fragen_Startseite.php";
    questions("Singlechoice", $link, $Trainer);
    echo'<div class="überschrift"><b>Multiplechoice</b></div><div class="überschrift"><b>Häufigste</b></div> <div class="überschrift"><b>Seltenste</b> </div>';
    questions("Multiplechoice", $link, $Trainer);
    echo'<div class="überschrift"><b>Schieberegler</b> </div> <div class="überschrift"><b>Total</b></div> <div class="überschrift"><b>Trend</b> </div>';
    questions("Schieberegler", $link, $Trainer);
?>