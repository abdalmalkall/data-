<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $targetDir = "uploads/";
    $fileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . time() . "_" . $fileName;
    
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
        $stmt = $conn->prepare("INSERT INTO images (image_path) VALUES (?)");
        $stmt->bind_param("s", $targetFilePath);
        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "image" => $targetFilePath]);
        } else {
            echo json_encode(["status" => "error", "message" => "خطأ في إدخال البيانات"]);
        }
        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "فشل رفع الصورة"]);
    }
}
?>
