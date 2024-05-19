<?php
session_start();
include_once "../db/db_connect.php";
header('Content-Type: application/json');

if (isset($_POST["itemName"])) {
    $item_name = $_POST["itemName"];
    // $is_checked = 0;

    $sql = "INSERT INTO items (value) VALUES ('$item_name')";
    $result = $conn->query($sql);
    if ($result) {
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
