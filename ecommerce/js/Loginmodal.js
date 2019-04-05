function displayLoginModal() {
	document.getElementById("login").classList.toggle("display");
}
//This prevents the modal from closing when the user clicks on elements within the modal.
document.querySelector("#login").children[0].addEventListener('click', function(e) {
	e.stopPropagation();
}, false);

function displayRegisterModal() {
	document.getElementById("register").classList.toggle("display1");
}
//This prevents the modal from closing when the user clicks on elements within the modal.
document.querySelector("#register").children[0].addEventListener('click', function(e) {
	e.stopPropagation();
}, false);