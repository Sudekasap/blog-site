<?php
//  Oturumu (Session) başlat
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//  Veritabanı bağlantısını 
// Bu dosya ($db bağlantısı) tüm sayfalarda (login.php, register.php) kullanılacaktır.
require_once 'baglanti.php'; 

// 3. Yönlendirme Mantığı
// URL'deki 'sayfa' parametresini kontrol ediyoruz
$sayfa = isset($_GET['sayfa']) ? $_GET['sayfa'] : 'home';
 
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Sitem </title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>

    <?php 
        // includes/navbar.php dosyasını buraya dahil ediyoruz (Header/Menü)
        include 'includes/navbar.php'; 
    ?>

    <main class="container mt-5">
        
        <?php
            // URL'deki 'sayfa' parametresini kontrol ediyoruz (Yönlendirme Mantığı)
            // Örnek: index.php?sayfa=giris
            $sayfa = isset($_GET['sayfa']) ? $_GET['sayfa'] : 'home';

            // İstenen sayfaya göre ilgili dosyayı yüklüyoruz
            if ($sayfa == 'home') {
                include 'pages/home.php'; 
            } elseif ($sayfa == 'giris') {
                include 'login.php'; 
            } elseif ($sayfa == 'kayit') {
                include 'register.php'; 
            } else {
                // Sayfa bulunamazsa 404 göster
                echo "<div class='alert alert-danger'>404 Hata: Sayfa Bulunamadı.</div>";
            }
        ?>

    </main>
    <?php 
        // includes/footer.php dosyasını buraya dahil ediyoruz (Alt Bilgi)
        include 'includes/footer.php'; 
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>