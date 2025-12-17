<?php
// Bu dosya: blog-site/pages/detay.php
// $db bağlantısının index.php tarafından sağlandığını varsayıyoruz.

// Blog yazısına göre ilgili ürün linklerini döndüren fonksiyon
function getRelatedProducts($baslik, $ozet = '', $icerik = '') {
    $text = strtolower($baslik . ' ' . $ozet . ' ' . strip_tags($icerik));
    $products = [];
    
    // Cilt bakımı ile ilgili
    if (strpos($text, 'cilt') !== false || strpos($text, 'bakım') !== false || strpos($text, 'güzellik') !== false || strpos($text, 'nem') !== false) {
        $products[] = [
            'title' => 'Cilt Bakım Seti - Nemlendirici',
            'link' => 'https://www.trendyol.com/sr?q=cilt+bakım+seti+nemlendirici&qt=cilt+bakım+seti+nemlendirici&st=cilt+bakım+seti+nemlendirici',
            'icon' => 'bi-droplet-fill',
            'color' => 'primary'
        ];
        $products[] = [
            'title' => 'Güneş Koruyucu Krem SPF 50',
            'link' => 'https://www.trendyol.com/sr?q=güneş+koruyucu+krem+spf+50&qt=güneş+koruyucu+krem+spf+50&st=güneş+koruyucu+krem+spf+50',
            'icon' => 'bi-sun-fill',
            'color' => 'warning'
        ];
        $products[] = [
            'title' => 'Cilt Temizleme Jeli',
            'link' => 'https://www.trendyol.com/sr?q=cilt+temizleme+jeli&qt=cilt+temizleme+jeli&st=cilt+temizleme+jeli',
            'icon' => 'bi-brush-fill',
            'color' => 'info'
        ];
    }
    // Sağlık ile ilgili
    elseif (strpos($text, 'sağlık') !== false || strpos($text, 'vitamin') !== false || strpos($text, 'beslenme') !== false || strpos($text, 'diyet') !== false) {
        $products[] = [
            'title' => 'Multivitamin Kompleks',
            'link' => 'https://www.trendyol.com/sr?q=multivitamin+kompleks&qt=multivitamin+kompleks&st=multivitamin+kompleks',
            'icon' => 'bi-capsule',
            'color' => 'success'
        ];
        $products[] = [
            'title' => 'Omega 3 Balık Yağı',
            'link' => 'https://www.trendyol.com/sr?q=omega+3+balık+yağı&qt=omega+3+balık+yağı&st=omega+3+balık+yağı',
            'icon' => 'bi-heart-pulse-fill',
            'color' => 'danger'
        ];
        $products[] = [
            'title' => 'Probiyotik Takviyesi',
            'link' => 'https://www.trendyol.com/sr?q=probiyotik+takviyesi&qt=probiyotik+takviyesi&st=probiyotik+takviyesi',
            'icon' => 'bi-shield-check',
            'color' => 'primary'
        ];
    }
    // Spor/Fitness ile ilgili
    elseif (strpos($text, 'spor') !== false || strpos($text, 'fitness') !== false || strpos($text, 'egzersiz') !== false || strpos($text, 'antrenman') !== false) {
        $products[] = [
            'title' => 'Spor Ayakkabısı',
            'link' => 'https://www.trendyol.com/sr?q=spor+ayakkabısı&qt=spor+ayakkabısı&st=spor+ayakkabısı',
            'icon' => 'bi-lightning-fill',
            'color' => 'warning'
        ];
        $products[] = [
            'title' => 'Spor Kıyafeti Seti',
            'link' => 'https://www.trendyol.com/sr?q=spor+kıyafeti+seti&qt=spor+kıyafeti+seti&st=spor+kıyafeti+seti',
            'icon' => 'bi-trophy-fill',
            'color' => 'success'
        ];
        $products[] = [
            'title' => 'Protein Tozu',
            'link' => 'https://www.trendyol.com/sr?q=protein+tozu&qt=protein+tozu&st=protein+tozu',
            'icon' => 'bi-star-fill',
            'color' => 'info'
        ];
    }
    // Moda/Giyim ile ilgili
    elseif (strpos($text, 'moda') !== false || strpos($text, 'giyim') !== false || strpos($text, 'kıyafet') !== false || strpos($text, 'stil') !== false) {
        $products[] = [
            'title' => 'Trend Kadın Giyim',
            'link' => 'https://www.trendyol.com/sr?q=kadın+giyim+trend&qt=kadın+giyim+trend&st=kadın+giyim+trend',
            'icon' => 'bi-bag-fill',
            'color' => 'primary'
        ];
        $products[] = [
            'title' => 'Aksesuar Seti',
            'link' => 'https://www.trendyol.com/sr?q=aksesuar+seti&qt=aksesuar+seti&st=aksesuar+seti',
            'icon' => 'bi-gem',
            'color' => 'warning'
        ];
        $products[] = [
            'title' => 'Çanta Koleksiyonu',
            'link' => 'https://www.trendyol.com/sr?q=çanta+koleksiyonu&qt=çanta+koleksiyonu&st=çanta+koleksiyonu',
            'icon' => 'bi-briefcase-fill',
            'color' => 'success'
        ];
    }
    // Genel/Yaşam ile ilgili (varsayılan)
    else {
        $products[] = [
            'title' => 'Yaşam Rehberi Kitapları',
            'link' => 'https://www.trendyol.com/sr?q=yaşam+rehberi+kitap&qt=yaşam+rehberi+kitap&st=yaşam+rehberi+kitap',
            'icon' => 'bi-book-fill',
            'color' => 'primary'
        ];
        $products[] = [
            'title' => 'Motivasyon Ürünleri',
            'link' => 'https://www.trendyol.com/sr?q=motivasyon+ürünleri&qt=motivasyon+ürünleri&st=motivasyon+ürünleri',
            'icon' => 'bi-lightbulb-fill',
            'color' => 'warning'
        ];
        $products[] = [
            'title' => 'Ev Dekorasyon',
            'link' => 'https://www.trendyol.com/sr?q=ev+dekorasyon&qt=ev+dekorasyon&st=ev+dekorasyon',
            'icon' => 'bi-house-heart-fill',
            'color' => 'info'
        ];
    }
    
    return $products;
}

