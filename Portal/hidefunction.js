function hide($x,$y) {

		var x = document.getElementById($x);

		var y = document.getElementById($y);
		var Hinweis = document.getElementById("Hinweis");

		if (x.style.display === "none") {

			x.style.display = "grid";
			Hinweis.style.display ="none"

		} else {

			x.style.display = "none";
			Hinweis.style.display ="block";

		}

		y.style.display = "none";

	}