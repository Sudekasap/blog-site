<?php
// Hata raporlama
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Veritabanı Ayarları
$host     = 'localhost';
$dbname   = 'blog_sitesi'; // MySQL Workbench'te oluşturduğunuz veritabanı adı
$user     = 'root';        // MySQL kullanıcı adı (XAMPP'te varsayılan)
$password = '12345678';    // MySQL şifre

// PDO ile veritabanı bağlantısını kur
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);

    // Hata modunu Exception olarak ayarla (daha iyi hata yönetimi için)
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Varsayılan veri çekme modunu ayarla
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Eski kodlarla uyumluluk için $baglanti isminde de değişken oluştur
    $baglanti = $db;

} catch (PDOException $e) {
    // Bağlantı hatası durumunda işlemi durdur ve hatayı göster
    die("Veritabanı bağlantı hatası: " . $e->getMessage());
}

?>
