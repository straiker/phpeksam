<?php

require_once("config.php");
include("menu.html");
$id = $_GET['id'];

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
$stmt = $mysqli->prepare("DELETE FROM goods WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

?>


