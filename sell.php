<?php
require_once("config.php");

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['sell'])) {
        $stmt = $mysqli->prepare("UPDATE goods SET dateSold=NOW() WHERE id=?");
        $stmt->bind_param("i", $_POST['id']);
        $stmt->execute();
        $stmt->close();

        echo "Müüdud";
    }
}

?>

<html>
<head>
    <title>PHP eksam - Rait Avastu</title>
</head>
<body>
<div id="wrapper">
    <h1>Müük</h1>
    <?php include("menu.html"); ?>
    <form action="sell.php" method="post">
        <p>Kinnita toote müük
            <input type="submit" name="sell" value="Siin">
            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
        </p>
    </form>

</div>
</body>
</html>