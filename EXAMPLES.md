# Deprem RSS Plugin - Ekran Görüntüleri ve Örnekler

Bu dokümanda eklentinin nasıl göründüğünü ve nasıl kullanıldığını görebilirsiniz.

## Yönetim Paneli

### Ana Ayarlar Sayfası

Eklenti aktif edildikten sonra WordPress yönetim panelinde sol menüde **Deprem RSS** seçeneği görünür.

**Ayarlar:**
- **Deprem Veri Kaynağı URL**: KOERI veya başka bir kaynak
- **Önbellek Süresi**: 300 saniye (5 dakika) önerilir
- **Gösterilecek Deprem Sayısı**: 1-100 arası
- **Minimum Büyüklük**: 0.0-10.0 arası

**Özellikler:**
- Canlı deprem listesi sidebar'da görünür
- RSS feed URL'si kopyalanabilir
- Shortcode kullanım örnekleri gösterilir
- Widget kullanım talimatları

## Ön Yüz Görünümleri

### Shortcode ile Tablo Görünümü

`[depremrss]` shortcode'u kullanıldığında:

```
+------------------+----------+----------+-----------------------------------+
| Tarih/Saat       | Büyüklük | Derinlik | Bölge                            |
+------------------+----------+----------+-----------------------------------+
| 2026.01.02       |   4.2    |  7.5 km  | İZMİR KARABURUN AÇIKLARI         |
| 06:05:32         |          |          |                                   |
+------------------+----------+----------+-----------------------------------+
| 2026.01.02       |   3.8    |  12.3 km | EGE DENİZİ                       |
| 05:05:32         |          |          |                                   |
+------------------+----------+----------+-----------------------------------+
```

**Özellikler:**
- Responsive tasarım (mobilde kart görünümüne dönüşür)
- Büyüklüğe göre renk kodlaması:
  - 0-2.9: Yeşil (Minör)
  - 3.0-3.9: Açık Yeşil
  - 4.0-4.9: Sarı (Orta)
  - 5.0-5.9: Turuncu (Güçlü)
  - 6.0-7.9: Koyu Turuncu (Büyük)
  - 8.0+: Kırmızı (Çok Büyük)

### Widget Görünümü

Sidebar veya footer'da kullanıldığında:

```
┌─────────────────────────────┐
│ Son Depremler               │
├─────────────────────────────┤
│  ┌───┐                      │
│  │4.2│ İZMİR KARABURUN      │
│  └───┘ AÇIKLARI             │
│        2026.01.02 06:05:32  │
│        Derinlik: 7.5 km     │
├─────────────────────────────┤
│  ┌───┐                      │
│  │3.8│ EGE DENİZİ           │
│  └───┘                      │
│        2026.01.02 05:05:32  │
│        Derinlik: 12.3 km    │
└─────────────────────────────┘
```

## RSS Feed Görünümü

`/feed/deprem` endpoint'inden erişilebilir RSS feed:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0">
    <channel>
        <title>Site Adı - Deprem RSS</title>
        <link>https://siteniz.com</link>
        <description>Son depremler</description>
        
        <item>
            <title>Deprem: 4.2 Büyüklüğünde - İZMİR KARABURUN AÇIKLARI</title>
            <link>https://siteniz.com</link>
            <pubDate>Wed, 02 Jan 2026 06:05:32 +0000</pubDate>
            <description>
                Büyüklük: 4.2
                Derinlik: 7.5 km
                Bölge: İZMİR KARABURUN AÇIKLARI
                Tarih: 2026.01.02
                Saat: 06:05:32
            </description>
        </item>
        
        <!-- Diğer depremler... -->
    </channel>
