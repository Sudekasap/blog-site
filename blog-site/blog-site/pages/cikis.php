<?php
// Çıkış (logout) sayfası

// Oturum zaten index.php'de başlatılmış olabilir, yine de kontrol edelim
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Tüm oturum değişkenlerini temizle
$_SESSION = [];

// Eski projedeki ana anahtarlar da dahil (güvenli tarafta kalmak için)
if (isset($_SESSION['giris_var'])) {
    unset($_SESSION['giris_var']);
}
if (isset($_SESSION['yetki'])) {
    unset($_SESSION['yetki']);
}
if (isset($_SESSION['loggedin'])) {
    unset($_SESSION['loggedin']);
}
if (isset($_SESSION['user_id'])) {
    unset($_SESSION['user_id']);
}
if (isset($_SESSION['user_role'])) {
    unset($_SESSION['user_role']);
}
if (isset($_SESSION['username'])) {
    unset($_SESSION['username']);
}

// Session cookie'sini de sil (varsa)
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
}

// Oturumu tamamen sonlandır
session_destroy();

// Kullanıcıyı giriş sayfasına yönlendir
// Projenin klasör yolu: /blog-site/
// Tarayıcıda adres: http://localhost/blog-site/index.php?sayfa=giris
header('Location: /blog-site/index.php?sayfa=giris');
exit;


