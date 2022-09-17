$( function() {
  get_datediff();

} );

  //gibt die Anzahl der Tage zwischen dem ersten feedback und heute zurück

  function get_datediff(){
    var Trainer = Auswahl_Trainer.value;
    var datediff=10;
    var xmlhttp_options = new XMLHttpRequest();
                xmlhttp_options.onreadystatechange = function() {
                     if (this.readyState == 4 && this.status == 200) {
                      $('input[name="daterange"]').daterangepicker({
                        "showDropdowns": true,
                        ranges: {
                            'Heute': [moment(), moment()],
                            'Letzten 3 Tage': [moment().subtract(2, 'days'), moment()],
                            'Letzten 7 Tage': [moment().subtract(6, 'days'), moment()],
                            'Letzten 30 Tage': [moment().subtract(29, 'days'), moment()],
                            'Dieser Monat': [moment().startOf('month'), moment().endOf('month')],
                        'Dieses Jahr': [moment().startOf('year'), moment().endOf('year')],
                        'Letztes Jahr': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
                        },
                      locale: {
                            "format": "YYYY-MM-DD",
                            "separator": "   bis   ",
                            "applyLabel": "Apply",
                            "cancelLabel": "Cancel",
                            "fromLabel": "From",
                            "toLabel": "To",
                            "customRangeLabel": "Benutzerdefiniert",
                            "weekLabel": "W",
                            "daysOfWeek": [
                                "So",
                                "Mo",
                                "Di",
                                "Mi",
                                "Do",
                                "Fr",
                                "Sa"
                            ],
                            "monthNames": [
                                "Jänner",
                                "Februar",
                                "März",
                                "April",
                                "Mai",
                                "Juni",
                                "Juli",
                                "August",
                                "September",
                                "Oktober",
                                "November",
                                "Dezember"
                            ],
                            "firstDay": 1
                        },
                        "alwaysShowCalendars": true,
                        "startDate": this.responseText,
                    });
                      
                    $('#zeitraum').on('apply.daterangepicker', function(ev, picker) {
                      update();
                    });                        
                      }
            ;};
            xmlhttp_options.open("GET", "first_date_extern.php?Trainer="+Trainer, false);
            xmlhttp_options.send();
                      
      return datediff;

    }
    