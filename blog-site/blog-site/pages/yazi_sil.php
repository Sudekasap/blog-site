<?php
// Yazı silme işlemi
session_start();
require_once '../baglanti.php';

// Kullanıcı giriş yapmış mı?
if (empty($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../index.php?sayfa=giris');
    exit;
}

$yazi_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($yazi_id <= 0) {
    header('Location: ../index.php?yazi_sil_hata=1');
    exit;
}

try {
    // Yazıyı ve yazarını çek
    $stmt = $db->prepare("SELECT id, yazar_id FROM yazilar WHERE id = :id");
    $stmt->execute([':id' => $yazi_id]);
    $yazi = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$yazi) {
        header('Location: ../index.php?yazi_sil_hata=1');
        exit;
    }

    $currentUserId = $_SESSION['user_id'] ?? null;
    $currentRole   = $_SESSION['user_role'] ?? ($_SESSION['yetki'] ?? '');

    $yetkili_mi = false;
    if (in_array($currentRole, ['Admin', 'Editor'])) {
        $yetkili_mi = true;
    } elseif ($currentUserId && $yazi['yazar_id'] == $currentUserId) {
        $yetkili_mi = true;
    }

    if (!$yetkili_mi) {
        header('Location: ../index.php?yazi_sil_hata=1');
        exit;
    }

    // Yazıyı tamamen sil (istersen burada soft delete de yapabilirsin)
    $del = $db->prepare("DELETE FROM yazilar WHERE id = :id");
    $del->execute([':id' => $yazi_id]);

    header('Location: ../index.php?yazi_silindi=1');
    exit;

} catch (PDOException $e) {
    header('Location: ../index.php?yazi_sil_hata=1');
    exit;
}


