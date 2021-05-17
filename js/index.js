var x1, x2, x3, x4, x5, x6;
x1 = x2 = x3 = x4 = x5 = x6 = false;
var submitButton = document.getElementById("submitButton");

function disableButton(button) {
    let checkAll = x1 && x2 && x3 && x4 && x5 && x6;
    if(checkAll){
        button.disabled = false;
    }
    else if(!checkAll){
        button.disabled = true;
    }
}

var usernamebox = document.getElementById("usernamebox");
usernamebox.addEventListener("input", ()=> {

    let username = new RegExp("^(?=.{3,20}$)(?![.])(?!.*[.]{2})[a-zA-Z0-9._]+(?<![.])$");
    let isMatch = username.test(usernamebox.value);

    let isAvailable;
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let errmsg = document.getElementById("username-taken-error");
                if(this.responseText == "no"){
                    isAvailable = false;
                    if(usernamebox.value.length != 0)
                        errmsg.classList.add("show");
                }
                else if(this.responseText == "yes"){
                    isAvailable = true;
                        errmsg.classList.remove("show");
                }
                if (usernamebox.value.length == 0){
                    document.getElementById("usernameWarning").innerHTML = '<i class="far fa-circle" style="color: #c4c6ca"></i>';
                    x6=false;
                }
                else if((!isMatch || !isAvailable) && usernamebox.value.length != 0){
                    document.getElementById("usernameWarning").innerHTML = '<i class="far fa-times-circle" style="color: red"></i>';
                    x6=false;
                }
                else if (isMatch && isAvailable){
                    document.getElementById("usernameWarning").innerHTML = '<i class="far fa-check-circle" style="color: green"></i>';
                    x6=true;
                }
                disableButton(submitButton);
            }
        }
        xhr.open("GET", "../php/check_username.php?q=" + usernamebox.value, true);
        xhr.send();
});

var namebox = document.getElementById("fullnamebox");
namebox.addEventListener("input", ()=> {
    let name = new RegExp("^([a-zA-Z '\.])+$");
    let isMatch = name.test(namebox.value);
    if (namebox.value.length == 0){
        document.getElementById("nameWarning").innerHTML = '<i class="far fa-circle" style="color: #c4c6ca"></i>';
        x1=false;
    }
    else if(!isMatch){
        document.getElementById("nameWarning").innerHTML = '<i class="far fa-times-circle" style="color: red"></i>';
        x1=false;
    }
    else if (isMatch){
        document.getElementById("nameWarning").innerHTML = '<i class="far fa-check-circle" style="color: green"></i>';
        x1=true;
    }
    disableButton(submitButton);
});

var agebox = document.getElementById("agebox");
agebox.addEventListener("input", () => {
    let age = Number(agebox.value);
    if (agebox.value.length == 0){
        document.getElementById("ageWarning").innerHTML = '<i class="far fa-circle" style="color: #c4c6ca"></i>';
        x2=false;
    }
    else if( age<0 || age>150 ){
        document.getElementById("ageWarning").innerHTML = '<i class="far fa-times-circle" style="color: red"></i>';
        x2=false;
    }
    else if( age >= 0 && age <= 150 ){
        document.getElementById("ageWarning").innerHTML = '<i class="far fa-check-circle" style="color: green"></i>';
        x2=true;
    }
    disableButton(submitButton);
});   


var emailbox = document.getElementById("emailbox");
emailbox.addEventListener("input", ()=> {
    let email = new RegExp("^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9])+\.)+([a-zA-Z0-9]{2,5})+$");
    let isMatch = email.test(emailbox.value);
    if (emailbox.value.length == 0){
        document.getElementById("emailWarning").innerHTML = '<i class="far fa-circle" style="color: #c4c6ca"></i>';
        x3=false;
    }
    else if(!isMatch){
        document.getElementById("emailWarning").innerHTML = '<i class="far fa-times-circle" style="color: red"></i>';
        x3=false;
    }
    else if (isMatch){
        document.getElementById("emailWarning").innerHTML = '<i class="far fa-check-circle" style="color: green"></i>';
        x3=true;
    }
    disableButton(submitButton);
});

var phbox = document.getElementById("phnumberbox");
phbox.addEventListener("input", () => {
    let phnumber = new RegExp(/^((\+91-)?[6-9][0-9]{9})$/);
    let isMatch = phnumber.test(phbox.value);
    if (phbox.value.length == 0) {
        document.getElementById("phnumberWarning").innerHTML = '<i class="far fa-circle" style="color: #c4c6ca"></i>';
        x4=false;
    }
    else if(!isMatch){
        document.getElementById("phnumberWarning").innerHTML = '<i class="far fa-times-circle" style="color: red"></i>';
        x4=false;
    }
    else if (isMatch){
        document.getElementById("phnumberWarning").innerHTML = '<i class="far fa-check-circle" style="color: green"></i>';
        x4=true;
    }
    disableButton(submitButton);
});

var password = document.getElementById("passwordbox");
password.addEventListener("input", () => {
    if (cpassword.value.length == 0){
        document.getElementById("cpassWarning").innerHTML = '<i class="far fa-circle" style="color: #c4c6ca"></i>';
        x5=false;
    }
    else if ( cpassword.value === password.value){
        document.getElementById("cpassWarning").innerHTML = '<i class="far fa-check-circle" style="color: green"></i>';
        x5=true;
    }
    else if ( cpassword.value !== password.value){
        document.getElementById("cpassWarning").innerHTML = '<i class="far fa-times-circle" style="color: red"></i>';
        x5=false;
    }
    disableButton(submitButton);
});

var cpassword = document.getElementById("cpasswordbox");

cpassword.addEventListener("input", () => {
    if (cpassword.value.length == 0){
        document.getElementById("cpassWarning").innerHTML = '<i class="far fa-circle" style="color: #c4c6ca"></i>';
        x5=false;
    }
    else if ( cpassword.value === password.value){
        document.getElementById("cpassWarning").innerHTML = '<i class="far fa-check-circle" style="color: green"></i>';
        x5=true;
    }
    else if ( cpassword.value !== password.value){
        document.getElementById("cpassWarning").innerHTML = '<i class="far fa-times-circle" style="color: red"></i>';
        x5=false;
    }
    disableButton(submitButton);
});

