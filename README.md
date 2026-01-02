# Deprem RSS - WordPress Eklentisi

Kandilli Rasathanesi'nden deprem verilerini otomatik olarak çekerek WordPress sitenize yazı olarak ekleyen eklenti.

## Özellikler

- 🌍 Kandilli Rasathanesi RSS beslemesinden otomatik deprem verisi çekme
- 📝 Her deprem için otomatik WordPress yazısı oluşturma
- ⏰ Otomatik güncelleme (her saat başı)
- 🔄 Manuel güncelleme seçeneği
- 📊 Deprem detayları (büyüklük, derinlik, konum)
- 🏷️ Otomatik "Deprem" kategorisi oluşturma
- ✅ Çift kayıt önleme sistemi

## Kurulum

### Manuel Kurulum

1. `depremrss.php` dosyasını WordPress kurulumunuzun `wp-content/plugins/depremrss/` dizinine yükleyin
2. WordPress yönetim panelinden "Eklentiler" menüsüne gidin
3. "Deprem RSS" eklentisini bulun ve "Etkinleştir" butonuna tıklayın

### ZIP ile Kurulum

1. Bu repository'yi ZIP olarak indirin
2. WordPress yönetim panelinde "Eklentiler > Yeni Ekle > Eklenti Yükle" menüsüne gidin
3. ZIP dosyasını yükleyin ve eklentiyi etkinleştirin

## Kullanım

### Otomatik Çalışma

Eklenti aktif edildiğinde otomatik olarak:
- Her saat başı Kandilli Rasathanesi RSS beslemesini kontrol eder
- Yeni depremleri WordPress yazısı olarak ekler
- Çift kayıt oluşturmamak için kontrol yapar

### Manuel Güncelleme

1. WordPress yönetim panelinde "Deprem RSS" menüsüne gidin
2. "Şimdi Depremleri Getir" butonuna tıklayın
3. Eklenti anında yeni depremleri kontrol edip ekleyecektir

### Deprem Yazıları

Her deprem yazısı şu bilgileri içerir:
- Başlık (büyüklük, yer, tarih, saat)
- Deprem büyüklüğü
- Derinlik
- Konum (enlem, boylam)
- Kaynak linki

Tüm depremler otomatik olarak "Deprem" kategorisine eklenir.

## Veri Kaynağı

Deprem verileri Boğaziçi Üniversitesi Kandilli Rasathanesi ve Deprem Araştırma Enstitüsü'nün (KRDAE) RSS beslemesinden alınmaktadır:
- **RSS URL:** http://koeri.boun.edu.tr/rss/

## Teknik Detaylar

- **Gereksinimler:** WordPress 5.0+, PHP 7.0+
- **Programlama Dili:** PHP
- **Bağımlılıklar:** WordPress Core (wp-cron, wp_remote_get, SimpleXML)
- **Güncelleme Sıklığı:** Saatlik (özelleştirilebilir)

## Lisans

GPL v2 veya üzeri

## Destek

Sorunlar veya öneriler için [GitHub Issues](https://github.com/integrumart/depremrss/issues) sayfasını kullanabilirsiniz.

## Sorumluluk Reddi

Bu eklenti Kandilli Rasathanesi tarafından sağlanan verileri kullanır. Deprem bilgilerinin doğruluğu ve güncelliği için Kandilli Rasathanesi sorumludur.
