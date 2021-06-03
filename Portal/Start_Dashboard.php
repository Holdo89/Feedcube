<?php
require_once "../config.php";
require_once "session.php";

    $Trainer = $_REQUEST["Trainer"];
    echo'<div class="überschrift_start"><b>Singlechoice</b> </div> <div class="überschrift_start"><b>Total</b></div> <div class="überschrift_start"><b>Trend</b> </div>';
    include "Fragen_Startseite.php";
    questions("Singlechoice", $link, $Trainer);
    echo'<div class="überschrift_start"><b>Multiplechoice</b></div><div class="überschrift_start"><b>Häufigste</b></div> <div class="überschrift_start"><b>Seltenste</b> </div>';
    questions("Multiplechoice", $link, $Trainer);
    echo'<div class="überschrift_start"><b>Schieberegler</b> </div> <div class="überschrift_start"><b>Total</b></div> <div class="überschrift_start"><b>Trend</b> </div>';
    questions("Schieberegler", $link, $Trainer);
?>