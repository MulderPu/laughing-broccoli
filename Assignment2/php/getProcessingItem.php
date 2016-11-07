<?php
    header('Content-Type: text/xml');

    $filename = "../data/goods.xml";

    $xml = new DOMDocument();
    $xml->load($filename);
    echo $xml->savexml();
?>
