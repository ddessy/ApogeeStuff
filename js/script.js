$('document').ready(function () {
  $('#reg-username').on('blur', function () {
    validateEmail($("#reg-username").val());
  });

  $('#fullname').on('blur', function () {
    validateName($("#fullname").val());
  });

  $('#reg-password').on('blur', function () {
    validatePassword($("#reg-password").val());
  });

  $('#reg-password-r').on('blur', function () {
    validatePasswordR($("#reg-password").val(), $("#reg-password-r").val());
  });

  $('#profile-username').on('blur', function () {
    validateEmail($("#profile-username").val());
  });

  $('#profile-password').on('blur', function () {
    validatePassword($("#profile-password").val());
  });
});

function validateForm() {
  var name = document.forms["registrationform"]["fullname"].value;
  var email = document.forms["registrationform"]["email"].value;
  var password = document.forms["registrationform"]["password"].value;
  var passwordR = document.forms["registrationform"]["password_r"].value;

  result = true;

  resultValidatePassword = validatePassword(password);
  resultValidatePasswordR = validatePasswordR(password, passwordR);
  resultValidateEmail = validateEmail(email);
  resultValidateName = validateName(name);

  return resultValidateEmail && resultValidateName && resultValidatePassword
      && resultValidatePasswordR;
}

function validatePasswordR(password, passwordR) {

  if (passwordR.length < 1 || passwordR != password) {
    if (document.getElementById('reg-password-r') != null) {
      document.getElementById('reg-password-r').style.border = "1px solid red";
    }

    if (document.getElementById('profile-password-r')) {
      document.getElementById(
          'profile-password-r').style.border = "1px solid red";
    }

    document.getElementById(
        'error-password-r').innerHTML = "Повторете избраната парола";
    return false;
  }

  if (document.getElementById('reg-password-r') != null) {
    document.getElementById('reg-password-r').style.border = "1px solid green";
  }

  if (document.getElementById('profile-password-r')) {
    document.getElementById(
        'profile-password-r').style.border = "1px solid green";
  }

  document.getElementById('error-password-r').innerHTML = "";
  return true;
}

function validatePassword(password) {

  if (password.length < 1) {
    if (document.getElementById('reg-password') != null) {
      document.getElementById('reg-password').style.border = "1px solid red";
    }

    if (document.getElementById('profile-password') != null) {
      document.getElementById(
          'profile-password').style.border = "1px solid red";
    }

    if (document.getElementById('error-password') != null) {
      document.getElementById('error-password').innerHTML = "Въведете парола";
    }

    return false;
  }

  if(document.getElementById('reg-password') != null) {
    document.getElementById('reg-password').style.border = "1px solid green";
  }

  if (document.getElementById('profile-password') != null) {
    document.getElementById(
        'profile-password').style.border = "1px solid green";
  }

  if (document.getElementById('error-password') != null) {
    document.getElementById('error-password').innerHTML = "";
  }

  return true;
}

function validateName(name) {

  if (name.length < 1) {
    document.getElementById('fullname').style.border = "1px solid red";
    document.getElementById('error-name').innerHTML = "Въведете име и фамилия";
    return false;
  }

  document.getElementById('fullname').style.border = "1px solid green";
  document.getElementById('error-name').innerHTML = "";
  return true;

}

function isEmailValid(email) {
  const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

  if (email.length < 1) {
    document.getElementById('reg-username').style.border = "1px solid red";
    document.getElementById('error-email').innerHTML = "Въведете email";
    return false;
  } else if (!re.test(email)) {
    document.getElementById('reg-username').style.border = "1px solid red";
    document.getElementById('error-email').innerHTML = "Въведете валиден email";
    return false;
  }

  return true;
}

// TODO: to be moved to /registration Controller
function validateEmail(email) {

  if (!isEmailValid(email)) {
    return false;
  }

  var emailData = new FormData();
  emailData.append('email_check', '1');
  emailData.append('email', email);

  var xmlhttp = new XMLHttpRequest();

  xmlhttp.open("GET", "/checkemail/" + email, true);
  xmlhttp.onload = function () {
    if (xmlhttp.status === 200) {
      if (xmlhttp.responseText === "userexists") {
        document.getElementById('reg-username').style.border = "1px solid red";
        document.getElementById(
            'error-email').innerHTML = "Вече съществува потребител регистриран с този email";
        return false;
      }
    }
  };

  xmlhttp.send(emailData);

  document.getElementById('reg-username').style.border = "1px solid green";
  document.getElementById('error-email').innerHTML = "";

  return true;
}

function validateProfileForm() {
  var name = document.forms["profileform"]["fullname"].value;
  var email = document.forms["profileform"]["email"].value;
  var password = document.forms["profileform"]["new_password"].value;
  var passwordR = document.forms["profileform"]["new_password_r"].value;

  result = true;

  resultValidatePassword = validatePassword(password);
  //resultValidatePasswordR = validatePasswordR(password, passwordR);
  resultValidateEmail = isEmailValid(email);
  resultValidateName = validateName(name);

  return resultValidateEmail && resultValidateName && resultValidatePassword
      && resultValidatePasswordR;
}

function existUser() {

  var email = document.forms["loginform"]["username"].value;
  var password = document.forms["loginform"]["password"].value;

  var userData = new FormData();
  userData.append('login_check', '1');
  userData.append('username', email);
  userData.append('password', password);

  var xmlhttp = new XMLHttpRequest();

  xmlhttp.open("POST", "/login", false);
  xmlhttp.send(userData);

  if (xmlhttp.status === 200) {
    if (xmlhttp.responseText === "error") {
      document.getElementById(
          'login-error').innerHTML = "Грешно въведено потребителско име или email";
      return false;
    } else {
      return true;
    }
  }
  ;

}