# Kurulum ve Kullanım Rehberi

## Hızlı Başlangıç

### Gereksinimler
- WordPress 5.0 veya üzeri
- PHP 7.0 veya üzeri
- cURL veya WordPress HTTP API desteği

### Kurulum Adımları

#### Yöntem 1: Manuel Kurulum

1. Bu repository'yi indirin veya klonlayın:
   ```bash
   git clone https://github.com/integrumart/depremrss.git
   ```

2. `depremrss.php` dosyasını WordPress kurulumunuzun `wp-content/plugins/depremrss/` dizinine yükleyin:
   ```bash
   cp depremrss.php /path/to/wordpress/wp-content/plugins/depremrss/
   ```

3. WordPress yönetim paneline giriş yapın

4. **Eklentiler** menüsüne gidin

5. **Deprem RSS** eklentisini bulun ve **Etkinleştir** butonuna tıklayın

#### Yöntem 2: FTP ile Kurulum

1. FTP istemciniz ile WordPress sunucunuza bağlanın

2. `wp-content/plugins/` dizinine gidin

3. `depremrss` adında yeni bir klasör oluşturun

4. `depremrss.php` dosyasını bu klasöre yükleyin

5. WordPress yönetim panelinden eklentiyi etkinleştirin

#### Yöntem 3: ZIP ile Kurulum

1. Bu repository'yi ZIP olarak indirin

2. WordPress yönetim panelinde **Eklentiler > Yeni Ekle** menüsüne gidin

3. **Eklenti Yükle** butonuna tıklayın

4. ZIP dosyasını seçin ve yükleyin

5. **Şimdi Etkinleştir** butonuna tıklayın

## Kullanım

### Otomatik Çalışma

Eklenti etkinleştirildikten sonra:

1. Her saat başı otomatik olarak Kandilli Rasathanesi RSS beslemesini kontrol eder
2. Yeni depremleri tespit eder
3. Her deprem için otomatik WordPress yazısı oluşturur
4. Çift kayıt önleme sistemi sayesinde aynı depremi tekrar eklemez

### Manuel Güncelleme

Otomatik güncellemelerin yanı sıra manuel olarak da deprem verilerini çekebilirsiniz:

1. WordPress yönetim panelinde **Deprem RSS** menüsüne gidin

2. **Şimdi Depremleri Getir** butonuna tıklayın

3. Eklenti anında RSS beslemesini kontrol eder ve yeni depremleri ekler

4. Ekranda kaç deprem yazısının eklendiğini göreceksiniz

### Deprem Yazılarını Görüntüleme

1. WordPress yönetim panelinde **Yazılar** menüsüne gidin

2. Tüm deprem yazıları "Deprem" kategorisi altında listelenecektir

3. Her yazı şu bilgileri içerir:
   - Deprem başlığı (büyüklük, konum, tarih, saat)
   - Büyüklük (magnitude)
   - Derinlik (km)
   - Konum koordinatları (enlem, boylam)
   - Kaynak linki (Kandilli Rasathanesi)

### Kategori Ayarları

Eklenti ilk çalıştığında otomatik olarak **Deprem** kategorisi oluşturur. Bu kategoriyi:

- WordPress **Yazılar > Kategoriler** menüsünden özelleştirebilirsiniz
- Üst kategori olarak başka bir kategoriye atayabilirsiniz
- Açıklama ekleyebilirsiniz
- Slug'ını değiştirebilirsiniz

## Test Etme

Repository'de test scriptleri bulunmaktadır:

### Mock Test (Önerilen)
```bash
php test-mock.php
```
Bu script, örnek deprem verisi ile parsing mantığını test eder.

### RSS Test (HTML)
`test-rss.php` dosyasını web sunucunuzda çalıştırarak RSS beslemesini tarayıcıda test edebilirsiniz.

### Basit Test
```bash
php test-simple.php
```
Bu script, RSS beslemesine doğrudan bağlanıp veri çekmeyi test eder.

## Sorun Giderme

### Depremler Eklenmiyor

1. **RSS bağlantısını kontrol edin:**
   - Kandilli Rasathanesi RSS beslemesi erişilebilir mi?
   - http://koeri.boun.edu.tr/rss/ adresini tarayıcınızda açın

2. **WP-Cron'u kontrol edin:**
   ```php
   // wp-config.php dosyasına ekleyin (test için)
   define('DISABLE_WP_CRON', false);
   ```

3. **PHP hata günlüklerini kontrol edin:**
   - WordPress debug modunu etkinleştirin
   - `wp-content/debug.log` dosyasını inceleyin

4. **Sunucu bağlantısını test edin:**
   - Sunucunuzun dış HTTP isteklerine izin verdiğinden emin olun
   - cURL veya `file_get_contents()` fonksiyonlarının çalıştığını kontrol edin

### Aynı Deprem Tekrar Ekleniyor

Eklenti, yazı başlığına göre çift kayıt kontrolü yapar. Eğer sorun devam ediyorsa:

1. Veritabanında aynı başlıkla birden fazla yazı olup olmadığını kontrol edin
2. WordPress **Yazılar** bölümünden tekrar eden yazıları silin
3. Eklentiyi deaktive edip tekrar aktive edin

### Manuel Güncelleme Çalışmıyor

1. JavaScript console'da hata var mı kontrol edin
2. AJAX isteklerinin doğru çalıştığından emin olun
3. Yönetici yetkilerinizi kontrol edin

## Gelişmiş Ayarlar

### Güncelleme Sıklığını Değiştirme

Varsayılan olarak saatlik güncelleme yapılır. Bunu değiştirmek için `depremrss.php` dosyasında:

```php
// 43. satırda:
wp_schedule_event(time(), 'hourly', 'depremrss_fetch_earthquakes');

// Seçenekler: 'hourly', 'twicedaily', 'daily'
// Özel bir süre için WP-Cron custom interval eklemeniz gerekir
```

### Post Durumunu Değiştirme

Varsayılan olarak yazılar yayınlanır durumda eklenir. Taslak olarak eklemek için:

```php
// 303. satırda:
'post_status'   => 'publish',  // 'draft' olarak değiştirin
```

## Eklenti Bilgileri

- **Versiyon:** 1.0.0
- **Gerekli WordPress:** 5.0+
- **Gerekli PHP:** 7.0+
- **Lisans:** GPL v2 veya üzeri
- **Dil:** Türkçe

## Destek

Sorularınız veya sorunlarınız için:
- GitHub Issues: https://github.com/integrumart/depremrss/issues
- Pull Request'ler memnuniyetle karşılanır

## Güvenlik

Güvenlik açığı bulduysanız, lütfen herkese açık bir issue oluşturmak yerine repository sahibi ile doğrudan iletişime geçin.
