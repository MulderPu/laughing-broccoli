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

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            var resp = this.responseText;
            // alert(resp);
            // console.log(responseText);
            if (resp == "success") {
                alert("1");
                document.getElementById("status").innerHTML = "Login Success!";
                location.href = "../htm/buyonline.htm";
            }else{
                alert("2");
                document.getElementById("status").innerHTML = "Failed to login. Invalid ID or password. Please check again!";
                document.getElementById("manager_id").value = "";
                document.getElementById("password").value = "";
            }
        }
    }
    xmlhttp.open("GET", "../php/managerLogin.php?manager_id=" + manager_id + "&password=" + password, true);
    xmlhttp.send(null);
}