</rss>
```

## Kullanım Örnekleri

### Örnek 1: Basit Kullanım

```php
// Sayfa içeriğinde
[depremrss]
```

Tüm depremleri gösterir (ayarlarda belirlenen limite kadar).

### Örnek 2: Filtrelenmiş Liste

```php
// Sadece büyük depremleri göster
[depremrss min_magnitude="5.0"]
```

Sadece 5.0 ve üzeri büyüklükteki depremleri gösterir.

### Örnek 3: Sınırlı Sayıda

```php
// Sadece son 5 depremi göster
[depremrss limit="5"]
```

En son 5 depremi listeler.

### Örnek 4: Kombinasyon

```php
// Son 10 orta/büyük deprem
[depremrss limit="10" min_magnitude="4.0"]
```

4.0 ve üzeri, maksimum 10 deprem.

## Responsive Tasarım

### Masaüstü (>768px)
- Tam tablo görünümü
- Tüm sütunlar görünür
- Hover efektleri aktif

### Tablet (481px-768px)
- Küçültülmüş tablo
- Tüm bilgiler hala görünür
- Küçültülmüş padding

### Mobil (<480px)
- Kart görünümü
- Her deprem ayrı bir kart
- Daha kolay okunabilir
- Başlıklar her satırda tekrarlanır

## Özelleştirme Örnekleri

### CSS ile Renk Değiştirme

```css
/* Tablo başlığı rengini değiştir */
.depremrss-table thead {
    background: #8b0000; /* Koyu kırmızı */
}

/* 4.0+ depremler için renk */
.depremrss-magnitude-4 .depremrss-magnitude {
    color: #ff6600;
}

/* Widget büyüklük kutusunu değiştir */
.depremrss-widget-magnitude {
    background: #8b0000;
    border-radius: 8px;
}
```

### PHP ile Veri Filtreleme

```php
// functions.php'ye ekle
add_filter('depremrss_earthquakes', function($earthquakes) {
    // Sadece İzmir depremlerini göster
    return array_filter($earthquakes, function($eq) {
        return strpos($eq['location'], 'İZMİR') !== false;
    });
});
```

## Performans Notları

- **Önbellek**: Veriler 5 dakika önbelleklenir (varsayılan)
- **Optimizasyon**: Minimum büyüklük filtresi kullanın
- **Limit**: Çok fazla deprem göstermekten kaçının (önerilen: 10-20)

## Güvenlik Özellikleri

- ✅ Tüm girişler sanitize edilir
- ✅ Tüm çıktılar escape edilir
- ✅ Nonce kullanılır (CSRF koruması)
- ✅ WordPress izin kontrolü
- ✅ SQL injection koruması
- ✅ XSS koruması

## Tarayıcı Desteği

- ✅ Chrome (son 2 versiyon)
- ✅ Firefox (son 2 versiyon)
- ✅ Safari (son 2 versiyon)
- ✅ Edge (son 2 versiyon)
- ✅ Opera (son 2 versiyon)
- ✅ Mobil tarayıcılar (iOS Safari, Chrome Mobile)

## RSS Reader Desteği

RSS feed şu okuyucularla test edilmiştir:
- ✅ Feedly
- ✅ Inoreader
- ✅ NewsBlur
- ✅ The Old Reader
- ✅ Outlook
- ✅ Thunderbird

## İleriye Dönük Geliştirmeler

### Planlanan Özellikler (v1.1.0+)

1. **Harita Görünümü**: Depremleri harita üzerinde gösterme
2. **Gerçek Veri Entegrasyonu**: KOERI API entegrasyonu
3. **Bildirimler**: E-posta/push bildirimleri
4. **Detay Sayfaları**: Her deprem için ayrı sayfa
5. **İstatistikler**: Grafikler ve analizler
6. **Export**: CSV/Excel çıktı alma
7. **Gutenberg Block**: Block editor desteği
8. **REST API**: Custom endpoint'ler

## Destek ve Yardım

Sorularınız için:
- GitHub Issues: https://github.com/integrumart/depremrss/issues
- Dokümantasyon: README.md ve INSTALLATION.md

---

**Not**: Bu dokümandaki ekran görüntüleri ASCII art ile gösterilmiştir. Gerçek ekran görüntüleri eklenti yayınlandığında eklenecektir.
