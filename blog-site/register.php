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
        <div class="col-md-7 col-lg-6">
            <div class="alert alert-<?php echo htmlspecialchars($mesaj_tipi); ?> text-center mt-3" role="alert">
                <?php echo htmlspecialchars($mesaj); ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- HTML TASARIMI BURADAN BAŞLAR -->
<div class="row justify-content-center align-items-center auth-hero">
    <div class="col-md-7 col-lg-6">
        <div class="card shadow-lg p-4 auth-card">
            <h3 class="card-title text-center mb-2 text-pink-custom">Yeni Üyelik Oluştur</h3>
            <p class="text-center text-muted mb-4">Blog topluluğumuza katıl, hikayelerini paylaş.</p>
            
            <form action="index.php?sayfa=kayit" method="POST">
                
                <div class="mb-3">
                    <label for="reg_username" class="form-label">Kullanıcı Adı</label>
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
                
                <div class="mb-3">
                    <label for="reg_email" class="form-label">E-posta Adresi</label>
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
                
                <div class="mb-3">
                    <label for="reg_password" class="form-label">Şifre</label>
                    <input 
                        type="password" 
                        class="form-control" 
                        id="reg_password" 
                        name="password" 
                        placeholder="En az 6 karakter"
                        required
                    >
                </div>
                
                <div class="mb-3">
                    <label for="reg_password_repeat" class="form-label">Şifre Tekrar</label>
                    <input 
                        type="password" 
                        class="form-control" 
                        id="reg_password_repeat" 
                        name="password_repeat" 
                        placeholder="Şifrenizi tekrar girin"
                        required
                    >
                </div>
                
                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-success btn-lg">Kayıt Ol</button>
                </div>
                
                <p class="text-center mt-3 mb-0">
                    Zaten hesabın var mı?
                    <a href="index.php?sayfa=giris" class="text-pink-custom fw-bold">Giriş Yap</a>
                </p>
            </form>
        </div>
    </div>
</div>
