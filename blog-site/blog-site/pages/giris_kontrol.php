<?php
// Giriş kontrolü
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Eğer index.php üzerinden gelmediyse veritabanı bağlantısını garanti altına al
if (!isset($db) && file_exists(__DIR__ . '/../baglanti.php')) {
    require_once __DIR__ . '/../baglanti.php';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identity = trim($_POST['login_identity'] ?? '');
    $password = $_POST['login_password'] ?? '';

    if ($identity === '' || $password === '') {
        $_SESSION['login_hata'] = 'Lütfen kullanıcı adı/e-posta ve şifre alanlarını doldurun.';
        header('Location: ../index.php?sayfa=giris');
        exit;
    }

    try {
        // Kullanıcı adı veya e-posta ile arama
        $sql = "SELECT id, username, email, password, rol 
                FROM kullanicilar 
                WHERE username = :identity OR email = :identity 
                LIMIT 1";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':identity', $identity);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Başarılı giriş
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['username']  = $user['username'];
            $_SESSION['user_role'] = $user['rol'];
            $_SESSION['loggedin']  = true; // navbar için kullanılan flag

            // Eski kodlarla uyum için
            $_SESSION['giris_var'] = true;
            $_SESSION['kadi']      = $user['username'];
            $_SESSION['yetki']     = $user['rol'];

            header('Location: ../index.php');
            exit;
        } else {
            $_SESSION['login_hata'] = 'Kullanıcı adı/e-posta veya şifre hatalı.';
            header('Location: ../index.php?sayfa=giris');
            exit;
        }
    } catch (PDOException $e) {
        $_SESSION['login_hata'] = 'Veritabanı hatası: ' . $e->getMessage();
        header('Location: ../index.php?sayfa=giris');
        exit;
    }
} else {
    header('Location: ../index.php?sayfa=giris');
    exit;
}
?>