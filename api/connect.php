<?php
// ตั้งค่า CORS (เพื่อให้รับ Request จาก Netlify หรือโดเมนอื่นได้)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// ถ้าเป็นการเรียกแบบ Preflight (OPTIONS) จากเบราว์เซอร์ ให้ตอบกลับและจบการทำงาน
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$conn_hos = new mysqli("14.207.178.163", "bnh", ".Bnh123456", "btc_dca");

if ($conn_hos->connect_error) {
    die(json_encode([
        "status" => "error",
        "message" => "Connection failed: " . $conn_hos->connect_error
    ]));
}

$conn_hos->set_charset("utf8mb4");
?>
