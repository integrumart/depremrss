# Changelog

Tüm önemli değişiklikler bu dosyada belgelenecektir.

Format [Keep a Changelog](https://keepachangelog.com/en/1.0.0/) standardına dayanır,
ve bu proje [Semantic Versioning](https://semver.org/spec/v2.0.0.html) kullanır.

## [1.0.0] - 2026-01-02

### Eklendi
- İlk sürüm yayınlandı
- Deprem verilerini RSS feed olarak sunma
- WordPress yönetim paneli entegrasyonu
- Ayarlar sayfası ile kolay yapılandırma
- Önbellekleme sistemi (varsayılan 5 dakika)
- Shortcode desteği: `[depremrss]`
- Shortcode parametreleri: `limit`, `min_magnitude`
- Widget desteği: Sidebar/footer için deprem widget'ı
- Büyüklüğe göre renk kodlaması
- Responsive tasarım (masaüstü, tablet, mobil)
- Türkçe dil desteği
- Tam dokümantasyon (README.md, INSTALLATION.md)
- GPL-3.0 lisansı

### Özellikler
- KOERI (Kandilli Rasathanesi) veri kaynağı desteği
- Özelleştirilebilir minimum büyüklük filtresi
- Özelleştirilebilir deprem sayısı limiti
- Önbellek süresi ayarı
- Admin panelinde canlı deprem listesi
- RSS feed: `/feed/deprem` endpoint
- Güvenli veri işleme (sanitization, escaping)
- WordPress Coding Standards uyumlu

### Teknik Detaylar
- WordPress 5.0+ gereksinimi
- PHP 7.0+ gereksinimi
- Singleton pattern kullanımı
- WordPress Hooks API entegrasyonu
- Transients API ile önbellekleme
- Widget API kullanımı
- Shortcode API kullanımı
- Custom Feed API kullanımı

## [Planlanan] - Gelecek Sürümler

### Versiyon 1.1.0
- [ ] Gerçek KOERI veri entegrasyonu
- [ ] Harita görünümü (Google Maps/Leaflet)
- [ ] E-posta bildirimleri
- [ ] Büyük depremler için anlık bildirim
- [ ] Çoklu dil desteği (İngilizce, vb.)

### Versiyon 1.2.0
- [ ] Deprem detay sayfaları
- [ ] Deprem istatistikleri ve grafikler
- [ ] CSV/Excel export özelliği
- [ ] REST API endpoint'leri
- [ ] Gutenberg block desteği

### Versiyon 2.0.0
- [ ] Çoklu veri kaynağı desteği
- [ ] Gelişmiş filtreleme seçenekleri
- [ ] Kullanıcı favorileri
- [ ] Deprem alarm sistemi
- [ ] Push notification desteği
