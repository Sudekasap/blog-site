<?php
// ======================================================
// 1. OTURUM YÖNETİMİ (Session)
// ======================================================
// Kullanıcının giriş yapıp yapmadığını takip etmek için oturumu başlatıyoruz.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// ======================================================
// 2. VERİTABANI BAĞLANTISI
// ======================================================
// baglanti.php dosyasını dahil et. Bu dosya veritabanına erişim sağlar.
// $baglanti nesnesinin bu dosya içinde PDO olarak tanımlanması beklenir.
if (file_exists('baglanti.php')) {
    require_once 'baglanti.php';
} else {
    // Bağlantı dosyası yoksa çalışmayı durdur ve hata ver.
    die("<div style='color:red; text-align:center; margin-top:50px;'>HATA: <b>baglanti.php</b> dosyası bulunamadı!</div>");
}

// ======================================================
// 3. SAYFA YÖNLENDİRME (Routing)
// ======================================================
// URL'den 'sayfa' parametresini alıyoruz (örn: index.php?sayfa=giris)
// Eğer parametre yoksa, varsayılan olarak 'home' (Anasayfa) açılır.
$sayfa = isset($_GET['sayfa']) ? $_GET['sayfa'] : 'home';

// İstenen sayfanın gerçek dosya yolunu belirliyoruz.
// Sayfalar pages/ klasörü içinde olmalıdır.
$dosya_yolu = 'pages/' . $sayfa . '.php'; 
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Projesi | <?php echo ucfirst($sayfa); ?> </title>
    
    <!-- Bootstrap 5 CSS (Tasarım için gerekli) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Sizin Özel CSS Dosyanız -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="d-flex flex-column min-vh-100">

    <?php 
        // 4. NAVBAR (ÜST MENÜ)
        if (file_exists('includes/navbar.php')) {
            include 'includes/navbar.php'; 
        } else {
            echo "<nav class='navbar navbar-dark bg-danger mb-4'><div class='container'><span class='navbar-brand'>Uyarı: includes/navbar.php bulunamadı!</span></div></nav>";
        }
    ?>

    <main class="container mt-4 mb-5">
        
        <?php
            // ======================================================
            // 5. İÇERİK YÜKLEME VE GÜVENLİK KONTROLÜ
            // ======================================================
            
            // ÖZEL DURUM: Admin Paneli Güvenliği
            if ($sayfa == 'admin') {
                // Eğer kullanıcı giriş yapmamışsa VEYA yetkisi 'Admin' değilse engelle.
                // Not: Rol adının "Admin" (büyük A) olduğundan emin olun.
                if (!isset($_SESSION['giris_var']) || $_SESSION['yetki'] !== 'Admin') { 
                     echo "<script>
                        alert('Bu sayfaya erişim yetkiniz yok! Lütfen Admin olarak giriş yapın.'); 
                        window.location.href='index.php?sayfa=giris';
                     </script>";
                     exit;
                }
            }
            
            // SAYFAYI ÇAĞIRMA
            if (file_exists($dosya_yolu)) {
                // Dosya varsa içeriği buraya yükle
                include $dosya_yolu;
            } else {
                // Dosya yoksa 404 Hata mesajı göster
                echo "<div class='alert alert-warning text-center p-5'>";
                echo "<h1 class='display-4'>404</h1>";
                echo "<p>Aradığınız sayfa sistemde bulunamadı: <br><strong>$dosya_yolu</strong></p>";
                echo "<a href='index.php' class='btn btn-primary mt-3'>Anasayfaya Dön</a>";
                echo "</div>";
            }
        ?>

    </main>
    
    <?php 
        // 6. FOOTER (ALT BİLGİ)
        if (file_exists('includes/footer.php')) {
            include 'includes/footer.php'; 
        } else {
            echo "<footer class='bg-light text-center py-3 mt-auto border-top'>Blog Projesi &copy; 2025</footer>";
        }
    ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>