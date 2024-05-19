<?php
session_start();
include_once "db/db_connect.php";
header('Content-Type: application/json');


$sql = "SELECT * FROM items";
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'id' => $row["id"],
            'value' => $row["value"],
        ];
    }
}

echo json_encode(['success' => true, 'data' => $data]);
