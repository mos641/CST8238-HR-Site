<?php

require "MySQLConnectionInfo.php";

$error = "";

if(isset($_POST["updateEmployeeId"]))
{
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        // set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sqlQuery = "UPDATE Employee SET FirstName = '".$_POST["updateFirstName"]."', LastName = '".$_POST["updatelastName"]."', LastName = '".$_POST["updateEmail"]."', LastName = '".$_POST["updatePhone"]."', LastName = '".$_POST["updateDesignation"]."', LastName = '".$_POST["updateAdcode"]."' WHERE EmployeeId = '".$_POST['updateEmployeeId']."'";
        
        try {
            $result = $pdo->query( $sqlQuery );
            $error = "Employee Information is Successfully Updated". "<br>";
        }
        catch(PDOException $e) {
            $error = "Employee Could not be Updated:  " . $e->getMessage();
        }
        
        $pdo = null;
    }
    catch(PDOException $e) {
        echo "Connection failed:  " . $e->getMessage();
    }
    
}

?>
<html>
    <head>
    	<title>Update Complete</title>
    	<link href="styles-template.css" rel="stylesheet">
    </head>
    
    <body>
    	<div id="header">
    		<?php include_once 'Header.php';?>
    	</div>
    	
    	<div id="container">
    	<div id="menu">
    		<?php include_once 'Menu.php';?>
    	</div>
    	
    	<div id="content">
    	
       <?php 
			include "MySQLMenu.php";

			echo $error;
		?>
    	
    	</div>
    	</div>
    	
    	<div id="footer">
    		<?php include_once 'Footer.php';?>
    	</div>
    </body>
</html>