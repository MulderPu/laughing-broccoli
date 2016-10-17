<?php
    $xmlFile = "customer.xml";
    $HTML = "";
    $count = 0;
    $totalTemp = 0;
    $avgTemp = 0;

    $xmlDoc = new DOMDocument();
    $xmlDoc->load($xmlFile);

    $information = $xml->getElementsByTagName("customer");

    $query = array();

    foreach($information as $node)
    {
    	$email = $node->getElementsByTagName("email");
      	$email = $email->item(0)->nodeValue;

    	$query = $email;
        $count++;
    }

    if ($count == 0){
        $HTML = "<br><span>Nothing in there</span>";
    }else{
        foreach($query as $email){
            $HTML = $HTML."<br>".$email."/".$month."/".$year." : ".$maxTemp."<br>";
        }
    }
    echo $HTML;
?>
