function delete_data(){
    var Zeitraumvalue =  document.getElementById("zeitraum").value;
    var Zeitraum = "Benutzerdefiniert";
    switch(Zeitraumvalue){
        case "24 hours":
            var Zeitraum = "Heute";
            break;
        case "3 days":
            var Zeitraum = "letzten 3 Tage";
            break;
        case "7 days":
            var Zeitraum = "letzten 7 Tage";
            break;
        case "30 days":
            var Zeitraum = "letzten 30 Tage";
            break;
        }
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
        Leistung_Text="Alle Leistungen";
    }
    var value_min = $( "#slider-range" ).slider( "values", 0 );
    var value_max = $( "#slider-range" ).slider( "values", 1 );
    var output = document.getElementById("demo");
    var datum_min = new Date();
    var datum_max = new Date();
    datum_min.setDate(datum_min.getDate() - value_min);
    datum_min = datum_min.toISOString().split('T')[0];
    datum_max.setDate(datum_max.getDate() - value_max);
    datum_max = datum_max.toISOString().split('T')[0];
    output.innerHTML = datum_min + " bis " + datum_max;
    if (Zeitraum=="Benutzerdefiniert"){
        if (confirm("Wollen Sie das gesammelte Feedback zur folgenden Auswahl löschen:\nUser: "+Trainer_Name+"\nLeistung: " + Leistung_Text + "\nZeitraum: "+ datum_max + " bis " + datum_min))
        {
            var xmlhttp = new XMLHttpRequest();    
            xmlhttp.open("GET", "Delete_Data.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Leistung=" + Leistung + "&Frage=" + Frage + "&Trainer=" + Trainer + "&Zeitraum=" + Zeitraum, true);
            xmlhttp.send();
        }
    }
    else{ 
        if(confirm("Wollen Sie das gesammelte Feedback zur folgenden Auswahl löschen:\nUser: "+Trainer_Name+"\nLeistung: " + Leistung_Text + "\nZeitraum: "+ Zeitraum))
        {
            var xmlhttp = new XMLHttpRequest();    
            xmlhttp.open("GET", "Delete_Data.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Leistung=" + Leistung + "&Frage=" + Frage + "&Trainer=" + Trainer + "&Zeitraum=" + Zeitraum, true);
            xmlhttp.send();
        }
    }
    location.reload();
}

