# Deprem RSS - Test Planı

Bu dokümanda eklentinin test edilmesi gereken tüm alanlar listelenmektedir.

## Test Ortamı Gereksinimleri

### Minimum Gereksinimler
- WordPress 5.0+
- PHP 7.0+
- MySQL 5.6+ veya MariaDB 10.0+

### Test Ortamları
- [ ] Temiz WordPress kurulumu (varsayılan tema)
- [ ] Popüler temalarla test (Astra, OceanWP, GeneratePress)
- [ ] Farklı WordPress versiyonları (5.0, 5.5, 6.0, 6.4)
- [ ] Farklı PHP versiyonları (7.0, 7.4, 8.0, 8.1, 8.2)

## 1. Kurulum ve Aktivasyon Testleri

### Test 1.1: Eklenti Kurulumu
- [ ] ZIP dosyasından yükleme
- [ ] FTP ile manuel yükleme
- [ ] Eklenti listede görünüyor
- [ ] Versiyon numarası doğru

### Test 1.2: Aktivasyon
- [ ] Eklenti başarıyla aktive ediliyor
- [ ] PHP hataları yok
- [ ] Veritabanı hataları yok
- [ ] Menü öğesi ekleniyor (sol menüde "Deprem RSS")
- [ ] Varsayılan ayarlar oluşturuluyor

### Test 1.3: Deaktivasyon
- [ ] Eklenti başarıyla deaktive ediliyor
- [ ] Menü öğesi kaldırılıyor
- [ ] RSS feed devre dışı kalıyor
- [ ] Widget'lar çalışmayı durduruyor

### Test 1.4: Silme (Uninstall)
- [ ] Eklenti başarıyla siliniyor
- [ ] Veritabanı seçenekleri temizleniyor
- [ ] Transients (önbellek) temizleniyor
- [ ] Dosyalar tamamen kaldırılıyor

## 2. Yönetim Paneli Testleri

### Test 2.1: Ayarlar Sayfası Erişimi
- [ ] "Deprem RSS" menüsüne tıklanabiliyor
- [ ] Sayfa başarıyla yükleniyor
- [ ] Icon görünüyor (warning dashicon)
- [ ] Sadece admin kullanıcılar erişebiliyor

### Test 2.2: Ayarlar Formu
- [ ] Tüm form alanları görünüyor
- [ ] Varsayılan değerler doğru
- [ ] Form alanları düzenlenebiliyor
- [ ] Kaydet butonu çalışıyor
- [ ] Başarı mesajı gösteriliyor

### Test 2.3: Form Validasyonu
- [ ] Boş URL kabul edilmiyor (varsa)
- [ ] Geçersiz URL formatı reddediliyor
- [ ] Negatif sayılar kabul edilmiyor
- [ ] Maksimum limitler çalışıyor
- [ ] Nonce kontrolü çalışıyor

### Test 2.4: Ayarlar Kaydetme
- [ ] Ayarlar veritabanına kaydediliyor
- [ ] Önbellek temizleniyor
- [ ] Sayfada yeni değerler görünüyor
- [ ] Tarayıcı yenilenince ayarlar kalıcı

### Test 2.5: Sidebar Bilgileri
- [ ] Son depremler listesi görünüyor
- [ ] RSS feed URL gösteriliyor
- [ ] Kopyala butonu çalışıyor
- [ ] Shortcode örnekleri görünüyor
- [ ] Widget talimatları görünüyor
- [ ] Versiyon ve geliştirici bilgisi doğru

## 3. RSS Feed Testleri

### Test 3.1: Feed Erişimi
- [ ] `/feed/deprem` URL'si çalışıyor
- [ ] XML formatında döndürüyor
- [ ] Content-Type header doğru
- [ ] Charset UTF-8

### Test 3.2: Feed İçeriği
- [ ] `<rss>` elementi var
- [ ] `<channel>` elementi var
- [ ] Site başlığı doğru
- [ ] Site URL'si doğru
- [ ] Son depremler listeleniyor

### Test 3.3: Feed Item'ları
- [ ] Her deprem için `<item>` var
- [ ] `<title>` doğru formatlanmış
- [ ] `<link>` var
- [ ] `<pubDate>` RFC-822 formatında
- [ ] `<guid>` benzersiz
- [ ] `<description>` içinde tüm bilgiler var

### Test 3.4: Feed Validasyonu
- [ ] W3C Feed Validator'dan geçiyor
- [ ] RSS reader'larda açılabiliyor (Feedly, Inoreader)
- [ ] Outlook'ta subscribe edilebiliyor
- [ ] Thunderbird'de çalışıyor

### Test 3.5: Feed Filtreler
- [ ] Minimum büyüklük filtresi çalışıyor
- [ ] Limit ayarı uygulanıyor
- [ ] Önbellek çalışıyor

## 4. Shortcode Testleri

### Test 4.1: Basit Shortcode
- [ ] `[depremrss]` çalışıyor
- [ ] Sayfa/yazıda gösteriliyor
- [ ] Tablo formatında görünüyor
- [ ] Varsayılan limit uygulanıyor

