<?php
$servername = "localhost";
$username = "root";  // par défaut sur XAMPP
$password = "";  // vide par défaut sur XAMPP
$dbname = "gestion_bibliotheque";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
