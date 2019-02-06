<html>
<head>
<title>Registration</title>
<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
<?php

// Set the variables for the person we want to add to the database
$user = $_POST["Username"];
$pass = $_POST["Password"];
$name = $_POST["Name"];
$dob = $_POST["Dayofbirth"];
$mob = $_POST["Monthofbirth"];
$yob = $_POST["Yearofbirth"];

$d = getdate();
$y = $d["year"];

$servername = "localhost";
$username = "ephp043";
$password = "ohquioce";
$dbname = "ephp043";
$sql = "mysql:host=$servername;dbname=$dbname;";



if ($y - $yob <= 18) // calculate current year and users date of birth to see if its less or equal than 18.
{
		echo "<p>" . "You have to be 18 or over to proceed!" . "</p>";
}

elseif ($user == "" || $pass == "" || $name == "" || $dob == "" || $mob == "" || $yob == "") //checks if there is missing inputs.
{
		echo "<p>" . "The form is missing something!" . "<br />Try again." . "</p>";
}	

else
{		//// Create a new connection to the MySQL database using PDO, $conn is an object
		try {
			$conn = new PDO($sql, $username , $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			echo "Connected successfully";
		} catch (PDOException $error) {
			echo 'Connection error: ' . $error->getMessage();
		}
		
		// Here we create a variable that calls the prepare() method of the database object
		// The SQL query you want to run is entered as the parameter, and placeholders are written like this :placeholder_name
		$insert_statement = $conn->prepare("INSERT INTO ht_users2 ('username','password','name','dayofbirth','monthofbirth','yearofbirth') VALUES (:username, :password, :name, :dob, :mob, :yob)");
		
		// Now we tell the script which variable each placeholder actually refers to using the bindParam() method
		// First parameter is the placeholder in the statement above - the second parameter is a variable that it should refer to	
		$insert_statement->bindParam(':username', $user);
		$insert_statement->bindParam(':password', $pass);
		$insert_statement->bindParam(':name', $name);
		$insert_statement->bindParam(':dob', $dob);
		$insert_statement->bindParam(':mob', $mob);
		$insert_statement->bindParam(':yob', $yob);
		
		// Execute the query using the data we just defined
		// The execute() method returns TRUE if it is successful and FALSE if it is not, allowing you to write your own messages here
		if ($insert_statement->execute()) {
			echo "<p>" ."New record created successfully" . "</p>";
			echo "<p>" . "You have signed up with <br />" . 
			"Name: " . $name . "<br />" .
			"Username: " . $user . "<br />" .
			"Date of Birth: " . $dob . " " . $mob . " " . $yob . "<br />" . "</p>";
		} else {
			echo "Unable to create record";
		}
		$conn->close();
}
?>
</body>
</html>
