<?php
    session_start();

    //get email and password
    $customer_email = $_GET['customer_email'];
    $password = $_GET['password'];

    // confirm user email and password
    if(accountCheck($customer_email,$password) == false){
        echo "failed";
    }else{
        // save session
        $_SESSION['customer']= accountCheck($customer_email,$password);
        echo "success";
    }

    // check customer account, validate email and password
    function accountCheck($customer_email, $password){
        $filename = "../data/customer.xml";

        $xml = new DOMDocument();
    	$xml->load($filename);
    	$customer = $xml->getElementsByTagName("customer");

    	if (sizeof($customer) == 0) {
            echo "Nothing found.";
    		return false;
    	} else{
    		foreach ($customer as $cus) {
    			$email = $cus->getElementsByTagName("email")->item(0)->nodeValue;
    			$pass = $cus->getElementsByTagName("password")->item(0)->nodeValue;

    			if ($email==$customer_email && $pass==$password) {
    				$customer_id = $cus->getElementsByTagName("customer_id")->item(0)->nodeValue;
                    return $customer_id;
    			}
    		}
            return false;
    	}
    }
?>
