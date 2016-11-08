<?php
    session_start();

    $manager_id = $_GET['manager_id'];
    $password = $_GET['password'];
    if(accountCheck($manager_id,$password) == true){
        $_SESSION['manager']=$manager_id;
        echo "success";
    }else{
        echo "failed";
    }

    // check manager account
    function accountCheck($manager_id, $password){
        $filename = "../data/manager.txt";
        $file = "";

        if(!file_exists($filename)){
            $file = fopen($filename, "w+") or die("Unable to open file.");
            fclose($file);
        }else{
            $lines = file($filename);

            foreach ($lines as $line){
                $arrayOfLines = explode(",",$line);

                if(trim($arrayOfLines[0]) == trim($manager_id) && trim($arrayOfLines[1]) == trim($password)){
                    return true;
                    break;
                }
            }
            return false;
        }
    }

?>
