# Deprem RSS - Kullanım Örnekleri

Bu dosya, Deprem RSS WordPress eklentisinin çeşitli kullanım örneklerini içerir.

## Shortcode Örnekleri

### 1. Temel Kullanım
En basit haliyle shortcode kullanımı:
```
[deprem_listesi]
```
Bu, ayarlarda belirlenen varsayılan parametrelerle deprem listesini gösterir.

### 2. Belirli Sayıda Deprem Gösterme
5 adet deprem göstermek için:
```
[deprem_listesi count="5"]
```

10 adet deprem göstermek için:
```
[deprem_listesi count="10"]
```

### 3. Minimum Büyüklük Filtresi
Sadece 3.0 ve üzeri büyüklükteki depremleri göstermek için:
```
[deprem_listesi min_magnitude="3.0"]
```

Sadece 4.0 ve üzeri büyüklükteki depremleri göstermek için:
```
[deprem_listesi min_magnitude="4.0"]
```

### 4. Kombine Parametreler
5 adet, minimum 3.5 büyüklüğündeki depremleri göstermek için:
```
[deprem_listesi count="5" min_magnitude="3.5"]
```

20 adet, minimum 2.0 büyüklüğündeki depremleri göstermek için:
```
[deprem_listesi count="20" min_magnitude="2.0"]
```

## Widget Kullanımı

### Adım 1: Widget Ekleme
1. WordPress yönetim panelinde **Görünüm → Widget'lar** menüsüne gidin
2. Sol taraftaki widget listesinden **Deprem RSS Widget**'ını bulun
3. Widget'ı istediğiniz alana (örn: Sidebar, Footer) sürükleyin

### Adım 2: Widget Ayarları
Widget ayarlarında şunları yapılandırabilirsiniz:
- **Başlık**: Widget başlığı (örn: "Son Depremler")
- **Gösterilecek Sayı**: Kaç adet deprem gösterileceği (1-50 arası)
- **Minimum Büyüklük**: Minimum deprem büyüklüğü (0-10 arası)

### Örnek Widget Konfigürasyonu
```
Başlık: Son Depremler
Gösterilecek Sayı: 5
Minimum Büyüklük: 2.5
```

## Tema Dosyalarında Kullanım

### PHP Dosyalarında Shortcode Kullanımı
Tema dosyalarınızda (örn: `sidebar.php`, `footer.php`) shortcode kullanmak için:

```php
<?php echo do_shortcode('[deprem_listesi count="5"]'); ?>
```

### Belirli Bir Sayfada Gösterme
```php
<?php
if (is_page('anasayfa')) {
    echo do_shortcode('[deprem_listesi count="10" min_magnitude="3.0"]');
}
?>
```

### Sidebar'da Gösterme
```php
<?php
if (is_active_sidebar('sidebar-1')) {
    dynamic_sidebar('sidebar-1');
}
echo do_shortcode('[deprem_listesi count="5"]');
?>
```

## Gutenberg Bloklarında Kullanım

### 1. Shortcode Bloğu Ekleme
1. Yeni bir post veya sayfa oluşturun
2. **+** butonuna tıklayın
3. "Shortcode" bloğunu arayın ve ekleyin
4. Shortcode'unuzu yazın:
```
[deprem_listesi count="10" min_magnitude="3.0"]
```

### 2. HTML Bloğu ile Kullanım
1. HTML bloğu ekleyin
2. Shortcode'u HTML içine yerleştirin:
```html
<div class="earthquake-section">
    <h2>Güncel Deprem Bilgileri</h2>
    [deprem_listesi count="8" min_magnitude="2.5"]
</div>
```

## Klasik Editörde Kullanım

Klasik WordPress editöründe, shortcode'u doğrudan yazı içeriğine ekleyebilirsiniz:

```
İşte son depremler:

[deprem_listesi count="5" min_magnitude="3.0"]

Daha fazla bilgi için KOERI'yi ziyaret edin.
```

