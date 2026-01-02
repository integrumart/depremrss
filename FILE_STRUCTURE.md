# Deprem RSS - Dosya Yapısı

Bu dokümanda eklentinin dosya ve klasör yapısı detaylı olarak açıklanmaktadır.

## Kök Dizin

```
depremrss/
├── depremrss.php              # Ana eklenti dosyası
├── uninstall.php              # Eklenti silindiğinde çalışır
├── index.php                  # Güvenlik (directory listing engelleme)
├── .gitignore                 # Git ignore kuralları
├── LICENSE                    # GPL-3.0 lisans dosyası
├── README.md                  # Ana dokümantasyon
├── readme.txt                 # WordPress.org formatında readme
├── INSTALLATION.md            # Detaylı kurulum rehberi
├── CONTRIBUTING.md            # Katkıda bulunma rehberi
├── CODE_OF_CONDUCT.md         # Davranış kuralları
├── CHANGELOG.md               # Sürüm geçmişi
├── EXAMPLES.md                # Kullanım örnekleri
├── QUICKSTART.md              # Hızlı başlangıç rehberi
├── TESTING.md                 # Test planı
├── FILE_STRUCTURE.md          # Bu dosya
├── assets/                    # CSS, JS ve resim dosyaları
├── includes/                  # PHP include dosyaları
└── languages/                 # Çeviri dosyaları
```

## Dosya Açıklamaları

### Ana Dosyalar

#### `depremrss.php`
**Amaç**: Ana eklenti dosyası  
**İçerik**:
- WordPress plugin header'ları
- Plugin sabitleri (version, paths)
- `DepremRSS` ana sınıfı
  - Singleton pattern
  - Hook initialization
  - Admin menu ekleme
  - RSS feed generation
  - Shortcode handler
  - Widget registration
  - CSS/JS enqueue
- Plugin initialization

**Önemli Fonksiyonlar**:
- `activate()`: Eklenti aktivasyonu
- `deactivate()`: Eklenti deaktivasyonu
- `add_admin_menu()`: Admin menü ekleme
- `admin_page()`: Admin sayfası render
- `add_custom_feed()`: RSS feed endpoint ekleme
- `generate_rss_feed()`: RSS XML oluşturma
- `get_earthquake_data()`: Deprem verilerini getirme
- `depremrss_shortcode()`: Shortcode handler

**Bağımlılıklar**:
- `includes/admin-page.php`
- `includes/shortcode-template.php`
- `includes/class-depremrss-widget.php`

#### `uninstall.php`
**Amaç**: Eklenti tamamen silindiğinde cleanup  
**İçerik**:
- WordPress uninstall hook kontrolü
- Options silme
- Transients temizleme
- Multisite desteği

**Ne Zaman Çalışır**: WordPress'ten eklenti silindiğinde

### Includes Dizini

```
includes/
├── admin-page.php              # Admin ayarlar sayfası template
├── shortcode-template.php      # Shortcode HTML template
├── class-depremrss-widget.php  # Widget sınıfı
└── index.php                   # Güvenlik
```

#### `includes/admin-page.php`
**Amaç**: Admin paneli ayarlar sayfası HTML template  
**İçerik**:
- Settings form
- Ayar alanları (URL, cache, limit, magnitude)
- RSS feed URL gösterimi
- Shortcode kullanım örnekleri
- Widget talimatları
- Son depremler sidebar
- Hakkında kutusu

**Güvenlik**:
- `esc_html()`, `esc_attr()`, `esc_url()` kullanımı
- `wp_nonce_field()` CSRF koruması

#### `includes/shortcode-template.php`
**Amaç**: `[depremrss]` shortcode için HTML template  
**İçerik**:
- Tablo yapısı
- Deprem listesi
- "Veri yok" mesajı
- Responsive tablo

**Kullanılan Değişkenler**:
- `$earthquakes`: Deprem dizisi

#### `includes/class-depremrss-widget.php`
**Amaç**: WordPress widget sınıfı  
**Extends**: `WP_Widget`  
**Fonksiyonlar**:
- `__construct()`: Widget constructor
- `widget()`: Widget frontend display
- `form()`: Widget admin form
- `update()`: Widget settings kaydetme

**Ayarlar**:
- `title`: Widget başlığı
- `limit`: Gösterilecek deprem sayısı
- `min_magnitude`: Minimum büyüklük

### Assets Dizini

```
assets/
├── css/
│   ├── admin.css       # Admin panel stilleri
│   ├── frontend.css    # Frontend stilleri
│   └── index.php       # Güvenlik
├── js/                 # JavaScript dosyaları (gelecek)
└── index.php           # Güvenlik
```

#### `assets/css/admin.css`
**Amaç**: Admin paneli özel stilleri  
**İçerik**:
- `.depremrss-admin`: Ana konteyner
- `.depremrss-content`: İçerik layout (flexbox)
- `.depremrss-main`: Ana içerik alanı
- `.depremrss-sidebar`: Sidebar
- `.depremrss-box`: Bilgi kutuları
- `.depremrss-list`: Deprem listesi
- Responsive mediaquery'ler

