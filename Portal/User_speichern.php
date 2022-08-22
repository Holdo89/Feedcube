<script>

function speichern(Id){

var User = document.getElementById("User_"+Id).value;

var Username = document.getElementById("Username_"+Id).value;

var Email = document.getElementById("Email_"+Id).value;

var xmlhttp = new XMLHttpRequest();

xmlhttp.open("GET", "User_database_update.php?Id=" + Id + "&User=" + User + "&Username=" + Username + "&Email=" + Email, true);

xmlhttp.send();



}



function entfernen(Id){

var xmlhttp = new XMLHttpRequest();

xmlhttp.open("GET", "User_entfernen.php?Id=" + Id, true);

xmlhttp.send();



}

</script>