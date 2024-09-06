<?php
$servername = "localhost";
$username = "root";
$password = "dinamik123";
$database = "dinamiksite";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Veritabanına bağlanırken hata oluştu: " . $conn->connect_error);
}

if (isset($_FILES['photo']) && isset($_POST['title']) && isset($_POST['description'])) {
    $fileTmpName = $_FILES['photo']['tmp_name'];
    $fileName = basename($_FILES["photo"]["name"]);
    $targetDir = "img/";
    $targetFile = $targetDir . $fileName;
    
    if (move_uploaded_file($fileTmpName, $targetFile)) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $fileUrl = $targetFile;

        $stmt = $conn->prepare("INSERT INTO basarilarimiz (baslik, yazi, foto_url) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $description, $fileUrl);

        if ($stmt->execute()) {
            echo "Fotoğraf başarıyla yüklendi.";
        } else {
            echo "Fotoğraf yüklenirken bir hata oluştu: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Fotoğraf yüklenirken bir hata oluştu.";
    }
} else {
    echo "Gerekli veriler sağlanmadı.";
}

$conn->close();
?>
