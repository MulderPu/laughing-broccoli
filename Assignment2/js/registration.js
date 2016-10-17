function validateForm(){
    var match = true;

    var email = document.getElementById("email").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // alert(xmlhttp.responseText);
            var xmlDoc = this.responseXML;
            var x = xmlDoc.getElementsByTagName("customer");
            for (var i = 0; i <x.length; i++) {
                var xmlEmail = x[i].getElementsByTagName("email")[0].childNodes[0].nodeValue;

                if(xmlEmail === email){
                    document.getElementById("emailErr").innerHTML = "Email had been used.";
                    break;
                }else{
                    document.getElementById("myform").submit();
                }
            }
        }
        return false;
    };

    xmlhttp.open("GET", "../data/customer.xml", true);
    xmlhttp.send();
    return false;




    //
    // var pass1 = document.getElementById("pass1").value;
    // var pass2 = document.getElementById("pass2").value;
    //
    // if (pass1 != pass2) {
    //     document.getElementById("pass1").value = "";
    //     document.getElementById("pass2").value = "";
    //     document.getElementById("pwErr").innerHTML = "Password is incorrect!";
    //     match = false;
    // }
    //
    return match;
}
