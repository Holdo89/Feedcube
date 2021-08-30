
	var fragenset_modal = document.getElementById("Fragenset_Modal");
	var modal = document.getElementById("myModal");

	function fragenset_abfrage_speichern(id) {
			fragenset_speichern(id);
	;}
	function fragenset_abfrage_löschen(id) {
  	if (confirm("Wollen Sie dieses Fragenset entfernen?"))
	  {fragenset_entfernen(id);
		alert("Das Fragenset wurde gelöscht");
		location.reload();}
	;}

	function user_abfrage_speichern(id) {
			speichern(id);
	;}
	function user_abfrage_löschen(id) {
  	if (confirm("Wollen Sie diese Leistung entfernen? Ihre bestehenden Antworten zu dieser Leistung werden ebenfalls entfernt"))
	  {entfernen(id);
		alert("Die Leistung wurde gelöscht");
		location.reload();}
	;}
	
	function display(id,type) {
        
		if(type=="fragenset")
		{
			fragenset_modal.style.display = "block";
			var div_id=document.getElementById("Fragenset_ID");
		}
		else
		{
			modal.style.display = "block";
			var div_id=document.getElementById("ID");
		}
		div_id.value=id;

		var xmlhttp1 = new XMLHttpRequest();

		xmlhttp1.onreadystatechange = function() {

		if (this.readyState == 4 && this.status == 200) {
		    console.log("outter rim")
			console.log(this.responseText);
			var checked_sets = this.response.split(";.,");
			var i=0;
			while (i<checked_sets.length){
				if(type=="fragenset"){
					var checkbox = document.getElementById('Fragenset_'+checked_sets[i]);
				}
				else
					var checkbox = document.getElementById(checked_sets[i]);

				checkbox.checked=false;	
				i=i+1;		
			}
			var xmlhttp = new XMLHttpRequest();

			xmlhttp.onreadystatechange = function() {

			if (this.readyState == 4 && this.status == 200) {
				var checked_sets = this.response.split(";.,");
				console.log("innerrim")
				console.log(checked_sets);
				var i=0;
				while (i<checked_sets.length){
					if(type=="fragenset")
					{
					    console.log("Hello");
						var checkbox = document.getElementById('Fragenset_'+checked_sets[i]);
					}
					else{
					    console.log("Hello2");
						var checkbox = document.getElementById(checked_sets[i]);
					    
					}checkbox.checked=true;	
					i=i+1;		
				}
			}
			};
			if(type=="fragenset")
			{
				xmlhttp.open("GET", "Fragenset_get_Fragenset_checked.php?ID=" + id, true);
			}
			else
			{
				xmlhttp.open("GET", "Leistung_get_Fragenset_checked.php?ID=" + id, true);
			}
			xmlhttp.send();
		}
		};
		xmlhttp1.open("GET", "Leistung_get_Fragenset.php?ID=" + id, true);	
		xmlhttp1.send();

	}
	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];
	var span_2 = document.getElementsByClassName("close")[1];
	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
  		modal.style.display = "none";
	}
	span_2.onclick = function() {
		fragenset_modal.style.display = "none";
	}
	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	if (event.target == modal || event.target == fragenset_modal ) {
		modal.style.display = "none";
		fragenset_modal.style.display = "none";
	}
	}

	function display_leistung() {
		var Fragenset_ID = Auswahl_Fragenset.value;

		var xmlhttp1 = new XMLHttpRequest();

		xmlhttp1.onreadystatechange = function() {

		if (this.readyState == 4 && this.status == 200) {
			var checked_sets = this.response.split(",");
			var i=0;
			while (i<checked_sets.length){
				var checkbox = document.getElementById(checked_sets[i]);

				checkbox.checked=false;	
				i=i+1;		
			}
			var xmlhttp = new XMLHttpRequest();

			xmlhttp.onreadystatechange = function() {

			if (this.readyState == 4 && this.status == 200) {
				var checked_sets = this.response.split(",");
				console.log(checked_sets);
				var i=0;
				while (i<checked_sets.length){
					var checkbox = document.getElementById(checked_sets[i]);
					checkbox.checked=true;	
					i=i+1;		
				}
			}
			};

			xmlhttp.open("GET", "Fragenset_get_Fragenset_checked.php?ID=" + Fragenset_ID, true);
			xmlhttp.send();
		}
		};
		xmlhttp1.open("GET", "Leistung_get_Fragenset.php?ID=" + Fragenset_ID, true);	
		xmlhttp1.send();
		
	}