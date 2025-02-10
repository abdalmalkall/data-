<?php
$servername = "localhost";
$username = "username"; // استبدل باسم المستخدم الخاص بك
$password = "password"; // استبدل بكلمة المرور الخاصة بك
$dbname = "social_network";

// إنشاء اتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST['user_id']; // يجب أن يكون لديك نظام تسجيل دخول لتحديد المستخدم
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    
    // رفع الصورة
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        $sql = "INSERT INTO images (user_id, image_path, created_at) VALUES ('$userId', '$targetFile', NOW())";
        if ($conn->query($sql) === TRUE) {
            echo "تم رفع الصورة بنجاح.";
        } else {
            echo "خطأ: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "عذرًا، حدث خطأ أثناء رفع الصورة.";
    }
}

$conn->close();
?>