const adminButton = document.getElementById("adminButton");
const form = document.getElementById("adminAccess");
const cancelAdminAccess = document.getElementById("cancelAdminAccess");
const exitAdmin = document.getElementById("exitAdmin");


adminButton.addEventListener("click", function() {
	adminButton.style.display = "none";
	adminAccess.style.display = "block";
	cancelAdminAccess.style.display = "block";
});

cancelAdminAccess.addEventListener("click", function() {
	adminButton.style.display = "block";
	adminAccess.style.display = "none";
	cancelAdminAccess.style.display = "none";
});

form.addEventListener("submit", function() {
	adminButton.style.display = "none";
	adminAccess.style.display = "none";
	cancelAdminAccess.style.display = "none";
});

const signalButtons = document.querySelectorAll(".signalButton");

signalButtons.forEach(function (item) {
	item.addEventListener("click", function (e) {
  		var commentId = item.dataset["comment"];
      	var req = new XMLHttpRequest();
		req.open("GET", "index.php?action=signal&commentId=" + commentId);
		req.addEventListener("load", function () {
			if (req.status >= 200 && req.status < 400) { 
			    item.innerHTML = "Commentaire signalé";
			} else {
			    console.error(req.status + " " + req.statusText);
			}
		});
		req.addEventListener("error", function () {
		console.error("Erreur réseau");
		});
		req.send(null);
	});
});