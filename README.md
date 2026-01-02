# Deprem RSS - WordPress Eklentisi

WordPress için Türkiye'deki son depremleri takip etmenizi sağlayan RSS eklentisi.

## 📋 Özellikler

- ✅ Deprem verilerini RSS feed olarak sunma
- ✅ Yönetim paneli ile kolay ayarlama
- ✅ Shortcode desteği ile sayfa/yazılara entegrasyon
- ✅ Widget desteği
- ✅ Önbellekleme sistemi
- ✅ Minimum büyüklük filtresi
- ✅ Özelleştirilebilir görünüm
- ✅ Türkçe dil desteği

## 🚀 Kurulum

1. `depremrss` klasörünü WordPress kurulumunuzun `wp-content/plugins/` dizinine yükleyin
2. WordPress yönetim panelinden eklentiyi aktif edin
3. Yönetim menüsünden "Deprem RSS" sayfasına giderek ayarları yapılandırın

## 📖 Kullanım

### RSS Feed

Eklenti aktif edildiğinde, deprem verileri şu adresten RSS formatında erişilebilir:

```
https://siteniz.com/feed/deprem
```

### Shortcode

Sayfa veya yazılarınızda deprem listesi göstermek için:

```
[depremrss]
```

Parametrelerle kullanım:

```
[depremrss limit="10" min_magnitude="4.0"]
```

**Parametreler:**
- `limit`: Gösterilecek maksimum deprem sayısı (varsayılan: 10)
- `min_magnitude`: Minimum deprem büyüklüğü (varsayılan: 0.0)

### Widget

1. WordPress yönetim panelinden **Görünüm > Widget'lar** menüsüne gidin
2. **Deprem RSS Widget**'ını istediğiniz alana sürükleyin
3. Widget ayarlarını yapılandırın:
   - Başlık
   - Gösterilecek deprem sayısı
   - Minimum büyüklük

## ⚙️ Ayarlar

Yönetim panelinden **Deprem RSS** menüsüne giderek şu ayarları yapabilirsiniz:

- **Deprem Veri Kaynağı URL**: Deprem verilerinin alınacağı kaynak (varsayılan: KOERI)
- **Önbellek Süresi**: Verilerin önbellekte tutulma süresi (saniye)
- **Gösterilecek Deprem Sayısı**: Maksimum gösterilecek deprem sayısı
- **Minimum Büyüklük**: Gösterilecek minimum deprem büyüklüğü

## 🎨 Özelleştirme

Eklenti, CSS ile kolayca özelleştirilebilir. Aşağıdaki CSS sınıflarını kullanabilirsiniz:

```css
.depremrss-earthquakes    /* Ana konteyner */
.depremrss-table          /* Tablo */
.depremrss-magnitude      /* Büyüklük sütunu */
.depremrss-widget         /* Widget konteyner */
```

## 📊 Veri Kaynağı

Eklenti varsayılan olarak Kandilli Rasathanesi ve Deprem Araştırma Enstitüsü (KOERI) verilerini kullanacak şekilde yapılandırılmıştır.

## 🔧 Gereksinimler

- WordPress 5.0 veya üzeri
- PHP 7.0 veya üzeri

## 📝 Lisans

Bu proje GPL-3.0 lisansı altında lisanslanmıştır. Detaylar için [LICENSE](LICENSE) dosyasına bakın.

## 👨‍💻 Geliştirici

**IntegrumArt**
- GitHub: [@integrumart](https://github.com/integrumart)

## 🤝 Katkıda Bulunma

Katkılarınızı bekliyoruz! Lütfen pull request göndermekten çekinmeyin.

## 📞 Destek

Herhangi bir sorun veya öneri için [GitHub Issues](https://github.com/integrumart/depremrss/issues) sayfasını kullanabilirsiniz.

## 🔄 Sürüm Geçmişi

### 1.0.0 (İlk Sürüm)
- İlk sürüm yayınlandı
- RSS feed desteği
- Shortcode desteği
- Widget desteği
- Yönetim paneli
- Türkçe dil desteği
