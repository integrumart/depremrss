# Deprem RSS - Hızlı Başlangıç Rehberi

## 🚀 5 Dakikada Kurulum

### 1. Kurulum
```bash
# WordPress plugins dizinine kopyala
cp -r depremrss /path/to/wordpress/wp-content/plugins/

# Veya ZIP olarak yükle
# WordPress > Eklentiler > Yeni Ekle > Eklenti Yükle
```

### 2. Aktifleştir
- WordPress Admin > Eklentiler > Deprem RSS > Etkinleştir

### 3. Ayarla
- Sol menüden **Deprem RSS** > Ayarları yapılandır

### 4. Kullan
- RSS: `https://siteniz.com/feed/deprem`
- Shortcode: `[depremrss]`
- Widget: Görünüm > Widget'lar

---

## 📖 Hızlı Komutlar

### Shortcode Kullanımı

```
[depremrss]                                    # Tüm depremler
[depremrss limit="5"]                          # Son 5 deprem
[depremrss min_magnitude="4.0"]                # 4.0+ depremler
[depremrss limit="10" min_magnitude="3.5"]     # 3.5+, max 10
```

### RSS Feed

```
Ana Feed: https://siteniz.com/feed/deprem
```

### PHP Template

```php
<?php
// Depremleri al
$earthquakes = DepremRSS::get_instance()->get_earthquake_data();

// Göster
foreach ($earthquakes as $eq) {
    echo $eq['magnitude'] . ' - ' . $eq['location'];
}
?>
```

---

## ⚙️ Varsayılan Ayarlar

| Ayar | Varsayılan | Açıklama |
|------|-----------|----------|
| Önbellek Süresi | 300 saniye | Veri yenileme süresi |
| Deprem Sayısı | 10 | Gösterilecek sayı |
| Min Büyüklük | 0.0 | Minimum büyüklük filtresi |
| Veri Kaynağı | KOERI | Deprem veri kaynağı |

---

## 🎨 CSS Sınıfları

```css
.depremrss-earthquakes        /* Ana konteyner */
.depremrss-table              /* Tablo */
.depremrss-magnitude          /* Büyüklük */
.depremrss-magnitude-4        /* 4.0-4.9 depremler */
.depremrss-widget             /* Widget */
.depremrss-widget-magnitude   /* Widget büyüklük */
```

---

## 🔧 Sorun Giderme

### RSS feed çalışmıyor?
```
Çözüm: Ayarlar > Kalıcı Bağlantılar > Kaydet
```

### Depremler görünmüyor?
```
1. Minimum büyüklük ayarını kontrol et
2. Önbelleği temizle (ayarları kaydet)
```

### Stil sorunları?
```
Tarayıcı önbelleğini temizle: Ctrl+F5
```

---

## 📊 Renk Kodlaması

| Büyüklük | Renk | Tanım |
|----------|------|-------|
| 0.0-2.9 | 🟢 Yeşil | Minör |
| 3.0-3.9 | 🟢 Açık Yeşil | Hafif |
| 4.0-4.9 | 🟡 Sarı | Orta |
| 5.0-5.9 | 🟠 Turuncu | Güçlü |
| 6.0-7.9 | 🟠 Koyu Turuncu | Büyük |
| 8.0+ | 🔴 Kırmızı | Çok Büyük |

---

## 🔗 Yararlı Linkler

- **Dokümantasyon**: [README.md](README.md)
- **Kurulum Rehberi**: [INSTALLATION.md](INSTALLATION.md)
- **Örnekler**: [EXAMPLES.md](EXAMPLES.md)
- **Katkıda Bulun**: [CONTRIBUTING.md](CONTRIBUTING.md)
- **GitHub**: https://github.com/integrumart/depremrss

---

## 📞 Destek

- **GitHub Issues**: Hata bildirimi ve özellik önerisi
- **Dokümantasyon**: Detaylı kullanım bilgisi
- **Topluluk**: Sorularınız için GitHub Discussions

---

## ✅ Checklist

Kurulumdan sonra kontrol edin:

- [ ] Eklenti aktif
- [ ] Ayarlar yapılandırılmış
- [ ] RSS feed çalışıyor
- [ ] Shortcode test edilmiş
- [ ] Widget eklenmiş (opsiyonel)
- [ ] Mobilde test edilmiş

---

## 🎯 İpuçları

1. **Performans**: Önbellek süresini 300-600 saniye tutun
2. **Kullanılabilirlik**: Minimum büyüklük 3.0+ ayarlayın (gürültüyü azaltır)
3. **Tasarım**: CSS ile özelleştirin
4. **Entegrasyon**: RSS feed'i diğer servislere bağlayın

---

## 📱 Responsive

- ✅ Masaüstü: Tam tablo görünümü
- ✅ Tablet: Küçültülmüş görünüm
- ✅ Mobil: Kart bazlı görünüm

---

**Versiyon**: 1.0.0  
**Son Güncelleme**: 2026-01-02  
**Lisans**: GPL-3.0
