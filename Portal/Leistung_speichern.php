<script>
function speichern(Id){
var Leistung = document.getElementById("Leistung_"+Id).value;
var xmlhttp = new XMLHttpRequest();
xmlhttp.open("GET", "Leistung_database_update.php?Id=" + Id + "&Leistung=" + Leistung, true);
xmlhttp.send();

}

function entfernen(Id){
var Leistung = document.getElementById("Leistung_"+Id).value;
var xmlhttp = new XMLHttpRequest();
xmlhttp.open("GET", "Leistung_entfernen.php?Id=" + Id + "&Leistung=" + Leistung, true);
xmlhttp.send();

}
</script>