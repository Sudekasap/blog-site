-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 18 Ara 2025, 09:28:48
-- Sunucu sürümü: 8.0.44
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `blog_sitesi`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_turkish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `rol` enum('Admin','Editor','User') COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'User',
  `kayit_tarihi` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `username`, `email`, `password`, `rol`, `kayit_tarihi`) VALUES
(1, 'adminuser', 'admin@isigin.com', '$2y$10$Q7YyF2hJ7lQh8l2F7Yx3g.u8bJj9xG7K1hG2B5e6A9V0X0Y8Z6C4A', 'Admin', '2025-12-18 08:26:11'),
(2, 'editoruser', 'editor@isigin.com', '$2y$10$Q7YyF2hJ7lQh8l2F7Yx3g.u8bJj9xG7K1hG2B5e6A9V0X0Y8Z6C4A', 'Editor', '2025-12-18 08:26:11');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yazilar`
--

CREATE TABLE `yazilar` (
  `id` int NOT NULL,
  `baslik` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `ozet` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `icerik` longtext COLLATE utf8mb4_turkish_ci NOT NULL,
  `resim_yolu` varchar(255) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `yazar_id` int NOT NULL,
  `yayin_tarihi` datetime DEFAULT CURRENT_TIMESTAMP,
  `durum` enum('Yayinlandi','Taslak') COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'Taslak'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `yazilar`
--

INSERT INTO `yazilar` (`id`, `baslik`, `ozet`, `icerik`, `resim_yolu`, `yazar_id`, `yayin_tarihi`, `durum`) VALUES
(1, 'Doğal Bakım Yöntemleri', 'Doğal bakım yöntemleri ile cildinizi ve saçınızı doğal yollarla güzelleştirin. Evde kolayca uygulayabileceğiniz doğal maskeler ve bakım teknikleri hakkında bilgiler.', '<h2>Doğal Bakım Yöntemleri</h2><p>Doğal bakım yöntemleri, cildinizi ve saçınızı kimyasal ürünler olmadan güzelleştirmenin en sağlıklı yoludur. Evde bulunan doğal malzemelerle hazırlayabileceğiniz maskeler ve bakım ürünleri hem ekonomik hem de etkilidir.</p><h3>Doğal Cilt Bakımı</h3><p>Bal, yoğurt, yumurta ve avokado gibi doğal malzemeler cilt bakımında mucizevi etkilere sahiptir. Bu malzemeleri kullanarak evde kolayca hazırlayabileceğiniz maskeler ile cildinizi besleyebilir ve gençleştirebilirsiniz.</p>', 'https://images.unsplash.com/photo-1556228578-0d85b1a4d571?w=800&h=600&fit=crop', 1, '2025-12-18 11:26:12', 'Yayinlandi'),
(2, 'Bitkisel Yağların Kullanımı', 'Bitkisel yağların cilt ve saç bakımındaki etkilerini keşfedin. Hangi yağın hangi cilt tipine uygun olduğunu öğrenin.', '<h2>Bitkisel Yağların Kullanımı</h2><p>Argan yağı, jojoba yağı, hindistan cevizi yağı ve badem yağı gibi bitkisel yağlar cilt ve saç bakımında oldukça etkilidir. Her yağın kendine özgü faydaları vardır.</p><h3>En Popüler Bitkisel Yağlar</h3><ul><li>Argan Yağı: Kuru ciltler için idealdir</li><li>Jojoba Yağı: Yağlı ciltler için uygundur</li><li>Hindistan Cevizi Yağı: Nemlendirici özelliği yüksektir</li><li>Badem Yağı: Hassas ciltler için güvenlidir</li></ul>', 'https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?w=800&h=600&fit=crop', 1, '2025-12-17 11:26:12', 'Yayinlandi'),
(3, 'Evde Peeling Tarifleri', 'Evde kolayca hazırlayabileceğiniz peeling tarifleri ile ölü derilerden kurtulun ve pürüzsüz bir cilde kavuşun.', '<h2>Evde Peeling Tarifleri</h2><p>Pahalı peeling ürünleri yerine evde doğal malzemelerle hazırlayabileceğiniz peeling tarifleri hem ekonomik hem de etkilidir. Şeker, kahve, yulaf ve bal gibi malzemeler peeling için mükemmeldir.</p><h3>Kolay Peeling Tarifleri</h3><p>Kahve peelingi, şeker peelingi ve yulaf peelingi en popüler ev yapımı peeling çeşitleridir. Bu peelingleri haftada 1-2 kez uygulayarak cildinizi ölü derilerden arındırabilirsiniz.</p>', 'https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?w=800&h=600&fit=crop', 1, '2025-12-16 11:26:12', 'Yayinlandi'),
(4, 'Öz Bakım (Self-Care) Rehberi', 'Kendinize zaman ayırmanın ve öz bakım yapmanın önemini keşfedin. Ruh sağlığınızı ve fiziksel sağlığınızı korumak için öz bakım rutinleri.', '<h2>Öz Bakım (Self-Care) Rehberi</h2><p>Öz bakım, hem fiziksel hem de ruhsal sağlığımız için çok önemlidir. Kendimize zaman ayırmak, hobilerimizle ilgilenmek ve bedenimize iyi bakmak genel sağlığımızı olumlu etkiler.</p><h3>Öz Bakım Rutinleri</h3><p>Günlük öz bakım rutininize meditasyon, yoga, kitap okuma, banyo yapma ve cilt bakımı gibi aktiviteler ekleyebilirsiniz. Bu aktiviteler stresi azaltır ve yaşam kalitesini artırır.</p>', 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=800&h=600&fit=crop', 1, '2025-12-15 11:26:12', 'Yayinlandi'),
(5, 'Stresin Cilde Etkisi', 'Stresin cildinize olan olumsuz etkilerini öğrenin ve stres yönetimi teknikleri ile hem ruh sağlığınızı hem de cilt sağlığınızı koruyun.', '<h2>Stresin Cilde Etkisi</h2><p>Stres, cildimizde sivilce, kırışıklık, kuruluk ve erken yaşlanma gibi birçok olumsuz etkiye neden olabilir. Stres yönetimi teknikleri ile bu etkileri azaltabilirsiniz.</p><h3>Stres Yönetimi İpuçları</h3><p>Düzenli egzersiz, yeterli uyku, meditasyon ve nefes egzersizleri stresi azaltmada etkilidir. Ayrıca dengeli beslenme ve yeterli su tüketimi de stresin cilde olan etkilerini minimize eder.</p>', 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=800&h=600&fit=crop', 1, '2025-12-14 11:26:12', 'Yayinlandi'),
(6, 'Kendine Zaman Ayırma Sanatı', 'Yoğun hayat temposunda kendinize zaman ayırmanın yollarını keşfedin. Kişisel gelişim ve mutluluk için kendinize zaman ayırmanın önemi.', '<h2>Kendine Zaman Ayırma Sanatı</h2><p>Modern hayatın yoğun temposunda kendimize zaman ayırmak bazen zor olabilir. Ancak kişisel mutluluğumuz ve sağlığımız için kendimize zaman ayırmak çok önemlidir.</p><h3>Kendinize Zaman Ayırma Yolları</h3><p>Hobilerinizle ilgilenmek, kitap okumak, yürüyüş yapmak, müzik dinlemek veya sadece sessiz bir ortamda dinlenmek kendinize zaman ayırmanın harika yollarıdır.</p>', 'https://images.unsplash.com/photo-1515378791036-0648a814c963?w=800&h=600&fit=crop', 1, '2025-12-13 11:26:12', 'Yayinlandi'),
(7, 'Bakım Ürünleri İncelemeleri', 'Popüler cilt ve saç bakım ürünlerinin detaylı incelemeleri. Hangi ürünün hangi cilt tipine uygun olduğunu öğrenin.', '<h2>Bakım Ürünleri İncelemeleri</h2><p>Piyasada birçok bakım ürünü bulunmaktadır. Bu ürünlerin hangilerinin gerçekten etkili olduğunu ve hangi cilt tipine uygun olduğunu bilmek önemlidir.</p><h3>Ürün Seçimi İpuçları</h3><p>Cilt tipinize uygun ürünleri seçmek, ürün içeriklerini okumak ve deneme boyutlarını kullanmak doğru ürünü bulmanızda size yardımcı olacaktır.</p>', 'https://images.unsplash.com/photo-1556228578-0d85b1a4d571?w=800&h=600&fit=crop', 1, '2025-12-12 11:26:12', 'Yayinlandi'),
(8, 'Uygun Fiyatlı Bakım Ürünleri', 'Bütçenize uygun, etkili bakım ürünlerini keşfedin. Pahalı olmayan ama kaliteli ürünler hakkında bilgiler.', '<h2>Uygun Fiyatlı Bakım Ürünleri</h2><p>Etkili bakım ürünleri her zaman pahalı olmak zorunda değildir. Piyasada uygun fiyatlı ama kaliteli birçok ürün bulunmaktadır.</p><h3>Bütçe Dostu Ürünler</h3><p>Eczane markaları, doğal ürünler ve ev yapımı bakım ürünleri bütçenize uygun alternatifler sunar. Önemli olan ürünün içeriğini ve cilt tipinize uygunluğunu kontrol etmektir.</p>', 'https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?w=800&h=600&fit=crop', 1, '2025-12-11 11:26:12', 'Yayinlandi'),
(9, 'Cilt Tipini Tanıma Rehberi', 'Cilt tipinizi doğru şekilde tanımanın yollarını öğrenin. Kuru, yağlı, karma ve hassas cilt tipleri hakkında detaylı bilgiler.', '<h2>Cilt Tipini Tanıma Rehberi</h2><p>Cilt tipinizi bilmek, doğru bakım ürünlerini seçmenizde çok önemlidir. Kuru, yağlı, karma ve hassas cilt tiplerinin özelliklerini öğrenerek cildinize uygun bakım rutini oluşturabilirsiniz.</p><h3>Cilt Tipleri</h3><ul><li>Kuru Cilt: Pullanma ve gerginlik hissi</li><li>Yağlı Cilt: Parlaklık ve geniş gözenekler</li><li>Karma Cilt: T bölgesinde yağlılık</li><li>Hassas Cilt: Kızarıklık ve tahriş</li></ul>', 'https://images.unsplash.com/photo-1612817288484-6f916006741a?w=800&h=600&fit=crop', 1, '2025-12-10 11:26:12', 'Yayinlandi'),
(10, 'Günlük Cilt Bakım Rutini', 'Sabah ve akşam uygulayabileceğiniz etkili günlük cilt bakım rutini. Adım adım cilt bakımı rehberi.', '<h2>Günlük Cilt Bakım Rutini</h2><p>Düzenli bir cilt bakım rutini, sağlıklı ve parlak bir cilt için çok önemlidir. Sabah ve akşam uygulayacağınız basit adımlarla cildinizi koruyabilir ve gençleştirebilirsiniz.</p><h3>Sabah Rutini</h3><p>Temizleme, tonik, serum, nemlendirici ve güneş koruyucu sabah rutininin temel adımlarıdır.</p><h3>Akşam Rutini</h3><p>Makyaj temizleme, temizleme, tonik, serum, göz kremi ve nemlendirici akşam rutininin olmazsa olmazlarıdır.</p>', 'https://images.unsplash.com/photo-1556228578-0d85b1a4d571?w=800&h=600&fit=crop', 1, '2025-12-09 11:26:12', 'Yayinlandi'),
(11, 'Cilt Bakımında Yapılan Hatalar', 'Cilt bakımında sıkça yapılan hataları öğrenin ve bu hatalardan kaçınarak daha sağlıklı bir cilde kavuşun.', '<h2>Cilt Bakımında Yapılan Hatalar</h2><p>Birçok kişi cilt bakımında yanlış uygulamalar yaparak cildine zarar verebiliyor. Bu hatalardan kaçınmak için doğru bilgilere sahip olmak önemlidir.</p><h3>Yaygın Hatalar</h3><ul><li>Çok fazla ürün kullanmak</li><li>Güneş koruyucu kullanmamak</li><li>Makyajı temizlemeden uyumak</li><li>Cilt tipine uygun olmayan ürünler kullanmak</li><li>Peeling yapmayı abartmak</li></ul>', 'https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?w=800&h=600&fit=crop', 1, '2025-12-08 11:26:12', 'Yayinlandi'),
(12, 'Sivilce Oluşumunun Nedenleri', 'Sivilce oluşumunun temel nedenlerini öğrenin ve sivilce sorununu önlemek için yapabileceklerinizi keşfedin.', '<h2>Sivilce Oluşumunun Nedenleri</h2><p>Sivilce, birçok faktörün bir araya gelmesiyle oluşur. Hormonlar, beslenme, stres ve yanlış bakım ürünleri sivilce oluşumuna neden olabilir.</p><h3>Sivilce Nedenleri</h3><ul><li>Hormonal değişiklikler</li><li>Yanlış beslenme alışkanlıkları</li><li>Stres</li><li>Yanlış cilt bakım ürünleri</li><li>Makyaj malzemeleri</li><li>Genetik faktörler</li></ul>', 'https://images.unsplash.com/photo-1612817288484-6f916006741a?w=800&h=600&fit=crop', 1, '2025-12-07 11:26:12', 'Yayinlandi'),
(13, 'Gözenek Bakımı Rehberi', 'Geniş gözeneklerin nedenlerini ve gözenek bakımı için etkili yöntemleri öğrenin. Sıkı ve temiz gözenekler için ipuçları.', '<h2>Gözenek Bakımı Rehberi</h2><p>Gözenekler, cildimizin nefes almasını sağlayan küçük açıklıklardır. Gözenek bakımı, sağlıklı bir cilt için çok önemlidir.</p><h3>Gözenek Bakımı İpuçları</h3><p>Düzenli temizleme, peeling, tonik kullanımı ve nemlendirme gözenek bakımının temel adımlarıdır. Ayrıca güneş koruyucu kullanmak da gözeneklerin genişlemesini önler.</p>', 'https://images.unsplash.com/photo-1556228578-0d85b1a4d571?w=800&h=600&fit=crop', 1, '2025-12-06 11:26:12', 'Yayinlandi'),
(14, 'Ciltte Siyah Nokta Problemi', 'Siyah noktaların nedenlerini ve evde uygulayabileceğiniz doğal çözümleri öğrenin. Temiz ve pürüzsüz bir cilt için rehber.', '<h2>Ciltte Siyah Nokta Problemi</h2><p>Siyah noktalar, gözeneklerin tıkanması sonucu oluşur. Doğru bakım ve temizleme ile siyah noktalardan kurtulabilirsiniz.</p><h3>Siyah Nokta Çözümleri</h3><p>Düzenli temizleme, buhar banyosu, kil maskesi ve doğal peeling yöntemleri siyah noktaları temizlemede etkilidir. Ancak siyah noktaları sıkmamak önemlidir.</p>', 'https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?w=800&h=600&fit=crop', 1, '2025-12-05 11:26:12', 'Yayinlandi'),
(15, 'Saç Tipini Belirleme', 'Saç tipinizi doğru şekilde belirleyin. Kuru, yağlı, karma ve normal saç tipleri hakkında bilgiler ve bakım önerileri.', '<h2>Saç Tipini Belirleme</h2><p>Saç tipinizi bilmek, doğru şampuan ve bakım ürünlerini seçmenizde çok önemlidir. Saç tipinize göre bakım rutini oluşturabilirsiniz.</p><h3>Saç Tipleri</h3><ul><li>Kuru Saç: Mat ve kırılgan</li><li>Yağlı Saç: Hızlı yağlanan</li><li>Karma Saç: Uçları kuru, kökleri yağlı</li><li>Normal Saç: Denge durumunda</li></ul>', 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=800&h=600&fit=crop', 1, '2025-12-04 11:26:12', 'Yayinlandi'),
(16, 'Saç Dökülmesi Nedenleri', 'Saç dökülmesinin nedenlerini öğrenin ve saç dökülmesini önlemek için yapabileceklerinizi keşfedin.', '<h2>Saç Dökülmesi Nedenleri</h2><p>Saç dökülmesi birçok nedene bağlı olabilir. Stres, beslenme, hormonal değişiklikler ve yanlış bakım ürünleri saç dökülmesine neden olabilir.</p><h3>Saç Dökülmesi Çözümleri</h3><p>Dengeli beslenme, saç bakım ürünlerini doğru kullanma, stresten kaçınma ve düzenli saç bakımı saç dökülmesini önlemede etkilidir.</p>', 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=800&h=600&fit=crop', 1, '2025-12-03 11:26:12', 'Yayinlandi'),
(17, 'Saç Uzatma Yöntemleri', 'Saçlarınızı doğal yollarla uzatmanın etkili yöntemlerini öğrenin. Saç sağlığını koruyarak uzun saçlara kavuşun.', '<h2>Saç Uzatma Yöntemleri</h2><p>Saç uzatmak için sabır ve doğru bakım gereklidir. Saç sağlığını koruyarak saçlarınızı daha hızlı uzatabilirsiniz.</p><h3>Saç Uzatma İpuçları</h3><ul><li>Düzenli saç kesimi (kırık uçları temizlemek için)</li><li>Saç maskeleri kullanımı</li><li>Saçları ısıdan koruma</li><li>Dengeli beslenme</li><li>Yeterli su tüketimi</li></ul>', 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=800&h=600&fit=crop', 1, '2025-12-02 11:26:12', 'Yayinlandi'),
(18, 'Yağlı Saç Bakımı', 'Yağlı saçlar için etkili bakım yöntemleri. Saçlarınızın daha az yağlanması için ipuçları ve ürün önerileri.', '<h2>Yağlı Saç Bakımı</h2><p>Yağlı saçlar, saç derisinin fazla sebum üretmesi sonucu oluşur. Doğru bakım ve ürün seçimi ile yağlı saç problemini çözebilirsiniz.</p><h3>Yağlı Saç Bakımı İpuçları</h3><p>Uygun şampuan kullanımı, saç derisi bakımı, saçları sık yıkamama ve doğru saç stilleri yağlı saç bakımında önemlidir.</p>', 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=800&h=600&fit=crop', 1, '2025-12-01 11:26:12', 'Yayinlandi'),
(19, 'Yıpranmış Saçlar İçin Bakım', 'Yıpranmış ve hasarlı saçlar için etkili bakım yöntemleri. Saçlarınızı onarın ve sağlıklı görünümüne kavuşturun.', '<h2>Yıpranmış Saçlar İçin Bakım</h2><p>Isı, boya, perma gibi işlemler saçları yıpratabilir. Doğru bakım ürünleri ve yöntemlerle yıpranmış saçları onarabilirsiniz.</p><h3>Saç Onarımı</h3><p>Protein maskeleri, nemlendirici maskeler, ısıdan kaçınma ve düzenli bakım yıpranmış saçlar için etkilidir.</p>', 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=800&h=600&fit=crop', 1, '2025-11-30 11:26:12', 'Yayinlandi'),
(20, 'Evde Saç Maskeleri - Yıpranan Saçlara Özel Doğal Bakım', 'Deniz ve güneşten yıpranan saçlarınız için evde kolayca hazırlayabileceğiniz 10 etkili doğal bakım maskesi. Yumurta, zeytinyağı, yoğurt, bal ve daha fazlası ile saçlarınızı onarın.', '<h2>Yıpranan Saçlara Özel Doğal Bakım Maskeleri</h2><p>Yaz geldi mi hazırlıklar başlar. Sadece tatil planı mı? Plajda ne giyileceğinden tutun da saçın nasıl olacağına kadar her şeyi düşünürüz. Hal böyle olunca da tatil öncesinde tepeden tırnağa hazırlık yaparız.</p><p>Tüm yıl heyecanla beklediğimiz tatilin etkilerini saçımızda da görmek isteriz. Mesela daha kısa kestirir veya rengini birkaç ton açarız. Kuafördeki işlemlerle zarar gören saçlar, deniz ve güneşe de maruz kalınca iyice <strong>güçsüzleşir, zayıflar, matlaşır.</strong></p><h3>1. Yumurta + Zeytinyağı Maskesi</h3><p>Kuru ve cansız saçlar için yumurta ve zeytinyağı mükemmel ikili. Zeytinyağı ve yumurtayı bir kapta karıştırın. Saçınıza karışımı masaj yaparak uygulayıp bir bone, streç film veya havlu ile kapatın. 1 saat kadar bu şekilde beklettikten sonra saçlarınızı yıkayın.</p><h3>2. Yoğurt + Bal + Elma Sirkesi</h3><p>Güneş ve deniz suyu yüzünden kuruyan saçlar cansızlaşır. Yoğurt, bal ve birkaç damla elma sirkesini karıştırın. Saçlarınıza uygulayıp 30-45 dakika bekletin.</p><h3>3. Avokado + Hindistan Cevizi Yağı</h3><p>Olgun bir avokadoyu ezin, 2 yemek kaşığı hindistan cevizi yağı ekleyin. Karışımı saçlarınıza uygulayıp 1 saat bekletin.</p><h3>4. Bal + Zeytinyağı + Yumurta</h3><p>1 yumurta, 2 yemek kaşığı bal ve 1 yemek kaşığı zeytinyağını karıştırın. Saçlarınıza uygulayıp 45 dakika bekletin.</p><h3>5. Mayonez Maskesi</h3><p>Hazır mayonezi saçlarınıza uygulayıp 30 dakika bekletin. Ilık suyla yıkayın.</p><p><em>Kaynak: <a href=\"https://yemek.com/yipranan-saclara-ozel-dogal-bakim-maskeleri/\" target=\"_blank\">Yemek.com</a></em></p>', 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=800&h=600&fit=crop', 1, '2025-11-29 11:26:12', 'Yayinlandi'),
(21, 'Günlük Makyaj Önerileri', 'Günlük hayatta uygulayabileceğiniz doğal ve hafif makyaj teknikleri. Hızlı ve kolay günlük makyaj rehberi.', '<h2>Günlük Makyaj Önerileri</h2><p>Günlük makyaj, doğal ve hafif olmalıdır. Cildin nefes almasını engellemeyecek şekilde minimal makyaj yapmak önemlidir.</p><h3>Günlük Makyaj Adımları</h3><p>Nemlendirici, fondöten veya BB krem, ruj, maskara ve kaş düzenleme günlük makyajın temel adımlarıdır.</p>', 'https://images.unsplash.com/photo-1512496015851-a90fb38ba796?w=800&h=600&fit=crop', 1, '2025-11-28 11:26:12', 'Yayinlandi'),
(22, 'Doğal Makyaj Teknikleri', 'Doğal görünümlü makyaj teknikleri. Cildinizi bozmadan doğal bir güzellik için makyaj ipuçları.', '<h2>Doğal Makyaj Teknikleri</h2><p>Doğal makyaj, cildinizin kendi güzelliğini öne çıkaran minimal bir makyaj stilidir. Doğal renkler ve hafif uygulamalarla harika sonuçlar elde edebilirsiniz.</p><h3>Doğal Makyaj İpuçları</h3><p>Hafif fondöten, doğal renkler, yumuşak fırça darbeleri ve cilt tonuna uygun renkler doğal makyaj için önemlidir.</p>', 'https://images.unsplash.com/photo-1512496015851-a90fb38ba796?w=800&h=600&fit=crop', 1, '2025-11-27 11:26:12', 'Yayinlandi'),
(23, 'Makyaj Temizliğinin Önemi', 'Makyaj temizliğinin cilt sağlığındaki önemini öğrenin. Doğru makyaj temizleme yöntemleri ve ürün önerileri.', '<h2>Makyaj Temizliğinin Önemi</h2><p>Makyajı temizlemeden uyumak cilt sağlığı için çok zararlıdır. Gözeneklerin tıkanmasına, sivilce oluşumuna ve erken yaşlanmaya neden olabilir.</p><h3>Makyaj Temizleme Adımları</h3><p>İki aşamalı temizleme (yağ bazlı temizleyici + su bazlı temizleyici), tonik kullanımı ve nemlendirme makyaj temizliğinin olmazsa olmazlarıdır.</p>', 'https://images.unsplash.com/photo-1512496015851-a90fb38ba796?w=800&h=600&fit=crop', 1, '2025-11-26 11:26:12', 'Yayinlandi'),
(24, 'Cilt Tipine Göre Makyaj Ürünleri', 'Cilt tipinize uygun makyaj ürünlerini seçmenin yollarını öğrenin. Kuru, yağlı ve karma ciltler için ürün önerileri.', '<h2>Cilt Tipine Göre Makyaj Ürünleri</h2><p>Cilt tipinize uygun makyaj ürünleri seçmek, makyajın daha uzun süre kalmasını ve cildinizin sağlıklı kalmasını sağlar.</p><h3>Ürün Seçimi</h3><ul><li>Kuru Cilt: Nemlendirici fondötenler</li><li>Yağlı Cilt: Matlaştırıcı ürünler</li><li>Karma Cilt: Dengeleyici ürünler</li><li>Hassas Cilt: Hipoalerjenik ürünler</li></ul>', 'https://images.unsplash.com/photo-1512496015851-a90fb38ba796?w=800&h=600&fit=crop', 1, '2025-11-25 11:26:12', 'Yayinlandi');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorumlar`
--

