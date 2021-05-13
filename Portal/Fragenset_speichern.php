<script>

function fragenset_speichern(Id){
var Fragenset = document.getElementById("Fragenset_"+Id).value;
var xmlhttp = new XMLHttpRequest();
xmlhttp.open("GET", "Fragenset_database_update.php?Id=" + Id + "&Fragenset=" + Fragenset, true);
xmlhttp.send();
}

function fragenset_entfernen(Id){
var Fragenset = document.getElementById("Fragenset_"+Id).value;
var xmlhttp = new XMLHttpRequest();
xmlhttp.open("GET", "Fragenset_entfernen.php?Id=" + Id + "&Fragenset=" + Fragenset, true);

xmlhttp.send();

}

</script>