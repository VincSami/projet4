const adminButton = document.getElementById("adminButton");
const adminAccess = document.getElementById("adminAccess");
adminButton.addEventListener("click", function() {
	adminButton.style.display = "none";
	adminAccess.style.display = "block";
});