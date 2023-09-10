let signupform = document.querySelector("#signup-form");
let loginform = document.querySelector("#login-form");
let loginbutton = document.getElementById("login-btn");
let is_signup_form_open = true;
let invalid_form_data = false;
let alertModule = document.getElementById("alert-module");
//SignUp Form
let password = document.querySelector("#password");
let cpassword = document.querySelector("#cPassword");

function openLoginForm() {
  signupform.style.display = "none";
  loginform.style.display = "block";
  is_signup_form_open = false;
}
function openSignupForm() {
  signupform.style.display = "block";
  loginform.style.display = "none";
  is_signup_form_open = true;
}
function closeAlert() {
  alertModule.style.display = "none";
}
function openAlert(message, classListName) {
  alertModule.style.display = "block";
  alertModule.innerHTML =
    message +
    '<button type="button" class="btn-close" onclick="closeAlert();"></button>';
  alertModule.classList.remove("alert-success");
  alertModule.classList.remove("alert-warning");
  alertModule.classList.add(classListName);
}
function checkEmail(email) {
  return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email);
}

function checkPhone(phone) {
  return /^[0-9]+$/.test(phone);
}

cpassword.addEventListener("keyup", () => {
  if (password.value != cpassword.value) {
    console.log(cpassword.value);
    cpassword.classList.remove("input-focus-green-color");
    cpassword.classList.add("input-focus-red-color");
    invalid_form_data = true;
  } else {
    cpassword.classList.remove("input-focus-red-color");
    cpassword.classList.add("input-focus-green-color");
    invalid_form_data = false;
  }
});
function validate() {
  invalid_form_data = false;
  
  if (is_signup_form_open) {
    let inps = document.querySelectorAll(".signup-form input");
    let signup_error_msg = document.getElementById("signup-error-msg");
    signup_error_msg.innerHTML = null;
    // console.log(inps);
    inps.forEach((inp) => {
      if (inp.value.trim() == "" || inp.value.length < 3) {
        invalid_form_data = true;
        signup_error_msg.innerHTML = "Please Fill Details Properly.<br>";
        signup_error_msg.innerHTML +=
          "Names and Password should contain more than three letters<br>";
          // return;
      }
    });

    

    if (!checkEmail(inps[2].value)) {
      invalid_form_data = true;
      signup_error_msg.innerHTML += "Enter valid email.<br>";
    }
    if (!checkPhone(inps[3].value) || inps[3].value.length != 10) {
      invalid_form_data = true;
      signup_error_msg.innerHTML += "Phone should contain only digits(10).<br>";
    }
    if (!invalid_form_data) {
      let gender_name = "";
      for (let i = 4; i < 7; i++) {
        if (inps[i].checked) {
          gender_name = inps[i].value;
          break;
        }
      }

      signup_error_msg.style.display = "none";
      let data = {
        firstname: inps[0].value,
        lastname: inps[1].value,
        email: inps[2].value,
        phone: inps[3].value,
        gender: gender_name,
        password: inps[7].value,
      };
      $.ajax({
        method: "POST",
        url: "./partials/_handleSignup.php",
        data: data,
        success: function (response) {
          // console.log(response);
          let res = JSON.parse(response);
          // console.log(res.message)
          if (res.error != null) {
            openAlert(res.message, "alert-warning");
          } else {
            openLoginForm();
            openAlert(
              "<strong>Bravo!</strong> you registered successfully please proceed with login.",
              "alert-success"
            );
          }
        },
        error: function (xhr, status, error) {
          console.error(xhr);
        },
      });
    }
  }
}

const url = window.location.search;
let params = new URLSearchParams(url);
if (params.has("return")) {
  openLoginForm();
}
