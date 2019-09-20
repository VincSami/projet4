const adminButton = document.getElementById("adminButton");
const adminAccess = document.getElementById("adminAccess");
const cancelAdminAccess = document.getElementById("cancelAdminAccess");
const submitAdminAccess = document.getElementById("submitAccess");
const deconnexionButton = document.getElementById("deconnexion");

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

submitAdminAccess.addEventListener("click", function() {
	adminButton.style.display = "none";
	adminAccess.style.display = "none";
	cancelAdminAccess.style.display = "none";
	deconnexionButton.style.display = "block";
});