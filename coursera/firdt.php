<?php
require_once "pdo.php";
$stmt = $pdo->query("Select * from user");
while($row = $stmt->fetch(PDO :: FETCH_ASSOC))
{
    print_r($row);
}
echo"</pre>\n";
$sql = "insert into user(name,email,password) values (:name,:email,:password)";
if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])){
    $stmt = $pdo->prepare($sql);
    try
    {$stmt->execute(Array(
        ':name' => $_POST["name"],
        ':emal' => $_POST["email"],
        ':password' => $_POST["password"]
    ));
}
catch(Exception $ex)
{
   // echo ("Exception message". $ex->getMessage());
   echo ("Error");
   error_log("error4.php SQL error = ".$ex->getMessage());
    return;
}
$row = $stmt->fetch(PDO :: FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        Name : <input type="text" name="name">
        Email : <input type="email" name="email">
        Password : <input type="password" name="password">
        <input type="submit" value="Add New">
    </form>
</body>
</html>