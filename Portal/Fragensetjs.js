
	var fragenset_modal = document.getElementById("Fragenset_Modal");

	function fragenset_abfrage_speichern(id) {
			fragenset_speichern(id);
	;}
	function fragenset_abfrage_löschen(id) {
  	if (confirm("Wollen Sie dieses Fragenset entfernen?"))
	  {fragenset_entfernen(id);
		alert("Das Fragenset wurde gelöscht");
		location.reload();}
	;}
	
	function display(id,type) {

		var getFragenset = new XMLHttpRequest();
		var currentFragenset="";
		document.getElementById("Fragenset_Form").action="Fragenset_relate_question.php"
		if (window.location.href.indexOf("Step") != -1)
		{
			document.getElementById("Fragenset_Form").action="Fragenset_relate_question.php?Step=4"	
		}

		if(id!=undefined)
		{
			getFragenset.onreadystatechange = function() {
				document.getElementById("neues_Fragenset").value=this.responseText;
			}
			getFragenset.open("GET", "getFragenset.php?ID=" + id, false);	
			getFragenset.send();
		}
		getFragenset.onreadystatechange = function() {
			currentFragenset=this.responseText;
		}
		getFragenset.open("GET", "Leistung_getCurrentFragenset.php?ID=" + id, false);	
		getFragenset.send();
		
	
		fragenset_modal.style.display = "block";
		var div_id=document.getElementById("Fragenset_ID");
		div_id.value=id;
		enableAllCheckboxes();

		var xmlhttp1 = new XMLHttpRequest();

		xmlhttp1.onreadystatechange = function() {

		if (this.readyState == 4 && this.status == 200) {
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
				var i=0;
				while (i<checked_sets.length){
					if(type=="fragenset")
					{
						var checkbox = document.getElementById('Fragenset_'+checked_sets[i]);	
					}
					else{
						var checkbox = document.getElementById(checked_sets[i]);
					}
					checkbox.checked=true;
					i=i+1;		
				}
			}
			};
			xmlhttp.open("GET", "Fragenset_get_Fragenset_checked.php?ID=" + id, true);
			xmlhttp.send();
		}
		};
		xmlhttp1.open("GET", "Leistung_get_Fragenset.php?ID=" + id, true);	
		xmlhttp1.send();
		if(id==undefined)
		{
			document.getElementById("Fragenset_Form").action="insert_fragenset.php"
			if (window.location.href.indexOf("Step") != -1)
			{
				document.getElementById("Fragenset_Form").action="insert_fragenset.php?Step=4"	
			}
		}
	}
	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];
	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
		fragenset_modal.style.display = "none";
	}
	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	if (event.target == fragenset_modal ) {
		fragenset_modal.style.display = "none";
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