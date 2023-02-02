function delete_data()
{
    var Trainer = Auswahl_Trainer.value;
    try{
        var Frage = Auswahl_Frage.value;
        }
        catch{
            var Frage = "%25";
        }
    var Leistung = Auswahl_Leistung.value;
    var Trainer_Name = Auswahl_Trainer.value;
    if(Trainer_Name == "%25"){
        Trainer_Name="Alle Trainer";
    }
    var Leistung_Text = Auswahl_Leistung.value;
    console.log("Leistungtext:"+Leistung_Text)
    if(Leistung_Text == "%25"){
        Leistung_Text="Alle Kurse";
    }
	var daterange = document.getElementById("zeitraum").value;
	const DateRangeArray = daterange.split("   bis   ");
	var datum_min = DateRangeArray[1];
	var datum_max = DateRangeArray[0];	
	datum_min = new Date(datum_min);
	datum_max = new Date(datum_max);


    datum_min = datum_min.toISOString().split('T')[0];
	datum_max = datum_max.toISOString().split('T')[0];

    if(confirm("Wollen Sie das gesammelte Feedback zum konfigurierten Filter löschen?"))
        {
            var xmlhttp = new XMLHttpRequest();    
            xmlhttp.open("GET", "Delete_Data.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Leistung=" + Leistung + "&Frage=" + Frage + "&Trainer=" + Trainer, false);
            xmlhttp.send();
            location.reload();
        }
}

function intern_delete_data(){
    var Umfrage = Auswahl_Umfrage.value;
	var daterange = document.getElementById("zeitraum").value;
	const DateRangeArray = daterange.split("   bis   ");
	var datum_min = DateRangeArray[1];
	var datum_max = DateRangeArray[0];	
	datum_min = new Date(datum_min);
	datum_max = new Date(datum_max);


    datum_min = datum_min.toISOString().split('T')[0];
	datum_max = datum_max.toISOString().split('T')[0];
    if(confirm("Wollen Sie das gesammelte interne Feedback zum konfigurierten Filter löschen?"))
    {
    var xmlhttp = new XMLHttpRequest();    
    xmlhttp.open("GET", "Intern_Delete_Data.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Umfrage=" + Umfrage, false);
    xmlhttp.send();
    location.reload();
    }
}

function export_data_admin(){
        var Trainer = Auswahl_Trainer.value;
        try{
        var Frage = Auswahl_Frage.value;
        }
        catch{
            var Frage = "%25";
        }
        var Leistung = Auswahl_Leistung.value;
        var Trainer_Name = Auswahl_Trainer.value;
        if(Trainer_Name == "%25"){
            Trainer_Name="Alle Trainer";
        }
        var Leistung_Text = Auswahl_Leistung.value;
        if(Leistung_Text == "%25"){
            Leistung_Text="Alle Kurse";
        }
        var daterange = document.getElementById("zeitraum").value;
        const DateRangeArray = daterange.split("   bis   ");
        var datum_min = DateRangeArray[1];
        var datum_max = DateRangeArray[0];	
        datum_min = new Date(datum_min);
        datum_max = new Date(datum_max);

        datum_min = datum_min.toISOString().split('T')[0];
        datum_max = datum_max.toISOString().split('T')[0];

        var xmlhttp = new XMLHttpRequest(); 
        xmlhttp.onreadystatechange = function() {

            if (this.readyState == 4 && this.status == 200) {
        
              var csv=this.responseText;
              var hiddenElement = document.createElement('a');
              hiddenElement.href = 'data:text/csv;charset=utf-8,%EF%BB%BF' + encodeURI(csv);
              hiddenElement.target = '_blank';
              hiddenElement.download = 'kursfeedback.csv';
              hiddenElement.click();
              }
      
            }   
        xmlhttp.open("GET", "Export_Data_Admin.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Leistung=" + Leistung + "&Frage=" + Frage + "&Trainer=" + Trainer, true);
        xmlhttp.send();
        }



function export_data(){
    try{
        var Frage = Auswahl_Frage.value;
        }
        catch{
            var Frage = "%25";
        }
    var Leistung = Auswahl_Leistung.value;
    var Leistung_Text = Auswahl_Leistung.value;
    if(Leistung_Text == "%25"){
        Leistung_Text="Alle Kurse";
    }
	var daterange = document.getElementById("zeitraum").value;
	const DateRangeArray = daterange.split("   bis   ");
	var datum_min = DateRangeArray[1];
	var datum_max = DateRangeArray[0];	
	datum_min = new Date(datum_min);
	datum_max = new Date(datum_max);


    datum_min = datum_min.toISOString().split('T')[0];
	datum_max = datum_max.toISOString().split('T')[0];
    var xmlhttp = new XMLHttpRequest(); 
    xmlhttp.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {
    
          var csv=this.responseText;
          var hiddenElement = document.createElement('a');
          hiddenElement.href = 'data:text/csv;charset=utf-8,%EF%BB%BF' + encodeURI(csv);
          hiddenElement.target = '_blank';
          hiddenElement.download = 'kursfeedback.csv';
          hiddenElement.click();
          }
  
        }   
    xmlhttp.open("GET", "Export_Data.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Leistung=" + Leistung + "&Frage=" + Frage, true);
    xmlhttp.send();
    }


function intern_export_data(){
    var Umfrage = Auswahl_Umfrage.value;
    var daterange = document.getElementById("zeitraum").value;
	const DateRangeArray = daterange.split("   bis   ");
	var datum_min = DateRangeArray[1];
	var datum_max = DateRangeArray[0];	
	datum_min = new Date(datum_min);
	datum_max = new Date(datum_max);


    datum_min = datum_min.toISOString().split('T')[0];
	datum_max = datum_max.toISOString().split('T')[0];
    var xmlhttp = new XMLHttpRequest(); 
    xmlhttp.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {
    
          var csv=this.responseText;
          var hiddenElement = document.createElement('a');
          hiddenElement.href = 'data:text/csv;charset=utf-8,%EF%BB%BF' + encodeURI(csv);
          hiddenElement.target = '_blank';
          hiddenElement.download = 'umfragenfeedback.csv';
          hiddenElement.click();
          }
  
        }   
    xmlhttp.open("GET", "Export_Data_Intern.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Umfrage=" + Umfrage, true);
    xmlhttp.send();
    }