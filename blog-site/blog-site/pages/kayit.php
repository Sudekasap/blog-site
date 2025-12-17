<?php
// Hata ve Başarı mesajlarını tutacak değişkenler
$mesaj = '';
$mesaj_tipi = ''; 
$kullanici_adi_value = '';
$email_value = '';

// Formun POST edilip edilmediğini kontrol et
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Veri Temizleme ve Alma
    $kullanici_adi = trim(htmlspecialchars($_POST['username'] ?? ''));
    $email         = trim(htmlspecialchars($_POST['email'] ?? ''));
    $sifre         = $_POST['password'] ?? '';
    $sifre_tekrar  = $_POST['password_repeat'] ?? ''; 

    // Form değerlerini hata durumunda tekrar göstermek için kaydet
    $kullanici_adi_value = $kullanici_adi;
    $email_value = $email;

    // 2. Zorunlu Alan ve Temel Doğrulama Kontrolleri
    if (empty($kullanici_adi) || empty($email) || empty($sifre) || empty($sifre_tekrar)) {
        $mesaj = "Lütfen tüm alanları doldurunuz.";
        $mesaj_tipi = 'danger';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mesaj = "Geçerli bir e-posta adresi giriniz.";
        $mesaj_tipi = 'danger';
    } elseif ($sifre !== $sifre_tekrar) {
        $mesaj = "Şifreler birbiriyle eşleşmiyor.";
        $mesaj_tipi = 'danger';
    } elseif (strlen($sifre) < 6) {
        $mesaj = "Şifreniz en az 6 karakter olmalıdır.";
        $mesaj_tipi = 'danger';
    } else {
        
        // 3. Kullanıcı Adı ve E-posta Tekrar Kontrolü
        $sql = "SELECT id FROM kullanicilar WHERE username = :username OR email = :email LIMIT 1";
        
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':username', $kullanici_adi);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $mesaj = "Bu kullanıcı adı veya e-posta adresi zaten kullanımda.";
                $mesaj_tipi = 'danger';
            } else {
                
                // 4. Şifreyi Hash'leme
                $hashed_password = password_hash($sifre, PASSWORD_DEFAULT);
                $rol = 'User'; 

                // 5. Veritabanına Kayıt
                $sql_insert = "INSERT INTO kullanicilar (username, email, password, rol) VALUES (:username, :email, :password, :rol)";
                
                $stmt_insert = $db->prepare($sql_insert);
                $stmt_insert->bindParam(':username', $kullanici_adi);
                $stmt_insert->bindParam(':email', $email);
                $stmt_insert->bindParam(':password', $hashed_password);
                $stmt_insert->bindParam(':rol', $rol);
                
                $stmt_insert->execute();

                // Kayıt Başarılı!
                $mesaj = "Kayıt işlemi başarılı! Şimdi giriş yapabilirsiniz.";
                $mesaj_tipi = 'success';
                
                // Başarılı kayıttan sonra form alanlarını temizle
                $kullanici_adi_value = '';
                $email_value = '';

            }
        } catch (PDOException $e) {
            $mesaj = "Veritabanı hatası oluştu. Lütfen yöneticinize başvurunuz. (Hata: " . $e->getMessage() . ")";
            $mesaj_tipi = 'danger';
        }
    }
}
// PHP KODU BURADA BİTİYOR
?>

<!-- Bu kısım, Hata/Başarı mesajını formun hemen üstünde göstermek için eklenmiştir -->
<?php if (!empty($mesaj)): ?>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="alert alert-<?php echo htmlspecialchars($mesaj_tipi); ?> text-center mt-3" role="alert">
                <i class="bi bi-<?php echo $mesaj_tipi === 'success' ? 'check-circle' : 'exclamation-triangle'; ?>-fill me-2"></i>
                <?php echo htmlspecialchars($mesaj); ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- HTML TASARIMI BURADAN BAŞLAR -->
