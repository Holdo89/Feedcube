<div id="UserInfo_Modal" class="modal" style="display:none">
	<form class= "modalform" style="grid-template-columns: auto" action"#" onsubmit="hideinformation(); return false" method="post">
	    <div></div>
	    <div></div>
		<span class="close" onclick="hideinformationWithoutremembering()" style="text-align:right">&times;</span>
		<div>		
		<h4 style="font-size:30px; margin-bottom:10px;"><img src="../assets/brand/group.png" width="60"> Benutzer </h4>
		<p style="text-align:left">
		    Hier werden neue Benutzer hinzugefügt und verwaltet. Zu jedem Benutzer stehen weitere Optionen zur Verfügung. <br>
		</p>
			<p style="text-align:left; line-height:30px;">
				<i class='fa fa-lock'></i> neues Passwort vergeben.<br>	
				<i class='fa fa-trash'></i> ausgewählten Benutzer löschen. <br>
				<i class='fa fa-link'></i> Feedbacklink für ausgewählten Benutzer erstellen.<br>	   
			</p>	
		<p style="text-align:left">
		Des weiteren werden Benutzer in zwei Gruppen unterschieden.<br><br>
		<i class="fas fa-user-cog"></i> Administratoren konfigurieren das System und besitzen die Berechtigung neue Fragen, Antworten, Leistungen, Benutzer und Umfragen hinzuzufügen. Zudem besitzen Administratoren zusätzliche Möglichkeiten um abgegebenes Feedback auszuwerten bzw. zu löschen.  
		<br><br><i class="fas fa-chalkboard-teacher"></i> Trainer sind Benutzer die an Umfragen teilnehmen und zu denen Feedback abgegeben werden kann. Trainer besitzen eingeschränkte Möglichkeiten bei der Auswertung von Feedback. So ist es für diese Benutzergruppe nicht möglich bei der Auswertung des Feedbacks nach anderen Trainern zu filtern oder abgegebenes Feedback zu löschen.	
	</p>
		    <button id="element" style="font-size:13px; margin-top:20px; width:170px; padding:10px;"><i class="fa fa-check" aria-hidden="true" style="font-size:13px"></i> Alles klar</button>
		</div>

	</form>
	
	</div>