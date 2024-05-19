<?php
session_start();
include_once "../db/db_connect.php";
header('Content-Type: application/json');

if (isset($_POST["itemId"]) && isset($_POST["isActive"])) {
    $item_id = $_POST["itemId"];
    $new_status = $_POST["isActive"];

    $sql_check = "SELECT * FROM purchases WHERE id = '$item_id' AND user_id = " . $_SESSION['user_id'];
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        $sql_update = "UPDATE purchases SET is_checked = '$new_status' WHERE id = '$item_id'";
        $result_update = $conn->query($sql_update);

        if ($result_update) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Update failed.']);
            exit;
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Item not found or not owned by user.']);
        exit;
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Error with ajax.']);
    exit;
}
