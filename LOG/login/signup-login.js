const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});


let signupForm = document.getElementById("signupForm");
let submitBtn = document.getElementById("signupBtn");

let regexName = /^[a-zA-Z ]{8,}$/;
let regexUsername = /^[A-Za-z0-9_]+$/;
let regexEmail = /^[A-Za-z0-9._%+-]+@(?:[A-Za-z0-9-]+\.)+(?:com|net|org|edu|ru|gov|mil|biz|info|mobi|name|aero|asia|jobs|museum)$/i;
let regexPassword = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
let regexPhoneNumber = /^(\+\d{1,3})?\d{10}$/;

// Handle form submission
function handleSubmit(e) {
  e.preventDefault();

  let username = document.getElementById("uname").value;
  let email = document.getElementById("email").value;
  let password = document.getElementById("password").value;
  let confirmPassword = document.getElementById("confPassword").value;
  let phone = document.getElementById("phone").value;

  checkInputs( username, email, password, confirmPassword, phone);
}

signupForm.addEventListener("submit", handleSubmit);

function checkInputs( username, email, password, confirmPassword, phone) {
  let errorMessage = '';

  if (username == "") {
    errorMessage = "Don't forget to fill in all the fields";
  }
  else if (!regexName.test(username)) {
    errorMessage = "Name must only contain letters and at least 8 characters";
  }
  else if (!regexEmail.test(email)) {
    errorMessage = "Email is invalid";
  }
  else if (!regexPassword.test(password)) {
    errorMessage = "Password must be at least 8 characters, and have an uppercase letter, a lowercase letter, a digit, and a special character";
  }
  else if (password !== confirmPassword) {
    errorMessage = "Passwords not matched";
  }
  else if (!regexPhoneNumber.test(phone)) {
    errorMessage = "Phone invalid";
  }
  if (errorMessage !== '') {
    preventSubmittion(errorMessage);
  } else {
    signupForm.removeEventListener("submit", handleSubmit);
    signupForm.submit();
  }
}
function preventSubmittion(errorMessage) {
  if (errorMessage !== '') {
    Swal.fire({
      icon: 'info',
      title: 'Register Failed',
      text: errorMessage,
      footer: 'Fix the issue and try again'
    })
  }
}
