<?php
    session_start();

    $itemNum = $_GET['item_number'];

    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = "";
    }

    if($_SESSION['cart'] != ""){
        $cart = $_SESSION['cart'];

        if (isset($cart[$itemNum])) {
            $quantity = $cart[$itemNum][0];
            // echo $quantity;

            $filename = "../data/goods.xml";
            $xml = new DOMDocument();
            $xml->load($filename);

            $goods = $xml->getElementsByTagName("good");
            foreach ($goods as $good) {
        		$goodID = $good->getElementsByTagName("good_id")->item(0)->nodeValue;

        		if ($goodID == $itemNum) {
                    //add quantity back
        			$quantityAvailable = $good->getElementsByTagName('item_quantity')->item(0)->nodeValue;
                    $good->getElementsByTagName("item_quantity")->item(0)->nodeValue = $quantity + $quantityAvailable;

                    $hold = $good->getElementsByTagName("on_hold")->item(0)->nodeValue;
                    $good->getElementsByTagName("on_hold")->item(0)->nodeValue = $hold - $quantity;
        		}
        	}
            $xml->save($filename); //save to xml
            unset($cart[$itemNum]); //destroy this item
        }

        //rewrite session
        $_SESSION["cart"] = $cart;
		return toXml($cart);
    }

    function toXml($cart){

        $xmlFile = "../data/testing.xml";
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
?>
