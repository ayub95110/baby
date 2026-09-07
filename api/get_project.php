<?php
require_once 'connect.php';
header("Content-Type: application/json");

if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Missing project id"]);
    exit();
}

$project_id = $conn_hos->real_escape_string($_GET['id']);

$sql = "SELECT data FROM baby_projects WHERE project_id = '$project_id' LIMIT 1";
$result = $conn_hos->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // คืนค่า JSON data แบบดิบๆ เลย เพราะบันทึกเป็น JSON อยู่แล้ว
    echo $row['data'];
} else {
    http_response_code(404);
    echo json_encode(["status" => "error", "message" => "Project not found"]);
}

$conn_hos->close();
?>
