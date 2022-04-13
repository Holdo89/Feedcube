<div id="FragenInfo_Modal" class="modal" style="display:none;">
	<form class= "modalform" style="grid-template-columns: auto" action"#" onsubmit="hideinformation(); return false" method="post">
	    <div></div>
		<span class="close" onclick="hideinformationWithoutremembering()" style="float:right; text-align:right">&times;</span>
		<div>		
		<h4 style="font-size:30px; margin-bottom:10px;"><img src="../assets/brand/questionmark.png" width="60" style="margin-top:-10px;">Fragen </h4>
		<p style="text-align:left">
		    Hier werden bestehende Fragen bearbeitet und neue Fragen hinzugefügt, die bei Kundenbefragungen beantwortet werden. Dabei wird zwischen 4 verschiedenen Fragentypen unterschieden.   
        </p>
        <p style="text-align:left">
        <b>Bewertung</b> - Fragen bei denen genau eine Antwortmöglichkeit gewählt wird. <a onclick="showExample('radio')" style="cursor:pointer">Beispiel anzeigen</a><br><br></p>
		<div id="radio" class="radio">
		Wie bewerten Sie unsere Dienstleistung?<br>
			<label class="radio-inline">
			<input type="radio" name="optradio">Positiv
			</label>
			<label class="radio-inline">
			<input type="radio" name="optradio">Neutral
			</label>
			<label class="radio-inline">
			<input type="radio" name="optradio">Negativ
			</label>
		<br><br>
		</div>
  		<p style="text-align:left">
        <b>Multiplechoice</b> - Fragen bei denen mehrere oder keine Antwortmöglichkeit gewählt wird. <a onclick="showExample('checkbox')" style="cursor:pointer">Beispiel anzeigen</a><br><br></p>
		<div id="checkbox" class="radio">
			Welche Themen sind noch interessant?<br>
			<label class="checkbox-inline">
			<input type="checkbox" name="optradio">Option 1
			</label>
			<label class="checkbox-inline">
			<input type="checkbox" name="optradio">Option 2
			</label>
			<label class="checkbox-inline">
			<input type="checkbox" name="optradio">Option 3
			</label>
		</div>
		<p style="text-align:left">
        <b>Schieberegler</b> - Durch Verschieben eines Reglers wird ein Zahlenwert ermittelt und als Bewertung abgegeben. Um das Maximum und Minimum des Reglers zu bearbeiten klicke <i class="fa fa-pencil" aria-hidden="true"></i>. <a onclick="showExample('range')" style="cursor:pointer">Beispiel anzeigen</a><br><br></p>
		<div id="range" class="radio">
		<div style='text-align:center'><p style='margin-bottom:20px;'>Bewertung: <span id='output' style='font-size:15px;'>50</span></p><input type='range' style='width:70%; margin:auto;' min='0' max='100' value='50' name='element_1_1' id='element_1_1' ontouchend='input_update(1)' oninput='input_update(1), color(1)'></div>
		<br><br>
		</div>
		<p style="text-align:left">
		<b>Text</b> - Fragen werden durch ein Kommentar in Textform beantwortet.<br><br>
		<i style="font-size:20px; color:blue" class="fas fa-info"></i> Für die Antwortmöglichkeiten bei Bewertungen und Multiplechoice Fragen können vordefinierte Optionen gewählt, oder fragenspezifische Antworten erstellt werden.  
		Um eine bestehende Frage zu bearbeiten, klicke <i class="fa fa-pencil" aria-hidden="true"></i>.
		</p>
		    <button id="element" style="font-size:13px; margin-top:20px; width:170px; padding:10px;"><i class="fa fa-check" aria-hidden="true" style="font-size:13px"></i> Alles klar</button>
		</div>

	</form>
	
</div>