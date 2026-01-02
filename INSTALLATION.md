# Deprem RSS - Kurulum ve Kullanım Kılavuzu

## Kurulum

### Otomatik Kurulum (WordPress.org üzerinden)

1. WordPress yönetim paneline giriş yapın
2. **Eklentiler > Yeni Ekle** menüsüne gidin
3. Arama kutusuna "Deprem RSS" yazın
4. **Şimdi Kur** butonuna tıklayın
5. Kurulum tamamlandığında **Etkinleştir** butonuna tıklayın

### Manuel Kurulum

1. Bu repoyu indirin veya klonlayın
2. `depremrss` klasörünü WordPress kurulumunuzun `wp-content/plugins/` dizinine kopyalayın
3. WordPress yönetim paneline gidin
4. **Eklentiler** menüsünden "Deprem RSS" eklentisini bulun
5. **Etkinleştir** butonuna tıklayın

## İlk Yapılandırma

1. Eklentiyi aktif ettikten sonra sol menüde **Deprem RSS** menüsü görünecektir
2. Bu menüye tıklayarak ayarlar sayfasına gidin
3. Aşağıdaki ayarları yapılandırın:

### Temel Ayarlar

#### Deprem Veri Kaynağı URL
- **Varsayılan:** `http://www.koeri.boun.edu.tr/scripts/lst0.asp`
- **Açıklama:** Deprem verilerinin alınacağı kaynak URL
- **Not:** KOERI (Kandilli Rasathanesi) varsayılan kaynaktır

#### Önbellek Süresi
- **Varsayılan:** 300 saniye (5 dakika)
- **Açıklama:** Deprem verilerinin önbellekte tutulma süresi
- **Önerilen:** 300-600 saniye arası
- **Not:** Çok kısa süreler sunucunuzu yavaşlatabilir

#### Gösterilecek Deprem Sayısı
- **Varsayılan:** 10
- **Aralık:** 1-100
- **Açıklama:** RSS feed ve shortcode'da gösterilecek maksimum deprem sayısı

#### Minimum Büyüklük
- **Varsayılan:** 0.0
- **Aralık:** 0.0-10.0
- **Açıklama:** Gösterilecek minimum deprem büyüklüğü (Richter ölçeği)
- **Örnek:** 4.0 olarak ayarlarsanız sadece 4.0 ve üzeri depremler gösterilir

## Kullanım

### 1. RSS Feed

RSS feed otomatik olarak oluşturulur ve şu adresten erişilebilir:

```
https://siteniz.com/feed/deprem
```

#### RSS Feed Nasıl Kullanılır?

- **RSS Okuyucular:** Feedly, Inoreader gibi RSS okuyuculara ekleyin
- **Diğer Siteler:** RSS feed URL'sini paylaşarak diğer sitelerin kullanmasını sağlayın
- **Entegrasyonlar:** IFTTT, Zapier gibi servislerle entegre edin

### 2. Shortcode Kullanımı

#### Basit Kullanım

Herhangi bir sayfa veya yazıda:

```
[depremrss]
```

Bu kod:
- Ayarlarda belirlenen sayıda depremi gösterir
- Tablo formatında görüntüler
- Renk kodlaması ile büyüklüğe göre gösterir

#### Parametreli Kullanım

```
[depremrss limit="5" min_magnitude="4.0"]
```

**Parametreler:**

- `limit`: Kaç deprem gösterileceği
  - Örnek: `limit="5"` → 5 deprem gösterir
  
- `min_magnitude`: Minimum büyüklük filtresi
  - Örnek: `min_magnitude="4.0"` → 4.0 ve üzeri depremleri gösterir

#### Örnek Kullanımlar

```
[depremrss limit="20"]
→ Son 20 depremi gösterir

[depremrss min_magnitude="5.0"]
→ 5.0 ve üzeri depremleri gösterir

[depremrss limit="10" min_magnitude="3.5"]
→ 3.5 ve üzeri, maksimum 10 deprem gösterir
```

### 3. Widget Kullanımı

#### Widget Ekleme

