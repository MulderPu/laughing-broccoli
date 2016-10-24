function managerLogin(){
    var xmlhttp;
    if (window.XMLHttpRequest){
        xmlhttp = new XMLHttpRequest();
    }
    else if (window.ActiveXObject){
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    var manager_id = document.getElementById("manager_id").value;
    var password = document.getElementById("password").value;

    xmlhttp.open("GET", "../php/managerLogin.php?manager_id=" + manager_id + "&password=" + password, true);
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("status").innerHTML = "";

            var resp = this.responseText;

            if (resp == "success") {
                window.location = "../htm/buyonline.htm";
            }else{
                // alert("FAILED");
                document.getElementById("status").innerHTML = "Invalid ID or password. Please check again!";
                document.getElementById("manager_id").value = "";
                document.getElementById("password").value = "";
            }
        }
    }

    xmlhttp.send(null);

}
