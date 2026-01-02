# Deprem RSS - WordPress Eklentisi

![WordPress](https://img.shields.io/badge/WordPress-5.0+-blue.svg)
![PHP](https://img.shields.io/badge/PHP-7.0+-purple.svg)
![License](https://img.shields.io/badge/License-GPL%20v2-green.svg)

Depremleri WordPress sitenizde takip edin - RSS beslemesi üzerinden deprem verilerini görüntüleyin.

## 📋 Özellikler

- **RSS Feed Desteği**: Herhangi bir deprem RSS feed'ini kullanabilirsiniz (KOERI, AFAD vb.)
- **Özelleştirilebilir Görünüm**: Gösterilecek deprem sayısını ve minimum büyüklüğü ayarlayın
- **Shortcode Desteği**: `[deprem_listesi]` shortcode'u ile istediğiniz yerde deprem listesi gösterin
- **Widget Desteği**: Yan menüde deprem widget'ı ekleyin
- **Otomatik Yenileme**: AJAX ile sayfa yenilenmeden deprem listesini otomatik güncelleyin
- **Önbellekleme**: Performans için RSS feed'i önbelleğe alır
- **Renk Kodlu Büyüklük**: Deprem büyüklüğüne göre renkli görünüm
- **Duyarlı Tasarım**: Mobil ve masaüstü cihazlarda mükemmel görünüm
- **Kolay Yönetim**: Kullanıcı dostu yönetim paneli

## 🚀 Kurulum

### Otomatik Kurulum

1. WordPress yönetim panelinde **Eklentiler → Yeni Ekle**'ye gidin
2. "Deprem RSS" araması yapın
3. **Şimdi Yükle** butonuna tıklayın
4. Eklentiyi etkinleştirin

### Manuel Kurulum

1. Bu repository'yi klonlayın veya ZIP olarak indirin:
   ```bash
   git clone https://github.com/integrumart/depremrss.git
   ```

2. `depremrss` klasörünü WordPress kurulumunuzun `/wp-content/plugins/` dizinine kopyalayın

3. WordPress yönetim panelinde eklentiyi etkinleştirin

## 🎯 Kullanım

### Ayarlar

1. WordPress yönetim panelinde **Ayarlar → Deprem RSS**'e gidin
2. RSS feed URL'sini girin (örnek: KOERI feed)
3. Önbellek süresi, gösterilecek deprem sayısı gibi ayarları yapılandırın
4. Otomatik yenileme özelliğini etkinleştirin (isteğe bağlı)
5. Ayarları kaydedin

### Shortcode Kullanımı

Temel kullanım:
```
[deprem_listesi]
```

Parametreli kullanım:
```
[deprem_listesi count="5" min_magnitude="3.0"]
```

#### Shortcode Parametreleri

- `count`: Gösterilecek deprem sayısı (varsayılan: ayarlardaki değer)
- `min_magnitude`: Minimum deprem büyüklüğü (varsayılan: ayarlardaki değer)

### Widget Kullanımı

1. **Görünüm → Widget'lar** menüsüne gidin
2. **Deprem RSS Widget**'ını istediğiniz alana sürükleyin
3. Widget ayarlarını yapılandırın:
   - Başlık
   - Gösterilecek sayı
   - Minimum büyüklük
4. Kaydedin

## 📊 RSS Feed Kaynakları

### Önerilen Kaynaklar

- **KOERI (Kandilli Rasathanesi)**: `http://www.koeri.boun.edu.tr/scripts/lst0.asp`
- **AFAD**: Resmi AFAD RSS feed'i (varsa)

Herhangi bir standart RSS formatındaki deprem feed'ini kullanabilirsiniz.

## 🎨 Görünüm Özelleştirme

Eklenti, deprem büyüklüğüne göre otomatik renk kodlaması yapar:

- 🔴 **6.0+**: Büyük deprem (kırmızı)
- 🟠 **5.0-5.9**: Güçlü deprem (turuncu)
- 🟡 **4.0-4.9**: Orta şiddette (sarı)
- 🟢 **3.0-3.9**: Hafif deprem (sarı-yeşil)
- ⚪ **0-2.9**: Çok hafif (yeşil)

CSS dosyalarını özelleştirerek görünümü istediğiniz gibi değiştirebilirsiniz:
- `/assets/css/frontend.css` - Ön yüz stilleri
- `/assets/css/admin.css` - Yönetim paneli stilleri

## 🔧 Geliştirme

### Dosya Yapısı

```
depremrss/
├── depremrss.php          # Ana eklenti dosyası
├── readme.txt             # WordPress.org readme
├── README.md              # GitHub readme
├── LICENSE                # GPL v2 Lisansı
└── assets/
    ├── css/
    │   ├── admin.css      # Yönetim paneli stilleri
    │   └── frontend.css   # Ön yüz stilleri
    └── js/
        └── frontend.js    # Frontend JavaScript
```

### Katkıda Bulunma

1. Bu repository'yi fork edin
2. Feature branch oluşturun (`git checkout -b feature/amazing-feature`)
3. Değişikliklerinizi commit edin (`git commit -m 'feat: Add amazing feature'`)
4. Branch'inizi push edin (`git push origin feature/amazing-feature`)
5. Pull Request açın

## 📝 Gereksinimler

- WordPress 5.0 veya üzeri
- PHP 7.0 veya üzeri
- RSS feed okuma yetkisi

## 🐛 Sorun Bildirme

Bir hata bulduysanız veya öneriniz varsa, lütfen [issue açın](https://github.com/integrumart/depremrss/issues).

## 📜 Lisans

Bu proje GPL v2 veya üzeri lisansı altında lisanslanmıştır. Detaylar için [LICENSE](LICENSE) dosyasına bakın.

## 👥 Yazar

**Integrum Art**
- GitHub: [@integrumart](https://github.com/integrumart)

## 🙏 Teşekkürler

- KOERI (Kandilli Rasathanesi) - Deprem verileri için
- WordPress topluluğu - Harika bir platform için

## 📞 Destek

- GitHub Issues: [Sorun bildir](https://github.com/integrumart/depremrss/issues)
- WordPress.org: Eklenti destek forumu (yayınlandıktan sonra)

---

⭐ Bu projeyi beğendiyseniz, yıldız vermeyi unutmayın!
