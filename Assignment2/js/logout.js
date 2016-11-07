var xmlhttp;
if (window.XMLHttpRequest){ //code for modern browsers
    xmlhttp = new XMLHttpRequest();
}
else if (window.ActiveXObject){ // code for IE6, IE5
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}

xmlhttp.open("GET", "../php/logout.php", true);
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var resp = this.responseText;
        document.getElementById('user').innerHTML = resp;
    }
}

xmlhttp.send(null);
