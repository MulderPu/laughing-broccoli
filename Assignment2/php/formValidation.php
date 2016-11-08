<?php
    echo "Registration success! Please click back to continue~ Have a nice day.</br>";

    if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['email']) || isset($_POST['phone']) ){
        $xmlFile = "../data/customer.xml";
        if(!file_exists($xmlFile)){
            createXML(); //create file and save if file not exist
        }else{
            saveToXML(); //save file
        }
    }

    //save info into xml
    function saveToXML(){
        $xmlFile = "../data/customer.xml";
        $xml = new DOMDocument("1.0","UTF-8");
        $xml->formatOutput=true;
        $xml->load($xmlFile);

        //id record here
        $listOfCus = $xml->getElementsByTagName("customer");
        $cusSize = $listOfCus->length; //get size of child in root

        //take last child and plus 1 for id
        $lastChildNodes = $listOfCus[$cusSize -1];
        $customerID = $lastChildNodes->getElementsByTagName("customer_id")->item(0)->nodeValue + 1;

        $infoTag = $xml->getElementsByTagName("informations")->item(0);
        $customerTag = $xml->createElement("customer");
        $idTag = $xml->createElement("customer_id", $customerID);
        $fNameTag = $xml->createElement("first_name",$_POST['first_name']);
        $surnameTag = $xml->createElement("surname",$_POST['last_name']);
        $emailTag = $xml->createElement("email",$_POST['email']);
        $passwordTag = $xml->createElement("password",$_POST['password']);
        $contactTag = $xml->createElement("contact",$_POST['phone']);

        $customerTag->appendChild($idTag);
        $customerTag->appendChild($fNameTag);
        $customerTag->appendChild($surnameTag);
        $customerTag->appendChild($emailTag);
        $customerTag->appendChild($passwordTag);
        $customerTag->appendChild($contactTag);

        $infoTag->appendChild($customerTag);
        $xml->save($xmlFile);
    }

    function createXML(){
        $xmlFile = "../data/customer.xml";
        $customerID = 0;
        $xml = new DOMDocument("1.0","UTF-8");
        $xml->formatOutput=true;

        $infoTag = $xml->createElement("informations");
        $customerTag = $xml->createElement("customer");
        $idTag = $xml->createElement("customer_id", $customerID);
        $fNameTag = $xml->createElement("first_name",$_POST['first_name']);
        $surnameTag = $xml->createElement("surname",$_POST['last_name']);
        $emailTag = $xml->createElement("email",$_POST['email']);
        $passwordTag = $xml->createElement("password",$_POST['password']);
        $contactTag = $xml->createElement("contact",$_POST['phone']);

        $customerTag->appendChild($idTag);
        $customerTag->appendChild($fNameTag);
        $customerTag->appendChild($surnameTag);
        $customerTag->appendChild($emailTag);
        $customerTag->appendChild($passwordTag);
        $customerTag->appendChild($contactTag);

        $infoTag->appendChild($customerTag);
        $xml->appendChild($infoTag);
        $xml->save($xmlFile);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Registration</title>
    </head>
    <body>
        <button type="button" name="button" onclick="back()">Back</button>
    </body>

    <script type="text/javascript">
        function back(){
            location.href = "../htm/buyonline.htm";
        }
    </script>
</html>
