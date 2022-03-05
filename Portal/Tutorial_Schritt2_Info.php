<div id="AntwortenInfo_Modal" class="modal" style="display:block;">
	<form class= "modalform" style="grid-template-columns: auto" action"#" onsubmit="hideinformation(); return false" method="post">
	    <div></div>
		<span class="close" onclick="hideinformationWithoutremembering()" style="float:right; text-align:right">&times;</span>
		<div>		
		<h4 style="font-size:30px; margin-bottom:10px;"><img src="../assets/brand/check-mark.png" width="60"> Antworten </h4>
		<p style="text-align:left">
		    Antworten werden von Fragen abgekoppelt behandelt, wodurch eine Wiederverwendbarkeit für mehrere Fragen erleichtert wird. Antwortmöglichkeiten werden in 2 verschiedene Arten kategorisiert:    
        </p>
        <p style="text-align:left">
        <b>Bewertung</b> - Antworten bei denen genau eine Option gewählt wird. Beispiel dafür: </p>
			<label class="radio-inline">
			<input type="radio" name="optradio">Option 1
			</label>
			<label class="radio-inline">
			<input type="radio" name="optradio">Option 2
			</label>
			<label class="radio-inline">
			<input type="radio" name="optradio">Option 3
			</label>
		<br><br>
  		<p style="text-align:left">
        <b>Multiplechoice</b> - Antworten bei denen mehrere oder keine Option gewählt wird. Beispiel dafür</p>
			<label class="checkbox-inline">
			<input type="checkbox" name="optradio">Option 1
			</label>
			<label class="checkbox-inline">
			<input type="checkbox" name="optradio">Option 2
			</label>
			<label class="checkbox-inline">
			<input type="checkbox" name="optradio">Option 3
			</label>
		<br><br>
		<p style="text-align:left">
        Um eine Übersetzung zu denen einzelnen Antworten einzutragen klicke <i class="fa fa-pencil" aria-hidden="true"></i>.     
		</p>
		    <button id="element" style="font-size:13px; margin-top:20px; width:170px; padding:10px;"><i class="fa fa-check" aria-hidden="true" style="font-size:13px"></i> Alles klar</button>
		</div>

	</form>
	
	</div>