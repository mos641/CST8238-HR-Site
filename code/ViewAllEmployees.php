<?php

session_start();

if(isset($_SESSION["adcode"]))
{
    if ($_SESSION["adcode"] == 111 || $_SESSION["adcode"] == 999){
        
        require "MySQLConnectionInfo.php";
        
    } else {
        header("Location: Login.php");
        exit;
    }
} else {
    header("Location: Login.php");
    exit;
}
?>

<html>
    <head>
    	<title>View Employees</title>
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
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
            // set the PDO error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "<h2>Database Data </h2>";
            
            $sqlQuery = "SELECT * FROM Employee";
            
            $result = $pdo->query( $sqlQuery );
            
            $rowCount = $result->rowCount();
            
            if($rowCount == 0)
                echo "There are no Employees.";
                else
                {
                    echo "<table CELLSPACING=0 style=\"width: 100%;\">";
                    echo "<tr>";
                    echo "<td><b>First Name</b></td>";
                    echo "<td><b>Last Name</b></td>";
                    echo "<td><b>Email Address</b></td>";
                    echo "<td><b>Phone Number</b></td>";
                    echo "<td><b>SIN</b></td>";
                    echo "<td><b>Designation</b></td>";
                    echo "</tr>";
                    for($i=0; $i<$rowCount; ++$i)
                    {
                        $row = $result->fetch();
                        
                        echo "<tr>";
                        echo "<td>$row[1]</td>";
                        echo "<td>$row[2]</td>";
                        echo "<td>$row[3]</td>";
                        echo "<td>$row[4]</td>";
                        echo "<td>$row[5]</td>";
                        echo "<td>$row[7]</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                
                $pdo = null;
                
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        ?>
    	
    	</div>
    	</div>
    	
    	<div id="footer">
    		<?php include_once 'Footer.php';?>
    	</div>
    </body>
</html>