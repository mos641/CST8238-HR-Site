<?php

require "MySQLConnectionInfo.php";

?>

<html>
    <head>
    	<title>Update Account</title>
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
    	
        <form action="UpdateComplete.php" method="post">
			<input type="hidden" name="updateEmployeeId" value="<?php echo  $_POST['EmployeeId']; ?>" />
			First Name: <input type="text" name="updateFirstName" value="<?php echo  $_POST['FirstName']; ?>" />
			<br />
			Last Name: <input type="text" name="updateLastName" value="<?php echo  $_POST['LastName']; ?>" />
			<br />
			Email Address: <input type="text" name="updateEmail" value="<?php echo  $_POST['EmailAddress']; ?>" />
			<br />
			Phone Number: <input type="text" name="updatePhone" value="<?php echo  $_POST['TelephoneNumber']; ?>" />
			<br />
			Designation: <input type="text" name="updateDes" value="<?php echo  $_POST['Designation']; ?>" />
			<br />
			Admin Code: <input type="text" name="updateAdcode" value="<?php echo  $_POST['AdminCode']; ?>" />
			<br />
			<input type="submit" value="Update Record" />
		</form>
    	</div>
    	</div>
    	
    	<div id="footer">
    		<?php include_once 'Footer.php';?>
    	</div>
    </body>
</html>