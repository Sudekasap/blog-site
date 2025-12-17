<?php
// Yorum ekleme işleme sayfası
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Eğer index.php üzerinden gelmediyse veritabanı bağlantısını garanti altına al
if (!isset($db) && file_exists(__DIR__ . '/../baglanti.php')) {
    require_once __DIR__ . '/../baglanti.php';
}

// Kullanıcı giriş yapmış mı kontrol et
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    $_SESSION['yorum_hata'] = 'Yorum yapmak için lütfen giriş yapın.';
    header('Location: ../index.php?sayfa=giris');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $yazi_id = isset($_POST['yazi_id']) ? intval($_POST['yazi_id']) : 0;
    $yorum_metni = isset($_POST['yorum_metni']) ? trim($_POST['yorum_metni']) : '';
    $kullanici_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : 0;

    // Validasyon
    if ($yazi_id <= 0) {
        $_SESSION['yorum_hata'] = 'Geçersiz yazı ID\'si.';
        header('Location: ../index.php?sayfa=detay&id=' . $yazi_id);
        exit;
    }

    if (empty($yorum_metni) || strlen($yorum_metni) < 10) {
        $_SESSION['yorum_hata'] = 'Yorum en az 10 karakter olmalıdır.';
        header('Location: ../index.php?sayfa=detay&id=' . $yazi_id);
        exit;
    }

    if (strlen($yorum_metni) > 1000) {
        $_SESSION['yorum_hata'] = 'Yorum en fazla 1000 karakter olabilir.';
        header('Location: ../index.php?sayfa=detay&id=' . $yazi_id);
        exit;
    }

    if ($kullanici_id <= 0) {
        $_SESSION['yorum_hata'] = 'Kullanıcı bilgisi bulunamadı.';
        header('Location: ../index.php?sayfa=detay&id=' . $yazi_id);
        exit;
    }

    // Yazının var olup olmadığını kontrol et
    try {
        $yazi_kontrol = $db->prepare("SELECT id FROM yazilar WHERE id = :id AND durum = 'Yayinlandi'");
        $yazi_kontrol->execute([':id' => $yazi_id]);
        $yazi_var = $yazi_kontrol->fetch();

        if (!$yazi_var) {
            $_SESSION['yorum_hata'] = 'Yazı bulunamadı veya yayınlanmamış.';
            header('Location: ../index.php?sayfa=home');
            exit;
        }

        // Yorumu veritabanına ekle
        $yorum_ekle = $db->prepare("
            INSERT INTO yorumlar (yazi_id, kullanici_id, yorum_metni, durum) 
            VALUES (:yazi_id, :kullanici_id, :yorum_metni, 'Onaylandi')
        ");

        $yorum_ekle->execute([
            ':yazi_id' => $yazi_id,
            ':kullanici_id' => $kullanici_id,
            ':yorum_metni' => $yorum_metni
        ]);

        $_SESSION['yorum_basarili'] = 'Yorumunuz başarıyla eklendi!';
        header('Location: ../index.php?sayfa=detay&id=' . $yazi_id);
        exit;

    } catch (PDOException $e) {
        $_SESSION['yorum_hata'] = 'Yorum eklenirken bir hata oluştu: ' . $e->getMessage();
        header('Location: ../index.php?sayfa=detay&id=' . $yazi_id);
        exit;
    }
} else {
    // GET isteği ile gelirse ana sayfaya yönlendir
    header('Location: ../index.php?sayfa=home');
    exit;
}
?>
