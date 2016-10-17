<?php
    echo "Registration success! Please click back to continue~ Have a nice day.</br>";

    if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['email']) || isset($_POST['phone']) ){
        $fileName = "../data/customer.xml";
        if(!file_exists($fileName)){
            createXML();
        }else{
            saveToXML();
        }
    }


    function saveToXML(){
        $xmlFile = "../data/customer.xml";
        $xml = new DOMDocument("1.0","UTF-8");
        $xml->formatOutput=true;
        $xml->load($xmlFile);

        //id record here
        $root = $xml->documentElement;
        $customerID = $root->childNodes->length;

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
        $fileName = "../data/customer.xml";
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

        $xml->save($fileName);
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
            location.href = "../htm/register.htm";
        }
    </script>
</html>
