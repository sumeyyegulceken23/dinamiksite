<?php
// contact_process.php

// Form verilerini almak
$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';

// Veritabanına bağlanma
$servername = "localhost";
$username = "root";
$password = "dinamik123";
$dbname = "dinamiksite";

// Bağlantıyı oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// $conn değişkeni ile veritabanı bağlantısı kurulduğunu varsayıyoruz
$stmt = $conn->prepare("INSERT INTO mesajlar (ad, eposta, mesaj) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $message);

// İfadeyi çalıştırın
if ($stmt->execute()) {
    echo "Mesaj başarıyla gönderildi!";
} else {
    echo "Hata: " . $stmt->error;
}

$stmt->close();
