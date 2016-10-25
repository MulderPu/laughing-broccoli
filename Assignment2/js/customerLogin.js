function customerLogin(){
    var xmlhttp;
    if (window.XMLHttpRequest){
        xmlhttp = new XMLHttpRequest();
    }
    else if (window.ActiveXObject){
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    var customer_email = document.getElementById("customer_email").value;
    var password = document.getElementById("password").value;

    xmlhttp.open("GET", "../php/customerLogin.php?customer_email=" + customer_email + "&password=" + password, true);
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("status").innerHTML = "";

            var resp = this.responseText;
            alert(resp);
            if (resp == "success") {
                window.location = "../htm/buying.htm";
            }else{
                document.getElementById("status").innerHTML = "Invalid email or password. Please check again!";
                document.getElementById("customer_email").value = "";
                document.getElementById("password").value = "";
            }
        }
    }

    xmlhttp.send(null);

}
