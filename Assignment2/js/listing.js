function add(){
    var error = false;
    var numbers = /^[0-9]+$/;

    //check item name
    if(document.getElementById('item_name').value == ""){
        document.getElementById('nameErr').innerHTML = "Item name is required.";
        error = true;
    }else{
        document.getElementById('nameErr').innerHTML = "";
    }

    // check item price
    if(document.getElementById('item_price').value == ""){
        document.getElementById('priceErr').innerHTML = "Item price is required.";
        error = true;
    }else if(!document.getElementById("item_price").value.match(numbers)){
        error = true;
        document.getElementById('priceErr').innerHTML = "Item price required numbers only.";
        document.getElementById('item_price').value = "";
    }
    else{
        document.getElementById('priceErr').innerHTML = "";
    }

    // check item quantity
    if(document.getElementById('item_quantity').value == ""){
        document.getElementById('quanErr').innerHTML = "Item quantity is required.";
        error = true;
    }else if(!document.getElementById("item_quantity").value.match(numbers)){
        error = true;
        document.getElementById('quanErr').innerHTML = "Item quantity required numbers only.";
        document.getElementById('item_quantity').value="";
    }else{
        document.getElementById('quanErr').innerHTML = "";
    }

    // check item description
    if(document.getElementById('item_desc').value == ""){
        document.getElementById('descErr').innerHTML = "Item description is required.";
        error = true;
    }else{
        document.getElementById('descErr').innerHTML = "";
    }

    // check if no error, add item to database
    if(error == false){
        addCart();
    }

    function addCart(){
        var xmlhttp;
        if (window.XMLHttpRequest){ //code for modern browsers
            xmlhttp = new XMLHttpRequest();
        }
        else if (window.ActiveXObject){ // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        var item_name = document.getElementById('item_name').value;
        var item_price = document.getElementById('item_price').value;
        var item_quantity = document.getElementById('item_quantity').value;
        var item_desc = document.getElementById('item_desc').value;

        xmlhttp.open("GET", "../php/listing.php?item_name="
            + encodeURIComponent(item_name)
            + "&item_price="
            + item_price
            + "&item_quantity="
            + item_quantity
            + "&item_desc="
            + encodeURIComponent(item_desc)
            ,true
        );

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var resp = this.responseText;

                document.getElementById('status').innerHTML
                = "The item has been listed in the system, and the item number is "
                + resp + ".";

                //clean form
                document.getElementById('item_name').value = "";
                document.getElementById('item_price').value = "";
                document.getElementById('item_quantity').value = "";
                document.getElementById('item_desc').value = "";
            }
        }
        xmlhttp.send(null);
    }
}

// clear form
function reset(){
    document.getElementById('item_name').value = "";
    document.getElementById('item_price').value = "";
    document.getElementById('item_quantity').value = "";
    document.getElementById('item_desc').value = "";
}
