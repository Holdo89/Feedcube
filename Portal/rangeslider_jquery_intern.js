$( function() {
  $( "#slider-range" ).slider({
    stop: function(event, ui) {
      datum_update();
      update();
  },
    range: true,
    min: 0,
    max: get_datediff(),
    values: [0, get_datediff()],
  });
  $( "#slider-range2" ).slider({
  stop: function(event, ui) {
    create_blog();
  },
    range: true,
    min: 0,
    max: get_datediff(),
    values: [0, get_datediff()]
  });
} );

  //gibt die Anzahl der Tage zwischen dem ersten feedback und heute zurück
  function get_datediff(){
    var datediff=10;
    var xmlhttp_options = new XMLHttpRequest();
                xmlhttp_options.onreadystatechange = function() {
                     if (this.readyState == 4 && this.status == 200) {
                        datediff=parseInt(this.responseText)+3;	//diese Zeile ist notwendig weil ein string array "4,2,1,..." zurückgegeben wird und mit split erzeugen wir ein array und der letzte , wird entfernt mit slice
                        $( "#slider-range" ).slider({
                          range: true,
                          min: 0,
                          max: datediff,
                          values: [0, datediff],
                        });
                        $( "#slider-range2" ).slider({
                          range: true,
                          min: 0,
                          max: datediff,
                          values: [0, datediff]
                        });
                      }
            ;};
            xmlhttp_options.open("GET", "first_date_intern.php", true);
            xmlhttp_options.send();
      return datediff;
    }