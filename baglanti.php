<?php
// Hata raporlama
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Veritabanı Ayarları
$host     = 'localhost';
$dbname   = 'blog_sitesi'; // MySQL Workbench'te oluşturduğunuz veritabanı adı
$user     = 'root';            // MySQL kullanıcı adı (XAMPP'te varsayılan)
$password = '12345678';                // MySQL şifre (XAMPP'te varsayılan olarak boş)

// PDO ile veritabanı bağlantısı
try {
    // MySQL ile bağlantıyı kurma
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);
    
    // Hata modunu Exception olarak ayarla (Daha iyi hata yönetimi için)
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Varsayılan veri çekme modunu ayarla (FETCH_ASSOC: Sütun isimleriyle dizi döner)
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    // Bağlantı başarılı ise, $db nesnesi artık tüm projede kullanılabilir.
    
} catch (PDOException $e) {
    // Bağlantı hatası durumunda işlemi durdur ve hatayı göster
    die("Veritabanı bağlantı hatası: " . $e->getMessage());
}
?>