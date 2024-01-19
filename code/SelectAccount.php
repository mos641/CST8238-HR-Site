<?php

session_start();

if(isset($_SESSION["adcode"]))
{
    if ($_SESSION["adcode"] == 999){
        
        require "MySQLConnectionInfo.php";
        
    } else {
        header("Location: Admin.php");
        exit;
    }
}else {
    header("Location: Admin.php");
    exit;
}
?>
<html>
    <head>
    	<title>Select an Account</title>
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
            
            $sqlQuery = "SELECT * FROM Employee";
            
            $result = $pdo->query( $sqlQuery );
            
            $rowCount = $result->rowCount();
            
            if($rowCount == 0)
                echo "There are no Employees.";
                else
                {
					echo "<table CELLSPACING=0>";
                    for($i=0; $i<$rowCount; $i++)
                    {
                        $row = $result->fetch();
                        
                        echo "<tr><td style=\"width:20%; padding-bottom:30px;\">";
                        
                        echo "<form action=\"UpdateAccount.php\" method=\"post\">";
                        echo "<input type=\"hidden\" name=\"EmployeeId\" value=\"".$row[0]."\" />";
                        echo "<input type=\"hidden\" name=\"FirstName\" value=\"".$row[1]."\" />";
                        echo "<input type=\"hidden\" name=\"LastName\" value=\"".$row[2]."\" />";
                        echo "<input type=\"hidden\" name=\"EmailAddress\" value=\"".$row[3]."\" />";
                        echo "<input type=\"hidden\" name=\"TelephoneNumber\" value=\"".$row[4]."\" />";
                        echo "<input type=\"hidden\" name=\"Designation\" value=\"".$row[7]."\" />";
                        echo "<input type=\"hidden\" name=\"AdminCode\" value=\"".$row[8]."\" />";
                        echo "<input type=\"submit\" name=\"editButton\" value=\"Edit Employee\" />";
                        echo "</form>";
                        echo "</td>";
                        
                        echo "<td style=\"width:60%; padding-bottom:30px;\">";
                        echo "First Name: ".$row[1]."<br />";
                        echo "Last Name: ".$row[2]."<br />";
                        echo "</td></tr>";
                        
                        echo "<br />";
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