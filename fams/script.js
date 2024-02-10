const container = document.getElementById("container1");
const registerBtn = document.getElementById("register1");
const loginBtn = document.getElementById("login1");

registerBtn.addEventListener("click", () => {
  container.classList.add("active");
});

loginBtn.addEventListener("click", () => {
  container.classList.remove("active");
});

function togglePassword() {
  var passwordInput = document.querySelector(".password-input");
  var passwordToggleIcon = document.querySelector(".password-toggle-icon");

  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    passwordToggleIcon.innerHTML = '<i class="fa fa-eye"></i>';
  } else {
    passwordInput.type = "password";
    passwordToggleIcon.innerHTML = '<i class="fa fa-eye-slash"></i>';
  }
}

function togglePassword() {
  var passwordInput = document.querySelector(".password-input");
  var passwordToggleIcon = document.querySelector(".password-toggle-icon");

  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    passwordToggleIcon.innerHTML = '<i class="fa fa-eye"></i>';
  } else {
    passwordInput.type = "password";
    passwordToggleIcon.innerHTML = '<i class="fa fa-eye-slash"></i>';
  }
}
