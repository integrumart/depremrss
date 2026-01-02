# Katkıda Bulunma Kılavuzu

Deprem RSS projesine katkıda bulunmayı düşündüğünüz için teşekkür ederiz! Bu belge, projeye nasıl katkıda bulunabileceğiniz konusunda size yol gösterecektir.

## Davranış Kuralları

Bu projede açık ve misafirperver bir ortam yaratmak için tüm katılımcıların birbirlerine saygılı davranması beklenir.

## Nasıl Katkıda Bulunabilirim?

### Hata Bildirimi

Bir hata bulduysanız:

1. Önce mevcut [issues](https://github.com/integrumart/depremrss/issues) sayfasını kontrol edin
2. Eğer benzer bir issue yoksa, yeni bir issue açın
3. Issue'da şunları belirtin:
   - Hatanın açık bir tanımı
   - Hatayı yeniden oluşturma adımları
   - Beklenen davranış
   - Gerçekleşen davranış
   - Ekran görüntüleri (varsa)
   - WordPress versiyonu
   - PHP versiyonu
   - Kullanılan tema

### Özellik Önerisi

Yeni bir özellik önermek için:

1. Bir issue açın ve başlığa `[Özellik]` ekleyin
2. Özelliğin detaylı açıklamasını yapın
3. Kullanım senaryolarını belirtin
4. Varsa mockup veya örnek ekleyin

### Pull Request Süreci

1. **Fork**: Projeyi fork edin
2. **Branch**: Yeni bir branch oluşturun
   ```bash
   git checkout -b feature/my-new-feature
   ```
3. **Kod**: Değişikliklerinizi yapın
4. **Test**: Kodunuzun çalıştığından emin olun
5. **Commit**: Anlamlı commit mesajları yazın
   ```bash
   git commit -m "feat: Add new earthquake filter option"
   ```
6. **Push**: Branch'inizi push edin
   ```bash
   git push origin feature/my-new-feature
   ```
7. **PR**: Pull request açın

### Commit Mesajı Formatı

Commit mesajlarınız için şu formatı kullanın:

```
<type>: <subject>

<body>

<footer>
```

**Type değerleri:**
- `feat`: Yeni özellik
- `fix`: Hata düzeltme
- `docs`: Dokümantasyon değişikliği
- `style`: Kod formatı, noktalama vb.
- `refactor`: Kod refactoring
- `test`: Test ekleme/düzenleme
- `chore`: Yardımcı araçlar, konfigürasyon vb.

**Örnekler:**
```
feat: Add earthquake magnitude color coding
fix: Resolve caching issue in RSS feed parser
docs: Update installation instructions in README
```

## Kod Standartları

### PHP Kod Standartları

- [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/) kullanın
- PHP 7.0+ syntax kullanın
- Tüm fonksiyonları ve sınıfları dökümante edin
- Güvenlik en iyi pratiklerini takip edin:
  - `esc_html()`, `esc_attr()`, `esc_url()` kullanın
  - Nonce kullanın
  - Data sanitizasyonu yapın

### JavaScript Kod Standartları

- Modern ES5+ syntax kullanın
- jQuery varsa kullanın, ancak vanilla JS tercih edilir
- Kodunuzu yorum satırlarıyla açıklayın

### CSS Kod Standartları

- BEM metodolojisini takip edin
- Mobile-first yaklaşımı kullanın
- Anlamlı class isimleri verin

## Test Etme

Pull request göndermeden önce:

1. Kodunuzu farklı WordPress versiyonlarında test edin
2. Farklı temalarda test edin
3. Mobil cihazlarda test edin
4. Tarayıcı console'unda hata olmadığından emin olun

## Dokümantasyon

- Yeni özellikler için README.md'yi güncelleyin
- Kod içi yorumlar ekleyin
- Gerekirse kullanım örnekleri ekleyin

## Lisans

Katkıda bulunarak, kodunuzun GPL v2 lisansı altında lisanslanmasını kabul edersiniz.

## Sorular?

Herhangi bir sorunuz varsa, issue açmaktan çekinmeyin!

## Teşekkürler!

Katkılarınız projeyi daha iyi hale getirir. Zaman ayırdığınız için teşekkür ederiz! 🙏
