var xmlhttp;
if (window.XMLHttpRequest){ //code for modern browsers
    xmlhttp = new XMLHttpRequest();
}
else if (window.ActiveXObject){ // code for IE6, IE5
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}

xmlhttp.open("GET", "../php/manager.php", true);
xmlhttp.onreadystatechange = function() {
    //data load and status ok
    if (this.readyState == 4 && this.status == 200) {

        //get return get from server
        var resp = this.responseText;
        console.log(resp);

        if (resp != "") {
            document.getElementById('listing').innerHTML = "<a href=\"../htm/listing.htm\">Listing</a>";
            document.getElementById('processing').innerHTML = "<a href=\"../htm/processing.htm\">Processing</a>";
            document.getElementById('logout').innerHTML = "<a href=\"../htm/logout.htm\">Logout</a>";
            document.getElementById('home').style.visibility = "hidden";
            document.getElementById('register').style.visibility = "hidden";
            document.getElementById('login').style.visibility = "hidden";
            document.getElementById('mlogin').style.visibility = "hidden";
            document.getElementById('manager').innerHTML = "Hello, " + resp;
        }
    }
}

xmlhttp.send(null);
