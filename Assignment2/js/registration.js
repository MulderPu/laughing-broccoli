function validateForm(){
    var pass1 = document.getElementById("pass1").value;
    var pass2 = document.getElementById("pass2").value;
    var ok = true;
    if (pass1 != pass2) {
        //alert("password not match");
        document.getElementById("pass1").value = "";
        document.getElementById("pass2").value = "";
        document.getElementById("pwErr").innerHTML = "Password is incorrect!";
        ok = false;
    }
    else {
        // alert("password match!!!");
    }
    return ok;
}
