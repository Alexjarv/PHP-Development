<html>
<head>
<title>Results</title>
<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
<?php
$a = $_GET["artist"];
$conn = new PDO("mysql:host=localhost;dbname=ephp043;" , "ephp043" , "ohquioce");

$results = $conn->query("select * from wadsongs where artist = '$a'");

while($row=$results->fetch())
{
    echo "<p>";
    echo " Song Title: ". $row["title"] ."<br/> ";
    echo " Artist " . $row["artist"] . "<br/> "; 
    echo " Year " .$row["year"]. "<br/>";
	echo " Genre " .$row["genre"]. "<br/>"; 
    echo "</p>";
}
?>
</body>
</html>
