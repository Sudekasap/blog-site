<?php
/**
 * Blog Yazısı Ekleme Kontrol Sayfası
 * Form gönderildiğinde buraya yönlendirilir
 */

// Session kontrolü
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Giriş kontrolü
if (!isset($_SESSION['giris_var']) || $_SESSION['giris_var'] != true) {
    header("Location: ../index.php?sayfa=giris");
    exit;
}

// Veritabanı bağlantısı
require_once __DIR__ . '/../baglanti.php';

// Form gönderildi mi?
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $baslik = trim($_POST['baslik'] ?? '');
    $ozet = trim($_POST['ozet'] ?? '');
    $icerik = trim($_POST['icerik'] ?? '');
    $resim_yolu = trim($_POST['resim_yolu'] ?? '');
    
    // Validasyon
    $hata = '';
    
    if (empty($baslik) || strlen($baslik) < 10) {
        $hata = 'Başlık en az 10 karakter olmalıdır!';
    } elseif (empty($ozet) || strlen($ozet) < 50) {
        $hata = 'Özet en az 50 karakter olmalıdır!';
    } elseif (empty($icerik) || strlen($icerik) < 100) {
        $hata = 'İçerik en az 100 karakter olmalıdır!';
    }
    
    if ($hata) {
        $_SESSION['yazi_ekle_hata'] = $hata;
        header("Location: ../index.php?sayfa=yazi_ekle&yazi_ekle_hata=1");
        exit;
    }
    
    // Resim yolu yoksa varsayılan resim
    if (empty($resim_yolu)) {
        $resim_yolu = 'https://images.unsplash.com/photo-1556228578-0d85b1a4d571?w=400&h=300&fit=crop';
    }
    
    try {
        // Kullanıcı ID'sini username'den al
        $kullanici_query = $db->prepare("SELECT id FROM kullanicilar WHERE username = :username");
        $kullanici_query->execute(['username' => $_SESSION['kadi']]);
        $kullanici = $kullanici_query->fetch();
        $kullanici_id = $kullanici['id'] ?? null;
        
        if (!$kullanici_id) {
            throw new Exception("Kullanıcı bulunamadı!");
        }
        
        // Yazıyı ekle
        $sql = "INSERT INTO yazilar (baslik, ozet, icerik, resim_yolu, yazar_id, durum, yayin_tarihi) 
                VALUES (:baslik, :ozet, :icerik, :resim_yolu, :yazar_id, 'Yayinlandi', NOW())";
        
        $stmt = $db->prepare($sql);
        $stmt->execute([
            'baslik' => $baslik,
            'ozet' => $ozet,
            'icerik' => $icerik,
            'resim_yolu' => $resim_yolu,
            'yazar_id' => $kullanici_id
        ]);
        
        // Başarılı - ana sayfaya yönlendir
        header("Location: ../index.php?yazi_eklendi=1");
        exit;
        
    } catch (PDOException $e) {
        $_SESSION['yazi_ekle_hata'] = 'Bir hata oluştu: ' . $e->getMessage();
        header("Location: ../index.php?sayfa=yazi_ekle&yazi_ekle_hata=1");
        exit;
    } catch (Exception $e) {
        $_SESSION['yazi_ekle_hata'] = $e->getMessage();
        header("Location: ../index.php?sayfa=yazi_ekle&yazi_ekle_hata=1");
        exit;
    }
} else {
    // GET isteği - ana sayfaya yönlendir
    header("Location: ../index.php");
    exit;
}

