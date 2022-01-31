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

function speichern_intern(Id){
    var Frage = document.getElementById("Frage_"+Id).value;
    var Fragentyp = document.getElementById("Auswahl_Fragentyp_"+Id).value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "interne_Frage_database_update.php?Id=" + Id + "&Frage=" + Frage + "&Fragentyp=" + Fragentyp, true);
    xmlhttp.send();
}

function entfernen_intern(Id){
var xmlhttp = new XMLHttpRequest();
xmlhttp.open("GET", "interne_Frage_entfernen.php?Id=" + Id, true);
xmlhttp.send();
}

</script>