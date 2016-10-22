<?php
    session_start();
?>

<?php
    $manager_id = $_GET['manager_id'];
    $password = $_GET['password'];
    $filename = "../data/manager.txt";
    $file = "";

    if(!file_exists($filename)){
        $file = fopen($filename, "w+") or die("Unable to open file.");
        fclose($file);
    }else{
        $line = file($filename);
        foreach ($line as $line_num => $line){
            $arrayOfLines = explode(",",$line);

            if(trim($arrayOfLines[0]) == trim($manager_id) && trim($arrayOfLines[1]) == trim($password)){
                $_SESSION['manager_id'] = $manager_id;
                echo "success";
            }else{
                echo "failed";
            }
        }
    }

?>