**Yüklenme**: Sadece `depremrss` admin sayfasında

#### `assets/css/frontend.css`
**Amaç**: Frontend (shortcode, widget) stilleri  
**İçerik**:
- `.depremrss-table`: Tablo stilleri
- `.depremrss-magnitude-*`: Büyüklük renk kodlaması
- `.depremrss-widget`: Widget stilleri
- Responsive tasarım (masaüstü, tablet, mobil)
- Mobil kart görünümü (<480px)

**Yüklenme**: Tüm frontend sayfalarda (wp_enqueue_scripts)

### Languages Dizini

```
languages/
├── depremrss.pot       # Translation template
└── index.php           # Güvenlik
```

#### `languages/depremrss.pot`
**Amaç**: Çeviri şablonu (Portable Object Template)  
**İçerik**:
- Tüm çevrilebilir string'ler
- msgid: Orijinal metin (Türkçe)
- msgstr: Çeviri (boş, doldurulacak)
- Dosya referansları

**Kullanım**: 
1. POT dosyasından .po dosyası oluştur
2. Çevirileri yap
3. .mo dosyasına derle
4. `languages/` dizinine yerleştir

**Örnek**:
```
depremrss-tr_TR.po  → Türkçe çeviri
depremrss-en_US.po  → İngilizce çeviri
```

## Dokümantasyon Dosyaları

### `README.md`
**Hedef Kitle**: Geliştiriciler, GitHub kullanıcıları  
**İçerik**:
- Özellikler
- Kurulum
- Kullanım (RSS, Shortcode, Widget)
- Ayarlar
- Özelleştirme
- Gereksinimler
- Lisans
- Katkıda bulunma

### `readme.txt`
**Hedef Kitle**: WordPress.org kullanıcıları  
**Format**: WordPress Plugin Readme standardı  
**Bölümler**:
- Description
- Installation
- FAQ
- Screenshots
- Changelog
- Upgrade Notice

### `INSTALLATION.md`
**Hedef Kitle**: Kullanıcılar  
**İçerik**:
- Adım adım kurulum
- İlk yapılandırma
- Detaylı kullanım
- Sorun giderme
- Performans ipuçları
- Özelleştirme örnekleri

### `CONTRIBUTING.md`
**Hedef Kitle**: Katkıda bulunacaklar  
**İçerik**:
- Katkı türleri
- Geliştirme ortamı kurulumu
- Kod standartları
- Commit mesaj formatı
- Pull request süreci
- Test etme

### `CODE_OF_CONDUCT.md`
**Hedef Kitle**: Tüm katılımcılar  
**İçerik**:
- Davranış kuralları (Contributor Covenant)
- Kabul edilebilir/edilemez davranışlar
- Uygulama politikaları

### `CHANGELOG.md`
**Hedef Kitle**: Kullanıcılar, geliştiriciler  
**Format**: Keep a Changelog  
**İçerik**:
- Versiyon geçmişi
- Eklenenler
- Değişenler
- Düzeltilenler
- Kaldırılanlar

### `EXAMPLES.md`
**Hedef Kitle**: Kullanıcılar  
**İçerik**:
- Görsel örnekler (ASCII art)
- Kullanım senaryoları
- Shortcode örnekleri
- CSS özelleştirme örnekleri
- PHP özelleştirme örnekleri

### `QUICKSTART.md`
**Hedef Kitle**: Acele kullancılar  
**İçerik**:
- 5 dakikada kurulum
- Hızlı komutlar
- Varsayılan ayarlar
- CSS sınıfları
- Sorun giderme özet

### `TESTING.md`
**Hedef Kitle**: Test ekibi, QA  
**İçerik**:
- Kapsamlı test planı
- Test case'ler
- Checklist'ler
- Test ortamı gereksinimleri
- Test raporu şablonu

### `FILE_STRUCTURE.md`
**Hedef Kitle**: Geliştiriciler  
**İçerik**: Bu dosya

## Güvenlik Dosyaları

### `index.php`
Her dizinde bulunan boş PHP dosyası.

**Amaç**: Directory listing'i engellemek  
**İçerik**: `<?php // Silence is golden.`  
**Neden Gerekli**: Web server yapılandırması directory listing'e izin veriyorsa, boş index.php bunu engeller.

### `.gitignore`
**Amaç**: Versiyon kontrolünden hariç tutulacak dosyalar  
**İçerik**:
- WordPress config dosyaları
- IDE/Editor dosyaları
- Geçici dosyalar
- node_modules
- vendor
- Log dosyaları

## Kod Organizasyonu

### Class Yapısı

```php
DepremRSS (Singleton)
├── __construct()
├── get_instance()
├── init_hooks()
├── activate()
├── deactivate()
├── add_admin_menu()
├── admin_page()
├── add_custom_feed()
├── generate_rss_feed()
├── get_earthquake_data()
├── depremrss_shortcode()
├── register_widget()
├── admin_enqueue_scripts()
└── frontend_enqueue_scripts()

DepremRSS_Widget (extends WP_Widget)
├── __construct()
├── widget()
├── form()
└── update()
```

### Hook Yapısı

