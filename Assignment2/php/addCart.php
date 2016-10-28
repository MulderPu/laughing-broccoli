<?php
    $itemNum = $_GET['item_number'];
    $itemPrice = $_GET['item_price'];

    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = "";
    }

    $quantityCheck = checkItemQuantity($itemNum);
    if($quantityCheck == true){
        echo "available";
        addItemToHold($itemNum);

        //check if session is empty
        if($_SESSION['cart'] != ""){
            //save array as a var
            $cart = $_SESSION['cart'];

            //check if inside session is empty
            if($cart[$itemNum] != ""){
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

    function toXml($cart){
        
    }

    function checkItemQuantity($itemNum){
        $filename = "../data/goods.xml";
    	$xml = new DOMDocument();
    	$xml->load($filename);

    	$goods = $xml->getElementsByTagName("good");

    	foreach ($goods as $good) {
    		$goodID = $good->getElementsByTagName("good_id")->item(0)->nodeValue;

    		if ($goodID ==$itemNum) {
    			$quantity = $good->getElementsByTagName("item_quantity")->item(0)->nodeValue;

    			if ($quantity > 0) {
    				return true;
    			} else {
    				return false;
    			}
    		}
    	}
    }

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
