function isNHS(r, e) {
  if (r.value.length !== 10 && r.value.length !== 0) {
    if (append)
      document.getElementById("alert_message").innerHTML +=
        e + " must have 10 digits</br>";
    else
      document.getElementById("alert_message").innerHTML =
        e + " must have 10 digits";
    return true;
  }
}

function isOnlyCharacter(r, e) {
  if (!isEmpty(r, e)) {
    if (r.value.length < 1) {
      if (append)
        document.getElementById("alert_message").innerHTML +=
          e + " must have more than equal to 1 characters<br/>";
      else
        document.getElementById("alert_message").innerHTML =
          e + " must have more than equal to 1 characters";
      return false;
    }
    if (r.value.length > 30) {
      if (append)
        document.getElementById("alert_message").innerHTML +=
          e + " must have less than equal to 30 characters<br/>";
      else
        document.getElementById("alert_message").innerHTML =
          e + " must have less than equal to 30 characters";
      return false;
    }
    if (/^([a-zA-Z]+\s)*[a-zA-Z]+$/.test(r.value.trim())) {
      if (append) document.getElementById("alert_message").innerHTML += "";
      else document.getElementById("alert_message").innerHTML = "";
      return true;
    }
    if (append)
      document.getElementById("alert_message").innerHTML +=
        e + " can only contain characters<br/>";
    else
      document.getElementById("alert_message").innerHTML =
        e + " can only contain characters";
    return false;
  }
  return false;
}

function ValidateNHSEmail() {
  var mail = document.getElementById("email2");
  if (!isEmpty(mail, "NHS Staff Mail")) {
    mail = mail.value;
    if (/^\w+([\.-]?\w+)*@nhs.net$/.test(mail)) {
      if (append) document.getElementById("alert_message").innerHTML += "";
      else document.getElementById("alert_message").innerHTML = "";
      return true;
    } else if (/^\w+([\.-]?\w+)*@[0-9a-zA-Z]+.nhs.uk$/.test(mail)) {
      if (append) document.getElementById("alert_message").innerHTML += "";
      else document.getElementById("alert_message").innerHTML = "";
      return true;
    }
    if (append)
      document.getElementById("alert_message").innerHTML +=
        "Invalid NHS Email<br/>";
    else
      document.getElementById("alert_message").innerHTML = "Invalid NHS Email";
    return false;
  }
  return false;
}

function isEmpty(r, e) {
  if (r.value.trim() == "") {
    if (append)
      document.getElementById("alert_message").innerHTML +=
        e + " can't be empty.</br>";
    else
      document.getElementById("alert_message").innerHTML =
        e + " can't be empty";
    return true;
  }
  if (append) document.getElementById("alert_message").innerHTML += "";
  else document.getElementById("alert_message").innerHTML = "";
  return false;
}

function isOnlyCharacter(r, e) {
  if (!isEmpty(r, e)) {
    if (r.value.length < 1) {
      if (append)
        document.getElementById("alert_message").innerHTML +=
          e + " must have more than equal to 1 characters<br/>";
      else
        document.getElementById("alert_message").innerHTML =
          e + " must have more than equal to 1 characters";
      return false;
    }
    if (r.value.length > 30) {
      if (append)
        document.getElementById("alert_message").innerHTML +=
          e + " must have less than equal to 30 characters<br/>";
      else
        document.getElementById("alert_message").innerHTML =
          e + " must have less than equal to 30 characters";
      return false;
    }
    if (/^([a-zA-Z]+\s)*[a-zA-Z]+$/.test(r.value.trim())) {
      if (append) document.getElementById("alert_message").innerHTML += "";
      else document.getElementById("alert_message").innerHTML = "";
      return true;
    }
    if (append)
      document.getElementById("alert_message").innerHTML +=
        e + " can only contain characters<br/>";
    else
      document.getElementById("alert_message").innerHTML =
        e + " can only contain characters";
    return false;
  }
  return false;
}

function isOnlyNumber(r, e) {
  if (!isEmpty(r, e)) {
    if (/^\d+$/.test(r.value.trim())) {
      if (append) document.getElementById("alert_message").innerHTML += "";
      else document.getElementById("alert_message").innerHTML = "";
      return true;
    }
    if (append)
      document.getElementById("alert_message").innerHTML +=
        e + " can only contain Numbers<br/>";
    else
      document.getElementById("alert_message").innerHTML =
        e + " can only contain Numbers";
    return false;
  }
  return false;
}

function ValidateEmail() {
  var mail = document.getElementById("email");
  if (!isEmpty(mail, "Mail")) {
    mail = mail.value;
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)) {
      if (append) document.getElementById("alert_message").innerHTML += "";
      else document.getElementById("alert_message").innerHTML = "";
      return true;
    }
    if (append)
      document.getElementById("alert_message").innerHTML += "Invalid Email";
    else document.getElementById("alert_message").innerHTML = "Invalid Email";
    return false;
  }
  return false;
}

// function validateDate(signup, e) {
//   signup = signup.value;
//   var reg = /^\s*(3[01]|[12][0-9]|0?[1-9])\-(1[012]|0?[1-9])\-((?:19|20)\d{2})\s*$/;
//   if (reg.test(signup)) {
//     if (append) document.getElementById("alert_message").innerHTML += "";
//     else document.getElementById("alert_message").innerHTML = "";
//     return true;
//   }
//   if (append)
//     document.getElementById("alert_message").innerHTML +=
//       e + " should be in DD/MM/YYYY format";
//   else
//     document.getElementById("alert_message").innerHTML =
//       e + " should be in DD/MM/YYYY format";
//   return false;
// }