**Activation/Deactivation**:
- `register_activation_hook()`: Plugin aktivasyonu
- `register_deactivation_hook()`: Plugin deaktivasyonu

**Admin**:
- `admin_menu`: Admin menü ekleme
- `admin_enqueue_scripts`: Admin CSS/JS

**Frontend**:
- `init`: Custom feed ekleme
- `wp_enqueue_scripts`: Frontend CSS/JS
- `widgets_init`: Widget registration

**Shortcode**:
- `add_shortcode('depremrss', ...)`: Shortcode registration

**Text Domain**:
- `plugins_loaded`: Çeviri dosyalarını yükleme

## Veri Akışı

### RSS Feed İsteği
```
1. Kullanıcı → /feed/deprem
2. WordPress → add_feed() ile custom feed
3. DepremRSS::generate_rss_feed()
4. get_earthquake_data() → Önbellek kontrolü
5. Transient varsa → Dön
6. Transient yoksa → Veri çek + Önbelleğe al
7. RSS XML oluştur
8. Output (exit)
```

### Shortcode İsteği
```
1. WordPress → Shortcode parse
2. DepremRSS::depremrss_shortcode($atts)
3. get_earthquake_data() → Önbellek kontrolü
4. Parametrelerle filtrele
5. Template include (shortcode-template.php)
6. HTML return
```

### Widget İsteği
```
1. WordPress → Widget render
2. DepremRSS_Widget::widget()
3. get_earthquake_data() → Önbellek kontrolü
4. Widget ayarları ile filtrele
5. HTML output
```

### Admin Settings Save
```
1. Form submit → POST
2. Nonce kontrolü
3. Sanitization
4. Options update
5. Transient delete (cache clear)
6. Success message
```

## Önbellek Mekanizması

**Kullanılan API**: WordPress Transients API

**Key**: `depremrss_data`  
**Değer**: Deprem dizisi  
**Süre**: Ayarlardan (`cache_duration`, varsayılan 300 saniye)

**İşleyiş**:
```php
// Önbellek kontrolü
$cached = get_transient('depremrss_data');
if (false !== $cached) {
    return $cached;
}

// Veri çek
$data = fetch_earthquake_data();

// Önbelleğe al
set_transient('depremrss_data', $data, $cache_duration);
```

**Temizlenme**:
- Ayarlar kaydedildiğinde
- `delete_transient('depremrss_data')`
- Otomatik (süre dolunca)
- Plugin silindiğinde

## WordPress Standartları

### Coding Standards
- [WordPress PHP Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/)
- PSR-12 benzeri
- Snake_case (WordPress style)

### Security
- `esc_html()`: HTML output
- `esc_attr()`: Attribute output
- `esc_url()`: URL output
- `sanitize_text_field()`: Text input
- `intval()`, `floatval()`: Numeric input
- `wp_nonce_field()`: CSRF protection
- `check_admin_referer()`: Nonce verification
- `current_user_can('manage_options')`: Capability check

### Best Practices
- Singleton pattern ana class için
- Transients API önbellekleme için
- `wp_enqueue_*` CSS/JS için
- Text domain çeviriler için
- Hooks/Filters genişletilebilirlik için

## Bağımlılıklar

### WordPress APIs
- Plugin API (hooks, filters)
- Options API (settings)
- Transients API (cache)
- Widget API
- Shortcode API
- Feed API
- Admin Menu API
- i18n (internationalization)

### PHP Requirements
- PHP 7.0+
- Extensions: json, date

### WordPress Requirements
- WordPress 5.0+

## Genişletilebilirlik

### Filtreler (Gelecek)
```php
// Deprem verilerini filtrele
apply_filters('depremrss_earthquakes', $earthquakes);

// Önbellek süresini değiştir
apply_filters('depremrss_cache_duration', $duration);

// RSS feed template
apply_filters('depremrss_rss_template', $template);
```

### Actionlar (Gelecek)
```php
// Deprem verisi güncellendi
do_action('depremrss_data_updated', $earthquakes);

// Ayarlar kaydedildi
do_action('depremrss_settings_saved', $options);
```

## Performans Notları

### Optimization
- Transients API kullanımı (DB cache)
- CSS/JS conditional loading
- Minimum DB sorguları
- Array filtering (PHP tarafında)

### Yüklenme Sırası
1. WordPress core yükleme
2. Plugins yükleme (including depremrss.php)
3. Theme yükleme
4. Hooks çalışma (init, wp_enqueue_scripts, etc.)

## Gelecek Geliştirmeler

### Planlanan Dosyalar (v1.1.0+)
- `assets/js/admin.js`: Admin panel JavaScript
- `assets/js/frontend.js`: Frontend JavaScript
- `includes/class-depremrss-api.php`: API handler
- `includes/class-depremrss-cache.php`: Cache manager
- `includes/functions.php`: Helper functions
- `tests/`: PHPUnit testleri

### Planlanan Özellikler
- Gerçek API entegrasyonu
- Harita görünümü
- Gutenberg block
- REST API endpoints
- E-posta bildirimleri

---

**Versiyon**: 1.0.0  
**Son Güncelleme**: 2026-01-02  
**Yazar**: IntegrumArt
