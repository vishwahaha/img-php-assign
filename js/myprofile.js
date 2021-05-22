if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            document.querySelector('#imagePreview').style.backgroundImage = "url(" + e.target.result + ")";
        }
        reader.readAsDataURL(input.files[0]);
    }
}

var x1, x2, x3, x4;
x1 = x2 = x3 = x4 = false;
var submitButton = document.getElementById("updateBtn");
function disableButton(button) {
    let checkAll = x1 && x2 && x3 && x4;
    if (checkAll) {
        button.disabled = false;
    } else if (!checkAll) {
        button.disabled = true;
    }
}
function verifyFields() {
    let name = new RegExp("^([a-zA-Z '.])+$");
    let email = new RegExp(
        "^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9])+.)+([a-zA-Z0-9]{2,5})+$"
    );
    let phnumber = new RegExp(/^((\+91-)?[6-9][0-9]{9})$/);
    if (name.test(namebox.value)) {
        x1 = true;
    } else x1 = false;
    if (email.test(emailbox.value)) {
        x2 = true;
    } else x2 = false;
    if (phnumber.test(phbox.value)) {
        x3 = true;
    } else x3 = false;
    if (password.value.length != 0) {
        x4 = true;
    } else x4 = false;
}

var namebox = document.getElementById("fullnamebox");
namebox.addEventListener("input", () => {
    let name = new RegExp("^([a-zA-Z '.])+$");
    let isMatch = name.test(namebox.value);
    if (namebox.value.length == 0) {
        document.getElementById("nameWarning").innerHTML =
            '<i class="far fa-circle" style="color: #c4c6ca"></i>';
        x1 = false;
    } else if (!isMatch) {
        document.getElementById("nameWarning").innerHTML =
            '<i class="far fa-times-circle" style="color: red"></i>';
        x1 = false;
    } else if (isMatch) {
        document.getElementById("nameWarning").innerHTML =
            '<i class="far fa-check-circle" style="color: green"></i>';
        x1 = true;
    }
    verifyFields();
    disableButton(submitButton);
});
var emailbox = document.getElementById("emailbox");
emailbox.addEventListener("input", () => {
    let email = new RegExp(
        "^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9])+.)+([a-zA-Z0-9]{2,5})+$"
    );
    let isMatch = email.test(emailbox.value);
    if (emailbox.value.length == 0) {
        document.getElementById("emailWarning").innerHTML =
            '<i class="far fa-circle" style="color: #c4c6ca"></i>';
        x2 = false;
    } else if (!isMatch) {
        document.getElementById("emailWarning").innerHTML =
            '<i class="far fa-times-circle" style="color: red"></i>';
        x2 = false;
    } else if (isMatch) {
        document.getElementById("emailWarning").innerHTML =
            '<i class="far fa-check-circle" style="color: green"></i>';
        x2 = true;
    }
    verifyFields();
    disableButton(submitButton);
});
var phbox = document.getElementById("phnumberbox");
phbox.addEventListener("input", () => {
    let phnumber = new RegExp(/^((\+91-)?[6-9][0-9]{9})$/);
    let isMatch = phnumber.test(phbox.value);
    if (phbox.value.length == 0) {
        document.getElementById("phnumberWarning").innerHTML =
            '<i class="far fa-circle" style="color: #c4c6ca"></i>';
        x3 = false;
    } else if (!isMatch) {
        document.getElementById("phnumberWarning").innerHTML =
            '<i class="far fa-times-circle" style="color: red"></i>';
        x3 = false;
    } else if (isMatch) {
        document.getElementById("phnumberWarning").innerHTML =
            '<i class="far fa-check-circle" style="color: green"></i>';
        x3 = true;
    }
    verifyFields();
    disableButton(submitButton);
});
var password = document.getElementById("passwordbox");
password.addEventListener("input", () => {
    if (password.value.length == 0) {
        document.getElementById("cpassWarning").innerHTML =
            '<i class="far fa-circle" style="color: #c4c6ca"></i>';
        x4 = false;
    } else x4 = true;
    verifyFields();
    disableButton(submitButton);
});
// -------------------------------------------password form----------------------------------------------
var y1, y2, y3;
y1 = y2 = y3 = false;
function disablePassButton(button) {
    let check = y1 && y2 && y3;
    if (check) {
        button.disabled = false;
    } else if (!check) {
        button.disabled = true;
    }
}

var changeButton = document.getElementById("changePass");

var newpassword = document.getElementById("newpasswordbox");
newpassword.addEventListener("input", () => {
    if (newpassword.value.length == 0) {
        y1 = false;
    }
    else if (newpassword.value.length != 0) {
        y1 = true;
    }
    disablePassButton(changeButton);
});

var cnewpassword = document.getElementById("cnewpasswordbox");
cnewpassword.addEventListener("input", () => {
    if (cnewpassword.value.length == 0) {
        y2 = false;
    }
    else if (cnewpassword.value.length != 0) {
        y2 = true;
    }
    disablePassButton(changeButton);
});

var oldpassword = document.getElementById("oldpasswordbox");
oldpassword.addEventListener("input", () => {
    if (oldpassword.value.length == 0) {
        y3 = false;
    }
    else if (oldpassword.value.length != 0) {
        y3 = true;
    }
    disablePassButton(changeButton);
});

window.onload = () => {
    verifyFields();
    disableButton(submitButton);
    disablePassButton(changeButton);
}

