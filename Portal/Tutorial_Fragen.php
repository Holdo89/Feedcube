<script>
	document.getElementById("myTopnav").style.display="none";
</script>

<?php

$Step=$_REQUEST["Step"];
if($Step==3)
{
	include "Tutorial_Schritt3_Info.php";
}
else
{
	include "Tutorial_Schritt1_Info.php";
}
?>
    <link href="Tutorialstyle.css" rel="stylesheet" type="text/css">
	<div class="content">
	        <button id="element2" onclick = "zurück()">zurück</button>
            <button id="element" onclick = "weiter()">weiter</button>
    </div>

    <script src="Cookiefunctions.js" type="text/javascript"></script>

    <script>

			<?php
			if($Step==3)
			{
            	echo'
					checkCookie("FragenInformationCheckedSchritt3", "FragenInfo_Modal")
					function weiter() {
						window.location.href = "Tutorial_Fragenset.php"
					}

					function zurück() {
						window.location.href = "Tutorial_Antwortmoeglichkeiten.php"
					}
					
					function hideinformation(){
						document.getElementById("FragenInfo_Modal").style.display="none"
						document.cookie = "FragenInformationCheckedSchritt3=1";
					}
				';
			}
			else
			{
				echo'
				checkCookie("FragenInformationChecked", "FragenInfo_Modal")
				function weiter() {
					window.location.href = "Tutorial_Antwortmoeglichkeiten.php"
				}

				function zurück() {
					window.location.href = "Introstart.php"
				}
				
				function hideinformation(){
					document.getElementById("FragenInfo_Modal").style.display="none"
					document.cookie = "FragenInformationChecked=1";
				}
			';
			}
			?>

        function hideinformationWithoutremembering(){
            document.getElementById("FragenInfo_Modal").style.display="none"
        }

    </script>
    </body>
</html>