1. **Görünüm > Widget'lar** menüsüne gidin
2. Sol tarafta **Deprem RSS Widget**'ını bulun
3. Eklemek istediğiniz alana sürükleyin (yan panel, footer vb.)
4. Widget ayarlarını yapın:

**Ayarlar:**
- **Başlık:** Widget başlığı (örn: "Son Depremler")
- **Gösterilecek Sayı:** 1-20 arası (örn: 5)
- **Minimum Büyüklük:** 0.0-10.0 arası (örn: 3.0)

5. **Kaydet** butonuna tıklayın

#### Widget Görünümü

Widget şunları gösterir:
- Deprem büyüklüğü (renkli kutu içinde)
- Deprem lokasyonu
- Tarih ve saat
- Derinlik bilgisi

## Özelleştirme

### CSS ile Özelleştirme

Temanızın `style.css` dosyasına veya Görünüm > Özelleştir > Ek CSS bölümüne ekleyebilirsiniz:

```css
/* Tablo renklerini değiştir */
.depremrss-table thead {
    background: #YOUR_COLOR;
}

/* Büyüklük renk kodlamasını değiştir */
.depremrss-magnitude-4 .depremrss-magnitude {
    color: #YOUR_COLOR;
}

/* Widget stilini değiştir */
.depremrss-widget-magnitude {
    background: #YOUR_COLOR;
}
```

### PHP ile Özelleştirme

Temanızın `functions.php` dosyasına:

```php
// Önbellek süresini değiştir
add_filter('depremrss_cache_duration', function($duration) {
    return 600; // 10 dakika
});

// Deprem verilerini filtrele
add_filter('depremrss_earthquakes', function($earthquakes) {
    // Sadece belirli bölgeleri göster
    return array_filter($earthquakes, function($eq) {
        return strpos($eq['location'], 'İZMİR') !== false;
    });
});
```

## Sorun Giderme

### RSS Feed Çalışmıyor

1. **Permalinks'i Yenile:**
   - Ayarlar > Kalıcı Bağlantılar'a git
   - "Değişiklikleri Kaydet" butonuna tıkla

2. **Önbelleği Temizle:**
   - Deprem RSS ayarlar sayfasından ayarları kaydet
   - Bu önbelleği otomatik temizler

### Depremler Görünmüyor

1. **Minimum Büyüklük Ayarını Kontrol Edin:**
   - Çok yüksek bir değer ayarladıysanız düşürün

2. **Önbelleği Temizleyin:**
   - Ayarlar sayfasından herhangi bir ayarı kaydedin

3. **Veri Kaynağını Kontrol Edin:**
   - URL'nin doğru olduğundan emin olun

### Stil Sorunları

1. **Tarayıcı Önbelleğini Temizle:**
   - Ctrl+F5 veya Cmd+Shift+R

2. **CSS Çakışmasını Kontrol Et:**
   - Tarayıcı geliştirici araçlarını kullan (F12)

## Performans İpuçları

1. **Önbellek Süresini Optimize Edin:**
   - Çok kısa süreler (< 300 sn) sunucuyu yavaşlatabilir
   - Önerilen: 300-600 saniye

2. **Görüntüleme Limitini Ayarlayın:**
   - Çok fazla deprem göstermek sayfayı yavaşlatabilir
   - Önerilen: 10-20 arası

3. **Caching Plugin Kullanın:**
   - WP Super Cache veya W3 Total Cache
   - Sayfaları önbelleğe alır, performansı artırır

## Güvenlik

- Tüm girişler sanitize edilir
- XSS koruması vardır
- SQL injection koruması vardır
- WordPress nonce kullanır
- Sadece admin kullanıcılar ayarlara erişebilir

## Destek

Sorularınız veya sorunlarınız için:

- **GitHub Issues:** https://github.com/integrumart/depremrss/issues
- **Dokümantasyon:** README.md dosyasını okuyun

## Güncellemeler

Eklenti güncellemelerini kaçırmamak için:

1. WordPress yönetim panelinde bildirimler enabled olsun
2. GitHub reposunu takip edin (Watch/Star)

## Lisans

GPL-3.0 License - Detaylar için LICENSE dosyasına bakın.