function intern_delete_data(){
    var value_min = $( "#slider-range" ).slider( "values", 0 );
    var value_max = $( "#slider-range" ).slider( "values", 1 );
    var output = document.getElementById("demo");
    var datum_min = new Date();
    var datum_max = new Date();
    datum_min.setDate(datum_min.getDate() - value_min);
    datum_min = datum_min.toISOString().split('T')[0];
    datum_max.setDate(datum_max.getDate() - value_max);
    datum_max = datum_max.toISOString().split('T')[0];
    output.innerHTML = datum_min + " bis " + datum_max;
    if (confirm("Wollen Sie das gesammelte interne Feedback Im Zeitraum von "+ datum_max + " bis " + datum_min + " löschen?"))
    {
    var xmlhttp = new XMLHttpRequest();    
    xmlhttp.open("GET", "Intern_Delete_Data.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Zeitraum=" + Zeitraum, true);
    xmlhttp.send();
    }
    location.reload();
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
            Leistung_Text="Alle Leistungen";
        }
        var value_min = $( "#slider-range" ).slider( "values", 0 );
        var value_max = $( "#slider-range" ).slider( "values", 1 );
        var output = document.getElementById("demo");
        var datum_min = new Date();
        var datum_max = new Date();
        datum_min.setDate(datum_min.getDate() - value_min);
        datum_min = datum_min.toISOString().split('T')[0];
        datum_max.setDate(datum_max.getDate() - value_max);
        datum_max = datum_max.toISOString().split('T')[0];
        output.innerHTML = datum_min + " bis " + datum_max;
        if (confirm("Wollen Sie das gesammelte Feedback zur folgenden Auswahl exportieren:\nUser: "+Trainer_Name+"\nLeistung: " + Leistung_Text + "\nZeitraum: "+ datum_max + " bis " + datum_min))
        {
        var xmlhttp = new XMLHttpRequest(); 
        xmlhttp.onreadystatechange = function() {

            if (this.readyState == 4 && this.status == 200) {
        
              var csv=this.responseText;
              var hiddenElement = document.createElement('a');
              hiddenElement.href = 'data:text/csv;charset=utf-8,%EF%BB%BF' + encodeURI(csv);
              hiddenElement.target = '_blank';
              hiddenElement.download = 'externes_feedback.csv';
              hiddenElement.click();
              }
      
            }   
        xmlhttp.open("GET", "Export_Data_Admin.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Leistung=" + Leistung + "&Frage=" + Frage + "&Trainer=" + Trainer + "&Zeitraum=" + Zeitraum, true);
        xmlhttp.send();
        }
    
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
        Leistung_Text="Alle Leistungen";
    }
    var value_min = $( "#slider-range" ).slider( "values", 0 );
    var value_max = $( "#slider-range" ).slider( "values", 1 );
    var output = document.getElementById("demo");
    var datum_min = new Date();
    var datum_max = new Date();
    datum_min.setDate(datum_min.getDate() - value_min);
    datum_min = datum_min.toISOString().split('T')[0];
    datum_max.setDate(datum_max.getDate() - value_max);
    datum_max = datum_max.toISOString().split('T')[0];
    output.innerHTML = datum_min + " bis " + datum_max;
    if (confirm("Wollen Sie Ihr gesammeltes Feedback zur folgenden Auswahl exportieren:\nLeistung: " + Leistung_Text + "\nZeitraum: "+ datum_max + " bis " + datum_min))
    {
    var xmlhttp = new XMLHttpRequest(); 
    xmlhttp.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {
    
          var csv=this.responseText;
          var hiddenElement = document.createElement('a');
          hiddenElement.href = 'data:text/csv;charset=utf-8,%EF%BB%BF' + encodeURI(csv);
          hiddenElement.target = '_blank';
          hiddenElement.download = 'externes_feedback.csv';
          hiddenElement.click();
          }
  
        }   
    xmlhttp.open("GET", "Export_Data.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Leistung=" + Leistung + "&Frage=" + Frage + "&Zeitraum=" + Zeitraum, true);
    xmlhttp.send();
    }

}


function intern_export_data(){

    var Frage = Auswahl_Frage.value;
    var value_min = $( "#slider-range" ).slider( "values", 0 );
    var value_max = $( "#slider-range" ).slider( "values", 1 );
    var output = document.getElementById("demo");
    var datum_min = new Date();
    var datum_max = new Date();
    datum_min.setDate(datum_min.getDate() - value_min);
    datum_min = datum_min.toISOString().split('T')[0];
    datum_max.setDate(datum_max.getDate() - value_max);
    datum_max = datum_max.toISOString().split('T')[0];
    output.innerHTML = datum_min + " bis " + datum_max;
    if (confirm("Wollen Sie das gesammelte interne Feedback zur folgenden Auswahl exportieren:\nZeitraum: "+ datum_max + " bis " + datum_min))
    {
    var xmlhttp = new XMLHttpRequest(); 
    xmlhttp.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {
    
          var csv=this.responseText;
          var hiddenElement = document.createElement('a');
          hiddenElement.href = 'data:text/csv;charset=utf-8,%EF%BB%BF' + encodeURI(csv);
          hiddenElement.target = '_blank';
          hiddenElement.download = 'internes_feedback.csv';
          hiddenElement.click();
          }
  
        }   
    xmlhttp.open("GET", "Export_Data_Intern.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Frage=" + Frage + "&Zeitraum=" + Zeitraum, true);
    xmlhttp.send();
    }

}