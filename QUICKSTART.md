# Deprem RSS - Hızlı Başlangıç Rehberi

## Kurulum (3 Adım)

### 1. Yükleme
```bash
# WordPress plugins dizinine:
cd wp-content/plugins/
git clone https://github.com/integrumart/depremrss.git
```

### 2. Etkinleştirme
WordPress yönetim paneli → Eklentiler → Deprem RSS → Etkinleştir

### 3. Yapılandırma
Ayarlar → Deprem RSS:
- RSS URL: `http://www.koeri.boun.edu.tr/scripts/lst0.asp`
- Önbellek: `300` saniye
- Gösterim: `10` deprem
- Min Büyüklük: `2.5`

## Kullanım

### Shortcode (En Kolay)
Sayfa veya yazı içine ekleyin:
```
[deprem_listesi]
```

Özelleştirme:
```
[deprem_listesi count="5" min_magnitude="3.0"]
```

### Widget
Görünüm → Widget'lar → "Deprem RSS Widget"i sidebar'a sürükleyin

### PHP Kodu
```php
<?php echo do_shortcode('[deprem_listesi count="10"]'); ?>
```

## Parametreler

| Parametre | Açıklama | Örnek |
|-----------|----------|-------|
| count | Gösterilecek deprem sayısı | count="5" |
| min_magnitude | Minimum büyüklük | min_magnitude="3.0" |

## Özellikler

✓ RSS feed entegrasyonu
✓ Otomatik yenileme
✓ Renk kodlu büyüklük
✓ Responsive tasarım
✓ Widget desteği
✓ Önbellekleme

## Renk Kodları

- 🔴 6.0+ = Büyük (Kırmızı)
- 🟠 5.0-5.9 = Güçlü (Turuncu)
- 🟡 4.0-4.9 = Orta (Sarı)
- 🟢 3.0-3.9 = Hafif (Yeşil-Sarı)
- ⚪ 0-2.9 = Çok Hafif (Yeşil)

## Sorun Giderme

### Depremler görünmüyorsa:
1. RSS URL'sini kontrol edin
2. Önbelleği temizleyin (Yenile butonu)
3. Minimum büyüklük ayarını düşürün

### Stil sorunları:
1. Tarayıcı önbelleğini temizleyin
2. Tema ile uyumluluğu kontrol edin

## Destek

- GitHub: https://github.com/integrumart/depremrss/issues
- Dokümantasyon: README.md

## Lisans
GPL v2 veya üzeri

---
İyi kullanımlar! 🎉
