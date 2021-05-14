var x1, x2, x3, x4, x5, x6;
x1 = x2 = x3 = x4 = x5 = x6 = false;
var submitButton = document.getElementById("submitButton");

var usernamebox = document.getElementById("usernamebox");
usernamebox.addEventListener("input", ()=> {
    let username = new RegExp("^(?=.{3,20}$)(?![.])(?!.*[.]{2})[a-zA-Z0-9._]+(?<![.])$");
    let isMatch = username.test(usernamebox.value);
    if (usernamebox.value.length == 0){
        document.getElementById("usernameWarning").innerHTML = '<i class="far fa-circle" style="color: #c4c6ca"></i>';
        x6=false;
    }
    else if(!isMatch){
        document.getElementById("usernameWarning").innerHTML = '<i class="far fa-times-circle" style="color: red"></i>';
        x6=false;
    }
    else if (isMatch){
        document.getElementById("usernameWarning").innerHTML = '<i class="far fa-check-circle" style="color: green"></i>';
        x6=true;
    }
    let checkAll = x1 && x2 && x3 && x4 && x5 && x6;
    if(checkAll){
        submitButton.disabled = false;
    }
    else if(!checkAll){
        submitButton.disabled = true;
    }

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
    let checkAll = x1 && x2 && x3 && x4 && x5 && x6;
    if(checkAll){
        submitButton.disabled = false;
    }
    else if(!checkAll){
        submitButton.disabled = true;
    }

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
    let checkAll = x1 && x2 && x3 && x4 && x5 && x6;
    if(checkAll){
        submitButton.disabled = false;
    }
    else if(!checkAll){
        submitButton.disabled = true;
    }
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
    let checkAll = x1 && x2 && x3 && x4 && x5 && x6;
    if(checkAll){
        submitButton.disabled = false;
    }
    else if(!checkAll){
        submitButton.disabled = true;
    }
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
    let checkAll = x1 && x2 && x3 && x4 && x5 && x6;
    if(checkAll){
        submitButton.disabled = false;
    }
    else if(!checkAll){
        submitButton.disabled = true;
    }
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
    let checkAll = x1 && x2 && x3 && x4 && x5 && x6;
    if(checkAll){
        submitButton.disabled = false;
    }
    else if(!checkAll){
        submitButton.disabled = true;
    }
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
    let checkAll = x1 && x2 && x3 && x4 && x5 && x6;
    if(checkAll){
        submitButton.disabled = false;
    }
    else if(!checkAll){
        submitButton.disabled = true;
    }
});

