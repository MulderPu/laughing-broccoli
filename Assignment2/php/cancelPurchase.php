<?php
    session_start();
    $array = array();

    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = "";
    }

    if($_SESSION['cart'] != ""){
        $cart = $_SESSION['cart'];
        // $array = array();
        foreach ($cart as $itemNum => $data) {
            array_push($array, $itemNum);
        }
    }

    foreach ($array as $itemNum) {
        cancelPurchase($itemNum);
    }

    $_SESSION['cart'] = "";
    echo "cancel";

    function cancelPurchase($itemNum){
        if ( $_SESSION['cart'] != "" ) {
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
            			$hold = $good->getElementsByTagName('on_hold')->item(0)->nodeValue;
                        $good->getElementsByTagName("on_hold")->item(0)->nodeValue = $hold - $quantity;;

                        $quantityAvailable = $good->getElementsByTagName('item_quantity')->item(0)->nodeValue;
                        $good->getElementsByTagName('item_quantity')->item(0)->nodeValue = $quantity + $quantityAvailable;
            		}
            	}
                $xml->save($filename); //save to xml
                unset($cart[$itemNum]); //destroy this item
            }
        }
    }





?>
