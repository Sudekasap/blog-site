<?php
/**
 * Tüm yazıların resimlerini farklı Unsplash resimleriyle güncelleme scripti
 * 
 * Kullanım: http://localhost/blog-site/update_images.php
 */

require_once 'baglanti.php';

// Her kategori için farklı resimler
$resimler = [
    // Cilt Bakımı
    'https://images.unsplash.com/photo-1612817288484-6f916006741a?w=400&h=300&fit=crop',
    'https://images.unsplash.com/photo-1556228578-0d85b1a4d571?w=400&h=300&fit=crop',
    'https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?w=400&h=300&fit=crop',
    'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=400&h=300&fit=crop',
    
    // Saç Bakımı
    'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=400&h=300&fit=crop',
    'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=400&h=250&fit=crop',
    'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=400&h=350&fit=crop',
    
    // Makyaj
    'https://images.unsplash.com/photo-1512496015851-a90fb38ba796?w=400&h=300&fit=crop',
    'https://images.unsplash.com/photo-1512496015851-a90fb38ba796?w=400&h=250&fit=crop',
    
    // Doğal Bakım
    'https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?w=400&h=300&fit=crop',
    'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=400&h=300&fit=crop',
    'https://images.unsplash.com/photo-1515378791036-0648a814c963?w=400&h=300&fit=crop',
    
    // Diğer
    'https://images.unsplash.com/photo-1556228578-0d85b1a4d571?w=400&h=300&fit=crop',
    'https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?w=400&h=300&fit=crop',
    'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=400&h=300&fit=crop',
    'https://images.unsplash.com/photo-1612817288484-6f916006741a?w=400&h=300&fit=crop',
    'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=400&h=300&fit=crop',
    'https://images.unsplash.com/photo-1512496015851-a90fb38ba796?w=400&h=300&fit=crop',
    'https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?w=400&h=300&fit=crop',
    'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=400&h=300&fit=crop',
    'https://images.unsplash.com/photo-1515378791036-0648a814c963?w=400&h=300&fit=crop',
];

echo "<h2>Resim Güncelleme Scripti</h2>";
echo "<p>Tüm yazıların resimleri farklı Unsplash resimleriyle güncelleniyor...</p>";
echo "<hr>";

try {
    // Tüm yazıları al
    $yazilar = $db->query("SELECT id, baslik FROM yazilar ORDER BY id")->fetchAll();
    
    $guncellenen = 0;
    $resim_index = 0;
    
    foreach ($yazilar as $yazi) {
        // Her yazı için farklı bir resim seç (döngüsel)
        $yeni_resim = $resimler[$resim_index % count($resimler)];
        $resim_index++;
        
        // Resmi güncelle
        $update = $db->prepare("UPDATE yazilar SET resim_yolu = :resim WHERE id = :id");
        $update->execute([
            'resim' => $yeni_resim,
            'id' => $yazi['id']
        ]);
        
        $guncellenen++;
        echo "✅ Güncellendi: <strong>{$yazi['baslik']}</strong> (ID: {$yazi['id']})<br>";
        echo "&nbsp;&nbsp;&nbsp;Yeni Resim: $yeni_resim<br><br>";
    }
    
    echo "<hr>";
    echo "<h3>Özet:</h3>";
    echo "✅ Toplam güncellenen: $guncellenen yazı<br>";
    echo "<br><a href='index.php'>Ana Sayfaya Dön</a>";
    
} catch (PDOException $e) {
    die("HATA: " . $e->getMessage());
}