## Özel Sayfa Şablonlarında Kullanım

### Özel Template Oluşturma
`page-earthquakes.php` adında bir template oluşturun:

```php
<?php
/**
 * Template Name: Deprem Sayfası
 */

get_header(); ?>

<div class="earthquake-page">
    <h1>Türkiye Depremleri</h1>
    
    <div class="major-earthquakes">
        <h2>Büyük Depremler (5.0+)</h2>
        <?php echo do_shortcode('[deprem_listesi count="10" min_magnitude="5.0"]'); ?>
    </div>
    
    <div class="all-earthquakes">
        <h2>Tüm Depremler</h2>
        <?php echo do_shortcode('[deprem_listesi count="50" min_magnitude="0"]'); ?>
    </div>
</div>

<?php get_footer(); ?>
```

## RSS Feed URL Örnekleri

### KOERI (Kandilli Rasathanesi)
```
http://www.koeri.boun.edu.tr/scripts/lst0.asp
```

### Özel RSS Feed
Kendi RSS feed'inizi kullanmak için:
1. **Ayarlar → Deprem RSS** menüsüne gidin
2. **RSS Feed URL'si** alanına feed URL'inizi girin
3. Ayarları kaydedin

## İleri Seviye Kullanım

### Birden Fazla Deprem Listesi
Aynı sayfada farklı parametrelerle birden fazla liste gösterebilirsiniz:

```
<div class="major-earthquakes">
    <h3>Büyük Depremler</h3>
    [deprem_listesi count="5" min_magnitude="5.0"]
</div>

<div class="moderate-earthquakes">
    <h3>Orta Şiddette Depremler</h3>
    [deprem_listesi count="10" min_magnitude="3.0"]
</div>

<div class="all-earthquakes">
    <h3>Tüm Depremler</h3>
    [deprem_listesi count="20" min_magnitude="0"]
</div>
```

### Özel CSS ile Stil Verme
Kendi CSS stilinizi eklemek için:

```html
<style>
.depremrss-container {
    background: #f5f5f5;
    border-radius: 10px;
    padding: 20px;
}

.depremrss-item {
    border-left-width: 6px;
}
</style>

[deprem_listesi count="10"]
```

## Otomatik Yenileme Ayarları

Ayarlarda otomatik yenilemeyi etkinleştirmek için:
1. **Ayarlar → Deprem RSS** menüsüne gidin
2. **Otomatik Yenileme** seçeneğini işaretleyin
3. **Yenileme Aralığı** belirleyin (saniye cinsinden)
4. Ayarları kaydedin

Örnek ayarlar:
- Her 60 saniyede bir yenile (varsayılan)
- Her 30 saniyede bir yenile (sık güncelleme)
- Her 300 saniyede bir yenile (5 dakika)

## Performans Optimizasyonu

### Önbellek Ayarları
Optimal performans için önbellek süresini ayarlayın:
- Yüksek trafik: 600 saniye (10 dakika)
- Orta trafik: 300 saniye (5 dakika)
- Düşük trafik: 60 saniye (1 dakika)

### Gösterim Sayısı
Performansı artırmak için:
- Ana sayfada: 5-10 deprem
- Widget'larda: 3-5 deprem
- Özel sayfalarda: 20-50 deprem

## Sorun Giderme

### Depremler Görünmüyorsa
1. RSS feed URL'sinin doğru olduğundan emin olun
2. Önbelleği temizleyin (Yenile butonuna basın)
3. Minimum büyüklük ayarını kontrol edin
4. WordPress hata günlüklerini kontrol edin

### Stil Sorunları
CSS çakışması varsa:
1. Tarayıcı geliştirici araçlarını açın
2. CSS sınıflarını kontrol edin
3. Gerekirse özel CSS ekleyin

## Destek

Daha fazla yardım için:
- GitHub: https://github.com/integrumart/depremrss/issues
- Dokümantasyon: README.md dosyasını okuyun
