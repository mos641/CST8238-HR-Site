<?php
session_start();

$_SESSION["adcode"] = "";

require "MySQLConnectionInfo.php";

$error = "";

if (! isset($_POST["firstName"]) || ! isset($_POST["lastName"]) || ! isset($_POST["email"]) || ! isset($_POST["phone"]) || ! isset($_POST["sin"]) || ! isset($_POST["pass"]) || ! isset($_POST["des"]) || ! isset($_POST["adcode"])) {
    $error = "Please fill out the entire form.";
} else {
    if ($_POST["firstName"] != "" && $_POST["lastName"] != "" && $_POST["email"] != "" && $_POST["phone"] != "" && $_POST["sin"] != "" && $_POST["pass"] != "" && $_POST["des"] != "" && $_POST["adcode"] != "") {
        if ($_POST["des"] != "Manager" && $_POST["des"] != "ITDeveloper") {
            $error = "Invalid Designation.";
        } else if (($_POST["des"] == "Manager" && $_POST["adcode"] != 999) || ($_POST["des"] == "ITDeveloper" && $_POST["adcode"] != 111)) {
            $error = "Invalid admin code.";
        } else {
            try {
                $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
                // set the PDO error mode to exception
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $error = "Connected successfully";

                $sqlQuery = "INSERT INTO Employee (FirstName, LastName, EmailAddress, TelephoneNumber, SocialInsuranceNumber, Password, Designation, AdminCode) VALUES('" . $_POST["firstName"] . "', '" . $_POST["lastName"] . "', '" . $_POST["email"] . "', '" . $_POST["phone"] . "', '" . $_POST["sin"] . "', '" . $_POST["pass"] . "', '" . $_POST["des"] . "', '" . $_POST["adcode"] . "')";

                try {
                    $result = $pdo->query($sqlQuery);

                    $_SESSION["adcode"] = $_POST["adcode"];

                    header("Location: ViewAllEmployees.php");
                    exit();
                } catch (PDOException $e) {
                    echo "Employee Could not be added:  " . $e->getMessage();
                }

                $pdo = null;
            } 
            catch (PDOException $e) {
                echo "Connection failed:  " . $e->getMessage();
            }
        }
    } else {
        $error = "Please fill out the entire form.";
    }
}

?>
<html>
<head>
<title>Create an Account</title>
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
			<b>Create your new account</b> <br /> <br /> Please fill in all
			information.

			<form action="CreateAccount.php" method="post">
				First Name <input type="text" name="firstName" /> <br /> Last Name <input
					type="text" name="lastName" /> <br /> Email Address <input
					type="text" name="email" /> <br /> Phone Number <input
					type="number" name="phone" min="1000000000" max="9999999999" /> <br />
				SIN <input type="number" name="sin" min="10000000000"
					max="99999999999" /> <br /> Password <input type="text" name="pass" />
				<br /> Designation <input type="text" name="des" /> <br /> Admin
				Code <input type="text" name="adcode" /> <br /> <input type="submit"
					value="Submit Information" /> <br /> <br />
			</form>
		<?php
echo $error;
?>		
    	
    	</div>
	</div>

	<div id="footer">
    		<?php include_once 'Footer.php';?>
    	</div>
</body>
</html>