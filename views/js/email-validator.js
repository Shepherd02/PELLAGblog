
function validateEmail(e){
    var email = document.getElementById('login-email').value;
    
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
        return true;
    }
    alert("You have entered an invalid email/password")
    return false;
}


