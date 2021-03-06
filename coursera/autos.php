<?php
require_once "pdo.php";

// Demand a GET parameter
if ( ! isset($_GET['name']) || strlen($_GET['name']) < 1  ) {
    die('Name parameter missing');
}

// If the user requested logout go back to index.php
if ( isset($_POST['logout']) ) {
    header('Location: index.php');
    return;
}

$failure = false;
$failure2 = false;

if ( isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage'])) {
    if(strlen($_POST['make']) > 1 ){
    if(is_numeric($_POST['year']) && is_numeric($_POST['mileage'])){
    $sql = "INSERT INTO autos (make, year, mileage) VALUES (:make, :year, :mileage)";
    //echo("<pre>\n".$sql."\n</pre>\n");
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':make' => htmlentities($_POST['make']),
        ':year' => htmlentities($_POST['year']),
        ':mileage' => htmlentities($_POST['mileage'])));

        $failure2 = true;
    }else{
        $failure= "Mileage and year must be numeric";
    }
    }else{
        $failure= "Make is required";
    }
}




$stmt = $pdo->query("SELECT * FROM autos");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>
<!DOCTYPE html>
<html>
<head>
<title>DIEGO ANTONIO ROMERO PALACIOS b1bc86bf</title>

</head>
<body>
<div class="container">
<h1>Tracking Autos for <?php echo($_GET['name'])?></h1>
<?php 
if ( $failure !== false ) {
    // Look closely at the use of single and double quotes
    echo('<p style="color: red;">'.htmlentities($failure)."</p>\n");
    
}
if($failure2 === true){
    echo('<p style="color: green;">'."Record inserted"."</p>\n");
}

?>
<form method="post">
<p>Make:
<input type="text" name="make" size="40"></p>
<p>Year:
<input type="text" name="year"></p>
<p>Mileage:
<input type="text" name="mileage"></p>
<p>
<input type="submit" value="Add">
<input type="submit" name="logout" value="Logout">
</p>
</form>
<?php
echo "<h2>Automobiles</h2>";
foreach ( $rows as $row ) {
    echo "<ul><p>";
    echo "<li>";
    echo($row['year']);
    echo(" ");
    echo($row['make']);
    echo(" / ");
    echo($row['mileage']);
    echo ("</li>");
    echo "</ul></p>";
}
?>
</div>
</body>
</html>

