<?php
$conn = new mysqli("localhost", "root", "1234", "student_setiac");

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => $conn->connect_error]);
    exit();
}


$sql = "SELECT category, COUNT(*) as total FROM reports GROUP BY category";
$result = $conn->query($sql);

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);
?>
