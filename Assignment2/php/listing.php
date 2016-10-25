<?php
    $item_name = $_GET['item_name'];
    $item_price = $_GET['item_price'];
    $item_quantity = $_GET['item_quantity'];
    $item_desc = $_GET['item_desc'];

    $xmlFile = "../data/goods.xml";
    if(!file_exists($xmlFile)){
        createXML($item_name,$item_price,$item_quantity,$item_desc);
    }else{
        saveToXML($item_name,$item_price,$item_quantity,$item_desc);
    }

    function saveToXML($item_name,$item_price,$item_quantity,$item_desc){
        $xmlFile = "../data/goods.xml";
        $xml = new DOMDocument("1.0","UTF-8");
        $xml->formatOutput=true;
        $xml->load($xmlFile);

        //id record here
        $root = $xml->documentElement;
        $goodID = $root->childNodes->length;
        $item_onHold = 0;
        $item_quantitySold = 0;

        $goodsTag = $xml->getElementsByTagName("goods")->item(0);
        $goodTag = $xml->createElement("good");
        $idTag = $xml->createElement("good_id", $goodID);
        $nameTag = $xml->createElement("item_name", $item_name);
        $priceTag = $xml->createElement("item_price",$item_price);
        $quantityTag = $xml->createElement("item_quantity",$item_quantity);
        $descTag = $xml->createElement("item_desc",$item_desc);
        $onHoldTag = $xml->createElement("on_hold", $item_onHold);
        $quantitySoldTag = $xml->createElement("quantity_sold", $item_quantitySold);

        $goodTag->appendChild($idTag);
        $goodTag->appendChild($nameTag);
        $goodTag->appendChild($priceTag);
        $goodTag->appendChild($quantityTag);
        $goodTag->appendChild($descTag);
        $goodTag->appendChild($onHoldTag);
        $goodTag->appendChild($quantitySoldTag);

        $goodsTag->appendChild($goodTag);

        $xml->appendChild($goodsTag);
        $xml->save($xmlFile);
        echo $goodID;
    }

    function createXML($item_name,$item_price,$item_quantity,$item_desc){
        $xmlFile = "../data/goods.xml";
        $goodID = 0;
        $item_onHold = 0;
        $item_quantitySold = 0;
        $xml = new DOMDocument("1.0","UTF-8");
        $xml->formatOutput=true;

        $goodsTag = $xml->createElement("goods");
        $goodTag = $xml->createElement("good");
        $idTag = $xml->createElement("customer_id", $goodID);
        $nameTag = $xml->createElement("item_name", $item_name);
        $priceTag = $xml->createElement("item_price",$item_price);
        $quantityTag = $xml->createElement("item_quantity",$item_quantity);
        $descTag = $xml->createElement("item_desc",$item_desc);
        $onHoldTag = $xml->createElement("on_hold", $item_onHold);
        $quantitySoldTag = $xml->createElement("quantity_sold", $item_quantitySold);

        $goodTag->appendChild($idTag);
        $goodTag->appendChild($nameTag);
        $goodTag->appendChild($priceTag);
        $goodTag->appendChild($quantityTag);
        $goodTag->appendChild($descTag);
        $goodTag->appendChild($onHoldTag);
        $goodTag->appendChild($quantitySoldTag);

        $goodsTag->appendChild($goodTag);

        $xml->appendChild($goodsTag);
        $xml->save($xmlFile);
    }
?>
