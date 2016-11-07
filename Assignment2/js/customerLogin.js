function customerLogin(){
    var xmlhttp;
    if (window.XMLHttpRequest){ //code for modern browsers
        xmlhttp = new XMLHttpRequest();
    }
    else if (window.ActiveXObject){ // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    // get customer and password input from user
    var customer_email = document.getElementById("customer_email").value;
    var password = document.getElementById("password").value;

    xmlhttp.open("GET", "../php/customerLogin.php?customer_email=" + customer_email + "&password=" + password, true);
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) { //data load and status ok
            document.getElementById("status").innerHTML = "";

            var resp = this.responseText;
            // alert(resp);
            if (resp == "success") {
                // redirect to buying page
                window.location = "../htm/buying.htm";
            }else{
                // show error message, clear input text
                document.getElementById("status").innerHTML = "Invalid email or password. Please check again!";
                document.getElementById("customer_email").value = "";
                document.getElementById("password").value = "";
            }
        }
    }

    xmlhttp.send(null);

}
