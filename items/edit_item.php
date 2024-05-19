<?php
include "../db/db_connect.php";

if (isset($_GET["id"])) {
    $item_id = $_GET["id"];

    $sql_check = "SELECT value FROM items WHERE id = '$item_id'";
    $result_check = $conn->query($sql_check);


    $old_item_name = $result_check->fetch_assoc()["value"];

    if (isset($_POST["confirm_new_name"])) {
        $new_item_name = $_POST["new_item_name"];
        $sql_edit = "UPDATE items SET value='$new_item_name' WHERE id = '$item_id'";
        $result_edit = $conn->query($sql_edit);
        if ($result_edit) {
            header("Location: ../index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
} else {
    echo "<script> alert('The item ID is not provided.'); window.location.href = '../index.php'</script>";
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Изменить элемент</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
</head>

<body>
    <div class="container">
        <h2>Изменить элемент</h2>
        <form action=<?php echo "edit_item.php?id=$item_id" ?> method="post">
            <input type="text" name="new_item_name" placeholder=<?php echo $old_item_name ?> required>
            <br>
            <input type="submit" name="confirm_new_name" value="Введите новое значение">
        </form>
        <a href="../index.php">Вернуться к списку</a>
    </div>
</body>

</html>