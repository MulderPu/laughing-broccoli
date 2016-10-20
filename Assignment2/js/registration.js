function validateForm(){
    var email = document.getElementById("email").value;
    var pass1 = document.getElementById("pass1").value;
    var pass2 = document.getElementById("pass2").value;

    if(!urlExists('../data/customer.xml')){
       document.getElementById("myform").submit();
   }else{
       var xmlhttp;
       if (window.XMLHttpRequest){
           xmlhttp = new XMLHttpRequest();
       }
       else if (window.ActiveXObject){
           xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
       }

       xmlhttp.onreadystatechange = function() {
           if (this.readyState == 4 && this.status == 200) {
               document.getElementById("emailErr").innerHTML = "";
               document.getElementById("pwErr").innerHTML = "";

               var xmlDoc = this.responseXML;
               var customer = xmlDoc.getElementsByTagName("customer");
               for (var i = 0; i <customer.length; i++) {
                   var xmlEmail = customer[i].getElementsByTagName("email")[0].childNodes[0].nodeValue;

                   if(xmlEmail === email){
                       document.getElementById("emailErr").innerHTML = "Email had been used.";
                       break;
                   }else if (pass1 != pass2){
                       document.getElementById("pass1").value = "";
                       document.getElementById("pass2").value = "";
                       document.getElementById("pwErr").innerHTML = "Password is incorrect!";
                       break;
                   }
                   else{
                       document.getElementById("myform").submit();
                   }
               }
           }
       };

       xmlhttp.open("GET", "../data/customer.xml", true);
       xmlhttp.send();
       return false;
   }

    function urlExists(url){
        if (window.XMLHttpRequest){ // code for IE7+, Firefox, Chrome, Opera, Safari
          var xmlhttp = new XMLHttpRequest();
        }
        else{
          var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.open('HEAD', url, false);
        xmlhttp.send();
        return xmlhttp.status != 404;
    }

    return false;
}
