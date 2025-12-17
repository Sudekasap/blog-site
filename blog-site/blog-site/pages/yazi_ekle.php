<?php
/**
 * Blog Yazısı Ekleme Sayfası
 * Giriş yapan kullanıcılar için blog yazısı ekleme formu
 */

// Giriş kontrolü
if (!isset($_SESSION['giris_var']) || $_SESSION['giris_var'] != true) {
    header("Location: index.php?sayfa=giris");
    exit;
}

$mesaj = '';
$mesaj_tipi = '';

// Form gönderildi mi?
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Form kontrol sayfasına yönlendir
    header("Location: yazi_ekle_kontrol.php");
    exit;
}

// Başarı/hata mesajları
if (isset($_GET['yazi_eklendi']) && $_GET['yazi_eklendi'] == '1') {
    $mesaj = 'Yazınız başarıyla eklendi ve yayınlandı!';
    $mesaj_tipi = 'success';
}

if (isset($_GET['yazi_ekle_hata']) && isset($_SESSION['yazi_ekle_hata'])) {
    $mesaj = $_SESSION['yazi_ekle_hata'];
    $mesaj_tipi = 'danger';
    unset($_SESSION['yazi_ekle_hata']);
}
?>

<div class="row mb-4">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
                    <i class="bi bi-pencil-square me-2"></i>
                    Yeni Blog Yazısı Ekle
                </h4>
            </div>
            <div class="card-body">
                <?php if ($mesaj): ?>
                    <div class="alert alert-<?php echo $mesaj_tipi; ?> alert-dismissible fade show" role="alert">
                        <?php echo htmlspecialchars($mesaj); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="yazi_ekle_kontrol.php" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="baslik" class="form-label fw-bold">
                            <i class="bi bi-type me-1"></i>
                            Başlık <span class="text-danger">*</span>
                        </label>
                        <input 
                            type="text" 
                            class="form-control form-control-lg" 
                            id="baslik" 
                            name="baslik" 
                            placeholder="Örn: Evde Doğal Cilt Bakımı Maskeleri"
                            value="<?php echo htmlspecialchars($_POST['baslik'] ?? ''); ?>"
                            required
                            minlength="10"
                        >
                        <div class="invalid-feedback">
                            Lütfen en az 10 karakter uzunluğunda bir başlık girin.
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="ozet" class="form-label fw-bold">
                            <i class="bi bi-card-text me-1"></i>
                            Özet <span class="text-danger">*</span>
                        </label>
                        <textarea 
                            class="form-control" 
                            id="ozet" 
                            name="ozet" 
                            rows="3" 
                            placeholder="Yazınızın kısa özetini girin (ana sayfada görünecek)..."
                            required
                            minlength="50"
                        ><?php echo htmlspecialchars($_POST['ozet'] ?? ''); ?></textarea>
                        <div class="invalid-feedback">
                            Lütfen en az 50 karakter uzunluğunda bir özet girin.
                        </div>
                        <small class="text-muted">Ana sayfada görünecek kısa açıklama (150-200 karakter önerilir)</small>
                    </div>
                    
                    <div class="mb-3">
                        <label for="icerik" class="form-label fw-bold">
                            <i class="bi bi-file-text me-1"></i>
                            İçerik <span class="text-danger">*</span>
                        </label>
                        <textarea 
                            class="form-control" 
                            id="icerik" 
                            name="icerik" 
                            rows="10" 
                            placeholder="Yazınızın detaylı içeriğini girin... HTML etiketleri kullanabilirsiniz (örn: &lt;h2&gt;, &lt;p&gt;, &lt;ul&gt;, &lt;li&gt;)"
                            required
                            minlength="100"
                        ><?php echo htmlspecialchars($_POST['icerik'] ?? ''); ?></textarea>
                        <div class="invalid-feedback">
                            Lütfen en az 100 karakter uzunluğunda bir içerik girin.
                        </div>
                        <small class="text-muted">HTML etiketleri kullanabilirsiniz: &lt;h2&gt;, &lt;p&gt;, &lt;ul&gt;, &lt;li&gt;, &lt;strong&gt;, &lt;em&gt; vb.</small>
                    </div>
                    
                    <div class="mb-3">
                        <label for="resim_yolu" class="form-label fw-bold">
                            <i class="bi bi-image me-1"></i>
                            Resim URL (Opsiyonel)
                        </label>
                        <input 
                            type="url" 
                            class="form-control" 
                            id="resim_yolu" 
                            name="resim_yolu" 
                            placeholder="https://images.unsplash.com/photo-..."
                            value="<?php echo htmlspecialchars($_POST['resim_yolu'] ?? ''); ?>"
                        >
                        <small class="text-muted">Resim URL'si girmezseniz varsayılan bir resim kullanılacaktır. Unsplash, Imgur gibi servislerden URL kullanabilirsiniz.</small>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-check-circle me-2"></i>
                            Yazıyı Yayınla
                        </button>
                        <a href="index.php" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i>
                            İptal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Örnek Resim URL'leri -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card bg-light border-0">
            <div class="card-body">
                <h6 class="fw-bold mb-3">
                    <i class="bi bi-info-circle me-2"></i>
                    Örnek Resim URL'leri (Kopyalayıp kullanabilirsiniz):
                </h6>
                <div class="row g-2">
                    <div class="col-md-3">
                        <input type="text" class="form-control form-control-sm" readonly 
                            value="https://images.unsplash.com/photo-1556228578-0d85b1a4d571?w=400&h=300&fit=crop"
                            onclick="this.select(); document.execCommand('copy');"
                            title="Tıklayarak kopyala">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control form-control-sm" readonly 
                            value="https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?w=400&h=300&fit=crop"
                            onclick="this.select(); document.execCommand('copy');"
                            title="Tıklayarak kopyala">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control form-control-sm" readonly 
                            value="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=400&h=300&fit=crop"
                            onclick="this.select(); document.execCommand('copy');"
                            title="Tıklayarak kopyala">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control form-control-sm" readonly 
                            value="https://images.unsplash.com/photo-1512496015851-a90fb38ba796?w=400&h=300&fit=crop"
                            onclick="this.select(); document.execCommand('copy');"
                            title="Tıklayarak kopyala">
                    </div>
                </div>
                <small class="text-muted mt-2 d-block">Unsplash'tan daha fazla resim için: <a href="https://unsplash.com" target="_blank">unsplash.com</a></small>
            </div>
        </div>
    </div>
</div>

<script>
// Form validasyonu
(function() {
    'use strict';
    var form = document.querySelector('form.needs-validation');
    if (form) {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    }
})();
</script>
