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
        <div class="col-md-7 col-lg-5">
            <div class="alert alert-<?php echo htmlspecialchars($mesaj_tipi); ?> text-center mt-3" role="alert">
                <?php echo htmlspecialchars($mesaj); ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="row justify-content-center align-items-center auth-hero">
    <div class="col-md-7 col-lg-5">
        <div class="card shadow-lg p-4 auth-card">
            <h3 class="card-title text-center mb-2 text-pink-custom">Tekrar Hoş Geldin</h3>
            <p class="text-center text-muted mb-4">Bloguna giriş yap, paylaşımları keşfetmeye devam et.</p>

            <form action="pages/giris_kontrol.php" method="POST">
                <div class="mb-3">
                    <label for="login_username" class="form-label">Kullanıcı Adı veya E-posta</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="login_username" 
                        name="login_identity" 
                        placeholder="ornekkullanici veya mail@ornek.com" 
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="login_password" class="form-label">Şifre</label>
                    <input 
                        type="password" 
                        class="form-control" 
                        id="login_password" 
                        name="login_password" 
                        placeholder="Şifrenizi girin" 
                        required
                    >
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="rememberMe" name="remember_me">
                        <label class="form-check-label" for="rememberMe">
                            Beni hatırla
                        </label>
                    </div>
                    <a href="#" class="small text-pink-custom">Şifremi unuttum</a>
                </div>

                <div class="d-grid gap-2 mt-3">
                    <button type="submit" class="btn btn-primary btn-lg">Giriş Yap</button>
                </div>

                <p class="text-center mt-3 mb-0">
                    Henüz hesabın yok mu?
                    <a href="index.php?sayfa=kayit" class="text-pink-custom fw-bold">Kayıt Ol</a>
                </p>
            </form>
        </div>
    </div>
</div>