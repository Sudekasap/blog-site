<?php
// Giriş sayfası için basit mesaj değişkenleri
$mesaj = '';
$mesaj_tipi = '';

// Eğer önceki giriş denemesinde bir hata mesajı session'a yazıldıysa göster
if (isset($_SESSION['login_hata'])) {
    $mesaj = $_SESSION['login_hata'];
    $mesaj_tipi = 'danger';
    unset($_SESSION['login_hata']);
}
?>

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

<div class="row justify-content-center align-items-center auth-hero py-5">
    <!-- Sol Taraf: Bilgilendirme ve Özellikler -->
    <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
        <div class="auth-features">
            <h4 class="text-center mb-4">
                <i class="bi bi-stars me-2"></i>
                Kendi Işığın Bloguna Hoş Geldin!
            </h4>
            
            <div class="auth-feature-item">
                <div class="auth-feature-icon">
                    <i class="bi bi-pencil-square"></i>
                </div>
                <div class="auth-feature-content">
                    <h5>Hikayelerini Paylaş</h5>
                    <p>Düşüncelerini, deneyimlerini ve ilham verici hikayelerini binlerce okuyucuyla paylaş. Her yazın bir ışık olsun.</p>
                </div>
            </div>

            <div class="auth-feature-item">
                <div class="auth-feature-icon">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div class="auth-feature-content">
                    <h5>Toplulukla Bağlan</h5>
                    <p>Benzer düşüncelere sahip yazarlarla tanış, yorumlar yap, fikir alışverişinde bulun ve birlikte büyü.</p>
                </div>
            </div>

            <div class="auth-feature-item">
                <div class="auth-feature-icon">
                    <i class="bi bi-heart-fill"></i>
                </div>
                <div class="auth-feature-content">
                    <h5>İlham Al ve İlham Ver</h5>
                    <p>Diğer yazarların eserlerinden ilham al, kendi yazılarınla da başkalarına ilham kaynağı ol.</p>
                </div>
            </div>

            <div class="auth-info-box">
                <h5>
                    <i class="bi bi-shield-check"></i>
                    Güvenli ve Özel
                </h5>
                <ul>
                    <li>Verileriniz şifrelenmiş ve güvende</li>
                    <li>Kişisel bilgileriniz korunur</li>
                    <li>Reklamsız deneyim</li>
                    <li>7/24 teknik destek</li>
                </ul>
            </div>

            <div class="auth-stats">
                <div class="auth-stat-card">
                    <span class="auth-stat-number">10K+</span>
                    <span class="auth-stat-label">Aktif Kullanıcı</span>
                </div>
                <div class="auth-stat-card">
                    <span class="auth-stat-number">50K+</span>
                    <span class="auth-stat-label">Blog Yazısı</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Sağ Taraf: Giriş Formu -->
    <div class="col-lg-5 col-md-6">
        <div class="card shadow-lg p-4 auth-card bg-white">
            <div class="text-center mb-4">
                <div class="auth-image-placeholder mb-3" style="max-width: 120px; height: 120px; margin: 0 auto;">
                    <i class="bi bi-person-circle"></i>
                </div>
                <h3 class="card-title mb-2 text-pink-custom">
                    <i class="bi bi-box-arrow-in-right me-2"></i>
                    Tekrar Hoş Geldin
                </h3>
                <p class="text-muted mb-4">
                    Bloguna giriş yap, paylaşımları keşfetmeye devam et. Topluluğumuz seni bekliyor!
                </p>
            </div>

            <form action="pages/giris_kontrol.php" method="POST">
                <div class="mb-3">
                    <label for="login_username" class="form-label fw-bold">
                        <i class="bi bi-person me-1"></i>
                        Kullanıcı Adı veya E-posta
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="bi bi-envelope-at text-muted"></i>
                        </span>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="login_username" 
                            name="login_identity" 
                            placeholder="ornekkullanici veya mail@ornek.com" 
                            required
                        >
                    </div>
                    <small class="text-muted">
                        <i class="bi bi-info-circle me-1"></i>
                        Kullanıcı adın veya kayıtlı e-posta adresin ile giriş yapabilirsin.
                    </small>
                </div>

                <div class="mb-3">
                    <label for="login_password" class="form-label fw-bold">
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
                            id="login_password" 
                            name="login_password" 
                            placeholder="Şifrenizi girin" 
                            required
                        >
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="rememberMe" name="remember_me">
                        <label class="form-check-label" for="rememberMe">
                            <i class="bi bi-check2-square me-1"></i>
                            Beni hatırla
                        </label>
                    </div>
                    <a href="#" class="small text-pink-custom text-decoration-none">
                        <i class="bi bi-question-circle me-1"></i>
                        Şifremi unuttum
                    </a>
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-box-arrow-in-right me-2"></i>
                        Giriş Yap
                    </button>
                </div>

                <div class="text-center mt-4 pt-3 border-top">
                    <p class="mb-2 text-muted">
                        <i class="bi bi-question-circle me-1"></i>
                        Henüz hesabın yok mu?
                    </p>
                    <a href="index.php?sayfa=kayit" class="btn btn-outline-success">
                        <i class="bi bi-person-plus me-2"></i>
                        Hemen Kayıt Ol
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>


