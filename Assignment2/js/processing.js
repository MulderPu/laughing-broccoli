var xmlhttp;
if (window.XMLHttpRequest){ //code for modern browsers
    xmlhttp = new XMLHttpRequest();
}
else if (window.ActiveXObject){ // code for IE6, IE5
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}

getProcessingItem(); //get processing item from db

function getProcessingItem(){
    xmlhttp.open("GET", "../php/getProcessingItem.php", true);
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) { //data load and status ok

            var resp = this.responseXML;
            // console.log(resp);

            var good = resp.getElementsByTagName("good");
            var table = document.getElementById('tableProcess');

            //remove old lists
        	while (table.childElementCount > 1) {
        		table.removeChild(table.lastChild);
        	}

            for (var i = 0; i < good.length; i++) {
                var quantitySold = good[i].getElementsByTagName('quantity_sold')[0].textContent;

                if(quantitySold != 0){
                    var tr = document.createElement('tr');
                    var td_itemNumber = document.createElement('td');
                    var td_itemName   = document.createElement('td');
                    var td_itemPrice  = document.createElement('td');
                    var td_itemQuantity = document.createElement('td');
                    var td_itemOnHold = document.createElement('td');
                    var td_itemSold = document.createElement('td');

                    var itemNumber = document.createTextNode(good[i].getElementsByTagName('good_id')[0].textContent);
                    var itemName = document.createTextNode(good[i].getElementsByTagName('item_name')[0].textContent);
                    var itemPrice = document.createTextNode(good[i].getElementsByTagName('item_price')[0].textContent);
                    var itemQuantity = document.createTextNode(good[i].getElementsByTagName('item_quantity')[0].textContent);
                    var itemOnHold = document.createTextNode(good[i].getElementsByTagName('on_hold')[0].textContent);
                    var itemSold = document.createTextNode(good[i].getElementsByTagName('quantity_sold')[0].textContent);

                    td_itemNumber.appendChild(itemNumber);
                    td_itemName.appendChild(itemName);
                    td_itemPrice.appendChild(itemPrice);
                    td_itemQuantity.appendChild(itemQuantity);
                    td_itemOnHold.appendChild(itemOnHold);
                    td_itemSold.appendChild(itemSold);

                    tr.appendChild(td_itemNumber);
                    tr.appendChild(td_itemName);
                    tr.appendChild(td_itemPrice);
                    tr.appendChild(td_itemQuantity);
                    tr.appendChild(td_itemOnHold);
                    tr.appendChild(td_itemSold);

                    table.appendChild(tr);
                }
            }

            //table row for button process
            var tr = document.createElement('tr');
            var td_addButton = document.createElement('td');
            var td_button = document.createElement('button');
            var buttonText = document.createTextNode('Process');
            td_button.appendChild(buttonText);
            td_button.setAttribute('type','button');
            td_button.setAttribute('onclick',"process()");
            td_addButton.appendChild(td_button);
            td_addButton.setAttribute('colSpan','6');
            td_addButton.setAttribute('align','center');
            tr.appendChild(td_addButton);
            table.appendChild(tr);
        }
    }
    xmlhttp.send(null);
}

// process item in the table 
function process(){
    xmlhttp.open("GET", "../php/process.php?", true);
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var resp = this.responseText;

            var table = document.getElementById('tableProcess');

            //remove old lists
            while (table.childElementCount > 1) {
                table.removeChild(table.lastChild);
            }
        }
    }
    xmlhttp.send(null);
}
