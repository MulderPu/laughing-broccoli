<?php
    $filename = "../data/goods.xml";
    $xml = new DOMDocument();
    $xml->load($filename);

    $root = $xml->getElementsByTagName('goods')->item(0);
    $goods = $xml->getElementsByTagName("good");

    foreach ($goods as $good) {
        $quantitySold = $good->getElementsByTagName("quantity_sold")->item(0)->nodeValue;
        $quantityAvailable = $good->getElementsByTagName("item_quantity")->item(0)->nodeValue;
        $hold = $good->getElementsByTagName("on_hold")->item(0)->nodeValue;

        if ($quantitySold != 0) {
            $good->getElementsByTagName('quantity_sold')->item(0)->nodeValue = 0;
        }

        if(($quantityAvailable == 0 ||  $quantityAvailable == "" ) && ($hold == 0 || $hold == "")){
            // echo "yes";
            $root->removeChild($good);
        }
    }


    $xml->save($filename); //save to xml


?>
