# Deprem RSS - Kurulum ve Test Rehberi

## Kurulum Adımları

### 1. WordPress Ortamına Kurulum

#### A. Doğrudan Kurulum
```bash
# WordPress plugins dizinine gidin
cd /path/to/wordpress/wp-content/plugins/

# Repository'yi klonlayın
git clone https://github.com/integrumart/depremrss.git

# Veya ZIP olarak indirip açın
unzip depremrss.zip
```

#### B. WordPress Yönetim Panelinden Kurulum
1. Projeyi ZIP olarak indirin
2. WordPress yönetim paneline giriş yapın
3. **Eklentiler → Yeni Ekle → Eklenti Yükle** menüsüne gidin
4. ZIP dosyasını seçin ve yükleyin
5. Eklentiyi etkinleştirin

### 2. İlk Kurulum

1. Eklentiyi etkinleştirdikten sonra **Ayarlar → Deprem RSS** menüsüne gidin
2. Temel ayarları yapın:
   - **RSS Feed URL'si**: `http://www.koeri.boun.edu.tr/scripts/lst0.asp`
   - **Önbellek Süresi**: `300` (5 dakika)
   - **Gösterilecek Deprem Sayısı**: `10`
   - **Minimum Büyüklük**: `0` veya `2.5`
3. Ayarları kaydedin

## Test Senaryoları

### Test 1: Shortcode Testi

1. Yeni bir sayfa veya yazı oluşturun
2. Şu shortcode'u ekleyin:
   ```
   [deprem_listesi]
   ```
3. Sayfayı kaydedin ve önizleyin
4. Deprem listesinin göründüğünü doğrulayın

**Beklenen Sonuç**: Deprem listesi renk kodlu büyüklükler ve detaylarla görüntülenir.

### Test 2: Parametreli Shortcode Testi

1. Şu shortcode'u kullanın:
   ```
   [deprem_listesi count="5" min_magnitude="3.0"]
   ```
2. Sadece 5 adet, 3.0 ve üzeri büyüklükteki depremlerin göründüğünü doğrulayın

**Beklenen Sonuç**: Maksimum 5 deprem, sadece 3.0+ büyüklükte olanlar.

### Test 3: Widget Testi

1. **Görünüm → Widget'lar** menüsüne gidin
2. **Deprem RSS Widget**'ını sidebar'a ekleyin
3. Widget ayarlarını yapın:
   - Başlık: "Son Depremler"
   - Gösterilecek Sayı: 5
   - Minimum Büyüklük: 2.0
4. Kaydedin
5. Sitenin ön yüzüne gidin ve sidebar'da widget'ın göründüğünü doğrulayın

**Beklenen Sonuç**: Sidebar'da 5 adet deprem widget içinde gösterilir.

### Test 4: Otomatik Yenileme Testi

1. **Ayarlar → Deprem RSS** menüsüne gidin
2. **Otomatik Yenileme** seçeneğini işaretleyin
3. **Yenileme Aralığı**: `30` (saniye)
4. Ayarları kaydedin
5. Deprem listesi olan bir sayfayı açın
6. Tarayıcı geliştirici araçlarını açın (F12)
7. Network sekmesinde 30 saniyede bir AJAX isteği gönderildiğini doğrulayın

**Beklenen Sonuç**: Her 30 saniyede bir AJAX isteği ile liste güncellenir.

### Test 5: Manuel Yenileme Testi

1. Deprem listesi olan bir sayfayı açın
2. **Yenile** butonuna tıklayın
3. Loading animasyonunun göründüğünü doğrulayın
4. Listenin güncellendiğini doğrulayın

**Beklenen Sonuç**: Yenile butonuna tıklandığında liste güncellenir, loading animasyonu gösterilir.

### Test 6: Önbellek Testi

1. Tarayıcı geliştirici araçlarını açın
2. Network sekmesini temizleyin
3. Deprem listesi olan sayfayı yenileyin
4. RSS feed isteğinin gönderildiğini görün
5. Sayfayı tekrar yenileyin (önbellek süresi dolmadan)
6. RSS feed isteğinin gönderilmediğini doğrulayın (önbellekten gelir)

**Beklenen Sonuç**: Önbellek süresi dolana kadar aynı veriler önbellekten sunulur.

### Test 7: Responsive Tasarım Testi

