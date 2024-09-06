<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "dinamik123";
$database = "dinamiksite";

// Veritabanı bağlantısını oluştur
$conn = new mysqli($servername, $username, $password, $database);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Veritabanına bağlanırken hata oluştu: " . $conn->connect_error);
}

// Fotoğraf ID'sini al
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fotoğraf verisini seç
$sql = "SELECT foto_url FROM basarilarimiz WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($foto_url);
$stmt->fetch();

// İçerik türünü belirt
header("Content-Type: image/png");

// Fotoğrafı çıktı olarak ver
echo $foto_url;

// Bağlantıyı kapat
$stmt->close();
$conn->close();
?>
