# Katkıda Bulunma Rehberi

Deprem RSS projesine katkıda bulunmak istediğiniz için teşekkür ederiz! Bu rehber, katkı sürecini kolaylaştırmak için hazırlanmıştır.

## Katkı Türleri

### 🐛 Hata Bildirimi

Hata bulduysanız:

1. Önce [Issues](https://github.com/integrumart/depremrss/issues) sayfasında aynı hatanın bildirilip bildirilmediğini kontrol edin
2. Yeni bir issue açın ve şunları ekleyin:
   - Hatanın açık tanımı
   - Hatayı yeniden üretme adımları
   - Beklenen davranış
   - Gerçekleşen davranış
   - Ekran görüntüleri (varsa)
   - Ortam bilgileri (WordPress versiyonu, PHP versiyonu, tema, vb.)

### ✨ Özellik Önerisi

Yeni özellik önerileriniz için:

1. [Issues](https://github.com/integrumart/depremrss/issues) sayfasını kontrol edin
2. Yeni bir "Feature Request" issue'su açın
3. Özelliği detaylı açıklayın
4. Kullanım senaryolarını ekleyin
5. Varsa örnek ekran görüntüleri veya mockup'lar ekleyin

### 🔧 Kod Katkısı

Kod katkısında bulunmak için:

1. Repoyu fork edin
2. Yeni bir branch oluşturun (`git checkout -b feature/amazing-feature`)
3. Değişikliklerinizi yapın
4. Commit edin (`git commit -m 'feat: Add amazing feature'`)
5. Branch'inizi push edin (`git push origin feature/amazing-feature`)
6. Pull Request açın

## Geliştirme Ortamı Kurulumu

### Gereksinimler

- WordPress 5.0+
- PHP 7.0+
- Local WordPress ortamı (Local by Flywheel, XAMPP, MAMP, vb.)

### Kurulum

```bash
# Repoyu klonlayın
git clone https://github.com/integrumart/depremrss.git

# WordPress plugins dizinine symlink oluşturun
ln -s /path/to/depremrss /path/to/wordpress/wp-content/plugins/depremrss

# WordPress admin panelinden eklentiyi aktif edin
```

## Kod Standartları

### PHP

- [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/) kullanın
- PHP 7.0+ uyumlu kod yazın
- Tüm user input'ları sanitize edin
- Tüm output'ları escape edin

### CSS

- BEM metodolojisi kullanın
- Mobile-first yaklaşım
- Responsive tasarım

### JavaScript (gelecekte eklenirse)

- ES6+ standardı
- Vanilla JS veya WordPress'in jQuery'si

### Commit Mesajları

Conventional Commits formatını kullanın:

```
feat: Yeni özellik ekle
fix: Hata düzeltmesi
docs: Dokümantasyon değişikliği
style: Kod formatı değişikliği
refactor: Kod yeniden yapılandırma
test: Test ekleme/düzeltme
chore: Diğer değişiklikler
```

Örnekler:
```
feat: Add earthquake map view
fix: Correct RSS feed encoding issue
docs: Update installation guide
```

## Pull Request Süreci

1. **Küçük ve odaklı PR'lar:** Her PR tek bir özellik veya düzeltme içermeli
2. **Açıklayıcı başlık:** PR'ın ne yaptığını açıkça belirtin
3. **Detaylı açıklama:** 
   - Değişikliklerin özeti
   - İlgili issue numarası (#123 gibi)
   - Test adımları
   - Ekran görüntüleri (UI değişikliği varsa)
4. **Test edin:** Tüm değişiklikleri test edin
5. **Temiz commit geçmişi:** Gerekirse squash edin

## Test Etme

### Manuel Test

1. Eklentiyi temiz bir WordPress kurulumunda test edin
2. Farklı temalarda test edin
3. Farklı WordPress versiyonlarında test edin (5.0+)
4. Mobil cihazlarda test edin

### Test Checklist

- [ ] Eklenti aktive ediliyor mu?
- [ ] Ayarlar sayfası çalışıyor mu?
- [ ] RSS feed doğru çalışıyor mu?
- [ ] Shortcode çalışıyor mu?
- [ ] Widget çalışıyor mu?
- [ ] CSS stilleri doğru uygulanıyor mu?
- [ ] Hata mesajları var mı?
- [ ] Güvenlik açıkları var mı?

## Soru ve Yardım

- **Issues:** Genel sorular ve yardım için
- **Discussions:** Tartışmalar için (etkinse)
- **Email:** Özel konular için

## Lisans

Katkıda bulunarak, katkılarınızın [GPL-3.0 Lisansı](LICENSE) altında lisanslanmasını kabul etmiş olursunuz.

## Davranış Kuralları

Lütfen [CODE_OF_CONDUCT.md](CODE_OF_CONDUCT.md) dosyasını okuyun ve tüm etkileşimlerinizde bu kurallara uyun.

## Teşekkürler

Deprem RSS projesine katkıda bulunan herkese teşekkür ederiz! 🙏

---

**Not:** Bu proje açık kaynak bir projedir ve gönüllüler tarafından yürütülmektedir. Sabırlı olun ve saygılı olun.