### Test 4.2: Shortcode Parametreleri
- [ ] `limit` parametresi çalışıyor
- [ ] `min_magnitude` parametresi çalışıyor
- [ ] Birden fazla parametre birlikte çalışıyor
- [ ] Geçersiz parametreler ignore ediliyor

### Test 4.3: Shortcode Görünümü
- [ ] Tablo başlıkları görünüyor
- [ ] Tarih/Saat görünüyor
- [ ] Büyüklük görünüyor
- [ ] Derinlik görünüyor
- [ ] Bölge görünüyor
- [ ] Renk kodlaması çalışıyor

### Test 4.4: Shortcode Edge Cases
- [ ] Veri yoksa mesaj gösteriliyor
- [ ] Boş limit hata vermiyor
- [ ] Çok büyük limit sınırlanıyor
- [ ] Negatif değerler handle ediliyor

## 5. Widget Testleri

### Test 5.1: Widget Ekleme
- [ ] Widget listede görünüyor
- [ ] Sidebar'a eklenebiliyor
- [ ] Footer'a eklenebiliyor
- [ ] Birden fazla widget eklenebiliyor

### Test 5.2: Widget Ayarları
- [ ] Başlık alanı çalışıyor
- [ ] Limit alanı çalışıyor
- [ ] Minimum büyüklük alanı çalışıyor
- [ ] Ayarlar kaydediliyor

### Test 5.3: Widget Görünümü
- [ ] Widget başlığı görünüyor
- [ ] Depremler listeleniyor
- [ ] Büyüklük kutusu görünüyor
- [ ] Lokasyon görünüyor
- [ ] Tarih/saat görünüyor
- [ ] Derinlik görünüyor

### Test 5.4: Widget Stilleri
- [ ] CSS yükleniyor
- [ ] Responsive çalışıyor
- [ ] Tema ile uyumlu

## 6. Stil ve Tasarım Testleri

### Test 6.1: Admin CSS
- [ ] Admin CSS dosyası yükleniyor
- [ ] Stillerin çakışması yok
- [ ] Layout düzgün görünüyor
- [ ] Responsive çalışıyor

### Test 6.2: Frontend CSS
- [ ] Frontend CSS yükleniyor
- [ ] Tablo stilleri uygulanıyor
- [ ] Widget stilleri uygulanıyor
- [ ] Tema CSS'i ile çakışma yok

### Test 6.3: Responsive Tasarım
- [ ] Masaüstü (>768px) - Tam tablo
- [ ] Tablet (481-768px) - Küçültülmüş tablo
- [ ] Mobil (<480px) - Kart görünümü
- [ ] Widget her ekranda çalışıyor

### Test 6.4: Renk Kodlaması
- [ ] 0-2.9: Yeşil
- [ ] 3.0-3.9: Açık yeşil
- [ ] 4.0-4.9: Sarı
- [ ] 5.0-5.9: Turuncu
- [ ] 6.0-7.9: Koyu turuncu
- [ ] 8.0+: Kırmızı

### Test 6.5: Cross-Browser Uyumluluk
- [ ] Chrome (son 2 versiyon)
- [ ] Firefox (son 2 versiyon)
- [ ] Safari (son 2 versiyon)
- [ ] Edge (son 2 versiyon)
- [ ] Mobil Safari (iOS)
- [ ] Chrome Mobile (Android)

## 7. Güvenlik Testleri

### Test 7.1: Input Sanitization
- [ ] URL sanitize ediliyor
- [ ] Sayısal değerler intval/floatval ile işleniyor
- [ ] Metin alanları sanitize_text_field ile temizleniyor

### Test 7.2: Output Escaping
- [ ] HTML output esc_html ile escape ediliyor
- [ ] Attribute output esc_attr ile escape ediliyor
- [ ] URL output esc_url ile escape ediliyor

### Test 7.3: Nonce Kontrolü
- [ ] Form submit'te nonce kontrolü var
- [ ] Geçersiz nonce reddediliyor
- [ ] Nonce timeout çalışıyor

### Test 7.4: Capability Checks
- [ ] Admin sayfası sadece `manage_options` ile erişilebilir
- [ ] Non-admin kullanıcılar engellenıyor

### Test 7.5: SQL Injection
- [ ] Direkt SQL sorgusu yok
- [ ] WordPress API kullanılıyor
- [ ] Prepared statements (varsa)

### Test 7.6: XSS (Cross-Site Scripting)
- [ ] User input escape ediliyor
- [ ] JavaScript injection mümkün değil
- [ ] HTML injection mümkün değil

### Test 7.7: CSRF (Cross-Site Request Forgery)
- [ ] Nonce kullanılıyor
- [ ] Referer check yapılıyor (WordPress tarafından)

## 8. Performans Testleri

### Test 8.1: Önbellek
- [ ] Transients kullanılıyor
- [ ] Önbellek süresi uygulanıyor
- [ ] Önbellek temizleme çalışıyor
- [ ] Süre sonunda yeniden fetch ediliyor

### Test 8.2: Sayfa Yüklenme
- [ ] Eklenti sayfayı yavaşlatmıyor
- [ ] CSS/JS minified olabilir (gelecek versiyon)
- [ ] Gereksiz sorgu yok
- [ ] Database query optimize

