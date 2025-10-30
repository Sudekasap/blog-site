<?php
// Bu dosyanın başında $db bağlantısının index.php tarafından zaten sağlandığını varsayıyoruz.

// 1. Yazıları veritabanından çekme sorgusu
// Sadece 'Yayinlandi' durumundaki yazıları, en yeniden en eskiye doğru çekiyoruz.
// Yazar ismini de çekmek için 'kullanicilar' tablosuyla JOIN yapıyoruz.
$sql = "SELECT y.id, y.baslik, y.ozet, y.resim_yolu, y.yayin_tarihi, k.username AS yazar_adi 
        FROM yazilar y
        INNER JOIN kullanicilar k ON y.yazar_id = k.id
        WHERE y.durum = 'Yayinlandi'
        ORDER BY y.yayin_tarihi DESC";

// Sorguyu hazırlama ve çalıştırma
try {
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $yazilar = $stmt->fetchAll(PDO::FETCH_ASSOC); // Tüm sonuçları çek
} catch (PDOException $e) {
    // Hata durumunda kullanıcıya gösterilecek mesaj
    echo "<div class='alert alert-danger'>Yazılar yüklenirken bir hata oluştu: " . $e->getMessage() . "</div>";
    $yazilar = []; // Hata durumunda boş dizi ata
}
?>

<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-success text-center" role="alert">
            <h3>HOŞ GELDİNİZZ ! NEŞE VE MUTLULUKLA DOLU BİR GÜN GEÇİRİN ...</h3>
            <p></p>
        </div>
    </div>
</div>

<div class="row mt-4">

    <?php 
    // Eğer veritabanından yazı çekilebildiyse, her bir yazı için döngü başlat
    if (!empty($yazilar)): 
        foreach ($yazilar as $yazi): 
    ?>
    
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                
                <img src="<?php echo htmlspecialchars($yazi['resim_yolu']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($yazi['baslik']); ?>">
                
                <div class="card-body">
                    
                    <h5 class="card-title"><?php echo htmlspecialchars($yazi['baslik']); ?></h5>
                    
                    <p class="card-text text-muted">
                        <?php echo htmlspecialchars($yazi['ozet']); ?> 
                        <br>
                        (Yazar: <?php echo htmlspecialchars($yazi['yazar_adi']); ?> | 
                        Tarih: <?php echo date("d.m.Y", strtotime($yazi['yayin_tarihi'])); ?>)
                    </p>
                    
                    <a href="index.php?sayfa=detay&id=<?php echo htmlspecialchars($yazi['id']); ?>" class="btn btn-primary btn-sm">Devamını Oku</a>
                </div>
            </div>
        </div>
        
    <?php 
        endforeach; 
    else: 
    ?>
    
        <div class="col-lg-12">
            <div class="alert alert-warning text-center">
                Henüz yayınlanmış bir blog yazısı bulunmamaktadır.
            </div>
        </div>
        
    <?php endif; ?>

</div>