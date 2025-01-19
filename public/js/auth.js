const signUpButton = document.getElementById('signUpSwap');
const signInButton = document.getElementById('signInSwap');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});