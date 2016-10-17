<?php
    echo $_POST['first_name'];
    // $fname = $_POST['first_name'];
    // $xml = new DOMDocument('1.0', 'utf-8');
    // $xml->formatOutput = true;
    // $xml->preserveWhiteSpace = false;
    // $xml->load('customer.xml');
    //
    // $element = $xml->getElementsByTagName('customer_information')->item(0);
    // $fname = $element->getElementsByTagName('first_name')->item(0);
    //
    // $newItem = $xml->createElement('customer_information');
    //
    // $newItem->appendChild($xml->createElement('first_name', $_POST['first_name']));
    // $xml->appendChild($newItem);
    //
    // $xml->save('customer.xml')


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
