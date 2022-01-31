
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
		console.log(id);
  	if (confirm("Wollen Sie diese Umfrage entfernen? Ihre bestehenden Antworten zu dieser Umfrage werden ebenfalls entfernt"))
	  {entfernen(id);
		alert("Die Umfrage wurde gelöscht");
		location.reload();}
	;}

	function showQuestions(id)
	{
		var form = document.getElementById("form_"+id);
		if(form.style.display=="grid")
		form.style.display="none";
		else
		form.style.display="grid";
	}
	
	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];
	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
  		modal.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	if (event.target == modal || event.target == fragenset_modal ) {
		modal.style.display = "none";
		fragenset_modal.style.display = "none";
	}
	}

	function display_umfrage() {
		var Fragenset_ID = Auswahl_Fragenset.value;
		console.log(Fragenset_ID)
		var xmlhttp1 = new XMLHttpRequest();
		if (Fragenset_ID != "kein_Fragenset")
		{
		xmlhttp1.onreadystatechange = function() {

		if (this.readyState == 4 && this.status == 200) {
			var checked_sets = this.response.split(";.,");
			var i=0;
			while (i<checked_sets.length){
				var checkbox = document.getElementById(checked_sets[i]);

				checkbox.checked=false;	
				i=i+1;		
			}
			var xmlhttp = new XMLHttpRequest();

			xmlhttp.onreadystatechange = function() {

			if (this.readyState == 4 && this.status == 200) {
				var checked_sets = this.response.split(";.,");
				var i=0;
				while (i<checked_sets.length){
					var checkbox = document.getElementById(checked_sets[i]);
					checkbox.checked=true;
					checkbox.disabled=true;	
					i=i+1;		
				}
			}
			};

			xmlhttp.open("GET", "Fragenset_get_Fragenset_checked.php?ID=" + Fragenset_ID, true);
			xmlhttp.send();
		}
		};
		xmlhttp1.open("GET", "Umfrage_get_Fragenset.php?ID=" + Fragenset_ID, true);	
		xmlhttp1.send();
		}
		else{
			enableAllCheckboxes();
		}
		
	}

	function enableAllCheckboxes(){
		var checkbox_list = document.getElementsByTagName('input');
 
		for (var i = 0; i < checkbox_list.length; i++) {
			var checkbox = checkbox_list[i];
		
			if (checkbox.getAttribute('type') == 'checkbox') {
				checkbox.disabled=false;
			}
		} 
	}