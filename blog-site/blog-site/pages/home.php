<?php
// Bu dosya blog-site/pages/home.php'dir.
// $db bağlantı nesnesinin index.php tarafından zaten sağlandığını varsayıyoruz.

// Blog yazısına göre ilgili ürün linklerini döndüren fonksiyon
function getRelatedProducts($baslik, $ozet = '') {
    $text = strtolower($baslik . ' ' . $ozet);
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

// Yazıyı basit anahtar kelime eşlemesi ile kategoriye ayır
function getPostCategory($baslik, $ozet = '') {
    $text = strtolower($baslik . ' ' . $ozet);

    $sac_keywords  = ['saç', 'sac', 'yıpranmış', 'kırık', 'dökülme', 'saç maskesi', 'şampuan'];
    $cilt_keywords = ['cilt', 'peeling', 'sivilce', 'gözenek', 'leke', 'nem', 'güneş', 'toni̇k', 'serum'];
    $makyaj_keywords = ['makyaj', 'fondöten', 'rimel', 'maskara', 'ruj', 'allık', 'palet', 'bb krem'];

    foreach ($sac_keywords as $kw) {
        if (strpos($text, $kw) !== false) {
            return 'sac';
        }
    }
    foreach ($cilt_keywords as $kw) {
        if (strpos($text, $kw) !== false) {
            return 'cilt';
        }
    }
    foreach ($makyaj_keywords as $kw) {
        if (strpos($text, $kw) !== false) {
            return 'makyaj';
        }
    }
    return 'tum'; // diğer/her şey
}

// Veritabanından istatistikleri çek
try {
    // Toplam yazı sayısı
    $total_posts = $db->query("SELECT COUNT(*) as total FROM yazilar WHERE durum = 'Yayinlandi'")->fetch()['total'];
    
    // Toplam kullanıcı sayısı
    $total_users = $db->query("SELECT COUNT(*) as total FROM kullanicilar")->fetch()['total'];
    
    // En çok yazı yazan yazarlar
    $top_authors = $db->query("
        SELECT k.username, COUNT(y.id) as yazi_sayisi 
        FROM kullanicilar k 
        LEFT JOIN yazilar y ON k.id = y.yazar_id AND y.durum = 'Yayinlandi'
        GROUP BY k.id, k.username 
        HAVING yazi_sayisi > 0
        ORDER BY yazi_sayisi DESC 
        LIMIT 5
    ")->fetchAll();
    
    // Son 7 gün içindeki yazılar
    $recent_posts_count = $db->query("
        SELECT COUNT(*) as total 
        FROM yazilar 
        WHERE durum = 'Yayinlandi' 
        AND yayin_tarihi >= DATE_SUB(NOW(), INTERVAL 7 DAY)
    ")->fetch()['total'];
    
} catch (PDOException $e) {
    $total_posts = 0;
    $total_users = 0;
    $top_authors = [];
    $recent_posts_count = 0;
}

// Yetkili kullanıcının bir yazıyı silip silemeyeceğini kontrol eden yardımcı fonksiyon
function canDeletePost($yazi) {
    if (empty($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        return false;
    }
    $currentUserId = $_SESSION['user_id'] ?? null;
    $currentRole   = $_SESSION['user_role'] ?? ($_SESSION['yetki'] ?? '');

    if (in_array($currentRole, ['Admin', 'Editor'])) {
        return true;
    }

    if ($currentUserId && isset($yazi['yazar_id']) && $yazi['yazar_id'] == $currentUserId) {
        return true;
    }
    return false;
}

// 1. Yazıları veritabanından çekme sorgusu (Doğal Bakım Yöntemleri hariç)
$sql = "SELECT y.id, y.baslik, y.ozet, y.resim_yolu, y.yayin_tarihi, y.yazar_id, k.username AS yazar_adi 
        FROM yazilar y
        INNER JOIN kullanicilar k ON y.yazar_id = k.id
        WHERE y.durum = 'Yayinlandi' 
        AND y.baslik != 'Doğal Bakım Yöntemleri'
        ORDER BY y.yayin_tarihi DESC
        LIMIT 20";

try {
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $yazilar = $stmt->fetchAll();

    // URL'den kategori filtresi geldiyse yazıları filtrele
    $aktif_kategori = isset($_GET['kategori']) ? strtolower(trim($_GET['kategori'])) : '';
    if (in_array($aktif_kategori, ['sac', 'cilt', 'makyaj'])) {
        $yazilar = array_values(array_filter($yazilar, function($yazi) use ($aktif_kategori) {
            return getPostCategory($yazi['baslik'], $yazi['ozet']) === $aktif_kategori;
        }));
    } else {
        $aktif_kategori = 'tum';
    }
} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Yazılar yüklenirken bir hata oluştu.</div>";
    $yazilar = [];
}
?>

<!-- Kompakt Hero Section -->
<div class="blog-hero-section-compact mb-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto text-center py-3">
                <h1 class="hero-title-compact fw-bold text-pink-custom mb-2">
                    <i class="bi bi-stars me-2"></i>
                    KENDİ IŞIĞIN BLOGU
                </h1>
                <p class="hero-subtitle-compact text-muted mb-2">
                    Neşe ve mutlulukla dolu bir gün geçirin... Saç, cilt ve makyaj üzerine gerçek deneyimlere dayanan yazılar seni bekliyor!
                </p>
                <div class="mb-3">
                    <?php if ($aktif_kategori === 'sac'): ?>
                        <span class="badge bg-primary px-3 py-2">
                            <i class="bi bi-wind me-1"></i> Şu an: Saç Bakımı Yazıları
                        </span>
                    <?php elseif ($aktif_kategori === 'cilt'): ?>
                        <span class="badge bg-success px-3 py-2">
                            <i class="bi bi-droplet-half me-1"></i> Şu an: Cilt Bakımı Yazıları
                        </span>
                    <?php elseif ($aktif_kategori === 'makyaj'): ?>
                        <span class="badge bg-danger px-3 py-2">
                            <i class="bi bi-brush-fill me-1"></i> Şu an: Makyaj Yazıları
                        </span>
                    <?php else: ?>
                        <span class="badge bg-secondary px-3 py-2">
                            <i class="bi bi-collection me-1"></i> Tüm Kategorilerden Son Yazılar
                        </span>
                    <?php endif; ?>
                </div>
                <div class="hero-stats-compact d-flex justify-content-center gap-3 flex-wrap">
                    <div class="stat-item-compact">
                        <i class="bi bi-journal-text"></i>
                        <span><?php echo $total_posts; ?> Yazı</span>
                    </div>
                    <div class="stat-item-compact">
                        <i class="bi bi-people"></i>
                        <span><?php echo $total_users; ?> Üye</span>
                    </div>
                    <div class="stat-item-compact">
                        <i class="bi bi-clock-history"></i>
                        <span><?php echo $recent_posts_count; ?> Yeni</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Blog Yazıları - Öne Çıkan İlk Yazı (Kompakt) -->
<?php if (!empty($yazilar)): 
    $ilk_yazi = $yazilar[0];
    $relatedProducts = getRelatedProducts($ilk_yazi['baslik'], $ilk_yazi['ozet']);
?>
<div class="row mb-4">
    <div class="col-12">
        <div class="featured-post-compact">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="featured-post-image-compact">
                        <a href="index.php?sayfa=detay&id=<?php echo htmlspecialchars($ilk_yazi['id']); ?>">
                            <img 
                                src="<?php echo !empty($ilk_yazi['resim_yolu']) ? htmlspecialchars($ilk_yazi['resim_yolu']) : 'https://images.unsplash.com/photo-1556228578-0d85b1a4d571?w=400&h=300&fit=crop'; ?>" 
                                alt="<?php echo htmlspecialchars($ilk_yazi['baslik']); ?>"
                                class="img-fluid"
                                onerror="this.src='https://images.unsplash.com/photo-1556228578-0d85b1a4d571?w=400&h=300&fit=crop'"
                            >
                        </a>
                        <div class="featured-badge-compact">
                            <i class="bi bi-star-fill me-1"></i>
                            Öne Çıkan
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="featured-post-content-compact">
                        <div class="post-meta-compact mb-2">
                            <span class="badge bg-primary me-2">
                                <i class="bi bi-calendar3 me-1"></i>
                                <?php echo date("d.m.Y", strtotime($ilk_yazi['yayin_tarihi'])); ?>
                            </span>
                            <span class="badge bg-info">
                                <i class="bi bi-person me-1"></i>
                                <?php echo htmlspecialchars($ilk_yazi['yazar_adi']); ?>
                            </span>
                        </div>
                        <h3 class="featured-post-title-compact mb-2">
                            <a href="index.php?sayfa=detay&id=<?php echo htmlspecialchars($ilk_yazi['id']); ?>" class="text-dark text-decoration-none">
                                <?php echo htmlspecialchars($ilk_yazi['baslik']); ?>
                            </a>
                        </h3>
                        <p class="featured-post-excerpt-compact text-muted mb-3">
                            <?php 
                            $ozet = htmlspecialchars($ilk_yazi['ozet']);
                            echo strlen($ozet) > 150 ? substr($ozet, 0, 150) . '...' : $ozet;
                            ?>
                        </p>
                        <a href="index.php?sayfa=detay&id=<?php echo htmlspecialchars($ilk_yazi['id']); ?>" class="btn btn-primary btn-sm">
                            <i class="bi bi-arrow-right me-1"></i>
                            Devamını Oku
                        </a>
                        <?php if (canDeletePost($ilk_yazi)): ?>
                            <a href="pages/yazi_sil.php?id=<?php echo (int)$ilk_yazi['id']; ?>" class="btn btn-outline-danger btn-sm ms-2" onclick="return confirm('Bu yazıyı silmek istediğinize emin misiniz?');">
                                <i class="bi bi-trash me-1"></i> Sil
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Diğer Blog Yazıları -->
<?php if (!empty($yazilar) && count($yazilar) > 1): ?>
<div class="row mb-3">
    <div class="col-12">
        <h3 class="section-title-compact mb-3">
            <i class="bi bi-journal-text me-2 text-primary"></i>
            Son Yazılar
        </h3>
    </div>
</div>

<div class="row g-4">
    <?php 
    // İlk yazıyı atla, diğerlerini göster
    foreach (array_slice($yazilar, 1) as $yazi): 
        $relatedProducts = getRelatedProducts($yazi['baslik'], $yazi['ozet']);
    ?>
        <div class="col-lg-4 col-md-6">
            <article class="blog-post-card-compact">
                <div class="post-image-wrapper-compact">
                    <a href="index.php?sayfa=detay&id=<?php echo htmlspecialchars($yazi['id']); ?>">
                        <img 
                            src="<?php echo !empty($yazi['resim_yolu']) ? htmlspecialchars($yazi['resim_yolu']) : 'https://images.unsplash.com/photo-1556228578-0d85b1a4d571?w=400&h=250&fit=crop'; ?>" 
                            class="post-image-compact" 
                            alt="<?php echo htmlspecialchars($yazi['baslik']); ?>"
                            onerror="this.src='https://images.unsplash.com/photo-1556228578-0d85b1a4d571?w=400&h=250&fit=crop'"
                        >
                    </a>
                    <span class="post-badge-compact">
                        <i class="bi bi-star-fill me-1"></i>
                        Yeni
                    </span>
                </div>
                
                <div class="post-content-compact">
                    <div class="post-meta-compact mb-2">
                        <span class="text-muted small">
                            <i class="bi bi-calendar3 me-1"></i>
                            <?php echo date("d.m.Y", strtotime($yazi['yayin_tarihi'])); ?>
                        </span>
                        <span class="text-muted small ms-2">
                            <i class="bi bi-person me-1"></i>
                            <?php echo htmlspecialchars($yazi['yazar_adi']); ?>
                        </span>
                    </div>
                    
                    <h5 class="post-title-compact mb-2">
                        <a href="index.php?sayfa=detay&id=<?php echo htmlspecialchars($yazi['id']); ?>" class="text-dark text-decoration-none">
                            <?php echo htmlspecialchars($yazi['baslik']); ?>
                        </a>
                    </h5>
                    
                    <p class="post-excerpt-compact text-muted mb-3">
                        <?php 
                        $ozet = htmlspecialchars($yazi['ozet']);
                        echo strlen($ozet) > 100 ? substr($ozet, 0, 100) . '...' : $ozet;
                        ?>
                    </p>
                    
                    <div class="post-footer-compact">
                        <a href="index.php?sayfa=detay&id=<?php echo htmlspecialchars($yazi['id']); ?>" class="read-more-btn-compact">
                            Devamını Oku
                            <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                        <?php if (canDeletePost($yazi)): ?>
                            <a href="pages/yazi_sil.php?id=<?php echo (int)$yazi['id']; ?>" class="btn btn-outline-danger btn-sm ms-2" onclick="return confirm('Bu yazıyı silmek istediğinize emin misiniz?');">
                                <i class="bi bi-trash me-1"></i> Sil
                            </a>
                        <?php endif; ?>
                        
                        <!-- İlgili Ürünler - Kompakt -->
                        <div class="related-products-compact mt-3 pt-3 border-top">
                            <div class="d-flex flex-wrap gap-1">
                                <?php foreach (array_slice($relatedProducts, 0, 2) as $product): ?>
                                    <a 
                                        href="<?php echo htmlspecialchars($product['link']); ?>" 
                                        target="_blank" 
                                        rel="noopener noreferrer"
                                        class="badge bg-<?php echo $product['color']; ?> text-decoration-none"
                                        title="<?php echo htmlspecialchars($product['title']); ?>"
                                    >
                                        <i class="bi <?php echo $product['icon']; ?> me-1"></i>
                                        <?php 
                                        $shortTitle = htmlspecialchars($product['title']);
                                        echo strlen($shortTitle) > 20 ? substr($shortTitle, 0, 20) . '...' : $shortTitle;
                                        ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<!-- Boş Durum -->
<?php if (empty($yazilar)): ?>
<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-info text-center py-5">
            <i class="bi bi-inbox display-4 d-block mb-3 text-muted"></i>
            <h4>Henüz yayınlanmış bir blog yazısı bulunmamaktadır.</h4>
            <p class="text-muted">Yakında harika içerikler paylaşılacak, bizi takip etmeye devam edin!</p>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Giriş Yapan Kullanıcılar İçin Blog Yazısı Ekleme Formu -->
<?php if (isset($_SESSION['giris_var']) && $_SESSION['giris_var'] == true): ?>
<div class="row mt-5 mb-4">
    <div class="col-12">
        <div class="card shadow-sm border-0 blog-post-form-card">
            <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="bi bi-pencil-square me-2"></i>
                    Yeni Blog Yazısı Ekle
                </h4>
                <a href="index.php?sayfa=yazi_ekle" class="btn btn-light btn-sm">
                    <i class="bi bi-arrows-fullscreen me-1"></i>
                    Tam Ekran
                </a>
            </div>
            <div class="card-body p-4">
                <?php 
                // Başarı mesajı kontrolü
                if (isset($_GET['yazi_eklendi']) && $_GET['yazi_eklendi'] == '1'): 
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <strong>Başarılı!</strong> Yazınız başarıyla eklendi ve yayınlandı.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                
                <?php 
                // Silme başarı mesajı
                if (isset($_GET['yazi_silindi']) && $_GET['yazi_silindi'] == '1'): 
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-trash-fill me-2"></i>
                        <strong>Silindi!</strong> Seçtiğiniz blog yazısı kaldırıldı.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php 
                // Hata mesajı kontrolü
                if (isset($_GET['yazi_ekle_hata']) && isset($_SESSION['yazi_ekle_hata'])): 
                ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <strong>Hata!</strong> <?php echo htmlspecialchars($_SESSION['yazi_ekle_hata']); unset($_SESSION['yazi_ekle_hata']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="pages/yazi_ekle_kontrol.php" id="blogForm" class="needs-validation" novalidate onsubmit="return validateForm()">
                    <div class="row g-4">
                        <div class="col-md-12">
                            <label for="baslik" class="form-label fw-bold">
                                <i class="bi bi-type-h1 me-1 text-primary"></i>
                                Başlık <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-control form-control-lg" 
                                id="baslik" 
                                name="baslik" 
                                placeholder="Örn: Evde Doğal Cilt Bakımı Maskeleri"
                                required
                                minlength="10"
                            >
                            <div class="invalid-feedback">
                                Lütfen en az 10 karakter uzunluğunda bir başlık girin.
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <label for="ozet" class="form-label fw-bold">
                                <i class="bi bi-card-text me-1 text-primary"></i>
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
                            ></textarea>
                            <small class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>
                                Ana sayfada görünecek kısa açıklama (en az 50 karakter)
                            </small>
                            <div class="invalid-feedback">
                                Lütfen en az 50 karakter uzunluğunda bir özet girin.
                            </div>
                        </div>
                        
                        <div class="col-md-8">
                            <label for="icerik" class="form-label fw-bold">
                                <i class="bi bi-file-text me-1 text-primary"></i>
                                İçerik <span class="text-danger">*</span>
                            </label>
                            <textarea 
                                class="form-control" 
                                id="icerik" 
                                name="icerik" 
                                rows="8" 
                                placeholder="Yazınızın detaylı içeriğini girin... HTML etiketleri kullanabilirsiniz: &lt;h2&gt;, &lt;p&gt;, &lt;ul&gt;, &lt;li&gt;, &lt;strong&gt; vb."
                                required
                                minlength="100"
                            ></textarea>
                            <small class="text-muted">
                                <i class="bi bi-code-slash me-1"></i>
                                HTML etiketleri kullanabilirsiniz: &lt;h2&gt;, &lt;p&gt;, &lt;ul&gt;, &lt;li&gt;, &lt;strong&gt;, &lt;em&gt; vb.
                            </small>
                            <div class="invalid-feedback">
                                Lütfen en az 100 karakter uzunluğunda bir içerik girin.
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="resim_yolu" class="form-label fw-bold">
                                <i class="bi bi-image me-1 text-primary"></i>
                                Resim URL <small class="text-muted">(Opsiyonel)</small>
                            </label>
                            <input 
                                type="url" 
                                class="form-control" 
                                id="resim_yolu" 
                                name="resim_yolu" 
                                placeholder="https://images.unsplash.com/..."
                            >
                            <div class="mt-3">
                                <label class="form-label small fw-bold">Hızlı Seçim:</label>
                                <select class="form-select form-select-sm" id="resimOrnek" onchange="if(this.value) document.getElementById('resim_yolu').value = this.value; this.value = '';">
                                    <option value="">Örnek resim seç...</option>
                                    <option value="https://images.unsplash.com/photo-1556228578-0d85b1a4d571?w=400&h=300&fit=crop">🌿 Doğal Bakım</option>
                                    <option value="https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?w=400&h=300&fit=crop">💧 Bitkisel Yağlar</option>
                                    <option value="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=400&h=300&fit=crop">💇 Saç Bakımı</option>
                                    <option value="https://images.unsplash.com/photo-1512496015851-a90fb38ba796?w=400&h=300&fit=crop">💄 Makyaj</option>
                                    <option value="https://images.unsplash.com/photo-1612817288484-6f916006741a?w=400&h=300&fit=crop">✨ Cilt Bakımı</option>
                                    <option value="https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?w=400&h=300&fit=crop">🧴 Peeling</option>
                                    <option value="https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=400&h=300&fit=crop">🧘 Öz Bakım</option>
                                    <option value="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=400&h=300&fit=crop">😌 Stres & Cilt</option>
                                </select>
                            </div>
                            <small class="text-muted d-block mt-2">
                                <i class="bi bi-info-circle me-1"></i>
                                Boş bırakırsanız varsayılan resim kullanılacaktır.
                            </small>
                        </div>
                        
                        <div class="col-12">
                            <hr class="my-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn btn-primary btn-lg px-4">
                                    <i class="bi bi-check-circle-fill me-2"></i>
                                    Yazıyı Yayınla
                                </button>
                                <button type="reset" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-counterclockwise me-2"></i>
                                    Temizle
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Form validasyonu
function validateForm() {
    var form = document.getElementById('blogForm');
    if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
        form.classList.add('was-validated');
        return false;
    }
    return true;
}

(function() {
    'use strict';
    var form = document.getElementById('blogForm');
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
<?php endif; ?>