1. Deprem listesi olan sayfayı açın
2. Tarayıcı penceresini küçültün (mobil görünüm)
3. Listenin mobil cihazlara uygun görüntülendiğini doğrulayın
4. Tablet boyutunda test edin
5. Masaüstü boyutunda test edin

**Beklenen Sonuç**: Tüm ekran boyutlarında düzgün görüntülenir.

### Test 8: Tema Uyumluluğu Testi

Farklı WordPress temalarıyla test edin:
- Twenty Twenty-One
- Twenty Twenty-Two
- Twenty Twenty-Three
- Astra
- GeneratePress

**Beklenen Sonuç**: Tüm temalarda düzgün çalışır ve görüntülenir.

### Test 9: Performans Testi

1. Browser DevTools'da Performance sekmesini açın
2. Profiling başlatın
3. Deprem listesi olan sayfayı yükleyin
4. Performans raporunu inceleyin

**Beklenen Sonuç**: Sayfa yüklenme süresi makul seviyede (<2 saniye).

### Test 10: Güvenlik Testi

1. XSS (Cross-Site Scripting) testi:
   - Ayarlara JavaScript kodu eklemeye çalışın
   - Kodun escape edildiğini doğrulayın

2. SQL Injection testi:
   - Parametrelere SQL kodu eklemeye çalışın
   - Sanitization'ın çalıştığını doğrulayın

3. CSRF testi:
   - AJAX isteklerinde nonce kontrolü yapıldığını doğrulayın

**Beklenen Sonuç**: Tüm güvenlik kontrolleri başarılı.

## Manuel Test Checklist

- [ ] Plugin başarıyla etkinleştiriliyor
- [ ] Admin ayarlar sayfası düzgün açılıyor
- [ ] RSS feed başarıyla parse ediliyor
- [ ] Shortcode düzgün çalışıyor
- [ ] Widget düzgün çalışıyor
- [ ] Otomatik yenileme çalışıyor
- [ ] Manuel yenileme çalışıyor
- [ ] Önbellek sistemi çalışıyor
- [ ] Büyüklük filtreleme çalışıyor
- [ ] Renk kodlaması doğru
- [ ] Responsive tasarım çalışıyor
- [ ] Farklı temalarda çalışıyor
- [ ] PHP hataları yok
- [ ] JavaScript hataları yok
- [ ] Console'da hata yok
- [ ] Güvenlik kontrolleri geçiyor
- [ ] Performans kabul edilebilir

## Bilinen Sınırlamalar

1. **RSS Feed Formatı**: Plugin standart RSS formatını bekler. Özel format gerektiren feed'ler için kod değişikliği gerekebilir.

2. **Büyüklük Parse**: Deprem büyüklüğü RSS feed içindeki metinden parse edilir. Format değişirse düzgün çalışmayabilir.

3. **Önbellek**: WordPress transient API kullanır. Bazı önbellek eklentileri ile çakışabilir.

4. **AJAX**: JavaScript devre dışıysa otomatik yenileme çalışmaz.

## Hata Ayıklama

### PHP Hatalarını Gösterme

`wp-config.php` dosyasına ekleyin:
```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
```

Hata logları: `wp-content/debug.log`

### JavaScript Hatalarını Gösterme

Tarayıcı Console'unu açın (F12 → Console sekmesi)

### RSS Feed Testi

Feed'in düzgün çalıştığını test etmek için:
```php
$feed = fetch_feed('http://www.koeri.boun.edu.tr/scripts/lst0.asp');
var_dump($feed);
```

## Sorun Giderme

### Sorun: Depremler görünmüyor
**Çözüm**: 
1. RSS feed URL'sinin doğru olduğundan emin olun
2. `wp-content/debug.log` dosyasını kontrol edin
3. Önbelleği temizleyin (Yenile butonuna basın)

### Sorun: Stil hatalı görünüyor
**Çözüm**:
1. Tarayıcı önbelleğini temizleyin
2. CSS dosyalarının yüklendiğini doğrulayın
3. Tema ile CSS çakışması olup olmadığını kontrol edin

### Sorun: AJAX çalışmıyor
**Çözüm**:
1. JavaScript'in yüklendiğini doğrulayın
2. Console'da hata olup olmadığını kontrol edin
3. Nonce'un doğru oluşturulduğunu doğrulayın

## Destek

Sorun yaşarsanız:
1. GitHub Issues: https://github.com/integrumart/depremrss/issues
2. Debug logları ekleyin
3. WordPress ve PHP versiyonlarını belirtin
4. Kullanılan temayı belirtin
