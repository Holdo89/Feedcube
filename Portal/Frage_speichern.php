<script>

function speichern(Id)
{
    var Überschrift = document.getElementById("Überschrift_"+Id).value;
    var Frage = document.getElementById("Frage_"+Id).value;
    var Fragentyp = document.getElementById("Auswahl_Fragentyp_"+Id).value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "Frage_database_update.php?Id=" + Id + "&Überschrift=" + Überschrift + "&Frage=" + Frage + "&Fragentyp=" + Fragentyp, true);
    xmlhttp.send();
}



function entfernen(Id){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "Frage_entfernen.php?Id=" + Id, true);
    xmlhttp.send();
}

function speichern_intern(Id){
    var Frage = document.getElementById("Frage_"+Id).value;
    var Fragentyp = document.getElementById("Auswahl_Fragentyp_"+Id).value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "interne_Frage_database_update.php?Id=" + Id + "&Frage=" + Frage + "&Fragentyp=" + Fragentyp, true);
    xmlhttp.send();
}

function Überschrift_entfernen(Id){
         
var xmlhttp = new XMLHttpRequest();
xmlhttp.open("GET", "Überschrift_entfernen.php?Id=" + Id, true);
xmlhttp.send();

}



function speichern_antwort(Id, typ){
    var Antwort = document.getElementById("Antwort_"+typ+"_"+Id).value;
    Antwort = Antwort.replace("&","%26");
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "Antwort_database_update.php?Id=" + Id + "&Antwort=" + Antwort + "&Typ="+ typ, true);
    xmlhttp.send();
}

function speichern_range(){
    var ID = document.getElementById("ID_extern_Schieberegler").value;
    var range_min = document.getElementById("Range_Min").value;
	var range_max = document.getElementById("Range_Max").value;
    var columns = 5;
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.open("GET", "Rangeslider_update.php?min=" + range_min + "&max=" + range_max + "&columns=" + columns + "&ID=" + ID, true);

    xmlhttp.send();

}


function entfernen_antwort(Id,Typ){

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "Antwort_entfernen.php?Id=" + Id + "&Typ=" + Typ, true);
    xmlhttp.send();
}

</script>