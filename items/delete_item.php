<?php
session_start();
include_once "../db/db_connect.php";
header('Content-Type: application/json');

if (isset($_POST["itemId"])) {
    $item_id = $_POST["itemId"];

    $sql_delete = "DELETE FROM items WHERE id = '$item_id'";
    $result_delete = $conn->query($sql_delete);
    if ($result_delete) {
        echo json_encode(['success' => true]);
        exit;
    } else {
        echo json_encode(['success' => false, 'error' => 'SQL Error.']);
        exit;
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Error with ajax.']);
    exit;
}