CREATE TABLE `yorumlar` (
  `id` int NOT NULL,
  `yazi_id` int NOT NULL,
  `kullanici_id` int NOT NULL,
  `yorum_metni` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `yorum_tarihi` datetime DEFAULT CURRENT_TIMESTAMP,
  `durum` enum('Onaylandi','Beklemede','Reddedildi') COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'Onaylandi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Tablo için indeksler `yazilar`
--
ALTER TABLE `yazilar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `yazar_id` (`yazar_id`);

--
-- Tablo için indeksler `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_yazi_id` (`yazi_id`),
  ADD KEY `idx_kullanici_id` (`kullanici_id`),
  ADD KEY `idx_durum` (`durum`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `yazilar`
--
ALTER TABLE `yazilar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Tablo için AUTO_INCREMENT değeri `yorumlar`
--
ALTER TABLE `yorumlar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `yazilar`
--
ALTER TABLE `yazilar`
  ADD CONSTRAINT `yazilar_ibfk_1` FOREIGN KEY (`yazar_id`) REFERENCES `kullanicilar` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD CONSTRAINT `fk_yorum_kullanici` FOREIGN KEY (`kullanici_id`) REFERENCES `kullanicilar` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_yorum_yazi` FOREIGN KEY (`yazi_id`) REFERENCES `yazilar` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
