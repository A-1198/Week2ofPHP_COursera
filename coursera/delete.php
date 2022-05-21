<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        Id : <input type="number" name="id">;
        <input type="submit" name="Delete">;
    </form>
</body>
</html>
        <?php
require_once "pdo.php";
if(isset($_POST['id'])){
    $sql = "Delete from user where user_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(Array(
        ':id' => $_POST['id']
    )
    );
}
?>