<div class="row justify-content-center align-items-center auth-hero py-5">
    <!-- Sol Taraf: Kayıt Formu -->
    <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
        <div class="card shadow-lg p-4 auth-card bg-white">
            <div class="text-center mb-4">
                <div class="auth-image-placeholder mb-3" style="max-width: 120px; height: 120px; margin: 0 auto;">
                    <i class="bi bi-person-plus"></i>
                </div>
                <h3 class="card-title mb-2 text-pink-custom">
                    <i class="bi bi-star-fill me-2"></i>
                    Yeni Üyelik Oluştur
                </h3>
                <p class="text-muted mb-4">
                    Blog topluluğumuza katıl, hikayelerini paylaş ve binlerce okuyucuya ulaş. Sen de kendi ışığını yak!
                </p>
            </div>
            
            <form action="index.php?sayfa=kayit" method="POST">
                <div class="mb-3">
                    <label for="reg_username" class="form-label fw-bold">
                        <i class="bi bi-person me-1"></i>
                        Kullanıcı Adı
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="bi bi-at text-muted"></i>
                        </span>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="reg_username" 
                            name="username" 
                            value="<?php echo htmlspecialchars($kullanici_adi_value); ?>" 
                            placeholder="Kullanıcı adınızı girin"
                            required
                        >
                    </div>
                    <small class="text-muted">
                        <i class="bi bi-info-circle me-1"></i>
                        Benzersiz bir kullanıcı adı seç. Bu ad profilinde görünecek.
                    </small>
                </div>
                
                <div class="mb-3">
                    <label for="reg_email" class="form-label fw-bold">
                        <i class="bi bi-envelope me-1"></i>
                        E-posta Adresi
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="bi bi-envelope-at text-muted"></i>
                        </span>
                        <input 
                            type="email" 
                            class="form-control" 
                            id="reg_email" 
                            name="email" 
                            value="<?php echo htmlspecialchars($email_value); ?>" 
                            placeholder="ornek@email.com"
                            required
                        >
                    </div>
                    <small class="text-muted">
                        <i class="bi bi-shield-check me-1"></i>
                        E-posta adresin gizli tutulur ve sadece bildirimler için kullanılır.
                    </small>
                </div>
                
                <div class="mb-3">
                    <label for="reg_password" class="form-label fw-bold">
                        <i class="bi bi-lock me-1"></i>
                        Şifre
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="bi bi-key text-muted"></i>
                        </span>
                        <input 
                            type="password" 
                            class="form-control" 
                            id="reg_password" 
                            name="password" 
                            placeholder="En az 6 karakter"
                            required
                        >
                    </div>
                    <small class="text-muted">
                        <i class="bi bi-exclamation-triangle me-1"></i>
                        Güçlü bir şifre seç: En az 6 karakter, harf ve rakam kombinasyonu önerilir.
                    </small>
                </div>
                
                <div class="mb-3">
                    <label for="reg_password_repeat" class="form-label fw-bold">
                        <i class="bi bi-lock-fill me-1"></i>
                        Şifre Tekrar
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="bi bi-key-fill text-muted"></i>
                        </span>
                        <input 
                            type="password" 
                            class="form-control" 
                            id="reg_password_repeat" 
                            name="password_repeat" 
                            placeholder="Şifrenizi tekrar girin"
                            required
                        >
                    </div>
                    <small class="text-muted">
                        <i class="bi bi-check2-circle me-1"></i>
                        Şifrenizi doğrulamak için tekrar girin.
                    </small>
                </div>
                
                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="bi bi-person-plus me-2"></i>
                        Kayıt Ol ve Başla
                    </button>
                </div>
                
                <div class="text-center mt-4 pt-3 border-top">
                    <p class="mb-2 text-muted">
                        <i class="bi bi-question-circle me-1"></i>
                        Zaten hesabın var mı?
                    </p>
                    <a href="index.php?sayfa=giris" class="btn btn-outline-primary">
                        <i class="bi bi-box-arrow-in-right me-2"></i>
                        Giriş Yap
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Sağ Taraf: Bilgilendirme ve Avantajlar -->
    <div class="col-lg-5 col-md-6">
        <div class="auth-features">
            <h4 class="text-center mb-4">
                <i class="bi bi-gift-fill me-2"></i>
                Kayıt Ol, Avantajları Keşfet!
            </h4>
            
            <div class="auth-feature-item">
                <div class="auth-feature-icon">
                    <i class="bi bi-journal-text"></i>
                </div>
                <div class="auth-feature-content">
                    <h5>Sınırsız Yazı Paylaşımı</h5>
                    <p>İstediğin kadar blog yazısı yayınla. Düşüncelerini, deneyimlerini ve hikayelerini özgürce paylaş. Her yazın senin sesin olsun.</p>
                </div>
            </div>

            <div class="auth-feature-item">
                <div class="auth-feature-icon">
                    <i class="bi bi-image"></i>
                </div>
                <div class="auth-feature-content">
                    <h5>Görsel Zengin İçerik</h5>
                    <p>Yazılarına fotoğraflar, görseller ve videolar ekle. İçeriğini görsel olarak zenginleştir ve okuyucuların dikkatini çek.</p>
                </div>
            </div>

            <div class="auth-feature-item">
                <div class="auth-feature-icon">
                    <i class="bi bi-graph-up-arrow"></i>
                </div>
                <div class="auth-feature-content">
                    <h5>İstatistikler ve Analiz</h5>
                    <p>Yazılarının kaç kişi tarafından okunduğunu gör, hangi konularda daha başarılı olduğunu öğren ve içeriğini geliştir.</p>
                </div>
            </div>

            <div class="auth-feature-item">
                <div class="auth-feature-icon">
                    <i class="bi bi-chat-dots"></i>
                </div>
                <div class="auth-feature-content">
                    <h5>Etkileşimli Topluluk</h5>
                    <p>Diğer yazarlarla yorum yap, beğen, paylaş ve fikir alışverişinde bulun. Aktif bir topluluğun parçası ol.</p>
                </div>
            </div>

            <div class="auth-info-box">
                <h5>
                    <i class="bi bi-award-fill"></i>
                    Ücretsiz ve Kolay
                </h5>
                <ul>
                    <li>Kayıt tamamen ücretsiz</li>
                    <li>Kredi kartı bilgisi gerekmez</li>
                    <li>Hemen başlayabilirsin</li>
                    <li>İstediğin zaman çıkış yapabilirsin</li>
                </ul>
            </div>

            <div class="auth-stats">
                <div class="auth-stat-card">
                    <span class="auth-stat-number">%100</span>
                    <span class="auth-stat-label">Ücretsiz</span>
                </div>
                <div class="auth-stat-card">
                    <span class="auth-stat-number">24/7</span>
                    <span class="auth-stat-label">Destek</span>
                </div>
            </div>
        </div>
    </div>
</div>

