<?php
require_once 'connect.php';
header("Content-Type: application/json");

// รับค่า JSON จาก Client
$input = file_get_contents("php://input");
$data = json_decode($input, true);

if (!$data || !isset($data['name']) || !isset($data['levels'])) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Invalid data"]);
    exit();
}

// สร้าง ID สุ่มแบบง่ายๆ
$project_id = uniqid() . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 5);
$name = $conn_hos->real_escape_string($data['name']);

// บันทึก JSON ก้อนนี้ลงตาราง
$json_data = $conn_hos->real_escape_string(json_encode($data, JSON_UNESCAPED_UNICODE));

$sql = "INSERT INTO baby_projects (project_id, name, data) VALUES ('$project_id', '$name', '$json_data')";

if ($conn_hos->query($sql) === TRUE) {
    echo json_encode([
        "status" => "success",
        "project_id" => $project_id
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        "status" => "error", 
        "message" => "Error saving data: " . $conn_hos->error
    ]);
}

$conn_hos->close();
?>
