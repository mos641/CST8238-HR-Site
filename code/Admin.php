<?php
session_start();

$_SESSION["adcode"] = "";

require "MySQLConnectionInfo.php";

$message = "";

if (! isset($_POST["email"]) || ! isset($_POST["pass"]) || ! isset($_POST["adcode"])) {
    $message = "Please fill entire form.";
} else {
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $adcode = $_POST["adcode"];

    if ($adcode != 999) {
        $message = "Invalid Login.";
    } else {

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
            // set the PDO error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sqlQuery = "SELECT * FROM Employee";

            $result = $pdo->query($sqlQuery);

            $rowCount = $result->rowCount();

            if ($rowCount == 0)
                $message = "Invalid Login.";
            else {

                for ($i = 0; $i < $rowCount; ++ $i) {
                    $row = $result->fetch();

                    if ($row[3] == $email && $row[6] == $pass && $row[8] == $adcode) {
                        $_SESSION["adcode"] = $row[8];

                        header("Location: SelectAccount.php");
                        exit();
                    }
                }
                $message = "Invalid Login.";
            }

            $pdo = null;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}

?>
<html>
<head>
<title>Admin Log In</title>
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

			<b>Admin Panel</b> <br /> <br />

			<form action="Admin.php" method="post">
				Email Address <input type="text" name="email" /> <br /> Password <input
					type="text" name="pass" /> <br /> Admin Code <input type="number"
					name="adcode" /> <br /> <input type="submit" value="Login" /> <br />
				<br />
			</form>
    	
        <?php
        echo $message;
        ?>
    	
    	</div>
	</div>

	<div id="footer">
    		<?php include_once 'Footer.php';?>
    	</div>
</body>
</html>