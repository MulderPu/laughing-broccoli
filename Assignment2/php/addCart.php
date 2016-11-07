<?php
    session_start();

    $itemNum = $_GET['item_number'];
    $itemPrice = $_GET['item_price'];

    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = "";
    }

    $quantityCheck = checkItemQuantity($itemNum);
    if($quantityCheck == true){
        // echo "available";
        addItemToHold($itemNum);

        //check if session is empty
        if($_SESSION['cart'] != ""){
            //save array as a var
            $cart = $_SESSION['cart'];

            //check if inside session is empty
            if(isset($cart[$itemNum])){
                //if not , then add 1
                $quantity = $cart[$itemNum][0] + 1;
    			$cart[$itemNum][0] = $quantity;
            }else{
                //create array,add quantity and price
                $item = array(1, $itemPrice);
    			$cart[$itemNum] = $item;
            }

        }else{
            //create array, add item quantity and item price into array
            $item = array(1, $itemPrice);
			$cart[$itemNum] = $item;
        }

        //rewrite session
        $_SESSION["cart"] = $cart;
		return toXml($cart);
    }else{
        echo "unavailable";
    }

    // save into xml
    function toXml($cart){
        // $xmlFile = "../data/testing.xml";
        $xml = new DOMDocument("1.0","UTF-8");
        $xml->formatOutput=true;
        $total =0;
        $cartTag = $xml->createElement("cart");
        $itemsTag = $xml->createElement("items");

        foreach ($cart as $itemNum => $data) {
            $itemTag = $xml->createElement('item');
            $itemNumTag = $xml->createElement('item_number');
            $itemQuantityTag = $xml->createElement('item_quantity');
            $itemPriceTag = $xml->createElement('item_price');

            $itemNumTagText = $xml->createTextNode($itemNum);
            $itemQuantityTagText = $xml->createTextNode($data[0]);
            $itemPriceTagText = $xml->createTextNode($data[1]);

            $itemNumTag->appendChild($itemNumTagText);
            $itemQuantityTag->appendChild($itemQuantityTagText);
            $itemPriceTag->appendChild($itemPriceTagText);

            $itemTag->appendChild($itemNumTag);
            $itemTag->appendChild($itemQuantityTag);
            $itemTag->appendChild($itemPriceTag);

            $itemsTag->appendChild($itemTag);

            $productPrice = $data[0] * $data[1];
            $total += $productPrice;
        }

        $totalTag = $xml->createElement('total');
        $totalTagText = $xml->createTextNode($total);
        $totalTag->appendChild($totalTagText);

        $cartTag->appendChild($totalTag);
        $cartTag->appendChild($itemsTag);

        $xml->appendChild($cartTag);
        $xmlDoc= $xml->saveXML();
        echo $xmlDoc;
        // $xml->save($xmlFile);
    }

    //check quantity of item available
    function checkItemQuantity($itemNum){
        $filename = "../data/goods.xml";
    	$xml = new DOMDocument();
    	$xml->load($filename);

    	$goods = $xml->getElementsByTagName("good");

    	foreach ($goods as $good) {
    		$goodID = $good->getElementsByTagName("good_id")->item(0)->nodeValue;

    		if ($goodID ==$itemNum) {
    			$quantity = $good->getElementsByTagName("item_quantity")->item(0)->nodeValue;

    			if ($quantity != 0) {
    				return true;
    			} else {
    				return false;
    			}
    		}
    	}
    }

    // add item to on hold
    function addItemToHold($itemNum){
        $filename = "../data/goods.xml";
    	$xml = new DOMDocument();
    	$xml->load($filename);

    	$goods = $xml->getElementsByTagName("good");

    	foreach ($goods as $good) {
    		$goodID = $good->getElementsByTagName("good_id")->item(0)->nodeValue;

    		if ($goodID ==$itemNum) {
    			$quantity = $good->getElementsByTagName("item_quantity")->item(0)->nodeValue;
                $good->getElementsByTagName("item_quantity")->item(0)->nodeValue = $quantity - 1;

                $hold = $good->getElementsByTagName("on_hold")->item(0)->nodeValue;
                $good->getElementsByTagName("on_hold")->item(0)->nodeValue = $hold + 1;
    		}
    	}
        $xml->save($filename);
    }
?>
