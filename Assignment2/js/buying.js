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

            if( resp == "unavailable"){
                alert("Sorry, this item is not available for sale.");
            }else{
                var parser = new DOMParser();
                var xmlDoc = parser.parseFromString(resp,"text/xml");

                printShoppingCart(xmlDoc);
            }
        }
    }
    xmlhttp.send(null);
}

function printShoppingCart(xmlDoc){
    var item = xmlDoc.getElementsByTagName('item');
    var table = document.getElementById('tableCart');

    //remove old lists
    while (table.childElementCount > 1) {
        table.removeChild(table.lastChild);
    }

    for (var i = 0; i < item.length; i++) {

        var tr = document.createElement('tr');

        var td_itemNumber = document.createElement('td');
        var td_itemPrice  = document.createElement('td');
        var td_itemQuantity = document.createElement('td');
        var td_addButton = document.createElement('td');
        var td_button = document.createElement('button');

        var itemNumber = document.createTextNode(item[i].getElementsByTagName('item_number')[0].textContent);
        var itemPrice = document.createTextNode(item[i].getElementsByTagName('item_price')[0].textContent);
        var itemQuantity = document.createTextNode(item[i].getElementsByTagName('item_quantity')[0].textContent);
        var buttonText = document.createTextNode('Remove from cart');

        td_itemNumber.appendChild(itemNumber);
        td_itemPrice.appendChild(itemPrice);
        td_itemQuantity.appendChild(itemQuantity);
        td_addButton.appendChild(td_button);
        td_button.appendChild(buttonText);
        td_button.setAttribute('type','button');
        td_button.setAttribute('onclick',"removeCart(" + itemNumber.nodeValue + ")");

        tr.appendChild(td_itemNumber);
        tr.appendChild(td_itemPrice);
        tr.appendChild(td_itemQuantity);
        tr.appendChild(td_addButton);

        table.appendChild(tr);
    }

    //table row that print total
    var tr = document.createElement('tr');
    var td_totalLabel = document.createElement('td');
    var td_totalValue = document.createElement('td');
    var totalLabel = document.createTextNode("Total: ");
    var totalValue = document.createTextNode("$" + xmlDoc.getElementsByTagName('total')[0].textContent);
    td_totalLabel.appendChild(totalLabel);
    td_totalLabel.setAttribute('colSpan','3');
    td_totalValue.appendChild(totalValue);
    td_totalValue.setAttribute('id', 'totalValue');
    tr.appendChild(td_totalLabel);
    tr.appendChild(td_totalValue);
    table.appendChild(tr);

    //table row for button confirm purchase
    var tr = document.createElement('tr');
    var td_addButton1 = document.createElement('td');
    var td_button1 = document.createElement('button');
    var buttonText1 = document.createTextNode('Confirm Purchase');
    td_button1.appendChild(buttonText1);
    td_button1.setAttribute('type','button');
    td_button1.setAttribute('onclick',"confirmPurchase()");
    td_addButton1.appendChild(td_button1);
    td_addButton1.setAttribute('colSpan','2');
    td_addButton1.setAttribute('align','center');
    tr.appendChild(td_addButton1);

    // button cancel purchase
    var td_addButton2 = document.createElement('td');
    var td_button2 = document.createElement('button');
    var buttonText2 = document.createTextNode('Cancel Purchase');
    td_button2.appendChild(buttonText2);
    td_button2.setAttribute('type','button');
    td_button2.setAttribute('onclick',"");
    td_addButton2.appendChild(td_button2);
    td_addButton2.setAttribute('colSpan','2');
    td_addButton2.setAttribute('align','center');
    tr.appendChild(td_addButton2);

    table.appendChild(tr);
}

function confirmPurchase(){
    xmlhttp.open("GET", "../php/confirmPurchase.php?", true);
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var resp = this.responseText;
            if (resp == "confirm") {
                var totalValue = document.getElementById('totalValue').innerHTML;
                // alert(totalValue);
                // console.log(totalValue);
                var table = document.getElementById('tableCart');

                //remove old lists
                while (table.childElementCount > 1) {
                    table.removeChild(table.lastChild);
                }
                alert("Your purchase has been confirmed and total amount due to pay is " + totalValue + ".");
            }
        }
    }
    xmlhttp.send(null);
}

function removeCart(item_number){
    xmlhttp.open("GET", "../php/removeCart.php?item_number=" + item_number, true);
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var resp = this.responseText;
            var parser = new DOMParser();
            var xmlDoc = parser.parseFromString(resp,"text/xml");

            printShoppingCart(xmlDoc);
        }
    }
    xmlhttp.send(null);
}
