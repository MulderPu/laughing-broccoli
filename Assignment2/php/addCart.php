<?php
    $itemNum = $_GET['item_number'];
    $itemPrice = $_GET['item_price'];

    $quantityCheck = checkItemQuantity($itemNum);
    if($quantityCheck == true){
        echo "available";
    }else{
        echo "unavailable";
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

?>