// 1. URL'den ID'yi alıyoruz (index.php?sayfa=detay&id=X)
// Güvenlik için intval() ile sadece tam sayı değerini alıyoruz.
$yazi_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($yazi_id > 0) {
    // 2. Veritabanından o ID'ye ait yazıyı ve yazar adını çekiyoruz
    $sorgu = $db->prepare("
        SELECT y.*, k.username AS yazar_adi 
        FROM yazilar y 
        INNER JOIN kullanicilar k ON y.yazar_id = k.id 
        WHERE y.id = :id AND y.durum = 'Yayinlandi'
    ");
    $sorgu->execute([':id' => $yazi_id]);
    $yazi = $sorgu->fetch(PDO::FETCH_ASSOC);
}

// Eğer yazı bulunamadıysa (ID hatalıysa veya yayınlanmamışsa)
if (!$yazi_id || !$yazi) {
    // 404 sayfasına yönlendirme (veya basit bir hata mesajı gösterme)
    header("Location: index.php?sayfa=404");
    exit;
}

// Yorumları veritabanından çek (sadece onaylanmış yorumlar)
try {
    $yorum_sorgu = $db->prepare("
        SELECT y.*, k.username AS kullanici_adi, k.id AS kullanici_id
        FROM yorumlar y
        INNER JOIN kullanicilar k ON y.kullanici_id = k.id
        WHERE y.yazi_id = :yazi_id AND y.durum = 'Onaylandi'
        ORDER BY y.yorum_tarihi DESC
    ");
    $yorum_sorgu->execute([':yazi_id' => $yazi_id]);
    $yorumlar = $yorum_sorgu->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $yorumlar = [];
}

// Kullanıcı giriş yapmış mı kontrol et
$kullanici_giris_yapti = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
$kullanici_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
?>

<!-- YAZI DETAY TASARIMI -->
<div class="row justify-content-center">
    <div class="col-lg-10">
        
        <!-- Başlık ve Meta Bilgiler -->
        <div class="mb-4 text-center border-bottom pb-3">
            <h1 class="display-5 fw-bold text-dark"><?php echo htmlspecialchars($yazi['baslik']); ?></h1>
            <p class="text-muted small">
                <span class="me-3">✍️ Yazar: <strong><?php echo htmlspecialchars($yazi['yazar_adi']); ?></strong></span>
                <span>📅 Tarih: <?php echo date("d.m.Y", strtotime($yazi['yayin_tarihi'])); ?></span>
            </p>
        </div>

        <!-- Büyük Kapak Resmi -->
        <div class="mb-5 shadow-lg rounded overflow-hidden">
            <img 
                src="<?php echo !empty($yazi['resim_yolu']) ? htmlspecialchars($yazi['resim_yolu']) : 'https://images.unsplash.com/photo-1556228578-0d85b1a4d571?w=800&h=600&fit=crop'; ?>" 
                class="img-fluid w-100" 
                alt="<?php echo htmlspecialchars($yazi['baslik']); ?>" 
                style="max-height: 500px; object-fit: cover;"
                onerror="this.src='https://images.unsplash.com/photo-1556228578-0d85b1a4d571?w=800&h=600&fit=crop'"
            >
        </div>

        <!-- İçerik Alanı -->
        <div class="bg-light p-4 p-md-5 rounded shadow-sm article-content">
            <p class="lead font-italic mb-4 text-secondary border-start border-4 border-primary ps-3">
                <!-- Özet bilgisi -->
                <?php echo htmlspecialchars($yazi['ozet']); ?>
            </p>
            
            <hr class="my-4">
            
            <div class="fs-5 text-dark" style="line-height: 1.8;">
                <!-- İçerikteki HTML etiketlerini çalıştırmak için htmlspecialchars KULLANILMAZ -->
                <?php echo $yazi['icerik']; ?>
            </div>
        </div>

        <!-- İlgili Ürünler Bölümü -->
        <?php 
        $relatedProducts = getRelatedProducts($yazi['baslik'], $yazi['ozet'], $yazi['icerik'] ?? '');
        if (!empty($relatedProducts)): 
        ?>
        <div class="mt-5 mb-4">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-gradient-primary text-white">
                    <h4 class="mb-0 fw-bold">
                        <i class="bi bi-bag-check me-2"></i>
                        Bu Yazıyla İlgili En Çok Satan Ürünler
                    </h4>
                    <p class="mb-0 small mt-2 opacity-75">
                        Yazıda bahsedilen konularla ilgili önerilen ürünler
                    </p>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <?php foreach ($relatedProducts as $product): ?>
                            <div class="col-md-4">
                                <a 
                                    href="<?php echo htmlspecialchars($product['link']); ?>" 
                                    target="_blank" 
                                    rel="noopener noreferrer"
                                    class="btn btn-outline-<?php echo $product['color']; ?> w-100 h-100 d-flex flex-column align-items-center justify-content-center p-3 product-link-card"
                                    style="min-height: 120px; text-decoration: none; transition: all 0.3s ease;"
                                >
                                    <i class="bi <?php echo $product['icon']; ?> display-6 mb-2 text-<?php echo $product['color']; ?>"></i>
                                    <span class="fw-bold text-dark text-center" style="font-size: 0.9rem;">
                                        <?php echo htmlspecialchars($product['title']); ?>
                                    </span>
                                    <small class="text-muted mt-2">
                                        <i class="bi bi-box-arrow-up-right"></i>
                                        Trendyol'da İncele
                                    </small>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- YORUMLAR BÖLÜMÜ -->
        <div class="mt-5 mb-4">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-gradient-primary text-white">
                    <h4 class="mb-0 fw-bold">
                        <i class="bi bi-chat-dots me-2"></i>
                        Yorumlar
                        <span class="badge bg-light text-dark ms-2"><?php echo count($yorumlar); ?></span>
                    </h4>
                </div>
                <div class="card-body p-4">
                    
                    <!-- Başarı/Hata Mesajları -->
                    <?php if (isset($_SESSION['yorum_basarili'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>
                            <?php echo htmlspecialchars($_SESSION['yorum_basarili']); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION['yorum_basarili']); ?>
                    <?php endif; ?>
                    
                    <?php if (isset($_SESSION['yorum_hata'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <?php echo htmlspecialchars($_SESSION['yorum_hata']); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION['yorum_hata']); ?>
                    <?php endif; ?>
                    
                    <!-- Yorum Ekleme Formu (Sadece giriş yapan kullanıcılar için) -->
                    <?php if ($kullanici_giris_yapti): ?>
                    <div class="mb-4 p-3 bg-light rounded">
                        <h5 class="mb-3">
                            <i class="bi bi-pencil-square me-2 text-primary"></i>
                            Yorum Yap
                        </h5>
                        <form action="pages/yorum_ekle.php" method="POST" id="yorumForm">
                            <input type="hidden" name="yazi_id" value="<?php echo $yazi_id; ?>">
                            <div class="mb-3">
                                <textarea 
                                    class="form-control" 
                                    name="yorum_metni" 
                                    id="yorum_metni" 
                                    rows="4" 
                                    placeholder="Yorumunuzu buraya yazın..." 
                                    required
                                    minlength="10"
                                    maxlength="1000"
                                ></textarea>
                                <div class="invalid-feedback">
                                    Lütfen en az 10 karakter yazın.
                                </div>
                                <small class="text-muted">
                                    <span id="karakter_sayisi">0</span> / 1000 karakter
                                </small>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send me-2"></i>
                                Yorumu Gönder
                            </button>
                        </form>
                    </div>
                    <?php else: ?>
                    <div class="alert alert-info mb-4">
                        <i class="bi bi-info-circle me-2"></i>
                        Yorum yapmak için lütfen <a href="index.php?sayfa=giris" class="alert-link">giriş yapın</a> veya <a href="index.php?sayfa=kayit" class="alert-link">kayıt olun</a>.
                    </div>
                    <?php endif; ?>

                    <hr class="my-4">

                    <!-- Yorumlar Listesi -->
                    <div class="yorumlar-listesi">
                        <?php if (count($yorumlar) > 0): ?>
                            <?php foreach ($yorumlar as $yorum): ?>
                                <div class="yorum-item mb-4 p-3 bg-white rounded shadow-sm border-start border-primary border-3">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <strong class="text-primary">
                                                <i class="bi bi-person-circle me-2"></i>
                                                <?php echo htmlspecialchars($yorum['kullanici_adi']); ?>
                                            </strong>
                                            <small class="text-muted ms-2">
                                                <i class="bi bi-clock me-1"></i>
                                                <?php 
                                                $tarih = new DateTime($yorum['yorum_tarihi']);
                                                $simdi = new DateTime();
                                                $fark = $simdi->diff($tarih);
                                                
                                                if ($fark->days > 7) {
                                                    echo date("d.m.Y H:i", strtotime($yorum['yorum_tarihi']));
                                                } elseif ($fark->days > 0) {
                                                    echo $fark->days . " gün önce";
                                                } elseif ($fark->h > 0) {
                                                    echo $fark->h . " saat önce";
                                                } elseif ($fark->i > 0) {
                                                    echo $fark->i . " dakika önce";
                                                } else {
                                                    echo "Az önce";
                                                }
                                                ?>
                                            </small>
                                        </div>
                                    </div>
                                    <p class="mb-0 text-dark" style="line-height: 1.6;">
                                        <?php echo nl2br(htmlspecialchars($yorum['yorum_metni'])); ?>
                                    </p>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center py-4 text-muted">
                                <i class="bi bi-chat-left-text display-4 d-block mb-2"></i>
                                <p class="mb-0">Henüz yorum yapılmamış. İlk yorumu siz yapın!</p>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>

        <!-- Geri Dön Butonu -->
        <div class="mt-5 mb-5 text-center">
            <a href="index.php?sayfa=home" class="btn btn-outline-secondary px-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>
                Ana Sayfaya Dön
            </a>
        </div>

    </div>
</div>

<!-- Yorum Formu JavaScript Validasyonu -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('yorumForm');
    const textarea = document.getElementById('yorum_metni');
    const karakterSayisi = document.getElementById('karakter_sayisi');
    
    if (textarea && karakterSayisi) {
        // Karakter sayısını güncelle
        textarea.addEventListener('input', function() {
            karakterSayisi.textContent = this.value.length;
        });
        
        // Form validasyonu
        if (form) {
            form.addEventListener('submit', function(e) {
                if (!form.checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();
                }
                form.classList.add('was-validated');
            });
        }
    }
});
</script>