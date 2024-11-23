<?php

$servername = "mysql";
$username = "root";
$password = "root";
$dbname = "kart_race";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = getResultsQuery();

    $result = $conn->query($sql);
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
    exit;
}