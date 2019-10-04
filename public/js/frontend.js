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

const signalButton = document.getElementById("adminButton");