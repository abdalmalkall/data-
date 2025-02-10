<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>موقع تسجيل المستخدمين ومشاركة الصور</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>تسجيل المستخدمين</h1>
        <form id="userForm">
            <input type="text" id="name" placeholder="الاسم" required>
            <input type="email" id="email" placeholder="البريد الإلكتروني" required>
            <button type="submit">تسجيل</button>
        </form>
        <div id="message"></div>

        <h2>المستخدمون المسجلون</h2>
        <div id="userList"></div>
        
        <h2>مشاركة الصور</h2>
        <form id="uploadForm" enctype="multipart/form-data">
            <input type="file" id="image" name="image" accept="image/*" required>
            <button type="submit">رفع الصورة</button>
        </form>

        <h2>الصور المرفوعة</h2>
        <div id="imageList">
            <?php
            require 'db.php';

            try {
                $stmt = $conn->prepare("SELECT image_path FROM images ORDER BY created_at DESC");
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $imagePath = htmlspecialchars($row['image_path']);
                        if (!empty($imagePath)) {
                            echo "<div class='image-item'>";
                            echo "<img src='$imagePath' alt='صورة مرفوعة' class='uploaded-img'>";
                            echo "</div>";
                        }
                    }
                } else {
                    echo "<p>لا توجد صور مرفوعة.</p>";
                }
            } catch (Exception $e) {
                echo "<p>حدث خطأ أثناء جلب الصور.</p>";
            }
            ?>
        </div>

        <h2>مقالات</h2>
        <a href="article.html">محمد أكل خيار</a>
    </div>
    <script src="script.js"></script>
</body>
</html>
