<script>
function speichern(Id){
var Umfrage = document.getElementById("Umfrage_"+Id).value;
var xmlhttp = new XMLHttpRequest();
xmlhttp.open("GET", "Umfrage_database_update.php?Id=" + Id + "&Umfrage=" + Umfrage, true);
xmlhttp.send();

}

function entfernen(Id){
    var Umfrage = document.getElementById("Umfrage_"+Id).value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "Umfrage_entfernen.php?Id=" + Id + "&Umfrage=" + Umfrage, true);
    xmlhttp.send();
}
</script>