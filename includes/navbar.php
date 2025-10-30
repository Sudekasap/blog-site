<?php
// Bu kod, index.php'de başlatılan $_SESSION'a erişir.

// Kullanıcının giriş yapıp yapmadığını kontrol eder
$giris_yapildi_mi = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;

// Kullanıcı giriş yapmışsa, kullanıcı adı ve rolünü alır
if ($giris_yapildi_mi) {
    $kullanici_adi = htmlspecialchars($_SESSION['username'] ?? 'Kullanıcı');
    $kullanici_rol = htmlspecialchars($_SESSION['user_role'] ?? 'User');
    // Eğer rol Admin veya Editör ise, Yönetim Paneli linki eklenecek
    $admin_girisi_mi = in_array($kullanici_rol, ['Admin', 'Editor']);
} else {
    $admin_girisi_mi = false;
}
?>

<!-- Değişiklikler: bg-dark yerine bg-light ve navbar-dark yerine navbar-light kullanıldı -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm border-bottom">
    <div class="container">
        <!-- Marka Adı -->
        <a class="navbar-brand fw-bold text-pink-custom" href="index.php">KENDİ IŞIĞIN</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Ana Sayfa</a>
                </li>
                <?php if ($admin_girisi_mi): ?>
                    <li class="nav-item">
                        <!-- Yönetim Paneli Linki -->
                        <a class="nav-link text-success fw-bold" href="index.php?sayfa=panel">Yönetim Paneli</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?sayfa=hakkimizda">Hakkımızda</a>
                </li>
            </ul>
            
            <ul class="navbar-nav">
                <?php if ($giris_yapildi_mi): ?>
                    <!-- KULLANICI GİRİŞ YAPMIŞSA -->
                    <li class="nav-item me-3 d-flex align-items-center">
                        <span class="navbar-text">
                            Hoş Geldin, <strong class="text-info"><?php echo $kullanici_adi; ?></strong> (<small><?php echo $kullanici_rol; ?></small>)
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-sm btn-danger mt-2 mt-lg-0" href="index.php?sayfa=cikis">Çıkış Yap</a>
                    </li>
                <?php else: ?>
                    <!-- KULLANICI GİRİŞ YAPMAMIŞSA -->
                    <li class="nav-item">
                        <a class="btn btn-sm btn-outline-info me-2 mt-2 mt-lg-0" href="index.php?sayfa=giris">Giriş Yap</a>
                    </li>
                    <li class="nav-item">
                        <!-- Kayıt butonu için canlı bir renk (success) kullandık -->
                        <a class="btn btn-sm btn-success mt-2 mt-lg-0" href="index.php?sayfa=kayit">Kayıt Ol</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>