### Test 8.3: Stress Test
- [ ] Çok sayıda deprem ile test
- [ ] Birden fazla shortcode aynı sayfada
- [ ] Birden fazla widget
- [ ] Yüksek traffic simülasyonu

## 9. Uyumluluk Testleri

### Test 9.1: WordPress Versiyonları
- [ ] WordPress 5.0
- [ ] WordPress 5.5
- [ ] WordPress 6.0
- [ ] WordPress 6.4 (en son)

### Test 9.2: PHP Versiyonları
- [ ] PHP 7.0
- [ ] PHP 7.4
- [ ] PHP 8.0
- [ ] PHP 8.1
- [ ] PHP 8.2

### Test 9.3: Popüler Temalar
- [ ] Twenty Twenty-Three (varsayılan)
- [ ] Astra
- [ ] OceanWP
- [ ] GeneratePress
- [ ] Kadence

### Test 9.4: Popüler Eklentiler
- [ ] Yoast SEO
- [ ] Contact Form 7
- [ ] WooCommerce
- [ ] Elementor
- [ ] WP Super Cache

### Test 9.5: Multisite
- [ ] Network activation çalışıyor
- [ ] Her site için ayrı ayarlar
- [ ] Network admin'den yönetilebilir (gelecek versiyon)

## 10. Fonksiyonel Testler

### Test 10.1: Veri Çekme
- [ ] Sample data gösteriliyor
- [ ] Veri formatı doğru
- [ ] Tarih formatı doğru
- [ ] Koordinatlar doğru formatta

### Test 10.2: Veri Filtreleme
- [ ] Minimum büyüklük filtresi
- [ ] Limit çalışıyor
- [ ] Sıralama doğru (en yeni ilk)

### Test 10.3: Hata Yönetimi
- [ ] Veri yoksa kullanıcı dostu mesaj
- [ ] Network hatası gracefully handle ediliyor
- [ ] PHP uyarıları bastırılıyor
- [ ] Error log'a yazılıyor

## 11. İnternasyonalizasyon Testleri

### Test 11.1: Çeviri Altyapısı
- [ ] Text domain doğru (`depremrss`)
- [ ] Domain path doğru (`/languages`)
- [ ] POT dosyası mevcut

### Test 11.2: Çevrilebilir Metinler
- [ ] Tüm user-facing string'ler `__()`veya `_e()` ile sarılmış
- [ ] sprintf kullanımı doğru
- [ ] Plural forms (varsa) doğru

### Test 11.3: RTL Desteği (Gelecek)
- [ ] RTL dillerde layout bozulmuyor

## 12. Dokümantasyon Testleri

### Test 12.1: README.md
- [ ] Güncel ve doğru
- [ ] Kurulum talimatları net
- [ ] Örnekler çalışıyor
- [ ] Markdown formatı doğru

### Test 12.2: INSTALLATION.md
- [ ] Adım adım kurulum açık
- [ ] Ekran görüntüleri (gelecek)
- [ ] Sorun giderme bölümü yeterli

### Test 12.3: Code Comments
- [ ] PHP dosyalarında PHPDoc
- [ ] Karmaşık kodlar açıklanmış
- [ ] Fonksiyon parametreleri dokümante

### Test 12.4: WordPress Plugin Readme
- [ ] readme.txt formatı doğru
- [ ] WordPress.org standardına uygun
- [ ] FAQ bölümü yararlı

## 13. Regresyon Testleri

### Test 13.1: Eski Versiyondan Güncelleme
- [ ] Ayarlar korunuyor
- [ ] Veri kaybı yok
- [ ] Widget'lar çalışmaya devam ediyor

### Test 13.2: Önceki Özellikler
- [ ] Tüm özellikler hala çalışıyor
- [ ] Bug fix'ler hala geçerli

## Test Raporu Şablonu

```markdown
### Test Raporu - [Tarih]

**Tester**: [İsim]
**WordPress Versiyon**: [Versiyon]
**PHP Versiyon**: [Versiyon]
**Tema**: [Tema adı]

#### Geçen Testler
- [x] Test 1.1: Kurulum
- [x] Test 2.1: Admin erişimi
...

#### Başarısız Testler
- [ ] Test X.X: [Test adı]
  - **Hata**: [Hata açıklaması]
  - **Beklenen**: [Beklenen davranış]
  - **Gerçekleşen**: [Gerçekleşen davranış]
  - **Adımlar**: [Yeniden üretme adımları]

#### Notlar
- [Ek gözlemler]
```

## Otomasyon Önerileri

### Unit Test (Gelecek)
- [ ] PHPUnit entegrasyonu
- [ ] Test case'ler yazılmalı
- [ ] CI/CD pipeline

### Integration Test (Gelecek)
- [ ] WordPress test suite
- [ ] Selenium/Playwright testleri

---

**Not**: Bu test planı canlı WordPress ortamında manuel olarak çalıştırılmalıdır.
Test sonuçları dokümante edilmeli ve sorunlar GitHub Issues'da raporlanmalıdır.
