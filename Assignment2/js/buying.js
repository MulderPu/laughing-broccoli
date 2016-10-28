var xmlhttp;
if (window.XMLHttpRequest){
    xmlhttp = new XMLHttpRequest();
}
else if (window.ActiveXObject){
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}

getShoppingItem();
retrieveData();

function retrieveData(){
    var refresh=setInterval(getShoppingItem, 10000);
}

function getShoppingItem(){

    xmlhttp.open("GET", "../php/getShoppingItem.php", true);
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            var resp = this.responseXML;

            var good = resp.getElementsByTagName("good");
            var table = document.getElementById('tableCatalog');

            //remove old lists
        	while (table.childElementCount > 1) {
        		table.removeChild(table.lastChild);
        	}

            for (var i = 0; i < good.length; i++) {
                var quantity = good[i].getElementsByTagName('item_quantity')[0].textContent;
                if(quantity != 0){
                    var tr = document.createElement('tr');
                    var td_itemNumber = document.createElement('td');
                    var td_itemName   = document.createElement('td');
                    var td_itemDesc   = document.createElement('td');
                    var td_itemPrice  = document.createElement('td');
                    var td_itemQuantity = document.createElement('td');
                    var td_addButton = document.createElement('td');
                    var td_button = document.createElement('button');

                    var itemNumber = document.createTextNode(good[i].getElementsByTagName('good_id')[0].textContent);
                    var itemName = document.createTextNode(good[i].getElementsByTagName('item_name')[0].textContent);
                    var itemDesc = document.createTextNode(good[i].getElementsByTagName('item_desc')[0].textContent.substring(0,20));
                    var itemPrice = document.createTextNode(good[i].getElementsByTagName('item_price')[0].textContent);
                    var itemQuantity = document.createTextNode(good[i].getElementsByTagName('item_quantity')[0].textContent);
                    var buttonText = document.createTextNode('Add one to cart');

                    td_itemNumber.appendChild(itemNumber);
                    td_itemName.appendChild(itemName);
                    td_itemDesc.appendChild(itemDesc);
                    td_itemPrice.appendChild(itemPrice);
                    td_itemQuantity.appendChild(itemQuantity);
                    td_addButton.appendChild(td_button);
                    td_button.appendChild(buttonText);
                    td_button.setAttribute('type','button');
                    td_button.setAttribute('onclick',"addCart(" + itemNumber.nodeValue + "," + itemPrice.nodeValue + ")");

                    tr.appendChild(td_itemNumber);
                    tr.appendChild(td_itemName);
                    tr.appendChild(td_itemDesc);
                    tr.appendChild(td_itemPrice);
                    tr.appendChild(td_itemQuantity);
                    tr.appendChild(td_addButton);

                    table.appendChild(tr);
                }
            }
        }
    }
    xmlhttp.send(null);
}

function addCart(item_number, item_price){
    xmlhttp.open("GET", "../php/addCart.php?item_number=" + item_number + "&item_price=" + item_price, true);
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var resp = this.responseText;
            // alert(resp);

            if( resp == "unavailable"){
                alert("Sorry, this item is not available for sale.");
            }else if (resp == "available"){
                alert("yes");
            }
        }
    }
    xmlhttp.send(null);
}
