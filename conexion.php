<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
    	$conn = new PDO("mysql:host=$servername;dbname=dictionary", $username, $password);
    // set the PDO error mode to exception
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	//echo "Conexión exitosa";
    }
catch(PDOException $e)
    {
    	//echo "Conexión fallida: " . $e->getMessage();
    }
?>